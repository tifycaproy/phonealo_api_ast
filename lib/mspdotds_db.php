<?php

function _encomillaCampo($campoValor) {
    $campoValor = trim($campoValor);

    if (_is_number($campoValor)) {
        //$campoValor = mssql_escape_string($campoValor);
        //return "'$campoValor'";
        return "$campoValor";
    } else {
        return "'$campoValor'";

    }
}

/**
 * Convierte el arreglo de key=>value a una cadena apropiada para el where
 *
 * @param array $where_fields
 * @return str
 */
function db_format_where($where_fields, $hideWhere = false) {
    $where_clause = '';

    if (is_array($where_fields) && (sizeof($where_fields) > 0)) {
        $where_clause = array(
        );
        foreach ($where_fields as $key => $value) {
            if (is_array($value)) {
                if (isset($value["oper"])) {
                    $where_clause[] = sprintf("%s{$value['oper']}%s", $value["left"], $value['right']);
                }
            } else {
                if (is_numeric($value))
                    $where_clause[] = sprintf("%s=%s", $key, $value);
                else
                    $where_clause[] = sprintf("%s=%s", $key, _encomillaCampo($value));
            }
        }

        $where_clause = (($hideWhere) ? '' : 'where ') . implode(" and ", $where_clause);
    }

    return $where_clause;
}

function getcc() {
    $r = mysql_query("show status like 'Select_full_join';");
    $ci = mysql_fetch_array($r);

    return $ci[1];
}

/**
 * Realiza una consulta sobre la db. Si se pasan parametros luego de la consulta, se sustituyen en los %s que hayan en
 * la misma.
 *
 * @param str $query
 * @return resource
 */
function db_query($query, $params = null) {
    global $dbh;

    $args = func_get_args();
    $query = array_shift($args);

    if (is_array($args) && (sizeof($args) > 0)) {
        $query = vsprintf($query, $args);
    }

    //$res = sqlsrv_query($conn, $query);

    $res = $dbh->prepare($query);
    $res->execute();

    if (!$res) {
        die('Error consulta: ' . $query . " \n");
    }

    return $res;
}

/**
 * Hace un fetch_assoc al resource pasado como parametro
 *
 * @param resource $resource
 * @return array
 */
function db_fetch($res) {

    $row = $res->fetch();

    return $row;
}

/**
 * Devuelve un array de los campos pasados en el parametro fields de tipo array
 *
 * @param resource $res
 * @param array $fields 
 * @return array
 */
function db_batch_fetch($res, $fields = null) {
    $result = array();
    if ($res) {
        while ($row = db_fetch($res)) {
            if (is_null($fields)) {
                $result[] = $row;
            } else if (is_array($fields)) {
                $result[] = array_intersect_key($row, array_flip($fields));
            } else {
                $result[] = $row[$fields];
            }
        }
    }

    return $result;
}

/**
 * Retorna el valor del campo especificado, solo de la 1ra fila (util para hacer count)
 *
 * @param str $query
 * @param str $field
 * @return int
 */
function db_get_field($query, $field) {

    $res = db_query($query);
    $result = db_fetch($res);

    return $result["$field"];
}

function db_get_fieldtable($table, $field,  $where = array ()) {

    $res = db_direct_query($table, $where);
    $result = db_fetch($res);

    return $result["$field"];
}

/**
 * Hace una consulta a la bd y devuelve un apuntador a los resultados, genial para hacer tablas o mostrar resultados
 *
 * @param str $table
 * @param array $where
 * @param array $order
 * @return 
 */
function db_direct_query($table, $where = array(), $order = array()) {
    $query = "select * from $table " . db_format_where($where);

    if (is_array($order) && (sizeof($order) > 0)) {
        $query .= " order by " . implode(", ", $order);
    }

    return db_query($query);
}

function db_insert($table_name, $fields_values) {
    $keys = array();
    $values = array();
    foreach ($fields_values as $key => $value) {
        $keys[] = $key;
        $values[] = _encomillaCampo(trim($value));
    }

    
    //$res = db_query('BEGIN TRANSACTION;');

    //$res = db_query('COMMIT TRANSACTION');
    
    $res = db_query("insert into $table_name (%s) values (%s)", implode(',', $keys), implode(',', $values));
    
    if ($res) {
        //db_query('commit');
        $last = db_fetch(db_query("select SCOPE_IDENTITY() as lastid"));
        return $last['lastid'];
    } else {
        return false;
    }
}

function db_update($table_name, $field_values, $where_fields) {
    $where_clause = db_format_where($where_fields);

    $fields = array();
    foreach ($field_values as $key => $value) {
        $sqlValue = _encomillaCampo(trim($value));
        $fields[] = $key . '=' . $sqlValue;
    }

    $sql = "update $table_name set " . implode(",", $fields) . " " . $where_clause;
    
//    echo $sql;
//    die(0);

    if (db_query($sql)) {
        //db_query('commit');
        return true;
    } else {
        return false;
    }
}

function db_delete($table, $where_fields) {
    $where_clause = db_format_where($where_fields);

    $sql = "delete from $table $where_clause";

    if (db_query($sql)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Cuenta los resultados de una consulta
 *
 * @param str $table
 * @param array $where
 * @return 
 */
function db_count($table, $field, $where = array()) {
    $query = "select count($field) cnt from $table " . db_format_where($where);
    
    
    if (is_array($order) && (sizeof($order) > 0)) {
        $query .= " order by " . implode(", ", $order);
    }

    $stmt = db_query($query);
    $row = db_fetch($stmt);

    return ($row['cnt']);
}

/**
 * Suma los valores de un campo
 *
 * @param str $table
 * @param array $where
 * @return
 */
function db_sum($table, $field, $where = array()) {
    $query = "select sum($field) cnt from $table " . db_format_where($where);


    if (is_array($order) && (sizeof($order) > 0)) {
        $query .= " order by " . implode(", ", $order);
    }

    $stmt = db_query($query);
    $row = db_fetch($stmt);

    return ($row['cnt']);
}

/**
 * Devuelve el siguiente ID de campo clave de la tabla, bueno para insertar en ORACLE
 *
 * @param str $table
 * @param str $campo
 * @return 
 */
function db_sig_id($table, $campo) {
    $query = "select max($campo)+1 mx from $table";
    $stmt = db_query($query);
    $row = db_fetch($stmt);
    return $row->mx;
}


/*
 * Arregla las cadenas para 
 */

function mssql_escape_string($data) {
    if (!isset($data) or empty($data))
        return '';
    if (is_numeric($data))
        return $data;

    $non_displayables = array(
        '/%0[0-8bcef]/', // url encoded 00-08, 11, 12, 14, 15
        '/%1[0-9a-f]/', // url encoded 16-31
        '/[\x00-\x08]/', // 00-08
        '/\x0b/', // 11
        '/\x0c/', // 12
        '/[\x0e-\x1f]/'             // 14-31
    );
    foreach ($non_displayables as $regex)
        $data = preg_replace($regex, '', $data);
    $data = str_replace("'", "''", $data);
    return $data;
}
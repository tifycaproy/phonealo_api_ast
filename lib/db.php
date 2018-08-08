<?php

function _encomillaCampo($campoValor) {
    if (is_numeric($campoValor)) {
        $campoValor = mysql_real_escape_string($campoValor);
        return "'$campoValor'";
    }

    switch ($campoValor) {
        case 'now()':
            return 'now()';
            break;
        case 'null-null':
            return 'null';
            break;
        default:
            $campoValor = mysql_real_escape_string($campoValor);
            return "'$campoValor'";
    }
}

/**
 * Convierte el arreglo de key=>value a una cadena apropiada para el where
 *  Para trabajar con operadores se pasa un valor del campo tipo array donde key es el campo y el valor 
 *  es un array tipo:
 *  array (
 *      campo_cod => array (
 *                  oper => 'like',
 *                  derecha => '"%prueba%"'
 *              )
 *  )
 * 
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
                    $where_clause[] = sprintf("%s {$value['oper']} %s", $key, $value['derecha']);
                }
            } else {
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
function db_query($query) {

    $args = func_get_args();
    $query = array_shift($args);

    if (is_array($args) && (sizeof($args) > 0)) {
        $query = vsprintf($query, $args);
    }

    $res = mysql_query($query) or die(mysql_error() . " query: " . $query);

    if (!$res) {
        die(mysql_error() . ' consulta: ' . $query . " \n" . debug_print_backtrace());
    }

    return $res;
}

/**
 * Hace un fetch_assoc al resource pasado como parametro
 *
 * @param resource $resource
 * @return array
 */
function db_fetch($resource) {
    return mysql_fetch_assoc($resource);
}

/**
 * Da un fetch_assoc a cada row devuelto en el resource pasado como parametro
 *
 * @param resource $res
 * @return array
 */
function db_batch_fetch($res, $fields = null) {
    $result = array();

    if (mysql_numrows($res) > 0) {
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

    return $result[$field];
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
        $values[] = _encomillaCampo($value);
    }

    db_query("insert into $table_name (%s) values (%s)", implode(',', $keys), implode(',', $values));

    $insID = mysql_insert_id();
    if ($insID) {
        return $insID;
    } else {
        return (mysql_affected_rows() > 0);
    }
}

function db_update($table_name, $field_values, $where_fields) {
    $where_clause = db_format_where($where_fields);

    $fields = array();
    foreach ($field_values as $key => $value) {
        $sqlValue = _encomillaCampo($value);

        $fields[] = $key . '=' . $sqlValue;
    }

    $sql = "update $table_name set " . implode(",", $fields) . " " . $where_clause;

    if (db_query($sql)) {
        return (mysql_affected_rows() > 0);
    } else {
        return false;
    }
}

function db_delete($table, $where_fields) {
    $where_clause = db_format_where($where_fields);

    $sql = "delete from $table $where_clause";
    if (db_query($sql)) {
        return (mysql_affected_rows() > 0);
    } else {
        return false;
    }
}

/**
 * Devuelve true si una tabla existe
 *
 * @param str $table_name
 * @return boolean
 */
function table_exists($table_name) {

    $sql = "show tables";

    $result = db_query($sql);

    $a_tables = db_batch_fetch($result);

    return in_array($table_name, $a_tables);
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
    
    $stmt = db_query($query);
    $row = db_fetch($stmt);

    return ($row['cnt']);
}
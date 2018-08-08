<? 
function _encomillaCampo($campoValor) {
	if (is_numeric($campoValor)) {
		$campoValor = mysql_escape_string($campoValor);
		return "'$campoValor'";
	}

	$charInitValor = substr($campoValor, 0, 2);
	
	switch ($charInitValor) {
		case '->':
			$campoValor = substr($campoValor, 2);
			$campoValor = mysql_escape_string($campoValor);
			return $campoValor;
			break;
		case '=>':
			$campoValor = substr($campoValor, 2);
			return $campoValor;
			break;
		default:
			$campoValor = mysql_escape_string($campoValor);
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
				$where_clause[] = sprintf("%s=%s", $key, _encomillaCampo($value));
			}
		}
		
		$where_clause = (($hideWhere)?'':'where ') . implode(" and ", $where_clause);
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
	global $conn;
	$args = func_get_args();
	$query = array_shift($args);
	
	if (is_array($args) && (sizeof($args) > 0)) {
		$query = vsprintf($query, $args);
	}

	//echo $query."<br />";
	$res = ociparse($conn, $query) or die(oci_error()." query: ".$query);
	ociexecute($res, OCI_DEFAULT);		
	
	if (!$res) {
		die('Error consulta: '.$query." \n");
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
	
	ocifetchinto($resource, $rows, OCI_ASSOC);
		
	return $rows;
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

/**
 * Hace una consulta a la bd y devuelve un apuntador a los resultados, genial para hacer tablas o mostrar resultados
 *
 * @param str $table
 * @param array $where
 * @param array $order
 * @return 
 */
function db_direct_query($table, $where = array(), $order = array()) {
	$query = "select * from $table ".db_format_where($where);
	
	if (is_array($order) && (sizeof($order) > 0)) {
		$query .= " order by ".implode(", ", $order);
	}

	return db_query($query);
}


function db_insert($table_name, $fields_values) {
	$keys = array();
	$values = array();
	foreach ($fields_values as $key=>$value) {
		$keys[] = $key;
		$values[] = _encomillaCampo($value);
	}
	
	$res = db_query("insert into $table_name (%s) values (%s)", implode(',', $keys), implode(',', $values));
	
	if ($res) {
		db_query('commit');
		return true;
	} else {
		return  false;	
	}
}

function db_update($table_name, $field_values, $where_fields) {
	$where_clause = db_format_where($where_fields);
	
	$fields = array();
	foreach ($field_values as $key=>$value) {
		$sqlValue = _encomillaCampo($value);
		
		$fields[] = $key.'='.$sqlValue;
	}
	
	$sql = "update $table_name set ".implode(",", $fields)." ".$where_clause;
	
	if (db_query($sql)) {
		db_query('commit');
		return  true;
	} else {
		return false;
	}
}

function db_delete($table, $where_fields) {
	$where_clause = db_format_where($where_fields);
	
	$sql = "delete from $table $where_clause";
	
	if (db_query($sql)) {
		db_query('commit');
		return  true;
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
function db_count($table, $where = array()) {
	$query = "select count(*) cnt from $table ".db_format_where($where);
	
	if (is_array($order) && (sizeof($order) > 0)) {
		$query .= " order by ".implode(", ", $order);
	}
	
	$stmt = db_query($query);	
	$row = db_fetch($stmt);
	
	return ($row['CNT']);
}


/**
 * Cuenta los resultados en base a la consulta
 *
 * @param str $consulta
 * @return 
 */
function db_row_count($consulta) {
	
	$query = "select count(*) CNT from ( $consulta )";

	$stmt = db_query($query);	
	$row = db_fetch($stmt);
	return ($row['CNT']);
}

/**
 * Devuelve el siguiente ID de campo clave de la tabla, bueno para insertar en ORACLE
 *
 * @param str $table
 * @param str $campo
 * @return 
 */
function db_sig_id($table, $campo) {
	$query = "select nvl(max($campo),0)+1 mx from $table";
	$stmt = db_query($query);	
	$row = db_fetch($stmt);
	return $row['MX'];
}
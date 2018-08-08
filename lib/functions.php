<?php

function redirect($url) {
    if (substr($url, 0, 4) == 'http')
        header("Location:$url");
    else {
        $url = base_path.$url;
        header("Location:$url");
    }
    die();
}

/**
 * despulpa una query sacando los valores en un arreglo asociativo o solo los valores en caso de no pasar $valueField
 *
 * @param str $query
 * @param str $keyField
 * @param str $valueField
 * @return array($keyField => $valueField) || array($keyField)
 */
function getResultsFromQuery($query, $keyField, $valueField = false) {
    $result = array();

    $res = db_query($query);
    if (mysql_num_rows($res) > 0) {
        while ($info = mysql_fetch_array($res)) {
            if (!$valueField) {
                $result[] = $info[$keyField];
            } else {
                $result[$info[$keyField]] = $info[$valueField];
            }
        }
    }

    return $result;
}

function getResultFromQuery($query, $field) {
    $res = getResultsFromQuery($query, $field);

    if (sizeof($res) > 0) {
        $result = $res[0];
    } else {
        $result = false;
    }

    return $result;
}

function getQuery($distinct = false, $selectFields, $fromClause = array(), $whereClause = array(), $rest = "") {
    $query = "select ";

    if ($distinct) {
        $query .= " distinct";
    }

    $query .= implode($selectFields);

    $query .= " from " . implode(" ", $fromClause);

    if (sizeof($whereClause) > 0) {
        $query .= " where " . implode(" ", $whereClause);
    }

    $query .= $rest;

    return $query;
}

function getClasificador($tabla, $keyCampo, $valueCampo, $where = array()) {
    return getResultsFromQuery($query, $keyCampo, $valueCampo);
}

function date2ISO($date) {
    $parts = explode("/", $date);
    $iso = "{$parts[2]}-{$parts[1]}-{$parts[0]}";

    return $iso;
}

function formatDate($date) {
    if (strpos($date, "/") !== false) { // dd/mm/yyyy
        $result = date2ISO($date);
    } else {
        $result = $date;
    }

    return $result;
}



function print_object($var) {
    ?><pre>
    <?php print_r($var); ?>    
    </pre>
    <?php
}


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {
    if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

    switch ($theType) {
        case "text" :
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "long" :
        case "int" :
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
        case "double" :
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
        case "date" :
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined" :
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
    }
    return $theValue;
}

function printableDate($date) {
    if (strpos($date, "-") === false) { // dd/mm/yyyy
        $result = $date;
    } else {
        $result = date("d/m/Y", strtotime($date));
    }

    return $result;
}

function dateDiff($interval, $dateTimeBegin, $dateTimeEnd) {
    //Parse about any English textual datetime
    //$dateTimeBegin, $dateTimeEnd
    $dateTimeBegin = strtotime($dateTimeBegin);
    if ($dateTimeBegin === -1) {
        return ("..begin date Invalid");
    }
    $dateTimeEnd = strtotime($dateTimeEnd);
    if ($dateTimeEnd === -1) {
        return ("..end date Invalid");
    }
    $dif = $dateTimeEnd - $dateTimeBegin;
    switch ($interval) {
        case "s" : //seconds
            return ($dif);
        case "n" : //minutes
            return (floor($dif / 60)); //60s=1m
        case "h" : //hours
            return (floor($dif / 3600)); //3600s=1h
        case "d" : //days
            return (floor($dif / 86400)); //86400s=1d
        case "ww" : //Week
            return (floor($dif / 604800)); //604800s=1week=1semana
        case "m" : //similar result "m" dateDiff Microsoft
            $monthBegin = (date("Y", $dateTimeBegin) * 12) + date("n", $dateTimeBegin);
            $monthEnd = (date("Y", $dateTimeEnd) * 12) + date("n", $dateTimeEnd);
            $monthDiff = $monthEnd - $monthBegin;
            return ($monthDiff);
        case "yyyy" : //similar result "yyyy" dateDiff Microsoft
            return (date("Y", $dateTimeEnd) - date("Y", $dateTimeBegin));
        default :
            return (floor($dif / 86400)); //86400s=1d
    }
}

function parseTemplate($template_content, $values) {
    $tag = array();
    $replace = array();

    foreach ($values as $key => $value) {
        $tag[] = "[$key]";
        $replace[] = $value;
    }

    return str_replace($tag, $replace, $template_content);
}

/**
 * Sustituye JSON para servidor de PHP inferior a 5.3
 *
 * @param array $data
 * @param str $keyField
 * @param str $valueField
 * @return array($keyField => $valueField) || array($keyField)
 */
function myJSONEncode($data) {

    $a_tmp = array();
    foreach ($data as $indice => $valor)
        array_push($a_tmp, '"' . $indice . '":"' . addslashes($valor) . '"');

    return "{" . implode(",", $a_tmp) . "}";
}

/**
 * Prepara una cadena para las b�squedas utilizando regexplike
 * @param unknown_type $strig2search 
 * @param unknown_type $exact
 */
function prep_str2search($strig2search, $exact = true, $separador = ",") {

    $a_str = explode($separador, $strig2search);

    //Limpiamos los espacios
    $a_str = array_map("trim", $a_str);

    //Si la busquedas es exacta agregamos los ^ y los $ al final para palabras completas
    if ($exact)
        $r_str = "^" . implode("$|^", $a_str) . "$";
    else
        $r_str = implode("|", $a_str);

    return $r_str;
}

//SERGIO
/**
 * Conviertes caracteres codificados de url a utf8
 * 
 * @param string $eC
 */
/* function urlDecode($eC) {
  $arr_col_name = array ('%C2%A0','%C3%80','%C3%81','%C3%84','%C3%87','%C3%88','%C3%89','%C3%8B','%C3%8C','%C3%8D','%C3%8F','%C3%91','%C3%92','%C3%93','%C3%96','%C3%99','%C3%9A','%C3%9C','%C3%9D','%C3%A0','%C3%A1','%C3%A4','%C3%A7','%C3%A8','%C3%A9','%C3%AC','%C3%AD','%C3%B1','%C3%B2','%C3%B3','%C3%B6','%C3%B9','%C3%BA','%C3%B','%C3%BF','%2C');
  $arr_col_ord = array (' ','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','�','','�','�',',');
  return str_replace($arr_col_name, $arr_col_ord, $eC);
  } */

/**
 * Convierte una url con datos serializados a un array asociativo
 * 
 * @param string $url
 */
function url_to_array($url) {
    $arr = explode("?", $url);
    $arr = explode("&", $arr[1]);
    foreach ($arr as $c => $v) {
        $valor = explode("=", $v);
        $arr_res[$valor[0]] = urlDecode($valor[1]); //str_replace('%2C', ',', $valor[1]);
    }
    return $arr_res;
}

/*
 * Devuelve TRUE si tiene valor
 */
function have_value($v) {
    return (strlen($v) > 0);
}

function showMes($mes_cod) {
    $meses = array (
        '', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    );
    return $meses[$mes_cod];
}


/**
 * @param $url :http://xxx.xx/xxx
 * @param $data_string : JSON con los parametros a pasar
 * @return mixed
 */
function postapi($url, $data_string) {
    //$data_string = eregi_replace("[\n|\r|\n\r]", ' ', $data_string);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );

    $result = curl_exec($ch);
    curl_close($ch);
    //conv_log($url . ' <br/>' . $result, 'Resultado envio datos');
    return $result;
}

function getapi($url, $data_string = '') {

    //$data_string = eregi_replace("[\n|\r|\n\r]", ' ', $data_string);
    $data_string = preg_replace("/[\n|\r|\n\r]/", ' ', $data_string);

    $ch = curl_init() or die(curl_error($ch));
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        )
    );
    //$data1 = curl_exec($ch) or die('Fallo de comunicaci&oacute;n' . curl_error($ch) . print_object($data_string));
    $data1 = curl_exec($ch);
    curl_close($ch);
    return $data1;
}
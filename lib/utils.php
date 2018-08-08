<?php

function send_mail($to, $subject, $message, $from_name, $from_email, $reply_to = 'vacio')
{
    if ($reply_to == 'vacio') {
        $reply_to = $from_email;
    }
    // check whether the message has got html content
    $content_type = "text/html";
    //$message=stripslashes($message);
    if (preg_match("/\<(.*?)\>(.*?)\<\/(.*?)\>/is", $message)) {
        $content_type = "text/html";
        //$message=nl2br($message);
    }
    // Clean the from data
    $from_array = preg_split("/[\r\n]+/is", trim($from_email), -1, PREG_SPLIT_NO_EMPTY);
    $from = $from_array[0];
    // From array cleaned	
    $headers = "MIME-Version: 1.0 \n";
    $headers .= "Content-type: $content_type; charset=IS0-8859-15 \n";
    $headers .= "From: $from_name <$from_email> \n";
    $headers .= "Reply-To: $reply_to \n";

    //echo "to=$to,from=$from,subject=$subject,message=$message";
    if (trim($to) == "") { // To address missing
        return;
    }
    $bool = @mail($to, $subject, $message, $headers);
    //echo "bool=$bool";

    return $bool;
}

/**
 * Pilla los files de un POST y los guarda en la tabla files, devuelve el COD del file insertado
 */
function process_file($file, $ruta) {


}


function factual_datetime()
{
    return date('d-m-Y H:i:s.000');
}

function factual_datetime_mysql()
{
    return date('Y-m-d H:i:s.000');
}

function date_flat2mysql($strdate)
{
    $y = substr($strdate, 4, 4);
    $d = substr($strdate, 0, 2);
    $m = substr($strdate, 2, 2);
    $h = substr($strdate, 8, 2);
    $mi = substr($strdate, 10, 2);

    return sprintf('%s-%s-%s %s:%s', $y, $m, $d, $h, $mi);
}

function date_mysql2flat($date) {

    $datestr = substr($date, 0, 10);
    $adate = explode('-', $datestr);

    $timestr = substr($date, 11);

    $atime = explode(":", $timestr);

    return $adate[2].$adate[1].$adate[0].$atime[0].$atime[1];
}


function factual_datetime_inc_day($num_days)
{
    $date = new DateTime();
    $date->modify('+'.$num_days.' day');
    return $date->format('d-m-Y H:i:s.000');
}

function factual_date()
{
    $fecha = date("Y") . "-" . date("m") . "-" . date("d");
    return ($fecha);
}

function factual_dateYMD()
{
    $fecha = date("Y") . "-" . date("m") . "-" . date("d");
    return ($fecha);
}


function factual_dateDMY()
{
    $fecha = date("d") . "-" . date("m") . "-" . date("y");
    return ($fecha);
}

function b_coma($strcoma)
{
    if (strlen($strcoma) != 0) {
        $str_ret = ", " . $strcoma;
    } else {
        $str_ret = "";
    }
}

function cambiaf_a_normal($fecha)
{
    if (strlen($fecha) >= 10) {
        $fecha = substr($fecha, 0, 10);
        preg_match("/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha);
        $lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
    } else
        $lafecha = '';
    return $lafecha;
}

function cambiaf_a_normal_time($fecha, $only_time = false)
{
    if (strlen($fecha) > 0) {
        $hora = substr($fecha, 10, 6);
        $fecha = substr($fecha, 0, 10);
        if (strlen($fecha) == 10) {
            //ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
            preg_match("/([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})/", $fecha, $mifecha);
            $lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];

        } else {
            $lafecha = '';
        }
    } else {
        $lafecha = '';
        $hora = '';
    }

    return ($only_time)?$hora:$lafecha.' ' .$hora;
}

function get_datetime_from_object($fecha, $formato = 'Y-m-d H:i:s')
{
    if (is_object($fecha)) {
        $ret = $fecha->format($formato);
        //$ret = cambiaf_a_normal_time($fecha->date);
    } else {
        $ret = $fecha;
    }
    return $ret;
}


function show_datetime_from_sqls($fecha, $formato = 'd/m/Y H:i:s')
{
    if (is_object($fecha)) {
        $ret = $fecha->format($formato);
        //$ret = cambiaf_a_normal_time($fecha->date);
    } else {
        $ret = $fecha;
    }
    return $ret;
}

function date2ocm($fecha) {

    $afecha =  explode('/', substr($fecha, 0, 10));
    return $afecha[1].$afecha[0].$afecha[2];

}

/*
 * Arreglamos la fecha para poder pasarla a la htmltable
 */
function fix_objfecha_html_table(&$value, $key)
{

    $keys = array_keys($value);
    foreach ($keys as $key) {
        if (strpos($key, 'fecha') != 0) {
            $value[$key] = show_datetime_from_sqls($value[$key]);
        }
    }

}

function cambiaf_a_mysql($fecha, $separador = '-')
{
    //ereg("([0-9]{1,2})$separador([0-9]{1,2})$separador([0-9]{2,4})", $fecha, $mifecha);
    preg_match("/([0-9]{1,2})$separador([0-9]{1,2})$separador([0-9]{2,4})/", $fecha, $mifecha);

    $lafecha = $mifecha[3] . "-" . $mifecha[2] . "-" . $mifecha[1];
    return $lafecha;
}

function fecha2time($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha = $mifecha[3] . "/" . $mifecha[2] . "/" . $mifecha[1];
    $ftime = mktime(0, 0, 0, $mifecha[2], $mifecha[3], $mifecha[1]);
    return $ftime;
}

function fechaDia($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    return $mifecha[3];
}

function fechaMes($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    return $mifecha[2];
}

function aa_fechaMesNombre($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $nmes = $mifecha[2];
    //$resmes = mysql_query("select * from meses where mes_cod = $nmes");
    //$row = mysql_fetch_object($resmes);
    $a = 1;
    $b = 32;
    $MesNombre = db_get_field("select * from meses where mes_cod = $nmes", "mes_desc_es");
    //$MesNombre = $row->mes_desc_es;
    return $MesNombre;
}

function fechaMesNombre($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $nmes = $mifecha[2];
    //$resmes = mysql_query("select * from meses where mes_cod = $nmes");
    //$row = mysql_fetch_object($resmes);
    $a = 1;
    $b = 32;
    $lang = $_SESSION['lang'];
    $MesNombre = db_get_field("select * from meses where mes_cod = $nmes", "mes_desc_$lang");
    //$MesNombre = $row->mes_desc_es;
    return $MesNombre;
}


function incDia($fecha, $cmeses)
{
    $fecha = strtotime("$fecha + $cmeses month");
    $retval = date('Y-m-d', $fecha);
    return $retval;
}

function incMes($fecha, $cmeses)
{
    $fecha = strtotime("$fecha + $cmeses month");
    $retval = date('Y-m-d', $fecha);
    return $retval;
}

function decMes($fecha, $cmeses)
{
    $fecha = strtotime("$fecha - $cmeses month");
    $retval = date('Y-m-d', $fecha);
    return $retval;
}

function fechaAnyo($fecha)
{
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    return $mifecha[1];
}

function showMinutos($segundos) {
    return number_format($segundos / 60, 1);
}

function tipoDia($fecha, $expo)
{
    include("conectar.php");
    //Analizar si es festivo
    ereg("([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $anyo = $mifecha[1];
    $mes = $mifecha[2];
    $dia = $mifecha[3];
    $curday = date("w", fecha2time("$anyo-$mes-$dia"));
    $tdia = 1;
    //Si es festivo
    //echo "select * from t_calendario where tidi_cod=2 and expo_cod=1 and cale_dia = '$mes_anyo-$mes_cod-$j'";
    $result = mysql_query("select * from t_calendario where expo_cod=$expo and cale_dia = '$fecha'", $link);
    if (mysql_num_rows($result) == 1) {
        $row = mysql_fetch_object($result);
        $tdia = $row->tidi_cod;
    }
    //Analizar si es fin de semana
    if ($curday == 0 or $curday == 6) {
        $tdia = 2;
    }
    return $tdia;
}

function exse_excludes($fecha, $expo)
{
    include("conectar.php");
    //Buscarlo en el calendario
    $result = mysql_query("select * from t_calendario where expo_cod=$expo and cale_dia = '$fecha'", $link);
    if (mysql_num_rows($result) == 1) {
        $row = mysql_fetch_object($result);
        $retval = $row->cale_exse_exclude;
    } else {
        $retval = "";
    }
    return $retval;
}

function showasteric($dato)
{
    $retval = "";
    if ($dato == 1) {
        $retval = "*";
    }
    return $retval;
}

function getIP()
{
    $retval = $_SERVER[REMOTE_ADDR];
    return $retval;
}

function clearDNI($datdni)
{
    $retval = trim($datdni);
    $retval = strtoupper($retval);
    $retval = str_replace(" ", "", $retval);
    $retval = str_replace("-", "", $retval);
    return $retval;
}

function suma_dias_fecha($fecha, $ndias)
{
    //Sumar d�as a una fecha
    if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/", $fecha))
        list($ano, $mes, $dia) = split("/", $fecha);
    if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/", $fecha))
        list($ano, $mes, $dia) = split("-", $fecha);
    $nueva = mktime(0, 0, 0, $mes, $dia, $ano) + $ndias * 24 * 60 * 60;
    $nuevafecha = date("Y-m-d", $nueva);
    return ($nuevafecha);
}

/*
 * Es dato de tipo moneda, es la nuestra
 */
function _is_number($v)
{
    $v = str_replace(",", "", $v);
    $v = str_replace(" ", "", $v);
    return (is_float($v) || is_numeric($v));
}

function is_IBAN($iban)
{
    $iban = str_replace("-", "", $iban);
    $iban=trim($iban);
    $iban=strtoupper($iban);

    if(strlen($iban)!=24)
    {
        return false;
    }
    else
    {
        $letra1 = substr($iban, 0, 1);
        $letra2 = substr($iban, 1, 1);

        $num1 = numeroLetra($letra1);
        $num2 = numeroLetra($letra2);

        $final= substr($iban, 2, 2);

        $temp = substr($iban, 4, strlen($iban)).$num1.$num2.$final;

        if(bcmod($temp,97)==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

function numeroLetra($letra)
{

    $letras["A"]=10;
    $letras["B"]=11;
    $letras["C"]=12;
    $letras["D"]=13;
    $letras["E"]=14;
    $letras["F"]=15;
    $letras["G"]=16;
    $letras["H"]=17;
    $letras["I"]=18;
    $letras["J"]=19;
    $letras["K"]=20;
    $letras["L"]=21;
    $letras["M"]=22;
    $letras["N"]=23;
    $letras["O"]=24;
    $letras["P"]=25;
    $letras["Q"]=26;
    $letras["R"]=27;
    $letras["S"]=28;
    $letras["T"]=29;
    $letras["U"]=30;
    $letras["V"]=31;
    $letras["W"]=32;
    $letras["X"]=33;
    $letras["Y"]=34;
    $letras["Z"]=35;

    return($letras[$letra]);
}

function porciento($monto, $porciento) {
    return number_format(doubleval(($monto * $porciento) / 100), 2);
}

function is_CuentaCorriente($ccc) {
    //$ccc ser�a el 20770338793100254321
    $valido = true;

    if (!is_numeric($ccc))
        return false;
    if ($ccc == '00000000000000000000') {
        return false;
    }

    ///////////////////////////////////////////////////
    //    D�gito de control de la entidad y sucursal:
    //Se multiplica cada d�gito por su factor de peso
    ///////////////////////////////////////////////////
    $suma = 0;
    $suma += $ccc[0] * 4;
    $suma += $ccc[1] * 8;
    $suma += $ccc[2] * 5;
    $suma += $ccc[3] * 10;
    $suma += $ccc[4] * 9;
    $suma += $ccc[5] * 7;
    $suma += $ccc[6] * 3;
    $suma += $ccc[7] * 6;

    $division = floor($suma / 11);
    $resto = $suma - ($division * 11);
    $primer_digito_control = 11 - $resto;
    if ($primer_digito_control == 11)
        $primer_digito_control = 0;

    if ($primer_digito_control == 10)
        $primer_digito_control = 1;

    if ($primer_digito_control != $ccc[8])
        $valido = false;

    ///////////////////////////////////////////////////
    //            D�gito de control de la cuenta:
    ///////////////////////////////////////////////////
    $suma = 0;
    $suma += $ccc[10] * 1;
    $suma += $ccc[11] * 2;
    $suma += $ccc[12] * 4;
    $suma += $ccc[13] * 8;
    $suma += $ccc[14] * 5;
    $suma += $ccc[15] * 10;
    $suma += $ccc[16] * 9;
    $suma += $ccc[17] * 7;
    $suma += $ccc[18] * 3;
    $suma += $ccc[19] * 6;

    $division = floor($suma / 11);
    $resto = $suma - ($division * 11);
    $segundo_digito_control = 11 - $resto;

    if ($segundo_digito_control == 11)
        $segundo_digito_control = 0;
    if ($segundo_digito_control == 10)
        $segundo_digito_control = 1;

    if ($segundo_digito_control != $ccc[9])
        $valido = false;


    return $valido;
}

function valida_nif($IN_nif) {

    //Si es un DNI, CIF, NIF o NIE
    $retmes = 1; //Para saber si se ha validado o no.
    $cf = trim($IN_nif);
    $cf = strtoupper($cf);
    $cf = str_replace(" ", "", $cf);
    $cf = str_replace("-", "", $cf);
    $cf = str_replace(".", "", $cf);
    $cf = str_replace(",", "", $cf);

    for ($i = 0; $i < 9; $i++)
        $num[$i] = substr($cf, $i, 1);


    if (ereg('(^[0-9][A-Z]{1}$)', $cf)) {
        $cf = str_pad($cf, 8, '0', STR_PAD_LEFT);
    }

    //si es vacio devuelve error y si no entonces comprobamos si tiene un formato vï¿½lido
    if (strlen($cf) == 0) {
        return 0;
    } else
        if (!ereg('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)', $cf)) {
            return 0;
        }

    //comprobacion de NIFs estandar
    if (ereg('(^[0-9]{8}[A-Z]{1}$)', $cf))
        if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cf, 0, 8) % 23, 1))
            return 1;
        else {
            return -1;
        }

    //algoritmo para comprobacion de codigos tipo CIF
    $suma = $num[2] + $num[4] + $num[6];
    for ($i = 1; $i < 8; $i += 2)
        $suma += substr(2 * $num[$i], 0, 1) + substr(2 * $num[$i], 1, 1);
    $n = 10 - substr($suma, strlen($suma) - 1, 1);

    //comprobacion de NIFs especiales (se calculan como CIFs)
    if (ereg('^[KLM]{1}', $cf))
        if ($num[8] == chr(64 + $n))
            return 1;
        else {
            return -1;
        }


    //comprobacion de CIFs
    if (ereg('^[ABCDEFGHNPQRSV]{1}', $cf))
        if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1))
            return 2;
        else {
            return -2;
        }


    if (ereg('^[TXYZ]{1}', $cf))
        if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(ereg_replace('X', '0', $cf), 0, 8) % 23, 1) || ereg('^[T]{1}[A-Z0-9]{8}$', $cf) || ereg('^[Y]{1}[A-Z0-9]{8}$', $cf) || ereg('^[Z]{1}[A-Z0-9]{8}$', $cf))
            //if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(ereg_replace('^[XYZ]', '0', $cf), 0, 8) % 23, 1) || ereg('^[T]{1}[A-Z0-9]{8}$', $cf))
            return 3;
        else {
            return -3;
        }


    return 0;
}
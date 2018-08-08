<?php
include_once(file_path.'lib/secureAPI.php');

$ahora = new DateTime("now");
//$ahora = new DateTime("2016-09-23 22:48:10");
$h1hora = new DateTime("now");
//$h1hora = new DateTime("2016-09-23 22:48:10");
$h1hora =  date_sub($h1hora, new DateInterval('PT1H'));

$h6hora = new DateTime("now");
//$h6hora = new DateTime("2016-09-23 22:48:10");
$h6hora =  date_sub($h6hora, new DateInterval('PT6H'));

$cdr1 = new \CompayPhone\billing(0, $dbBilling);
//Las contestadas
$h1DataAns = $cdr1->getStatusTrunks(get_datetime_from_object($h1hora), get_datetime_from_object($ahora));

$table1h = new html_table('tableh1', $h1DataAns, '', '');

$table1h->add_column('destination', 'Destino', '{destination}');
$table1h->add_column('trunkcode', 'Trunk', '{trunkcode}');
$table1h->add_column('minutos', 'Minutos', '{TIEMPOSegundos}', '', 'showMinutos');
$table1h->add_column('totalCalls', 'Recibidas', '{totalCalls}');
$table1h->add_column('answeredCalls', 'Contestadas', '{answeredCalls}');
$table1h->add_column('ars', 'ASR', '{totalCalls},{answeredCalls}', '', 'showASR');
$table1h->add_column('acd', 'ACD', '{TIEMPOSegundos},{answeredCalls}', '', 'showACD');

$h6DataAns = $cdr1->getStatusTrunks(get_datetime_from_object($h6hora), get_datetime_from_object($ahora));

$table6h = new html_table('tableh6', $h6DataAns, '', '');

$table6h->add_column('destination', 'Destino', '{destination}');
$table6h->add_column('trunkcode', 'Trunk', '{trunkcode}');
$table6h->add_column('minutos', 'Minutos', '{TIEMPOSegundos}', '', 'showMinutos');
$table6h->add_column('totalCalls', 'Recibidas', '{totalCalls}');
$table6h->add_column('answeredCalls', 'Contestadas', '{answeredCalls}');
$table6h->add_column('ars', 'ASR', '{totalCalls},{answeredCalls}', '', 'showASR');
$table6h->add_column('acd', 'ACD', '{TIEMPOSegundos},{answeredCalls}', '', 'showACD');

$h0hora = $h6hora;
$h0DataAns = $cdr1->getStatusTrunks($h0hora->format('Y-m-d 00:00'), $h0hora->format('Y-m-d 23:59'));

$table0h = new html_table('tableh0', $h0DataAns, '', '800px');

$table0h->add_column('destination', 'Destino', '{destination}');
$table0h->add_column('trunkcode', 'Trunk', '{trunkcode}');
$table0h->add_column('minutos', 'Minutos', '{TIEMPOSegundos}', '', 'showMinutos');
$table0h->add_column('totalCalls', 'Recibidas', '{totalCalls}');
$table0h->add_column('answeredCalls', 'Contestadas', '{answeredCalls}');
$table0h->add_column('ars', 'ASR', '{totalCalls},{answeredCalls}', '', 'showASR');
$table0h->add_column('acd', 'ACD', '{TIEMPOSegundos},{answeredCalls}', '', 'showACD');


$saldoTeleco3 = file_get_contents("http://188.165.236.165/billing/api/simple_balance/6xb92hm50b");


/*

Cuba 🇨🇺 6
Marroc 3,3
Pero en general 5 es un umbral bueno
En el ASR el 60%
La curva del ASR 30% limite 60 Google por encima del 80% peligroso
ACD por debajo de 2 rojo para todo

---Lapsos de tiempo----
Hora = Ultima Hora
Hace dos horas
Hace 6 horas
Ayer
Semana


ASR es el % de llamadas contestadas con respecto a las llamadas enviadas
ACD es la media de minutos hablado de las llamadas contestadas
Y SCC % de llamadas de más de 30 segundos
Con eso por destino

** Mostrar los minutos disponibles en troncalCuba

*/
<?php
include_once(file_path.'lib/secureAPI.php');
$view = 'json';
$response = array ();

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata);

if (!is_null($data->{"account_id"})) {

    $usuario = new \CompayPhone\usuario();
    $usuario->loadById(pget('account_id'));

    $_SESSION['usu_logged'] = $usuario;

    //echo 'A Pagar';
    redirect(path('pasarelaCM'));

}
die(0);
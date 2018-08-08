<?php
include_once(file_path.'lib/secureAPI.php');
$view = 'json';
$response = array ();

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata);

$response = 'No have cookie :-(';

if (pget('card2query')) {

    $card_info = $db->queryFirstRow("SELECT * FROM cc_card WHERE username=%s", pget('card2query'));

    $pdte_refacturar = $am->queryOneField('pendiente', 'select sum(billingsessionbill) pendiente from datosrefacturacion
                    where billingclientcardid = %s and refacturada = %s', $card_info['id'], 'no');

    $response = array (
        'credit' => number_format($card_info['credit'] + $pdte_refacturar, 2),
        'currency' => $card_info['currency']
    );

}

echo serialize($response);

die(0);


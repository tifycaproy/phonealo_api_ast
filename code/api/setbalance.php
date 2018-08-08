<?php
include_once(file_path.'lib/secureAPI.php');
$view = 'json';
$response = array ();

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata);

$response = 'No have cookie :-(';

if (strlen($data->{card2query}) > 0) {

    $card2query = $data->{card2query};
    $amount = $data->{amount};
    $payid = $data->{payid};

    $card_info = $db->queryFirstRow("SELECT * FROM cc_card WHERE username=%s", $card2query);

    $db->insert('cc_logrefill', array (
        'credit' => $amount,
        'card_id' => $card_info['id'],
        'description' => 'Pago desde web ID: '.$payid,
    ));
    $idrefill = $db->insertId();

    $db->insert('cc_logpayment', array (
        'payment' => $amount,
        'card_id' => $card_info['id'],
        'id_logrefill' => $idrefill,
        'description' => 'Pago desde web ID: '.$payid,
        'added_refill' => 1
    ));
    $billingpayid = $db->insertId();

    $final_credit = floatval($card_info['credit']) + floatval($amount);
    $db->update('cc_card', array ('credit' => $final_credit) , 'id = %s', $card_info['id']);

    $card_info = $db->queryFirstRow("SELECT * FROM cc_card WHERE username=%s", $card2query);
    $response = array (
        'credit' => number_format($card_info['credit'],2),
        'currency' => $card_info['currency'],
        'billingrefillid' => $idrefill,
        'billingpayid' => $billingpayid
    );

}

echo json_encode($response);

die(0);


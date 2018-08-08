<?php
include_once(file_path.'lib/secureAPI.php');
$view = 'json';
$response = array ();

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata);

$response = 'No have cookie :-(';

if (pget('card2query')) {

    $card_info = $db->queryFirstRow("SELECT * FROM cc_card WHERE username=%s", pget('card2query'));

    if (count($card_info) == 0 ) {
        $response = array (
            'calls' => 0
        );
    } else {

        $res_calls = $db->query('
            select * from cc_call a, cc_card b
                where a.card_id = b.id and b.id like %s order by a.id desc limit 100', $card_info['id']);

        $acalls = array ();
        foreach ($res_calls as $call) {
            $acalls[] = array (
                'starttime' => $call['starttime'],
                'calledstation' => $call['calledstation'],
                'sessionbill' => round($call['sessionbill'], 2),
                'sessiontime' => str_replace('.', ':', round($call['sessiontime'] / 60, 2))
            );

        }

        $response = array (
            'calls' => $acalls
        );

    }


}

echo serialize($response);

die(0);


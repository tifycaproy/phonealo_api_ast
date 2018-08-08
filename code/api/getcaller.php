<?php
include_once(file_path.'lib/secureAPI.php');
$view = 'json';
$response = array ();

$jsondata = file_get_contents('php://input');
$data = json_decode($jsondata);

if (pget('prefix')) {

    $server = new \CompayPhone\serversip(0, $db);
    $ccard_id = $server->getFreeCallerID(pget('group'));

    if (count($ccard_id) > 0) {

        $db->update('cc_card', array (
            'lastname' => pget('lastname')
        ),
            "id = %s",  $ccard_id['id']
        );
        $db->insertUpdate('cc_callerid', array (
            'cid' => pget('prefix').pget('mobile'),
            'id_cc_card' => $ccard_id['id']
        ), array (
            'cid' => pget('prefix').pget('mobile'),
            'id_cc_card' => $ccard_id['id']
        ));
        $tmpPass = strrev($ccard_id['username']);
        $db->update('cc_sip_buddies', array (
                'name' => $ccard_id['username'],
                'defaultuser' => $ccard_id['username'],
                'context' => 'call53',
                'type' => 'friend',
                'host' => 'dynamic',
                'nat' => 'comedia',
                'secret' => substr($tmpPass, 1, 5),
                'disallow' => 'all',
                'allow' => 'g729,alaw,ulaw',
                'qualify' => 'no',
                'callerid' => pget('prefix').pget('mobile')
            ), "id_cc_card = %s",  $ccard_id['id']
        );

        $response = array (
            'result' => 'ok',
            'data' => $ccard_id
        );

    } else {
        $response = array (
            'result' => 'ko'
        );
    }

}

echo json_encode($response);

die(0);


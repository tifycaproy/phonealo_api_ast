<?php

$sips = array (
    '6253623773' ,
    '4312475567' ,
    '9878374755' ,
    '6561999133' ,
    '4253243455'
);

$response['account'] = array (
    'id' => $sips[rand(0, 4)]
);


foreach ($sips as $id => $pin) {

    echo $id.' '.substr(strrev($id), 1, 5).'<br>';

}


echo substr(strrev('0034666777698'), 1, 5);


die('003466677780'.rand(1, 3));

$amount = '1235';
$order = '29292929';
$code = '201920191';
$currency = '978';
$secret = 'h2u282kMks01923kmqpo';

$digest = $amount.$order.$code.$currency.$secret;

$digest = sha1($digest);

die($digest);
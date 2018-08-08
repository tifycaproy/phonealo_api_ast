<?php
$notAccess = true;
if ($aq[2] == APIKEY ) {
    $notAccess = false;
}
$jsondata = file_get_contents('php://input');

$requestJSONPOST = json_decode(rtrim($jsondata, '\0'));
//$requestJSONPOST = json_decode($jsondata);

if (!is_null($requestJSONPOST->{"APIKEY"})) {
    $notAccess = false;
}

if (!is_null($requestJSONPOST->{APIKEY})) {
    $notAccess = false;
}

if (pget('APIKEY') == APIKEY && $notAccess) {
    $notAccess = false;
}

if (ppost('APIKEY') == APIKEY && $notAccess) {
    $notAccess = false;
}

if ($notAccess) {
    header('HTTP/1.0 403 Forbidden');
    echo '<h2>No access :-/</h2>';
    die(0);
} else {
    $_SESSION['have_access'] = true;
}

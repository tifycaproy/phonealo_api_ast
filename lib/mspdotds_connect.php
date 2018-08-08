<?php
global $dbh;

try {
    $db_usr = 'monteoro';
    $db_pass = 'monte%19';
    $db_server = 'fcm-erpsql01';
    $db_name = 'MONTEORO-PRE';
    $db_port = '1433';

    //$dbh = new PDO ("dblib:host=$db_server:$db_port;dbname=$db_name","$db_usr","$db_pass");
    $dbh = new PDO ("dblib:host=$db_server;dbname=$db_name","$db_usr","$db_pass");
} catch (PDOException $e) {
    echo "Imposible conectar: " . $e->getMessage() . "\n";
    exit;
}
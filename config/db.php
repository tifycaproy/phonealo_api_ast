<?php
global $db;

$db_hostname = "************";
$db_database = "************";
$db_username = "*********";
$db_password = "*******";

$db = new MeekroDB($db_hostname, $db_username, $db_password, $db_database);

$am_hostname = "*********";
$am_database = "amundocuba";
$am_username = "*********";
$am_password = "********";

$am = new MeekroDB($am_hostname, $am_username, $am_password, $am_database);


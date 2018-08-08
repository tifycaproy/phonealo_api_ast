<?php
$db = mysql_connect($db_hostname, $db_username, $db_password) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($db_database, $db) or die(mysql_error());
mysql_query("SET CHARSET 'utf8'");
<?
	$conn = ociLogon($db_username,$db_password, $db_database, 'AL32UTF8') or die("Error, no se puede seleccionar la BD");	
	//$conn = oci_connect($db_username, $db_password, $db_database) or die("Error, no se puede seleccionar la BD");	
?>
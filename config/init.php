<?php
/**
 * Aqui va todo el meollo
 * User: alx
 * Date: 07/03/15
 * Time: 12:14
 */
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

define('rewrite_url', false);
define('APIKEY', '**********************');

$langs = array (
    'es', 'en'
);

define('i18n_base', 'es');

define('base_path', 'http://prod.phonealo.net/c53api/');
define('file_path', '/var/www/html/c53api/');
//define('sipconf_file', '/Users/alx/Documents/httpdocs/call53front/files/sip.conf');

include_once(file_path."config/route.php");

require_once(file_path."lib/meekrodb.2.3.class.php");
include_once(file_path."config/db.php");

include_once(file_path."lib/mailer/class.phpmailer.php");
include_once(file_path.'lib/lib.php');
include_once(file_path.'lib/utils.php');
include_once(file_path.'lib/formprocess.php');
include_once(file_path.'lib/functions.php');
include_once(file_path.'lib/htmloutput.php');
include_once(file_path.'lib/html_output.php');
//include_once(file_path.'lib/i18n.php');

include_once(file_path.'clases/functions_cpadmin.php');

include_once(file_path.'clases/base.php');
include_once(file_path.'clases/utils.php');
include_once(file_path.'clases/usuario.php');
include_once(file_path.'clases/extension.php');
include_once(file_path.'clases/serversip.php');
include_once(file_path.'clases/tarifas.php');
include_once(file_path.'clases/billing.php');
//include_once(file_path.'clases/producto.php');
//include_once(file_path.'clases/pedido.php');
//include_once(file_path.'clases/email.php');
//include_once(file_path.'clases/doc.php');
//include_once(file_path.'clases/comision.php');
//include_once(file_path.'clases/vk_functions.php');

$util = new \CompayPhone\utils();


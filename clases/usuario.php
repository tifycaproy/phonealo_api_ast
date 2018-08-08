<?php

/**
 * Created by PhpStorm.
 * User: alx
 * Date: 21/03/15
 * Time: 12:01
 */

namespace CompayPhone;

class usuario extends base {

    function __construct($usu_cod = 0, $db = null) {

        parent::__construct($usu_cod, $db);
        $this->table_name = 'usuario';
        $this->name_cod = 'usu_cod';
        $this->cod = $usu_cod;
    }


    function full_name() {
        return $this->usu_cod . ' - ' . $this->usu_nombre . ' ' . $this->usu_apellidos;
    }


    /**
     * Devolveremos el saldo del cliente
     */
    function getBalance() {
        global $dbBilling;
        $dr = $dbBilling->queryFirstRow("select a.* from cc_card a
                where a.id = %s
                order by a.id limit 1", $this->data['usu_billing_cardid']);
        $result = array (
            'credit' => $dr['credit'],
            'currency' => $dr['currency']
        );
        return $result;

    }

    /*
     * Aplicamos saldo
     */
    function impute_saldo($importe, $pedi) {

    }

    /*
     * Genera el pin de acceso del usuario
     */
    function setPIN() {
        $pin = rand(1000, 9990);
        $this->data['usu_key'] = $pin;
    }

    function setServer($srv_cod = null) {
        $this->data['usu_srv_cod'] = (is_null($srv_cod))?2:$srv_cod;
    }

    function getExtension() {
        $ext_cod = $this->db->queryOneField('ext_cod', "SELECT * FROM extensions WHERE ext_usu_cod=%s", $this->cod);
        $ext = new extension($ext_cod);
        $ext->load();
        return $ext;
    }

    /*
     * Genera la extensión SIP
     */
    function genExtension() {
        /**
         * LO INCLUIMOS EN EL BILLING
         */
        global $dbBilling;
        $rowcallid = $dbBilling->queryFirstRow("select * from cc_callerid where id_cc_card = %s", $this->data['usu_billing_cardid']);
        if (count($rowcallid) == 0) {
            $dbBilling->insert(
                'cc_callerid', array (
                    'cid' => $this->data['usu_billing_cardusername'],
                    'id_cc_card' => $this->data['usu_billing_cardid'],
                    'activated' => 't'
                )
            );
            /**
             * LO CREAMOS EN EL FICHERO SIP.CONF
             */
            $template = file_get_contents(file_path.'sip_generated/appsip.tpl');
            $this->data['usu_sippass'] = $this->getSipPass();
            $sipBody = parseTemplate($template, $this->data, '{}');
            file_put_contents(sipconf_file, $sipBody, FILE_APPEND);
            exec('asterisk -rx "sip reload"');
        }
    }

    function getSipPass() {
        $tmpPass = strrev($this->data['usu_billing_cardusername']);
        return substr($tmpPass, 1, 5);
    }

    function loadById($id) {
        $usu_cod = $this->db->queryOneField('usu_cod',
                "SELECT * FROM usuario WHERE concat(usu_country_prefix, usu_mobile) =%s", $id);

        if ($usu_cod) {
            $this->cod = $usu_cod;
            $this->load();
        }

    }

    function loadByMobilePrefix($mobile, $prefix) {
        $usu_cod = $this->db->queryOneField('usu_cod',
            "SELECT * FROM usuario WHERE concat(usu_country_prefix, usu_mobile) =%s", $prefix.$mobile);

        if (strlen($usu_cod) > 0) {
            $this->cod = $usu_cod;
            $this->load();
        }

    }

}



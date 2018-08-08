<?php

/**
 * Created by PhpStorm.
 * User: alx
 * Date: 21/03/15
 * Time: 12:01
 */

namespace CompayPhone;

class extension extends base {

    var $server;

    function __construct($ext_cod = 0, $db = null) {

        parent::__construct($ext_cod, $db);
        $this->table_name = 'extensions';
        $this->name_cod = 'ext_cod';
        $this->cod = $ext_cod;
    }

    function load() {
        parent::load();
        $this->server = new serversip($this->data['ext_srv_cod']);
        $this->server->load();
    }

    /**
     * Devolveremos el saldo del cliente
     */
    function get_saldo() {

    }

    /*
     * Aqui creamos la extension en el servidor con el pin que le corresponde
     */
    function createInServer() {

    }

    function loadFromUser() {

    }

}


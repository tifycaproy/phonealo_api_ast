<?php

/**
 * Created by PhpStorm.
 * User: alx
 * Date: 21/03/15
 * Time: 12:01
 */

namespace CompayPhone;

class serversip extends base {

    function __construct($_cod = 0, $db = null) {

        parent::__construct($_cod, $db);
        $this->table_name = '';
        $this->name_cod = '';
        $this->cod = $_cod;
    }

    /*
     * Aqui creamos la extension en el servidor con el pin que le corresponde
     */
    function createInServer() {

    }

    function getFreeCallerID($group) {

        $dr = $this->db->queryFirstRow("select a.* from cc_card a
                where a.id_group = %s and a.id not in (select id_cc_card from cc_callerid b)
                order by a.id limit 1", $group);
        return $dr;

    }

}


<?php

/**
 * Created by PhpStorm.
 * User: alx
 * Date: 21/03/15
 * Time: 12:01
 */

namespace CompayPhone;

class tarifas extends base {

    function __construct($tar_cod = 0, $db = null) {

        parent::__construct($tar_cod, $db);
        $this->table_name = 'tarifas';
        $this->name_cod = 'tar_cod';
        $this->cod = $tar_cod;
    }

    function getAll() {

        $data = $this->db->query('select * from '.$this->table_name);

        return $data;

    }

}


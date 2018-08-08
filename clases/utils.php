<?php
/**
 * Created by PhpStorm.
 * User: alx
 * Date: 27/9/16
 * Time: 17:28
 */

namespace CompayPhone;


class utils extends base {

    function __construct($cod = 0, $db = null) {
        parent::__construct($cod, $db);
    }

    function getPaises() {
        global $db;
        $paises = $db->query("select pais_country_prefix, pais_desc from paises where pais_active = 1");
        $ret = array ();
        foreach ($paises as $value) {
            $ret[] = array (
                'country_prefix' => $value['pais_country_prefix'],
                'country_name' => utf8_encode($value['pais_desc'])
            );
        }
        return $ret;
    }

}


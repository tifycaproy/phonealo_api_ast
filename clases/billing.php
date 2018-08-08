<?php

/**
 * Created by PhpStorm.
 * User: alx
 * Date: 21/03/15
 * Time: 12:01
 */

namespace CompayPhone;

class billing extends base {

    function __construct($_cod = 0, $db = null) {

        parent::__construct($_cod, $db);
        $this->table_name = '';
        $this->name_cod = '';
        $this->cod = $_cod;
    }

    function getStatusTrunks($startDate, $endDate, $filters =  null) {

        $strQuery = "
            select c.destination, trunkcode,
              sum((timestampdiff(SECOND, starttime, stoptime))) TIEMPOSegundos,
              sec_to_time(sum(timestampdiff(SECOND, starttime, stoptime))) TIEMPOMinuto, terminatecauseid,
              count(id) totalCalls, sum(if(terminatecauseid = 1, 1, 0)) answeredCalls
                from cc_call a, cc_trunk b, cc_prefix c
                where a.id_trunk = b.id_trunk and a.destination = c.prefix and starttime > '$startDate' and starttime <= '$endDate'
                    $filters
                group by destination, trunkcode
        ";
        return $this->db->query($strQuery);
    }



    function getExtension() {
        $ext_cod = $this->db->queryOneField('ext_cod', "SELECT * FROM extensions WHERE ext_usu_cod=%s", $this->cod);
        $ext = new extension($ext_cod);
        $ext->load();
        return $ext;
    }

    function loadById($id) {

        $usu_cod = $this->db->queryOneField('usu_cod',
                "SELECT * FROM usuario WHERE concat(usu_country_prefix, usu_mobile) =%s", $id);

        if ($usu_cod) {
            $this->cod = $usu_cod;
            $this->load();
        }

    }

}



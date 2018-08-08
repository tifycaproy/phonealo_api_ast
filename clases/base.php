<?php
namespace CompayPhone;

class base {

    var $data = array ();
    var $table_name = '';
    var $name_cod = '';
    var $cod = 0;

    var $db = null;

    function __construct($_cod, $dbs = null) {

        global $db;
        if (is_null($dbs)) {
            $this->db = $db;
        } else {
            $this->db = $dbs;
        }

    }

    function set_data ($data) {
        $this->data = $data;
    }

    /**
     * Funcion de guardado..
     */
    function save() {
        //Quitamos lo que viene vacío

        if ($this->cod == 0 || strlen($this->cod) == 0) {
            $this->data[$this->name_cod] = 0;
            $this->db->insert($this->table_name, $this->data);
            $this->cod = $this->db->insertId();
            $this->data[$this->name_cod] = $this->cod;
        } else {
            $this->db->insertUpdate($this->table_name, $this->data);
        }
        /*
        $this->cod = $this->db->insertUpdate($this->table_name, $this->data);
        $this->data[$this->name_cod] = $this->cod;
        */

        /*

        if (isset($this->cod) && $this->cod != 0) {
            if (isset($this->data[$this->name_cod]))
                unset($this->data[$this->name_cod]);
            //db_update($this->table_name, $this->data, array($this->name_cod => $this->cod));
            $this->db->update($this->table_name, $this->data, $this->name_cod."=%s", $this->cod);
        } else {
            //$this->cod = db_insert($this->table_name, $this->data);
            $this->cod = $this->db->insert($this->table_name, $this->data);
            $this->name_cod = $this->cod;
        }
        */
        return $this->cod;
    }

    function describe() {
        $res = $this->db->query('describe '.$this->table_name);
        $ret = array ();
        foreach ($res as $field) {
            $ret[$field['Field']] = $field['Type'];
        }
        return $ret;
    }

    function load() {

        if ($this->cod == 0) {
            $fields = $this->describe();
            foreach ($fields as $field => $type) {
                $this->data[$field] = null;
            }
            $this->data[$this->name_cod] = 0;
        } else {
            $query = sprintf("select * from %s where %s=%s", $this->table_name, $this->name_cod, $this->cod);
            $this->data = $this->db->queryFirstRow($query);
        }

    }

} 
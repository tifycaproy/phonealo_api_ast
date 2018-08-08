<?php
/**
 * Esta primera versi�n no procesa datos de files
 * Simplemente procesa lo recibido en un form y lo envia a la tabla o tablas indicadas...
 *
 */
class pForm {

    var $form_data = array();
    var $form_files = array();
    var $form_id = array();
    var $campo_id;
    var $status;
    var $table_name;
    var $list_error_validation;

    function __construct($data, $field_link = 'f_', $files = '', $more_data = '') {

        //Determinamos la pk del form que se env�a
        foreach ($data as $campo => $valor) {
            if (preg_match("/^$field_link/", $campo)) {//Si empieza por f_ es un campo del formulario
                //Compruebo si cod esta vacio, se inserta o con datos modifica..
                if (preg_match("/_pk$/", $campo)) {
                    $campo = substr($campo, 0, -3);
                    $this->campo_id = substr($campo, 2);
                    $this->form_id[$this->campo_id] = (empty($valor) || $valor == 0) ? 0 : $valor;
                } else {
                    //Fin si (ereg("cod$",...
                    if (preg_match("/(0?[1-9]|[12][0-9]|3[01])-(0?[1-9]|1[012])-(20[0-9]{2})/", $valor))
                        $valor = cambiaf_a_mysql($valor); //Si tiene formato fecha se pone en forma MYSQL					
                    if (preg_match("/_file_path$/", $campo)) {
                        $destino_archivo = $valor;
                    } else {
                        /*
                          $campos = $campos.substr($campo,2).",";//Se quita la parte"f_" de los campos.
                          $valores = $valores."'".$valor."',";//Pillamos los valores
                         */
                        $campo_nombre = substr($campo, 2);
                        $this->form_data[$campo_nombre] = $valor;
                    }
                }
            }//Fin si (ereeg("^f_"..
        }//Fin foreach...
    }

    function proccess2table($table_name) {
        $this->table_name = $table_name;

        if ($this->form_id[$this->campo_id] == 0) {
            $this->form_id[$this->campo_id] = db_insert($table_name, $this->form_data);
        } else {
            db_update($table_name, $this->form_data, $this->form_id);
        }

        return array($this->campo_id, $this->form_id[$this->campo_id]);
    }

    function getData($table_name = '', $where = '') {
        $table_name = ($table_name == '') ? $this->table_name : $table_name;
        $result = db_direct_query($table_name, $this->form_id);
        return db_fetch($result);
    }

    /**
     * Valida los campos que se pasen como parametro, estos ya no tienen f_
     * 
     * @param unknown_type $field_id
     * @param (req: obligatorio, email: correo, cif: Cif, Nie o DNI, Expr: valida la expresion del param siguiente, Si se pone una expresi�n la valida) $type_validation
     * @param string $expr Expresi�n a validar cdo se pasa el parametro 'expr' en type_validation
     * @param unknown_type $err_msg
     */
    function validate_field($field_id, $type_validation, $expr = '', $err_msg) {

        $value_field = $this->form_data[$field_id];

        switch (strtolower($type_validation)) {
            case 'req':
                if (!$this->validate_req($value_field) && !in_array($field_id, $this->list_error_validation)) {
                    $this->list_error_validation[$field_id] = $err_msg;
                }
                break;
            case 'expr':
                if (!$this->validate_expr($expr) && !in_array($field_id, $this->list_error_validation)) {
                    $this->list_error_validation[$field_id] = $err_msg;
                }
                break;
            case 'email':
                if (!$this->validate_email($value_field) && !in_array($field_id, $this->list_error_validation)) {
                    $this->list_error_validation[$field_id] = $err_msg;
                }
                break;

            case 'cif':
                if (!$this->validate_cif($value_field) && !in_array($field_id, $this->list_error_validation)) {
                    $this->list_error_validation[$field_id] = $err_msg;
                }
                break;
            default:
                if (!($type_validation) && !in_array($field_id, $this->list_error_validation)) {
                    $this->list_error_validation[$field_id] = $err_msg;
                }
                break;
        }
    }

    function validate_req($value) {
        $value_correcto = (strlen($value) > 0) ? true : false;
        return $value_correcto;
    }

    function validate_expr($expr) {
        $expr_correcta = eval($expr);
        return $expr_correcta;
    }

    function validate_email($value) {
        $mail_correcto = false;
        if ((strlen($email) >= 6) && (substr_count($email, "@") == 1) && (substr($email, 0, 1) != "@") && (substr($email, strlen($email) - 1, 1) != "@")) {
            if ((!strstr($email, "'")) && (!strstr($email, "\"")) && (!strstr($email, "\\")) && (!strstr($email, "\$")) && (!strstr($email, " "))) {
                //miro si tiene caracter . 
                if (substr_count($email, ".") >= 1) {
                    //obtengo la terminacion del dominio 
                    $term_dom = substr(strrchr($email, '.'), 1);
                    //compruebo que la terminaci�n del dominio sea correcta 
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, "@"))) {
                        //compruebo que lo de antes del dominio sea correcto 
                        $antes_dom = substr($email, 0, strlen($email) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                        if ($caracter_ult != "@" && $caracter_ult != ".") {
                            $mail_correcto = true;
                        }
                    }
                }
            }
        }
        return $mail_correcto;
    }

    function validate_cif($value, $err_msg) {
        $cif_correcto = true;
        return $cif_correcto;
    }

}

class pFormOCI extends pForm {

    function proccess2table($table_name) {
        $this->table_name = $table_name;

        //Saber si se inserta y actualizar
        $acc = 'upd';
        foreach ($this->form_id as $idx => $value) {
            if ($value == 0) {
                $this->form_data[$idx] = db_sig_id($table_name, $idx);
                $this->form_id[$idx] = $this->form_data[$idx];
                $acc = 'ins';
            }
        }

        if ($acc == 'ins') {
            db_insert($table_name, $this->form_data);
        } else {
            db_update($table_name, $this->form_data, $this->form_id);
        }

        return array($this->campo_id, $this->form_id[$this->campo_id]);
    }

    function full_data() {
        return array_merge($this->form_id, $this->form_data);
    }

}

class pFormMS extends pForm {

    function proccess2table($table_name) {
        $this->table_name = $table_name;

        if ($this->form_id[$this->campo_id] == 0) {
            $this->form_id[$this->campo_id] = db_insert($table_name, $this->form_data);
            $this->form_data[$this->campo_id] = $this->form_id[$this->campo_id];
        } else {
            db_update($table_name, $this->form_data, $this->form_id);
        }

        return array($this->campo_id, $this->form_id[$this->campo_id]);

    }

    function full_data() {
        return array_merge($this->form_id, $this->form_data);
    }

}

?>
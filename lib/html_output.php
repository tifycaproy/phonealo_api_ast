<?php

/*
  Genera un select con informaci�n de una tabla o lista que se le pase
 */

function dropdownGeneric($name, $options, $selected = false, $attributes = '', $only_options = false) {
    $output = "";
    foreach ($options as $key => $text) {
        $output .= "<option value=\"$key\"" . ((($selected !== false) && ($selected == $key)) ? " selected" : "") . ">$text</option>";
    }

    // esto de only options es util por si queremos sacar el trozo de html con una llamada asincronica (AJAX)
    if (!$only_options) {
        $output = "<select name=\"$name\"  id=\"$name\" $attributes>$output</select>";
    }

    return $output;
}

/**
 * Imprime un dropdown con un Si/NO
 *
 * @param unknown_type $name
 * @param unknown_type $selected
 * @param unknown_type $attributes
 */
function dropdown_SINO($name, $selected, $attributes = '') {
    $a_options = array('S' => 'SI', 'N' => 'No');
    return dropdownGeneric($name, $a_options, $selected, $attributes);
}

/**
 * Devuelve un select con numeros desde from hasta to
 *
 * @param $name
 * @param $selected
 * @param $from
 * @param $to
 * @return unknown
 */
function dropdownNumeric($name, $selected, $from, $to) {
    $a_numbers = array();
    for ($i = $from; $i <= $to; $i++) {
        $a_numbers[$i] = $i;
    }
    return dropdownGeneric($name, $a_numbers, $selected);
}

function dropdownPages($name, $selected, $npages) {
    $a_pages = array();
    for ($i = 1; $i <= $npages; $i++) {
        $a_pages[$i] = $i;
    }
    return dropdownGeneric($name, $a_pages, $selected);
}

function html_output_get_opciones($a_opciones) {
    $str_opciones = '';
    if (is_array($a_opciones)) {
        foreach ($a_opciones as $key => $value) {
            $str_opciones .= sprintf('%s="%s" ', $key, $value);
        }
    } else
        $str_opciones = $a_opciones;
    return $str_opciones;
}

function print_link($url_target, $url_label = '', $a_opciones = '') {

    $str_opciones = html_output_get_opciones($a_opciones);

    $url_label = ($url_label == '') ? $url_target : $url_label;

    $str_link = '<a href="%s" %s >%s</a>';
    return sprintf($str_link, $url_target, $str_opciones, $url_label);
}

/**
 * Devuelve HTML de imagen
 *
 * @param $img_target Archivo Origen
 * @param unknown_type $img_alt
 * @param unknown_type $a_opciones
 * @return unknown
 */
function print_img($img_target, $img_alt = '', $a_opciones = '') {

    $str_opciones = html_output_get_opciones($a_opciones);

    $str_img = '<img src="%s" %s alt="%s" align="top">';

    return sprintf($str_img, $img_target, $str_opciones, strip_tags($img_alt));
}

//Print image_link
/**
 * Imprime un link con una imagen
 * @param $url_target
 * @param $img_target
 * @param $text_link
 * @param $a_opciones
 */
function print_imglink($url_target, $img_target, $text_link = '', $a_opciones = '') {

    $str_opciones = html_output_get_opciones($a_opciones);

    $img_string = print_img($img_target, $text_link, array("border" => "0", "align" => "absmiddle"));

    $str_link = '<a href="%s" %s >%s%s</a>';
    return sprintf($str_link, $url_target, $str_opciones, $img_string, $text_link);
}

/**
 * Imprime un link con una imagen y el text_link es el alt de la imagen
 * @param unknown_type $url_target
 * @param unknown_type $img_target
 * @param unknown_type $text_link
 * @param unknown_type $a_opciones
 */
function print_imglinkI($url_target, $img_target, $text_link = '', $a_opciones = '') {

    $str_opciones = html_output_get_opciones($a_opciones);

    $img_string = print_img($img_target, $text_link, array("border" => "0", "align" => "absmiddle"));

    $str_link = '<a href="%s" title="%s" %s>%s</a>';
    return sprintf($str_link, $url_target, $text_link, $str_opciones, $img_string);
}

function div_imglink($name, $url_target, $img_target, $text_link = '', $a_opciones = '') {
    $str_opciones = html_output_get_opciones($a_opciones);

    $link_string = print_imglink($url_target, $img_target, $text_link);

    $str_div = '<div id="%s" %s>%s</div>';
    return sprintf($str_div, $name, $str_opciones, $link_string);
}

/**
 * Devuelve el HTML de un div
 * @param unknown_type $name : Nombre del div
 * @param unknown_type $content : Contenido HTML
 * @param unknown_type $opptions : Opciones HTML
 */
function print_div($name, $content = '', $options = '') {
    $str_div = '<div id="%s" %s>%s</ul>';
    return sprintf($str_div, $name, $options, $content);
}

/**
 * Hace una lista html con el array pasado como parametro
 *
 * @param str $arra
 * @return str $result
 */
function print_list($arr_msg, $name = '', $options_ul = '' ) {
    $strid = ($name != '') ? 'id = "' . $name . '"' : '';
    $str_list = "<ul $options_ul $strid >%s</ul>";
    $str_li = "";
//    print_r($arr_msg);
    foreach ($arr_msg as $id => $value) {
        $str_li .= "<li>$value</li>";
    }
    return sprintf($str_list, $str_li);
}


function dropd_sexo($sexo_cod, $tabindex = '') {

    $options = array(
        '0' => 'Hombre',
        '1' => 'Mujer'
    );

    return dropdown('f_clie_sexo', $options, $sexo_cod, 'class = "form-control" '.$tabindex);
}

/**
 * Definimos una clase para construir una tabla
 */
class html_table {
    /* Esta clase imprime una tabla html con contenidos de una consulta ejemplo de utilizacion

      $result = db_query($consulta);
      $tabla_resultados = new html_table("resultados", $result);
      $tabla_resultados->add_column("selector", "Seleccione", '<input name="P_{MLDE_COD}" type="checkbox" value="" />');
      $tabla_resultados->add_column("nombre", "Nombre", "{MLDE_NOMBRE}");
      $tabla_resultados->add_column("apellidos", "Apellidos", "{MLDE_APELLIDOS}");
      $tabla_resultados->add_column("entidad", "Entidad", "{MLDE_ENTIDAD}");
      $tabla_resultados->add_column("departamento", "Departamento", "index.php?mlde={MLDE_COD},{MLDE_NOMBRE}",'',"print_link");


     */

    var $row_id = '';
    var $table_id = '';
    var $table_options = '';
    var $data = array();
    var $def_columnas = array();
    var $options_columnas = array();
    var $tags_columnas = array();
    var $def_celdas = array();
    var $def_callback = array();
    var $row_id_highlight = array();
    var $highlight_class = '';
    var $cnt_rows = 0;
    var $foot_cols = array ();

    /**
     *
     * @param unknown_type $name
     * @param unknown_type $data_source
     * @param unknown_type $row_id
     * @param unknown_type $options
     */
    function __construct($name, $data_source, $row_id = '', $options = '') {
        $this->table_id = $name;
        $this->table_options = $options;
        $this->row_id = $row_id;

        $this->data = (is_resource($data_source)) ? db_batch_fetch($data_source) : $data_source;
        array_walk($this->data, 'fix_objfecha_html_table');
    }

    function add_highlight($ids, $highlight_class) {
        $this->row_id_highlight = $ids;
        $this->highlight_class = $highlight_class;
    }

    /**
     * Agrega una columna a la tabla
     * @param unknown_type $name
     * @param unknown_type $title
     * @param unknown_type $content
     * @param unknown_type $options
     * @param unknown_type $callback Funcion que se llamar� pasando como parametros los campos de content separados por comas EJ: {tratamiento}. {nombre}, {apellidos}
     *
     */
    function add_column($name, $title, $content, $options = '', $call_back = '') {
        $this->def_columnas[$name] = $title;
        $this->options_columnas[$name] = $options;

        if ($call_back != '') {
            $this->def_callback[$name] = $call_back;
        }
        $this->def_celdas[$name] = $content;
        preg_match_all('#\\{([a-zA-Z0-9_\-\.]+)\}#i', $content, $tag_field);
        $this->tags_columnas[$name] = $tag_field[1];
    }

    function print_table() {
        $str_table = '<table id="' . $this->table_id . '" ' . $this->table_options . '>%s</table>';
        $str_head = '<tr id="html_table_head">%s</tr>';
        $str_tds = '';

        foreach ($this->def_columnas as $c_name => $c_value) {

            $str_tds .= '<th id="hd_' . $c_name . '" '.$this->options_columnas[$c_name].'>' . $c_value . '</th>';
        }
        $str_head = sprintf($str_head, $str_tds);

        $str_rows = '';
        $cnt = 0;
        $str_row = '<tr id="html_table_row_%s" class="%s">%s</tr>';
        foreach ($this->data as $row) {
            $str_tds = '';
            $highlight = '';
            $cnt++;
            foreach ($this->def_celdas as $c_name => $content) {
                //$str_tds .= "<td>".print_div($c_name.'_'.$row[$this->row_id], $this->parse_tags($row[$c_name]))."</td>";
                //$str_tds .= "<td>".$row[$c_name]."</td>";
                //$str_tds .= "<td id='td_".$c_name."_".$row[$this->row_id]."'>".$this->parse_tags($c_name, $row)  ."</td>";
                $str_tds .= '<td id="td_' . $c_name . "_" . $row[$this->row_id] . '" '.$this->options_columnas[$c_name].'>' . $this->parse_tags($c_name, $row) . "</td>";
                if (count($this->row_id_highlight)>0 && in_array($row[$this->row_id], $this->row_id_highlight)) {
                    $highlight = $this->highlight_class;
                }
            }
            $str_rows .= sprintf($str_row, $row[$this->row_id], $highlight, $str_tds);
        }

        $str_foot = '';
        if (count($this->foot_cols) > 0 ) {
            $str_foot = '<tfoot><tr>';
            foreach ($this->foot_cols as $foot_content) {
                if ($foot_content['callback'] <> '') {
                    $params = explode(",", $foot_content['content']);
                    $contenido_foot = call_user_func_array($foot_content['callback'], $params);
                } else {
                    $contenido_foot = $foot_content['content'];
                }
                $str_foot .= sprintf('<td colspan="%s" %s>%s</td>', $foot_content['colspan'], $foot_content['options'], $contenido_foot);
            }
            $str_foot .= '</tr></tfoot>';
        }

        $this->cnt_rows = $cnt;
        return sprintf($str_table, $str_head . $str_rows. $str_foot);
    }

    private function parse_tags($c_name, $row) {
        $tag = array();
        $replace = array();

        $tags_columnas = $this->tags_columnas[$c_name];

        foreach ($tags_columnas as $key) {
            $tag[] = '{' . $key . '}';
            $replace[] = $row[$key];
        }

        if (array_key_exists($c_name, $this->def_callback)) {
            $params = $ret_val = str_replace($tag, $replace, $this->def_celdas[$c_name]);
            $params = explode(",", $params);
            $ret_val = call_user_func_array($this->def_callback[$c_name], $params);
        } else {
            $ret_val = str_replace($tag, $replace, $this->def_celdas[$c_name]);
        }

        return $ret_val;
    }

    function add_cell_foot($content, $colspan = 0, $options = '', $callback = '') {
        $this->foot_cols[] = array (
            'content' => $content,
            'colspan' => $colspan,
            'options' => $options,
            'callback' => $callback
        );
    }

}


function dropdown($name, $options, $selected = false, $attributes = '', $only_options = false) {
    $output = "";
    if (count($options) == 0 ) {
        $options[0] = '-';
    }

    foreach ($options as $key => $text) {
        $output .= '<option value="' . $key . '"' . ((($selected !== false) && ($selected == $key)) ? " selected" : "") . ">$text</option>";
    }

    // esto de only options es util por si queremos sacar el trozo de html con una llamada asincronica (AJAX)
    if (!$only_options) {
        $output = '<select id="' . $name . '" name="' . $name . '" ' . $attributes . '>' . $output . '</select>';
    }

    return $output;
}

function dropdowntratamientos($name) {
    //$str = "select 0 mltr_cod, '' mltr_descripcion from dual union ";
    $str .= "select mltr_cod, mltr_descripcion from mltr_tratamientos order by mltr_descripcion";
    $str_res = db_query($str);
    $a_str_res = array();
    while ($row = db_fetch($str_res)) {
        $a_str_res[$row['MLTR_COD']] = $row['MLTR_DESCRIPCION'];
    }
    return dropdown($name, $a_str_res, '0', ' id="' . $name . '" class="arc90_multiselect" multiple="multiple"');
}

function dropdowncargos($name) {
    //$str = "select 0 mlca_cod, '' mlca_descripcion from dual union ";
    $str .= "select mlca_cod, mlca_descripcion from mlca_cargos order by mlca_descripcion";
    $str_res = db_query($str);
    $a_str_res = array();
    while ($row = db_fetch($str_res)) {
        $a_str_res[$row['MLCA_COD']] = $row['MLCA_DESCRIPCION'];
    }
    return dropdown($name, $a_str_res, '0', ' id="' . $name . '"');
}

function dropdownpaises($name) {
    //$str = "select 0 mlpa_cod, '' mlpa_descripcion from dual union ";
    $str .= "select mlpa_cod, mlpa_descripcion from mlpa_paises order by mlpa_descripcion";
    $str_res = db_query($str);
    $a_str_res = array();
    while ($row = db_fetch($str_res)) {
        $a_str_res[$row['MLPA_COD']] = $row['MLPA_DESCRIPCION'];
    }
    return dropdown($name, $a_str_res, '0', ' id="' . $name . '" class="arc90_multiselect" multiple="multiple"');
}

function dropdownpoblaciones($name) {
    //$str = "select 0 mlpo_cod, '' mlpo_descripcion from dual union ";
    $str .= "select mlpo_cod, mlpo_descripcion from mlpo_poblaciones order by mlpo_descripcion";
    $str_res = db_query($str);
    $a_str_res = array();
    while ($row = db_fetch($str_res)) {
        $a_str_res[$row['MLPO_COD']] = $row['MLPO_DESCRIPCION'];
    }
    return dropdown($name, $a_str_res, '0', ' id="' . $name . '" class="arc90_multiselect" multiple="multiple"');
}

function dropdownsn($name, $selected = '', $attributes = '') {
    $a_options = array('' => '', 'S' => 'Si', 'N' => 'No');
    return dropdownGeneric($name, $a_options, $selected, ' class="input" ');
}

/*
 * Recibe un array asociativo y lo devuelve como migas del tema
 */

function print_migas($migas) {

    $migas_html = '<ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="view_clientes.php">
                                Inicio
                            </a>
                            <i class="fa fa-angle-right"></i>
                        </li>';
    $k = 0;
    if (count($migas) > 0) {
        foreach ($migas as $i => $miga) {
            if ($k < count($migas)) {
                $migas_html .= sprintf('<li>
                            <a href="%s">
                                %s
                            </a>
                            <i class="fa fa-angle-right"></i>
                        </li>', $i, $miga);
            }
            $k++;
        }
    }
    $migas_html .= '</ul>';

    return $migas_html;
}


class html_form {

    var $template_folder = 'form1';
    var $name = '';
    var $method = '';
    var $action = '';

    function __construct($name, $method, $action) {


    }

    function addText () {


    }

    function addSelect() {


    }

    function addCheck() {


    }

    function addRadio() {


    }


}
<?php

/**
 * Devuelve un string_path de la ruta y los parametros que se pasen
 * @param $path
 * @param string $args
 * @return string
 */
function path($path, $args = '') {
    if (is_array($args)) {
        $query_string = '?'.http_build_query($args, '\n');
    } else {
        $query_string = '';
    }

    if (i18n) {
        global $language;
        return base_path.$language.'/'.$path.$query_string;
    } else {
        return base_path.$path.$query_string;
    }

}


/**
 * Devuelve la ruta base del sitio, es como base_path pero permite pasar parámetros en un array
 * @param $path
 * @param string $args
 * @return string
 */
function real_path($path, $args = '') {
    if (is_array($args)) {
        $query_string = '?'.http_build_query($args, '\n');
    } else {
        $query_string = '';
    }

    return base_path.$path.$query_string;
}


function print_css_pluggins($css_pluggins) {
    foreach ($css_pluggins as $css) {
        print '<link href="'.base_path.$css.'" rel="stylesheet" type="text/css">'.chr(13);
    }
}

function print_js_pluggins($js_pluggins) {
    $output = '';
    foreach ($js_pluggins as $js) {
        if (file_exists(file_path.$js))
            print '<script src="'.base_path.$js.'" type="text/javascript"></script>'.chr(13);
    }
}

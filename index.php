<?php
include ('config/init.php');
global $query_args;
global $lang;

if (isset($_GET['q'])) {
    $qs = $_GET['q'];
    $aq = explode('/', $qs);
    if (i18n == true and function_exists('i18n_languajes_a') and  in_array($aq[0], i18n_languajes())) {
        $language = $aq[0];

        if (count($aq) > 1) {
            array_shift($aq);
        } else {
            $aq = array(
                'index'
            );
        }

        $qs = substr($qs, strlen($language) + 1);

    }

    if (array_key_exists($qs, $route)) {
        $aq = explode('/', $route[$qs]);
    } else {

    }

} else {

    if (array_key_exists('index', $route)) {
        $aq = array (
            $route['index']
        );
    } else {
        $aq = array (
            'index'
        );
    }

}

array_push($aq, $_GET);

$query_args = end($aq);
if (isset($query_args['q'])) {
    unset($query_args['q']);
}

if (i18n == true and function_exists('i18n_languajes_a') ) {
    $language = is_null($language) ? i18n_base : $language;
}

if (is_dir(file_path.'code/'.$aq[0])) {
    if (file_exists(file_path.'code/'.$aq[0].'/'.$aq[1].'.php')) {
        $view = $aq[1];
        if (i18n == true and function_exists('i18n_languajes_a')) {
            $_SESSION['i18n_text'] = i18n_load_text($qs, $language);
        }
        include(file_path.'code/'.$aq[0].'/'.$aq[1].'.php');
    } else {
        if (file_exists(file_path.'code/'.$aq[0].'/'.$aq[0].'.php')) {
            $view = $aq[0];
            if (i18n == true and function_exists('i18n_languajes_a')) {
                $language = is_null($language) ? 'val' : $language;
                $_SESSION['i18n_text'] = i18n_load_text($qs, $language);            }
            include(file_path.'code/'.$aq[0].'/'.$aq[0].'.php');
        } else {
            die ('Sin controlador');
        }
    }
} else {
    if (file_exists(file_path.'code/'.$aq[0].'.php')) {
        $view = $aq[0];
        if (i18n == true and function_exists('i18n_languajes_a') ) {
            $_SESSION['i18n_text'] = i18n_load_text($qs, $language);        }
        include(file_path.'code/'.$aq[0].'.php');
    }
}

if (is_dir(file_path.'output/'.$aq[0])) {

    if (file_exists(file_path.'output/'.$aq[0].'/'.$view.'.php')) {
        include(file_path.'output/'.$aq[0].'/'.$view.'.php');
    } else {
        die ('Sin template');
    }

} else {

    if (file_exists(file_path.'output/'.$view.'.php')) {
        include(file_path.'output/'.$view.'.php');
    } else {
        die('Sin template');
    }
}


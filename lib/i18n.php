<?php
define('i18n', true); //Esto convierte el sitio en MULTILANGUAJE

function t($text, $allpages = false) {
    $atext = $_SESSION['i18n_text'];

    if (array_key_exists($text, $atext)) {
        return (strlen($atext[$text]) > 0 )?$atext[$text]:$text;
    } else {
        $_SESSION['i18n_text'][$text] = '';
        db_insert('i18n', array (
            'script' => ($allpages == true)?'':$atext[1],
            i18n_base => $text
        ));
        return $text;
    }

}

function i18n_languajes() {
    return array_keys(i18n_languajes_a());
}

function i18n_languajes_a() {
    return array (
        'es' => 'Español',
        'fr' => 'Frances',
        'en' => 'Inglés'
    );
}

/*
 * Carga en la variable global de textos los contenidos de la página
 */
function i18n_load_text($script_name, $lang) {

    $atext = array ();
    $atext[0] = $lang;
    $atext[1] = $script_name;

    $res = db_query("select ".i18n_base.", $lang from i18n where script = '$script_name' or script = '' ");
    while ($r = db_fetch($res)) {
        $atext[$r[i18n_base]] = $r[$lang];
    }

    return $atext;
}


<?php
//Datos del usuario logueado
global $usu_logged;

if (!isset($_SESSION['usu_logged'])) {
    redirect('login?page_from='.$aq[0]);
    //redirect('login.php');
} else {
    //print_object($_SESSION['usu_logged']);die(0);

    $usu_logged = new usuario($_SESSION['usu_logged']['usu_cod']);
    $usu_logged->load();

/*    $usu_logged = new \vk15\usuario($_SESSION['usu_logged']->usu_cod);
    $usu_logged->load();
*/
}

/*
 * Usada para saber si el usuario que está conectado tiene un rol determinado
 */
function have_rol($rol_cod) {

    $sesion_roles = $_SESSION['usu_logged']['usu_roles'];

    $have_rol = false;
    foreach($sesion_roles as $usurol) {
        if ($rol_cod == $usurol['usro_rol_cod']) {
            $have_rol = true;
        }
    }

    return $have_rol;
}


/*
 * Saber si un usuario tiene un rol por su descriptor de texto
 */
function have_trol($rol_cod) {

    $sesion_roles = $_SESSION['usu_logged']['usu_roles'];

    $have_rol = false;
    foreach($sesion_roles as $usurol) {
        if ($rol_cod == $usurol['usro_rol_cod']) {
            $have_rol = true;
        }
    }

    return $have_rol;
}
<?php
$mens_fail = '';

if (isset($_POST['username'])) {

    //Recuperamos el usuario con username & pass
    $res = db_fetch(db_direct_query('usuarios',
        array('usu_login' => $_POST['username'], 'usu_pass' => hash('sha512', $_POST['password']), 'usu_activo' => 1)));

    if (isset($res['usu_cod']) && $res['usu_cod']) {

        //Recuperamos el puesto del usuario y la oficina

        $usu_cod = $res['usu_cod'];
        $_SESSION['usu_logged'] = $res;

        /*
        //$_SESSION['usu_logged']['usu_roles'] = unserialize($_SESSION['usu_logged']['usu_roles']);
        $query = sprintf("select * from usuarios_roles where usro_usu_cod=%d and usro_fecha_baja is null", $_SESSION['usu_logged']['usu_cod']);

        $resrole = db_query($query);
        $datrole = db_batch_fetch($resrole);
        $_SESSION['usu_logged']['usu_roles'] = $datrole;

        */

        if (isset($_GET['page_from'])) {
            redirect($_GET['page_from']);
        } else {
            redirect('escritorio');
            //redirect($_SESSION['usu_logged']['usu_startpage']);
        }


    } else {
        $mens_fail = '<div class="alert alert-danger" style="display: block;">
                    <button data-close="alert" class="close"></button>
                    <span>
                        Usuario o clave incorrecta.
                    </span>
                </div>';
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['usu_logged']);
}
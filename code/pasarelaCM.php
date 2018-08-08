<?php
if (isset($_SESSION['usu_logged'])) {
    $usuario = $_SESSION['usu_logged'];

    echo 'Pasar a pago';
    //print_object($usuario);
}
//die(0);
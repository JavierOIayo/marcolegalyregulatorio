<?php

require_once '../../../config.php';

if (isset($_GET["usuario"])) {

    $usuario = $_GET["usuario"];

    if (mysqli_query($link, "UPDATE usuario SET rol = 'Gerente' WHERE id = $usuario")) {
        $status = "success";
        $titulo = "Actualizado!";
        $msg = "Permisos actualizados";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Permisos no actualizados.";
    }
    header("Location: ../../usuarios.php?status=$status&msg=$msg&titulo=$titulo");
}

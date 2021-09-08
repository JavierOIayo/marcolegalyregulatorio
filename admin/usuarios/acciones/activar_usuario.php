<?php

require_once '../../../config.php';

if (isset($_GET["usuario"])) {

    $usuario = $_GET["usuario"];

    if (mysqli_query($link, "UPDATE usuario SET estado = 1 WHERE id = $usuario")) {
        $status = "success";
        $titulo = "Actualizado!";
        $msg = "Usuario activado";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Usuario no activado";
    }
    header("Location: ../../usuarios.php?status=$status&msg=$msg&titulo=$titulo");
}

<?php

require_once '../../../config.php';

if (isset($_GET["usuario"])) {

    $usuario = $_GET["usuario"];

    if (mysqli_query($link, "DELETE FROM usuario WHERE id = $usuario")) {
        $status = "success";
        $titulo = "Eliminado!";
        $msg = "Usuario eliminado";
    } else if (mysqli_query($link, "UPDATE usuario SET estado = 0 WHERE id = $usuario")) {
        $status = "warning";
        $titulo = "Desactivado!";
        $msg = "El usuario posee información vinculada";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Usuario no eliminado";
    }
    header("Location: ../../usuarios.php?status=$status&msg=$msg&titulo=$titulo");
}

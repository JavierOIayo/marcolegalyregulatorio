<?php

require_once '../../../config.php';

if (isset($_GET["usuario"])) {

    $usuario = $_GET["usuario"];
    $temp_pass = "UMG" . substr(time(), 7);
    $nueva_pass = password_hash($temp_pass, PASSWORD_DEFAULT);

    if (mysqli_query($link, "UPDATE usuario SET estado = 2, pass = '$nueva_pass' WHERE id = $usuario")) {
        $status = "success";
        $titulo = "Actualizado!";
        $msg = "Contraseña cambiada a : $temp_pass";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Usuario no actualizado";
    }
    header("Location: ../../usuarios.php?status=$status&msg=$msg&titulo=$titulo");
}

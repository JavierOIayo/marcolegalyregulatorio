<?php

require_once '../../../config.php';

if (isset($_POST["nombre"])) {

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $rol = $_POST["rol"];
    $temp_pass = "UMG" . substr(time(), 7);
    $pass_hash = password_hash($temp_pass, PASSWORD_DEFAULT);

    if (mysqli_query($link, "INSERT INTO usuario (nombre, apellido, correo, pass, rol, estado) VALUES ('$nombre', '$apellido', '$correo', '$pass_hash', '$rol', 2)")) {
        $status = "success";
        $titulo = "Creado!";
        $msg = "Usuario creado. Contraseña: $temp_pass";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Usuario no creado";
    }
    header("Location: ../../usuarios.php?status=$status&msg=$msg&titulo=$titulo");
}

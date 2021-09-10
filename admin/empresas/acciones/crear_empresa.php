<?php

require_once '../../../config.php';

if (isset($_POST["nombre"])) {

    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    if (mysqli_query($link, "INSERT INTO empresa (nombre, direccion, telefono, correo, estado) VALUES ('$nombre', '$direccion', '$telefono', '$correo', 1)")) {
        $status = "success";
        $titulo = "Creada!";
        $msg = "Empresa creada.";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Empresa no creada";
    }
    header("Location: ../../empresas.php?status=$status&msg=$msg&titulo=$titulo");
}

<?php

require_once '../../../config.php';
date_default_timezone_set('America/Guatemala');
if (isset($_POST["id_empresa"])) {

    $id_empresa = $_POST["id_empresa"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];

    if (mysqli_query($link, "UPDATE empresa SET direccion = '$direccion', telefono = '$telefono', correo = '$correo' WHERE id = $id_empresa")) {

        $status = "success";
        $titulo = "Actualizada!";
        $msg = "Empresa actualizada.";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Empresa no actualizada.";
    }
    header("Location: ../../editar_empresa.php?empresa=$id_empresa&status=$status&msg=$msg&titulo=$titulo");
}

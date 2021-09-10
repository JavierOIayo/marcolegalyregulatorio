<?php

require_once '../../../config.php';

if (isset($_POST["empresa"])) {

    $empresa = $_POST["empresa"];
    $gerente = $_POST["gerente"];

    if (mysqli_query($link, "INSERT INTO asignar_gerente (id_empresa, id_usuario) VALUES ($empresa, $gerente)")) {
        $status = "success";
        $titulo = "Asignado!";
        $msg = "Gerente asignado";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Gerente no asignado";
    }
    header("Location: ../../empresas.php?status=$status&msg=$msg&titulo=$titulo");
}

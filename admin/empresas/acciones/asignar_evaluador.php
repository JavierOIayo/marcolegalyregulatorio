<?php

require_once '../../../config.php';

if (isset($_POST["empresa"])) {

    $empresa = $_POST["empresa"];
    $evaluador = $_POST["evaluador"];

    if (mysqli_query($link, "INSERT INTO asignar_evaluador (id_empresa, id_usuario) VALUES ($empresa, $evaluador)")) {
        $status = "success";
        $titulo = "Asignado!";
        $msg = "Evaluador asignado";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Evaluador no asignado";
    }
    header("Location: ../../empresas.php?status=$status&msg=$msg&titulo=$titulo");
}

<?php

require_once '../../../config.php';

if (isset($_GET["empresa"])) {

    $empresa = $_GET["empresa"];

    if (mysqli_query($link, "UPDATE empresa SET estado = 1 WHERE id = $empresa")) {
        $status = "success";
        $titulo = "Actualizada!";
        $msg = "Empresa desactivada";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Empresa no desactivada";
    }
    header("Location: ../../empresas.php?status=$status&msg=$msg&titulo=$titulo");
}

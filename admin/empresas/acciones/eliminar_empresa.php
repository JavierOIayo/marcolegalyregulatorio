<?php

require_once '../../../config.php';

if (isset($_GET["empresa"])) {

    $empresa = $_GET["empresa"];

    if (mysqli_query($link, "DELETE FROM empresa WHERE id = $empresa")) {
        $status = "success";
        $titulo = "Eliminado!";
        $msg = "Empresa eliminada";
    } else if (mysqli_query($link, "UPDATE empresa SET estado = 0 WHERE id = $empresa")) {
        $status = "warning";
        $titulo = "Desactivada!";
        $msg = "La empresa posee información vinculada";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Empresa no eliminada";
    }
    header("Location: ../../empresas.php?status=$status&msg=$msg&titulo=$titulo");
}

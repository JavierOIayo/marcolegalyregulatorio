<?php

require_once '../../../config.php';

if (isset($_GET["evaluacion"])) {

    $evaluacion = $_GET["evaluacion"];
    
    if (mysqli_query($link, "UPDATE evaluacion SET estado = 'Finalizada' WHERE id = $evaluacion")) {

        $status = "success";
        $titulo = "Actualizada!";
        $msg = "Evaluación actualizada.";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Evaluación no actualizada";
    }
    header("Location: ../../evaluaciones.php?status=$status&msg=$msg&titulo=$titulo");
}

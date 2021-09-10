<?php

require_once '../../../config.php';
date_default_timezone_set('America/Guatemala');
if (isset($_POST["empresa"])) {

    $empresa = $_POST["empresa"];
    $ley = $_POST["ley"];
    $fecha_inicio = date("Y-m-d");

    if (mysqli_query($link, "INSERT INTO evaluacion (id_empresa, id_ley, estado, fecha_inicio) VALUES ('$empresa', '$ley', 'En progreso', '$fecha_inicio')")) {

        $id_evaluacion_query = mysqli_query($link, "SELECT MAX(id) AS id FROM evaluacion");
        $id_evaluacion = mysqli_fetch_assoc($id_evaluacion_query);
        $articulos_evaluar_query = mysqli_query($link, "SELECT articulo.* FROM articulo, capitulo WHERE capitulo.id_ley = $ley");
        while ($articulos_evaluar = mysqli_fetch_assoc($articulos_evaluar_query)){
            mysqli_query($link, "INSERT INTO evaluacion_articulos (id_articulo, id_evaluacion) VALUES ({$articulos_evaluar["id"]}, {$id_evaluacion["id"]})");
        }
        
        $status = "success";
        $titulo = "Creada!";
        $msg = "Evaluación creada.";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Evaluación no creada";
    }
    header("Location: ../../evaluaciones.php?status=$status&msg=$msg&titulo=$titulo");
}

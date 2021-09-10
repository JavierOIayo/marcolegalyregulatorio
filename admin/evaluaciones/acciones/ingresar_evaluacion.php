<?php

require_once '../../../config.php';

$punteo_array = array();
$id_evaluacion_array = array();

foreach ($_POST['id_evaluacion'] as $id_evaluacion) {
    array_push($id_evaluacion_array, $id_evaluacion);
}

if (isset($_POST["punteo"])) {
    foreach ($_POST['punteo'] as $punteo) {
        array_push($punteo_array, $punteo);
    }
}

for ($x = 0; $x < count($id_evaluacion_array); $x++) {
    if (mysqli_query($link, "UPDATE evaluacion_articulos SET punteo = $punteo_array[$x] WHERE id = $id_evaluacion_array[$x]")) {
        $estado = "success";
    }
}

header("Location: ../../evaluar_articulos.php?evaluacion=13&status=$status&msg=$msg&titulo=$titulo");
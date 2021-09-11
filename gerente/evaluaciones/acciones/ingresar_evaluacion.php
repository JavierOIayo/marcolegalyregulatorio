<?php

require_once '../../../config.php';


$id_evaluacion_array = array();
$articulo_evaluado_array = array();
$punteo_array = array();

$ruta_evidencias = "../evidencias/";
$eval_id = $_POST["eval_id"];


foreach ($_POST['id_evaluacion'] as $id_evaluacion) {
    array_push($id_evaluacion_array, $id_evaluacion);
}

foreach ($_POST['articulo_evaluado'] as $articulo_evaluado) {
    array_push($articulo_evaluado_array, $articulo_evaluado);
}

if (isset($_POST["punteo"])) {
    foreach ($_POST['punteo'] as $punteo) {
        array_push($punteo_array, $punteo);
    }
}

for ($x = 0; $x < count($id_evaluacion_array); $x++) {
    if (mysqli_query($link, "UPDATE evaluacion_articulos SET punteo = $punteo_array[$x] WHERE id = $id_evaluacion_array[$x]")) {
        $status = "success";
        $titulo = "Creada!";
        $msg = "Evaluación creada.";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Evaluación no creada";
    }
}

if (isset($_POST["articulo_evaluado"])) {
    $articulo_eval = $_POST["articulo_evaluado"];
}

$evidencia_doc = $_FILES["evidencia"]["name"];
$array_evidencia_r = array();

for ($i = 0; $i < count($id_evaluacion_array); $i++) {
    if (!empty($evidencia_doc[$i])) {
        $evidencia_r = NULL;

        $ruta_evaluacion = $ruta_evidencias . "evidencia_" . $eval_id;
        if (!is_dir($ruta_evaluacion)) {
            mkdir($ruta_evaluacion, 0755);
        }

        $evidencia_docP = $evidencia_doc[$i];
        $evidencia_docP_extP = pathinfo($evidencia_docP, PATHINFO_EXTENSION);
        //Orden encargado doc
        if (!empty($evidencia_docP)) {
            # Upload file
            $evidencia_r = $articulo_eval[$i] . "." . $evidencia_docP_extP;
            // echo $evidencia_r;
            if (move_uploaded_file($_FILES['evidencia']['tmp_name'][$i], $ruta_evaluacion . "/" . $evidencia_r)) {
                // echo "Archivo subido.";
            }
        }

        $id_art_evaluacion = $id_evaluacion_array[$i];
        if (mysqli_query($link, "UPDATE evaluacion_articulos SET evidencia = '$evidencia_r' WHERE id = $id_art_evaluacion ")) {
            $status = "success";
            $titulo = "Actualizada!";
            $msg = "Evaluación actualizada.";
        } else {
            $status = "error";
            $titulo = "Error!";
            $msg = "Evaluación no actualizada";
        }
    }
}


header("Location: ../../evaluar_articulos.php?evaluacion=$eval_id&status=$status&msg=$msg&titulo=$titulo");

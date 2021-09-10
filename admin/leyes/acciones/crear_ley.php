<?php

require_once '../../../config.php';

if (isset($_POST["nombre"])) {

    $nombre = $_POST["nombre"];
    $direccion = $_POST["descripcion"];
    $fecha = $_POST["fecha"];
    $fecha2 = date_format(date_create($fecha), "Y-m-d");
    $pais = $_POST["pais"];

    if (mysqli_query($link, "INSERT INTO ley (nombre, descripcion, fecha, pais, estado) VALUES ('$nombre', '$direccion', '$fecha2', '$pais', 1)")) {
        $status = "success";
        $titulo = "Creada!";
        $msg = "Ley creada.";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Ley no creada";
    }
    header("Location: ../../leyes.php?status=$status&msg=$msg&titulo=$titulo");
}

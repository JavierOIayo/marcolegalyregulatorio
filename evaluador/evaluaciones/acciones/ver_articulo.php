<?php

require_once '../../../config.php';
if (isset($_GET["articulo"])) {

    $articulo = $_GET["articulo"];

    if ($articulo_query = mysqli_query($link, "SELECT descripcion from articulo WHERE id = $articulo")) {
        $articulo = mysqli_fetch_assoc($articulo_query);
        echo $articulo["descripcion"];
    } else {
        echo "No se encontró información";
    }
}

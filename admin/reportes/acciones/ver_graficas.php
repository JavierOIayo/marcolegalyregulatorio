<?php

require_once '../../../config.php';

if (isset($_POST["empresa"])) {

    $empresa = $_POST["empresa"];
    echo $empresa;
    header("Location: ../../reporte_1.php?empresa=$empresa");
}

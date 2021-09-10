<?php

require_once '../../../config.php';

if (isset($_GET["ley"])) {

    $ley = $_GET["ley"];

    if (mysqli_query($link, "UPDATE ley SET estado = 0 WHERE id = $ley")) {
        $status = "success";
        $titulo = "Actualizada!";
        $msg = "Ley desactivada";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Ley no desactivada";
    }
    header("Location: ../../leyes.php?status=$status&msg=$msg&titulo=$titulo");
}

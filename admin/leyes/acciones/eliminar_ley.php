<?php

require_once '../../../config.php';

if (isset($_GET["ley"])) {

    $ley = $_GET["ley"];

    if (mysqli_query($link, "DELETE FROM ley WHERE id = $ley")) {
        $status = "success";
        $titulo = "Eliminado!";
        $msg = "Ley eliminada";
    } else if (mysqli_query($link, "UPDATE ley SET estado = 0 WHERE id = $ley")) {
        $status = "warning";
        $titulo = "Desactivada!";
        $msg = "La ley posee información vinculada";
    } else {
        $status = "error";
        $titulo = "Error!";
        $msg = "Ley no eliminada";
    }
    header("Location: ../../leyes.php?status=$status&msg=$msg&titulo=$titulo");
}

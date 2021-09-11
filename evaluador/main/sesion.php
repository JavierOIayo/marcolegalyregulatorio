<?php
session_start();

if (!isset($_SESSION['evaluador']) || empty($_SESSION['evaluador'])) {
    $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("location: ../index.php?continue=$actual_link");
    exit;
} else {
    $s_usuario = $_SESSION['evaluador']["usuario"];
    $s_nombre = $_SESSION['evaluador']["nombre"];
    $s_apellido = $_SESSION['evaluador']["apellido"];
    $s_id = $_SESSION['evaluador']["id"];
    // include 'user/privileges/display.php';
    require_once '../config.php';
}

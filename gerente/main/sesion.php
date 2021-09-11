<?php
session_start();

if (!isset($_SESSION['gerente']) || empty($_SESSION['gerente'])) {
    $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("location: ../index.php?continue=$actual_link");
    exit;
} else {
    $s_usuario = $_SESSION['gerente']["usuario"];
    $s_nombre = $_SESSION['gerente']["nombre"];
    $s_apellido = $_SESSION['gerente']["apellido"];
    $s_id = $_SESSION['gerente']["id"];
    // include 'user/privileges/display.php';
    require_once '../config.php';
}

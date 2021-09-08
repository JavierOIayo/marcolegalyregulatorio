<?php
session_start();

if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
    $actual_link = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("location: auth/index.php?continue=$actual_link");
    exit;
} else {
    $s_usuario = $_SESSION['admin']["usuario"];
    $s_nombre = $_SESSION['admin']["nombre"];
    $s_apellido = $_SESSION['admin']["apellido"];
    $s_id = $_SESSION['admin']["id"];
    // include 'user/privileges/display.php';
}

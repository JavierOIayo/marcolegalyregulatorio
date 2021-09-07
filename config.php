<?php
define('DB_HOST', 'sql222.main-hosting.eu'); 
define('DB_USERNAME', 'u281116220_umglegal'); 
define('DB_PASSWORD', 'Marcoumglegal2021!'); 
define('DB_NAME', 'u281116220_marcolegal'); 

//Conectarse a la DB
$link = @mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Revisar conexión
if(!$link){
    header("Location: sin_conexion.php");
}else{
}
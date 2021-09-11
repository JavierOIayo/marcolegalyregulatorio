<?php
function alertas($pStatus, $pTitulo, $pMsg)
{
	echo "<script>Swal.fire('$pTitulo', '$pMsg', '$pStatus');</script>";
}

if (isset($_GET["status"]) && isset($_GET["titulo"]) && isset($_GET["msg"])) {
	$status = $_GET["status"];
	$titulo = $_GET["titulo"];
	$msg = $_GET["msg"];
	alertas($status, $titulo, $msg);
	echo "<script>window.history.replaceState(null, null, '?nino=$id_nino');</script>";
}
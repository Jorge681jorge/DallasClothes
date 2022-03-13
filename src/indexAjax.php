<?php
require_once "logica/Administrador.php";
require_once "logica/Producto.php";
require_once "logica/Cliente.php";
require_once "logica/Proveedor.php";
require_once "logica/FacturaProducto.php";
require_once "logica/Factura.php";

$pid = base64_decode($_GET["pid"]);
include $pid;
?>
 
<?php
session_start();
require_once "logica/Administrador.php";
require_once "logica/Producto.php";
require_once "logica/Cliente.php";
require_once "logica/Proveedor.php";
require_once "logica/Log.php";
require_once "logica/FacturaProducto.php";
require_once "logica/Factura.php";
require_once "pdf/pdf.php";
require_once "presentacion/autenticar.php";
$pid = "";
if (isset($_GET["pid"])) {
	$pid = base64_decode($_GET["pid"]);
} else {
	$_SESSION["id"] = "";
	$_SESSION["rol"] = "";
	$_SESSION["n"] = 0;
}
if (isset($_GET["cerrarSesion"]) || !isset($_SESSION["id"])) {
	$_SESSION["id"] = "";
	$_SESSION["n"] = 0;
}

?>

<html>

<head>
	<title>Dalla's Clothes</title>
	<link rel="icon" type="image/png" href="img/sell.png" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.1/css/all.css" />
	<link rel="stylesheet" href="css/estilos.css" />
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.js"></script>
</head>

<body>
	<?php
	include "presentacion/encabezado.php";
	$paginasSinSesion = array(
		"presentacion/Login.php",
		"presentacion/Registro.php",
		"presentacion/producto/mostrarProd.php",
		"presentacion/producto/mostrarProdInd.php",
		"presentacion/producto/Busqueda.php"
	);

	if ($_SESSION["id"] != "") {
		if ($_SESSION["rol"] == "Administrador") {
			include "presentacion/administrador/menuAdministrador.php";
		} else if ($_SESSION["rol"] == "Cliente") {
			include "presentacion/cliente/menuCliente.php";
		} else if ($_SESSION["rol"] == "Proveedor") {
			include "presentacion/proveedor/menuProveedor.php";
		}
		include $pid;
	} else if (in_array($pid, $paginasSinSesion)) {
		include "presentacion/menuInicio.php";
		include $pid;
	} else {
		include "presentacion/menuInicio.php";
		include "presentacion/inicio.php";
	}
	include "presentacion/footer.php";
	?>
</body>

</html>
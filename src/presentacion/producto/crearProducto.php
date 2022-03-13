<?php
if(isset($_GET["a"])){
	$a=$_GET["a"];
}
if(isset($_GET["t"])){
	$t=$_GET["t"];
}else{
	$t=0;
}
$nombre = "";
if (isset($_POST["nombre"])) {
	$nombre = $_POST["nombre"] . " " . $_POST['tipo'];
}
$cantidad = "";
if (isset($_POST["cantidad"])) {
	$cantidad = $_POST["cantidad"];
}
$precio = "";
if (isset($_POST["precio"])) {
	$precio = $_POST["precio"];
}
$idProveedor = "";
if ($_SESSION["rol"] == 'Proveedor') {
	$idProveedor = $_SESSION["id"];
} elseif (isset($_POST["idProveedor"])) {
	$idProveedor = $_POST["idProveedor"];
}

if (isset($_POST["crear"])) {
	$producto = new Producto("", $nombre, $cantidad, $precio, $idProveedor);
	$producto->insertar();
	if ($t == 1) {
		$proveedor = new Proveedor($a);
		$proveedor->consultar();
		$log = new Log("", "Inserción producto ", $nombre."-".$cantidad."-".$precio."-".$idProveedor, "", "", $proveedor->getCorreo());
		$log->insertar();
	} else {
		$administrador = new Administrador($a);
		$administrador->consultar();
		$log = new Log("", "Inserción producto ",$nombre."-".$cantidad."-".$precio."-".$idProveedor, "", "", $administrador->getCorreo());
		$log->insertar();
	}
}
?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-3">
	<div class="row">
		<div class="col-lg-3 col-md-0"></div>
		<div class="col-lg-6 col-md-12">
			<div class="card f">
				<div class="card-header text-white ">
					<h4>Crear Producto</h4>
				</div>
				<div class="card-body">
					<?php if (isset($_POST["crear"])) { ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Datos ingresados<br>
							Recuerde ingresar las fotos, los productos que no tengan foto NO se mostraran a clientes
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
					<?php } ?>
					<form action="index.php?pid=<?php echo base64_encode("presentacion/producto/crearProducto.php") ?>&a=<?php echo $a ."&t=".$t?>" method="post">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>" required>
						</div>
						<div class="form-group">
							<label>Cantidad</label>
							<input type="number" name="cantidad" class="form-control" min="1" value="<?php echo $cantidad ?>" required>
						</div>
						<div class="form-group">
							<label>Precio</label>
							<input type="number" name="precio" class="form-control" min="1" value="<?php echo $precio ?>" required>
						</div>
						<div class="form-group">
							<label>ID Proveedor</label>
							<input <?php
									if ($idProveedor) {
										echo 'disabled';
									}
									?> type="number" name="idProveedor" class="form-control" min="1" value="<?php echo $idProveedor ?>" required>
						</div>
							<select name="tipo" class="custom-select" id="inputGroupSelect02">
								<option selected>mujer</option>
								<option value="hombre">hombre</option>
							</select>
						<button type="submit" name="crear" class="btn btn-info">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$filtro = "";
if (isset($_GET["filtro"])) {
	$filtro = $_GET["filtro"];
}
$id = "";
if (isset($_GET["idP"])) {
	$id = $_GET["idP"];
}
if (isset($_GET["idProd"])) {
	$tiempo = new DateTime();
	$t = $tiempo->getTimestamp();
	$factura = new Factura("", "", "", $_SESSION["id"]);
	if ($factura->consultarCantidad() != 0) {
		$factura->consultar();
	} else {
		$factura = new Factura($t, "", "", $_SESSION["id"]);
		$factura->insertar();
	}

	$idprod = $_GET["idProd"];
	$producto = new Producto($idprod);
	$producto->consultar2();
	$facP = new FacturaProducto("", 1, $producto->getPrecio(), $factura->getIdFactura(), $producto->getIdProducto());
	$facP->insertar();
}
?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-3 col-md-0"></div>
		<div class="col-lg-6 col-md-12">
			<div class="card f">
				<div class="card-header text-white ">
					<h4>Buscar Producto</h4>
				</div>
				<div class="card-body">
					<input type="text" id="filtro" name="filtro" class="form-control" placeholder="Palabra clave" <?php if ($filtro != "") {
																														echo "value='" . $filtro . "'";
																													} ?>>
				</div>
			</div>
		</div>
	</div>
	<div class="mt-3">
	<?php if (isset($_GET["idProd"])) { ?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			Producto agregado al carrito
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		</div>
	<?php } ?>
	</div>
</div>
<div id="resultados"></div>
<script>
	$(document).ready(function() {
		$("#filtro").keyup(function() {
			if ($(this).val().length >= 3) {

				var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProdAjax.php") ?>&idP=<?php echo $id ?>&filtro=" + $(this).val();
				$("#resultados").load(url);

			}
		});
		if ($("#filtro").val().length >= 3) {

			var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProdAjax.php") ?>&idP=<?php echo $id ?>&filtro=" + $("#filtro").val();
			$("#resultados").load(url);

		}
	});
</script>
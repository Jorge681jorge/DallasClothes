<?php
if (isset($_GET["a"])) {
	$a = $_GET["a"];	
}
if (isset($_GET["t"])) {
	$t = $_GET["t"];	
}else{
	$t=0;
}
if (isset($_POST["editar"])) {
	$aux= new Producto($_GET["idProducto"]);
	$aux->consultar2();
	$fot1 = "";
	$fot2 = "";
	$fot3 = "";
	if($aux->getFoto()!=""){
		$fot1=$aux->getFoto();
	}
	if($aux->getFoto2()!=""){
		$fot2=$aux->getFoto2();
	}
	if($aux->getFoto3()!=""){
		$fot3=$aux->getFoto3();
	}
	if (!empty($_FILES['foto']['name'][0])) {
		$fot1 = "1.jpg";
	}
	if (!empty($_FILES['foto']['name'][1])) {
		$fot2 = "2.jpg";
	}
	if (!empty($_FILES['foto']['name'][2])) {
		$fot3 = "3.jpg";
	}
	$producto = new Producto($_GET["idProducto"], $_POST["nombre"], $_POST["cantidad"], $_POST["precio"], "", $fot1, $fot2, $fot3);

	for ($i = 0; $i < 3; $i++) {
		if (!empty($_FILES['foto']['name'][$i])) {
			$tmp = $_FILES["foto"]["tmp_name"][$i];

			$folder = 'ImgProd/' . $producto->getIdProducto() . "/";
			if (!is_dir($folder)) {
				mkdir($folder, 07777, true);
			}
			move_uploaded_file($tmp, $folder . ($i + 1) . '.jpg');
		}
	}
	if($t==1){
		$proveedor = new Proveedor($a);
		$proveedor->consultar();
		$p = new Producto($_GET["idProducto"]);
		$p->consultar2();
		$log = new Log("", "Edicion producto ",$p->getIdProducto()."-". $p->getNombre()."-". $p->getCantidad()."-". $p->getPrecio()."-". $p->getFoto()."-". $p->getFoto2()."-".$p->getFoto3() , "", "", $proveedor->getCorreo());
		$log->insertar();
	}else{
		$administrador = new Administrador($a);
		$administrador->consultar();
		$p = new Producto($_GET["idProducto"]);
		$p->consultar2();
		$log = new Log("", "Edicion producto ",$p->getIdProducto()."-". $p->getNombre()."-". $p->getCantidad()."-". $p->getPrecio()."-". $p->getFoto()."-". $p->getFoto2()."-".$p->getFoto3() , "", "", $administrador->getCorreo());
		$log->insertar();
	}
	
	$producto->editar();
} else {
	$producto = new Producto($_GET["idProducto"]);
	$producto->consultar();
}
?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-4">
	<div class="row">
		<div class="col-lg-3 col-md-0"></div>
		<div class="col-lg-6 col-md-12">
			<div class="card f">
				<div class="card-header text-white">
					<h4>Editar Producto</h4>
				</div>
				<div class="card-body">
					<?php if (isset($_POST["editar"])) { ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Datos editados
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
					<?php } ?>
					<form action="index.php?pid=<?php echo base64_encode("presentacion/producto/editarProducto.php") ?>&idProducto=<?php echo $_GET["idProducto"] ?>&a=<?php echo $a?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control" value="<?php echo $producto->getNombre() ?>" required>
						</div>
						<div class="form-group">
							<label>Cantidad</label>
							<input type="number" name="cantidad" class="form-control" min="1" value="<?php echo $producto->getCantidad() ?>" required>
						</div>
						<div class="form-group">
							<label>Precio</label>
							<input type="number" name="precio" class="form-control" min="1" value="<?php echo $producto->getPrecio() ?>" required>
						</div>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input name="foto[]" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
								<label class="custom-file-label" for="inputGroupFile01" >Imagen 1</label>
							</div>
						</div>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input name="foto[]" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
								<label class="custom-file-label" for="inputGroupFile01">Imagen 2</label>
							</div>
						</div>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input name="foto[]" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
								<label class="custom-file-label" for="inputGroupFile01">Imagen 3</label>
							</div>
						</div>
						<button type="submit" name="editar" class="btn btn-info">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
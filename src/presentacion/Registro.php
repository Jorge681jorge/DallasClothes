<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="inicio">

	<?php
	$error = 0;
	$registrado = false;
	if (isset($_POST["registrar"])) {
		$correo = $_POST["correo"];
		$clave = $_POST["clave"];
		$administrador = new Administrador("", "", "", $correo, $clave);
		$proveedor = new Proveedor("", "", "", $correo, $clave);
		$cliente = new Cliente("", "", "", $correo, $clave);
		if ($cliente->existeCorreo()||$proveedor -> existeCorreo()||$administrador -> existeCorreo()) {
			$error = 1;
		} else {
			$cliente->registrar();
			$registrado = true;
		}
	}
	if (isset($_POST["registrarP"])) {
		$correo = $_POST["correo"];
		$clave = $_POST["clave"];
		$nombre = $_POST["nombre"];
		$apellido = $_POST["apellido"];
		$administrador = new Administrador("", "", "", $correo, $clave);
		$proveedor = new Proveedor("", "", "", $correo, $clave);
		$cliente = new Cliente("", "", "", $correo, $clave);
		if ($proveedor->existeCorreo()||$cliente -> existeCorreo()||$administrador -> existeCorreo()) {
			$error = 1;
		} else {
			$proveedor->registrar();
			$registrado = true;
		}
	}
	?>
	<div class="container mt-5">
		
		<div class="row">
			<div class="col-lg-3 col-md-0"></div>
			<div class="col-lg-6 col-md-12">
					
				<div>
						<?php if ($error == 1) { ?>
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									El correo <?php echo $correo ?> ya se encuentra registrado.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
							<?php } else if ($registrado) { ?>
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									El cliente fue registrado exitosamente. Verifique el correo <?php echo $correo ?> para activar la cuenta.
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
						<?php } ?>
				</div>


				<div id="accordion">
							<div class="card f">
								<div class="card-header ">
									<a class="card-link text-white" data-toggle="collapse" href="#collapseOne">
									<h4>Registro Nuevos Clientes</h4>
									</a>
								</div>
								<div id="collapseOne" class="collapse show" data-parent="#accordion">
									<div class="card-body">
										<form action="index.php?pid=<?php echo base64_encode("presentacion/Registro.php") ?>" method="post">
											<div class="form-group">
												<input name="correo" type="email" class="form-control" placeholder="Correo" required>
											</div>
											<div class="form-group">
												<input name="clave" type="password" class="form-control" placeholder="Clave" required>
											</div>
											<div class="form-group">
												<input name="registrar" type="submit" class="form-control btn btn-info">
											</div>
										</form>									
									</div>
								</div>
							</div>

							<div class="card f">
								<div class="card-header">
									<a class="collapsed card-link text-white" data-toggle="collapse" href="#collapseTwo">
									<h10>¿Quieres Vender Tus produtos?</h10>
									<h4> Registro Proveedores Dallas</h4>
									</a>
								</div>
								<div id="collapseTwo" class="collapse" data-parent="#accordion">
									<div class="card-body">
										<form action="index.php?pid=<?php echo base64_encode("presentacion/Registro.php") ?>" method="post">
											<div class="form-group">
												<input name="nombre" type="text" class="form-control" placeholder="Nombre" required>
											</div>
											<div class="form-group">
												<input name="apellido" type="text" class="form-control" placeholder="Apellido" required>
											</div>
											<div class="form-group">
												<input name="correo" type="email" class="form-control" placeholder="Correo" required>
											</div>
											<div class="form-group">
												<input name="clave" type="password" class="form-control" placeholder="Clave" required>
											</div>
											<div class="form-group">
												<input name="registrarP" type="submit" class="form-control btn btn-info">
											</div>
										</form>
										
									</div>
		
							</div>

							



					</div>
					
			</div>


		</div>
	</div>
				
</div>
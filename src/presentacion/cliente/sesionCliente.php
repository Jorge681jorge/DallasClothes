<?php
$cliente = new Cliente($_SESSION["id"]);
$cliente->consultar();
$error = 0;
if (isset($_POST["editar"])) {
	if (file_exists('ImgCli/' . $cliente->getIdCliente() . $cliente->getFoto())) {
		unlink('ImgCli/' . $cliente->getIdCliente() . $cliente->getFoto());
	}

	if (!empty($_FILES['foto']['name'])) {

		$n = $_FILES['foto']['name'];
		$tmp = $_FILES["foto"]["tmp_name"];
		$folder = 'ImgCli/' . $cliente->getIdCliente();
		move_uploaded_file($tmp, $folder . $n);
	}

	$cliente = new Cliente($_SESSION["id"], $_POST["nombre"], $_POST["apellido"], "", "", $_FILES['foto']['name']);
	$cliente->editar();
}
if (isset($_POST["editarc"])) {
	if ($cliente->getClave() == (md5($_POST["antigua"]))) {
		$cli = new Cliente($_SESSION["id"], "", "", "", $_POST["nueva"]);
		$cli->editarClave();
	} else {
		$error = 1;
	}
}
$cliente->consultar();
?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-6">
			<div class="card f">
				<div class="card-header text-white">
					<h4>Bienvenido de nuevo <?php
											echo ($cliente->getNombre() != "") ? $cliente->getNombre() : $cliente->getCorreo();
											?></h4>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-3">
							<img src="<?php echo ($cliente->getFoto() != "") ? "ImgCli/" . $cliente->getIdCliente() . $cliente->getFoto() : "http://icons.iconarchive.com/icons/custom-icon-design/silky-line-user/512/user2-2-icon.png"; ?>" width="100%" class="img-thumbnail">
						</div>
						<div class="col-9">
							<table class="table table-hover">
								<tr>
									<th>Nombre</th>
									<td><?php echo $cliente->getNombre() ?></td>
								</tr>
								<tr>
									<th>Apellido</th>
									<td><?php echo $cliente->getApellido() ?></td>
								</tr>
								<tr>
									<th>Correo</th>
									<td><?php echo $cliente->getCorreo() ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="card-footer " style="text-align: right;">
					<a data-toggle="modal" data-target="#Facturas" style="text-align: right;" href="#" title="Ver compras realizadas"><i class="fas fa-clipboard"></i> </i></a>
					<a data-toggle="modal" data-target="#Informacion" style="text-align: right;" href="#" title="Editar perfil"><i class="fas fa-user-edit"> </i></a>
					<a data-toggle="modal" data-target="#Clave" style="text-align: right;" href="#" title="Editar contraseña"><i class="fas fa-unlock-alt"> </i></a>

				</div>
			</div>
		</div>
		<div class="col-lg-1">

		</div>
		<div class="col-lg-4  d-none d-lg-block d-xl-block">
			<div class="card">
				<div class="card-header text-white">
					<h4>Disfruta de nuestros nuevos productos</h4>
				</div>
				<div class="card-body">
					<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="img/n1.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item ">
								<img src="img/n2.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item ">
								<img src="img/n3.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item ">
								<img src="img/n4.jpg" class="d-block w-100" alt="...">
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


<!-- Modal edicion informacion -->
<div class="modal fade" id="Informacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edita tu información</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="index.php?pid=<?php echo base64_encode("presentacion/cliente/sesionCliente.php") ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" class="form-control" value="<?php echo $cliente->getNombre() ?>" required>
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" name="apellido" class="form-control" value="<?php echo $cliente->getApellido() ?>" required>
					</div>
					<label>Foto de perfil</label>
					<div class="input-group mb-3">
						<div class="custom-file">
							<input name="foto" type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
							<label class="custom-file-label" for="inputGroupFile01">Imagen</label>
						</div>
					</div>
					<button type="submit" name="editar" class="btn btn-info">Editar</button>
				</form>
				<?php if (isset($_POST["editar"])) { ?>
					<script>
						$('#Informacion').modal('show');
					</script>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						Informacion editada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

</div>

<!-- Modal edicion contraseña-->

<div class="modal fade" id="Clave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edita tu contraseña</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form action="index.php?pid=<?php echo base64_encode("presentacion/cliente/sesionCliente.php") ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Contraseña actual</label>
						<input type="password" name="antigua" class="form-control" value="" required>
					</div>
					<div class="form-group">
						<label>Nueva contraseña</label>
						<input type="password" name="nueva" class="form-control" value="" required>
					</div>
					<button type="submit" name="editarc" class="btn btn-info">Editar</button>
				</form>
				<?php if (isset($_POST["editarc"])) { ?>
					<script>
						$('#Clave').modal('show');
					</script>
					<?php
					if ($error != 0) {
					?>
						<span aria-hidden="false"></span>
						<div class="alert alert alert-danger alert-dismissible fade show" role="alert">
							La contraseña no coincide
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
					<?php
					} else {
					?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Contraseña editada
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</div>

</div>

<!-- Modal Facturas -->
<div class="modal fade" id="Facturas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">TUS COMPRAS</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover table-striped">
					<?php
					$fac = new Factura("","","",$_SESSION["id"]);
					$facts= $fac->consultarTodos();
					?>
					<tr>
						<th>IdFactura</th>
						<th>Fecha</th>
						<th>Valor</th>
					</tr>
					<?php
					
					foreach ($facts as $Actual) {
						echo "<tr>";
						echo "<td>" . $Actual->getIdFactura() . "</td>";
						echo "<td>" . $Actual->getFecha() . "</td>";
						echo "<td>" . $Actual->getValor() . "</td>";
						echo "</tr>";
					}
					?>
				</table>
			</div>
		</div>
	</div>

</div>
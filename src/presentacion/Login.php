
<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="inicio ">

	<div class="container ">
		<div class="row mt-5 mb-5">
			<div class="col-lg-1">

			</div>
			<div class="col-lg-2"></div>

			<div class="col-lg-5 ">
				<div class="card f">
					<div class="card-header text-white">
						<h4>Inicio de sesion</h4>
					</div>
					<div class="card-body ">
						<form action="index.php?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>" method="post">
							<div class="form-group">
								<input name="correoi" type="email" class="form-control" placeholder="Correo" required>
							</div>
							<div class="form-group">
								<input name="clave" type="password" class="form-control" placeholder="Clave" required>
							</div>
							<div class="form-group">
								<input name="ingresar" type="submit" class="form-control btn bg-dark btn-dark">
							</div>
							<?php
							if (isset($_GET["error"]) && $_GET["error"] == 1) {
								echo "<div class=\"alert alert-danger\" role=\"alert\">Error de correo o clave</div>";
							} else if (isset($_GET["error"]) && $_GET["error"] == 2) {
								echo "<div class=\"alert alert-danger\" role=\"alert\">Su cuenta no ha sido activada</div>";
							} else if (isset($_GET["error"]) && $_GET["error"] == 3) {
								echo "<div class=\"alert alert-danger\" role=\"alert\">Su cuenta ha sido inhabilitada</div>";
							}
							?>
						</form>
						<p>¿Eres nuevo? <a href="index.php?pid=<?php echo base64_encode("presentacion/Registro.php")?>">Registrate</a></p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
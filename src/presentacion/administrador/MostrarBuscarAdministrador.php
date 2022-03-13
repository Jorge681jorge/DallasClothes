
<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-5">
	<div class="row">
		<div class="col-lg-3 col-md-0"></div>
		<div class="col-lg-12 col-md-12">
			<div class="card f">
				<div class="card-header text-white ">
					<h4>Listado Administradores</h4>
				</div>
				<div class="card-body">
					<input type="text" id="filtro" name="filtro" class="form-control"
						placeholder="Palabra clave">
						
						<div id="resultados"></div>							
						
				</div>

				<div class="card-footer ">
						
				<div class="row">	
						<div class="col-lg-3 " name="cantidad">						
						<select id="cantidad" name="cantidad" class="form-control">
						<option value="5">Mostrar de a 5</option>
						<option value="10">Mostrar de a 10</option>
						<option value="15">Mostrar de a 15</option>
						<option value="20">Mostrar de a 20</option>
						</select>
						</div>

						<div class="col-lg-2 ">												
						<input type="number" min="1" id="paginaN" name="paginaN" class="form-control"
						placeholder="No. Pagina">
						</div>						
					
												
				</div>		

				</div>

			</div>
		</div>
	</div>
</div>

<script>
	
	var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/administrador/MostrarBuscarAdministradorAjax.php")?>";
    $("#resultados").load(url);

$(document).ready(function(){ 

	

    $("#filtro").keyup(function() {
		if($(this).val().length >= 1){  	
				var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/administrador/MostrarBuscarAdministradorAjax.php")?>&filtro="+ $("#filtro").val();
    			$("#resultados").load(url);	
		}else{
			var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/administrador/MostrarBuscarAdministradorAjax.php")?>";
    		$("#resultados").load(url);
		}	    	    
    });
	
		$("#cantidad").on("change", function() {
			var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/administrador/MostrarBuscarAdministradorAjax.php")?>&cantidad=" + $(this).val(); 	
			$("#resultados").load(url);
		});

		$("#paginaN").on("change",function() {
			if($(this).val()>= 1){
			var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/administrador/MostrarBuscarAdministradorAjax.php")?>&pagina=" + $(this).val()+"&cantidad=" + $(cantidad).val(); 	
			$("#resultados").load(url);
			}		
		});
		$("#paginaN").keyup(function() {
			if($(this).val()>= 1){
			var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/administrador/MostrarBuscarAdministradorAjax.php")?>&pagina=" + $(this).val()+"&cantidad=" + $(cantidad).val(); 	
			$("#resultados").load(url);
			}

			});

});
</script>   


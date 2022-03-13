
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
					<input type="text" id="filtro" name="filtro" class="form-control"
						placeholder="Palabra clave">
				</div>
			</div>
		</div>
	</div>
</div>
<div id="resultados"></div>
<script>
$(document).ready(function(){
    $("#filtro").keyup(function() {
        if($(this).val().length >= 3){  
			
			if("<?php echo $_SESSION["rol"]?>"=='Proveedor'){
				var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/buscarProductoAjax.php") ?>&id=<?php echo $_SESSION["id"]?>&filtro=" + $(this).val();
    			$("#resultados").load(url);
			}else{
				var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/producto/buscarProductoAjax.php") ?>&filtro=" + $(this).val();
    			$("#resultados").load(url);
			}
	    	
        }
    });
});
</script> 
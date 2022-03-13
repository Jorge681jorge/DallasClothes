<?php

require_once "logica/Administrador.php";

$cantidad = 5;
if(isset($_GET["cantidad"])){
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if(isset($_GET["pagina"])){
	$pagina = $_GET["pagina"];		
}
	
$administrador = new Administrador();	

if(isset($_GET["filtro"])){
	$administradores = $administrador -> consultarPaginacionFiltro($cantidad, $pagina,$_GET["filtro"] );

}else{
	$administradores = $administrador -> consultarPaginacion($cantidad, $pagina);
}


?>

<!DOCTYPE html> 
<html>
	
    <div class="card-body">	

	<div style="overflow-x: scroll;">
					<table class="table table-hover table-striped">
						<tr>							
							<th>ID</th>
							<th>Nombre</th>
							<th>apellido</th>
							<th>correo</th>															
							
						</tr>
						<?php 	$i=1;	
						    foreach($administradores as $administradoresActual) {

								?>
									<tr class="table-row" id="table-row-<?php echo  $administradoresActual -> getIdAdministrador(); ?>">
										
										<td contenteditable="false" onBlur="saveToDatabase(this,'idAdministrador','<?php echo $administradoresActual -> getIdAdministrador(); ?>')" onClick="editRow(this);"><?php echo $administradoresActual -> getIdAdministrador(); ?></td>      																	
										<td contenteditable="true" onBlur="saveToDatabase(this,'nombre','<?php echo   $administradoresActual -> getIdAdministrador(); ?>')" onClick="editRow(this);"><?php echo $administradoresActual -> getNombre(); ?></td>										
										<td contenteditable="true" onBlur="saveToDatabase(this,'apellido','<?php echo  $administradoresActual -> getIdAdministrador(); ?>')" onClick="editRow(this);"><?php echo $administradoresActual -> getApellido(); ?></td>
										<td contenteditable="false" onBlur="saveToDatabase(this,'correo','<?php echo  $administradoresActual -> getIdAdministrador(); ?>')" onClick="editRow(this);"><?php echo $administradoresActual -> getCorreo(); ?></td>														
									</tr>
								<?php								
							$i++;
						}
						?>
					</table>
	</div>
							<?php 
							$totalRegistros = $i-1;

							$totalPaginas = intval($totalRegistros/$cantidad);

							if($totalRegistros%$cantidad != 0 || $totalRegistros%$cantidad == 0){
								$totalPaginas++;
							}
							if($totalPaginas<$pagina){
									$pagina=$totalPaginas;
							}
							$ultimaPagina = ($totalPaginas == $pagina); 

							?>
					<div class="text-right">Resultados <?php echo (($pagina-1)*$cantidad+1) ?> al <?php echo (($pagina-1)*$cantidad)+count($administradores) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
					<div class="text-center">
        				<nav>
        					<ul class="pagination">        						
        						<?php 
        						for($i=1; $i<=$totalPaginas; $i++){
        						    if($i==$pagina){
        						        echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
        						    }else{
        						        echo "<li class='page-item'><a class='page-link' '>" . $i . "</a></li>";
        						    }        						            						    
        						}        						
        						?>        						
        					</ul>
        				</nav>
					</div>
					

	</div>

	



<script type="text/javascript" src="js/jquery.min.js"></script>
		
        	
<script>	
			
		function editRow(editableObj) {
			$(editableObj).css("background","#FFF");
			
		}			

		function saveToDatabase(editableObj,column,id) {			
		$(editableObj).css("background","#FFF url(cargando.gif) no-repeat right");
		$.ajax({
			url: "editar.php",
			type: "POST",
			data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id+'&rol=administrador',
			success: function(data){				
			$(editableObj).css("background","#FDFDFD");
			}
		});
		}				
		
</script>




</html>
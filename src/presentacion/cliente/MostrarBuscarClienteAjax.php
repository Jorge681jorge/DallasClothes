<?php

require_once "logica/Cliente.php";

$cantidad = 5;
if(isset($_GET["cantidad"])){
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if(isset($_GET["pagina"])){
	$pagina = $_GET["pagina"];		
}
	
$cliente = new Cliente();	
/*
$filtro="";
if(isset($_GET["filtro"])){
	$totalRegistros = $cliente -> consultarCantidadFiltro($_GET["filtro"]);

}else{
	$totalRegistros = $cliente -> consultarCantidad();
}

$totalPaginas = intval($totalRegistros/$cantidad);

if($totalRegistros%$cantidad != 0 || $totalRegistros%$cantidad == 0){
    $totalPaginas++;
}
if($totalPaginas<$pagina){
		$pagina=$totalPaginas;
}
$ultimaPagina = ($totalPaginas == $pagina); 
*/
if(isset($_GET["filtro"])){
	$clientes = $cliente -> consultarPaginacionFiltro($cantidad, $pagina,$_GET["filtro"] );

}else{
	$clientes = $cliente -> consultarPaginacion($cantidad, $pagina);
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
							<!--<th>Estado</th>								-->
							<th>estado</th>
							
						</tr>
						<?php 	$i=1;	
						    foreach($clientes as $clientesActual) {

								?>
									<tr class="table-row" id="table-row-<?php echo  $clientesActual -> getIdCliente(); ?>">
										
										<td contenteditable="false" onBlur="saveToDatabase(this,'idCliente','<?php echo $clientesActual -> getIdCliente(); ?>')" onClick="editRow(this);"><?php echo $clientesActual -> getIdCliente(); ?></td>      																	
										<td contenteditable="true" onBlur="saveToDatabase(this,'nombre','<?php echo   $clientesActual -> getIdCliente(); ?>')" onClick="editRow(this);"><?php echo $clientesActual -> getNombre(); ?></td>										
										<td contenteditable="true" onBlur="saveToDatabase(this,'apellido','<?php echo  $clientesActual -> getIdCliente(); ?>')" onClick="editRow(this);"><?php echo $clientesActual -> getApellido(); ?></td>
										<td contenteditable="false" onBlur="saveToDatabase(this,'correo','<?php echo  $clientesActual -> getIdCliente(); ?>')" onClick="editRow(this);"><?php echo $clientesActual -> getCorreo(); ?></td>				
										<th id="tabla<?php echo $i?>" >																														
													<div id='icono<?php echo $i;?>'> </div>
												<!---<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('1','<?php echo  $clientesActual -> getIdCliente(); ?>')"   <?php echo ($clientesActual -> getEstado()==1)?"checked":"" ?>>
													<label class="form-check-label" for="inlineRadio1">Activado    <?php echo ($clientesActual -> getEstado()==1)?"'<span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span>'":"" ?>    </label>
													</div>
													<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('0','<?php echo  $clientesActual -> getIdCliente(); ?>')"   <?php echo ($clientesActual -> getEstado()==0)?"checked":"" ?>>
													<label class="form-check-label" for="inlineRadio2">Inhabilitado</label>
													</div>
													<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('-1','<?php echo  $clientesActual -> getIdCliente(); ?>')"   <?php echo ($clientesActual -> getEstado()==-1)?"checked":"" ?>>
													<label class="form-check-label" for="inlineRadio3">No Activado</label>
												</div>--->
											<?php 		
											
											if($clientesActual -> getEstado()==1){?>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('1','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)" <?php echo ($clientesActual -> getEstado()==1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('0','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)"   <?php echo ($clientesActual -> getEstado()==0)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'></span> </label>
												</div>
											
											<?php
											}elseif($clientesActual -> getEstado()==0){?>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('1','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)"   <?php echo ($clientesActual -> getEstado()==1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('0','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)"   <?php echo ($clientesActual -> getEstado()==0)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'></span> </label>
												</div>
											
											<?php
											}elseif($clientesActual -> getEstado()==-1){?>
												<div class='form-check form-check-inline'>  
												<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('-1','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)"   <?php echo ($clientesActual -> getEstado()==-1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-user-clock' data-toggle='tooltip' data-placement='left' title='Registrado Pero sin Activar'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('1','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)"   <?php echo ($clientesActual -> getEstado()==1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $clientesActual -> getIdCliente(); ?>"   onclick="hacer_click('0','<?php echo  $clientesActual -> getIdCliente(); ?>',tabla<?php echo $i?>)"   <?php echo ($clientesActual -> getEstado()==0)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'></span> </label>
												</div>
											
											<?php
											}else{ echo "<span class='fas fa-question-circle' data-toggle='tooltip' data-placement='left' title='Estado Diferente'>". $clientesActual -> getEstado() ."</span>";
											}																		
											?>								
															
										</th>
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
					<div class="text-right">Resultados <?php echo (($pagina-1)*$cantidad+1) ?> al <?php echo (($pagina-1)*$cantidad)+count($clientes) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
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
			data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id+'&rol=Cliente',
			success: function(data){				
			$(editableObj).css("background","");
			}
		});
		}		

		function hacer_click(estado,id,editableObj){
			$(editableObj).css("background","#FFF url(cargando.gif) no-repeat right");
						$.ajax({
							url: "editar.php",
							type: "POST",
							data:'column='+'estado'+'&editval='+estado+'&id='+id+'&rol=Cliente',
							success: function(data){		
								$(editableObj).css("background","");								
							}
						});
    }	
		
</script>



</html>
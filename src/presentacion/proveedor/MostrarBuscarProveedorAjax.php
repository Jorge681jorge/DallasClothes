<?php

require_once "logica/Proveedor.php";



$cantidad = 5;
if(isset($_GET["cantidad"])){
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if(isset($_GET["pagina"])){
	$pagina = $_GET["pagina"];		
}
	
$proveedor = new Proveedor();	

$filtro="";

if(isset($_GET["filtro"])){
	$proveedores = $proveedor -> consultarPaginacionFiltro($cantidad, $pagina,$_GET["filtro"] );

}else{
	$proveedores = $proveedor -> consultarPaginacion($cantidad, $pagina);
}


?>

<!DOCTYPE html> 
<html>

	
    <div class="card-body">	
	<div style="overflow-x: scroll;">
	<div class="text-right"> Definicion Estados : <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'>Usuario Habilitado</span> -  <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'>Usuario Inhabilitado </span> - <span class='fas fa-user-clock' data-toggle='tooltip' data-placement='left' title='Registrado Pero sin Activar'>Usuario Reg. Pero No Activado</span> - <span class='fas fa-question-circle' data-toggle='tooltip' data-placement='left' title='Estado Diferente'>Estado Diferente</span> </div>
	<br>
					<table class="table table-hover table-striped">
						<tr>							
							<th>ID</th>
							<th>Nombre</th>
							<th>apellido</th>
							<th>correo</th>	
							<th>Estado</th>								
							
						</tr>
						<?php 	
						$i=1;	
						    foreach($proveedores as $proveedoresActual) {

								?>
									<tr class="table-row" id="table-row-<?php echo  $proveedoresActual -> getId(); ?>">
										
										<td contenteditable="false" onBlur="saveToDatabase(this,'idproveedor','<?php echo $proveedoresActual -> getId(); ?>')" onClick="editRow(this);"><?php echo $proveedoresActual -> getId(); ?></td>      																				
										<td contenteditable="true" onBlur="saveToDatabase(this,'nombre','<?php echo   $proveedoresActual -> getId(); ?>')" onClick="editRow(this);"><?php echo $proveedoresActual -> getNombre(); ?></td>									
										<td contenteditable="true" onBlur="saveToDatabase(this,'apellido','<?php echo  $proveedoresActual -> getId(); ?>')" onClick="editRow(this);"><?php echo $proveedoresActual -> getApellido(); ?></td>
										<td contenteditable="false" onBlur="saveToDatabase(this,'correo','<?php echo  $proveedoresActual -> getId(); ?>')" onClick="editRow(this);"><?php echo $proveedoresActual -> getCorreo(); ?></td>				
										<th id="tabla<?php echo $i?>" >																														
													<div id='icono<?php echo $i;?>'> </div>
												<!---<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('1','<?php echo  $proveedoresActual -> getId(); ?>')"   <?php echo ($proveedoresActual -> getEstado()==1)?"checked":"" ?>>
													<label class="form-check-label" for="inlineRadio1">Activado    <?php echo ($proveedoresActual -> getEstado()==1)?"'<span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span>'":"" ?>    </label>
													</div>
													<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('0','<?php echo  $proveedoresActual -> getId(); ?>')"   <?php echo ($proveedoresActual -> getEstado()==0)?"checked":"" ?>>
													<label class="form-check-label" for="inlineRadio2">Inhabilitado</label>
													</div>
													<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('-1','<	?php echo  $proveedoresActual -> getId(); ?>')"   <?php echo ($proveedoresActual -> getEstado()==-1)?"checked":"" ?>>
													<label class="form-check-label" for="inlineRadio3">No Activado</label>
												</div>--->
											<?php 		
											
											if($proveedoresActual -> getEstado()==1){?>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('1','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)" <?php echo ($proveedoresActual -> getEstado()==1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('0','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)"   <?php echo ($proveedoresActual -> getEstado()==0)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'></span> </label>
												</div>
											
											<?php
											}elseif($proveedoresActual -> getEstado()==0){?>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('1','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)"   <?php echo ($proveedoresActual -> getEstado()==1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('0','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)"   <?php echo ($proveedoresActual -> getEstado()==0)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'></span> </label>
												</div>
											
											<?php
											}elseif($proveedoresActual -> getEstado()==-1){?>
												<div class='form-check form-check-inline'>  
												<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('-1','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)"   <?php echo ($proveedoresActual -> getEstado()==-1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-user-clock' data-toggle='tooltip' data-placement='left' title='Registrado Pero sin Activar'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('1','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)"   <?php echo ($proveedoresActual -> getEstado()==1)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span> </label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="radio" name="inLine<?php echo  $proveedoresActual -> getId(); ?>"   onclick="hacer_click('0','<?php echo  $proveedoresActual -> getId(); ?>',tabla<?php echo $i?>)"   <?php echo ($proveedoresActual -> getEstado()==0)?"checked":"" ?>>
													<label class='form-check-label' for='inlineRadio1'> <span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inhabilitar'></span> </label>
												</div>
											
											<?php
											}else{ echo "<span class='fas fa-question-circle' data-toggle='tooltip' data-placement='left' title='Estado Diferente'>". $proveedoresActual -> getEstado() ."</span>";
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

					<div class="text-right">Resultados <?php echo (($pagina-1)*$cantidad+1) ?> al <?php echo (($pagina-1)*$cantidad)+count($proveedores) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
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
			data:'column='+column+'&editval='+$(editableObj).text()+'&id='+id+'&rol=Proveedor',
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
							data:'column='+'estado'+'&editval='+estado+'&id='+id+'&rol=Proveedor',
							success: function(data){		
								//prodriamos poner un alert aqui	
								$(editableObj).css("background","");								
							}
						});
						
    }		
		
</script>




</html>
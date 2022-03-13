<?php
$cliente= new Cliente();
$clientes = $cliente -> consultarTodos();
?>
<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-3">
	<div class="row">
		<div class="col">
            <div class="card f">
				<div class="card-header text-white">
					<h4>Consultar Cliente</h4>
				</div>
				<div class="text-right"><?php echo count($clientes) ?> registros encontrados</div>
              	<div class="card-body">
					<table class="table table-hover table-striped table-responsive-md">
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Correo</th>
							<th>Estado</th>
							<th>Servicios</th>
						</tr>
						<?php 
						$i=1;
						foreach($clientes as $clienteActual){
						    echo "<tr>";
						    echo "<td>" . $i . "</td>";
						    echo "<td>" . $clienteActual -> getNombre() . "</td>";
						    echo "<td>" . $clienteActual -> getApellido() . "</td>";
						    echo "<td>" . $clienteActual -> getCorreo() . "</td>";
						    echo "<td>" . (($clienteActual -> getEstado()==1)?"<div id='icono" . $clienteActual -> getIdCliente() . "'><span class='fas fa-check-circle' data-toggle='tooltip' data-placement='left' title='Habilitado'></span></div>":(($clienteActual -> getEstado()==0)?"<div id='icono" . $clienteActual -> getIdCliente() . "'><span class='fas fa-times-circle' data-toggle='tooltip' data-placement='left' title='Deshabilitado'></span></div>":"<span class='fas fa-ban' data-toggle='tooltip' data-placement='left' title='Inactivo'></span>")) . "</td>";						    
						    echo "<td><div id='accion" . $clienteActual -> getIdCliente() . "'><a id='cambiarEstado" . $clienteActual -> getIdCliente() . "' href='#' >" . (($clienteActual -> getEstado()==1)?"<span class='fas fa-user-times' data-toggle='tooltip' data-placement='left' title='Deshabilitar'></span>":(($clienteActual -> getEstado()==0)?"<span class='fas fa-user-check' data-toggle='tooltip' data-placement='left' title='Habilitar'></span>":"")) . "</a>";
						?>  
                        <script>
                        $(document).ready(function(){
                        	$("#cambiarEstado<?php echo $clienteActual -> getIdCliente() ?>").click(function(e){
                        		$('[data-toggle="tooltip"]').tooltip('hide');
                        		var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/cliente/cambiarEstadoClienteAjax.php") ?>&idCliente=<?php echo $clienteActual -> getIdCliente() ?>&nuevoEstado=<?php echo (($clienteActual -> getEstado()==1)?"0":"1")?>";		
                        		$("#icono<?php echo $clienteActual -> getIdCliente() ?>").load(url);
                        		var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/cliente/cambiarEstadoAccionAjax.php") ?>&idCliente=<?php echo $clienteActual -> getIdCliente() ?>&nuevoEstado=<?php echo (($clienteActual -> getEstado()==1)?"0":"1")?>";
                        		$("#accion<?php echo $clienteActual -> getIdCliente() ?>").load(url);
                        	});
                        });
                        </script>
						<?php   						    
						    echo "</div></td>";
						    echo "</tr>";
						    $i++;
						}
						?>
					</table>
				</div>
            </div>
		</div>
	</div>
</div>







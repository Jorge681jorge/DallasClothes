<?php
$producto = new Producto();
$productos = $producto -> consultarTodos();
?>
<div class="container mt-3">
	<div class="row">
		<div class="col">
            <div class="card">
				<div class="card-header text-white bg-info">
					<h4>Consultar Producto</h4>
				</div>
				<div class="text-right"><?php echo count($productos) ?> registros encontrados</div>
              	<div class="card-body">
					<table class="table table-hover table-striped">
						<tr>
							<th>#</th>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th></th>
						</tr>
						<?php 
						$i=1;
						foreach($productos as $productoActual){
						    echo "<tr>";
						    echo "<td>" . $i . "</td>";
						    echo "<td>" . $productoActual -> getNombre() . "</td>";
						    echo "<td>" . $productoActual -> getCantidad() . "</td>";
						    echo "<td>" . $productoActual -> getPrecio() . "</td>";
						    echo "<td><a href='index.php?pid=". base64_encode("presentacion/producto/editarProducto.php") . "&idProducto=" . $productoActual -> getIdProducto(). "' data-toggle='tooltip' data-placement='left' title='Editar'><span class='fas fa-edit'></span></a></td>";
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
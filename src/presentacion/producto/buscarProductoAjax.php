<?php
$filtro = $_GET["filtro"];
$producto = new Producto();
$id = "2"; 
if(isset($_GET["id"])){
	$id = $_GET["id"];    
	$productos = $producto -> consultarFiltroId($filtro,$id);
}else{
	$productos = $producto -> consultarFiltro($filtro);
}
?>
<div class="container mt-3">
	<div class="row">
		<div class="col">
            <div class="card">
				<div class="card-header text-white">
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
							<th>ID Proveedor</th>
							<th></th>
						</tr>
						<?php 
						$i=1;
						foreach($productos as $productoActual){
// 						    $posiciones = array();
// 						    for($i=0; $i<strlen($productoActual -> getNombre())-strlen($filtro)+1; $i++){
// 						        if(strtolower(substr($productoActual -> getNombre(), $i, strlen($filtro))) == strtolower($filtro)){
// 						            array_push($posiciones, $i);
// 						        }
// 						    }
						    $pos = stripos($productoActual -> getNombre(), $filtro);
						    echo "<tr>";
						    echo "<td>" . $i . "</td>";
						    if($pos === false){
						        echo "<td>" . $productoActual -> getNombre() . "</td>";						        
						    }else{						        
						        echo "<td>" . substr($productoActual -> getNombre(), 0, $pos) . "<mark><strong>" . substr($productoActual -> getNombre(), $pos, strlen($filtro)) . "</strong></mark>" . substr($productoActual -> getNombre(), $pos+strlen($filtro)) . "</td>";
							}

							
						        echo "<td>" . $productoActual -> getCantidad() . "</td>";
						    						    

							$pos = stripos($productoActual -> getPrecio(), $filtro);
							if($pos === false){
						        echo "<td>" . $productoActual -> getPrecio() . "</td>";
						    }else{						        
						        echo "<td>" . substr($productoActual -> getPrecio(), 0, $pos) . "<mark><strong>" . substr($productoActual -> getPrecio(), $pos, strlen($filtro)) . "</strong></mark>" . substr($productoActual -> getPrecio(), $pos+strlen($filtro)) . "</td>";
							}
							
							$pos = stripos($productoActual -> getidProveedor(), $filtro);
							if($pos === false){
						        echo "<td>" . $productoActual -> getidProveedor() . "</td>";
						    }else{						        
						        echo "<td>" . substr($productoActual -> getidProveedor(), 0, $pos) . "<mark><strong>" . substr($productoActual -> getidProveedor(), $pos, strlen($filtro)) . "</strong></mark>" . substr($productoActual -> getidProveedor(), $pos+strlen($filtro)) . "</td>";
							}
							
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


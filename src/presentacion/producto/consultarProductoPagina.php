<?php
if(isset($_GET["a"])){
	$a=$_GET["a"];
}
if(isset($_GET["t"])){
	$t=$_GET["t"];
}else{
	$t=0;
}
$producto = new Producto();
$cantidad = 5;
if(isset($_GET["cantidad"])){
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if(isset($_GET["pagina"])){
    $pagina = $_GET["pagina"];
}

if($_SESSION["rol"]=="Proveedor"){
	$productos = $producto -> consultarPaginacionId($cantidad, $pagina, $_SESSION["id"]);
	$totalRegistros = $producto -> consultarCantidadId($_SESSION["id"]);
}
else{
	$productos = $producto -> consultarPaginacion($cantidad, $pagina);
	$totalRegistros = $producto -> consultarCantidad();
}

$totalPaginas = intval($totalRegistros/$cantidad);
if($totalRegistros%$cantidad != 0 || $totalRegistros%$cantidad == 0){
    $totalPaginas++;
}
$ultimaPagina = ($totalPaginas == $pagina); 
?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-5">
	<div class="row">
		<div class="col">
            <div class="card f">
				<div class="card-header text-white ">
					<h4>Consultar Producto</h4>
				</div>
				<div class="text-right">Resultados <?php echo (($pagina-1)*$cantidad+1) ?> al <?php echo (($pagina-1)*$cantidad)+count($productos) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
              	<div class="card-body">
				  <div style="overflow-x: scroll;">
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
						    echo "<tr>";
						    echo "<td>" . $i . "</td>";
						    echo "<td>" . $productoActual -> getNombre() . "</td>";
						    echo "<td>" . $productoActual -> getCantidad() . "</td>";
							echo "<td>" . $productoActual -> getPrecio() . "</td>";
							echo "<td>" . $productoActual -> getidProveedor() . "</td>";
						    echo "<td><a href='index.php?pid=". base64_encode("presentacion/producto/editarProducto.php") . "&idProducto=" . $productoActual -> getIdProducto(). "&a=".$a."&t=".$t."' data-toggle='tooltip' data-placement='left' title='Editar'><span class='fas fa-edit'></span></a></td>";
						    echo "</tr>";
						    $i++;
						}
						?>
					</table>
					</div>
					<div class="text-center">
        				<nav>
        					<ul class="pagination">
        						<li class="page-item <?php echo ($pagina==1)?"disabled": ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("presentacion/producto/consultarProductoPagina.php") . "&pagina=" . ($pagina-1) . "&cantidad=" . $cantidad."&a=".$a."&t=".$t ?>"> &lt;&lt; </a></li>
        						<?php 
        						for($i=1; $i<=$totalPaginas; $i++){
        						    if($i==$pagina){
        						        echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
        						    }else{
        						        echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/producto/consultarProductoPagina.php") . "&pagina=" . $i . "&cantidad=" . $cantidad ."&a=".$a."&t=".$t."'>" . $i . "</a></li>";
        						    }        						            						    
        						}        						
        						?>
        						<li class="page-item <?php echo ($ultimaPagina)?"disabled": ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("presentacion/producto/consultarProductoPagina.php") . "&pagina=" . ($pagina+1) . "&cantidad=" . $cantidad ."&a=".$a."&t=".$t?>"> &gt;&gt; </a></li>
        					</ul>
        				</nav>
					</div>
					<select id="cantidad" >
						<option value="5" <?php echo ($cantidad==5)?"selected":"" ?>>5</option>
						<option value="10" <?php echo ($cantidad==10)?"selected":"" ?>>10</option>
						<option value="15" <?php echo ($cantidad==15)?"selected":"" ?>>15</option>
						<option value="20" <?php echo ($cantidad==20)?"selected":"" ?>>20</option>
					</select>
				</div>
            </div>
		</div>
	</div>
</div>

<script>
$("#cantidad").on("change", function() {
	url = "index.php?pid=<?php echo base64_encode("presentacion/producto/consultarProductoPagina.php")."&a=".$a."&t=".$t ?>&cantidad=" + $(this).val(); 	
	location.replace(url);
});
</script>

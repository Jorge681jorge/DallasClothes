<?php
if (isset($_GET["idP"])) {
    $idP = $_GET["idP"];
    $vec = preg_split("'/'", $idP . "/");
    $prod = new FacturaProducto("", "", "", $vec[1], $vec[0]);
    
    $factura = new Factura($vec[1]);
    $precio = 0;
    $prod->consultar();
    
    $p = new Producto($vec[0]);
    $p->consultar();
    $valor = $prod->getCantidad();
    if (($vec[2] == "menos") && ($prod->getCantidad() != 1)) {
        $valor = ($prod->getCantidad() - 1);
    } else if (($vec[2] == "mas") && ($prod->getCantidad() < $p->getCantidad())) {
        $valor = ($prod->getCantidad() + 1);
    }
    $proded = new FacturaProducto("", $valor, $p->getPrecio() * $valor, $vec[1], $vec[0]);
    $proded->editar();
    $productos = $prod->consultarTodos();
    foreach ($productos as $productoActual) {
        $precio = $precio + $productoActual->getPrecio();
    }
}
if (isset($_GET["f"])) {
    if ($_GET["f"]=="2") {
        echo ($precio == 0) ? "<h1> Aun no tienes productos :( </h1><div style='height: 400px;'></div>" : "<div id='total'><h4>Valor acumulado de tu factura: $" . $precio . "</h4></div>";
    } else {
        ?>

<div>
    <b>Cantidad: </b>
    <div class="row">
        <?php
        echo "<div class='col-lg-5'>" . $proded->getCantidad() . "</div>";
        echo "<div><button id='" . $proded->getIdProducto() . "/" . $vec[1] . "/menos' type='submit' class='btn btn-dark'><i class='fas fa-minus-circle'></i></button>";
        echo "<button id='" . $proded->getIdProducto() . "/" . $vec[1] . "/mas' type='submit' class='btn btn-dark'><i class='fas fa-plus-circle'></i></button></div>"; ?>
    </div>

    <b>Valor total:</b><br>
    <?php
    echo "<div >$ " . $proded->getPrecio() . "</div>"; ?>
</div>
<?php
    }
}
?>
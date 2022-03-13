<?php
$factura = new Factura("", "", "", $_SESSION["id"]);
if (isset($_GET["id"])) {
    $factura->consultar();
    $f = new FacturaProducto("", "", "", $factura->getIdFactura(), $_GET["id"]);
    $f->Eliminar();
}
$precio = 0;
if ($factura->consultarCantidad() != 0) {
    $factura->consultar();
    $f = new FacturaProducto("", "", "", $factura->getIdFactura(), "");
    $productos = $f->consultarTodos();

    foreach ($productos as $productoActual) {
        $precio = $precio + $productoActual->getPrecio();
    }
}
if (isset($_GET["c"])) {
    $f = new FacturaProducto("", "", "", $factura->getIdFactura(), "");
    $productos = $f->consultarTodos();

    foreach ($productos as $productoActual) {
        $prod = new Producto($productoActual->getIdProducto());
        $prod->consultar2();
        $prod = new Producto(
            $prod->getIdProducto(),
            $prod->getNombre(),
            $prod->getCantidad() - $productoActual->getCantidad(),
            $prod->getPrecio(),
            $prod->getidProveedor(),
            $prod->getFoto(),
            $prod->getFoto2(),
            $prod->getFoto3()
        );
        $prod->editar();
    }
    $factura->consultar();
    $factura = new Factura($factura->getIdFactura(), "", $precio);
    $factura->Comprar();
    $cliente = new Cliente($_SESSION["id"]);
    $cliente->consultar();
    $log = new Log("", "Compra", "Factura numero: " . $factura->getIdFactura(), "", "", $cliente->getCorreo());
    $log->insertar();

    $pdf = new PDF();
    $pdf->generar($factura->getIdFactura(), $_SESSION["id"]);
    echo "<script>window.open('factura.pdf', '_blank');</script>";
}
?>

<body style="background-image: url(img/fondo.jpg); background-size: cover;"></body>
<div class="container mt-3">

    <div class="card">
        <div class="card-header text-white">
            <h2>Tus productos</h2>
        </div>
        <div class="card-body">
            <div>
                <?php
                echo ($precio == 0) ? "<h1> Aun no tienes productos :( </h1><div style='height: 400px;'></div>" : "<div id='total'><h4>Valor acumulado de tu factura: $" . $precio . "</h4></div>";
                ?>

            </div>
            <div class="row">
                <?php
                if (isset($_GET["c"])) {
                    echo "<div class='col-lg-3'></div>";
                    echo "<div class='col-lg-6'><h1> Gracias por tu compra </h1></div>";
                } else if ($factura->consultarCantidad() != 0) {

                    foreach ($productos as $productoActual) {
                        $prod = new Producto($productoActual->getIdProducto());
                        $prod->consultar2();
                ?>

                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class='card mt-3'>
                                <div class='card-header text-white'>
                                    <h5><?php echo strtoupper($prod->getNombre()) ?></h5>
                                </div>

                                <div class='row'>
                                    <div class='col-lg-6 col-sm-11 mt-3  col-11'>

                                        <div id='carouselExampleSlidesOnly' class='carousel slide ml-3' data-ride='carousel'>
                                            <div class='carousel-inner'>
                                                <div class='carousel-item active'>
                                                    <?php echo "<img src='" . "imgProd/" . $prod->getIdProducto() . "/" . $prod->getFoto() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>"; ?>
                                                </div>
                                                <div class='carousel-item'>
                                                    <?php echo "<img src='" . "imgProd/" . $prod->getIdProducto() . "/" . $prod->getFoto2() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>"; ?>
                                                </div>
                                                <div class='carousel-item'>
                                                    <?php echo "<img src='" . "imgProd/" . $prod->getIdProducto() . "/" . $prod->getFoto3() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>"; ?>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-lg-5 col-11 mt-3'>
                                        <div style="font-size: 18px; text-align: left;">

                                            <b>Valor unidad:</b><br>
                                            <?php
                                            echo "<div id='valor'> $ " . $prod->getPrecio() . "</div>"; 
                                            echo "<div id=cantidad>";
                                            echo "<div id='cantidad". $productoActual->getIdProducto()."'>"
                                            ?>
                                            
                                                <b>Cantidad: </b>
                                                <div class="row">
                                                    <?php
                                                    echo "<div class='col-lg-5 col-md-4 col-sm-4 col-4'>" . $productoActual->getCantidad() . "</div>";
                                                    echo "<div><button id='" . $prod->getIdProducto() . "/" . $factura->getIdFactura() ."/menos' type='submit' class='btn btn-dark'><i class='fas fa-minus-circle'></i></button>";
                                                    echo "<button id='" . $prod->getIdProducto() . "/" . $factura->getIdFactura() . "/mas' type='submit' class='btn btn-dark'><i class='fas fa-plus-circle'></i></button></div>";
                                                    ?>
                                                </div>

                                                <b>Valor total:</b><br>
                                                <?php
                                                echo "<div >$ " . $productoActual->getPrecio() . "</div></div>"; ?>
                                            </div>
                                            <div class="m-2">
                                                <form action="index.php?pid=<?php echo base64_encode("presentacion/carrito.php") . "&id=" . $prod->getIdProducto() ?>" method="post">
                                                    <button type="submit" class="btn btn-dark"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="card-footer">
            <?php
            if (($precio != 0)&&(!isset($_GET["c"]))) {
            ?>
                <form action="index.php?pid=<?php echo base64_encode("presentacion/carrito.php") . "&c=1" ?>" method="post">
                    <button type="submit" class="btn btn-dark">Comprar <i class="fas fa-shopping-cart"></i></button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>


</div>

<script>
    $(document).ready(function() {
        $('body #cantidad').on('click', 'button', function() {
            var n = ($(this).attr('id') + "/").split("/");
            //alert(n[0]+" "+$(this).attr('id'));
            //alert(+n[0]);
            var url = "indexAjax.php?pid=<?php echo base64_encode("presentacion/carritoAjax.php") ?>&idP=" + $(this).attr('id')+"&f=1";
            var url2 = "indexAjax.php?pid=<?php echo base64_encode("presentacion/carritoAjax.php") ?>&idP=" + $(this).attr('id')+"&f=2";
            $("#cantidad"+n[0]).load(url);
            $("#total").load(url2);
        })
    })
</script>
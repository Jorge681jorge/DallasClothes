<?php
$filtro = $_GET["filtro"];
$producto = new Producto();
$cantidad = 6;
if (isset($_GET["cantidad"])) {
    $cantidad = $_GET["cantidad"];
}
$pagina = 1;
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}
$productos = $producto->consultarPaginacionFiltro($cantidad, $pagina, $filtro);
$totalRegistros = $producto->consultarCantidad2($filtro);
$totalPaginas = intval($totalRegistros / $cantidad);

if ($totalRegistros % $cantidad != 0) {
    $totalPaginas++;
}
$ultimaPagina = ($totalPaginas == $pagina);


$idP = "";
if (isset($_GET["idP"])) {
    $idP = $_GET["idP"];
    $productoModal = new Producto($idP);
    $productoModal->consultar2();
    $productosModal = $productoModal->consultarFiltro2($filtro);
?>

    <script>
        $(document).ready(function() {
            $("#myModal").modal("show");
        });
    </script>

<?php
}
if (isset($_POST["agregar"])) {
?>
    <script>
        $(document).ready(function() {
            $("#myModal").modal("hide");
        });
    </script>
<?php
    if (isset($_GET["idProd"])) {
        $tiempo = new DateTime();
        $t = $tiempo->getTimestamp();
        $factura = new Factura("", "", "", $_SESSION["id"]);
        if ($factura->consultarCantidad() != 0) {
            $factura->consultar();
        } else {
            $factura = new Factura($t, "", "", $_SESSION["id"]);
            $factura->insertar();
        }

        $idprod = $_GET["idProd"];
        $producto = new Producto($idprod);
        $producto->consultar2();
        $f = new FacturaProducto("", "", "", $factura->getIdFactura(), "");
        $produc = $f->consultarTodos();
        $x = true;
        foreach ($produc as $actual) {
            if ($producto->getIdProducto() == $actual->getIdProducto()) {
                $x = false;
            }
        }
        if ($x) {
            $facP = new FacturaProducto("", $_POST["cantidad"], $producto->getPrecio() * $_POST["cantidad"], $factura->getIdFactura(), $producto->getIdProducto());
            $facP->insertar();
        }
    }
}
?>

<body style="background-image: url(img/fondo2.jpg); background-size: cover;"></body>
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <?php if (isset($_POST["agregar"])) {
                if ($x) {
            ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Producto agregado al carrito
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php } else {
                ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        El producto ya ha sido agregado al carrito anteriormente
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
            <?php
                }
            } ?>
            <div class="card f">
                <div class="card-header text-white ">
                    <h4>Productos</h4>
                </div>

                <div class="text-right">Resultados <?php echo (($pagina - 1) * $cantidad + 1) ?> al <?php echo (($pagina - 1) * $cantidad) + count($productos) ?> de <?php echo $totalRegistros ?> registros encontrados</div>
                <div class="card-body">
                    <div class="row">
                        <?php

                        foreach ($productos as $productoActual) {
                            if (!empty($productoActual->getFoto())) {

                                echo "<div class='col-lg-2 col-md-3 col-sm-4 mt-3' >";
                                echo "<div id='padre' >";
                                echo strtoupper($productoActual->getNombre());
                                echo "<img src='" . "imgProd/" . $productoActual->getIdProducto() . "/" . $productoActual->getFoto() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>";
                                echo "<div class='texto-en-imagen'>";

                                echo "<a id=enlace href='index.php?pid=" . base64_encode("presentacion/producto/mostrarProd.php") . "&idP=" . $productoActual->getIdProducto() . "&pagina=" . $pagina . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>$" . $productoActual->getPrecio() . "</a></div> </div> </div>";
                            }
                        }
                        ?>

                    </div>
                    <div class="text-center mt-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item <?php echo ($pagina == 1) ? "disabled" : ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("presentacion/producto/mostrarProd.php") . "&pagina=" . ($pagina - 1) . "&cantidad=" . $cantidad . "&filtro=" . $filtro ?>"> &lt;&lt; </a></li>
                                        <?php
                                        for ($i = 1; $i <= $totalPaginas; $i++) {
                                            if ($i == $pagina) {
                                                echo "<li class='page-item active' aria-current='page'><span class='page-link'>" . $i . "<span class='sr-only'></span></span></li>";
                                            } else {
                                                echo "<li class='page-item'><a class='page-link' href='index.php?pid=" . base64_encode("presentacion/producto/mostrarProd.php") . "&pagina=" . $i . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>" . $i . "</a></li>";
                                            }
                                        }
                                        ?>
                                        <li class="page-item <?php echo ($ultimaPagina) ? "disabled" : ""; ?>"><a class="page-link" href="<?php echo "index.php?pid=" . base64_encode("presentacion/producto/mostrarProd.php") . "&pagina=" . ($pagina + 1) . "&cantidad=" . $cantidad . "&filtro=" . $filtro ?>"> &gt;&gt; </a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-lg-2" style="text-align: right;">
                                <h6>Productos por página</h6>
                            </div>
                            <div class="col-lg-2">

                                <select id="cantidad" class="custom-select">
                                    <option value="6" <?php echo ($cantidad == 6) ? "selected" : "" ?>>6</option>
                                    <option value="12" <?php echo ($cantidad == 12) ? "selected" : "" ?>>12</option>
                                    <option value="18" <?php echo ($cantidad == 18) ? "selected" : "" ?>>18</option>
                                    <option value="24" <?php echo ($cantidad == 24) ? "selected" : "" ?>>24</option>
                                </select>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $("#cantidad").on("change", function() {
        url = "index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php") . "&filtro=" . $filtro ?>&cantidad=" + $(this).val();
        location.replace(url);
    });
</script>



<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-3 mt-4 ml-4">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <?php
                                        echo "<img src='" . "imgProd/" . $productoModal->getIdProducto() . "/" . $productoModal->getFoto() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>";
                                        ?>
                                    </div>
                                    <div class="carousel-item ">
                                        <?php
                                        echo "<img src='" . "imgProd/" . $productoModal->getIdProducto() . "/" . $productoModal->getFoto2() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>";
                                        ?>
                                    </div>
                                    <div class="carousel-item ">
                                        <?php
                                        echo "<img src='" . "imgProd/" . $productoModal->getIdProducto() . "/" . $productoModal->getFoto3() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>";
                                        ?>
                                    </div>

                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-8  mt-3 ml-3">

                            <div class="card">
                                <div class="card-header text-white">
                                    <h4><?php
                                        echo strtoupper($productoModal->getNombre());
                                        ?></h4>
                                </div>
                                <div class="card-body" style="text-align: left;">
                                    <h5>
                                        Unidades disponibles : <?php
                                                                echo ($productoModal->getCantidad() != "0") ? $productoModal->getCantidad() : "AGOTADO";
                                                                echo "<br><br> Precio del producto $" . $productoModal->getPrecio();
                                                                ?><br><br>

                                    </h5>

                                    <h4>TALLA</h4>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary">XS</button>
                                        <button type="button" class="btn btn-secondary">S</button>
                                        <button type="button" class="btn btn-secondary">M</button>
                                        <button type="button" class="btn btn-secondary">L</button>
                                        <button type="button" class="btn btn-secondary">XL</button>
                                    </div><br><br>

                                    <div style="text-align: right">
                                        <form action="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php") . "&filtro=" . $filtro . "&idProd=" . $productoModal->getIdProducto() ?>" method="post">
                                            <input type="number" name="cantidad" class="form-control" min="1" value="1" required><br>
                                            <?php
                                            if (($productoModal->getCantidad() != "0") && $_SESSION["rol"] == "Cliente") {
                                                echo "<button name='agregar' type='submit' class='btn btn-dark'>Agregar al carrito <i class='fas fa-shopping-cart'></i></button>";
                                            }
                                            ?>
                                        </form>

                                    </div>

                                </div>
                                <div class="card-footer d-none d-lg-block d-xl-block">
                                    <h5 style="text-align: center;">------PRODUCTOS SIMILARES------</h5>
                                    <?php
                                    $i = 1;
                                    foreach ($productosModal as $productoActualModal) {
                                        if (!empty($productoActualModal->getFoto()) && ($i <= 4) && ($productoActualModal->getIdProducto() != $productoModal->getIdProducto())) {
                                            echo "<div class='col-lg-3 mt-3' id='padre'>";
                                            echo "<img src='" . "imgProd/" . $productoActualModal->getIdProducto() . "/" . $productoActualModal->getFoto() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>";
                                            echo "<div class='texto-en-imagen'>";
                                            echo "<a id=enlace href='index.php?pid=" . base64_encode("presentacion/producto/mostrarProd.php") . "&idP=" . $productoActualModal->getIdProducto() . "&pagina=" . $pagina . "&cantidad=" . $cantidad . "&filtro=" . $filtro . "'>$" . $productoActualModal->getPrecio() . "</a> </div> </div>";
                                        }
                                        $i++;
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
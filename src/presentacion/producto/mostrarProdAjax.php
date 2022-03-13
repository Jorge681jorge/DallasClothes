<?php
$filtro = $_GET["filtro"];
$producto = new Producto();
$productos = $producto->consultarFiltro2($filtro);
$idP = "";
if (isset($_GET["idP"])) {
    $idP = $_GET["idP"];
    if ($idP != "") {
        $productoModal = new Producto($idP);
        $productoModal->consultar2();
        $productosModal = $productoModal->consultarFiltro2($filtro); ?>

        <script>
            $(document).ready(function() {
                $("#myModal").modal("show");
            });
        </script>

<?php
    }
}

?>

<body style="background-image: url(img/fondo2.jpg); background-size: cover;"></body>
<div class="container mt-3">
    <div class="row">
        <div class="col">

            <div class="card f">
                <div class="card-header text-white ">
                    <h4>Productos</h4>
                </div>

                <div class="text-right">Resultados <?php echo count($productos) ?> registros encontrados</div>
                <div class="card-body">
                    <div class="row">
                        <?php

                        foreach ($productos as $productoActual) {
                            if (!empty($productoActual->getFoto())) {

                                echo "<div class='col-lg-2 col-md-3 col-sm-4 mt-3' >";
                                echo "<div id='padre'>";
                                echo strtoupper($productoActual->getNombre());
                                echo "<img src='" . "imgProd/" . $productoActual->getIdProducto() . "/" . $productoActual->getFoto() . "' class='d-block w-100 rounded ' alt='Responsive image' style='width: 100%;'>";
                                echo "<div class='texto-en-imagen'>";

                                echo "<a id=enlace href='index.php?pid=" . base64_encode("presentacion/producto/Busqueda.php") . "&idP=" . $productoActual->getIdProducto()  . "&filtro=" . $filtro . "'>$" . $productoActual->getPrecio() . "</a></div> </div> </div>";
                            }
                        }
                        ?>


                    </div>

                </div>
            </div>
        </div>

    </div>
</div>



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
                                        <form action="index.php?pid=<?php echo base64_encode("presentacion/producto/Busqueda.php") . "&filtro=" . $filtro . "&idProd=" . $productoModal->getIdProducto() ?>" method="post">
                                            <?php
                                            if ($productoModal->getCantidad() != "0") {
                                                echo "<button type='submit' class='btn btn-dark'>Agregar al carrito <i class='fas fa-shopping-cart'></i></button>";
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
                                            echo "<a id=enlace href='index.php?pid=" . base64_encode("presentacion/producto/Busqueda.php") . "&idP=" . $productoActualModal->getIdProducto() . "&filtro=" . $filtro . "'>$" . $productoActualModal->getPrecio() . "</a> </div> </div>";
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
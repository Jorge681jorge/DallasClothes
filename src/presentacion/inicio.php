<div id="carouselExampleControls" class="carousel slide mb-5" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/desc1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/desc2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="img/desc3.jpg" class="d-block w-100" alt="...">
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
<div class="container mb-5">
    <div class="row mt-3">
        <div class="col-lg-3" id="padre">
            <img src="img/rop1.jpg" class="d-block w-100 rounded" alt="Responsive image">
            <div class="texto-en-imagen">
                <a id=enlace href="index.php?pid=<?php
                                        echo base64_encode("presentacion/producto/mostrarProd.php");
                                        ?>&filtro=vestido">Vestidos</a>
            </div>

        </div>
        <div class="col-lg-3" id="padre">
            <img src="img/rop2.jpg" class="d-block w-100 rounded" alt="Responsive image">
            <div class="texto-en-imagen">
                <a id=enlace href="index.php?pid=<?php
                                        echo base64_encode("presentacion/producto/mostrarProd.php");
                                        ?>&filtro=pantalon mujer">Pantalones</a>
            </div>

        </div>
        <div class="col-lg-6" id="padre">
            <img src="img/rop5.jpg" class="d-block w-100 rounded" alt="Responsive image">
            <div class="texto-en-imagen">
                <a id=enlace href="index.php?pid=<?php
                                        echo base64_encode("presentacion/producto/mostrarProd.php");
                                        ?>&filtro=blusa mujer">Blusas</a>
            </div>

        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-6" id="padre">
            <img src="img/rop9.jpg" class="d-block w-100 rounded" alt="Responsive image">
            <div class="texto-en-imagen">
                <a id=enlace href="index.php?pid=<?php
                                        echo base64_encode("presentacion/producto/mostrarProd.php");
                                        ?>&filtro=camiseta hombre">Camisetas</a>
            </div>

        </div>
        <div class="col-lg-3" id="padre">
            <img src="img/rop7.jpg" class="d-block w-100 rounded" alt="Responsive image">
            <div class="texto-en-imagen">
                <a id=enlace href="index.php?pid=<?php
                                        echo base64_encode("presentacion/producto/mostrarProd.php");
                                        ?>&filtro=pantalon hombre">Pantalones</a>
            </div>

        </div>
        <div class="col-lg-3" id="padre">
            <img src="img/rop8.jpg" class="d-block w-100 rounded" alt="Responsive image">
            <div class="texto-en-imagen">
                <a id=enlace href="index.php?pid=<?php
                                        echo base64_encode("presentacion/producto/mostrarProd.php");
                                        ?>&filtro=chaqueta hombre">Chaquetas</a>
            </div>

        </div>
    </div>
</div>

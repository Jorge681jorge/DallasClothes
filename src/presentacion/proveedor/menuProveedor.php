<?php
$proveedor = new Proveedor($_SESSION["id"]);
$proveedor->consultar();
?>
<nav class="navbar sticky-top navbar-expand-md navbar-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="navbar-brand mb-0 h1" href="index.php?pid=<?php echo base64_encode("presentacion/inicio.php");
                                                                    ?>">Inicio</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mujeres
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=mujer">Todo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=pantalon mujer">Pantalones</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=blusa mujer">Blusas</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=vestido mujer">Vestidos</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=chaqueta mujer">Chaquetas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/Busqueda.php"); ?>">Buscar  <i class="fas fa-search"></i></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hombres
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=hombre">Todo</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=pantalon hombre">Pantalones</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=camisa hombre">Camisas</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=camiseta hombre">Camisetas</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=chaqueta hombre">Chaquetas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/Busqueda.php"); ?>">Buscar  <i class="fas fa-search"></i></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/crearProducto.php"); ?>&a=<?php echo $proveedor->getId()?>&t=1">Registar Producto</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/consultarProductoPagina.php") ?>&a=<?php echo $proveedor->getId()?>&t=1">Listado Productos</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/buscarProducto.php") ?>">Buscar Produto</a>
                </div>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="index.php?pid=<?php echo base64_encode("presentacion/proveedor/sesionProveedor.php"); ?>">PROVEEDOR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?pid=<?php echo base64_encode("presentacion/proveedor/sesionProveedor.php"); ?>">
                    <?php echo ($proveedor->getNombre() != "") ? $proveedor->getNombre() : $proveedor->getCorreo();
                    ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?cerrarSesion=true">Cerrar Sesion</a>
            </li>
        </ul>
    </div>
</nav>
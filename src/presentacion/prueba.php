
<?php
$administrador = new Administrador($_SESSION["id"]);
$administrador->consultar();
?>
<nav class="navbar sticky-top navbar-expand-md navbar-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="navbar-brand mb-0 h1" href="index.php?pid=<?php echo base64_encode("presentacion/inicio.php");
                                                                    ?>">Inicio</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tienda
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=mujer">Mujeres</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/mostrarProd.php"); ?>&filtro=hombre">Hombres</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    G. Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/crearProducto.php"); ?>&a=<?php echo $administrador->getIdAdministrador() ?>">Registar Producto</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/consultarProductoPagina.php") ?>&a=<?php echo $administrador->getIdAdministrador() ?>">Listado Productos</a>
                    <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/producto/buscarProducto.php") ?>">Buscar Produto</a>
                </div>
            </li>
                       
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    G. Usuarios
                </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/log/mostrarLog.php") ?>">Ver log</a></li>
                        <li><a class="dropdown-item" href="#">Buscar Usuario</a></li>
                        <li>
                            <a class="test dropdown-item" href="#">Listado Usuarios <i class="fas fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/cliente/MostrarBuscarCliente.php") ?>&a=<?php echo $administrador->getIdAdministrador() ?>">L. Clientes</a></li>
                            <li><a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/proveedor/mostrarTodos.php") ?>&a=<?php echo $administrador->getIdAdministrador() ?>">L. Proveedores</a></li>
                            <li><a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/mostrarTodos.php") ?>&a=<?php echo $administrador->getIdAdministrador() ?>">L. Administradores</a></li>
                            </ul>
                        </li>
                    </ul>
            </li>

        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/sesionAdministrador.php"); ?>">ADMINISTRADOR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/sesionAdministrador.php"); ?>">
                <?php echo ($administrador->getNombre() != "") ? $administrador->getNombre() : $administrador->getCorreo();
                                                                        ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?cerrarSesion=true">Cerrar Sesion</a>
            </li>
        </ul>
    </div>
</nav>


<script>
$(document).ready(function(){
  $('.dropdown a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
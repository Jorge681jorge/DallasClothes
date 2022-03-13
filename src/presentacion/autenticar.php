<?php
if ((isset($_POST["correoi"]))&&($_SESSION["n"]==0)) {
    $correo = $_POST["correoi"];
    $clave = $_POST["clave"];
    $administrador = new Administrador("", "", "", $correo, $clave);
    $cliente = new Cliente("", "", "", $correo, $clave, "", "");
    $proveedor = new Proveedor("", "", "", $correo, $clave, "", "");
    if ($administrador->autenticar()) {
        $_SESSION["id"] = $administrador->getIdAdministrador();
        $_SESSION["rol"] = "Administrador";
        $administrador = new Administrador($_SESSION["id"]);
        $administrador->consultar();
        $log = new Log("", "Inicio sesion", $administrador->getNombre(), "", "", $administrador->getCorreo());
        $log->insertar();
        header("Location: index.php?pid=" . base64_encode("presentacion/administrador/sesionAdministrador.php"));
    } else if ($cliente->autenticar()) {
        if ($cliente->getEstado() == -1) {
            header("Location: index.php?pid=" . base64_encode("presentacion/Login.php") . "&error=2");
        } else if ($cliente->getEstado() == 0) {
            header("Location: index.php?pid=" . base64_encode("presentacion/Login.php") . "&error=3");
        } else {
            $_SESSION["id"] = $cliente->getIdCliente();
            $_SESSION["rol"] = "Cliente";
            $cliente = new Cliente($_SESSION["id"]);
            $cliente->consultar();
            $log = new Log("", "Inicio sesion", $cliente->getNombre(), "", "", $cliente->getCorreo());
            $log->insertar();
            header("Location: index.php?pid=" . base64_encode("presentacion/cliente/sesionCliente.php"));
        }
    } else if ($proveedor->autenticar()) {
        if ($proveedor->getEstado() == -1) {
            header("Location: index.php?pid=" . base64_encode("presentacion/Login.php") . "&error=2");
        } else if ($proveedor->getEstado() == 0) {
            header("Location: index.php?pid=" . base64_encode("presentacion/Login.php") . "&error=3");
        } else {
            $_SESSION["id"] = $proveedor->getId();
            $_SESSION["rol"] = "Proveedor";
            $proveedor = new Proveedor($_SESSION["id"]);
            $proveedor->consultar();
            $log = new Log("", "Inicio sesion", $proveedor->getNombre(), "", "", $proveedor->getCorreo());
            $log->insertar();
            header("Location: index.php?pid=" . base64_encode("presentacion/proveedor/sesionProveedor.php"));
        }
    } else {
        header("Location: index.php?pid=" . base64_encode("presentacion/Login.php") . "&error=1");
    }
    $_SESSION["n"]=1;
}

<?php
require_once "logica/Log.php";
if(  $_POST["rol"]=='Cliente'  ){
    
    require_once "logica/Cliente.php";
    $cliente = new Cliente();
    $cliente -> editarColumn( $_POST["column"],$_POST["editval"],$_POST["id"]);
    

}else if(  $_POST["rol"]=='Proveedor'  ){
    
    require_once "logica/Proveedor.php";
    $proveedor = new Proveedor();
    $proveedor -> editarColumn( $_POST["column"],$_POST["editval"],$_POST["id"]);

}else if(  $_POST["rol"]=='Administrador'  ){
    
    require_once "logica/Administrador.php";
    $administrador = new Administrador();
    $administrador -> editarColumn( $_POST["column"],$_POST["editval"],$_POST["id"]);

}
$log = new Log("", "Cambio estado",$_POST["id"] ."-"."Edicion: ".$_POST["column"]."-".$_POST["editval"]."-".$_POST["rol"], "", "","actor");
    $log->insertar();

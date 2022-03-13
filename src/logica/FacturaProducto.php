<?php
require_once "persistencia/Conexion.php";
require_once "persistencia/FacturaProductoDAO.php";
class FacturaProducto{
    private $idFacturaP;
    private $cantidad;
    private $precio;
    private $idFactura;
    private $idProducto;
    private $conexion;
    private $facturaProductoDAO;

    public function getIdFacturaP(){
        return $this -> idFacturaP;
    }
    
    public function getCantidad(){
        return $this -> cantidad;
    }
    
    public function getPrecio(){
        return $this -> precio;
    }
    
    public function getIdFactura(){
        return $this -> idFactura;
    }

    public function getIdProducto(){
        return $this -> idProducto;
    }

    public function FacturaProducto($idFacturaP = "", $cantidad = "", $precio = "", $idFactura = "", $idProducto = ""){
        $this -> idFacturaP = $idFacturaP;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> idFactura = $idFactura;
        $this -> idProducto = $idProducto;
        $this -> conexion = new Conexion();
        $this -> facturaProductoDAO = new FacturaProductoDAO($this -> idFacturaP, $this -> cantidad, $this -> precio, $this -> idFactura,$this -> idProducto);
    }

    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaProductoDAO -> consultarTodos());
        $facturas = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new FacturaProducto("",$resultado[0], $resultado[1], "",$resultado[2]);
            array_push($facturas, $p);
        }
        $this -> conexion -> cerrar();        
        return $facturas;
        
    }

    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaProductoDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaProductoDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> cantidad = $resultado[0];
        $this -> precio = $resultado[1];
        $this -> idFactura = $resultado[2];
        $this -> idProducto = $resultado[3];
        
    }

    public function insertar(){
        $this -> conexion -> abrir();    
        $this -> conexion -> ejecutar($this -> facturaProductoDAO -> insertar());    
        $this -> conexion -> cerrar();        
    }

    public function Eliminar(){
        $this -> conexion -> abrir();    
        $this -> conexion -> ejecutar($this -> facturaProductoDAO -> Eliminar());    
        $this -> conexion -> cerrar();        
    }
    
    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaProductoDAO -> editar());
        $this -> conexion -> cerrar();
    }

}

?>
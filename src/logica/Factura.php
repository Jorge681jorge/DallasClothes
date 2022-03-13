<?php
require_once "persistencia/Conexion.php";
require_once "persistencia/FacturaDAO.php";
class Factura
{
    private $idFactura;
    private $fecha;
    private $valor;
    private $idCliente;
    private $estado;
    private $facturaDAO;
    private $conexion;
    
    public function getIdFactura()
    {
        return $this -> idFactura;
    }
    
    public function getFecha()
    {
        return $this -> fecha;
    }
    
    public function getValor()
    {
        return $this -> valor;
    }
    
    public function getIdCliente()
    {
        return $this -> idCliente;
    }

    public function getEstado()
    {
        return $this -> estado;
    }
 
    public function Factura($idFactura = "", $fecha = "", $valor = "", $idCliente = "", $estado="")
    {
        $this -> idFactura = $idFactura;
        $this -> fecha = $fecha;
        $this -> valor = $valor;
        $this -> idCliente = $idCliente;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> facturaDAO = new FacturaDAO($this -> idFactura, $this -> fecha, $this -> valor, $this -> idCliente);
    }

    public function consultar()
    {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idFactura = $resultado[0];
        $this -> fecha = $resultado[1];
        $this -> valor = $resultado[2];
        $this -> idCliente = $resultado[3];
        $this -> estado = $resultado[4];
        $this -> facturaDAO = new FacturaDAO($this -> idFactura, $this -> fecha, $this -> valor, $this -> idCliente);
    }

    public function consultar2()
    {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> consultar2());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idFactura = $resultado[0];
        $this -> fecha = $resultado[1];
        $this -> valor = $resultado[2];
        $this -> idCliente = $resultado[3];
        $this -> estado = $resultado[4];
        $this -> facturaDAO = new FacturaDAO($this -> idFactura, $this -> fecha, $this -> valor, $this -> idCliente);
    }

    public function consultarLog()
    {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> consultarLog());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idFactura = $resultado[0];
        $this -> fecha = $resultado[1];
        $this -> valor = $resultado[2];
        $this -> idCliente = $resultado[3];
        $this -> estado = $resultado[4];
    }


    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> consultar2());
        $facturas = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Factura($resultado[0], $resultado[1], $resultado[2], $resultado[3],$resultado[4]);
            array_push($facturas, $p);
        }
        $this -> conexion -> cerrar();        
        return $facturas;
        
    }

    public function insertar(){
        $this -> conexion -> abrir();    
        $this -> conexion -> ejecutar($this -> facturaDAO -> insertar());    
        $this -> conexion -> cerrar();        
    }
    
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> facturaDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function Comprar(){
        $this -> conexion -> abrir();    
        $this -> conexion -> ejecutar($this -> facturaDAO -> Comprar());    
        $this -> conexion -> cerrar();        
    }
}

?>
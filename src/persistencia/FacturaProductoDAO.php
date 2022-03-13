<?php
class FacturaProductoDAO{
    private $idFacturaP;
    private $cantidad;
    private $precio;
    private $idFactura;
    private $idProducto;

    public function getIdFacturaP()
    {
        return $this -> idFacturaP;
    }
    
    public function getCantidad()
    {
        return $this -> cantidad;
    }
    
    public function getPrecio()
    {
        return $this -> precio;
    }
    
    public function getIdFactura()
    {
        return $this -> idFactura;
    }

    public function getIdProducto()
    {
        return $this -> idProducto;
    }

    public function FacturaProductoDAO($idFacturaP = "", $cantidad = "", $precio = "", $idFactura = "", $idProducto = "")
    {
        $this -> idFacturaP = $idFacturaP;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> idFactura = $idFactura;
        $this -> idProducto = $idProducto;
    }

    public function consultarTodos()
    { 
        return "select cantidad, precio, idProducto
        from facturaProducto
        where idFactura = '" . $this -> idFactura .  "'";
    }

    public function consultarCantidad(){
        return "select count(idFacturaProducto)
                from facturaProducto
                where idFactura = '" . $this -> idFactura .  "'";
    }

    public function insertar(){          
        return "insert into facturaProducto (cantidad, precio, idFactura, idProducto)
                values ('".$this -> cantidad."', '" . $this -> precio ."', '" . $this -> idFactura ."','".$this -> idProducto. "')";          
    }

    public function Eliminar(){      
        return "Delete from facturaProducto where idProducto='".$this -> idProducto."'";          
    }
    
    public function editar(){
        return "update facturaProducto
                set cantidad = '".$this-> cantidad."', precio = '".$this-> precio."'
                where idProducto = '" . $this -> idProducto .  "' AND idFactura = '".$this -> idFactura."'";
    }

    public function consultar(){
        return "select cantidad, precio, idFactura, idProducto
                from facturaProducto 
                where idProducto = '" . $this -> idProducto .  "' AND idFactura = '".$this -> idFactura."'";
    }
}

<?php
class FacturaDAO{
    private $idFactura;
    private $fecha;
    private $valor;
    private $idCliente;
    
    public function getIdFactura(){
        return $this -> idFactura;
    }
    
    public function getFecha(){
        return $this -> fecha;
    }
    
    public function getValor(){
        return $this -> valor;
    }
    
    public function getIdCliente(){
        return $this -> idCliente;
    }

    public function FacturaDAO($idFactura = "", $fecha = "", $valor = "", $idCliente = "", $idProveedor = "", $foto = "", $foto2 = "", $foto3 = ""){
        $this -> idFactura = $idFactura;
        $this -> fecha = $fecha;
        $this -> valor = $valor;
        $this -> idCliente = $idCliente;
    }

    public function consultar(){
        return "select idFactura, fecha, valor, idCliente, estado
                from factura
                where idCliente = '" . $this -> idCliente .  "' AND estado ='0';";
    }

    public function consultar2(){
        return "select idFactura, fecha, valor, idCliente, estado
                from factura
                where idCliente = '" . $this -> idCliente .  "' AND estado ='1';";
    }

    public function consultarLog(){
        return "select idFactura, fecha, valor, idCliente, estado
                from factura
                where IdFactura = '" . $this -> idFactura .  "';";
    }

    public function insertar(){
        return "insert into factura (idFactura,fecha, valor, idCliente,estado)
                values ('".$this -> idFactura."',now(), '" . $this -> valor ."', '" . $this -> idCliente ."', '0')";    
    }

    public function consultarCantidad(){
        return "select count(idFactura)
                from factura
                where idCliente = '" . $this -> idCliente .  "' AND estado ='0';";
    }

    public function Comprar(){
        return "update factura
        SET estado = '1', valor= '".$this -> valor."'
        WHERE idFactura = '".$this -> idFactura."'";
    }
    
}

?>
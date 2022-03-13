<?php
class ClienteDAO{
    private $idCliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;

    public function ClienteDAO($idCliente = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;        
    }

    public function existeCorreo(){
        return "select correo
                from cliente
                where correo = '" . $this -> correo .  "'";
    }
        
    public function registrar(){
        return "insert into cliente (correo, clave, estado)
                values ('" . $this -> correo . "', '" . md5($this -> clave) . "', 1);";
    }
 
    public function verificarCodigoActivacion($codigoActivacion){
        return "select idCliente
                from cliente
                where correo = '" . $this -> correo .  "' and codigoActivacion = '" . md5($codigoActivacion) . "'";
    }
    
    public function activar(){
        return "update cliente 
                set estado = '1'
                where correo = '" . $this -> correo .  "'";
    }
    
    public function autenticar(){
        return "select idCliente, estado
                from cliente
                where correo = '" . $this -> correo .  "' and clave = '" . md5($this -> clave) . "'";
    }

    public function BuscarLog(){
        return "select idCliente, estado
                from cliente 
                where correo = '" . $this -> correo .  "'";
    }

    public function consultarTodos(){
        return "select idCliente, nombre, apellido, correo, estado
                from cliente";
    }

    public function consultarPaginacion($cantidad, $pagina){
        return "select idCliente, nombre, apellido, correo, estado
                from cliente
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    } 
    
    public function consultar(){
        return "select nombre, apellido, correo, foto, clave
                from cliente
                where idCliente = '" . $this -> idCliente .  "'";
    }

    public function consultarEstado(){
        return "select nombre, apellido, correo, foto, estado
                from cliente
                where idCliente = '" . $this -> idCliente .  "'";
    }

    public function consultarCantidad(){
        return "select count(idCliente)
                from cliente";
    }

    public function consultarCantidadFiltro($filtro){
        return "select count(idCliente)
                from cliente
                where idCliente like '%" . $filtro . "%' or nombre like '" . $filtro . "%' or apellido like '" . $filtro . "%' or estado like '" . $filtro . "%' or correo like '" . $filtro . "%'   ";             
    }

    public function consultarPaginacionFiltro($cantidad, $pagina, $filtro){
        return "select idCliente, nombre, apellido, correo, estado
                from cliente
                where idCliente like '%" . $filtro . "%' or nombre like '" . $filtro . "%' or apellido like '" . $filtro . "%' or estado like '" . $filtro . "%' or correo like '" . $filtro . "%'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    } 
    
    public function editarColumn($column,$editableObj,$id){
        $sql = "UPDATE cliente set " . $column . " = '".$editableObj."' WHERE  idCliente=".$id;
        return $sql;
    }
  
    public function editar(){
        return "update cliente
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idCliente = '" . $this -> idCliente.  "'";
    }

    public function editarClave(){
        return "update cliente
                set clave = '" .  md5($this -> clave)  . 
                "' where idCliente = '" . $this -> idCliente .  "'";
    }

    public function cambiarEstado(){
        return "update cliente
                set estado = '" . $this -> estado . "'
                where idCliente = '" . $this -> idCliente .  "'";
    }
}

?>
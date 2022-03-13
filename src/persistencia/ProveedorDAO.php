<?php
class ProveedorDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;

    public function ProveedorDAO($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;        
    }

    public function existeCorreo(){
        return "select correo
                from proveedor
                where correo = '" . $this -> correo .  "'";
    }

    public function BuscarLog(){
        return "select idProveedor, estado
                from proveedor 
                where correo = '" . $this -> correo .  "'";
    }
        
    public function registrar(){
        return "insert into proveedor (nombre,apellido,correo, clave, estado)
                values ('" . $this -> nombre . "','" . $this -> apellido . "','" . $this -> correo . "', '" . md5($this -> clave) . "', '-1');";
    }
 
    public function verificarCodigoActivacion($codigoActivacion){
        return "select idProveedor
                from proveedor
                where correo = '" . $this -> correo .  "' and codigoActivacion = '" . md5($codigoActivacion) . "'";
    }
    
    public function activar(){
        return "update proveedor 
                set estado = '1'
                where correo = '" . $this -> correo .  "'";
    }
    
    public function autenticar(){
        return "select idProveedor, estado
                from proveedor
                where correo = '" . $this -> correo .  "' and clave = '" . md5($this -> clave) . "'";
    }
 
    public function consultar(){
        return "select nombre, apellido, correo, foto, clave
                from proveedor
                where idProveedor = '" . $this -> id .  "'";
    }

    public function consultarTodos(){
        return "select idProveedor, nombre, apellido, correo, estado
                from proveedor";
    }

    public function consultarPaginacion($cantidad, $pagina){
        return "select idProveedor, nombre, apellido, correo, estado
                from proveedor
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function consultarEstado(){
        return "select nombre, apellido, correo, foto, estado
                from proveedor
                where idProveedor = '" . $this -> idProveedor .  "'";
    }

    public function consultarCantidad(){
        return "select count(idProveedor)
                from proveedor";
    }

    public function consultarCantidadFiltro($filtro){
        return "select count(idProveedor)
                from proveedor
                where idProveedor like '%" . $filtro . "%' or nombre like '" . $filtro . "%' or apellido like '" . $filtro  . "%' or correo like '" . $filtro . "%'   ";             
    }
    
    public function consultarPaginacionFiltro($cantidad, $pagina, $filtro){
        return "select idProveedor, nombre, apellido, correo, estado
                from proveedor
                where idProveedor like '%" . $filtro . "%' or nombre like '" . $filtro . "%' or apellido like '" . $filtro . "%' or estado like '" . $filtro . "%' or correo like '" . $filtro . "%'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    } 

    public function editarColumn($column,$editableObj,$id){
        $sql = "UPDATE proveedor set " . $column . " = '".$editableObj."' WHERE  idProveedor=".$id;
        return $sql;
    }
    
    public function editar(){
        return "update proveedor
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idProveedor = '" . $this -> id.  "'";
    }

    public function editarClave(){
        return "update proveedor
                set clave = '" .  md5($this -> clave)  . 
                "' where idProveedor = '" . $this -> id .  "'";
    }

    

}

?>
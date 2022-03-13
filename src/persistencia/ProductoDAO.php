<?php
class ProductoDAO{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $idProveedor;
    private $foto;
    private $foto2;
    private $foto3;
       
    public function ProductoDAO($idProducto = "", $nombre = "", $cantidad = "", $precio = "", $idProveedor = "", $foto = "", $foto2 = "", $foto3 = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> idProveedor = $idProveedor;
        $this -> foto = $foto;
        $this -> foto2 = $foto2;
        $this -> foto3 = $foto3;
    }

    public function consultar(){
        return "select nombre, cantidad, precio
                from producto
                where idProducto = '" . $this -> idProducto .  "'";
    }   
    
    public function consultar2(){
        return "select nombre, cantidad, precio, foto, foto2, foto3
                from producto
                where idProducto = '" . $this -> idProducto .  "'";
    }  
    
    public function insertar(){
        return "insert into producto (nombre, cantidad, precio, idProveedor)
                values ('" . $this -> nombre . "', '" . $this -> cantidad . "', '" . $this -> precio . "', '" . $this -> idProveedor . "')";
    }
    
    public function consultarTodos(){
        return "select idProducto, nombre, cantidad, precio
                from producto";
    }
    
    public function consultarPaginacion($cantidad, $pagina){
        return "select idProducto, nombre, cantidad, precio, idProveedor
                from producto
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function consultarCantidad2($filtro){
        return "select count(idProducto)
                from producto
                where nombre like '%" . $filtro . "%' or cantidad like '" . $filtro . "%' or precio like '" . $filtro . "%' or idProveedor like '" . $filtro . "%';";
    }

    public function consultarPaginacionFiltro($cantidad, $pagina, $filtro){
        return "select idProducto, nombre, cantidad, precio, idProveedor, foto, foto2, foto3 
                from producto
                where nombre like '%" . $filtro . "%' or cantidad like '" . $filtro . "%' or precio like '" . $filtro . "%' or idProveedor like '" . $filtro . "%'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function consultarPaginacionId($cantidad, $pagina, $id){
        return "select idProducto, nombre, cantidad, precio, idProveedor
                from producto
                where idProveedor = '". $id ."'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function consultarCantidad(){
        return "select count(idProducto)
                from producto";
    }

    public function consultarCantidadId($id){
        return "select count(idProducto)
                from producto
                where idProveedor = '". $id ."' ";
    }
  
    public function editar(){
        return "update producto
                set nombre = '" . $this -> nombre . "', cantidad = '" . $this -> cantidad . "', precio = '" . $this -> precio 
                . "', foto = '" . $this -> foto . "', foto2 = '" . $this -> foto2 . "', foto3 = '" . $this -> foto3 .
                "' where idProducto = '" . $this -> idProducto .  "'";
    }
    
    public function consultarFiltro2($filtro){
        return "select idProducto, nombre, cantidad, precio, idProveedor, foto 
                from producto
                where nombre like '%" . $filtro . "%' or cantidad like '" . $filtro . "%' or precio like '" . $filtro . "%' or idProveedor like '" . $filtro . "%';";
    }

    public function consultarFiltro($filtro){
        return "select idProducto, nombre, cantidad, precio, idProveedor
                from producto
                where nombre like '%" . $filtro . "%' or cantidad like '" . $filtro . "%' or precio like '" . $filtro . "%' or idProveedor like '" . $filtro . "%'";
    }

    public function consultarFiltroId($filtro, $id){
        return "select idProducto, nombre, cantidad, precio, idProveedor
                from producto
                where idProveedor = '". $id ."' and (  nombre like '%" . $filtro . "%' or cantidad like '" . $filtro . "%' or precio like '" . $filtro . "%' or idProveedor like '" . $filtro . "%')";
    }
}

?>
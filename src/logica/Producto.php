<?php
require_once "persistencia/Conexion.php";
require_once "persistencia/ProductoDAO.php";
class Producto{
    private $idProducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $idProveedor;
    private $conexion;
    private $foto;
    private $foto2;
    private $foto3;
    private $productoDAO;
    
    public function getIdProducto(){
        return $this -> idProducto;
    }
    
    public function getNombre(){
        return $this -> nombre;
    }
    
    public function getCantidad(){
        return $this -> cantidad;
    }
    
    public function getPrecio(){
        return $this -> precio;
    }
     
    public function getidProveedor(){
        return $this -> idProveedor;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getFoto2(){
        return $this -> foto2;
    }

    public function getFoto3(){
        return $this -> foto3;
    }

    public function Producto($idProducto = "", $nombre = "", $cantidad = "", $precio = "", $idProveedor = "", $foto = "", $foto2 = "", $foto3 = ""){
        $this -> idProducto = $idProducto;
        $this -> nombre = $nombre;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> idProveedor = $idProveedor;
        $this -> foto = $foto;
        $this -> foto2 = $foto2;
        $this -> foto3 = $foto3;
        $this -> conexion = new Conexion();
        $this -> productoDAO = new ProductoDAO($this -> idProducto, $this -> nombre, $this -> cantidad, $this -> precio, $this -> idProveedor, $this -> foto, $this -> foto2, $this -> foto3);
    }

    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> cantidad = $resultado[1];
        $this -> precio = $resultado[2];
        
    }
    
    public function consultar2(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultar2());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> cantidad = $resultado[1];
        $this -> precio = $resultado[2];
        $this -> foto = $resultado[3];
        $this -> foto2 = $resultado[4];
        $this -> foto3 = $resultado[5];
    }

    public function insertar(){
        $this -> conexion -> abrir();    
        $this -> conexion -> ejecutar($this -> productoDAO -> insertar());    
        $this -> conexion -> cerrar();        
    }
    
    public function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarTodos());
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();        
        return $productos;
    }
     
    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarPaginacion($cantidad, $pagina));
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();
        return $productos;
    }

    public function consultarPaginacionFiltro($cantidad, $pagina,$filtro){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarPaginacionFiltro($cantidad, $pagina,$filtro));
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4],$resultado[5]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();
        return $productos;
    }

    public function consultarPaginacionId($cantidad, $pagina, $id){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarPaginacionId($cantidad, $pagina, $id));
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();
        return $productos;
    }
    
    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function consultarCantidad2($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarCantidad2($filtro));
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }
    
    public function consultarCantidadId($id){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarCantidadId($id));
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }
    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> productoDAO -> editar());
        $this -> conexion -> cerrar();
    }

    public function consultarFiltro($filtro){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarFiltro($filtro));
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();
        return $productos;
    }

    public function consultarFiltro2($filtro){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarFiltro2($filtro));
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4],$resultado[5]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();
        return $productos;
    }

    public function consultarFiltroId($filtro, $id){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> productoDAO -> consultarFiltroId($filtro, $id));
        $productos = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Producto($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4]);
            array_push($productos, $p);
        }
        $this -> conexion -> cerrar();
        return $productos;
    }
    
}

?>
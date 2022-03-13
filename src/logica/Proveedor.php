<?php
require_once "persistencia/Conexion.php";
require_once "persistencia/ProveedorDAO.php";
class Proveedor{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;      
    private $conexion;
    private $proveedorDAO;
 
    public function getId(){
        return $this -> id;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }

    public function getCorreo(){
        return $this -> correo;
    } 

    public function getClave(){
        return $this -> clave;
    }

    public function getFoto(){
        return $this -> foto;
    }

    public function getEstado(){
        return $this -> estado;
    }
    
    public function Proveedor($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> proveedorDAO = new ProveedorDAO($this -> id, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> estado);
    }
   
    public function existeCorreo(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> proveedorDAO -> existeCorreo());        
        $this -> conexion -> cerrar();        
        return $this -> conexion -> numFilas();
    }
    
    public function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> registrar());
        $this -> conexion -> cerrar();       

    }
    
    public function activarCliente($codigoActivacion){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> verificarCodigoActivacion($codigoActivacion));                
        if ($this -> conexion -> numFilas() == 1){
            $this -> conexion -> ejecutar($this -> proveedorDAO -> activar());
            $this -> conexion -> cerrar();
            return true;
        }else {
            $this -> conexion -> cerrar();
            return false;
        }        
    }
    
    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> autenticar());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> estado = $resultado[1];
            return true;
        }else {
            return false;
        }
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> foto = $resultado[3];
        $this -> clave = $resultado[4];
    }

    public function BuscarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> BuscarLog());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> estado = $resultado[1];
            $this -> proveedorDAO = new ProveedorDAO($this -> id);
            return true;
        }else {
            return false;
        }
    }

    // para uso de ajax tabla
    public function consultarTodos(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarTodos());
        $proveedor = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Proveedor($resultado[0], $resultado[1], $resultado[2], $resultado[3],"","", $resultado[4]);
            array_push($proveedor, $c);
        }
        $this -> conexion -> cerrar();
        return $proveedor;
    }

    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarPaginacion($cantidad, $pagina));
        $proveedor = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Proveedor($resultado[0], $resultado[1], $resultado[2], $resultado[3],"","", $resultado[4]);
            array_push($proveedor, $c);
        }
        $this -> conexion -> cerrar();
        return $proveedor;
    }

    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function consultarCantidadFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarCantidadFiltro($filtro));
        $this -> conexion -> cerrar();        
        if(($this -> conexion -> extraer()) != null){
            return $this -> conexion -> extraer()[0];
        }else{
            return 0; // si no hay registro  manda cero, para evitar errores por valor nulo
        }        
    }

    public function consultarPaginacionFiltro($cantidad, $pagina, $filtro){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> proveedorDAO -> consultarPaginacionFiltro($cantidad, $pagina, $filtro));
        $proveedor = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Proveedor($resultado[0], $resultado[1], $resultado[2], $resultado[3],"","", $resultado[4]);
            array_push($proveedor, $p);
        }
        $this -> conexion -> cerrar();
        return $proveedor;
    }
    

// para uso de ajax editar
    public function editarColumn($column,$editableObj,$id){ 
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> editarColumn($column,$editableObj,$id));
        $this -> conexion -> cerrar();
    }

    
    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> editar());
        $this -> conexion -> cerrar();
    }

    public function editarClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> editarClave());
        $this -> conexion -> cerrar();
    }
  
    

}

?>
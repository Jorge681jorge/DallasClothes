<?php
require_once "persistencia/Conexion.php";
require_once "persistencia/AdministradorDAO.php";
class Administrador{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $conexion;
    private $administradorDAO;
 
    public function getIdAdministrador(){
        return $this -> idAdministrador;
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

    public function Administrador($idAdministrador = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministrador;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> conexion = new Conexion();
        $this -> administradorDAO = new AdministradorDAO($this -> idAdministrador, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto);
    }

    public function BuscarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> BuscarLog());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idAdministrador = $resultado[0];
            $this -> administradorDAO = new AdministradorDAO($this -> idAdministrador);
            return true;
        }else {
            return false;
        }
    }

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> autenticar());
        $this -> conexion -> cerrar();       
        if ($this -> conexion -> numFilas() == 1){            
            $resultado = $this -> conexion -> extraer();
            $this -> idAdministrador = $resultado[0];             
            return true;        
        }else {
            return false;
        }
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> foto = $resultado[3];
        $this -> clave = $resultado[4];
    }

     // para uso de ajax tabla
     public function consultarTodos(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultarTodos());
        $administrador = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Administrador($resultado[0], $resultado[1], $resultado[2], $resultado[3]);
            array_push($administrador, $c);
        }
        $this -> conexion -> cerrar();
        return $administrador;
    }

    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultarPaginacion($cantidad, $pagina));
        $administrador = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Administrador($resultado[0], $resultado[1], $resultado[2], $resultado[3]);
            array_push($administrador, $c);
        }
        $this -> conexion -> cerrar();
        return $administrador;
    }

    public function consultarCantidadFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultarCantidadFiltro($filtro));
        $this -> conexion -> cerrar();        
        if(($this -> conexion -> extraer()) != null){
            $cont = $this -> conexion -> extraer()[0];
        }else{
            $cont =0; // si no hay registro  manda cero, para evitar errores por valor nulo
        }        
        return $cont;
    }

    public function consultarPaginacionFiltro($cantidad, $pagina, $filtro){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultarPaginacionFiltro($cantidad, $pagina, $filtro));
        $administrador = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $p = new Administrador($resultado[0], $resultado[1], $resultado[2], $resultado[3]);
            array_push($administrador, $p);
        }
        $this -> conexion -> cerrar();
        return $administrador;
    }
    

    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

// para uso de ajax editar
    public function editarColumn($column,$editableObj,$id){ 
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> editarColumn($column,$editableObj,$id));
        $this -> conexion -> cerrar();
    }

    public function existeCorreo(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> administradorDAO -> existeCorreo());        
        $this -> conexion -> cerrar();        
        return $this -> conexion -> numFilas();
    }

    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> editar());
        $this -> conexion -> cerrar();
    }

    public function editarClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> administradorDAO -> editarClave());
        $this -> conexion -> cerrar();
    }
    
}

?>
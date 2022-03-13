<?php
require_once "persistencia/Conexion.php";
require_once "persistencia/ClienteDAO.php";
class Cliente{
    private $idCliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;
    private $estado;      
    private $conexion;
    private $clienteDAO;

    public function getIdCliente(){
        return $this -> idCliente;
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
    
    public function Cliente($idCliente = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = "", $estado = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> clienteDAO = new ClienteDAO($this -> idCliente, $this -> nombre, $this -> apellido, $this -> correo, $this -> clave, $this -> foto, $this -> estado);
    }
   
    public function existeCorreo(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> clienteDAO -> existeCorreo());        
        $this -> conexion -> cerrar();        
        return $this -> conexion -> numFilas();
    }
    
    public function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> registrar());
        $this -> conexion -> cerrar();       
    }
    
    public function activarCliente($codigoActivacion){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> verificarCodigoActivacion($codigoActivacion));                
        if ($this -> conexion -> numFilas() == 1){
            $this -> conexion -> ejecutar($this -> clienteDAO -> activar());
            $this -> conexion -> cerrar();
            return true;
        }else {
            $this -> conexion -> cerrar();
            return false;
        }        
    }
    
    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> autenticar());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idCliente = $resultado[0];
            $this -> estado = $resultado[1];
            return true;
        }else {
            return false;
        }
    }

    public function BuscarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> BuscarLog());
        $this -> conexion -> cerrar();
        if ($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> idCliente = $resultado[0];
            $this -> estado = $resultado[1];
            $this -> clienteDAO = new ClienteDAO($this -> idCliente);
            return true;
        }else {
            return false;
        }
    }
    
    public function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultar());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> foto = $resultado[3];
        $this -> clave = $resultado[4];
    }

// para uso de ajax modal
    public function consultarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarEstado());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> nombre = $resultado[0];
        $this -> apellido = $resultado[1];
        $this -> correo = $resultado[2];
        $this -> foto = $resultado[3];        
        $this -> estado = $resultado[4];
    }  
// para uso de ajax tabla
    public function consultarTodos(){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarTodos());
        $cliente = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3],"","", $resultado[4]);
            array_push($cliente, $c);
        }
        $this -> conexion -> cerrar();
        return $cliente;
    }

    public function consultarPaginacion($cantidad, $pagina){
        $this -> conexion -> abrir();        
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarPaginacion($cantidad, $pagina));
        $cliente = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3],"","", $resultado[4]);
            array_push($cliente, $c);
        }
        $this -> conexion -> cerrar();
        return $cliente;
    }  

    public function consultarCantidad(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarCantidad());
        $this -> conexion -> cerrar();
        return $this -> conexion -> extraer()[0];
    }

    public function consultarCantidadFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarCantidadFiltro($filtro));
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
        $this -> conexion -> ejecutar($this -> clienteDAO -> consultarPaginacionFiltro($cantidad, $pagina, $filtro));
        $cliente = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $c = new Cliente($resultado[0], $resultado[1], $resultado[2], $resultado[3],"","", $resultado[4]);
            array_push($cliente, $c);
        }
        $this -> conexion -> cerrar();
        return $cliente;
    }  
  
// para uso de ajax editar
    public function editarColumn($column,$editableObj,$id){ 
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> editarColumn($column,$editableObj,$id));
        $this -> conexion -> cerrar();
    }

    public function editar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> editar());
        $this -> conexion -> cerrar();
    }

    public function editarClave(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> editarClave());
        $this -> conexion -> cerrar();
    }

    public function cambiarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> cambiarEstado());
        $this -> conexion -> cerrar();        
    }
    
}

?>
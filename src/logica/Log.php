<?php 
    require_once "persistencia/Conexion.php";
    require_once "persistencia/LogDAO.php";

    class Log{
        private $id;
        private $accion;
        private $datos;
        private $fecha;
        private $hora;
        private $actor;
        private $conexion;
        private $logDAO;

        public function getId(){
            return $this -> id;
        }

        public function getAccion(){
            return $this -> accion;
        }

        public function getDatos(){
            return $this -> datos;
        }

        public function getFecha(){
            return $this -> fecha;
        }

        public function getHora(){
            return $this -> hora;
        }

        public function getActor(){
            return $this -> actor;
        }

        public function Log($id = "" ,$accion = "" ,$datos = "" ,$fecha = "", $hora = "" ,$actor = "" ){
            $this -> id = $id;
            $this -> accion = $accion;
            $this -> datos = $datos;
            $this -> fecha = $fecha;
            $this -> hora = $hora;
            $this -> actor = $actor;
            $this -> conexion = new Conexion();
            $this -> logDAO = new LogDAO($this -> id, $this -> accion, $this -> datos, $this -> fecha, $this -> hora, $this -> actor);
        } 

        public function consultar(){
            $this -> conexion -> abrir();
            $this -> conexion -> ejecutar($this -> logDAO -> consultar());
            $this -> conexion -> cerrar();
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> accion = $resultado[1];
            $this -> datos = $resultado[2];
            $this -> fecha = $resultado[3];
            $this -> hora = $resultado[4];
            $this -> actor = $resultado[5];
        }

        public function insertar(){
            $this -> conexion -> abrir();
            $this -> conexion -> ejecutar($this -> logDAO -> insertar());
            $this -> conexion -> cerrar();       
    
        } 

        public function consultarPaginacion($cantidad, $pagina){
            $this -> conexion -> abrir();        
            $this -> conexion -> ejecutar($this -> logDAO -> consultarPaginacion($cantidad, $pagina));
            $productos = array();
            while(($resultado = $this -> conexion -> extraer()) != null){
                $p = new Log($resultado[0], $resultado[1], $resultado[2], $resultado[3], $resultado[4],$resultado[5]);
                array_push($productos, $p);
            }
            $this -> conexion -> cerrar();
            return $productos;
        }

        public function consultarCantidad(){
            $this -> conexion -> abrir();
            $this -> conexion -> ejecutar($this -> logDAO -> consultarCantidad());
            $this -> conexion -> cerrar();
            return $this -> conexion -> extraer()[0];
        }
    }

?>
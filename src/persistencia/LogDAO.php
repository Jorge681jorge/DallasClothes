<?php 
    class LogDAO{
        private $id;
        private $accion;
        private $datos;
        private $fecha;
        private $hora;
        private $actor;

        public function LogDAO($id = "" ,$accion = "" ,$datos = "" ,$fecha = "", $hora = "" ,$actor = "" ){
            $this -> id = $id;
            $this -> accion = $accion;
            $this -> datos = $datos;
            $this -> fecha = $fecha;
            $this -> hora = $hora;
            $this -> actor = $actor;
        }

        public function insertar(){
            return "insert into log (accion, datos, fecha, hora, actor)
                    values ('".$this -> accion."','".$this -> datos."',NOW(),NOW(),'".$this -> actor."');";
        }

        public function consultar(){
            return "select id, accion, datos, fecha, hora, actor
                    from log where id= ".$this -> id;
        } 

        public function consultarPaginacion($cantidad, $pagina){
            return "select id, accion, datos, fecha, hora, actor
                    from log order by id DESC 
                    limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
        }

        public function consultarCantidad(){
            return "select count(id)
                    from log";
        }
    }

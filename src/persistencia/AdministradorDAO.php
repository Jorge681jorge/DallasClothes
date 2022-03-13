<?php
class AdministradorDAO{
    private $idAdministrador;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $foto;

    public function AdministradorDAO($idAdministrador = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $foto = ""){
        $this -> idAdministrador = $idAdministrador;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> foto = $foto;
    }

    public function BuscarLog(){
        return "select idAdministrador
                from administrador 
                where correo = '" . $this -> correo .  "'";
    }

    public function autenticar(){
        return "select idAdministrador 
                from administrador 
                where correo = '" . $this -> correo .  "' and clave = '" . md5($this -> clave) . "'";
    }

    public function consultar(){
        return "select nombre, apellido, correo, foto, clave
                from administrador
                where idAdministrador = '" . $this -> idAdministrador .  "'";
    }

    public function consultarTodos(){
        return "select idAdministrador, nombre, apellido, correo
                from administrador";
    }

    public function consultarPaginacion($cantidad, $pagina){
        return "select idAdministrador, nombre, apellido, correo
                from administrador
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }


    public function consultarCantidad(){
        return "select count(idAdministrador)
                from administrador";
    }
    
    public function consultarCantidadFiltro($filtro){
        return "select count(idAdministrador)
                from administrador
                where idAdministrador like '%" . $filtro . "%' or nombre like '" . $filtro . "%' or apellido like '" . $filtro . "%' or correo like '" . $filtro . "%'   ";             
    }
    
    public function consultarPaginacionFiltro($cantidad, $pagina, $filtro){
        return "select idAdministrador, nombre, apellido, correo
                from administrador
                where idAdministrador like '%" . $filtro . "%' or nombre like '" . $filtro . "%' or apellido like '" . $filtro . "%' or correo like '" . $filtro . "%'
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    } 


    public function editarColumn($column,$editableObj,$id){
        $sql = "UPDATE administrador set " . $column . " = '".$editableObj."' WHERE  idAdministrador=".$id;
        return $sql;
    }
 

    public function existeCorreo(){
        return "select correo
                from administrador
                where correo = '" . $this -> correo .  "'";
    }
    
    public function editar(){
        return "update administrador
                set nombre = '" . $this -> nombre . "', apellido = '" . $this -> apellido . 
                "', foto = '" . $this -> foto . 
                "' where idAdministrador = '" . $this -> idAdministrador .  "'";
    }

    public function editarClave(){
        return "update administrador
                set clave = '" .  md5($this -> clave)  . 
                "' where idAdministrador = '" . $this -> idAdministrador .  "'";
    }
}

?>
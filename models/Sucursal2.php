<?php 
    class Sucursal2 extends Conectar{

        public function get_sucursal2(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_sucursal WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>
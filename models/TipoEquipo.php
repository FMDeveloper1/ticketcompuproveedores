<?php 
    class TipoEquipo extends Conectar{

        public function get_tipoequipo(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_tipoequipo WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>
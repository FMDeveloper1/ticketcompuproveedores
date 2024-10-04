<?php 
    class LugarServicio extends Conectar{

        public function get_lugarservicio(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_lugarservicio WHERE est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>
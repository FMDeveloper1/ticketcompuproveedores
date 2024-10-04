<?php
class Sucursal extends Conectar {

    public function insert_sucursal($suc_nom) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_sucursal (suc_id, suc_nom, est) 
                VALUES (NULL, ?, '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $suc_nom);
        if ($sql->execute()) {
            return true; // Indicar que la inserción fue exitosa
        } else {
            return false; // Indicar que la inserción falló
        }
    }

    public function update_sucursal($suc_id, $suc_nom) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_sucursal SET
                suc_nom = ?
                WHERE suc_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $suc_nom);
        $sql->bindValue(2, $suc_id);
        if ($sql->execute()) {
            return true; // Indicar que la actualización fue exitosa
        } else {
            return false; // Indicar que la actualización falló
        }
    }

    public function delete_sucursal($suc_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_sucursal SET est = '0' WHERE suc_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $suc_id);
        if ($sql->execute()) {
            return true; // Indicar que la eliminación fue exitosa
        } else {
            return false; // Indicar que la eliminación falló
        }
    }

    public function get_sucursal() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_sucursal WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_sucursal_x_id($suc_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_sucursal WHERE suc_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $suc_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

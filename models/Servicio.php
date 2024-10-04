<?php
class Servicio extends Conectar {

    public function insert_servicio($ser_nom) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_servicio (ser_id, ser_nom, est) 
                VALUES (NULL, ?, '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ser_nom);
        if ($sql->execute()) {
            return true; // Indicar que la inserción fue exitosa
        } else {
            return false; // Indicar que la inserción falló
        }
    }

    public function update_servicio($ser_id, $ser_nom) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_servicio SET
                ser_nom = ?
                WHERE ser_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ser_nom);
        $sql->bindValue(2, $ser_id);
        if ($sql->execute()) {
            return true; // Indicar que la actualización fue exitosa
        } else {
            return false; // Indicar que la actualización falló
        }
    }

    public function delete_servicio($ser_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_servicio SET est = '0' WHERE ser_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ser_id);
        if ($sql->execute()) {
            return true; // Indicar que la eliminación fue exitosa
        } else {
            return false; // Indicar que la eliminación falló
        }
    }

    public function get_servicio() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_servicio WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_servicio_x_id($ser_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_servicio WHERE ser_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ser_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

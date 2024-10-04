<?php
class Cliente extends Conectar {

    public function get_cliente_by_id($cli_id) {
        // Connect to the database
        $conectar = parent::conexion();
        parent::set_names();

        // Prepare the SQL statement to fetch client data by cli_id
        $sql = "SELECT * FROM tm_cli WHERE cli_id = :cli_id AND est=1";
        $stmt = $conectar->prepare($sql);

        // Check if the statement preparation was successful
        if (!$stmt) {
            die('Error preparing statement: ' . implode(":", $conectar->errorInfo()));
        }

        // Bind the cli_id to the prepared statement
        $stmt->bindValue(':cli_id', $cli_id, PDO::PARAM_INT);

        // Execute the statement and check for errors
        if (!$stmt->execute()) {
            die('Error executing statement: ' . implode(":", $stmt->errorInfo()));
        }

        // Fetch the client data and return it
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    public function insert_cliente($cli_nom, $cli_ape, $cli_rfc, $cli_dir, $cli_ciu, $cli_est, $cli_cont, $cli_cel, $cli_tel, $cli_ext, $cli_telext, $cli_correo, $usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_cli (cli_id, cli_nom, cli_ape, cli_rfc, cli_dir, cli_ciu, cli_est, cli_cont, cli_cel, cli_tel, cli_ext, cli_telext, cli_correo, usu_id, est) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cli_nom);
        $sql->bindValue(2, $cli_ape);
        $sql->bindValue(3, $cli_rfc);
        $sql->bindValue(4, $cli_dir);
        $sql->bindValue(5, $cli_ciu);
        $sql->bindValue(6, $cli_est);
        $sql->bindValue(7, $cli_cont);
        $sql->bindValue(8, $cli_cel);
        $sql->bindValue(9, $cli_tel);
        $sql->bindValue(10, $cli_ext);
        $sql->bindValue(11, $cli_telext);
        $sql->bindValue(12, $cli_correo);
        $sql->bindValue(13, $usu_id);
        $sql->execute();
    }

    public function update_cliente($cli_id, $cli_nom, $cli_ape, $cli_rfc, $cli_dir, $cli_ciu, $cli_est, $cli_cont, $cli_cel, $cli_tel, $cli_ext, $cli_telext, $cli_correo, $usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_cli SET
                cli_nom = ?,
                cli_ape = ?,
                cli_rfc = ?,
                cli_dir = ?,
                cli_ciu = ?,
                cli_est = ?,
                cli_cont = ?,
                cli_cel = ?,
                cli_tel = ?,
                cli_ext = ?,
                cli_telext = ?,
                cli_correo = ?,
                usu_id = ?
                WHERE cli_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cli_nom);
        $sql->bindValue(2, $cli_ape);
        $sql->bindValue(3, $cli_rfc);
        $sql->bindValue(4, $cli_dir);
        $sql->bindValue(5, $cli_ciu);
        $sql->bindValue(6, $cli_est);
        $sql->bindValue(7, $cli_cont);
        $sql->bindValue(8, $cli_cel);
        $sql->bindValue(9, $cli_tel);
        $sql->bindValue(10, $cli_ext);
        $sql->bindValue(11, $cli_telext);
        $sql->bindValue(12, $cli_correo);
        $sql->bindValue(13, $usu_id);
        $sql->bindValue(14, $cli_id);
        $sql->execute();
    }

    public function delete_cliente($cli_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_cli SET est = '0', fech_eli = now() WHERE cli_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cli_id);
        $sql->execute();
    }

    public function get_cliente() {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT c.*, u.usu_nom as asesor_nom FROM tm_cli c
                JOIN tm_usuario u ON c.usu_id = u.usu_id
                WHERE c.est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_cliente_x_id($cli_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_cli WHERE cli_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cli_id);
        $sql->execute();
        return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

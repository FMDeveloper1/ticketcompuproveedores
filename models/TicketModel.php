<?php
require_once("../config/conexion.php");

class TicketModel extends Conectar {
    
    public function get_ticket_by_id($tick_id) {
        $conectar = parent::conexion();  // Obtén la conexión
        parent::set_names();  // Configura los nombres para la conexión
        
        // Consulta SQL
        $sql = "SELECT * FROM tm_ticket WHERE tick_id = ?";
        $sql = $conectar->prepare($sql);  // Prepara la consulta
        
        // Enlaza el parámetro
        $sql->bindParam(1, $tick_id, PDO::PARAM_INT);
        
        // Ejecuta la consulta
        $sql->execute();
        
        // Devuelve la primera fila encontrada, ya que se espera solo un ticket
        return $sql->fetch(PDO::FETCH_ASSOC);  // Devuelve un array asociativo
    }
}
?>

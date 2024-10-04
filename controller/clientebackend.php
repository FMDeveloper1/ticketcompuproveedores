<?php
require_once("../config/conexion.php");
require_once("../models/Cliente.php");

$conectar = new Conectar();
$cliente = new Cliente($conectar);

if (isset($_POST['cli_id'])) {
    $cli_id = $_POST['cli_id'];
    
    $client_data = $cliente->get_cliente_by_id($cli_id);
    
    header('Content-Type: application/json');
    echo json_encode($client_data);
} else {
    echo json_encode(['error' => 'No client ID provided']);
}
?>

ob_start();  // Inicia la captura de la salida para prevenir errores de salida
<?php
require_once("../fpdf/fpdf.php");
require_once("../models/TicketModel.php");

// Recibe el ID del ticket
if (isset($_GET['tick_id'])) {
    $tick_id = $_GET['tick_id'];

    // Crea una instancia del modelo
    $ticketModel = new TicketModel();
    $ticket = $ticketModel->get_ticket_by_id($tick_id);

    if ($ticket) {
        // Crea el PDF utilizando los datos del ticket
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        if (isset($ticket['tick_id'], $ticket['cli_nom'], $ticket['cli_ape'])) {
            $pdf->Cell(40, 10, 'Ticket ID: ' . $ticket['tick_id']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Cliente: ' . $ticket['cli_nom'] . ' ' . $ticket['cli_ape']);
        } else {
            echo "Datos del ticket no encontrados.";
            exit;
        }

        ob_end_clean();  // Limpia el buffer de salida antes de generar el PDF
        $pdf->Output();
    } else {
        echo "No se encontró el ticket.";
    }
} else {
    echo "No se proporcionó un ID de ticket.";
}
?>
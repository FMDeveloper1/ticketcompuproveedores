<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    require_once("../models/Usuario.php");
    $usuario = new Usuario();

    require_once("../fpdf/fpdf.php");

    switch($_GET["op"]){
        
        case "insert":
            $tick_dir = $_POST["cli_dir"];
            $tick_ciu = $_POST["cli_ciu"];
            $tick_est = $_POST["cli_est"];
            $tick_cont = $_POST["cli_cont"];
            $tick_rfc = $_POST["cli_rfc"];
            $tick_cel = $_POST["cli_cel"];
            $tick_tel = $_POST["cli_tel"];
            $tick_ext = $_POST["cli_ext"];
            $tick_telext = $_POST["cli_telext"];
            $tick_correo = $_POST["cli_correo"];
            $tick_otros = isset($_POST["tick_otros"]) ? implode(',', $_POST["tick_otros"]) : '';
            $tick_acces = isset($_POST["tick_acces"]) ? implode(',', $_POST["tick_acces"]) : '';
    
            
            $datos=$ticket->insert_ticket(
                $_POST["usu_id"],
                $_POST["cli_id"],      
                $_POST["ser_id"],
                $_POST["suc_id"],
                $_POST["tipequi_id"],
                $_POST["tick_descrip"],
                $_POST["lug_id"],
                $_POST["tick_mar"],
                $_POST["tick_mod"],
                $_POST["suc_id2"],
                $tick_rfc,
                $_POST["fech_ini"],
                $_POST["fech_ter"],
                $tick_dir,   
                $tick_ciu,   
                $tick_est,    
                $tick_cont,  
                $tick_cel,  
                $tick_tel,   
                $tick_ext, 
                $tick_telext,
                $tick_correo,
                $_POST["tick_nserie"],
                $tick_otros,
                $tick_acces
                
            );
            echo json_encode($datos);
            break;

        case "update":
            $ticket->update_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"], $_POST["usu_id"]);
        
        break;
        case "reabrir":
            $ticket->reabrir_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_reabrir($_POST["tick_id"], $_POST["usu_id"]);
        
        break;

        case "asignar":
            $ticket->update_ticket_asignacion($_POST["tick_id"], $_POST["usu_asig"]);
        
        break;

        case "listar_x_usu":
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["usu_id"].' - '.$row["usu_nom"].' '.$row['usu_ape'];
                $sub_array[] = $row["suc_nom"];
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["ser_nom"];
                $sub_array[] = $row["tipequi_nom"];
                $sub_array[] = $row["cli_nom"]. ' '.$row['cli_ape'];
                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }else{
                    $sub_array[] = '<a onClick="CambiarEstado('.$row["tick_id"].')"><span class="label label-pill label-danger">Cerrado</span><a/>';
                }
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                
                if($row["fech_asig"]==null){
                    $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
                }

                if($row["usu_asig"]==null){
                    $sub_array[] = '<span class="label label-pill label-warning">Sin Asignar</span>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_asig"]);
                    foreach($datos1 as $row1){
                        $sub_array[] = '<span class="label label-pill label-success">'. $row1["usu_nom"].'</span>';
                    }
                }

                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listar":
            $datos=$ticket->listar_ticket();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["usu_id"].' - '.$row["usu_nom"].' '.$row['usu_ape'];
                $sub_array[] = $row["suc_nom"];
                $sub_array[] = $row["lug_nom"];
                $sub_array[] = $row["ser_nom"];
                $sub_array[] = $row["tipequi_nom"];
                $sub_array[] = $row["cli_nom"]. ' '.$row['cli_ape'];

                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }else{
                    $sub_array[] = '<a onClick="CambiarEstado('.$row["tick_id"].')"><span class="label label-pill label-danger">Cerrado</span></a>';
                }
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                
                if($row["fech_asig"]==null){
                    $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
                }

                if($row["usu_asig"]==null){
                    $sub_array[] = '<a onClick="asignar('.$row["tick_id"].');"><span class="label label-pill label-warning">Sin Asignar</span></a>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_asig"]);
                    foreach($datos1 as $row1){
                        $sub_array[] = '<span class="label label-pill label-success">'. $row1["usu_nom"].'</span>';
                    }
                }

                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;

        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?>
                <?php
                    foreach($datos as $row){
                        ?>
                            <article class="activity-line-item box-typical">
                                <div class="activity-line-date">
                                    <?php echo date("d/m/Y", strtotime($row["fech_crea"]));?>
                                </div>
                                <header class="activity-line-item-header">
                                    <div class="activity-line-item-user">
                                        <div class="activity-line-item-user-photo">
                                            <a href="#">
                                                <img src="../../public/<?php echo $row['rol_id'] ?>.png" alt="">
                                            </a>
                                        </div>
                                        <div class="activity-line-item-user-name"><?php echo $row['usu_nom'].' '.$row['usu_ape'];?></div>
                                        <div class="activity-line-item-user-status">
                                            <?php 
                                                if ($row['rol_id']==1){
                                                    echo 'Asesor';
                                                }else{
                                                    echo 'Agente';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </header>
                                <div class="activity-line-action-list">
                                    <section class="activity-line-action">
                                        <div class="time"><?php echo date("H:i:s", strtotime($row["fech_crea"]));?></div>
                                        <div class="cont">
                                            <div class="cont-in">
                                                <p>
                                                    <?php echo $row["tickd_descrip"];?>
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </article>
                        <?php
                    }
                ?>
            <?php
        break;


        case "mostrar";
            $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tick_id"] = $row["tick_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["cli_id"] = $row["cli_id"];
                    $output["ser_id"] = $row["ser_id"];
                    $output["lug_id"] = $row["lug_id"];
                    $output["tipequi_id"] = $row["tipequi_id"];
                    $output["tick_nserie"] = $row["tick_nserie"];
                    

                    $output["tick_descrip"] = $row["tick_descrip"];

                    if ($row["tick_estado"]=="Abierto"){
                        $output["tick_estado"] = '<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["tick_estado"] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }

                    $output["tick_estado_texto"] = $row["tick_estado"];

                    $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["cli_nom"] = $row["cli_nom"];
                    $output["cli_ape"] = $row["cli_ape"];
                    $output["ser_nom"] = $row["ser_nom"];
                    $output["lug_nom"] = $row["lug_nom"];
                    $output["tipequi_nom"] = $row["tipequi_nom"];
                    $output["tick_nserie"] = $row["tick_nserie"];
                }
                
                echo json_encode($output);
            }   
        break;
        
        case "insertdetalle":
            $ticket->insert_ticketdetalle($_POST["tick_id"],$_POST["usu_id"],$_POST["tickd_descrip"]);
        break;

        case "total";
            $datos=$ticket->get_ticket_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];

                }
            echo json_encode($output); 
            }
        break;

        case "totalabierto";
            $datos=$ticket->get_ticket_totalabierto();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];

                }
            echo json_encode($output); 
            }
        break;

        case "totalcerrado";
            $datos=$ticket->get_ticket_totalcerrado();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];

                }
            echo json_encode($output); 
            }
        break;

        case "grafico";
            $datos=$ticket->get_ticket_grafico();  
            echo json_encode($datos);
        break;


        case "generar_pdf":
            if (isset($_GET['tick_id'])) {
                $tick_id = $_GET['tick_id'];
        
                $datos = $ticket->get_ticket_by_id($tick_id);
                $tick_acces = !empty($datos["tick_acces"]) ? explode(',', $datos["tick_acces"]) : ['N/A'];
                $tick_otros = !empty($datos["tick_otros"]) ? explode(',', $datos["tick_otros"]) : ['N/A'];

        
                if ($datos) {

                    class PDF extends FPDF
                    {

                        function Header()
                        {
                            $this->SetFont('Arial', 'B', 14);
                            $this->Cell(0, 10, 'PDF DE SOLICITUD DE SERVICIO A CLIENTES', 0, 1, 'L');
                            $this->Ln(10); 
                        }
        
                        function Footer()
                        {
                            $this->SetY(-15);
                            $this->SetFont('Arial', 'I', 8);
                            $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
                        }
                    }
        
                    $pdf = new PDF();
                    $pdf->AddPage();
                    $pdf->Image('../public/logo.png', 5, 20, 40); 
                    $pdf->SetFont('Arial', 'B', 16);
                            
                    $pdf->SetXY(45, 20);
                    $pdf->Cell(50, 35, 'SOLICITUD DE', 0, 1, 'C');
                    $pdf->SetXY(45, 25);
                    $pdf->Cell(50, 35, 'SERVICIO', 0, 1, 'C');

                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->SetXY(100, 30);

                    $pdf->Cell(40, 5, 'FECHA', 1, 1, 'C');
                    $pdf->SetX(110); 

                    $fecha_array = explode("-", $datos["fech_ini"]); 

                    // Día
                    $pdf->SetFont('Arial', '', 6);
                    $pdf->SetX(100);
                    $pdf->Cell(13.33, 8, '', 1, 0);  
                    $pdf->SetXY(100, 32); 
                    $pdf->Cell(13.33, 10, iconv('UTF-8', 'ISO-8859-1', 'Día'), 0, 0, 'C'); 
                    $pdf->SetXY(100, 40); 
                    $pdf->Cell(13.33, 2, $fecha_array[2], 0, 0, 'C'); 

                    // Mes
                    $pdf->SetXY(113.33, 35);
                    $pdf->Cell(13.33, 8, '', 1, 0); 
                    $pdf->SetXY(113.33, 32); 
                    $pdf->Cell(13.33, 10, 'Mes', 0, 0, 'C'); 
                    $pdf->SetXY(113.33, 40);  
                    $pdf->Cell(13.33, 2, $fecha_array[1], 0, 0, 'C'); 

                    // Año
                    $pdf->SetXY(126.66, 35);
                    $pdf->Cell(13.33, 8, '', 1, 0); 
                    $pdf->SetXY(126.66, 32); 
                    $pdf->Cell(13.33, 10, iconv('UTF-8', 'ISO-8859-1', 'Año'), 0, 0, 'C'); 
                    $pdf->SetXY(126.66, 40); 
                    $pdf->Cell(13.33, 2, $fecha_array[0], 0, 1, 'C'); 

                    $pdf->SetXY(100, 45);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(40, 5, 'VIGENCIA', 1, 1, 'C');
                    $vigencia_array = explode("-", $datos["fech_ter"]);

                    $pdf->SetFont('Arial', '', 6);
                    $pdf->SetX(100);
                    $pdf->Cell(13.33, 8, '', 1, 0); 
                    $pdf->SetXY(100, $pdf->GetY() - 6); 
                    $pdf->Cell(13.33, 16, iconv('UTF-8', 'ISO-8859-1', 'Día'), 0, 0, 'C');
                    $pdf->SetXY(100, $pdf->GetY() + 4); 
                    $pdf->Cell(13.33, 16, $vigencia_array[2], 0, 0, 'C');

                    $pdf->SetXY(113.33, 50);
                    $pdf->Cell(13.33, 8, '', 1, 0);
                    $pdf->SetXY(113.33, $pdf->GetY() - 6);  
                    $pdf->Cell(13.33, 16, 'Mes', 0, 0, 'C');
                    $pdf->SetXY(113.33, $pdf->GetY() + 4);  
                    $pdf->Cell(13.33, 16, $vigencia_array[1], 0, 0, 'C');

                    $pdf->SetXY(126.66, 50);
                    $pdf->Cell(13.33, 8, '', 1, 1);  
                    $pdf->SetXY(126.66, $pdf->GetY() - 7); 
                    $pdf->Cell(13.33, 2, iconv('UTF-8', 'ISO-8859-1', 'Año'), 0, 0, 'C');
                    $pdf->SetXY(126.66, $pdf->GetY() + 4); 
                    $pdf->Cell(13.33, 1, $vigencia_array[0], 0, 1, 'C');


                    $pdf->SetXY(145, 30);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(40, 5, 'FOLIO', 1, 1, 'C'); 
                    $pdf->SetXY(145, 35);
                    $pdf->SetFont('Arial', '', 6);
                    $pdf->Cell(40, 8, $datos["tick_id"], 1, 1, 'C'); 

                    $pdf->SetXY(145, 45);
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(40, 5, iconv('UTF-8', 'ISO-8859-1', 'CóDIGO').' DE SERVICIO', 1, 1, 'C'); 
                    $pdf->SetX(145);
                    $pdf->SetFont('Arial', '', 6);
                    $pdf->Cell(40, 8, '772026', 1, 1, 'C');

                    $pdf->Ln(5);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(0, 5, 'DATOS DEL CLIENTE', 1, 1, 'C');
                    $pdf->SetFont('Arial', '', 6);
        
                    $pdf->Cell(95, 5, 'NOMBRE DEL CLIENTE: ' . $datos["cli_nom"] . ' ' . $datos["cli_ape"], 1, 0, 'L');
                    $pdf->Cell(95, 5, 'NO. DEL CLIENTE: ' . $datos["cli_id"], 1, 1, 'L');
                    $pdf->Cell(95, 5, iconv('UTF-8', 'ISO-8859-1', 'DIRECCIóN:   ') . $datos["tick_dir"], 1, 0, 'L');
                    $pdf->Cell(95, 5, 'RFC: ' . $datos["tick_rfc"], 1, 1, 'L');
                    $pdf->Cell(95, 5, iconv('UTF-8', 'ISO-8859-1', 'POBLACIóN:   ') . $datos["tick_est"], 1, 0, 'L');
                    $pdf->Cell(95, 5, 'VENDEDOR: ' . $datos["usu_nom"] . ' ' . $datos["usu_ape"], 1, 1, 'L');
                    $pdf->Cell(95, 5, 'CONTACTAR A: ' . $datos["tick_cont"], 1, 0, 'L');
                    $pdf->Cell(95, 5, 'CORREO: ' . $datos["tick_correo"], 1, 1, 'L');
                    $pdf->Cell(0, 5, 'TELEFONO: ' . $datos["tick_tel"] . '                               EXT:  ' . $datos["tick_ext"] . '                               TELEFONO ADICIONAL:  ' . $datos["tick_telext"]. '     CELULAR:     ' . $datos["tick_cel"], 1, 1, 'L');
        
                    $pdf->Ln(5);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(0, 5, 'DESCRIPCION DEL SERVICIO EN PROCESO', 1, 1, 'C');
                    $pdf->SetFont('Arial', '', 6);
                    $pdf->Cell(95, 5, 'SUCURSAL:     ' . $datos["suc_nom"], 1, 0, 'L');
                    $pdf->Cell(95, 5, 'LUGAR DE SERVICIO:    ' . $datos["lug_nom"], 1, 1, 'L');
                    $pdf->Cell(95, 5, 'TIPO DE SERVICIO:    ' . $datos["ser_nom"], 1, 0, 'L');
                    $pdf->Cell(95, 5, 'TIPO DE EQUIPO:    ' . $datos["tipequi_nom"], 1, 1, 'L');

                    $pdf->Ln(5);

                    $pdf->SetXY(10, 115); 
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(63.33, 6, 'MARCA:', 1, 0, 'C'); 
                    $pdf->SetXY(10, $pdf->GetY() + 6); 
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(63.33, 6, $datos["tick_mar"], 1, 0, 'C'); 

                    $pdf->SetXY(10 + 63.33, 115);
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(63.33, 6, 'MODELO:', 1, 0, 'C'); 
                    $pdf->SetXY(73.33, $pdf->GetY() + 6); 
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(63.33, 6, $datos["tick_mod"], 1, 0, 'C'); 

                    $pdf->SetXY(10 + 126.66, 115); 
                    $pdf->SetFont('Arial', 'B', 8);
                    $pdf->Cell(63.33, 6, iconv('UTF-8', 'ISO-8859-1', 'NúMERO DE SERIE:'), 1, 0, 'C'); 
                    $pdf->SetXY(136.66, $pdf->GetY() + 6); 
                    $pdf->SetFont('Arial', '', 10);
                    $pdf->Cell(63.33, 6, $datos["tick_nserie"], 1, 1, 'C');

                    $pdf->Ln(5);

                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(0, 5, iconv('UTF-8', 'ISO-8859-1', 'RECEPCIóN').' DE', 1, 1, 'C');
                    $pdf->SetX(10);
                    $pdf->Cell(190, 40, '', 1, 1);

                    $separationX = 105; 
                    $pdf->Line($separationX, $pdf->GetY() -40, $separationX, $pdf->GetY()); 

                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetXY(12, $pdf->GetY() - 40); 
                    $pdf->Cell(93, 10, 'OTROS:', 0, 1, 'L'); 

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->SetX(12); 
                    $lineY = $pdf->GetY() -1;
                    foreach ($tick_acces as $index => $accesorio) {
                        $pdf->Cell(93, 4, trim($accesorio), 0, 1, 'L');
                        $lineY += 1; 
                    }

                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetXY($separationX + 2, $pdf->GetY() - 14); 
                    $pdf->Cell(93, 10, 'ACCESORIOS:', 0, 1, 'L'); 

                    $pdf->SetFont('Arial', '', 8);
                    $pdf->SetX($separationX + 2); 
                    $lineY = $pdf->GetY();
                    foreach ($tick_otros as $index => $otro) {
                        $pdf->Cell(93, 4, trim($otro), 0, 1, 'L'); 
                        $lineY += 1; 
                    }

                    $pdf->Ln(5);
                    $pdf->SetXY(10, 180); 
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->Cell(0, 8, 'FALLA REPORTADA', 1, 1, 'C');
                    $pdf->SetFont('Arial', '', 8);
                    $descripcion = $datos["tick_descrip"];
                    $descripcion_limpia = preg_replace('/^<p>|<\/p>$/', '', $descripcion);
                    $pdf->MultiCell(0, 10, iconv('UTF-8', 'ISO-8859-1', $descripcion_limpia), 1, 'L');

                    // Posición inicial del apartado de firmas
                    $pdf->SetY($pdf->GetY() + 10); 

                    $totalWidth = 190; 
                    $columnWidth = $totalWidth / 3; 

                    // Línea y firma del Técnico Asignado
                    $pdf->SetX(10); 
                    $pdf->Cell($columnWidth, 6, '', 0, 1, 'C');
                    $pdf->Line(15, $pdf->GetY() - 1, 70, $pdf->GetY() - 1); // Dibuja la línea 
                    $pdf->Ln(1);
                    $pdf->SetX(10);
                    $pdf->SetFont('Arial', '', 5);
                    $pdf->Cell($columnWidth, 1, iconv('UTF-8', 'ISO-8859-1', 'NOMBRE Y FIRMA DEL TÉCNICO'), 0, 0, 'C');
                    $pdf->Ln(3);
                    $pdf->Cell($columnWidth, 1, iconv('UTF-8', 'ISO-8859-1', 'ASIGNADO AL SERVICIO'), 0, 0, 'C');

                    // Línea y firma del Ejecutivo Comercial
                    $pdf->SetX($pdf->GetX() + $columnWidth); 
                    $pdf->Cell($columnWidth, 6, '', 0, 1, 'C'); 
                    $pdf->Line(80, $pdf->GetY() - 13, 130, $pdf->GetY() - 13); // Dibuja la línea 
                    $pdf->Ln(1);
                    $pdf->SetX(10 + $columnWidth);
                    $pdf->SetFont('Arial', '', 5);
                    $pdf->Cell($columnWidth, -20, iconv('UTF-8', 'ISO-8859-1', 'NOMBRE Y FIRMA DE ENTERADO DEL'), 0, 0, 'C');
                    $pdf->Ln(3);
                    $pdf->SetX(10 + $columnWidth);
                    $pdf->Cell($columnWidth, -20, iconv('UTF-8', 'ISO-8859-1', 'EJECUTIVO COMERCIAL'), 0, 0, 'C');

                    // Línea y firma del Cliente
                    $pdf->SetX($pdf->GetX() + $columnWidth); 
                    $pdf->Cell($columnWidth, 10, '', 0, 1, 'C'); 
                    $pdf->Line(140, $pdf->GetY() -26, 190, $pdf->GetY() - 26); // Dibuja la línea
                    $pdf->Ln(1);
                    $pdf->SetX(10 + (2 * $columnWidth));
                    $pdf->SetFont('Arial', '', 5);
                    $pdf->Cell($columnWidth, -41, iconv('UTF-8', 'ISO-8859-1', 'NOMBRE Y FIRMA DEL CLIENTE'), 0, 0, 'C');

                    $pdf->SetXY(10, 219);
                    $pdf->SetFont('Arial', '', 7);
                    $pdf->Cell(0, 8, 'POLITICAS', 0, 0, 'C');
                    $pdf->Ln(2);
                    $pdf->SetFont('Arial', '', 8);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '1. Toda solicitud será descrita de forma clara para ofrecerle un mejor servicio.'), 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '2. La recepción y atención de las solicitudes de servicio se efectuará conforme se vayan recibiendo de acuerdo al número de su reporte.'), 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '3. El tiempo estimado para realizar el diagnóstico de su equipo será de 48 horas, posteriores a la recepción de su solicitud. El diagnostico'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'tiene un costo de $200 pesos, el cual deberá cubrirlo al momento de ingresar su equipo. Sin factura y pago de diagnóstico este reporte no'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'será procesado.'), 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '4. El tiempo de reparación del equipo estará sujeto a la autorización del Cliente y de acuerdo a la disponibilidad de componentes en'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'Compuproveedores, fabricantes y/o proveedores.'), 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '5. El Cliente recibirá una liga al correo electrónico que indicó al momento de ingresar su equipo, en donde podrá consultar el seguimiento a'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'su servicio.'), 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '6. Una vez que reciba la notificación por correo electrónico, de que su equipo ha sido reparado podrá pasar a nuestras oficinas en un horario'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'de lunes a viernes de 8:00 a.m. a 12:00 p.m. y de 2:00 p.m. a 4:00 p.m.'), 0, 0, 'L');
                    $pdf->Ln(4);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', '7. Una vez realizada la reparación de su equipo, podrá permanecer por 10 días hábiles en Compuproveedores/HP store, posteriormente del'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'día 11 al 20 hábil se cobrara un 3% diario del monto total de la reparación por concepto de almacenaje. Después de este periodo'), 0, 0, 'L');
                    $pdf->Ln(3);
                    $pdf->Cell(0, 8, iconv('UTF-8', 'ISO-8859-1', 'Compuproveeores no se hace responsable por el resguardo de su equipo.'), 0, 0, 'L');
                    
                    // Generar el PDF
                    $pdf->Output('D', 'Ticket_'.$tick_id.'.pdf');
                } else {
                    echo "No se encontraron datos para el ticket con ID: " . $tick_id;
                }
            } else {
                echo "No se proporcionó un ID de ticket.";
        }

        case "encuesta":
            $ticket->insert_encuesta($_POST["tick_id"],$_POST["tick_star"],$_POST["tick_coment"]);
        break;
        
        
        
        
        
    }
?>
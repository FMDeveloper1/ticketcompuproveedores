<?php
    require_once("../config/conexion.php");
    require_once("../models/Servicio.php");

    $rol_id = $_SESSION["rol_id"];

    if (!isset($_SESSION["usu_id"])) {
        $conexion = new Conectar();
        header("Location:" . $conexion->ruta() . "/index.php");
        exit();
    }
    
    $servicio = new Servicio();

    switch($_GET["op"]){
        case "combo":
            $datos = $servicio->get_servicio();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['ser_id']."'>".$row['ser_nom']."</option>";
                }
                echo $html;
            }
        break;

        case "guardaryeditar":
            if ($rol_id == 2) { 
                $ser_id = !empty($_POST["ser_id"]) ? $_POST["ser_id"] : null;
    
                if (empty($ser_id)) {
                    $servicio->insert_servicio($_POST["ser_nom"]);
                } else {
                    $servicio->update_servicio($ser_id, $_POST["ser_nom"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "No tiene permisos para realizar esta acción."]);
            }
            break;
    
        case "listar":
            $datos = $servicio->get_servicio();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["ser_id"];
                $sub_array[] = $row["ser_nom"];
                $sub_array[] = '<button type="button" onClick="editar(' . $row["ser_id"] . ');" id="' . $row["ser_id"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["ser_id"] . ');" id="' . $row["ser_id"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);
            break;
    
        case "eliminar":
            if ($rol_id == 2) {
                $servicio->delete_servicio($_POST["ser_id"]);
            } else {
                echo json_encode(["status" => "error", "message" => "No tiene permisos para realizar esta acción."]);
            }
            break;
    
        case "mostrar":
            $datos = $servicio->get_servicio_x_id($_POST["ser_id"]);
            if (is_array($datos) == true and count($datos) > 0) {
                foreach ($datos as $row) {
                    $output["ser_id"] = $row["ser_id"];
                    $output["ser_nom"] = $row["ser_nom"];
                }
                echo json_encode($output);
            }
            break;
    }
?>
<?php
    require_once("../config/conexion.php");
    require_once("../models/Sucursal.php");

    if (!isset($_SESSION["usu_id"])) {
        $conexion = new Conectar();
        header("Location:" . $conexion->ruta() . "/index.php");
        exit();
    }
    
    $rol_id = $_SESSION["rol_id"];
    $sucursal = new Sucursal();

    switch($_GET["op"]){
        case "combo":
            $datos = $sucursal->get_sucursal();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['suc_id']."'>".$row['suc_nom']."</option>";
                }
                echo $html;
            }
        break;

        case "guardaryeditar":
            if ($rol_id == 2) { 
                $suc_id = !empty($_POST["suc_id"]) ? $_POST["suc_id"] : null;
    
                if (empty($suc_id)) {
                    $result = $sucursal->insert_sucursal($_POST["suc_nom"]);
                    if ($result) {
                        echo json_encode(["status" => "success", "message" => "Sucursal registrada correctamente."]);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Error al registrar la sucursal."]);
                    }
                } else {
                    $result = $sucursal->update_sucursal($suc_id, $_POST["suc_nom"]);
                    if ($result) {
                        echo json_encode(["status" => "success", "message" => "Sucursal actualizada correctamente."]);
                    } else {
                        echo json_encode(["status" => "error", "message" => "Error al actualizar la sucursal."]);
                    }
                }
            } else {
                echo json_encode(["status" => "error", "message" => "No tiene permisos para realizar esta acción."]);
            }
            break;
    
        case "listar":
            $datos = $sucursal->get_sucursal();
            $data = array();
            foreach ($datos as $row) {
                $sub_array = array();
                $sub_array[] = $row["suc_id"];
                $sub_array[] = $row["suc_nom"];
                $sub_array[] = '<button type="button" onClick="editar(' . $row["suc_id"] . ');" id="' . $row["suc_id"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar(' . $row["suc_id"] . ');" id="' . $row["suc_id"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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
                $result = $sucursal->delete_sucursal($_POST["suc_id"]);
                if ($result) {
                    echo json_encode(["status" => "success", "message" => "Sucursal eliminada correctamente."]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Error al eliminar la sucursal."]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "No tiene permisos para realizar esta acción."]);
            }
            break;
    
        case "mostrar":
            $datos = $sucursal->get_sucursal_x_id($_POST["suc_id"]);
            if (is_array($datos) == true and count($datos) > 0) {
                foreach ($datos as $row) {
                    $output["suc_id"] = $row["suc_id"];
                    $output["suc_nom"] = $row["suc_nom"];
                }
                echo json_encode($output);
            }
            break;
    }
?>
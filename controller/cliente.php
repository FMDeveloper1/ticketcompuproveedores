<?php
require_once("../config/conexion.php");
require_once("../models/Cliente.php");
$cliente = new Cliente();

switch ($_GET["op"]) {
    case "guardaryeditar":
        if (empty($_POST["cli_id"])) {
            $cliente->insert_cliente(
                $_POST["cli_nom"], 
                $_POST["cli_ape"], 
                $_POST["cli_rfc"], 
                $_POST["cli_dir"], 
                $_POST["cli_ciu"], 
                $_POST["cli_est"], 
                $_POST["cli_cont"], 
                $_POST["cli_cel"], 
                $_POST["cli_tel"], 
                $_POST["cli_ext"], 
                $_POST["cli_telext"], 
                $_POST["cli_correo"], 
                $_POST["usu_id"]
            );
        } else {
            $cliente->update_cliente(
                $_POST["cli_id"], 
                $_POST["cli_nom"], 
                $_POST["cli_ape"], 
                $_POST["cli_rfc"], 
                $_POST["cli_dir"], 
                $_POST["cli_ciu"], 
                $_POST["cli_est"], 
                $_POST["cli_cont"], 
                $_POST["cli_cel"], 
                $_POST["cli_tel"], 
                $_POST["cli_ext"], 
                $_POST["cli_telext"], 
                $_POST["cli_correo"], 
                $_POST["usu_id"]
            );
        }
        break;

    case "listar":
        $datos = $cliente->get_cliente();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cli_nom"];
            $sub_array[] = $row["cli_ape"];
            $sub_array[] = $row["cli_rfc"];
            $sub_array[] = $row["cli_ciu"];
            $sub_array[] = $row["cli_correo"];
            $sub_array[] = $row["asesor_nom"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["cli_id"] . ');" id="' . $row["cli_id"] . '" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["cli_id"] . ');" id="' . $row["cli_id"] . '" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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
        $cliente->delete_cliente($_POST["cli_id"]);
        break;

    case "mostrar":
        $datos = $cliente->get_cliente_x_id($_POST["cli_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["cli_id"] = $row["cli_id"];
                $output["cli_nom"] = $row["cli_nom"];
                $output["cli_ape"] = $row["cli_ape"];
                $output["cli_rfc"] = $row["cli_rfc"];
                $output["cli_dir"] = $row["cli_dir"];
                $output["cli_ciu"] = $row["cli_ciu"];
                $output["cli_est"] = $row["cli_est"];
                $output["cli_cont"] = $row["cli_cont"];
                $output["cli_cel"] = $row["cli_cel"];
                $output["cli_tel"] = $row["cli_tel"];
                $output["cli_ext"] = $row["cli_ext"];
                $output["cli_telext"] = $row["cli_telext"];
                $output["cli_correo"] = $row["cli_correo"];
                $output["usu_id"] = $row["usu_id"];
            }
            echo json_encode($output);
        }
        break;
    
}
?>

<?php
    require_once("../config/conexion.php");
    require_once("../models/TipoEquipo.php");
    $tipoequipo = new TipoEquipo();

    switch($_GET["op"]){
        case "combo":
            $datos = $tipoequipo->get_tipoequipo();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['tipequi_id']."'>".$row['tipequi_nom']."</option>";
                }
                echo $html;
            }
        break;
    }
?>
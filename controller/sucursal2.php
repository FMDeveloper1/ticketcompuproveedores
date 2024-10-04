<?php
    require_once("../config/conexion.php");
    require_once("../models/Sucursal2.php");
    $sucursal2 = new Sucursal2();

    switch($_GET["op"]){
        case "combo":
            $datos = $sucursal2->get_sucursal2();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['suc_id']."'>".$row['suc_nom']."</option>";
                }
                echo $html;
            }
        break;
    }
?>
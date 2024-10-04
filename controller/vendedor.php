<?php
    require_once("../config/conexion.php");
    require_once("../models/Vendedor.php");
    $vendedor = new Vendedor();

    switch($_GET["op"]){
        case "combo":
            $datos = $vendedor->get_vendedor();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['ven_id']."'>".$row['ven_nom']."</option>";
                }
                echo $html;
            }
        break;
    }
?>
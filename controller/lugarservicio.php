<?php
    require_once("../config/conexion.php");
    require_once("../models/LugarServicio.php");
    $lugarservicio = new LugarServicio();

    switch($_GET["op"]){
        case "combo":
            $datos = $lugarservicio->get_lugarservicio();
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $html.= "<option value='".$row['lug_id']."'>".$row['lug_nom']."</option>";
                }
                echo $html;
            }
        break;
    }
?>
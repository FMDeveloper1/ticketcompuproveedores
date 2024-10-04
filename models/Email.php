<?php
require('class.phpmailer.php');
include('class.smtp.php');

require_once('../config/conexion.php');
require_once('../models/Ticket.php');

class Email extends PHPMailer{
    protected $gcorreo = 'developer@fmconsulting.mx'; //Credenciales para el correo
    protected $gpass = 'Test2024$$';

    public function ticket_abierto($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $sucursal = $row["suc_nom"];
            $servicio = $row["ser_nom"];
            $correo = $row["usu_correo"];
            $fech_ini = $row["fech_ini"];
            $fech_ter = $row["fech_ter"];
            $lugar = $row["lug_nom"];
            $tipequi = $row["tipequi_nom"];
            $tick_mar = $row["tick_mar"];
            $tick_mod = $row["tick_mod"];
            $tick_nserie = $row["tick_nserie"];
            
            $cliente = $row["cli_nom"];
            $tick_rfc = $row["tick_rfc"];
            $sucursal2 = $row["suc_nom"];
            $tick_dir = $row["tick_dir"];
            $tick_ciu = $row["tick_ciu"];
            $tick_est = $row["tick_est"];
            $tick_cont = $row["tick_cont"];
            $tick_cel = $row["tick_cel"];
            $tick_tel = $row["tick_tel"];
            $tick_ext = $row["tick_ext"];
            $tick_telext = $row["tick_telext"];
            $tick_correo = $row["tick_correo"];
            
            
        }
        
        $this->isSMTP();
        $this->Host = 'mail.fmconsulting.mx';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'ssl';
        $this-> FromName = "Ticket Abierto ".$id;
        $this->CharSet ='UTF-8';
        $this->setFrom($this->gcorreo, 'Departamento Sistema');
        //Agregar correos extras
        $this->addAddress($correo);
        //$this->addAddress('andresvondermeden@outlook.com')
        $this->WordWrap =50;
        $this->IsHTML(true);
        $this->SMTPDebug = 2;
        $this-> Subject = "Ticket Abierto";

        $cuerpo = file_get_contents('../public/NuevoTicket.html');
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblSuc", $sucursal, $cuerpo);
        $cuerpo = str_replace("lblSer", $servicio, $cuerpo);
        $cuerpo = str_replace("lblFechini", $fech_ini, $cuerpo);
        $cuerpo = str_replace("lblFechter", $fech_ter, $cuerpo);
        $cuerpo = str_replace("lblLug", $lugar, $cuerpo);
        $cuerpo = str_replace("lblTipequi", $tipequi, $cuerpo);
        $cuerpo = str_replace("lblMar", $tick_mar, $cuerpo);
        $cuerpo = str_replace("lblMod", $tick_mod, $cuerpo);
        $cuerpo = str_replace("lblNserie", $tick_nserie, $cuerpo);

        $cuerpo = str_replace("lblCli", $cliente, $cuerpo);
        $cuerpo = str_replace("lblClirfc", $tick_rfc, $cuerpo);
        $cuerpo = str_replace("lblClisuc", $sucursal2, $cuerpo);
        $cuerpo = str_replace("lblClidir", $tick_dir, $cuerpo);
        $cuerpo = str_replace("lblCliciu", $tick_ciu, $cuerpo);
        $cuerpo = str_replace("lblCliest", $tick_est, $cuerpo);
        $cuerpo = str_replace("lblClicont", $tick_cont, $cuerpo);
        $cuerpo = str_replace("lblClicel", $tick_cel, $cuerpo);
        $cuerpo = str_replace("lblClitel", $tick_tel, $cuerpo);
        $cuerpo = str_replace("lblCliext", $tick_ext, $cuerpo);
        $cuerpo = str_replace("lblClitelext", $tick_telext, $cuerpo);
        $cuerpo = str_replace("lblClicorreo", $tick_correo, $cuerpo);


        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Abierto");
        return $this->Send();


    }

    public function ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $sucursal = $row["suc_nom"];
            $servicio = $row["ser_nom"];
            $correo = $row["usu_correo"];
            $fech_ini = $row["fech_ini"];
            $fech_ter = $row["fech_ter"];
            $lugar = $row["lug_nom"];
            $tipequi = $row["tipequi_nom"];
            $tick_mar = $row["tick_mar"];
            $tick_mod = $row["tick_mod"];
            $tick_nserie = $row["tick_nserie"];
            
            $cliente = $row["cli_nom"];
            $tick_rfc = $row["tick_rfc"];
            $sucursal2 = $row["suc_nom"];
            $tick_dir = $row["tick_dir"];
            $tick_ciu = $row["tick_ciu"];
            $tick_est = $row["tick_est"];
            $tick_cont = $row["tick_cont"];
            $tick_cel = $row["tick_cel"];
            $tick_tel = $row["tick_tel"];
            $tick_ext = $row["tick_ext"];
            $tick_telext = $row["tick_telext"];
            $tick_correo = $row["tick_correo"];
            
            
        }
        
        $this->isSMTP();
        $this->Host = 'mail.fmconsulting.mx';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'ssl';
        $this-> FromName = "Ticket Cerrado ".$id;
        $this->CharSet ='UTF-8';
        $this->setFrom($this->gcorreo, 'Departamento Sistema');
        //Agregar correos extras
        $this->addAddress($correo);
        //$this->addAddress('andresvondermeden@outlook.com')
        $this->WordWrap =50;
        $this->IsHTML(true);
        $this->SMTPDebug = 2;
        $this-> Subject = "Ticket Cerrado";

        $cuerpo = file_get_contents('../public/CerradoTicket.html');
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblSuc", $sucursal, $cuerpo);
        $cuerpo = str_replace("lblSer", $servicio, $cuerpo);
        $cuerpo = str_replace("lblFechini", $fech_ini, $cuerpo);
        $cuerpo = str_replace("lblFechter", $fech_ter, $cuerpo);
        $cuerpo = str_replace("lblLug", $lugar, $cuerpo);
        $cuerpo = str_replace("lblTipequi", $tipequi, $cuerpo);
        $cuerpo = str_replace("lblMar", $tick_mar, $cuerpo);
        $cuerpo = str_replace("lblMod", $tick_mod, $cuerpo);
        $cuerpo = str_replace("lblNserie", $tick_nserie, $cuerpo);

        $cuerpo = str_replace("lblCli", $cliente, $cuerpo);
        $cuerpo = str_replace("lblClirfc", $tick_rfc, $cuerpo);
        $cuerpo = str_replace("lblClisuc", $sucursal2, $cuerpo);
        $cuerpo = str_replace("lblClidir", $tick_dir, $cuerpo);
        $cuerpo = str_replace("lblCliciu", $tick_ciu, $cuerpo);
        $cuerpo = str_replace("lblCliest", $tick_est, $cuerpo);
        $cuerpo = str_replace("lblClicont", $tick_cont, $cuerpo);
        $cuerpo = str_replace("lblClicel", $tick_cel, $cuerpo);
        $cuerpo = str_replace("lblClitel", $tick_tel, $cuerpo);
        $cuerpo = str_replace("lblCliext", $tick_ext, $cuerpo);
        $cuerpo = str_replace("lblClitelext", $tick_telext, $cuerpo);
        $cuerpo = str_replace("lblClicorreo", $tick_correo, $cuerpo);


        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Cerrado");
        return $this->Send();
    }

    public function ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach($datos as $row){
            $id = $row["tick_id"];
            $usu = $row["usu_nom"];
            $sucursal = $row["suc_nom"];
            $servicio = $row["ser_nom"];
            $correo = $row["usu_correo"];
            $fech_ini = $row["fech_ini"];
            $fech_ter = $row["fech_ter"];
            $lugar = $row["lug_nom"];
            $tipequi = $row["tipequi_nom"];
            $tick_mar = $row["tick_mar"];
            $tick_mod = $row["tick_mod"];
            $tick_nserie = $row["tick_nserie"];
            
            $cliente = $row["cli_nom"];
            $tick_rfc = $row["tick_rfc"];
            $sucursal2 = $row["suc_nom"];
            $tick_dir = $row["tick_dir"];
            $tick_ciu = $row["tick_ciu"];
            $tick_est = $row["tick_est"];
            $tick_cont = $row["tick_cont"];
            $tick_cel = $row["tick_cel"];
            $tick_tel = $row["tick_tel"];
            $tick_ext = $row["tick_ext"];
            $tick_telext = $row["tick_telext"];
            $tick_correo = $row["tick_correo"];
            
            
        }
        
        $this->isSMTP();
        $this->Host = 'mail.fmconsulting.mx';//Aqui el server
        $this->Port = 465;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gcorreo;
        $this->Password = $this->gpass;
        $this->From = $this->gcorreo;
        $this->SMTPSecure = 'ssl';
        $this-> FromName = "Ticket Asignado ".$id;
        $this->CharSet ='UTF-8';
        $this->setFrom($this->gcorreo, 'Departamento Sistema');
        //Agregar correos extras
        $this->addAddress($correo);
        //$this->addAddress('andresvondermeden@outlook.com')
        $this->WordWrap =50;
        $this->IsHTML(true);
        $this->SMTPDebug = 2;
        $this-> Subject = "Ticket Cerrado";

        $cuerpo = file_get_contents('../public/AsignarTicket.html');
        $cuerpo = str_replace("xnroticket", $id, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
        $cuerpo = str_replace("lblSuc", $sucursal, $cuerpo);
        $cuerpo = str_replace("lblSer", $servicio, $cuerpo);
        $cuerpo = str_replace("lblFechini", $fech_ini, $cuerpo);
        $cuerpo = str_replace("lblFechter", $fech_ter, $cuerpo);
        $cuerpo = str_replace("lblLug", $lugar, $cuerpo);
        $cuerpo = str_replace("lblTipequi", $tipequi, $cuerpo);
        $cuerpo = str_replace("lblMar", $tick_mar, $cuerpo);
        $cuerpo = str_replace("lblMod", $tick_mod, $cuerpo);
        $cuerpo = str_replace("lblNserie", $tick_nserie, $cuerpo);

        $cuerpo = str_replace("lblCli", $cliente, $cuerpo);
        $cuerpo = str_replace("lblClirfc", $tick_rfc, $cuerpo);
        $cuerpo = str_replace("lblClisuc", $sucursal2, $cuerpo);
        $cuerpo = str_replace("lblClidir", $tick_dir, $cuerpo);
        $cuerpo = str_replace("lblCliciu", $tick_ciu, $cuerpo);
        $cuerpo = str_replace("lblCliest", $tick_est, $cuerpo);
        $cuerpo = str_replace("lblClicont", $tick_cont, $cuerpo);
        $cuerpo = str_replace("lblClicel", $tick_cel, $cuerpo);
        $cuerpo = str_replace("lblClitel", $tick_tel, $cuerpo);
        $cuerpo = str_replace("lblCliext", $tick_ext, $cuerpo);
        $cuerpo = str_replace("lblClitelext", $tick_telext, $cuerpo);
        $cuerpo = str_replace("lblClicorreo", $tick_correo, $cuerpo);


        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Ticket Asignado");
        return $this->Send();
    }
}

?>
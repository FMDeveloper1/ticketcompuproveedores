<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    class Ticket extends Conectar{

        public function insert_ticket($usu_id, $cli_id, $ser_id, $suc_id, $tipequi_id, $tick_descrip, $lug_id, $tick_mar, $tick_mod, $suc_id2, $tick_rfc, $fech_ini, $fech_ter, $tick_dir, $tick_ciu, $tick_est, $tick_cont, $tick_cel, $tick_tel, $tick_ext, $tick_telext, $tick_correo, $tick_nserie, $tick_otros, $tick_acces){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (tick_id, usu_id, cli_id, ser_id, suc_id, tipequi_id, tick_descrip,tick_estado, lug_id, tick_mar, tick_mod, suc_id2, tick_rfc, fech_ini, fech_ter, tick_dir, tick_ciu, tick_est, tick_cont, tick_cel, tick_tel, tick_ext, tick_telext, tick_correo, tick_nserie, tick_otros, tick_acces, fech_crea, usu_asig, fech_asig, est) VALUES (NULL,?,?,?,?,?,?,'Abierto',?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,now(),NULL,NULL,'1')";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cli_id);
            $sql->bindValue(3, $ser_id);
            $sql->bindValue(4, $suc_id);
            $sql->bindValue(5, $tipequi_id);
            $sql->bindValue(6, $tick_descrip);
            $sql->bindValue(7, $lug_id);
            $sql->bindValue(8, $tick_mar);
            $sql->bindValue(9, $tick_mod);
            //$sql->bindValue(10, $ven_id);
            $sql->bindValue(10, $suc_id2);
            $sql->bindValue(11, $tick_rfc);
            $sql->bindValue(12, $fech_ini);
            $sql->bindValue(13, $fech_ter);
            $sql->bindValue(14, $tick_dir);
            $sql->bindValue(15, $tick_ciu);
            $sql->bindValue(16, $tick_est);
            $sql->bindValue(17, $tick_cont);
            $sql->bindValue(18, $tick_cel);
            $sql->bindValue(19, $tick_tel);
            $sql->bindValue(20, $tick_ext);
            $sql->bindValue(21, $tick_telext);
            $sql->bindValue(22, $tick_correo);
            $sql->bindValue(23, $tick_nserie);
            $sql->bindValue(24, $tick_otros);
            $sql->bindValue(25, $tick_acces);
            $sql->execute();
            $sql1="SELECT last_insert_id() AS 'tick_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id, 
                tm_ticket.usu_id,
                tm_ticket.cli_id, 
                tm_ticket.ser_id, 
                tm_ticket.tick_descrip, 
                tm_ticket.tick_estado,
                tm_ticket.lug_id, 
                tm_ticket.tick_mar, 
                tm_ticket.tick_mod, 
                tm_ticket.suc_id2, 
                tm_ticket.tick_rfc, 
                tm_ticket.fech_ini, 
                tm_ticket.fech_ter, 
                tm_ticket.tick_dir, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_est, 
                tm_ticket.tick_cont, 
                tm_ticket.tick_cel, 
                tm_ticket.tick_tel, 
                tm_ticket.tick_ext, 
                tm_ticket.tick_telext, 
                tm_ticket.tick_correo, 
                tm_ticket.tick_nserie, 
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuario.usu_nom, 
                tm_usuario.usu_ape, 
                tm_servicio.ser_nom, 
                tm_sucursal.suc_nom, 
                tm_tipoequipo.tipequi_nom, 
                tm_servicio.ser_nom, 
                tm_lugarservicio.lug_nom, 

                tm_cli.cli_nom,
                tm_cli.cli_ape

                FROM tm_ticket
                INNER JOIN tm_usuario ON tm_usuario.usu_id = tm_ticket.usu_id 
                INNER JOIN tm_tipoequipo ON tm_tipoequipo.tipequi_id = tm_ticket.tipequi_id 
                INNER JOIN tm_sucursal ON tm_sucursal.suc_id = tm_ticket.suc_id 
                INNER JOIN tm_servicio ON tm_ticket.ser_id = tm_servicio.ser_id 
                Inner Join tm_lugarservicio ON tm_ticket.lug_id = tm_lugarservicio.lug_id 
                INNER JOIN tm_cli ON tm_ticket.cli_id = tm_cli.cli_id
                WHERE tm_ticket.est=1 AND tm_usuario.usu_id=?" ;
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function listar_ticket(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id, 
                tm_ticket.usu_id,
                tm_ticket.cli_id, 
                tm_ticket.ser_id, 
                tm_ticket.tick_descrip, 
                tm_ticket.tick_estado,
                tm_ticket.lug_id, 
                tm_ticket.tick_mar, 
                tm_ticket.tick_mod, 
                tm_ticket.suc_id2, 
                tm_ticket.tick_rfc, 
                tm_ticket.fech_ini, 
                tm_ticket.fech_ter, 
                tm_ticket.tick_dir, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_est, 
                tm_ticket.tick_cont, 
                tm_ticket.tick_cel, 
                tm_ticket.tick_tel, 
                tm_ticket.tick_ext, 
                tm_ticket.tick_telext, 
                tm_ticket.tick_correo, 
                tm_ticket.tick_nserie, 
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                
                tm_usuario.usu_nom, 
                tm_usuario.usu_ape, 
                tm_servicio.ser_nom, 
                tm_sucursal.suc_nom, 
                tm_tipoequipo.tipequi_nom, 
                tm_servicio.ser_nom, 
                tm_lugarservicio.lug_nom,

                tm_cli.cli_nom,
                tm_cli.cli_ape
                
                FROM tm_ticket
                INNER JOIN tm_usuario ON tm_usuario.usu_id = tm_ticket.usu_id 
                INNER JOIN tm_tipoequipo ON tm_tipoequipo.tipequi_id = tm_ticket.tipequi_id 
                INNER JOIN tm_sucursal ON tm_sucursal.suc_id = tm_ticket.suc_id 
                INNER JOIN tm_servicio ON tm_ticket.ser_id = tm_servicio.ser_id 
                Inner Join tm_lugarservicio ON tm_ticket.lug_id = tm_lugarservicio.lug_id 
                INNER JOIN tm_cli ON tm_ticket.cli_id = tm_cli.cli_id
                WHERE tm_ticket.est=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            /*
            $sql="SELECT 
                tm_ticket.tick_id, 
                tm_ticket.usu_id,
                tm_ticket.cli_id, 
                tm_ticket.ser_id, 
                tm_ticket.tick_descrip, 
                tm_ticket.tick_estado,
                tm_ticket.lug_id, 
                tm_ticket.tick_mar, 
                tm_ticket.tick_mod, 
                tm_ticket.suc_id2, 
                tm_ticket.tick_rfc, 
                tm_ticket.fech_ini, 
                tm_ticket.fech_ter, 
                tm_ticket.tick_dir, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_est, 
                tm_ticket.tick_cont, 
                tm_ticket.tick_cel, 
                tm_ticket.tick_tel, 
                tm_ticket.tick_ext, 
                tm_ticket.tick_telext, 
                tm_ticket.tick_correo, 
                tm_ticket.tick_nserie, 
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                
                tm_usuario.usu_nom, 
                tm_usuario.usu_ape, 
                tm_usuario.usu_correo,
                tm_servicio.ser_nom, 
                tm_sucursal.suc_nom, 
                tm_tipoequipo.tipequi_nom, 
                tm_servicio.ser_nom, 
                tm_lugarservicio.lug_nom,

                tm_cli.cli_nom,
                tm_cli.cli_ape
                FROM 
                tm_ticket
                INNER join tm_servicio on tm_ticket.ser_id = tm_servicio.ser_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                INNER JOIN tm_sucursal ON tm_sucursal.suc_id = tm_ticket.suc_id 
                INNER JOIN tm_lugarservicio ON tm_ticket.lug_id = tm_lugarservicio.lug_id
                INNER JOIN tm_tipoequipo ON tm_ticket.tipequi_id = tm_tipoequipo.tipequi_id
                INNER JOIN tm_cli ON tm_ticket.cli_id = tm_cli.cli_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tick_id = ?";
                */

            $sql="SELECT
                td_ticketdetalle.tickd_id,
                td_ticketdetalle.tickd_descrip,
                td_ticketdetalle.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.rol_id
                FROM 
                td_ticketdetalle
                INNER join tm_usuario on td_ticketdetalle.usu_id = tm_usuario.usu_id
                WHERE 
                tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id, 
                tm_ticket.usu_id,
                tm_ticket.cli_id, 
                tm_ticket.ser_id, 
                tm_ticket.suc_id, 
                tm_ticket.tipequi_id,
                tm_ticket.tick_descrip, 
                tm_ticket.tick_estado,
                tm_ticket.lug_id, 
                tm_ticket.tick_mar, 
                tm_ticket.tick_mod, 
                tm_ticket.suc_id2, 
                tm_ticket.tick_rfc, 
                tm_ticket.fech_ini, 
                tm_ticket.fech_ter, 
                tm_ticket.tick_dir, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_ciu, 
                tm_ticket.tick_est, 
                tm_ticket.tick_cont, 
                tm_ticket.tick_cel, 
                tm_ticket.tick_tel, 
                tm_ticket.tick_ext, 
                tm_ticket.tick_telext, 
                tm_ticket.tick_correo, 
                tm_ticket.tick_nserie, 
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                
                tm_usuario.usu_nom, 
                tm_usuario.usu_ape, 
                tm_usuario.usu_correo,
                tm_servicio.ser_nom, 
                tm_sucursal.suc_nom, 
                tm_tipoequipo.tipequi_nom, 
                tm_servicio.ser_nom, 
                tm_lugarservicio.lug_nom,

                tm_cli.cli_nom,
                tm_cli.cli_ape
                FROM 
                tm_ticket
                INNER join tm_servicio on tm_ticket.ser_id = tm_servicio.ser_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                INNER JOIN tm_sucursal ON tm_sucursal.suc_id = tm_ticket.suc_id 
                INNER JOIN tm_lugarservicio ON tm_ticket.lug_id = tm_lugarservicio.lug_id
                INNER JOIN tm_tipoequipo ON tm_ticket.tipequi_id = tm_tipoequipo.tipequi_id
                INNER JOIN tm_cli ON tm_ticket.cli_id = tm_cli.cli_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function insert_ticketdetalle($tick_id,$usu_id, $tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estado = 'Cerrado'
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket_asignacion($tick_id, $usu_asig){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    usu_asig = ?,
                    fech_asig = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call sp_i_ticketdetalle_01(?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_reabrir($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_ticketdetalle 
                (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) 
                VALUES 
                (NULL,?,?,'Ticket Re-Abierto...',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM tm_ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE tick_estado = 'Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS TOTAL FROM tm_ticket WHERE tick_estado = 'Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_servicio.ser_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_servicio ON tm_ticket.ser_id = tm_servicio.ser_id  
                WHERE    
                tm_ticket.est = 1
                GROUP BY 
                tm_servicio.ser_nom
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function reabrir_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_estado = 'Abierto'
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_by_id($tick_id) {
            $conectar = parent::conexion(); 
            parent::set_names(); 
            
            $sql = "SELECT 
                        tm_ticket.tick_id, 
                        tm_ticket.tick_descrip, 
                        tm_ticket.tick_estado,
                        tm_ticket.tick_dir, 
                        tm_ticket.tick_tel,
                        tm_ticket.tick_cel,
                        tm_ticket.tick_mar,
                        tm_ticket.tick_mod,
                        tm_ticket.tick_rfc,
                        tm_ticket.fech_ini, 
                        tm_ticket.fech_ter, 
                        tm_ticket.tick_ciu,  
                        tm_ticket.tick_est, 
                        tm_ticket.tick_cont,  
                        tm_ticket.tick_ext, 
                        tm_ticket.tick_telext, 
                        tm_ticket.tick_correo, 
                        tm_ticket.tick_nserie, 
                        tm_ticket.fech_crea,
                        tm_ticket.usu_asig,
                        tm_ticket.fech_asig,
                        tm_ticket.tick_otros,
                        tm_ticket.tick_acces,
                        tm_usuario.usu_nom,
                        tm_usuario.usu_ape,
                        tm_cli.cli_id,
                        tm_cli.cli_nom, 
                        tm_cli.cli_ape, 
                        tm_servicio.ser_nom, 
                        tm_lugarservicio.lug_nom, 
                        tm_sucursal.suc_nom,
                        tm_tipoequipo.tipequi_nom
                    FROM 
                        tm_ticket 
                    INNER JOIN tm_cli ON tm_ticket.cli_id = tm_cli.cli_id
                    INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                    INNER JOIN tm_servicio ON tm_ticket.ser_id = tm_servicio.ser_id
                    INNER JOIN tm_lugarservicio ON tm_ticket.lug_id = tm_lugarservicio.lug_id
                    INNER JOIN tm_tipoequipo ON tm_ticket.tipequi_id = tm_tipoequipo.tipequi_id
                    INNER JOIN tm_sucursal ON tm_ticket.suc_id = tm_sucursal.suc_id
                    WHERE 
                        tm_ticket.tick_id = ?";
            
            $sql = $conectar->prepare($sql);  
            $sql->bindParam(1, $tick_id, PDO::PARAM_INT);
            
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);  
        }

        public function insert_encuesta($tick_id,$tick_star,$tick_coment){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    tick_star = ?,
                    tick_coment = ?
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_star);
            $sql->bindValue(2, $tick_coment);
            $sql->bindValue(3, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        

    }
?>
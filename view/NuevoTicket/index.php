<?php
    require_once("../../config/conexion.php");
    if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <title>Compuproveedores</>::Nuevo Ticket</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>
	
    <?php require_once("../MainNav/nav.php");?>
    
	<div class="page-content">
		<div class="container-fluid">
            <header class="section-header">
			<div class="tbl">
				<div class="tbl-row">
					<div class="tbl-cell">
						<h3>Nuevo Ticket</h3>
						<ol class="breadcrumb breadcrumb-simple">
							<li><a href="#">Inicio</a></li>
							<li class="active">Nuevo Ticket</li>
						</ol>
					</div>
				</div>
			</div>
		    </header>

            <div class="box-typical box-typical-padding">
			    <p>
				    Desde esta ventana podran generar nuevos tickets:
			    </p>
                <h5 class="m-t-lg with-border">Solicitud de Servicio</h5>

				<div class="form-group row">
                    <form method="post" id="ticket_form">
                        <input type="hidden" id="usu_id" name="usu_id" value="<?php echo $_SESSION["usu_id"] ?>">
                        
                        <div class="col-lg-6">
                            <label class="form-label semibold">   Servicio</label>
                            <fieldset class="form-group">
                                <label for="suc_id" class="col-sm-2 form-control-label semibold">Sucursal:</label>
                                <select id="suc_id" name="suc_id" class="form-control">
                                </select>

                                <label for="lug_id" class="col-sm-4 form-control-label semibold">Lugar de Servicio:</label>
                                <select id="lug_id" name="lug_id" class="form-control">
                                </select>

                                <label for="fech_ini" class="col-sm-2 form-control-label semibold">Inicio:</label>
                                <p class="form-control-static"><input type="date" class="form-control" id="fech_ini" name="fech_ini"></p>                   
                            
                                <label for="fech_ter" class="col-sm-3 form-control-label semibold">Termino:</label>
                                <p class="form-control-static"><input type="date" class="form-control" id="fech_ter" name="fech_ter"></p>

                                <label for="ser_id" class="col-sm-5 form-control-label semibold">Tipo de servicio:</label>
                                <select id="ser_id" name="ser_id" class="form-control">
                                </select>

                                <label for="tipequi_id" class="col-sm-5 form-control-label semibold">Tipo de equipo:</label>
                                <select id="tipequi_id" name="tipequi_id" class="form-control">
                                </select>

                                <label for="tick_mar" class="col-sm-2 form-control-label semibold">Marca:</label>
                                <p class="form-control-static"><input type="text" class="form-control" id="tick_mar" name="tick_mar" placeholder="Marca"></p>

                                <label for="tick_mod" class="col-sm-2 form-control-label semibold">Modelo:</label>
                                <p class="form-control-static"><input type="text" class="form-control" id="tick_mod" name="tick_mod" placeholder="Modelo"></p>

                                <label for="tick_nserie" class="col-sm-3 form-control-label semibold">No. de serie:</label>
                                <p class="form-control-static"><input type="text" class="form-control" id="tick_nserie" name="tick_nserie" placeholder="No."></p>

                                <div class="form-group row">
                                    <label for="tick_otros" class="col-sm-3 col-form-label semibold">Otros:</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_otros[]" value="Herramienta"> Herramienta
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_otros[]" value="Escalera"> Escalera
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_otros[]" value="Equipo de Seguridad"> Equipo de Seguridad
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_otros[]" value="Documentacion Especial"> Documentacion Especial
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tick_acces" class="col-sm-3 col-form-label semibold">Accesorios:</label>
                                    <div class="col-sm-9">
                                        <div class="form-check">
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Bandeja Extra"> Bandeja Extra
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Cabezales"> Cabezales
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Cable Corriente"> Cable Corriente
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Por Gabinete"> Por Gabinete
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Cable USB"> Cable USB
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Cartuchos de tinta"> Cartuchos de tinta
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Toner"> Toner
                                            </div>
                                            <div class="form-check-item">
                                                <input type="checkbox" class="form-check-input" name="tick_acces[]" value="Otros"> Otros
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </fieldset>

                        </div>
                                         
                        <div class="col-lg-6">
                            <fieldset class="form-group">
                                <label class="form-label semibold">   Datos del cliente</label>
                                <label for="cli_id" class="semibold">Cliente ID:</label>
                                <input class="form-control" type="text" id="cli_id" name="cli_id" placeholder="Escriba ID del Cliente">

                                <label for="cli_nom" class="semibold">Nombre Cliente:</label>
                                <input class="form-control" type="text" id="cli_nom" name="cli_nom">

                                <label for="cli_ape" class="semibold">Apellido Cliente:</label>
                                <input class="form-control" type="text" id="cli_ape" name="cli_ape">

                                <label for="cli_rfc" class="semibold">RFC Cliente:</label>
                                <input class="form-control" type="text" id="cli_rfc" name="cli_rfc">

                                <label for="suc_id2" class="form-control-label semibold">Sucursal</label>
                                <select id="suc_id2" name="suc_id2" class="form-control">
                                </select>

                                <label for="cli_dir" class="semibold">Direccion:</label>
                                <input class="form-control" type="text" id="cli_dir" name="cli_dir">

                                <label for="cli_ciu" class="semibold">Ciudad:</label>
                                <input class="form-control" type="text" id="cli_ciu" name="cli_ciu">
                                
                                <label for="cli_est" class="semibold">Estado:</label>
                                <input class="form-control" type="text" id="cli_est" name="cli_est">

                                <label for="cli_cont" class="form-control-label semibold">Contacto:</label>
                                <p class="form-control-static"><input type="text" class="form-control" id="cli_cont" name="cli_cont" placeholder="Contacto"></p>
                                                                
                                <label for="cli_cel" class="semibold">Celular:</label>
                                <input class="form-control" type="text" id="cli_cel" name="cli_cel">

                                <label for="cli_tel" class="semibold">Telefono:</label>
                                <input class="form-control" type="text" id="cli_tel" name="cli_tel">
                                                                                                
                                <label for="cli_ext" class="semibold">Extension:</label>
                                <input class="form-control" type="text" id="cli_ext" name="cli_ext">

                                <label for="cli_telext" class="semibold">Telefono Extra:</label>
                                <input class="form-control" type="text" id="cli_telext" name="cli_telext">
                                
                                <label for="cli_correo" class="semibold">Correo:</label>
                                <input class="form-control" type="text" id="cli_correo" name="cli_correo">

                            </fieldset>
                        </div>

                        
                        <div class="col-lg-12">
                            <fieldset class="form-group">
                                <label class="form-label  semibold" for="tick_descrip">Falla:</label>
                                <div class="summernote-theme-1" >
                                    <textarea id="tick_descrip" name="tick_descrip" class="summernote"></textarea>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="action" value="add" class="btn btn-rounded btn-inline btn-primary">Guardar</button>
                        </div>

                    </form>
				</div>
            </div>

		</div>
	</div>

    <?php require_once("../MainJs/js.php");?>
    <script type="text/javascript" src="nuevoticket.js"></script>
</body>
</html>
<?php
    }else{
        $conexion = new Conectar();
        header("Location:". $conexion->ruta()."/index.php");
        exit();
    }
?>
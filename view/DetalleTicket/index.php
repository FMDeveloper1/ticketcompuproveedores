<?php
    require_once('../../fpdf/fpdf.php');
    require_once("../../config/conexion.php");
    if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <title>Compuproveedores</>::Detalle Ticket</title>
</head>
<body class="with-side-menu">

    <?php require_once("../MainHeader/header.php");?>

	<div class="mobile-menu-left-overlay"></div>
	
    <?php require_once("../MainNav/nav.php");?>
    
    <!--.Contenido-->
	<div class="page-content">
		<div class="container-fluid">
            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3 id="lblnomidticket"></h3>
                            <span id="lblestado"></span>
                            <span class="label label-pill label-primary" id="lblnomusuario"></span>
                            <span class="label label-pill label-default" id="lblfechcrea"></span>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Detalle Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
		    </header>
            <button type="button" id="btnDownloadPDF" class="btn btn-rounded btn-inline btn-info">Descargar Ticket en PDF</button>

            <div class="box-typical box-typical-padding">
                <div class="row">
                    <div class="col-lg-12">
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="lblnomcli">Cliente</label>
                        <input type="text" class="form-control" id="lblnomcli" name="lblnomcli" readonly>
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="ser_nom">Servicio</label>
                        <input type="text" class="form-control" id="ser_nom" name="ser_nom" readonly>
                        </fieldset>
                    </div>

                    <div class="col-lg-6">
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="lug_nom">Lugar de Servicio</label>
                        <input type="text" class="form-control" id="lug_nom" name="lug_nom" readonly>
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="tipequi_nom">Tipo de Equipo</label>
                        <input type="text" class="form-control" id="tipequi_nom" name="tipequi_nom" readonly>
                        </fieldset>
                    </div>
                    <div class="col-lg-6">
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="tick_nserie">Numero de Serie</label>
                        <input type="text" class="form-control" id="tick_nserie" name="tick_nserie" readonly>
                        </fieldset>
                    </div>

                    <div class="col-lg-12">
                        <fieldset class="form-group">
                        <label class="form-label semibold" for="tickd_descripusu">Descripción</label>
                        <div class="summernote-theme-1">
                            <textarea id="tickd_descripusu" name="tickd_descripusu" class="summernote" name="name"></textarea>
                        </div>

                        </fieldset>
                    </div>

                </div>
            </div>

            <section class="activity-line" id="lbldetalle">
			</section>

            <div class="box-typical box-typical-padding" id="pnldetalle">
                <p>
				Ingrese su duda o consulta:
			    </p>
				<div class="form-group row">

                    <div class="col-lg-12">
                        <fieldset class="form-group">
                            <label class="form-label  semibold" for="tickd_descrip">Descripcion:</label>
                            <div class="summernote-theme-1" >
                                <textarea id="tickd_descrip" name="tickd_descrip" class="summernote"></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-lg-12">
                        <button type="button" id="btnenviar" class="btn btn-rounded btn-inline btn-primary">Enviar</button>
                        <button type="button" id="btncerrarticket" class="btn btn-rounded btn-inline btn-warning">Cerrar Ticket</button>
                    </div>

				</div><!--Row Form-->
            </div>
		</div>
	</div>

    <?php require_once("../MainJs/js.php");?>
    <script type="text/javascript" src="detalleticket.js"></script>
</body>
</html>
<?php
    }else{
        $conexion = new Conectar();
        header("Location:". $conexion->ruta()."/index.php");
        exit();
    }
?>

<?php
    require_once("../../config/conexion.php");
    if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
    <title>Compuproveedores</>::Consultar Ticket</title>
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
                            <h3>Consultar Ticket</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Consultar Ticket</li>
                            </ol>
                        </div>
                    </div>
                </div>
		    </header>
            <div class="box-typical box-typical-padding">
                <table id="ticket_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th style="width: 1%;">Folio</th>
                            <th style="width: 3%;">Asesor</th>
                            <th style="width: 5%;">Sucursal</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Lugar Servicio</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Servicio</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Tipo Equipo</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Cliente</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Estado</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Fecha Creacion</th>

                            <th class="d-none d-sm-table-cell" style="width: 5%;">Fecha Asignacion</th>
                            <th class="d-none d-sm-table-cell" style="width: 5%;">Agente</th>
                            <th class="text-center" style="width: 3%;"></th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
		</div>
	</div>
    <?php require_once("modalasignar.php");?>

    <?php require_once("../MainJs/js.php");?>
    <script type="text/javascript" src="consultarticket.js"></script>
</body>
</html>
<?php
    }else{
        $conexion = new Conectar();
        header("Location:". $conexion->ruta()."/index.php");
        exit();
    }
?>
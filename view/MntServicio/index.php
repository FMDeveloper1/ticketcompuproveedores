<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php"); ?>
    <title>Compuproveedores :: Mantenimiento Servicio</title>
</head>
<body class="with-side-menu">
    <?php require_once("../MainHeader/header.php"); ?>
    <div class="mobile-menu-left-overlay"></div>
    <?php require_once("../MainNav/nav.php"); ?>

    <div class="page-content">
        <div class="container-fluid">
            <header class="section-header">
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <h3>Mantenimiento Servicio</h3>
                            <ol class="breadcrumb breadcrumb-simple">
                                <li><a href="#">Inicio</a></li>
                                <li class="active">Mantenimiento Servicio</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>
            <div class="box-typical box-typical-padding">
                <?php if ($_SESSION["rol_id"] == 2) { ?>
                    <button type="button" id="btnnuevo" class="btn btn-inline btn-primary">Nuevo Servicio</button>
                <?php } ?>
                <table id="servicio_data" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>ID Servicio</th>
                            <th>Nombre del Servicio</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php require_once("modalmantenimiento.php"); ?>
    <?php require_once("../MainJs/js.php"); ?>
    <script type="text/javascript" src="mtnservicio.js"></script>
</body>
</html>
<?php
} else {
    $conexion = new Conectar();
    header("Location:" . $conexion->ruta() . "/index.php");
    exit();
}
?>

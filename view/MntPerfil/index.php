<?php
  require_once("../../config/conexion.php"); 
  if(isset($_SESSION["usu_id"])){ 
?>
<!DOCTYPE html>
<html>
    <?php require_once("../MainHead/head.php");?>
	<title>Compuproveedores</>::Perfil</title>
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
							<h3>Perfil</h3>
							<ol class="breadcrumb breadcrumb-simple">
								<li><a href="#">Home</a></li>
								<li class="active">Cambiar contrasena</li>
							</ol>
						</div>
					</div>
				</div>
			</header>

			<div class="box-typical box-typical-padding">

				<div class="row">
					


						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Nueva Contrasena</label>
								<input class="form-control" type="password" id="txtpass" name="txtpass">
							</fieldset>
						</div>

						<div class="col-lg-6">
							<fieldset class="form-group">
								<label class="form-label semibold" for="exampleInput">Confirmar Contrasena</label>
								<input class="form-control" type="password" id="txtpassnew" name="txtpassnew">
							</fieldset>
						</div>
						<div class="col-lg-12">
							<button type="button" name="action" id="btnactualizar" class="btn btn-rounded btn-inline btn-primary">Actualizar</button>
						</div>
				</div>

			</div>
		</div>
	</div>

	<?php require_once("../MainJs/js.php");?>
	
	<script type="text/javascript" src="mntperfil.js"></script>

</body>
</html>
<?php
    }else{
        $conexion = new Conectar();
        header("Location:". $conexion->ruta()."/index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Encuesta HelpDesk</title>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <link rel="stylesheet" href="../../public/css/lib/bootstrap-sweetalert/sweetalert.css">
    <link rel="stylesheet" href="../../public/css/separate/vendor/sweet-alert-animations.min.css">
</head>
<body>

    <div class="container">
        <section class="row">
            <div class="col-md-12">
                <h1 class="text-center">Formato de Encuesta de Satisfacción.</h1>
            </div>
        </section>
        <hr><br />
        <section class="row">
            <section class="col-md-12">
                <h3>Datos basicos</h3>
                <p></p>
            </section>
        </section>
        <section class="row">
            <section class="col-md-12">
                <section class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCompleto">Nro de Ticket</label>
                            <input type="text" class="form-control" id="lblnomidticket" name="lblnomidticket" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreCompleto">Fecha de Cierre</label>
                            <input type="text" class="form-control" id="lblnomidticket" name="lblnomidticket" readonly>
                        </div>
                    </div>
                </section>
                
                <section class="row">
                    <div class="col-md-6">
                        <label for="tipoServicio">Servicio</label>
                        <input type="text" class="form-control" id="ser_nom" name="ser_nom" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipoSucursal">Sucursal</label>
                            <input type="text" class="form-control" id="suc_nom" name="suc_nom" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="numeroSerie">Numero de Serie</label>
                            <input type="text" class="form-control" id="tick_nserie" name="tick_nserie" readonly>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-md-4">
                        <label for="tipoAtencion">Usuario</label>
                        <input type="text" class="form-control" id="lblnomusuario" name="lblnomusuario" readonly>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Estado</label>
                            <input type="text" class="form-control" id="lblestado" name="lblestado" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaActual">Fecha Creacion</label>
                            <input type="text" class="form-control" id="lblfechcrea" name="lblfechcrea" readonly>
                        </div>
                    </div>
                </section>

            </section>
        </section>
        <hr />

        <div id="panel1">

            <section class="row">
                <div class="col-md-12 text-center">
                    <input id="tick_star" name="tick_star" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="0">
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <h3>Comentarios.</h3>
                    <p></p>
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="comment">Comentarios:</label>
                        <textarea id="tick_coment" name="tick_coment" class="form-control" rows="6" id="comentarios"></textarea>
                    </div>
                </div>
            </section>

            <section class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-info" id="btnguardar">Guardar Encuesta</button>
                </div>
            </section>

        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
<script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="encuesta.js"></script>
<script>
    $('#tick_star').rating({ 
        showCaption: false
    });
</script>
</body>
</html>
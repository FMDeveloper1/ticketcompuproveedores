<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="mdltitulo"></h4>
            </div>
            <form method="post" id="cliente_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cli_id">ID Cliente</label>
                        <input type="text" class="form-control" id="cli_id" name="cli_id" placeholder="ID del Cliente">
                    </div>
                    <div class="form-group">
                        <label for="cli_nom">Nombre</label>
                        <input type="text" class="form-control" id="cli_nom" name="cli_nom" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_ape">Apellido</label>
                        <input type="text" class="form-control" id="cli_ape" name="cli_ape" placeholder="Ingrese Apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_rfc">RFC</label>
                        <input type="text" class="form-control" id="cli_rfc" name="cli_rfc" placeholder="Ingrese RFC" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_dir">Dirección</label>
                        <input type="text" class="form-control" id="cli_dir" name="cli_dir" placeholder="Ingrese Dirección" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_ciu">Ciudad</label>
                        <input type="text" class="form-control" id="cli_ciu" name="cli_ciu" placeholder="Ingrese Ciudad" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_est">Estado</label>
                        <input type="text" class="form-control" id="cli_est" name="cli_est" placeholder="Ingrese Estado" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_cont">Contacto</label>
                        <input type="text" class="form-control" id="cli_cont" name="cli_cont" placeholder="Ingrese Contacto" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_cel">Celular</label>
                        <input type="text" class="form-control" id="cli_cel" name="cli_cel" placeholder="Ingrese Celular" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_tel">Teléfono</label>
                        <input type="text" class="form-control" id="cli_tel" name="cli_tel" placeholder="Ingrese Teléfono" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_ext">Extensión</label>
                        <input type="text" class="form-control" id="cli_ext" name="cli_ext" placeholder="Ingrese Extensión" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_telext">Teléfono Extensión</label>
                        <input type="text" class="form-control" id="cli_telext" name="cli_telext" placeholder="Ingrese Teléfono Extensión" required>
                    </div>
                    <div class="form-group">
                        <label for="cli_correo">Correo Electrónico</label>
                        <input type="email" class="form-control" id="cli_correo" name="cli_correo" placeholder="Ingrese Correo Electrónico" required>
                    </div>
                    <div class="form-group">
                        <label for="usu_id">Asignar a Asesor</label>
                        <select class="form-control" id="usu_id" name="usu_id">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

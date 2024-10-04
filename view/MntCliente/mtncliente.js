var tabla;

function init() {
    $('#cliente_form').on("submit", function (e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#cliente_form")[0]);
    $.ajax({
        url: "../../controller/cliente.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            console.log(datos);
            $('#cliente_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#cliente_data').DataTable().ajax.reload();

            swal({
                title: "HelpDesk!",
                text: "Completado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).ready(function () {
    tabla = $('#cliente_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax": {
            url: '../../controller/cliente.php?op=listar',
            type: "post",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    }).DataTable();
})

function editar(cli_id) {
    $('#mdltitulo').html('Editar Cliente');

    $.post("../../controller/cliente.php?op=mostrar", { cli_id: cli_id }, function (data) {
        data = JSON.parse(data);
        $('#cli_id').val(data.cli_id);
        $('#cli_nom').val(data.cli_nom);
        $('#cli_ape').val(data.cli_ape);
        $('#cli_rfc').val(data.cli_rfc);
        $('#cli_dir').val(data.cli_dir);
        $('#cli_ciu').val(data.cli_ciu);
        $('#cli_est').val(data.cli_est);
        $('#cli_cont').val(data.cli_cont);
        $('#cli_cel').val(data.cli_cel);
        $('#cli_tel').val(data.cli_tel);
        $('#cli_ext').val(data.cli_ext);
        $('#cli_telext').val(data.cli_telext);
        $('#cli_correo').val(data.cli_correo);
        $('#usu_id').val(data.usu_id).trigger('change');
    });

    $('#modalmantenimiento').modal('show');
}

function eliminar(cli_id) {
    swal({
        title: "Mesa de Ayuda",
        text: "¿Está seguro de eliminar este cliente?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        closeOnConfirm: false,
    },
    function (isConfirm) {
        if (isConfirm) {
            $.post("../../controller/cliente.php?op=eliminar", { cli_id: cli_id }, function (data) { });

            $('#cliente_data').DataTable().ajax.reload();

            swal({
                title: "Mesa de Ayuda",
                text: "Cliente eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}


function cargarAsesores() {
    $.ajax({
        url: "../../controller/usuario.php?op=listarAsesores",
        type: "GET",
        dataType: "json",
        success: function (data) {
            let options = "<option value=''>Seleccione un Asesor</option>";
            data.forEach(function (asesor) {
                options += `<option value="${asesor.usu_id}">${asesor.usu_nom} ${asesor.usu_ape}</option>`;
            });
            $('#usu_id').html(options);
        },
        error: function (e) {
            console.log(e.responseText);
        }
    });
}

$(document).on('click', '#btnnuevo', function () {
    $('#mdltitulo').html('Nuevo Cliente');
    $('#cliente_form')[0].reset();
    cargarAsesores();
    $('#modalmantenimiento').modal('show');
});


init();

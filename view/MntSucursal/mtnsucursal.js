var tabla;

function init() {
    $('#sucursal_form').on("submit", function (e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#sucursal_form")[0]);
    $.ajax({
        url: "../../controller/sucursal.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            datos = JSON.parse(datos);
            if (datos.status === "success") {
                $('#sucursal_form')[0].reset();
                $("#modalmantenimiento").modal('hide');
                $('#sucursal_data').DataTable().ajax.reload();
                swal({
                    title: "HelpDesk!",
                    text: datos.message,
                    type: "success",
                    confirmButtonClass: "btn-success"
                });
            } else {
                swal({
                    title: "Error!",
                    text: datos.message,
                    type: "error",
                    confirmButtonClass: "btn-danger"
                });
            }
        },
        error: function (error) {
            console.error("Error en la petición:", error);
            swal({
                title: "Error!",
                text: "No se pudo realizar la operación.",
                type: "error",
                confirmButtonClass: "btn-danger"
            });
        }
    });
}

$(document).ready(function () {
    tabla = $('#sucursal_data').dataTable({
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
            url: '../../controller/sucursal.php?op=listar',
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

function editar(suc_id) {
    $('#mdltitulo').html('Editar Sucursal');

    $.post("../../controller/sucursal.php?op=mostrar", { suc_id: suc_id }, function (data) {
        data = JSON.parse(data);
        $('#suc_id').val(data.suc_id);
        $('#suc_nom').val(data.suc_nom);
    });

    $('#modalmantenimiento').modal('show');
}

function eliminar(suc_id) {
    swal({
        title: "Mesa de Ayuda",
        text: "¿Está seguro de eliminar esta sucursal?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        closeOnConfirm: false,
    },
    function (isConfirm) {
        if (isConfirm) {
            $.post("../../controller/sucursal.php?op=eliminar", { suc_id: suc_id }, function (data) { });

            $('#sucursal_data').DataTable().ajax.reload();

            swal({
                title: "Mesa de Ayuda",
                text: "Sucursal eliminada.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).on('click', '#btnnuevo', function () {
    $('#mdltitulo').html('Nueva Sucursal');
    $('#sucursal_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});

init();

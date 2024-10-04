var tabla;

function init() {
    $('#servicio_form').on("submit", function (e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#servicio_form")[0]);
    $.ajax({
        url: "../../controller/servicio.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            datos = JSON.parse(datos);
            if (datos.status === "success") {
                $('#servicio_form')[0].reset();
                $("#modalmantenimiento").modal('hide');
                $('#servicio_data').DataTable().ajax.reload();
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
    tabla = $('#servicio_data').dataTable({
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
            url: '../../controller/servicio.php?op=listar',
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

function editar(ser_id) {
    $('#mdltitulo').html('Editar Servicio');

    $.post("../../controller/servicio.php?op=mostrar", { ser_id: ser_id }, function (data) {
        data = JSON.parse(data);
        $('#ser_id').val(data.ser_id);
        $('#ser_nom').val(data.ser_nom);
    });

    $('#modalmantenimiento').modal('show');
}

function eliminar(ser_id) {
    swal({
        title: "Mesa de Ayuda",
        text: "¿Está seguro de eliminar este servicio?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sí",
        cancelButtonText: "No",
        closeOnConfirm: false,
    },
    function (isConfirm) {
        if (isConfirm) {
            $.post("../../controller/servicio.php?op=eliminar", { ser_id: ser_id }, function (data) { });

            $('#servicio_data').DataTable().ajax.reload();

            swal({
                title: "Mesa de Ayuda",
                text: "Servicio eliminado.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
}

$(document).on('click', '#btnnuevo', function () {
    $('#mdltitulo').html('Nuevo Servicio');
    $('#servicio_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});

init();

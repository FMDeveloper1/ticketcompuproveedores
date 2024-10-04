
function init(){
    $("#ticket_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

$(document).ready(function() {
    $('#tick_descrip').summernote({
        height:200,
        lang: "es-ES",
        callbacks:{
            onImageUpload: function(image){
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e){
                console.log("Text detect...");
            }
        },
        toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'al', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $.post("../../controller/servicio.php?op=combo", function(data, status){
        $('#ser_id').html(data);
    });
    $.post("../../controller/lugarservicio.php?op=combo", function(data, status){
        $('#lug_id').html(data);
    });
    $.post("../../controller/sucursal.php?op=combo", function(data, status){
        $('#suc_id').html(data);
    });
    $.post("../../controller/sucursal2.php?op=combo", function(data, status){
        $('#suc_id2').html(data);
    });
    /*
    $.post("../../controller/vendedor.php?op=combo", function(data, status){
        $('#ven_id').html(data);
    });
    */
    $.post("../../controller/tipoequipo.php?op=combo", function(data, status){
        $('#tipequi_id').html(data);
    });
    $("#cli_id").keyup(function() {
        let cli_id = $(this).val();

        if (cli_id.length > 0) {
            $.ajax({
                url: '../../controller/clientebackend.php',
                type: 'POST',
                data: { cli_id: cli_id },
                dataType: 'json',
                success: function(data) {
                    console.log("Received data:", data); // Debugging: log the received data
                    if (data && !data.error) {
                        $("#cli_nom").val(data.cli_nom);
                        $("#cli_ape").val(data.cli_ape);
                        $("#cli_rfc").val(data.cli_rfc);
                        $("#cli_dir").val(data.cli_dir);
                        $("#cli_ciu").val(data.cli_ciu);
                        $("#cli_est").val(data.cli_est);
                        $("#cli_cont").val(data.cli_cont);
                        $("#cli_cel").val(data.cli_cel);
                        $("#cli_tel").val(data.cli_tel);
                        $("#cli_ext").val(data.cli_ext);
                        $("#cli_telext").val(data.cli_telext);
                        $("#cli_correo").val(data.cli_correo);
                    } else {
                        $("#cli_nom").val('');
                        $("#cli_ape").val('');
                        $("#cli_rfc").val('');
                        $("#cli_dir").val('');
                        $("#cli_ciu").val('');
                        $("#cli_est").val('');
                        $("#cli_cont").val('');
                        $("#cli_cel").val('');
                        $("#cli_tel").val('');
                        $("#cli_ext").val('');
                        $("#cli_telext").val('');
                        $("#cli_correo").val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX error:", status, error);
                }
            });
        } else {
            $("#cli_nom").val('');
            $("#cli_correo").val('');
            $("#cli_ape").val('');
            $("#cli_rfc").val('');
            $("#cli_dir").val('');
            $("#cli_ciu").val('');
            $("#cli_est").val('');
            $("#cli_cont").val('');
            $("#cli_cel").val('');
            $("#cli_tel").val('');
            $("#cli_ext").val('');
            $("#cli_telext").val('');
        }
    });
    
    
});

function guardaryeditar(e){

    
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    if($('#tick_descrip').summernote('isEmpty') || $('#tick_nserie').val()=='' || $('#tick_mar').val()=='' || $('#tick_mod').val()=='' || $('#fech_ini').val()=='' || $('#fech_ter').val()==''){
        swal("Advertencia", "Campos Vacios ", "warning");
    }else{
        $.ajax({
            url:"../../controller/ticket.php?op=insert",
            type:"POST",
            data: formData,
            contentType:false,
            processData:false,
            
            
            success: function(data) {
                data = JSON.parse(data);
                console.log(data[0].tick_id);
                try{
                    if (data[0] && data[0].tick_id) {
                        $.post("../../controller/email.php?op=ticket_abierto", {tick_id : data[0].tick_id}, function (data) {
                    });

                    $('#ser_id').val('');
                    $('#suc_id').val('');
                    $('#tick_mar').val('');
                    $('#tick_mod').val('');
                    $('#cli_rfc').val('');
                    $('#fech_ini').val('');
                    $('#fech_ter').val('');
                    $('#cli_id').val('');
                    $('#cli_nom').val('');
                    $('#cli_ape').val('');
                    $('#cli_dir').val('');
                    $('#cli_ciu').val('');
                    $('#cli_est').val('');
                    $('#cli_cont').val('');
                    $('#cli_cel').val('');
                    $('#cli_tel').val('');
                    $('#cli_ext').val('');
                    $('#cli_telext').val('');
                    $('#cli_correo').val('');
                    $('#tick_nserie').val('');
                    $('#tick_descrip').summernote('reset');
                    swal("Correcto!", "Registrado Correctamente: ", "success");
                    }
                    else {
                        console.error("Invalid data format:", data);
                
                    }
                } catch (e) {
                    console.error("Failed to parse JSON:", e, data);
            
                }
            }
            
        });
    }

}

    


init();
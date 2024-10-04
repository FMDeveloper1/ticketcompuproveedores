function init(){

}

$(document).ready(function(){
    var tick_id = getUrlParameter('ID');

    listardetalle(tick_id);

    

    $('#tickd_descrip').summernote({
        height:150,
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

    $('#tickd_descripusu').summernote({
        height:300,
        lang: "es-ES",
        toolbar:[
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'al', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#tickd_descripusu').summernote('disable');
});

var getUrlParameter = function getUrlParameter(sParam){
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    
    for(i=0; i< sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam){
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

$(document).on('click','#btnenviar', function(){
    var tick_id = getUrlParameter('ID');
    var usu_id = $('#usu_idx').val();
    var tickd_descrip = $('#tickd_descrip').val();
    if($('#tickd_descrip').summernote('isEmpty')){
        swal("Advertencia", "Falta Descripcion ", "warning");
    }else{
        $.post("../../controller/ticket.php?op=insertdetalle", {tick_id : tick_id, usu_id : usu_id, tickd_descrip : tickd_descrip}, function(data){
            listardetalle(tick_id);
            $('#tickd_descrip').summernote('reset');
            swal("Correcto!", "Ticket actualizado", "success")
            
        })
    }
});

$(document).on('click','#btncerrarticket', function(){
    swal({
        title: "Mesa de Ayuda",
        text: "Esta seguro de cerrar el Ticket?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false,
    },
    function(isConfirm) {
        if (isConfirm) {
            var tick_id = getUrlParameter('ID');
            var usu_id = $('#usu_idx').val();
            $.post("../../controller/ticket.php?op=update", { tick_id : tick_id,usu_id : usu_id }, function (data) {

            });

            $.post("../../controller/email.php?op=ticket_cerrado", {tick_id : tick_id}, function (data) {

            });

            listardetalle(tick_id);
            swal({
                title: "Mesa de Ayuda",
                text: "Ticket cerrado correctamente",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });
});

function listardetalle(tick_id){
    $.post("../../controller/ticket.php?op=listardetalle", {tick_id : tick_id}, function(data){
        $('#lbldetalle').html(data);
    });

    $.post("../../controller/ticket.php?op=mostrar", {tick_id : tick_id}, function(data){
        data = JSON.parse(data);
        $('#lblestado').html(data.tick_estado);
        $('#lblnomusuario').html(data.usu_nom+' '+data.usu_ape);
        $('#lblfechcrea').html(data.fech_crea);
        $('#lblnomidticket').html("Detalle Ticket - "+data.tick_id);
        $('#lblnomcli').val(data.cli_nom+' '+data.cli_ape)
        $('#ser_nom').val(data.ser_nom);
        $('#lug_nom').val(data.lug_nom);
        $('#tipequi_nom').val(data.tipequi_nom);
        $('#tick_nserie').val(data.tick_nserie);

        console.log( data.tick_estado_texto);
        $('#tickd_descripusu').summernote('code',data.tick_descrip);
        if (data.tick_estado_texto == "Cerrado"){
            $('#pnldetalle').hide();
        }

        
    });
}

$(document).on('click', '#btnDownloadPDF', function() {
    var tick_id = getUrlParameter('ID');
    window.location.href = "../../controller/ticket.php?op=generar_pdf&tick_id=" + tick_id;
});

init();
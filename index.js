function init(){

}

$(document).ready(function() {

    
});

$(document).on("click", "#btnsoporte", function(){

    if ($('#rol_id').val()=='1'){
        $('#lbltitulo').html("Acceso Agente");
        $('#btnsoporte').html("Acceso Asesor");
        
        $('#rol_id').val(2);
        $('#imgtipo').attr("src","public/2.png")
    }else{
        $('#lbltitulo').html("Acceso Asesor");
        $('#btnsoporte').html("Acceso Agente");
        $('#rol_id').val(1);
        $('#imgtipo').attr("src","public/1.png")
    }

    
});

init();
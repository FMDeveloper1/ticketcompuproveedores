function init(){

}

$(document).ready(function(){
    var usu_id = $('#usu_idx').val();

    if($('#rol_idx').val() == 1){
        $.post("../../controller/usuario.php?op=total", { usu_id : usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=totalabierto", { usu_id : usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalabiertos').html(data.TOTAL);
        });
        $.post("../../controller/usuario.php?op=totalcerrado", { usu_id : usu_id }, function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrados').html(data.TOTAL);
        });

        $.post("../../controller/ticket.php?op=grafico",function (data) {
            data = JSON.parse(data);
    
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value']
            });
        }); 
    }else{
        $.post("../../controller/ticket.php?op=total", function(data){
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        });
        $.post("../../controller/ticket.php?op=totalabierto", function(data){
            data = JSON.parse(data);
            $('#lbltotalabiertos').html(data.TOTAL);
        });
        $.post("../../controller/ticket.php?op=totalcerrado", function(data){
            data = JSON.parse(data);
            $('#lbltotalcerrados').html(data.TOTAL);
        });

        $.post("../../controller/ticket.php?op=grafico",function (data) {
            data = JSON.parse(data);
    
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value']
            });
        }); 

    }


});

init();
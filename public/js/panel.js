$(document).ready(function(){

    //Mensaje borrar
    $(".boton_borrar").click(function() {
        var id=$(this).attr('data-id');
        $("#"+id).slideToggle();
    });

    //Cambiar clave
    $("input[name=cambiar_clave]").click(function() {
        $("input[type=password]").fadeToggle(500);
    });

});
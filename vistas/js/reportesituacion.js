$( "#reportes" ).on( "change", function() {
   
    /* var descontar_tipohora = $('option:selected', this).attr("descontar_tipohora"); */
    var valor= $(this).val();
    $(".iraimprimir").attr("href",valor);

    if(valor=="reportehoraextra"){
        cerrartodo();
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv").removeAttr("style");
    }
    else if(valor=="reporteincapacidad"){
        cerrartodo();
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv2").removeAttr("style");
    }
    else if(valor=="reporteseptimo"){
        cerrartodo();
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv3").removeAttr("style");
    }
    else if(valor=="reporteausencia"){
        cerrartodo();
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv4").removeAttr("style");
    }
    else{
        cerrartodo();
        /* $(".iraimprimir").attr("style","display:block;"); */
    }
});
function cerrartodo(){
    $(".ocultodiv").attr("style","display:none");
    $(".ocultodiv2").attr("style","display:none");
    $(".ocultodiv3").attr("style","display:none");
    $(".ocultodiv4").attr("style","display:none");

    var existeAtributo = $(".iraimprimir").attr("style") !== undefined;

    if (existeAtributo) {
       
    } else {
      
    }


}
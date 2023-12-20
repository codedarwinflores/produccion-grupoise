$( "#reportes" ).on( "change", function() {
   
    $(".ocultodiv").attr("style","display:none");
    $(".ocultodiv2").attr("style","display:none");
    $(".ocultodiv3").attr("style","display:none");
    $(".ocultodiv4").attr("style","display:none");
    $(".ocultodiv5").attr("style","display:none");
    $(".ocultodiv6").attr("style","display:none");

    /* var descontar_tipohora = $('option:selected', this).attr("descontar_tipohora"); */
    var valor= $(this).val();
    $(".iraimprimir").attr("href",valor);

    if(valor=="reporteretiro"){
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv").removeAttr("style");
    }
    else if(valor=="reportecontratadospnc"){
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv2").removeAttr("style");
    }
    else if(valor=="reporteopcionvacacion"){
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv3").removeAttr("style");
    }
    else if(valor=="reporteopcionseguro"){
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv4").removeAttr("style");
    }
    else if(valor=="reporteopcioninde"){
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv5").removeAttr("style");
    }
    else if(valor=="reporteopcionaguinaldo"){
        $(".iraimprimir").attr("style","display:none");
        $(".ocultodiv6").removeAttr("style");
    }
    else {
        $(".ocultodiv").attr("style","display:none");
        $(".ocultodiv2").attr("style","display:none");
        $(".iraimprimir").attr("style","");
    }
})
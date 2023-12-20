$( "#reportes" ).on( "change", function() {
   
    /* var descontar_tipohora = $('option:selected', this).attr("descontar_tipohora"); */
    var valor= $(this).val();
    $(".iraimprimir").attr("href",valor);
})
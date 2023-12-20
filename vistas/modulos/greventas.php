
<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="todosreportes" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
           
                <div class="col-md-12">
                      
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="reventasccf" method="post" target="_blank" id="formulario" >


                              <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Tipo</label>
                                            <select name="tipo" id="tipo" class="form-control" >
                                              <option value="*"> Todos</option>
                                              <?php
                                                function series_ventas() {
                                                  $query = "SELECT * FROM series_ventas";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = series_ventas();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["tipo_serie"].">".$value["tipo_serie"]."-".$value["num_serie"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-12 ">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Número</label>
                                            <input type="text" class="form-control codigoventa" name="codigo" id="inputNumero" autocomplete="off" >
                                        </div>
                                 </div>


                              <div class="col-md-4 ">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Fecha Desde</label>
                                            <input type="text" class="form-control calendario" name="fecha_desde" autocomplete="off">
                                        </div>
                                 </div>

                                 <div class="col-md-4 ">
                                        <div class="form-group ocultar_factu">
                                            <label for="">Seleccionar Fecha Hasta</label>
                                            <input type="text" class="form-control calendario" name="fecha_hasta" autocomplete="off" >
                                        </div>
                                 </div>


                                 
                              <div class="col-md-12 ">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Opción</label>
                                            <select name="tiempo" id="tiempo" class="form-control" >
                                              <option value="Mensual">Mensual</option>
                                              <option value="Bimensual">Bimensual</option>
                                              <option value="Trimestral">Trimestral</option>
                                              <option value="Semestral">Semestral</option>
                                              <option value="Anual">Anual</option>
                                              <option value="24 Meses">24 Meses</option>
                                            </select>
                                        </div>
                                </div>



                               
                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->


                           
                                    
                </div>
                                
            </div>
                        
         </div>
       </div>
     </div>
   </div>
  </div>
 </section>
</div>

<script src="vistas/js/cargarplanillas.js"></script>

<script>

/* ******************************* */

$(document).ready(function() {
  $('#inputNumero').on('blur', function() {
    // Obtén el valor actual del input
    var valorInput = $(this).val();

    // Elimina cualquier carácter que no sea un dígito
    valorInput = valorInput.replace(/\D/g, '');

    // Asegúrate de que la longitud sea de exactamente 5 dígitos
    if (valorInput.length > 5) {
      valorInput = valorInput.slice(0, 5);
    }

    // Rellena con ceros a la izquierda si es necesario
    while (valorInput.length < 5) {
      valorInput = '0' + valorInput;
    }

    // Establece el nuevo valor en el input
    $(this).val(valorInput);
  });
});

/* ****************************** */

$(".oculta_equipo").attr("style","display:none");

/* ***************** */
var tiporeporte = $('#tipo');
tiporeporte.on('change', function() {
  /* $(".oculto").attr("style","display:none");
  $(".oculta_equipo").removeAttr("style"); */

  var valor="reventas"+$(this).val();
  $("#formulario").attr("action",valor);

  
  if(valor=="relistadoequipoarmatran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  else if(valor=="relistadoequiporadiotran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  else if(valor=="relistadoequiporcelulartran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  else if(valor=="relistadoequiporbicitran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }

  else if(valor=="relistadoequiporarmaradiotran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }

  else if(valor=="relistadoequiporarmaradioceltran"){
   $(".relistadoequipoarmatran").removeAttr("style");
  }
  
  
  
});
/* ***************** */



var rubro = $('#rubro');
rubro.on('change', function() {
  $("#cliente").val("*").trigger('change.select2');
});


var cliente = $('#cliente');
cliente.on('change', function() {
  $("#rubro").val("*");
});

var depa = $('#departamento');
depa.on('change', function() {
      var selectedValue = $(this).val();
      if(selectedValue!="*"){
        /* $("#municipio").attr("idDpto").trigger('change.select2');*/
        var idDpto = selectedValue;
        $("#municipio").select2();
        $("#municipio").select2('destroy');
        $("#municipio option").each(function () {
            if ($(this).attr('idDpto') === idDpto) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
      }
      else{
        $("#municipio").select2();
      }      
});






  var selectElement = $('#tipodesituacion');
  // Agregar un evento 'change' al elemento <select>
  selectElement.on('change', function() {
      $(".ocultar_div").attr("style","display:none");
      
      // Capturar el valor seleccionado cuando cambia la selección
      var selectedValue = $(this).val();
      $("#formulario").attr("action",selectedValue);

      if(selectedValue=="reportesituacionusuarios"){
        $(".usuarios").removeAttr("style");
      }

      
  });

    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);
</script>
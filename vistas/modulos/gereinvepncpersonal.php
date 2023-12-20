
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
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Seleccione el tipo de reporte:</label>
                                  <select name="" id="tiporeporte" class="form-control">
                                    <option value="">Seleccione el tipo de reporte</option>
                                    <option value="reinvepncpersonal">INFORMES PNC BOTON INVENTARIOS PERSONAL</option>
                                    <option value="reinvepncradios">INFORMES PNC BOTON INVENTARIOS RADIOS</option>
                                    <option value="recontratospnc">INFORMES PNC BOTON CONTRATOS</option>
                                    
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >

                                
                                  <div class="col-md-2 ocultar_div">
                                    <div class="form-group">
                                      <label for="">Fecha desde</label>
                                      <input type="text" class="form-control calendario" value="" name="fechadesde" id="">
                                    </div>
                                  </div>

                                  <div class="col-md-2 ocultar_div">
                                    <div class="form-group">
                                      <label for="">Fecha hasta</label>
                                      <input type="text" class="form-control calendario" name="fechahasta" value="" id="">
                                    </div>
                                  </div>


                                  

                                <div class="col-md-12 ocultar_div">
                                  <div class="form-group">
                                    <label>Estado de Empresa</label>
                                    <select name="cliente" id="cliente" class="form-control mi-selector">
                                      <option value="*">Estado de Empresa</option>
                                      <?php
                                      function clientes()
                                      {
                                        $query = "SELECT * FROM `clientes`group by estado_cliente order by id DESC";
                                        $sql = Conexion::conectar()->prepare($query);
                                        $sql->execute();
                                        return $sql->fetchAll();
                                      };
                                      $data_empleado = clientes();
                                      foreach ($data_empleado as $value) {
                                        echo "<option value=" . $value["estado_cliente"] . ">" . $value["estado_cliente"] . "</option>";
                                      }
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                

                                <div class="col-md-12 ocultar_div">
                                  <div class="form-group">
                                    <label>¿Posee contrato?</label>
                                    <select name="clientecontratos" id="cliente" class="form-control mi-selector">
                                      <option value="*">¿Posee contrato?</option>
                                      <?php
                                      function clientes_contra()
                                      {
                                        $query = "SELECT * FROM `clientes`group by posee_contrato order by id DESC";
                                        $sql = Conexion::conectar()->prepare($query);
                                        $sql->execute();
                                        return $sql->fetchAll();
                                      };
                                      $data_empleado = clientes_contra();
                                      foreach ($data_empleado as $value) {
                                        echo "<option value=" . $value["posee_contrato"] . ">" . $value["posee_contrato"] . "</option>";
                                      }
                                      ?>
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

$(".ocultar_div").attr("style","display:none");

var tiporeporte = $('#tiporeporte');
tiporeporte.on('change', function() {
  $(".ocultar_div").attr("style","display:none");


  var valor=$(this).val();
  $("#formulario").attr("action",valor);

  if(valor=="recontratospnc"){
   $(".ocultar_div").removeAttr("style");
  }
});



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
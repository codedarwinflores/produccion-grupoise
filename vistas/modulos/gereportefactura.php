
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
                                  <label for="exampleInputEmail1">Seleccione el tipo de reporte:</label>
                                  <select name="" id="tipodesituacion" class="form-control">
                                    <option value="">Seleccione el tipo de reporte</option>
                                    <option value="reportefactura">REPORTE FACTURACION</option>
                                    <option value="reportefacturarevision">REPORTE FACTURACION BOTON REVISION</option>
                                    <option value="reportefacturarubicacion">REPORTE FACTURACION BOTON UBICACIONES</option>
                                   
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="" method="post" target="_blank" id="formulario" >

                          
                                  <!-- ENTRADA PARA CAMPOS  -->
                                  <div class="form-group col-md-12 ocultar_factu" >
                                    <label for="" class="">Forma de Pago</label> 
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class=""></i></span> 
                                      <select name="forma_pago" id="" class="form-control" required="">
                                        <option value="*">Todas Forma de Pago</option>
                                        <option value="Mensual">Mensual</option>
                                        <option value="Bimensual">Bimensual</option>
                                        <option value="Trimestral">Trimestral</option>
                                        <option value="Semestral">Semestral</option>
                                        <option value="Anual">Anual</option>
                                        <option value="24 meses">24 meses</option>
                                      </select>
                                    </div>
                                  </div>


                                  <div class="col-md-12">
                                        <div class="form-group ocultar_factu">
                                            <label for="exampleInputEmail1">Seleccionar rubro</label>
                                            <select name="rubro" id="rubro" class="form-control  ubicacion" >
                                              <option value="*">Todos los rubro</option>
                                              <?php
                                                
                                                function ubicacion() {
                                                  $query = "SELECT*FROM tbl_clientes_ubicaciones group by rubro";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = ubicacion();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["rubro"].">".$value["rubro"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar cliente</label>
                                            <select name="cliente" id="cliente" class="form-control mi-selector cliente" >
                                              <option value="*">Todos los clientes</option>
                                              <?php
                                                
                                                function cliente() {
                                                  $query = "SELECT*FROM clientes";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = cliente();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["codigo"].">".$value["nombre"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                
                                  <!-- ENTRADA PARA CAMPOS  -->
                                  <div class="form-group col-md-12 ocultar_factu" >
                                    <label for="" class="">Imprimir con Concepto</label> 
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class=""></i></span> 
                                      <select name="concepto" id="" class="form-control" required="">
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
                                      </select>
                                    </div>
                                  </div>

                                  <!-- ENTRADA PARA CAMPOS  -->
                                  <div class="form-group col-md-12 ocultar_factu" >
                                    <label for="" class="">Sin Facturar</label> 
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class=""></i></span> 
                                      <select name="sinfacturar" id="" class="form-control" required="">
                                        <option value="No">No</option>
                                        <option value="Si">Si</option>
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


var tipodesituacion = $('#tipodesituacion');
tipodesituacion.on('change', function() {
  var valor=$(this).val();
  $(".ocultar_factu").removeAttr("style");
  if(valor=="reportefacturarevision"){
    $(".ocultar_factu").attr("style","display:none");
  }
  if(valor=="reportefacturarubicacion"){
    $(".ocultar_factu").attr("style","display:none");
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
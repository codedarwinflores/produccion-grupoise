
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

                          <label for="">Selecciones el tipo de reporte</label>
                          <select name="" id="opcionreporte" class="form-control">
                            <option value="">Selecciones el tipo de reporte</option>
                            <option value="reporteretencion">CONSOLIDADO RETENCIONES CON TODOS LOS MESES</option>
                            <option value="reporteretencionpormes">CONSOLIDADO RETENCIONES POR MESES</option>
                            <option value="reporteretencionnomes">CONSOLIDADO RETENCIONES SIN MESES</option>
                          </select>
                          <br>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="reporteretencion" method="post" target="_blank" id="formulario" >
                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Fecha Desde:</label>
                                  <input type="text" class="calendario form-control " name="fecha_desde" id=""    readonly placeholder="Fecha Desde">
                                </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Hasta:</label>
                                    <input type="text" class="calendario form-control " name="fecha_hasta" id=""    readonly placeholder="Fecha Hasta">
                                  </div>
                              </div>

                              <div class="col-md-12 meses" style="display:none">
                                  <div class="form-group">
                                    <label for="">Seleccione el mes:</label>
                                    <select name="messeleccionado" id="" class="form-control">
                                        <option value="*">Seleccione el mes</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Planilla Aguinaldo:</label>
                                    <select name="planillaaguinaldo" id="" class="form-control">
                                      <?php
                                          function planillaaguinaldo(){
                                            $query = "SELECT*FROM planilladevengo_aguinaldo group by numero_planilladevengo_aguinaldo";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            $sql=null;
                                
                                        }
                                        $data=planillaaguinaldo();
                                        foreach ($data as $value) {
                                          # code...
                                          echo "<option value='".$value["numero_planilladevengo_aguinaldo"]."'>".$value["descripcion_planilladevengo_aguinaldo"]."</option>";
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


  var selectElement = $('#opcionreporte');
  // Agregar un evento 'change' al elemento <select>
  selectElement.on('change', function() {
      $(".meses").attr("style","display:none");
      // Capturar el valor seleccionado cuando cambia la selección
      var selectedValue = $(this).val();
      $("#formulario").attr("action",selectedValue);

      if(selectedValue=="reporteretencionpormes"){
        $(".meses").removeAttr("style");
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
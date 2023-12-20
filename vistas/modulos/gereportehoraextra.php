
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

                            
                             <!-- **********BOLETA OPCION Administrativa************ -->
                            <div class="col-md-12 opcionadmin">

                              <form action="reportehoraextraadmin" method="post" target="_blank" id="formulario">
                                
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Seleccionar Planilla Desde</label>
                                            <select name="planilladesde" id="" class="form-control mi-selector planilla" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                function planilladevengo_admin() {
                                                  $query = "SELECT * from planilladevengo_admin GROUP BY numero_planilladevengo_admin ORDER BY id ASC";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };
                                                  $data = planilladevengo_admin();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["numero_planilladevengo_admin"]." vacacion=".$value["numero_plan_vacacion"].">".$value["numero_planilladevengo_admin"].' Planilla desde '.$value["fecha_desde_planilladevengo_admin"].' al '.$value["fecha_hasta_planilladevengo_admin"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>


                                <div class="col-md-12" style="display: none;">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Ubicación</label>
                                          <select name="ubicacion" class="form-control mi-selector ubicacion" >
                                            <option value="*"> Seleccionar</option>
                                            <?php
                                              function ubicacion() {
                                                $query = "SELECT * from tbl_clientes_ubicaciones ORDER BY id ASC";
                                                $sql = Conexion::conectar()->prepare($query);
                                                $sql->execute();			
                                                return $sql->fetchAll();
                                                };
                                                $data = ubicacion();
                                                foreach($data as $value) {
                                                echo "<option value=".$value["id"].">".$value["nombre_ubicacion"]."</option>";
                                                }
                                            ?>
                                          </select>
                                      </div>
                                </div>

                               
                                <div class="col-md-12" style="display: none;">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Planilla Vacación</label>
                                            <input type="text" class="form-control numerovacacion" readonly="readonly">
                                        </div>
                                </div>
                                <br>
                                <input type="submit" value="Imprimir" class="btn btn-primary">
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


<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');


    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);


    $( "#tipo_boleta" ).change(function(){ 
      var tipo = $('option:selected', this).val();
      
      if(tipo=="Ejecutar"){
        $(".opcionejecutar").removeAttr("style");
        $(".opcionadmin").attr("style","display:none;");
        $(".opciondevengo").attr("style","display:none;");
        $(".opcionsupervisor").attr("style","display:none;");
      }
      else if(tipo=="Devengos"){
        $(".opciondevengo").removeAttr("style");
        $(".opcionadmin").attr("style","display:none;");
        $(".opcionejecutar").attr("style","display:none;");
        $(".opcionsupervisor").attr("style","display:none;");

      }
      else if(tipo=="Administrativa"){
        $(".opcionadmin").removeAttr("style");
        $(".opcionejecutar").attr("style","display:none;");
        $(".opciondevengo").attr("style","display:none;");
        $(".opcionsupervisor").attr("style","display:none;");


      }
      else if(tipo=="Supervisor"){
        $(".opcionsupervisor").removeAttr("style");
        $(".opcionadmin").attr("style","display:none;");
        $(".opcionejecutar").attr("style","display:none;");
        $(".opciondevengo").attr("style","display:none;");

      }
      else{
        $(".opcionejecutar").attr("style","display:none;");
        $(".opciondevengo").attr("style","display:none;");
        $(".opcionadmin").attr("style","display:none;");
      }
    });

    $( ".planilla" ).change(function(){ 
      var vacacion = $('option:selected', this).attr("vacacion");
      $(".numerovacacion").val(vacacion);
    });

    $( ".empleado" ).change(function(){ 
      var banco = $('option:selected', this).attr("banco");
      var valor = $('option:selected', this).val();
      if(valor!="*"){
        $("#formulario").attr("action","anexoadminempleado");
      }
      else{
        $("#formulario").attr("action","anexoadminplanilla");
      }
    });

    

    $( ".devengodesde" ).change(function(){ 
      var valor = $('option:selected', this).val();
      if(valor!="*"){
        $(".devengos_descuentos").val("*");
        $(".div_devengos_descuentos").attr("style","display:none;");
      }
      else{
        $(".div_devengos_descuentos").removeAttr("style");
      }
    });


    $( ".devengos_descuentos" ).change(function(){ 
      var valor = $('option:selected', this).val();
      if(valor!="*"){
        $("#formulario").attr("action","anexoadminplanilla");
      }
    });



    $( ".ubicacion" ).change(function(){ 
      $(".empleado").val("*").trigger('change.select2');
    });


</script>
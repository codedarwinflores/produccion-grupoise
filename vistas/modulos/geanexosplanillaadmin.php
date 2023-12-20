
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

                              <form action="anexoadminplanilla" method="post"  id="formulario">

                                <!-- ********************** -->
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Seleccione el tipo de planilla</label>
                                    <select class="form-control tipo_planilla" name="tipo_planilla">
                                        <option value="*">Seleccione tipo planilla</option>
                                        <option value="planilladevengo_anticipo" devengos=''>Planilla de Anticipo</option>
                                        <option value="planilladevengo_vacacion" devengos='_vacacion'>Planilla de Vacacion</option>
                                        <option value="planilladevengo_aguinaldo" devengos='_aguinaldo'>Planilla de Aguinaldo</option>
                                        <option value="planilladevengo_gratifivaca" devengos='_gratifivaca'>Planilla de Gratificación por Vacación</option>
                                        <option value="planilladevengo_admin" devengos='_admin'>Planilla de Administratica</option>
                                    </select>
                                  </div>
                                </div>
                                <input type="hidden" name="devengos_table" class="devengos_table">
                                <!-- ********************** -->
                                
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Seleccionar Planilla Desde</label>
                                            <select name="planilladesde" id="" class="form-control mi-selector planilla cargardataplanilla" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                function planilladevengo_admin() {
                                                  $query = "SELECT * from planilladevengo_admin GROUP BY numero_planilladevengo_admin ORDER BY id ASC";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };
                                                  
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla Hasta</label>
                                            <select name="planillahasta" id="" class="form-control mi-selector planilla cargardataplanilla" >
                                              <option value="*"> Seleccionar</option>
                                              
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Seleccionar devengos o descuento desde</label>
                                            <select name="devengodesde" id="" class="form-control mi-selector devengodesde" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                function devemgos() {
                                                  $query = "SELECT*FROM tbl_devengo_descuento_planilla_admin  group by codigo_devengo_descuento_planilla ORDER BY codigo_devengo_descuento_planilla ASC";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };
                                                  $data = devemgos();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["codigo_devengo_descuento_planilla"]." >".$value["codigo_devengo_descuento_planilla"].'-'.$value["descripcion_devengo_descuento_planilla"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar devengos o descuento hasta</label>
                                            <select name="devengohasta" id="" class="form-control mi-selector" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                  $data = devemgos();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["codigo_devengo_descuento_planilla"]." >".$value["codigo_devengo_descuento_planilla"].'-'.$value["descripcion_devengo_descuento_planilla"]."</option>";
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

                              <div class="col-md-12 div_devengos_descuentos">
                                        <div class="form-group">
                                            <label for="">Mostrar Devengos o Descuentos</label>
                                            <select name="devengos_descuentos" id="" class="form-control mi-selector devengos_descuentos" >
                                              <option value="*"> Seleccionar</option>
                                              <option value="suma">Mostrar solo Devengos</option>
                                              <option value="resta">Mostrar solo Descuentos</option>
                                            </select>
                                        </div>
                              </div>

                                <div class="col-md-12 div_devengos_descuentos">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Filtrar por Empleado</label>
                                            <select name="empleado" id="" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
                                              <option value="todos"> Por todos los empleados</option>
                                              <?php
                                                function empleado() {
                                                  $query = "SELECT * from tbl_empleados  ORDER BY id ASC";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };
                                                  $data = empleado();
                                                  foreach($data as $value) {
                                                  echo "<option banco=".$value["id_banco"]."  value=".$value["id"].">".$value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]."</option>";
                                                  }
                                              ?>
                                            </select>
                                            <input type="hidden" name="banco" class="banco">
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

<script src="vistas/js/cargarplanillas.js"></script>

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
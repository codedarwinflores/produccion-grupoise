
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
                                            <label for="">Seleccionar tipo de boleta</label>
                                            <select name="" id="tipo_boleta" class="form-control mi-selector" >
                                              <option value="*"> Seleccione</option>
                                              <option value="Administrativa"> Administrativa</option>
                                              <option value="Devengos"> Devengos</option>
                                              <option value="Ejecutar"> Ejecutar</option>
                                              <option value="Supervisor">Supervisor</option>
                                              
                                            </select>
                                        </div>
                                </div>
                            
                              
                             <!-- **********BOLETA OPCION Administrativa************ -->
                            <div class="col-md-12 opcionadmin" style="display: none;">
                              <form action="reporteboletaadmin" method="post" target="_blank" >
                                
                              
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

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla</label>
                                            <select name="numero" id="" class="form-control mi-selector planilla cargardataplanilla" >
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

                                <div class="col-md-12">
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

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Empleado</label>
                                            <select name="empleado" id="" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
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

                                <div class="col-md-12">
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

                             <!-- **********BOLETA OPCION devengos************ -->
                             <div class="col-md-12 opciondevengo" style="display: none;">
                              <form action="reporteboletadevengo" method="post" target="_blank" >
                                
                              
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
                              

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla</label>
                                            <select name="numero" id="" class="form-control mi-selector planilla cargardataplanilla" >
                                              <option value="*"> Seleccionar</option>
                                              
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Ubicación</label>
                                          <select name="ubicacion" class="form-control mi-selector ubicacion" >
                                            <option value="*"> Seleccionar</option>
                                            <?php
                                                $data = ubicacion();
                                                foreach($data as $value) {
                                                echo "<option value=".$value["id"].">".$value["nombre_ubicacion"]."</option>";
                                                }
                                            ?>
                                          </select>
                                      </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Empleado</label>
                                            <select name="empleado" id="" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                  $data = empleado();
                                                  foreach($data as $value) {
                                                  echo "<option banco=".$value["id_banco"]."  value=".$value["id"].">".$value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]."</option>";
                                                  }
                                              ?>
                                            </select>

                                            <input type="hidden" name="banco" class="banco">
                                        </div>
                                </div>

                                <div class="col-md-12">
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

                            <!-- **********BOLETA OPCION EJECUTAR************ -->
                            <div class="col-md-12 opcionejecutar" style="display: none;">
                              <form action="reporteboletaejecutar" method="post" target="_blank" >
                                
                              
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

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla</label>
                                            <select name="numero" id="" class="form-control mi-selector planilla cargardataplanilla" >
                                              <option value="*"> Seleccionar</option>
                                             
                                            </select>
                                        </div>
                                </div>


                                
                                <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Ubicación</label>
                                          <select name="ubicacion" class="form-control mi-selector ubicacion" >
                                            <option value="*"> Seleccionar</option>
                                            <?php
                                                $data = ubicacion();
                                                foreach($data as $value) {
                                                echo "<option value=".$value["id"].">".$value["nombre_ubicacion"]."</option>";
                                                }
                                            ?>
                                          </select>
                                      </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Empleado</label>
                                            <select name="empleado" id="" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                
                                                  $data = empleado();
                                                  foreach($data as $value) {
                                                  echo "<option banco=".$value["id_banco"]."  value=".$value["id"].">".$value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]."</option>";
                                                  }
                                              ?>
                                            </select>

                                            <input type="hidden" name="banco" class="banco">
                                        </div>
                                </div>

                                <div class="col-md-12">
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

                            <!-- **********BOLETA OPCION Supervisor************ -->
                            <div class="col-md-12 opcionsupervisor" style="display: none;">
                              <form action="reporteboletasupervisor" method="post" target="_blank" >
                                
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

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Planilla</label>
                                            <select name="numero" id="" class="form-control mi-selector planilla cargardataplanilla" >
                                              <option value="*"> Seleccionar</option>
                                             
                                            </select>
                                        </div>
                                </div>

                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Seleccionar Supervisor</label>
                                            <select name="empleado" id="" class="form-control mi-selector empleado" >
                                              <option value="*"> Seleccionar</option>
                                              <?php
                                                
                                                function empleado_supervisor() {
                                                  $query = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                                  INNER JOIN cargos_desempenados 
                                                  WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='COORDINADOR DE ZONA' ";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = empleado_supervisor();
                                                  foreach($data as $value) {
                                                  echo "<option banco=".$value["id_banco"]."  value=".$value["id"].">".$value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]."</option>";
                                                  }
                                              ?>
                                            </select>

                                            <input type="hidden" name="banco" class="banco">
                                        </div>
                                </div>

                                <div class="col-md-12">
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
      $(".banco").val(banco);
      $(".ubicacion").val("*").trigger('change.select2');
    });

    $( ".ubicacion" ).change(function(){ 
      $(".empleado").val("*").trigger('change.select2');
    });


</script>
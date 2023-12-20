
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
                                  <label for="exampleInputEmail1">Seleccione el tipo de situación:</label>
                                  <select name="" id="tipodesituacion" class="form-control">
                                    <option value="">Seleccione el tipo de situación</option>
                                    <option value="reporteservicioeventual">PARTES DE SITUACION SERVICIO EVENTUAL</option>
                                    <option value="reportesituacionusuarios">PARTES DE SITUACION POR USUARIOS</option>
                                    <option value="reportesituacionfechaing">PARTES DE SITUACION POR FECHA INGRESO</option>
                                    <option value="reportesituacioncliente">REPORTE DE HORAS EXTRAS CLIENTE</option>
                                    <option value="reportesituacionlistado"> REPORTE DE HORAS EXTRAS OPCION LISTADO</option>
                                    <option value="reportesituacionlistadodia"> REPORTE DE HORAS EXTRAS OPCION LISTADO POR DIA</option>
                                    <option value="reportesitunoliquidadojefe"> REPORTE DE NO LIQUIDADO POR J.OPERACION</option>
                                    <option value="reportesituliquidadojefe"> REPORTE DE LIQUIDADO POR J.OPERACION</option>
                                    <option value="reportesituausencias">REPORTE DE MOVIMIENTOS AUSENCIAS</option>
                                    <option value="reportesituausenciasjp">REPORTE AUSENCIAS BOTON POR JOPERACION</option><!-- falta valor  dias -->
                                    <option value="reportesituanocubi">REPORTE DE HORAS NO CUBIERTAS</option>
                                   
                                  </select>
                                </div>
                              </div>
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="reporteservicioeventual" method="post" target="_blank" id="formulario" >

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Fecha Desde:</label>
                                  <input type="text" class="calendario form-control " name="fecha_desde"     readonly placeholder="Fecha Desde">
                                </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Hasta:</label>
                                    <input type="text" class="calendario form-control " name="fecha_hasta"     readonly placeholder="Fecha Hasta">
                                  </div>
                              </div>

                              
                              <div class="col-md-12 usuarios" style="display:none">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Seleccione Usuario:</label>
                                    <select name="usuario" class="form-control ">
                                      <option value="*">Todos los Usuarios</option>
                                      <?php
                                          function usuarios(){
                                            $query = "SELECT*FROM usuarios";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            $sql=null;
                                        }
                                        $data=usuarios();
                                        foreach ($data as $value) {
                                          # code...
                                          echo "<option value='".$value["id"]."'>".$value["usuario"]."</option>";
                                        }
                                      ?>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-12 clientes" style="display:none">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Seleccione Cliente:</label>
                                    <select name="cliente" class="form-control mi-selector allcliente">
                                      <option value="*">Todos los clientes</option>
                                      <?php
                                          function clientes(){
                                            $query = "SELECT*FROM clientes";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            $sql=null;
                                        }
                                        $data=clientes();
                                        foreach ($data as $value) {
                                          # code...
                                          echo "<option value='".$value["id"]."'>".$value["nombre"]."</option>";
                                        }
                                      ?>
                                    </select>
                                  </div>
                              </div>

                              <div class="col-md-12 ubicacion" style="display:none">
                                  <div class="form-group">
                                    <label for="">Seleccione ubicacion:</label>
                                    <select name="ubicacion" class="form-control mi-selector allubicacion">
                                      <option value="*">Todos los clientes</option>
                                      <?php
                                          function ubi(){
                                            $query = "SELECT*FROM tbl_clientes_ubicaciones";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            $sql=null;
                                        }
                                        $data=ubi();
                                        foreach ($data as $value) {
                                          # code...
                                          echo "<option value='".$value["codigo_ubicacion"]."'>".$value["nombre_ubicacion"]."</option>";
                                        }
                                      ?>
                                    </select>
                                  </div>
                              </div>


                              <div class="col-md-12 motivos" style="display:none">
                                  <div class="form-group">
                                    <label for="">Seleccione Motivo:</label>
                                    <select name="tipohora" class="form-control mi-selector">
                                      <option value="*">Todos los Motivos</option>
                                      <?php
                                          function tipohora(){
                                            $query = "SELECT*FROM tipohora";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            $sql=null;
                                        }
                                        $data=tipohora();
                                        foreach ($data as $value) {
                                          # code...
                                          echo "<option value='".$value["motivo_tipohora"]."'>".$value["motivo_tipohora"]."</option>";
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


  var cliente = $('.allcliente');
  cliente.on('change', function() {
    $(".allubicacion").val("*").trigger('change.select2');
  });

  var ubicacion = $('.allubicacion');
  ubicacion.on('change', function() {
    $(".allcliente").val("*").trigger('change.select2');
  });

var selectElement = $('#tipodesituacion');
  // Agregar un evento 'change' al elemento <select>
  selectElement.on('change', function() {
      $(".usuarios").attr("style","display:none");
      $(".motivos").attr("style","display:none");
      $(".ubicacion").attr("style","display:none");
      $(".clientes").attr("style","display:none");
      
      // Capturar el valor seleccionado cuando cambia la selección
      var selectedValue = $(this).val();
      $("#formulario").attr("action",selectedValue);

      if(selectedValue=="reportesituacionusuarios"){
        $(".usuarios").removeAttr("style");
      }
      else if(selectedValue=="reportesituacionfechaing"){
        $(".usuarios").removeAttr("style");
      }
      else if(selectedValue=="reportesituacioncliente"){
        $(".clientes").removeAttr("style");
      }else if(selectedValue=="reportesituacionlistado"){
        $(".motivos").removeAttr("style");
      }else if(selectedValue=="reportesituacionlistadodia"){
        $(".motivos").removeAttr("style");
      }
      else if(selectedValue=="reportesituanocubi"){
        $(".clientes").removeAttr("style");
        $(".ubicacion").removeAttr("style");
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
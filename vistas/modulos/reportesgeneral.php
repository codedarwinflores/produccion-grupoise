
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
        <a href="empleados" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
           
                <div class="col-md-12">
                            <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Seleccionar Reporte a Imprimir</label>
                                        <select name="reportes" class="form-control mi-selector" id="reportes">
                                        <option value="*"> Seleccionar Reporte</option>
                                        <option value="reportepersonalconansp">Reporte Personal con ANSP</option>
                                        <option value="reportepersonalsinansp">Reporte Personal sin ANSP</option>
                                        <option value="reportevencimientolicarna">Reporte Vencimiento de Licencia de portacion de arma</option>
                                        <option value="reporteretiro">Reporte agentes retirado</option>
                                        <option value="reportecontratadospnc">Reporte informe personal PNC</option>
                                        <option value="reporteopcionlistado">LISTADO DE EMPLEADO OPCION LISTADO</option>
                                        <option value="reporteopcionvacacion">REPORTE EMPLEADO VACACIONES</option>
                                        <option value="reporteopcionseguro">REPORTE EMPLEADO SEGURO</option>
                                        <option value="reporteopcioninde">REPORTE CALCULO DE INDEMNIZACIONES</option>
                                        <option value="reporteopcionaguinaldo">REPORTE CALCULO DE AGUINALDO</option>
                                        
                                        </select>
                                    </div>
                            </div>

                            <div class="col-md-12">
                              <br>
                                <a href="" class="btn btn-primary iraimprimir">Imprimir</a>
                            </div>

                            <!-- ********************** -->
                            <div class="col-md-12 ocultodiv" style="display: none;">
                              <form action="vistas/modulos/reporteretirados.php" method="post" target="_blank" >
                                <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Fecha Desde</label>
                                          <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha_desde"  placeholder="Ingresar Fecha" readonly>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Fecha hasta</label>
                                          <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha_hasta"  placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                                      </div>
                                </div>
                                <br>
                                <input type="submit" value="Imprimir" class="btn btn-primary">
                              </form>
                            </div>
                            <!-- ********************* -->
                            
                            <!-- ********************** -->
                            <div class="col-md-12 ocultodiv2" style="display: none;">
                              <form action="vistas/modulos/reportecontratadospnc.php" method="post" target="_blank" >
                                <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Fecha Desde</label>
                                          <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha_desde"  placeholder="Ingresar Fecha" readonly>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Fecha hasta</label>
                                          <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha_hasta"  placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                                      </div>
                                </div>
                                <br>
                                <input type="submit" value="Imprimir" class="btn btn-primary">
                              </form>
                            </div>
                            <!-- ********************* -->

                            <!-- ********************** -->
                            <div class="col-md-12 ocultodiv3" style="display: none;">
                              <form action="reporteopcionvacacion" method="post" target="_blank" >
                                <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Selecciones Mes</label>
                                            <select name="messeleccionado" id="" class="form-control">
                                                <option value="*">Seleccione Mes</option>
                                                <option value="01">Enero</option>
                                                <option value="02">Febrero</option>
                                                <option value="03">Marzo</option>
                                                <option value="04">Abril</option>
                                                <option value="05">Mayo</option>
                                                <option value="06">Junio</option>
                                                <option value="07">Julio</option>
                                                <option value="08">Agosto</option>
                                                <option value="09">Septiembre</option>
                                                <option value="10">Octubre</option>
                                                <option value="11">Noviembre</option>
                                                <option value="12">Diciembre</option>
                                            </select>
                                      </div>
                                </div>
                                <br>
                                <input type="submit" value="Imprimir" class="btn btn-primary">
                              </form>
                            </div>
                            <!-- ********************* -->

                            <!-- ********************** -->
                            <div class="col-md-12 ocultodiv4" style="display: none;">
                              <form action="reporteopcionseguro" method="post" target="_blank" >
                                <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Selecciones Opcion</label>
                                            <select name="opcionseguro" id="" class="form-control">
                                                <option value="*">Todos</option>
                                                <option value="conseguro">Con Seguro</option>
                                                <option value="sinseguro">Sin Seguro</option>
                                            </select>
                                      </div>
                                </div>
                                <br>
                                <input type="submit" value="Imprimir" class="btn btn-primary">
                              </form>
                            </div>
                            <!-- ********************* -->

                            
                            <!-- ********************** -->
                            <div class="col-md-12 ocultodiv5" style="display: none;">
                              <form action="reporteopcioninde" method="post" target="_blank" >
                                <!-- ***************** -->

                                
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Empleados Desde:</label>
                                        <select name="empleado_rango_desde" id="empleado_rango_desde" class="form-control  mi-selector">
                                            <option value="*">*</option>
                                            <?php
                                            
                                            function empleados()
                                              {
                                                $query01 = "SELECT * FROM `tbl_empleados` ORDER BY id ASC";
                                                $sql = Conexion::conectar()->prepare($query01);
                                                $sql->execute();
                                                return $sql->fetchAll();
                                              };
                                              $data01 = empleados();
                                              foreach ($data01 as $value) {
                                                $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                                $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                              ?>
                                              <option value="<?php echo $value["id"];?>"><?php echo $value["codigo_empleado"].'-'.$nombre_cargo.' '.$value["primer_apellido"]; ?></option>
                                            <?php
                                              }
                                            ?>
                                        </select>

                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Empleados Hasta:</label>
                                        <select name="empleado_rango_hasta" id="empleado_rango_hasta" class="form-control  mi-selector">
                                            <option value="*">*</option>
                                            <?php
                                              $data01 = empleados();
                                              foreach ($data01 as $value) {
                                                $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                                $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                              ?>
                                              <option value="<?php echo $value["id"];?>"><?php echo $value["codigo_empleado"].'-'.$nombre_cargo; ?></option>
                                            <?php
                                              }
                                            ?>
                                        </select>


                                      </div>
                                  </div>

                                <!-- ***************** -->
                                <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccione Fecha</label>
                                            <input type="text" class="form-control calendario" name="fecha" autocomplete="off">
                                      </div>
                                </div>
                                <div class="col-md-12">
                                <input type="submit" value="Imprimir" class="btn btn-primary">

                                </div>
                                
                              </form>
                            </div>
                            <!-- ********************* -->

                            
                            <!-- ********************** -->
                            <div class="col-md-12 ocultodiv6" style="display: none;">
                              <form action="reporteopcionaguinaldo" method="post" target="_blank" >
                                <!-- ***************** -->

                                
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Empleados Desde:</label>
                                        <select name="empleado_rango_desde" id="empleado_rango_desde" class="form-control  mi-selector">
                                            <option value="*">*</option>
                                            <?php
                                            
                                              $data01 = empleados();
                                              
                                              foreach ($data01 as $value) {
                                                $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                                $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                              ?>
                                              <option value="<?php echo $value["id"];?>"><?php echo $value["codigo_empleado"].'-'.$nombre_cargo.' '.$value["primer_apellido"]; ?></option>
                                            <?php
                                              }
                                            ?>
                                        </select>

                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Empleados Hasta:</label>
                                        <select name="empleado_rango_hasta" id="empleado_rango_hasta" class="form-control  mi-selector">
                                            <option value="*">*</option>
                                            <?php
                                              $data01 = empleados();
                                              foreach ($data01 as $value) {
                                                $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                                                $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                                              ?>
                                              <option value="<?php echo $value["id"];?>"><?php echo $value["codigo_empleado"].'-'.$nombre_cargo; ?></option>
                                            <?php
                                              }
                                            ?>
                                        </select>


                                      </div>
                                  </div>

                                <!-- ***************** -->
                                <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccione Fecha</label>
                                            <input type="text" class="form-control calendario" name="fecha" autocomplete="off">
                                      </div>
                                </div>
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

<script src="vistas/js/reportesglobales.js"></script>

<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);


    
    $( "#reportes" ).change(function(){ 
      var tipo = $('option:selected', this).val();
      
      

    })
</script>
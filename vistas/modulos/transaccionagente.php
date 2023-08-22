<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Movimiento";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_transacciones_agente;
  $query = "SHOW COLUMNS FROM $nombretabla_transacciones_agente";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};




?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        

      </div>

      <div class="row">
        <div class="col-md-4">
          <div class="box-body">
            <h4>Paso 1- Seleccione al Agente de Seguridad</h4>
            <div style="height: 35px;"></div>
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                  <thead>
                  <tr>
                    <th>Nombre Completo</th>
                  </tr> 
        
                </thead>
        
                <tbody>
        
                <?php

            function obtenerempleado() {
              /* $query = "SELECT empleado.*, empleado.id as idempleado  FROM tbl_empleados AS empleado
                        INNER JOIN
                        cargos_desempenados AS cargos
                        ON empleado.nivel_cargo = cargos.id and cargos.descripcion='Agente de seguridad'"; */
                $query = "SELECT empleado.*, empleado.id as idempleado  FROM tbl_empleados AS empleado
                        INNER JOIN
                        cargos_desempenados AS cargos
                        ON empleado.nivel_cargo = cargos.id ";
              
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };

        
                   
              $data0 = obtenerempleado();
              foreach($data0 as $value) {
                  
                  echo ' <tr>
                          <td class="nombreempleado" codigoempleado="'.$value["codigo_empleado"].'" idempleado="'.$value["idempleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]. '">'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]. '</td>';
        
                          
        
                          echo '</tr>';
                }
        
        
                ?> 
        
                </tbody>
  
            </table>
          </div>
        </div>
        <div class="col-md-8">
          <div class="box-body">
            <h4>Paso 2- Seleccione el Movimiento o Crear Nuevo</h4>
            <button class="btn btn-primary agregarbtnmovimiento" data-toggle="modal" data-target="#modalAgregartransacciones_agente">
              Agregar <?php echo $Nombre_del_Modulo;?>
             </button>

             <h4 class="nombre_empleado"></h4>
            <table class="table table-bordered table-striped dt-responsive tablas tablacargadatos" width="100%">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Tipo Movimiento</th>
                  <th>Nueva Ubicación</th>
                  <th>Ubicación Anterior</th>
                  <th>Acciones</th>
                </tr> 
      
              </thead>
      
              <tbody id="cargardata">
      
            
      
              </tbody>
      
            </table>

            <!-- maestros -->
            <input type="hidden" id="txtcodigoempleado">
            <input type="hidden" id="txtidempleado">
            <input type="hidden" id="txtidubicacion">
            <input type="hidden" id="txtcodigoubicacion">
            <input type="hidden" id="txtnombreubicacion">
            <input type="hidden" id="idnuevaubicacion">
            <input type="hidden" id="insertarvacante">
            <input type="hidden" id="insertarnuevaubicacion">
            <input type="hidden" id="ubicacionanterior">



           </div>
        </div>
      </div>

      

    </div>

  </section>

</div>





<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregartransacciones_agente" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 900px !important;">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar <?php echo $Nombre_del_Modulo;?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

            <h4 class="nombre_empleado"></h4>

             <!-- *************** -->

             <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
              
              <!-- *************** -->
  
            <input type="hidden" class="form-control input-lg input_idagente_transacciones_agente" name="nuevoidagente_transacciones_agente" id="nuevoidagente_transacciones_agente" placeholder="" value="">
               
  
              <!-- ******************** -->
  
              <div class="form-group   grupotransacciones_agente_fecha_transacciones_agente col-md-3">
                <label for="" class="">Ingresar Fecha</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_transacciones_agente calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="nuevofecha_transacciones_agente" id="nuevofecha_transacciones_agente" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly>
                </div>
              </div>
              <!-- ********************* -->
              <div class="form-group   grupotransacciones_agente_hora_transacciones_agente col-md-3">
                <label for="" class="">Hora</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_hora_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_hora_transacciones_agente" name="nuevohora_transacciones_agente" id="nuevohora_transacciones_agente" placeholder="Ingresar Hora" value="" autocomplete="off" required="" readonly>
                </div>
              </div>
  
              <!-- ********************* -->

              <div class="form-group   grupofecha_movimiento_transacciones_agente col-md-6">
                <label for="" class=""> Fecha Movimiento</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class=""></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_movimiento_transacciones_agente calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="nuevofecha_movimiento_transacciones_agente" id="nuevofecha_movimiento_transacciones_agente" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly>
                </div>
              </div>

              <!-- ************************** -->


  
              <div class="form-group   grupotransacciones_agente_tipo_movimiento_transacciones_agente col-md-12">
                <label for="" class="">Tipo de Movimiento</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_tipo_movimiento_transacciones_agente"></i></span> 

                  <select class="form-control input-lg input_tipo_movimiento_transacciones_agente mi-selector" name="nuevotipo_movimiento_transacciones_agente" id="nuevotipo_movimiento_transacciones_agente" >

                      <option value="">Seleccione Tipo Movimiento</option>
                      <?php
                          $datos_mostrar = Controladortransaccionespersonal::ctrMostrar($item, $valor);
                          foreach ($datos_mostrar as $key => $value){
                      ?>
                          <option codigomovimiento="<?php echo $value['codigo']?>" cubriragente="<?php echo $value['cubrir_vacante'] ?>"  value="<?php echo $value['codigo'].'-'.$value['nombre'].'-'.$value['tipo_movimiento_personal'] ?>">
                            <?php echo $value['codigo'].'-'.$value['nombre'].'-'.$value['tipo_movimiento_personal'] ?>
                          </option>  
                      <?php
                          }
                        ?>

                  </select>


                </div>
              </div>
              <!-- ********************* -->

         
  
              <div class="form-group   grupotransacciones_agente_nueva_ubicacion_transacciones_agente col-md-6">
                <label for="" class="">Nueva Ubicación</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_nueva_ubicacion_transacciones_agente"></i></span> 
      
                          <select class="form-control input-lg input_nueva_ubicacion_transacciones_agente mi-selector" name="nuevonueva_ubicacion_transacciones_agente" id="nuevonueva_ubicacion_transacciones_agente">
                          <option value="">Seleccione Nueva Ubicación</option>
                            <?php
                                $datos_mostrar = Controladorubicacionc::ctrMostrar($item, $valor);
                                foreach ($datos_mostrar as $key => $value){
                            ?>
                                <option idubicacion="<?php echo $value['idubicacionc']?>" codigo="<?php echo $value['codigo_ubicacion']?>" value="<?php echo $value['codigo_ubicacion'].'-'.$value['nombre_ubicacion'] ?>">
                                  <?php echo $value['codigo_ubicacion'].'-'.$value['nombre_ubicacion'] ?>
                                </option>  
                            <?php
                                }
                              ?>

                          </select>

                </div>
              </div>
              <!-- ********************* -->

              <div class="form-group    col-md-6 grupoid_vacante_transacciones_agente" style="visibility:hidden;">
                <label for="" class="">Vacante</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class=""></i></span> 
                  <select class="form-control vacante_a_cubrir" name="nuevoid_vacante_transacciones_agente" id="nuevoid_vacante_transacciones_agente">
                    
                  </select>
        
                </div>
              </div>


  
              <div class="form-group   grupotransacciones_agente_ubicacion_anterior_transacciones_agente col-md-12">
                <label for="" class="">Anterior Ubicación</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_ubicacion_anterior_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_ubicacion_anterior_transacciones_agente" name="nuevoubicacion_anterior_transacciones_agente" id="nuevoubicacion_anterior_transacciones_agente" placeholder="Anterior Ubicación" value="" autocomplete="off" readonly>
                </div>
              </div>
              <!-- ********************* -->

              
              <div class="form-group   grupotransacciones_agente_presento_incapacidad_transacciones_agente col-md-6">
                <label for="" class="">Presento Incapacidad?</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_presento_incapacidad_transacciones_agente"></i></span> 
                  <select class="form-control input-lg input_presento_incapacidad_transacciones_agente" name="nuevopresento_incapacidad_transacciones_agente" id="nuevopresento_incapacidad_transacciones_agente">
                      <option value="">Presento Incapacidad?</option>
                      <option value="Si">Si</option>
                      <option value="No">No</option>

                  </select>

                </div>
              </div>
              <!-- ********************* -->


              <div class="form-group col-md-6">
                <label for="" class="">Seleccione Incapacidad</label> 
                <div class="input-group">
                    <span class="input-group-addon"><i class="icono_ubicacion_anterior_transacciones_agente"></i></span> 
                    <select class="form-control input-lg incapacidad_select" name="nuevotipo_incapacidad_transacciones_agente" id="nuevotipo_incapacidad_transacciones_agente">
                      <option value="">Seleccione Incapacidad</option>
                      <option value="Inicial">Inicial</option>
                      <option value="Prorroga">Prorroga</option>
                    </select>
                </div>
              </div>


            

              <!-- ********************* -->
  
              <div class="form-group ocultar  grupotransacciones_agente_fecha_desde_transacciones_agente col-md-4">
                <label for="" class="">Ingresar Desde</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_desde_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_desde_transacciones_agente calendario" name="nuevofecha_desde_transacciones_agente" id="nuevofecha_desde_transacciones_agente" placeholder="Ingresar Desde" value="" autocomplete="off" readonly>
                </div>
              </div>
              <!-- ********************* -->
  
              <div class="form-group ocultar  grupotransacciones_agente_fecha_hasta_transacciones_agente col-md-4">
                <label for="" class="">Ingresar Hasta</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_hasta_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_hasta_transacciones_agente calendario" name="nuevofecha_hasta_transacciones_agente" id="nuevofecha_hasta_transacciones_agente" placeholder="Ingresar Hasta" value="" autocomplete="off" readonly>
                </div>
              </div>
              <!-- ********************* -->

              <div class="form-group  ocultar  col-md-4">
                <label for="" class="">Número Dias</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class=""></i></span> 
                  <input type="text" class="form-control input-lg input_numero_dias_transacciones_agente" name="nuevonumero_dias_transacciones_agente" id="nuevonumero_dias_transacciones_agente" placeholder="Número de dias" value="" autocomplete="off" readonly>
                </div>
              </div>

              <!-- ************************* -->
  
  
  
              <div class="form-group   grupotransacciones_agente_comentarios_transacciones_agente col-md-8">
                <label for="" class="">Comentario</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_comentarios_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_comentarios_transacciones_agente" name="nuevocomentarios_transacciones_agente" id="nuevocomentarios_transacciones_agente" placeholder="" value="" autocomplete="off">
                </div>
              </div>
              <!-- ********************* -->
  
  
  
              <div class="form-group   grupotransacciones_agente_turno_transacciones_agente col-md-4">
                <label for="" class="">Seleccione Turno</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_turno_transacciones_agente"></i></span> 
                  <select class="form-control input-lg input_turno_transacciones_agente" name="nuevoturno_transacciones_agente" id="nuevoturno_transacciones_agente">
                    <option value="">Seleccione Turno</option>
                    <option value="24h/r">24h/r</option>
                    <option value="24h/d5">24h/d5</option>
                    <option value="24h/d6">24h/d6</option>
                    <option value="24h/n6">24h/n6</option>
                    <option value="24h/d7">24h/d7</option>
                    <option value="24h/n7">24h/n7</option>
                    <option value="Septimo">Septimo</option>
                  </select>

                </div>
              </div>
              <!-- ********************* -->

              
              <div class="col-md-12"><hr></div>
              <div class="col-md-2">
                <br>
                <label for="">HORARIO DE TRABAJO</label>
              </div>
           
              <!-- ********************* -->
              <div class="form-group   grupotransacciones_agente_horario_desde_transacciones_agente col-md-3">
                <label for="" class="">Dia Desde</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_desde_transacciones_agente"></i></span> 
                  <select class="form-control input-lg input_horario_desde_transacciones_agente" name="nuevohorario_desde_transacciones_agente" id="nuevohorario_desde_transacciones_agente">
                    <option value="">Seleccionar Horario Desde</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                  </select>


                </div>
              </div>
              <!-- ********************* -->
  
  
              <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-3">
                <label for="" class="">Dia Hasta</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span> 

                  <select class="form-control input-lg input_horario_hasta_transacciones_agente" name="nuevohorario_hasta_transacciones_agente" id="nuevohorario_hasta_transacciones_agente" >
                    <option value="">Seleccionar Horario Desde</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                  </select>
                </div>
              </div>

            <!-- ************************ -->
            <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-2">
                <label for="" class="">Hora Desde</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span> 
                  <input type="text" class="form-control tiempo input-lg" name="nuevohora_desde_transacciones_agente" id="nuevohora_desde_transacciones_agente">
                </div>
              </div>

            <!-- ************************ -->

            <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-2">
                <label for="" class="">Hora Hasta</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span> 
                  <input type="text" class="form-control tiempo input-lg" name="nuevohora_hasta_transacciones_agente" id="nuevohora_hasta_transacciones_agente">
                </div>
              </div>

            <!-- ************************ -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardarvacante">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladortransacciones_agente();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartransacciones_agente" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 900px !important;">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar <?php echo $Nombre_del_Modulo?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

           
            <h4 class="nombre_empleado"></h4>

                <!-- *************** -->

                <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
              
              <!-- *************** -->
  
                  <input type="hidden" class="form-control input-lg input_idagente_transacciones_agente" name="editaridagente_transacciones_agente" id="editaridagente_transacciones_agente" placeholder="" value="">
               
  
              <!-- ******************** -->
  
              <div class="form-group   grupotransacciones_agente_fecha_transacciones_agente col-md-3">
                <label for="" class="">Ingresar Fecha</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_transacciones_agente calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="editarfecha_transacciones_agente" id="editarfecha_transacciones_agente" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly>
                </div>
              </div>
              <!-- ********************* -->
              <div class="form-group   grupotransacciones_agente_hora_transacciones_agente col-md-3">
                <label for="" class="">Hora</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_hora_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_hora_transacciones_agente" name="editarhora_transacciones_agente" id="editarhora_transacciones_agente" placeholder="Ingresar Hora" value="" autocomplete="off" required="" readonly>
                </div>
              </div>
  
              <!-- ********************* -->

              
              <div class="form-group   grupofecha_movimiento_transacciones_agente col-md-5">
                <label for="" class="">Ingresar Fecha Movimiento</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class=""></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_movimiento_transacciones_agente calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="editarfecha_movimiento_transacciones_agente" id="editarfecha_movimiento_transacciones_agente" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly>
                </div>
              </div>
              <!-- ********************* -->
  
              <div class="form-group   grupotransacciones_agente_tipo_movimiento_transacciones_agente col-md-12">
                <label for="" class="">Tipo de Movimiento</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_tipo_movimiento_transacciones_agente"></i></span> 

                  <select class="form-control input-lg input_tipo_movimiento_transacciones_agente mi-selector" name="editartipo_movimiento_transacciones_agente" id="editartipo_movimiento_transacciones_agente" >

                      <option value="" id="tipomovimiento">Seleccione Tipo Movimiento</option>
                      <?php
                          $datos_mostrar = Controladortransaccionespersonal::ctrMostrar($item, $valor);
                          foreach ($datos_mostrar as $key => $value){
                      ?>
                          <option codigomovimiento="<?php echo $value['codigo']?>" value="<?php echo $value['codigo'].'-'.$value['nombre'].'-'.$value['tipo_movimiento_personal'] ?>">
                            <?php echo $value['codigo'].'-'.$value['nombre'].'-'.$value['tipo_movimiento_personal'] ?>
                          </option>  
                      <?php
                          }
                        ?>

                  </select>


                </div>
              </div>
              <!-- ********************* -->

              
  
              <div class="form-group   grupotransacciones_agente_nueva_ubicacion_transacciones_agente col-md-6">
                <label for="" class="">Nueva Ubicación</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_nueva_ubicacion_transacciones_agente"></i></span> 
      
                          <select class="form-control input-lg input_nueva_ubicacion_transacciones_agente mi-selector" name="editarnueva_ubicacion_transacciones_agente" id="editarnueva_ubicacion_transacciones_agente">
                          <option   value="" id="nuevaubicacion">Seleccione Nueva Ubicación</option>
                            <?php
                                $datos_mostrar = Controladorubicacionc::ctrMostrar($item, $valor);
                                foreach ($datos_mostrar as $key => $value){
                            ?>
                                <option idubicacion="<?php echo $value['idubicacionc']?>" codigo="<?php echo $value['codigo_ubicacion']?>" value="<?php echo $value['codigo_ubicacion'].'-'.$value['nombre_ubicacion'] ?>">
                                  <?php echo $value['codigo_ubicacion'].'-'.$value['nombre_ubicacion'] ?>
                                </option>  
                            <?php
                                }
                              ?>

                          </select>

                </div>
              </div>
              <!-- ********************* -->


              <div class="form-group    col-md-6 grupoid_vacante_transacciones_agente" style="visibility:hidden;">
                <label for="" class="">Vacante</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class=""></i></span> 
                  <select class="form-control vacante_a_cubrir" name="editarid_vacante_transacciones_agente" id="editarid_vacante_transacciones_agente">
                    
                  </select>
        
                </div>
              </div>
              <!-- ***************** -->
  
              <div class="form-group   grupotransacciones_agente_ubicacion_anterior_transacciones_agente col-md-12">
                <label for="" class="">Anterior Ubicación</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_ubicacion_anterior_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_ubicacion_anterior_transacciones_agente" name="editarubicacion_anterior_transacciones_agente" id="editarubicacion_anterior_transacciones_agente" placeholder="Anterior Ubicación" value="" autocomplete="off" readonly>
                </div>
              </div>
              <!-- ********************* -->

              <div class="form-group   grupotransacciones_agente_presento_incapacidad_transacciones_agente col-md-6">
                <label for="" class="">Presento Incapacidad?</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_presento_incapacidad_transacciones_agente"></i></span> 
                  <select class="form-control input-lg input_presento_incapacidad_transacciones_agente" name="editarpresento_incapacidad_transacciones_agente" id="editarpresento_incapacidad_transacciones_agente">
                      <option value="">Presento Incapacidad?</option>
                      <option value="Si">Si</option>
                      <option value="No">No</option>

                  </select>

                </div>
              </div>
              <!-- ********************* -->


              
              <div class="form-group col-md-6">
                <label for="" class="">Seleccione Incapacidad</label> 
                <div class="input-group">
                    <span class="input-group-addon"><i class="icono_ubicacion_anterior_transacciones_agente"></i></span> 
                    <select class="form-control input-lg incapacidad_select" name="editartipo_incapacidad_transacciones_agente" id="editartipo_incapacidad_transacciones_agente">
                      <option value="">Seleccione Incapacidad</option>
                      <option value="Inicial">Inicial</option>
                      <option value="Prorroga">Prorroga</option>
                    </select>
                </div>
              </div>

              <!-- ********************* -->

           



  
              <div class="form-group ocultar  grupotransacciones_agente_fecha_desde_transacciones_agente col-md-4">
                <label for="" class="">Ingresar Desde</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_desde_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg einput_fecha_desde_transacciones_agente calendario" name="editarfecha_desde_transacciones_agente" id="editarfecha_desde_transacciones_agente" placeholder="Ingresar Desde" value="" autocomplete="off" readonly>
                </div>
              </div>
              <!-- ********************* -->
  
              <div class="form-group ocultar  grupotransacciones_agente_fecha_hasta_transacciones_agente col-md-4">
                <label for="" class="">Ingresar Hasta</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_hasta_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg einput_fecha_hasta_transacciones_agente calendario" name="editarfecha_hasta_transacciones_agente" id="editarfecha_hasta_transacciones_agente" placeholder="Ingresar Hasta" value="" autocomplete="off" readonly>
                </div>
              </div>
              <!-- ********************* -->


              
              <div class="form-group ocultar   col-md-4">
                <label for="" class="">Número Dias</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class=""></i></span> 
                  <input type="text" class="form-control input-lg einput_numero_dias_transacciones_agente" name="editarnumero_dias_transacciones_agente" id="editarnumero_dias_transacciones_agente" placeholder="Número de dias" value="" autocomplete="off" readonly>
                </div>
              </div>

              <!-- ************************* -->
  
            
  
  
              <div class="form-group   grupotransacciones_agente_comentarios_transacciones_agente col-md-8">
                <label for="" class="">Comentario</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_comentarios_transacciones_agente"></i></span> 
                  <input type="text" class="form-control input-lg input_comentarios_transacciones_agente" name="editarcomentarios_transacciones_agente" id="editarcomentarios_transacciones_agente" placeholder="" value="" autocomplete="off">
                </div>
              </div>
              <!-- ********************* -->
  
  
  
              <div class="form-group   grupotransacciones_agente_turno_transacciones_agente col-md-4">
                <label for="" class="">Seleccione Turno</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_turno_transacciones_agente"></i></span> 
                  <select class="form-control input-lg input_turno_transacciones_agente" name="editarturno_transacciones_agente" id="editarturno_transacciones_agente">
                    <option value="">Seleccione Turno</option>
                    <option value="24h/r">24h/r</option>
                    <option value="24h/d5">24h/d5</option>
                    <option value="24h/d6">24h/d6</option>
                    <option value="24h/n6">24h/n6</option>
                    <option value="24h/d7">24h/d7</option>
                    <option value="24h/n7">24h/n7</option>
                    <option value="Septimo">Septimo</option>
                  </select>

                </div>
              </div>

              <div class="col-md-12"><hr></div>
              <div class="col-md-2">
                <br>
                <label for="">HORARIO DE TRABAJO</label>
              </div>
           
              <!-- ********************* -->
              <div class="form-group   grupotransacciones_agente_horario_desde_transacciones_agente col-md-3">
                <label for="" class="">Dia Desde</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_desde_transacciones_agente"></i></span> 
                  <select class="form-control input-lg input_horario_desde_transacciones_agente" name="editarhorario_desde_transacciones_agente" id="editarhorario_desde_transacciones_agente">
                    <option value="">Seleccionar Horario Desde</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                  </select>


                </div>
              </div>
              <!-- ********************* -->
  
  
              <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-3">
                <label for="" class="">Dia Hasta</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span> 

                  <select class="form-control input-lg input_horario_hasta_transacciones_agente" name="editarhorario_hasta_transacciones_agente" id="editarhorario_hasta_transacciones_agente" >
                    <option value="">Seleccionar Horario Desde</option>
                    <option value="Lunes">Lunes</option>
                    <option value="Martes">Martes</option>
                    <option value="Miercoles">Miercoles</option>
                    <option value="Jueves">Jueves</option>
                    <option value="Viernes">Viernes</option>
                    <option value="Sábado">Sábado</option>
                    <option value="Domingo">Domingo</option>
                  </select>
                </div>
              </div>

            <!-- ************************ -->
            <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-2">
                <label for="" class="">Hora Desde</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span> 
                  <input type="text" class="form-control tiempo input-lg" name="editarhora_desde_transacciones_agente" id="editarhora_desde_transacciones_agente">
                </div>
              </div>

            <!-- ************************ -->

            <div class="form-group   grupotransacciones_agente_horario_hasta_transacciones_agente col-md-2">
                <label for="" class="">Hora Hasta</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_horario_hasta_transacciones_agente"></i></span> 
                  <input type="text" class="form-control tiempo input-lg" name="editarhora_hasta_transacciones_agente" id="editarhora_hasta_transacciones_agente">
                </div>
              </div>

            <!-- ************************ -->




          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardarvacante">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladortransacciones_agente();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladortransacciones_agente();
  $borrar -> ctrBorrar();

?> 



<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>
    window.location = "inicio";
  </script>';
  return;
}

$Nombre_del_Modulo="Situación";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_sim;
  $query = "SHOW COLUMNS FROM $nombretabla_sim";
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
        <div class="col-md-12">
          <div class="box-body">
              <label for="">Seleccione Empleado</label>
              <select name="" id="" class="form-control nombreempleado_situacion mi-selector">
                <option value="">Seleccione Empleado</option>
                <?php
                    function obtenerempleado() {
                      /* $query = "SELECT * FROM tbl_empleados AS empleado
                                INNER JOIN
                                cargos_desempenados AS cargos
                                ON empleado.nivel_cargo = cargos.id and cargos.descripcion='Agente de seguridad'"; */
                      $query = "SELECT * FROM tbl_empleados AS empleado
                                INNER JOIN
                                cargos_desempenados AS cargos
                                ON empleado.nivel_cargo = cargos.id";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                    $data0 = obtenerempleado();
                    foreach($data0 as $value) {
                          echo ' 
                                  <option class="" codigo="'.$value["codigo_empleado"].'" idempleado="'.$value["id"].'" nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
                                  '.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' - '.$value["descripcion"].'</option>';
                        }
                  ?> 
              </select>
              <br>
              <h4>
                Ubicación:
              </h4>
              <h5 class="mostrar_ubicacion"></h5>

              <input type="hidden" id="idempleado">
              <input type="hidden" id="codigo_empleado">
              <input type="hidden" id="nombre_empleado">

              <input type="hidden" id="idubicacion">
              <input type="hidden" id="codigo_ubicacion">
              <input type="hidden" id="nombre_ubicacion">

          </div>
        </div>
        <div class="col-md-12">
            <button class="btn btn-primary agregar_situacion" data-toggle="modal" data-target="#modalAgregarsituacion">
              Agregar <?php echo $Nombre_del_Modulo;?>
            </button>
            <br>

            <div class="box-body" style=" height: 450px;  overflow: scroll;" id="cargar_data_situacion">

            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
              <thead>
                <tr>
                <th>Fecha</th>
                <th>D.AUS</th>
                <th>H.AUS</th>
                <th>C.ISSS</th>
                <th>INCAP</th>
                <th>ANSP</th>
                <th>VACAC</th>
                <th>PERMI</th>
                <th>H.EXT</th>
                <th>H.NOR</th>
                <th>T.COMP</th>
                <th>R.TIEMP</th>
                <th>D. No Sueldo</th>
                <th>Acciones</th>

                </tr> 

              </thead>

              <tbody>
              </tbody>
            </table>
               
            </div>
            
        </div>
      </div>
    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarsituacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 950px;">

    <div class="modal-content">

  
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

              <div class="box-dody">

                <input type="hidden" id="id">
                <input type="text" id="accion">
                <input type="hidden" id="idempleado_situacion">

                <!-- ****************** -->
                <table class="tabla_situacion" width="100%">
                  <thead>
                    <tr>
                      <th style="width:90px">Fecha</th>
                      <th>D.AUS</th>
                      <th>H.AUS</th>
                      <th>C.ISSS</th>
                      <th>INCAP</th>
                      <th>ANSP</th>
                      <th>VACAC</th>
                      <th>PERMI</th>
                      <th>H.EXT</th>
                      <th>H.NOR</th>
                      <th>T.COMP</th>
                      <th>R.TIEMP</th>
                      <th>D. No Sueldo</th>

          
                    </tr> 
                  </thead>
          
                  <tbody>
                    <tr>
                      <td style="width:90px"><input type="text" class="form-control calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" id="fecha_situacion" oninput="validateNumber(this);" readonly autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="dias_ausencia_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="horas_ausencia_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="consulta_isss_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="incapacidad_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="ansp_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="vacaciones_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="permiso_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable activarmotivo"  id="hora_extra_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable activarmotivo" id="hora_normales_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable activarmotivo" id="tiempo_compensatorio_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="recuperar_tiempo_situacion" oninput="validateNumber(this);" autocomplete="off"></td>
                      <td><input type="text" class="form-control inputtable" id="dias_no_sueldo" oninput="validateNumber(this);" autocomplete="off"></td>
                    </tr>
                  </tbody>
                </table>
                <!-- ****************** -->
                <div class="col-md-12"><br></div>
           
                <!-- ****************** -->
                  <div class="form-group col-md-3">
                    <label>Es un rol de Comodin?</label>
                    <select  id="comodin_situacion" class="form-control">
                        <option value="">Es un rol de Comodin?</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3 inicial_situacion">
                    <label>Inicial</label>
                    <select  id="inicial_situacion" class="form-control">
                        <option value="">Seleccione opción</option>
                        <option value="Inicial">Inicial</option>
                        <option value="No">No</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3 inicial_situacion">
                    <label>Dias trabajados de incapacidad</label>
                   <input type="text" class="form-control" id="dias_tra_incapacidad">
                  </div>


                  <div class="form-group col-md-3 motivo_situacion">
                    <label>Motivo Horas Extras?</label>
                    <select  id="motivo_horas_extras" class="form-control mi-selector">
                        <option value="" id="motivo_value">Motivo Horas Extras?</option>
                        <?php
                        function consultar_hora() {
                          $query01 = "SELECT * FROM `tipohora` ";
                           $sql = Conexion::conectar()->prepare($query01);
                           $sql->execute();			
                           return $sql->fetchAll();
                        };
                        $data01 = consultar_hora();
                        foreach($data01 as $value) {
                          echo "<option descontar_tipohora='".$value["descontar_tipohora"]."' ingreso_hora_tipohora='".$value["ingreso_hora_tipohora"]."'  cobrar_cliente_tipohora='".$value["cobrar_cliente_tipohora"]."'  solicitado_tipohora='".$value["solicitado_tipohora"]."' requiere_agente='".$value["requiere_agente_tipohora"]."' value='".$value["codigo_tipohora"]."-".$value["motivo_tipohora"]."'>".$value["codigo_tipohora"]."-".$value["motivo_tipohora"]." </option>";
                        }
                        ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label>Servicio Eventual?</label>
                    <select  id="servicio_eventual_situacion" class="form-control">
                        <option value="">Servicio Eventual?</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div>

                  <!-- ******************** -->
                  <div class="form-group col-md-3">
                    <label>No Cubierto</label>
                    <select  id="cubierto_situacion" class="form-control">
                        <option value="">No Cubierto</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3">
                    <label>Seleccione Ubicación</label>

                    <select  id="ubicacion_situacion" class="form-control mi-selector">
                            <option value="" id="selec_ubicacion">Seleccione  Ubicación</option>
                            <?php


                              function ubicacion_con_hombres_autorizados() {
                                $query01 = "SELECT tbl_clientes_ubicaciones.id as idubicacion,  tbl_clientes_ubicaciones.*, tbl_ubicaciones_detalle.* 
                                FROM `tbl_ubicaciones_detalle` 
                                INNER JOIN tbl_clientes_ubicaciones 
                                WHERE tbl_clientes_ubicaciones.id = tbl_ubicaciones_detalle.idubicacion 
                                group by tbl_ubicaciones_detalle.idubicacion";
                                $sql = Conexion::conectar()->prepare($query01);
                                $sql->execute();			
                                return $sql->fetchAll();
                              };
                              $data0120 = ubicacion_con_hombres_autorizados();
                              foreach($data0120 as $value) {
                            ?>
                                <option codigo="<?php echo $value['codigo_ubicacion']?>" value="<?php echo $value['codigo_ubicacion'].'-'.$value['nombre_ubicacion'] ?>">
                                  <?php echo $value['codigo_ubicacion'].'-'.$value['nombre_ubicacion'] ?>
                                </option>  
                            <?php
                                }
                              ?>
                    </select>
                  </div>

 

                  <div class="form-group col-md-3">
                    <label>Inactivos</label>
                    <select  id="inactivos_situacion" class="form-control">
                        <option value="">Inactivos</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div>

                  <div class="col-md-12"></div>
                  <!-- ******************** -->

                  <div class="form-group col-md-3">
                    <label>Nuevo Servicio</label>
                    <select  id="nuevo_servicio_situacion" class="form-control">
                        <option value="">Nuevo Servicio</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div>

                  <div class="form-group col-md-3 vacante_situacion">
                    <label>Vacante</label>
                    <select class="form-control vacante_a_cubrir" name="" id="vacante_situacion">
                                <option value="">Seleccione la opcion</option>
                    </select>

                  </div>

                  <div class="form-group col-md-3 pocision_situacion">
                    <label>Pocisión</label>
                    <input type="text" class="form-control" id="posicion_situacion">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Activo</label>
                    <select  id="activo_situacion" class="form-control">
                        <option value="">Activo</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div>


                <!-- ******************** -->

                  <div class="form-group col-md-3">
                    <label>Fin Servicio</label>
                    <select  id="fin_servicio_situacion" class="form-control">
                        <option value="">Fin Servicio</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div> 


                  <div class="form-group col-md-3 cubrir_situacion">
                    <label>Cubrir a</label>
                    <select  id="cubrir_situacion" class="form-control mi-selector">
                        <option value="" id="cubrir">Cubrir a</option>
                        <?php
                        function obtenerempleado_cubrir() {
                          /* $query01 = "SELECT*FROM tbl_empleados AS empleado
                          INNER JOIN
                          cargos_desempenados AS cargos
                          ON empleado.nivel_cargo = cargos.id and cargos.descripcion='Agente de seguridad'"; */
                          $query01 = "SELECT*FROM tbl_empleados ";
                           $sql = Conexion::conectar()->prepare($query01);
                           $sql->execute();			
                           return $sql->fetchAll();
                        };
                        $data0120 = obtenerempleado_cubrir();
                        foreach($data0120 as $value) {
                          echo "<option value='".$value["codigo_empleado"]."-".$value["primer_nombre"]." ".$value["primer_apellido"]."'>".$value["codigo_empleado"]."-".$value["primer_nombre"]." ".$value["primer_apellido"]." </option>";
                        }
                        ?>
                    </select>
                  </div>

                  <div class="form-group col-md-3 ingreso_hora">
                    <label>Horas Inicio</label>
                    <input type="text" class="form-control tiempo" id="hora_inicio_situacion" value="0:00">
                  </div>

                  <div class="form-group col-md-3 ingreso_hora">
                    <label>Horas Fin</label>
                    <input type="text" class="form-control tiempo" id="hora_fin_situacion" value="0:00">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Liquidación</label>
                    <select  id="liquidado_situacion" class="form-control" disabled>
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                  </div> 

                  <div class="form-group col-md-3">
                    <label>Número Planilla Administrativa</label>
                   <input type="text" name="numero_planilla_admin" id="numero_planilla_admin" readonly class="form-control">
                  </div> 

                  <div class="form-group col-md-3">
                    <label>Horas no cubiertas</label>
                    <input type="text" class="form-control" id="horas_no_cubiertas">
                  </div>

                  <div class="form-group col-md-3 solicitado_situacion">
                    <label>Solicitado Por</label>
                    <input type="text" class="form-control" id="solicitado_situacion">
                  </div>


                  <div class="form-group col-md-3 cobrar_cliente">
                    <label>Cliente</label>
                    <select  id="codigocliente_situacion" class="form-control mi-selector">
                        <option value="" id="codigocliente">Cliente</option>
                        <?php
                        function obtenercliente_cobrar() {
                          $query01 = "SELECT*FROM clientes";
                           $sql = Conexion::conectar()->prepare($query01);
                           $sql->execute();			
                           return $sql->fetchAll();
                        };
                        $data0120 = obtenercliente_cobrar();
                        foreach($data0120 as $value) {
                          echo "<option  nombrecliente_situacion='".$value["nombre"]."' idcliente_situacion='".$value["id"]."' value='".$value["codigo"]."'>".$value["codigo"]."-".$value["nombre"]." </option>";
                        }
                        ?>
                    </select>
                    <!-- maestros -->
                    <input type="hidden" class="descontar_tipohora" value="">
                    <input type="hidden" class="nombrecliente_situacion" value="">
                    <input type="hidden" class="nombrecliente_situacion" value="">

                  </div>

              </div>

            <!-- ****************** -->

         
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardar_movimiento">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>




    </div>

  </div>

</div>

<script src="vistas/js/situacion.js"></script>

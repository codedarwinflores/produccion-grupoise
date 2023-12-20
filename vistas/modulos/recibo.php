<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Recibo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_recibo;
  $query = "SHOW COLUMNS FROM $nombretabla_recibo";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarrecibo">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha Descuento</th>
            <th>Empleado</th>
            <th>Descuento</th>
            <th>Número Recibo</th>
            <th>Valor</th>
            <th>Fecha Recibo</th>
            <th>Hora Recibo</th>
            <th>Número Planilla</th>
            <th>Liquidado</th>
            <th>Anular</th>
            <th>Usuario Encargado</th>
            <th>Observación</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorrecibo::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha_descuento_recibo"].'</td>
                   <td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["numero_recibo"].'</td>
                   <td>'.$value["valor_recibo"].'</td>
                   <td>'.$value["fecha_hecho_recibo"].'</td>
                   <td>'.$value["hora_hecho_recibo"].'</td>
                   <td>'.$value["numero_planilla_liquidado"].'</td>
                   <td>'.$value["liquidado_recibo"].'</td>
                   <td>'.$value["anular_recibo"].'</td>
                   <td>'.$value["nombre"].'</td>
                   <td>'.$value["observacion_recibo"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarrecibo" idrecibo="'.$value["idrecibo"].'" data-toggle="modal" data-target="#modalEditarrecibo"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarrecibo" numero_recibo="'.$value["numero_recibo"].'" idrecibo="'.$value["idrecibo"].'"  liquidado="'.$value["liquidado_recibo"].'"><i class="fa fa-times"></i></button>
 
                     </div>  
 
                   </td>
 
                 </tr>';
         }
 
 
         ?> 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarrecibo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

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

            <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
           

            <div class="form-group   gruporecibo_fecha_descuento_recibo" bis_skin_checked="1">
              <label for="" class="">Fecha Descuento</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha_descuento_recibo"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_descuento_recibo calendario" name="nuevofecha_descuento_recibo" id="nuevofecha_descuento_recibo" placeholder="" value="" autocomplete="off" required="" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" readonly>
              </div>
            </div>

            <div class="form-group   gruporecibo_empleado_recibo" bis_skin_checked="1">
              <label for="" class="">Empleado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_empleado_recibo"></i></span> 

                <select class="form-control input-lg input_empleado_recibo mi-selector" name="nuevoempleado_recibo" id="nuevoempleado_recibo" placeholder="" value="" autocomplete="off" required="">
                  <option value="">Seleccione Empleado</option>
                  <?php
                  function empleado()
                  {
                        $query01 = "SELECT * FROM tbl_empleados";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data03 = empleado();
                  foreach ($data03 as $value) {
                  ?>
                    <option value="<?php echo $value["id"]?>" codigo_empleado="<?php echo $value["codigo_empleado"]?>"><?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]?></option>
                  <?php
                   }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group   gruporecibo_descuento_recibo" bis_skin_checked="1">
              <label for="" class="">Descuento</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_descuento_recibo"></i></span> 
                
                <select class="form-control input-lg input_descuento_recibo mi-selector" name="nuevodescuento_recibo" id="nuevodescuento_recibo" placeholder="" value="" autocomplete="off" required="">
                  <option value="">Seleccionar Opción</option>
                  <?php
                  function descuentos()
                  {
                        $query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE tipo='-Resta'";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data04 = descuentos();
                  foreach ($data04 as $value) {
                  ?>
                    <option value="<?php echo $value["id"]?>" codigo="<?php echo $value["codigo"]?>"><?php echo $value["descripcion"]?></option>
                  <?php
                   }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group   gruporecibo_numero_recibo" bis_skin_checked="1">
              <label for="" class="">Número Recibo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_numero_recibo"></i></span> 
                <input type="text" class="form-control input-lg input_numero_recibo" name="nuevonumero_recibo" id="nuevonumero_recibo" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>
            <!-- ************************** -->
            <div class="divoculto" style="display: none;">
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <label for="">Equipo</label>
                  <!-- *************** -->
                  <select class="form-control mi-selector kardex_detalle" name="kardex_detalle" id="kardex_detalle">
                        <option value="">Seleccione Equipo</option>
                        <?php
                        function equipo()
                        {
                              $query01 = "SELECT  kardex.*,tbl_otros_equipos.*
                              FROM kardex,tbl_otros_equipos
                              where kardex.equipo_kardex=tbl_otros_equipos.codigo_equipo and equipo_kardex like '%UNI%'";
                              $sql = Conexion::conectar()->prepare($query01);
                              $sql->execute();
                              return $sql->fetchAll();
                        }
                        $data06 = equipo();
                        foreach ($data06 as $value) {
                        ?>
                          <option precio="<?php echo $value["precio_kardex"]?>" cantidad="<?php echo $value["cantidad_kardex"]?>" value="<?php echo $value["codigo_equipo"]?>" descripcion="<?php echo $value["descripcion"]?>"><?php echo $value["descripcion"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                  <!-- *************** -->
                </div>
                <div class="col-md-3">
                  
                  <label for="">Cantidad:</label>
                  <input type="number" class="form-control cantidad_detalle" id="cantidad_detalle" value="0" oninput="validateNumber(this);">
                  <input type="hidden" class="comparar">
                  <p class="advertencia" style="color: red;"></p>
                </div>
                <div class="col-md-3">
                  <label for="">Precio:</label>
                    <input type="text" class="form-control precio_detalle" id="precio_detalle" readonly> 
                </div>
                <div class="col-md-3">
                  <label for="">Total:</label>
                    <input type="text" class="form-control total_detalle" id="total_detalle" readonly> 
                </div>
                <div class="col-md-12">
                  <div class="btn btn-primary añadirtable">
                    Añadir
                  </div>
                </div>

                <div class="col-md-12">
                  <table class="table table-bordered table-striped dt-responsive productos" width="100%">
                  <thead>
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>
                    </tr> 
                  </thead>
                  <tbody class="añadirequipo" id="añadirequipo">
                  </tbody>
                </table>
                </div>
              </div>
              <hr>
            </div>
            <!-- ************************** -->


            <div class="form-group   gruporecibo_valor_recibo" bis_skin_checked="1">
              <label for="" class="">Valor</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_valor_recibo"></i></span> 
                <input type="text" class="form-control input-lg input_valor_recibo" name="nuevovalor_recibo" id="nuevovalor_recibo" placeholder="" value="" autocomplete="off" required="">

                <input type="text" class="validar_datos" required="" style="visibility: hidden;">

              </div>
            </div>

            <div class="form-group   gruporecibo_observacion_recibo" bis_skin_checked="1">
              <label for="" class="">Observación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_observacion_recibo"></i></span> 
                <input type="text" class="form-control input-lg input_observacion_recibo" name="nuevoobservacion_recibo" id="nuevoobservacion_recibo" placeholder="" value="" autocomplete="off" >
              </div>
            </div>

        
            <input type="hidden" class="form-control input-lg input_fecha_hecho_recibo" name="nuevofecha_hecho_recibo" id="nuevofecha_hecho_recibo" placeholder="" value="" autocomplete="off" >
            

            <input type="hidden" class="form-control input-lg input_hora_hecho_recibo" name="nuevohora_hecho_recibo" id="nuevohora_hecho_recibo" placeholder="" value="" autocomplete="off">
              
           <input type="hidden" class="form-control input-lg input_numero_planilla_liquidado" name="nuevonumero_planilla_liquidado" id="nuevonumero_planilla_liquidado" placeholder="" value="" autocomplete="off" >
            

            <div class="form-group   gruporecibo_liquidado_recibo" bis_skin_checked="1" style="visibility: hidden; height:0px;">
              <label for="" class="">Liquidado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_liquidado_recibo"></i></span> 
                <select class="form-control input-lg input_liquidado_recibo" name="nuevoliquidado_recibo" id="nuevoliquidado_recibo" placeholder="" value="" autocomplete="off">
                  <option value="No">No</option>
                  <option value="">Seleccione la Opción</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="form-group   gruporecibo_anular_recibo" bis_skin_checked="1" style="visibility: hidden; height:0px;">
              <label for="" class="">Anular</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_anular_recibo"></i></span> 
                <select class="form-control input-lg input_anular_recibo" name="nuevoanular_recibo" id="nuevoanular_recibo" placeholder="" value="" autocomplete="off">
                  <option value="No">No</option>
                  <option value="">Seleccione la Opción</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>

              </div>
            </div>

            
            <input type="hidden" class="form-control input-lg input_user_recibo" name="nuevouser_recibo" id="nuevouser_recibo" placeholder="" value=" <?php echo $_SESSION["id"];?>" autocomplete="off" required="">
             
            <input type="hidden" name="empleados_modulo" class="empleados_modulo" value="">


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardar_datos">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladorrecibo();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarrecibo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

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

          <!-- *********** -->

                        

              <div class="box-body">

              <!-- ENTRADA PARA CAMPOS  -->

              <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">


              <div class="form-group   gruporecibo_fecha_descuento_recibo" bis_skin_checked="1">
                <label for="" class="">Fecha Descuento</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_fecha_descuento_recibo"></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_descuento_recibo calendario" name="editarfecha_descuento_recibo" id="editarfecha_descuento_recibo" placeholder="" value="" autocomplete="off" required="" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" readonly>
                </div>
              </div>

              <div class="form-group   gruporecibo_empleado_recibo" bis_skin_checked="1">
                <label for="" class="">Empleado</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_empleado_recibo"></i></span> 

                  <select class="form-control input-lg input_empleado_recibo mi-selector" name="editarempleado_recibo" id="editarempleado_recibo" placeholder="" value="" autocomplete="off" required="">
                    <option value="">Seleccione Empleado</option>
                    <?php
                    $data03 = empleado();
                    foreach ($data03 as $value) {
                    ?>
                      <option value="<?php echo $value["id"]?>" codigo_empleado="<?php echo $value["codigo_empleado"]?>"><?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group   gruporecibo_descuento_recibo" bis_skin_checked="1">
                <label for="" class="">Descuento</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_descuento_recibo"></i></span> 
                  
                  <select class="form-control input-lg input_descuento_recibo mi-selector" name="editardescuento_recibo" id="editardescuento_recibo" placeholder="" value="" autocomplete="off" required="">
                    <option value="">Seleccionar Opción</option>
                    <?php
                    $data04 = descuentos();
                    foreach ($data04 as $value) {
                    ?>
                      <option value="<?php echo $value["id"]?>" codigo="<?php echo $value["codigo"]?>"><?php echo $value["descripcion"]?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group   gruporecibo_numero_recibo" bis_skin_checked="1">
                <label for="" class="">Número Recibo</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_numero_recibo"></i></span> 
                  <input type="text" class="form-control input-lg input_numero_recibo" name="editarnumero_recibo" id="editarnumero_recibo" placeholder="" value="" autocomplete="off" required="" readonly>
                </div>
              </div>

              <!-- ************************** -->
              <div class="divoculto" style="display: none;">
                <hr>
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Equipo</label>
                    <!-- *************** -->
                    <select class="form-control mi-selector kardex_detalle2 kardex_detalle" name="kardex_detalle" id="kardex_detalle">
                          <option value="">Seleccione Equipo</option>
                          <?php
                          $data06 = equipo();
                          foreach ($data06 as $value) {
                          ?>
                            <option precio="<?php echo $value["precio_kardex"]?>" cantidad="<?php echo $value["cantidad_kardex"]?>" value="<?php echo $value["codigo_equipo"]?>" descripcion="<?php echo $value["descripcion"]?>"><?php echo $value["descripcion"] ?></option>
                          <?php
                          }
                          ?>
                      </select>
                    <!-- *************** -->
                  </div>
                  <div class="col-md-3">
                    <label for="">Cantidad:</label>
                    <input type="number" class="form-control cantidad_detalle2 cantidad_detalle" id="cantidad_detalle" value="0" oninput="validateNumber(this);">
                    <input type="hidden" class="comparar">
                    <p class="advertencia" style="color: red;"></p>

                  </div>
                  <div class="col-md-3">
                    <label for="">Precio:</label>
                      <input type="text" class="form-control precio_detalle" id="precio_detalle" readonly> 
                  </div>
                  <div class="col-md-3">
                    <label for="">Total:</label>
                      <input type="text" class="form-control total_detalle" id="total_detalle" readonly> 
                  </div>
                  <div class="col-md-12">
                    <div class="btn btn-primary añadirtable">
                      Añadir
                    </div>
                  </div>

                  <div class="col-md-12">
                    <table class="table table-bordered table-striped dt-responsive productos" width="100%">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                      </tr> 
                    </thead>
                    <tbody class="añadirequipo" id="añadirequipo2">
                    </tbody>
                  </table>
                  </div>
                </div>
                <hr>
              </div>
              <!-- ************************** -->


              <div class="form-group   gruporecibo_valor_recibo" bis_skin_checked="1">
                <label for="" class="">Valor</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_valor_recibo"></i></span> 
                  <input type="text" class="form-control input-lg input_valor_recibo" name="editarvalor_recibo" id="editarvalor_recibo" placeholder="" value="" autocomplete="off" required="">

                  <input type="text" class="validar_datos" required="" style="visibility: hidden;">
                  
                </div>
              </div>

              <div class="form-group   gruporecibo_observacion_recibo" bis_skin_checked="1">
                <label for="" class="">Observación</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_observacion_recibo"></i></span> 
                  <input type="text" class="form-control input-lg input_observacion_recibo" name="editarobservacion_recibo" id="editarobservacion_recibo" placeholder="" value="" autocomplete="off" >
                </div>
              </div>


              <input type="hidden" class="form-control input-lg input_fecha_hecho_recibo" name="editarfecha_hecho_recibo" id="editarfecha_hecho_recibo" placeholder="" value="" autocomplete="off" >


              <input type="hidden" class="form-control input-lg input_hora_hecho_recibo" name="editarhora_hecho_recibo" id="editarhora_hecho_recibo" placeholder="" value="" autocomplete="off">
                
              <input type="hidden" class="form-control input-lg input_numero_planilla_liquidado" name="editarnumero_planilla_liquidado" id="editarnumero_planilla_liquidado" placeholder="" value="" autocomplete="off" >


              <div class="form-group   gruporecibo_liquidado_recibo" bis_skin_checked="1">
                <label for="" class="">Liquidado</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_liquidado_recibo"></i></span> 
                  <select class="form-control input-lg input_liquidado_recibo" name="editarliquidado_recibo" id="editarliquidado_recibo" placeholder="" value="" autocomplete="off">
                    <option value="">Seleccione la Opción</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>
              </div>

              <div class="form-group   gruporecibo_anular_recibo" bis_skin_checked="1">
                <label for="" class="">Anular</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_anular_recibo"></i></span> 
                  <select class="form-control input-lg input_anular_recibo" name="editaranular_recibo" id="editaranular_recibo" placeholder="" value="" autocomplete="off">
                    <option value="">Seleccione la Opción</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>

                </div>
              </div>


              <input type="hidden" class="form-control input-lg input_user_recibo" name="editaruser_recibo" id="editaruser_recibo" placeholder="" value=" <?php echo $_SESSION["id"];?>" autocomplete="off" required="">
              

              </div>
          <!-- *********** -->

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardarmodificacion_recibo">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladorrecibo();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorrecibo();
  $borrar -> ctrBorrar();

?> 



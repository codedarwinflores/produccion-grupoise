<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Uniforme Descuento";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_uniformedescuento;
  $query = "SHOW COLUMNS FROM $nombretabla_uniformedescuento";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
      <div class="row">
          <div class="col-md-6">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaruniformedescuento">
                
                Agregar <?php echo $Nombre_del_Modulo;?>

              </button>
          </div>
          <div class="col-md-6" align="right">
              <a href="empleados" class="btn btn-danger">Volver</a>
          </div>
        </div>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            
            <th>Fecha Descuento</th>
            <th>Código Empleado</th>
            <th>Nombre Empleado</th>
            <th>Código Descuento</th>
            <th>Descuento</th>
            <th>Número Recibo</th>
            <th>Valor</th>
            <th>Observación</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody id="uniformedescuento">
 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregaruniformedescuento" class="modal fade" role="dialog">
  
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

        <div class="box-body" bis_skin_checked="1">

            <!-- ENTRADA PARA CAMPOS  -->

            <div class="form-group id  grupouniformedescuento_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" id="" name="nuevoid" placeholder="" value="" autocomplete="off">

              </div>

            </div>


              <div class="form-group fecha_descuento  grupouniformedescuento_fecha_descuento" bis_skin_checked="1">
                <label for="" class="label_fecha_descuento">Ingresar Fecha Descuento</label> 
              
                <div class="input-group" bis_skin_checked="1">
              
                  <span class="input-group-addon"><i class="icono_fecha_descuento"></i></span> 
                  <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
                  <input type="text" class="form-control input-lg input_fecha_descuento calendario" name="nuevofecha_descuento" id="" placeholder="Ingresar Fecha Descuento" value="" autocomplete="off" required="">

                </div>
            </div>


            <div class="form-group codigo_empleado_descuento  grupouniformedescuento_codigo_empleado_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_empleado_descuento">Código Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_empleado_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_codigo_empleado_descuento bloqueado" name="nuevocodigo_empleado_descuento" id="" placeholder="Código Empleado" value="" autocomplete="off" required="">

              </div>

            </div>

            
            <div class="form-group codigo_empleado_descuento  grupouniformedescuento_codigo_empleado_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_empleado_descuento">Nombre Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_empleado_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_empleado_descuento bloqueado" name="" id="" placeholder="Código Empleado" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group codigo_uni_descuento  grupouniformedescuento_codigo_uni_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_uni_descuento">Código Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_uni_descuento"></i></span> 

                <select class="form-control input-lg input_codigo_uni_descuento bloqueado" name="nuevocodigo_uni_descuento" id="" required>
                  <option value="">Seleccione Código Descuento</option>
                <?php
                    $datos_mostrar = ControladorDescuentos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo'] ?>" des1="<?php echo $value['descripcion'] ?>"><?php echo $value["codigo"] ?></option>  
                <?php
                    }
                  ?>
                </select>



              </div>

            </div>

            
            <div class="form-group codigo_uni_descuento  grupouniformedescuento_codigo_uni_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_uni_descuento">Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_uni_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_descuento bloqueado" name="" id="" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group numero_recibo_descuento  grupouniformedescuento_numero_recibo_descuento" bis_skin_checked="1">
              <label for="" class="label_numero_recibo_descuento">Número Recibo</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_numero_recibo_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_numero_recibo_descuento bloqueado" name="nuevonumero_recibo_descuento" id="" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group valor_descuento  grupouniformedescuento_valor_descuento" bis_skin_checked="1">
              <label for="" class="label_valor_descuento">Ingrese Valor Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_valor_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_valor_descuento" id="" name="nuevovalor_descuento" placeholder="Ingrese Valor Descuento"  value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group observacion_descuento  grupouniformedescuento_observacion_descuento" bis_skin_checked="1">
              <label for="" class="label_observacion_descuento">Ingresar Observación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_observacion_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_observacion_descuento" name="nuevoobservacion_descuento" id="" placeholder="Ingresar Observación" value="" autocomplete="off" required="">

              </div>

            </div>


           

          </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladoruniformedescuento();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditaruniformedescuento" class="modal fade" role="dialog">
  
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

          <div class="box-body">

          <!-- -- entrada id -- -->

<!--           <input type="hidden" name="id" id="editarid">
 -->

 
            <!-- ENTRADA PARA CAMPOS  -->


            



            <div class="form-group id  grupouniformedescuento_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" id="editarid" name="editarid" placeholder="" value="" autocomplete="off">

              </div>

            </div>


              <div class="form-group fecha_descuento  grupouniformedescuento_fecha_descuento" bis_skin_checked="1">
                <label for="" class="label_fecha_descuento">Ingresar Fecha Descuento</label> 
              
                <div class="input-group" bis_skin_checked="1">
              
                  <span class="input-group-addon"><i class="icono_fecha_descuento"></i></span> 
                  <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
                  <input type="text" class="form-control input-lg input_fecha_descuento calendario" name="editarfecha_descuento" id="editarfecha_descuento" placeholder="Ingresar Fecha Descuento" value="" autocomplete="off" required="">

                </div>
            </div>


            <div class="form-group codigo_empleado_descuento  grupouniformedescuento_codigo_empleado_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_empleado_descuento">Código Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_empleado_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_codigo_empleado_descuento bloqueado" name="editarcodigo_empleado_descuento" id="editarcodigo_empleado_descuento" placeholder="Código Empleado" value="" autocomplete="off" required="">

              </div>

            </div>

            
            <div class="form-group codigo_empleado_descuento  grupouniformedescuento_codigo_empleado_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_empleado_descuento">Nombre Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_empleado_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_empleado_descuento bloqueado" name="" id="nombreempleado" placeholder="Código Empleado" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group codigo_uni_descuento  grupouniformedescuento_codigo_uni_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_uni_descuento">Código Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_uni_descuento"></i></span> 

                <select class="form-control input-lg input_codigo_uni_descuento bloqueado" name="editarcodigo_uni_descuento" id="editarcodigo_uni_descuento" required>
                  <option value="">Seleccione Código Descuento</option>
                <?php
                    $datos_mostrar = ControladorDescuentos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo'] ?>" des1="<?php echo $value['descripcion'] ?>"><?php echo $value["codigo"] ?></option>  
                <?php
                    }
                  ?>
                </select>



              </div>

            </div>

            
            <div class="form-group codigo_uni_descuento  grupouniformedescuento_codigo_uni_descuento" bis_skin_checked="1">
              <label for="" class="label_codigo_uni_descuento">Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_codigo_uni_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_descuento bloqueado" name="" id="descuento" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group numero_recibo_descuento  grupouniformedescuento_numero_recibo_descuento" bis_skin_checked="1">
              <label for="" class="label_numero_recibo_descuento">Número Recibo</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_numero_recibo_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_numero_recibo_descuento bloqueado" name="editarnumero_recibo_descuento" id="editarnumero_recibo_descuento" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group valor_descuento  grupouniformedescuento_valor_descuento" bis_skin_checked="1">
              <label for="" class="label_valor_descuento">Ingrese Valor Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_valor_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_valor_descuento" id="editarvalor_descuento" name="editarvalor_descuento" placeholder="Ingrese Valor Descuento"  value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group observacion_descuento  grupouniformedescuento_observacion_descuento" bis_skin_checked="1">
              <label for="" class="label_observacion_descuento">Ingresar Observación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_observacion_descuento"></i></span> 

                <input type="text" class="form-control input-lg input_observacion_descuento" name="editarobservacion_descuento" id="editarobservacion_descuento" placeholder="Ingresar Observación" value="" autocomplete="off" required="">

              </div>

            </div>





          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladoruniformedescuento();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladoruniformedescuento();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/uniformedescuento.js"></script>

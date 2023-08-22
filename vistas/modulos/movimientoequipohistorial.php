<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Movimiento Equipo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_movimientosequipos;
  $query = "SHOW COLUMNS FROM $nombretabla_movimientosequipos";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
$id= $results['cod'];



?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a class="btn btn-danger" href="movimientoequipo">Volver</a>
       
      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Fecha Ingreso</th>
            <th>Fecha Movimiento</th>
            <th>Correlativo</th>
            <th>Equipo</th>
            <th>Ubicación Actual</th>

          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 

         function ubicacion_mostrar($idubicacion1)
         {
           $query01="SELECT *from tbl_clientes_ubicaciones where id='$idubicacion1'";
           $sql = Conexion::conectar()->prepare($query01);
           $sql->execute();
           return $sql->fetchAll();
         };
         function armas_mostrar($codigo1)
         {
               $query01 = "SELECT * FROM tbl_armas where codigo='$codigo1'";
               $sql = Conexion::conectar()->prepare($query01);
               $sql->execute();
               return $sql->fetchAll();
         }
         function radios_mostrar($codigo1)
         {
               $query01 = "SELECT * FROM tbl_radios where codigo_radio='$codigo1'";
               $sql = Conexion::conectar()->prepare($query01);
               $sql->execute();
               return $sql->fetchAll();
         }

         function bicicleta_mostrar($codigo1)
                    {
                          $query01 = "SELECT * FROM tbl_bicicleta where codigo_bicicleta='$codigo1'";
                          $sql = Conexion::conectar()->prepare($query01);
                          $sql->execute();
                          return $sql->fetchAll();
                    }

        function celular_mostrar($codigo1)
          {
                $query01 = "SELECT * FROM celular where codigo='$codigo1'";
                $sql = Conexion::conectar()->prepare($query01);
                $sql->execute();
                return $sql->fetchAll();
          }
      

          
        function historialmovimiento($codigo1)
        {
              $query01 = "SELECT * FROM historialmovimientosequipos where codigo_equipo_his='$codigo1'";
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
        $data_historialmovimiento = historialmovimiento($id);
 
        foreach ($data_historialmovimiento as $value) {


          
           echo ' <tr>
                   <td>'.$value["fecha_ingreso_movimiento_his"].'</td>
                   <td>'.$value["fecha_movimiento_his"].'</td>';
            echo '<td>'.$value["correlativo_movimiento_his"].'</td>';
       
             /* ---------arma------------- */
             $data_arma = armas_mostrar($value["codigo_equipo_his"]);
             foreach ($data_arma as $value_arma) {
              echo '<td>'.$value_arma["descripcion_arma"].'</td>';
             }
             /* ---------------------- */
             /* ---------radio------------- */
             $data_radio = radios_mostrar($value["codigo_equipo_his"]);
             foreach ($data_radio as $value_radio) {
              echo '<td>'.$value_radio["descripcion_radio"].'</td>';
             }
             /* ---------------------- */
            /* ---------celular------------- */
              $data_cel = celular_mostrar($value["codigo_equipo_his"]);
              foreach ($data_cel as $value_cel) {
               echo '<td>'.$value_cel["descripcion"].'</td>';
              }
            /* ---------------------- */
             /* ---------bicicleta------------- */
             $data_bis = bicicleta_mostrar($value["codigo_equipo_his"]);
             foreach ($data_bis as $value_bis) {
              echo '<td>'.$value_bis["descripcion_bicicleta"].'</td>';
             }
           /* ---------------------- */

            /* ---------ubicacion------------- */
            $data_ubi = ubicacion_mostrar($value["id_ubicacion_movimiento_his"]);
            foreach ($data_ubi as $value_ubi) {
              echo '<td>'.$value_ubi["nombre_ubicacion"].'</td>';
            }
            /* ---------------------- */
            echo '</tr>';
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

<div id="modalAgregarmovimientosequipos" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70%;">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Administrar  <?php echo $Nombre_del_Modulo;?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->


            <!-- ******************************************* -->
                <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
           

            <div class="form-group  col-md-4 grupomovimientosequipos_correlativo_movimiento" bis_skin_checked="1">
              <label for="" class="">Correlativo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_correlativo_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_correlativo_movimiento" name="nuevocorrelativo_movimiento" id="nuevocorrelativo_movimiento" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>

            <div class="form-group col-md-4  grupomovimientosequipos_fecha_ingreso_movimiento" bis_skin_checked="1">
              <label for="" class=""> Fecha Ingreso</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha_ingreso_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_ingreso_movimiento calendario " name="nuevofecha_ingreso_movimiento" id="nuevofecha_ingreso_movimiento" placeholder="" value="" autocomplete="off" required="" readonly data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY">
              </div>
            </div>

            <div class="form-group col-md-4  grupomovimientosequipos_fecha_movimiento" bis_skin_checked="1">
              <label for="" class="">Fecha Movimiento</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_movimiento calendario" name="nuevofecha_movimiento" id="nuevofecha_movimiento" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>

            <div class="form-group col-md-6   grupomovimientosequipos_id_transaccion_movimiento" bis_skin_checked="1">
              <label for="" class="">Transacción</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_id_transaccion_movimiento"></i></span> 
                <select class="form-control input-lg input_id_transaccion_movimiento mi-selector" name="nuevoid_transaccion_movimiento" id="nuevoid_transaccion_movimiento" placeholder="" value="" autocomplete="off" required="" >
                  <option value="">Seleccione Transacción</option>
                  <?php
                  function transaccion()
                  {
                        $query01 = "SELECT * FROM tbl_transacciones_equipo";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data03 = transaccion();
                  foreach ($data03 as $value) {
                  ?>
                    <option value="<?php echo $value["id"]?>" tipo_transaccion_equipo="<?php echo $value["tipo_transaccion_equipo"]?>"  codigo="<?php echo $value["codigo"]?>"><?php echo $value["nombre"] ?></option>
                  <?php
                   }
                  ?>
                </select>


              </div>
            </div>


            <div class="form-group col-md-6  grupomovimientosequipos_id_ubicacion_movimiento" bis_skin_checked="1">
              <label for="" class="">Ubicación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_id_ubicacion_movimiento"></i></span> 
                <select  class="form-control input-lg input_id_ubicacion_movimiento mi-selector" name="nuevoid_ubicacion_movimiento" id="nuevoid_ubicacion_movimiento" placeholder="" value="" autocomplete="off" required="">
                  <option value="">Seleccione Ubicación</option>
                  <?php
                  function ubicacion()
                  {
                        $query01 = "SELECT * FROM tbl_clientes_ubicaciones";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data05 = ubicacion();
                  foreach ($data05 as $value) {
                  ?>
                  <option value="<?php echo $value["id"]?>" cantidad_radios="<?php echo $value["cantidad_radios"]?>" cantidad_armas="<?php echo $value["cantidad_armas"]?>"><?php echo $value["nombre_ubicacion"] ?></option>
                  <?php
                   }
                  ?>
                </select>


              </div>
            </div>

            <div class="form-group col-md-3   grupomovimientosequipos_armas_asig_movimiento" bis_skin_checked="1">
              <label for="" class="">Armas Asig.</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_armas_asig_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_armas_asig_movimiento" name="nuevoarmas_asig_movimiento" id="nuevoarmas_asig_movimiento" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>


            <div class="form-group  col-md-3 grupomovimientosequipos_diferencia_armas_movimiento" bis_skin_checked="1">
              <label for="" class="">Diferencia Arma</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_diferencia_armas_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_diferencia_armas_movimiento" name="nuevodiferencia_armas_movimiento" id="nuevodiferencia_armas_movimiento" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>


            <div class="form-group col-md-3  grupomovimientosequipos_radios_asign_movimiento" bis_skin_checked="1">
              <label for="" class="">Radios Asig.</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_radios_asign_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_radios_asign_movimiento" name="nuevoradios_asign_movimiento" id="nuevoradios_asign_movimiento" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>

            <div class="form-group  col-md-3 grupomovimientosequipos_diferencia_radios_movimiento" bis_skin_checked="1">
              <label for="" class="">Diferencia Radios</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_diferencia_radios_movimiento"></i></span> 
                <input type="text" class="form-control input-lg input_diferencia_radios_movimiento" name="nuevodiferencia_radios_movimiento" id="nuevodiferencia_radios_movimiento" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>

            <div class="form-group   grupomovimientosequipos_codigo_equipo" bis_skin_checked="1">
              <label for="" class=""></label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_codigo_equipo fa fa-qrcode"></i></span> 
                <select  class="form-control input-lg input_codigo_equipo mi-selector" name="nuevocodigo_equipo" id="nuevocodigo_equipo" placeholder="Ingresar Código" value="" autocomplete="off" required="">
                  <option value="">Seleccione Equipos</option>
                  <?php
                  function armas()
                  {
                        $query01 = "SELECT * FROM tbl_armas";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data05 = armas();
                  foreach ($data05 as $value) {
                  ?>
                    <option value="<?php echo $value["codigo"]?>" precio="<?php echo $value["precio_costo"]?>" tipoequipo="arma" marca="<?php echo $value["marca"]?>" modelo="<?php echo $value["modelo"]?>" serie="<?php echo $value["numero_serie"]?>"><?php echo $value["codigo"]."-".$value["descripcion_arma"]?></option>
                  <?php
                   }
                  ?>
                  <?php
                  function radios()
                  {
                        $query01 = "SELECT * FROM tbl_radios";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data05r = radios();
                  foreach ($data05r as $value) {
                  ?>
                    <option value="<?php echo $value["codigo_radio"]?>" precio="<?php echo $value["costo_radio"]?>" tipoequipo="radio" marca="<?php echo $value["marca"]?>" modelo="<?php echo $value["modelo_radio"]?>" serie="<?php echo $value["numero_serie"]?>"><?php echo $value["codigo_radio"]."-".$value["descripcion_radio"]?></option>
                  <?php
                   }
                  ?>
                  <?php
                  function bicicleta()
                  {
                        $query01 = "SELECT * FROM tbl_bicicleta";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data05b = bicicleta();
                  foreach ($data05b as $value) {
                  ?>
                    <option value="<?php echo $value["codigo_bicicleta"]?>" precio="<?php echo $value["costo_bicicleta"]?>" tipoequipo="bicicleta" marca="<?php echo $value["marca"]?>" modelo="<?php echo $value["modelo_bicicleta"]?>" serie="<?php echo $value["numero_serie"]?>"><?php echo $value["codigo_bicicleta"]."-".$value["descripcion_bicicleta"]?></option>
                  <?php
                   }
                  ?>
                   <?php
                  function celular()
                  {
                        $query01 = "SELECT * FROM celular";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data05b = celular();
                  foreach ($data05b as $value) {
                  ?>
                    <option value="<?php echo $value["codigo"]?>" precio="<?php echo $value["costo"]?>" tipoequipo="celular" marca="<?php echo $value["marca"]?>" modelo="<?php echo $value["modelo"]?>" serie=""><?php echo $value["codigo"]."-".$value["descripcion"]?></option>
                  <?php
                   }
                  ?>
                </select>
              </div>
            </div>

            <!-- *********************************** -->


            <div class="form-group  col-md-4 " bis_skin_checked="1">
              <label for="" class="">Marca</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control marca" readonly>
              </div>
            </div>

            <div class="form-group  col-md-4 " bis_skin_checked="1">
              <label for="" class="">Modelo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control modelo" readonly>
              </div>
            </div>

            <div class="form-group  col-md-4 " bis_skin_checked="1">
              <label for="" class="">Serie</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control serie" readonly>
              </div>
            </div>

            <div class="form-group  col-md-12 " bis_skin_checked="1">
              <label for="" class="">Ubicación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control ubicacion_actual" readonly>
              </div>
            </div>

           <div class="btn btn-primary guardarproducto">Añadir</div>

            <!-- ********************************** -->

            <input type="hidden" class="form-control input-lg input_tipoequipo" name="nuevotipoequipo" id="nuevotipoequipo" placeholder="" value="" autocomplete="off" required="">
             
            <!-- ******************************************* -->

            <!-- ********** -->
            <table class="table table-bordered table-striped dt-responsive productos" width="100%">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Sub Total</th>
                  <th>Tipo</th>
                  <th>Ubicación</th>
                  <th>Acciones</th>
                </tr> 
              </thead>
              <tbody id="añadirequipo">
              </tbody>
            </table>
            <!-- ************ -->
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardardata">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>



    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarmovimientosequipos" class="modal fade" role="dialog">
  
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

            <!-- ENTRADA PARA CAMPOS  -->

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group <?php echo $row['Field'];?> egrupomovimientosequipos_<?php echo $row['Field'];?>">
              <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 
                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
              </div>
            </div>
          <?php
             }
          ?>

          

            <div class="form-group observacion_tarjeta  ">
              <label for="" class="label_observacion_tarjeta">Ingresar Observaciones</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_observacion_tarjeta"></i></span> 
                <input type="text" class="form-control input-lg input_observacion_tarjeta" name="editarobservacion_tarjeta" id="editarobservacion_tarjeta" placeholder="Ingresar Observaciones" value="" autocomplete="off" required="">
              </div>
            </div>
           <!-- <div id="editaroperadordiv">
             <label for="" class="">Seleccione Operador</label> 
            
             <div class="input-group" id="">
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editaroperador" id="editaroperador" class="form-control input-lg" required>
                <option value="">Seleccione Operador</option>
                <option value="Tigo">Tigo</option>
                <option value="Digicel">Digicel</option>
                <option value="Claro">Claro</option>
                <option value="Movistar">Movistar</option>
              </select>
             </div>
           </div> -->

           <?php
                    function operadoreditar() {
                      $query = "select * from ajustes where name_table='tarjetas_movimientosequipos' and accion='editar' and elemento='Seleccione Operador'
                      ";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = operadoreditar();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>


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

          $editar = new Controladormovimientosequipos();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladormovimientosequipos();
  $borrar -> ctrBorrar();

?> 



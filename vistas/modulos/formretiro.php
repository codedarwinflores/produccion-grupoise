<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Retiro";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_retiro;
  $query = "SHOW COLUMNS FROM $nombretabla_retiro";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
       <!--  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarretiro">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button> -->

      </div>

      <div class="box-body">
        
      <form role="form" method="post" enctype="multipart/form-data">


      <div class="form-group  " bis_skin_checked="1">
              <label for="" class="">Motivo de Inactivo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 
                    <select name="nuevomotivo_inactivo" class="form-control mi-selector" id="nuevomotivo_inactivo" >
                      <option value="">Seleccione Motivo</option>
                      <?php                    
                                function transaccion() {
                                  $query = "SELECT * FROM `tbl_transacciones_personal`";
                                  $sql = Conexion::conectar()->prepare($query);
                                  $sql->execute();			
                                  return $sql->fetchAll();
                                };
                              $data = transaccion();
                              foreach($data as $row) {
                                echo "<option value='".$row["codigo"]."'>".$row["nombre"]."</option>";
                              }         
                      ?>
                    </select>                  
              </div>
      </div>


      <!-- ****** -->

          <div class="form-group id  gruporetiro_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" name="nuevoid" placeholder="" value="" autocomplete="off">

              </div>

          </div>

          <div class="form-group nombre_retiro  gruporetiro_nombre_retiro" bis_skin_checked="1">
              <label for="" class="label_nombre_retiro">Nombre Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_nombre_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_nombre_retiro" name="nuevonombre_retiro" placeholder="Nombre Empleado" value="" autocomplete="off"   readonly>

              </div>

          </div>

          <div class="form-group ubicacion_retiro  gruporetiro_ubicacion_retiro" bis_skin_checked="1">
              <label for="" class="label_ubicacion_retiro">Ubicación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_ubicacion_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_ubicacion_retiro" name="nuevoubicacion_retiro" placeholder="Ubicación" value="" autocomplete="off"  >

              </div>

          </div>

          <div class="form-group causa_retiro  gruporetiro_causa_retiro" bis_skin_checked="1">
              <label for="" class="label_causa_retiro">Causa del Retiro</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_causa_retiro"></i></span> 

                <select name="nuevocausa_retiro" id="" class="form-control input-lg input_causa_retiro"  >
                  <option value="">Seleccione Causa de Retiro</option>
                  <option value="Despido">Despido</option>
                  <option value="Renuncia">Renuncia</option>
                </select>

              </div>

          </div>

          <div class="form-group fecha_contratacion_retiro  gruporetiro_fecha_contratacion_retiro" bis_skin_checked="1">
              <label for="" class="label_fecha_contratacion_retiro">Fecha Contratación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha_contratacion_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_fecha_contratacion_retiro" name="nuevofecha_contratacion_retiro" placeholder="Fecha Contratación" value="" autocomplete="off" readonly >

              </div>

          </div>

          <div class="form-group fecha_retiro  gruporetiro_fecha_retiro" bis_skin_checked="1" style="width: 80%;">
              <label for="" class="label_fecha_retiro">Fecha del Retiro</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha_retiro"></i></span> 

                <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
                <input type="text" class="form-control input-lg input_fecha_retiro calendario" name="nuevofecha_retiro" placeholder="Fecha del Retiro" value="" autocomplete="off" readonly id="nuevofecha_retiro">

              </div>

          </div>

          <div class="form-group horas_extras_pentientes_retiro  gruporetiro_horas_extras_pentientes_retiro" bis_skin_checked="1">
              <label for="" class="label_horas_extras_pentientes_retiro">Horas Extras Pendientes</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_horas_extras_pentientes_retiro"></i></span> 

                <input type="number" class="form-control input-lg input_horas_extras_pentientes_retiro" name="nuevohoras_extras_pentientes_retiro" placeholder="Horas Extras Pendientes" value="" autocomplete="off"  >

              </div>

          </div>

          <div class="form-group horas_llegadas_tardes_retiro  gruporetiro_horas_llegadas_tardes_retiro" bis_skin_checked="1">
              <label for="" class="label_horas_llegadas_tardes_retiro">Horas Llegadas Tardes</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_horas_llegadas_tardes_retiro"></i></span> 

                <input type="number" class="form-control input-lg input_horas_llegadas_tardes_retiro" name="nuevohoras_llegadas_tardes_retiro" placeholder="Horas Llegadas Tardes" value="" autocomplete="off"  >

              </div>

          </div>

          <div class="form-group descuento_tarde_retiro  gruporetiro_descuento_tarde_retiro" bis_skin_checked="1">
              <label for="" class="label_descuento_tarde_retiro">Descuentos por Llegadas Tardes</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_descuento_tarde_retiro"></i></span> 

                <input type="number" class="form-control input-lg input_descuento_tarde_retiro" name="nuevodescuento_tarde_retiro" placeholder="Descuentos por Llegadas Tardes" value="" autocomplete="off"  >

              </div>

          </div>

          <div class="form-group observaciones_retiro  gruporetiro_observaciones_retiro" bis_skin_checked="1">
              <label for="" class="label_observaciones_retiro">Observación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_observaciones_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_observaciones_retiro" name="nuevoobservaciones_retiro" placeholder="Observación" value="" autocomplete="off"  >

              </div>

          </div>

          <div class="form-group idempleado_retiro  gruporetiro_idempleado_retiro" bis_skin_checked="1" style="visibility:hidden">
              <label for="" class="label_idempleado_retiro"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_idempleado_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_idempleado_retiro" name="nuevoidempleado_retiro" placeholder="" value="" autocomplete="off"  >

              </div>

          </div>

          <div class="form-group estado_retiro  gruporetiro_estado_retiro" bis_skin_checked="1" style="visibility:hidden">
              <label for="" class="label_estado_retiro"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_estado_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_estado_retiro" name="nuevoestado_retiro" placeholder="" value="Inactivo" autocomplete="off"   >

              </div>

          </div>

          <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo?></button>
          <a href="empleados" class="btn btn-danger">Volver</a>


            <?php

              $crear = new Controladorretiro();
              $crear -> ctrCrear();

            ?>

      <!-- ****** -->
        </form>
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->


<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<script src="vistas/js/formretiro.js"></script>


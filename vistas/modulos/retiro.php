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
  
      <div class="row">
      <div class="col-md-6" align="left">
            <a href="empleados" class="btn btn-danger">Volver</a>
        </div>

        <div class="col-md-6">
          <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarretiro">
            Agregar <?php echo $Nombre_del_Modulo;?>
          </button> -->
        </div>
        

      </div>
        

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Nombre Empleado</th>
            <th>Ubicación</th>
            <th>Causa del Retiro</th>
            <th>Fecha Contratación</th>
            <th>Fecha Retiro</th>
            <th>Hora Extras Pendientes</th>
            <th>Hora Llegadas Tarde</th>
            <th>Descuento Llegada Tarde</th>
            <th>Observación</th>
            <th>Estado</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorretiro::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["nombre_retiro"].'</td>
                   <td>'.$value["ubicacion_retiro"].'</td>
                   <td>'.$value["causa_retiro"].'</td>
                   <td>'.$value["fecha_contratacion_retiro"].'</td>
                   <td>'.$value["fecha_retiro"].'</td>
                   <td>'.$value["horas_extras_pentientes_retiro"].'</td>
                   <td>'.$value["horas_llegadas_tardes_retiro"].'</td>
                   <td>'.$value["descuento_tarde_retiro"].'</td>
                   <td>'.$value["observaciones_retiro"].'</td>
                   <td>'.$value["estado_retiro"].'</td>
                   ';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarretiro" idretiro="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarretiro"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarretiro" idretiro="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarretiro" class="modal fade" role="dialog">
  
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



            <!-- ********************* -->

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

          $crear = new Controladorretiro();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarretiro" class="modal fade" role="dialog">
  
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

            


          <div class="form-group id  gruporetiro_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">

              </div>

          </div>

          <div class="form-group nombre_retiro  gruporetiro_nombre_retiro" bis_skin_checked="1">
              <label for="" class="label_nombre_retiro">Nombre Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_nombre_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_nombre_retiro" name="editarnombre_retiro" id="editarnombre_retiro" placeholder="" value="" autocomplete="off" required="" readonly>

              </div>

          </div>

          <div class="form-group ubicacion_retiro  gruporetiro_ubicacion_retiro" bis_skin_checked="1">
              <label for="" class="label_ubicacion_retiro">Ubicación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_ubicacion_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_ubicacion_retiro" name="editarubicacion_retiro" id="editarubicacion_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>

          <div class="form-group causa_retiro  gruporetiro_causa_retiro" bis_skin_checked="1">
              <label for="" class="label_causa_retiro">Causa del Retiro</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_causa_retiro"></i></span> 

                <select name="editarcausa_retiro" id="editarcausa_retiro" class="form-control input-lg input_causa_retiro" required="">
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

                <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  

                <input type="text" class="form-control input-lg input_fecha_contratacion_retiro calendario" name="editarfecha_contratacion_retiro" id="editarfecha_contratacion_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>

          <div class="form-group fecha_retiro  gruporetiro_fecha_retiro" bis_skin_checked="1" style="width: 80%;">
              <label for="" class="label_fecha_retiro">Fecha del Retiro</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha_retiro"></i></span> 

                <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
                <input type="text" class="form-control input-lg input_fecha_retiro calendario" name="editarfecha_retiro" id="editarfecha_retiro" placeholder="" value="" autocomplete="off" required="required">

              </div>

          </div>

          <div class="form-group horas_extras_pentientes_retiro  gruporetiro_horas_extras_pentientes_retiro" bis_skin_checked="1">
              <label for="" class="label_horas_extras_pentientes_retiro">Horas Extras Pendientes</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_horas_extras_pentientes_retiro"></i></span> 

                <input type="number" class="form-control input-lg input_horas_extras_pentientes_retiro" name="editarhoras_extras_pentientes_retiro" id="editarhoras_extras_pentientes_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>

          <div class="form-group horas_llegadas_tardes_retiro  gruporetiro_horas_llegadas_tardes_retiro" bis_skin_checked="1">
              <label for="" class="label_horas_llegadas_tardes_retiro">Horas Llegadas Tardes</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_horas_llegadas_tardes_retiro"></i></span> 

                <input type="number" class="form-control input-lg input_horas_llegadas_tardes_retiro" name="editarhoras_llegadas_tardes_retiro" id="editarhoras_llegadas_tardes_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>

          <div class="form-group descuento_tarde_retiro  gruporetiro_descuento_tarde_retiro" bis_skin_checked="1">
              <label for="" class="label_descuento_tarde_retiro">Descuentos por Llegadas Tardes</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_descuento_tarde_retiro"></i></span> 

                <input type="number" class="form-control input-lg input_descuento_tarde_retiro" name="editardescuento_tarde_retiro" id="editardescuento_tarde_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>

          <div class="form-group observaciones_retiro  gruporetiro_observaciones_retiro" bis_skin_checked="1">
              <label for="" class="label_observaciones_retiro">Observación</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_observaciones_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_observaciones_retiro" name="editarobservaciones_retiro" id="editarobservaciones_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>


          <div class="form-group estado_retiro  gruporetiro_estado_retiro" bis_skin_checked="1" >
              <label for="" class="label_estado_retiro">Estado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_estado_retiro"></i></span> 

               <!--  <input type="text" placeholder="" value="Inactivo" autocomplete="off" required="" >
 -->
                <select  class="form-control input-lg input_estado_retiro" name="editarestado_retiro" id="editarestado_retiro" required activacion="">
                  <option value="">Seleccione Estado</option>
                  <option value="Inactivo">Inactivo</option>
                  <option value="Activar">Activar</option>

                </select>

              </div>

          </div>


          <div class="form-group idempleado_retiro  gruporetiro_idempleado_retiro" bis_skin_checked="1" style="visibility:hidden">
              <label for="" class="label_idempleado_retiro"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_idempleado_retiro"></i></span> 

                <input type="text" class="form-control input-lg input_idempleado_retiro" name="editaridempleado_retiro" id="editaridempleado_retiro" placeholder="" value="" autocomplete="off" required="">

              </div>

          </div>

      

           
            <!-- ************* -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary  modificar_retiro">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladorretiro();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorretiro();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/activarempleado.js"></script>

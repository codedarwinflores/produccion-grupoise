<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Bitacora";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_bitacora;
  $query = "SHOW COLUMNS FROM $nombretabla_bitacora";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <a href="planillaadmin" class="btn btn-danger">Volver</a>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarbitacora">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha</th>
            <th>Hora</th>
            <th>Usuario</th>
            <th>Planilla</th>
            <th>Estado</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
          function usuario($id)
          {
            $query01 = "SELECT * FROM `usuarios` WHERE id=$id";
            $sql = Conexion::conectar()->prepare($query01);
            $sql->execute();
            return $sql->fetchAll();
          };

         $item = null;
         $valor = null;


 
         $bancos = Controladorbitacora::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){

          $idusuario=$value["idusuario"];

          $data_usuario=usuario($idusuario);
          $nomb_usuario="";
          foreach ($data_usuario as $val_usu) {
            $nomb_usuario=$val_usu["nombre"];
          }
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha"].'</td>
                   <td>'.$value["hora"].'</td>
                   <td>'.$nomb_usuario.'</td>
                   <td>'.$value["num_planilla"].'</td>
                   <td>'.$value["estado_planilla"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarbitacora" idbitacora="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarbitacora"><i class="fa fa-pencil"></i></button>
 
 
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

<div id="modalAgregarbitacora" class="modal fade" role="dialog">
  
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

            <div class="form-group   grupobitacora_fecha" bis_skin_checked="1">
              <label for="" class="">Fecha</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha"></i></span> 
                <input type="text" class="form-control input-lg input_fecha" name="nuevofecha" id="nuevofecha" placeholder="" value="" autocomplete="off" required="" readonly="readonly">
              </div>
            </div>

            <div class="form-group   grupobitacora_hora" bis_skin_checked="1">
              <label for="" class="">Hora</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_hora"></i></span> 
                <input type="text" class="form-control input-lg input_hora" name="nuevohora" id="nuevohora" placeholder="" value="" autocomplete="off" required="" readonly="readonly">
              </div>
            </div>

            <input type="hidden" class="form-control input-lg input_idusuario" name="nuevoidusuario" id="nuevoidusuario" placeholder="" value="<?php echo $_SESSION["id"]?>" autocomplete="off" required="">


            <div class="form-group   grupobitacora_num_planilla" bis_skin_checked="1">
              <label for="" class="">Seleccione Planilla</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_num_planilla"></i></span> 

                    <select  class="form-control input-lg input_num_planilla" name="nuevonum_planilla" id="nuevonum_planilla"  autocomplete="off" required="">
                        <?php
                        function anticipo()
                          {
                            $query01 = "SELECT * FROM `planilladevengo_admin` GROUP BY numero_planilladevengo_admin ORDER BY id DESC";
                            $sql = Conexion::conectar()->prepare($query01);
                            $sql->execute();
                            return $sql->fetchAll();
                          };
                          $data01 = anticipo();
                          foreach ($data01 as $value) {
                          ?>
                          <option value="<?php echo $value["numero_planilladevengo_admin"];?>"><?php echo $value["numero_planilladevengo_admin"].'-'.$value["descripcion_planilladevengo_admin"]?></option>
                        <?php
                          }
                        ?>
                    </select>



              </div>
            </div>

            <div class="form-group   grupobitacora_estado_planilla" bis_skin_checked="1">
              <label for="" class="">Seleccione Acción</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_estado_planilla"></i></span> 

                <select class="form-control input-lg input_estado_planilla" name="nuevoestado_planilla" id="nuevoestado_planilla"  required="">
                  <option value="">Seleccione Opción</option>
                  <option value="Abrir">Abrir</option>
                  <option value="Cerrar">Cerrar</option>
                </select>

              </div>
            </div>
          
            <!-- ----------------------------------- -->
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

          $crear = new Controladorbitacora();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarbitacora" class="modal fade" role="dialog">
  
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
                          

                <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">

                <div class="form-group   grupobitacora_fecha" bis_skin_checked="1">
                  <label for="" class="">Fecha</label> 
                  <div class="input-group" bis_skin_checked="1">
                    <span class="input-group-addon"><i class="icono_fecha"></i></span> 
                    <input type="text" class="form-control input-lg input_fecha" name="editarfecha" id="editarfecha" placeholder="" value="" autocomplete="off" required="" readonly="readonly">
                  </div>
                </div>

                <div class="form-group   grupobitacora_hora" bis_skin_checked="1">
                  <label for="" class="">Hora</label> 
                  <div class="input-group" bis_skin_checked="1">
                    <span class="input-group-addon"><i class="icono_hora"></i></span> 
                    <input type="text" class="form-control input-lg input_hora" name="editarhora" id="editarhora" placeholder="" value="" autocomplete="off" required="" readonly="readonly">
                  </div>
                </div>

                <input type="hidden" class="form-control input-lg input_idusuario" name="editaridusuario" id="editaridusuario" placeholder="" value="<?php echo $_SESSION["id"]?>" autocomplete="off" required="">


                <div class="form-group   grupobitacora_num_planilla" bis_skin_checked="1">
                  <label for="" class="">Seleccione Planilla</label> 
                  <div class="input-group" bis_skin_checked="1">
                    <span class="input-group-addon"><i class="icono_num_planilla"></i></span> 

                        <select  class="form-control input-lg input_num_planilla mi-selector" name="editarnum_planilla" id="editarnum_planilla"  autocomplete="off" required="">
                            <?php
                              $data01 = anticipo();
                              foreach ($data01 as $value) {
                              ?>
                              <option value="<?php echo $value["numero_planilladevengo_admin"];?>"><?php echo $value["numero_planilladevengo_admin"].'-'.$value["descripcion_planilladevengo_admin"]?></option>
                            <?php
                              }
                            ?>
                        </select>



                  </div>
                </div>

                <div class="form-group   grupobitacora_estado_planilla" bis_skin_checked="1">
                  <label for="" class="">Seleccione Acción</label> 
                  <div class="input-group" bis_skin_checked="1">
                    <span class="input-group-addon"><i class="icono_estado_planilla"></i></span> 

                    <select class="form-control input-lg input_estado_planilla" name="editarestado_planilla" id="editarestado_planilla"  required="">
                      <option value="">Seleccione Opción</option>
                      <option value="Abrir">Abrir</option>
                      <option value="Cerrar">Cerrar</option>
                    </select>

                  </div>
                </div>


            <!-- ----------------------- -->
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

          $editar = new Controladorbitacora();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorbitacora();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/bitacora.js"></script>

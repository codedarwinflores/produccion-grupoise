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
          
          Agregar Cierres

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas"  width="100%">
         
         <thead>
          
          <tr>
            
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Modulo</th>
            <th>Accion</th>
 
          </tr> 
 
         </thead>
 
          <tbody id="mostrardatos">

          <?php
            function cierres() {
              $query = "SELECT*FROM cierres";
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };

            function usuario($id)
            {
              $query01 = "SELECT * FROM `usuarios` WHERE id=$id";
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
            };
  
        
            $data_cierre=cierres();
            $html="";
            foreach ($data_cierre as $value) {

              $idusuario=$value["idusuario_cierre"];

              $data_usuario=usuario($idusuario);
              $nomb_usuario="";
              foreach ($data_usuario as $val_usu) {
                $nomb_usuario=$val_usu["nombre"];
              }


              $html.="<tr>";
              $html.="<td>".$value["fecha_cierre"]."</td>";
              $html.="<td>".$nomb_usuario."</td>";
              $html.="<td>".$value["modulo_cierre"]."</td>";
              $html.="<td>"."<button class='btn btn-danger eliminar' idcierre='".$value["id"]."'>Eliminar</button>"."</td>";
              $html.="</tr>";
            }
            echo $html;
          
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

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Cierre</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

            <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">

            <div class="form-group   grupobitacora_fecha" bis_skin_checked="1">
              <label for="" class="">Fecha Desde</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha"></i></span> 
                <input type="text" class="form-control input-lg input_fecha calendario" name="fecha_desde" id="fecha_desde" placeholder="" value="" autocomplete="off" required="" readonly="readonly" >
              </div>
            </div>

            <div class="form-group   grupobitacora_fecha" bis_skin_checked="1">
              <label for="" class="">Fecha Hasta</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha"></i></span> 
                <input type="text" class="form-control input-lg input_fecha calendario" name="fecha_hasta" id="fecha_hasta" placeholder="" value="" autocomplete="off" required="" readonly="readonly" >
              </div>
            </div>


            <input type="hidden" class="form-control input-lg input_idusuario" name="editaridusuario" id="editaridusuario" placeholder="" value="<?php echo $_SESSION["id"]?>" autocomplete="off" required="">


            <div class="form-group   grupobitacora_estado_planilla" bis_skin_checked="1">
              <label for="" class="">Seleccione Modulo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_estado_planilla"></i></span> 

                <select class="form-control input-lg " name="modulo_cierre" id="modulo_cierre"  required="">
                  <option value="">Seleccione Opción</option>
                  <option value="situacion">Situacion</option>
                  <option value="transaccionagente">Movimiento Agente</option>
                  <option value="movimientoequipo">Movimiento Equipo</option>

                  
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

          <button type="submit" class="btn btn-primary guardar">Guardar </button>

        </div>



    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

 
<script src="vistas/js/cierres.js"></script>

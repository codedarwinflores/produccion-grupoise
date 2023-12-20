<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Vacante";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_vacante;
  $query = "SHOW COLUMNS FROM $nombretabla_vacante";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarvacante">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
     
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Ubicación</th>
            <th>Cliente</th>
            <th>Correlativo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Agente</th>
            <th>Nombre</th>
            <th>Posición</th>
            <th>Estado</th>
            <th>Fecha Cobertura</th>
            <th>Hora Cobertura</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorvacante::ctrMostrar($item, $valor);
 
         function cliente($codigo) {
            $query = "SELECT clientes.*
                      FROM tbl_clientes_ubicaciones, clientes
                      where tbl_clientes_ubicaciones.id_cliente=clientes.id and
                            tbl_clientes_ubicaciones.codigo_ubicacion='$codigo'";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
        };

        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.$value["ubicacion_vacante"]."-".$value["nombre_ubicacion_vacante"].'</td>';

                   $data_cliente=cliente($value["ubicacion_vacante"]);
                   foreach($data_cliente as $row_cliente) {
                    echo "<td>".$row_cliente["nombre"]."</td>";
                  }



              echo'<td>'.$value["correlativo_vacante"].'</td>
                   <td>'.$value["fecha_vacante"].'</td>
                   <td>'.$value["hora_vacante"].'</td>
                   <td>'.$value["codigo_agente_vacante"].'</td>
                   <td>'.$value["nombre_agente_vacante"].'</td>
                   <td>'.$value["posicion_vacante"].'</td>
                   <td>'.$value["estado_vacante"].'</td>
                   <td>'.$value["fecha_cobertura_vacante"].'</td>
                   <td>'.$value["hora_cobertura_vacante"].'</td>';
 
                  
 
                   echo '<td>

              
 
                     <div class="btn-group">
                       <button class="btn btn-warning btnEditarvacante" idvacante="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarvacante"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarvacante" idvacante="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>


                     
                     </div>  

                     <div class="btn-group">
                     <button type="button" class="btn btn-primary dropdown-toggle"
                             data-toggle="dropdown">
                      Mas Opciones<span class="caret"></span>
                     </button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                           <button class="btn btn-info btnadministrarvacante" idvacante="'.$value["id"].'" data-toggle="modal" data-target="#modaladministrar" style="display:none;">Administrar Movimiento</button>
                           <a class="btn btn-info" href="historialvacante?id='.$value["id"].'" style="background-color: #3c8dbc; color:#fff;">Administrar Movimiento</a>
                        </li>
                      </ul>

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

<div id="modalAgregarvacante" class="modal fade" role="dialog">
  
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


          <!-- ********************************* -->

                <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
             

            <div class="form-group   grupovacante_ubicacion_vacante" bis_skin_checked="1">
              <label for="" class="">Seleccione Ubicación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_ubicacion_vacante"></i></span> 

                  <select  class="form-control input-lg input_ubicacion_vacante mi-selector" name="nuevoubicacion_vacante" id="nuevoubicacion_vacante">
                        <option value="" id="">Seleccione Ubicación</option>
                        <?php
                        function consultar_hora() {
                          $query01 = "SELECT * FROM `tbl_clientes_ubicaciones` ";
                           $sql = Conexion::conectar()->prepare($query01);
                           $sql->execute();			
                           return $sql->fetchAll();
                        };
                        $data01 = consultar_hora();
                        foreach($data01 as $value) {
                          echo "<option  idubicacion='".$value["id"]."' codigo='".$value["codigo_ubicacion"]."' nombre='".$value["nombre_ubicacion"]."' value='".$value["codigo_ubicacion"]."'>".$value["codigo_ubicacion"]."-".$value["nombre_ubicacion"]." </option>";
                        }
                        ?>
                    </select>

                    <input type="hidden" name="nuevonombre_ubicacion_vacante" class="nombre_ubicacion_vacante" id="nuevonombre_ubicacion_vacante">


              </div>
            </div>

            <?php
            function ObtenerCorrelativo() {
              $query = "select * from vacante order by id desc limit 1";
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
              };
            
             $correlativo="";
             $data0 = ObtenerCorrelativo();
             foreach($data0 as $row0) {
              $numero = $row0['correlativo_vacante'];
              $quitarceros = ltrim($numero, "0"); 
              $addnumber= $quitarceros+1;
              $correlativo = sprintf("%09d",$addnumber);
              
              /* echo $correlativo; */
              
            }
            if($correlativo == "")
            {
              $correlativo="000000001";
            }
            
            ?>
            <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
              <label for="" class="">Correlativo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                <input type="text" class="form-control input-lg input_correlativo_vacante" name="nuevocorrelativo_vacante" id="nuevocorrelativo_vacante" placeholder="Correlativo" value="<?php echo $correlativo?>" autocomplete="off" readonly>
              </div>
            </div>


            <div class="form-group   grupovacante_fecha_vacante" bis_skin_checked="1">
              <label for="" class="">Fecha</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha_vacante"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_vacante" name="nuevofecha_vacante" id="nuevofecha_vacante" placeholder="" value="" autocomplete="off" required="" readonly>
              </div>
            </div>

            <div class="form-group   grupovacante_hora_vacante" bis_skin_checked="1">
              <label for="" class="">Hora</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_hora_vacante"></i></span> 
                <input type="text" class="form-control input-lg input_hora_vacante" name="nuevohora_vacante" id="nuevohora_vacante" placeholder="" value="" autocomplete="off" required="" >
              </div>
            </div>

            <div class="form-group   grupovacante_codigo_agente_vacante" bis_skin_checked="1">
              <label for="" class="">Seleccione Personal</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_codigo_agente_vacante"></i></span> 
         
                <select  class="form-control input-lg input_codigo_agente_vacante mi-selector" name="nuevocodigo_agente_vacante" id="nuevocodigo_agente_vacante">
                        <option value="" id="">Seleccione Personal</option>
                        <?php
                        function consultar_personal() {
                          $query01 = "SELECT * FROM tbl_empleados";
                           $sql = Conexion::conectar()->prepare($query01);
                           $sql->execute();			
                           return $sql->fetchAll();
                        };
                        $data01 = consultar_personal();
                        foreach($data01 as $value) {
                          $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                          $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                
                          echo "<option codigo='".$value["codigo_empleado"]."' nombre='".$nombre_cargo."'>".$value["codigo_empleado"]."-".$nombre_cargo." </option>";
                        }
                        ?>
                </select>
                <input type="hidden" class="form-control input-lg input_nombre_agente_vacante" name="nuevonombre_agente_vacante" id="nuevonombre_agente_vacante" placeholder="Nombre" value="" autocomplete="off" required="">

              </div>
            </div>

    
            

            <div class="form-group   grupovacante_posicion_vacante" bis_skin_checked="1">
              <label for="" class="">Ingresar Posición</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_posicion_vacante"></i></span> 
         
                <input type="text" class="form-control input-lg txt_posicion" placeholder="Agregar Nueva Posición">
                <select class="form-control input-lg input_posicion_vacante" name="nuevoposicion_vacante" id="nuevoposicion_vacante">
                </select>

              </div>
            </div>

            <div class="form-group   grupovacante_estado_vacante" bis_skin_checked="1" >
              <label for="" class="">Ingresar Estado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_estado_vacante"></i></span> 
                <select class="form-control input-lg input_estado_vacante" name="nuevoestado_vacante" id="nuevoestado_vacante">
                  <option value="Pendiente">Pendiente</option>
                  <option value="Cubierta">Cubierta</option>
                </select>
              </div>
            </div>

            <div class="form-group   grupovacante_fecha_cobertura_vacante" bis_skin_checked="1">
              <label for="" class="">Ingresar Fecha Cobertura</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha_cobertura_vacante"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_cobertura_vacante calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="nuevofecha_cobertura_vacante" id="nuevofecha_cobertura_vacante" placeholder="Ingresar Fecha Cobertura" value="" autocomplete="off" required="" readonly>
              </div>
            </div>


            <div class="form-group   grupovacante_hora_cobertura_vacante" bis_skin_checked="1">
              <label for="" class="">Ingresar Hora Cobertura</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_hora_cobertura_vacante"></i></span> 
                <input type="text" class="form-control input-lg input_hora_cobertura_vacante tiempo" name="nuevohora_cobertura_vacante" id="nuevohora_cobertura_vacante" placeholder="Ingresar Hora Cobertura" value="" autocomplete="off" >
              </div>
            </div>

            <div class="form-group   grupovacante_hora_cobertura_vacante" bis_skin_checked="1">
              <label for="" class="">Ingresar Observación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_hora_cobertura_vacante"></i></span> 
                <input type="text" class="form-control input-lg  " name="nuevoobserva_vacante" id="nuevoobserva_vacante" placeholder="Ingresar Hora Cobertura" value="" autocomplete="off" >
              </div>
            </div>


            <input type="hidden" name="nuevofecha_cubrir_vacante" id="nuevofecha_cubrir_vacante">
            <input type="hidden" name="nuevohora_cubrir_vacante" id="nuevohora_cubrir_vacante">
            <input type="hidden" name="nuevoaccion_cubrir_vacante" id="nuevoaccion_cubrir_vacante">
            <input type="hidden" name="nuevocodigo_empleado_cubrir_vacante" id="nuevocodigo_empleado_cubrir_vacante">
            <input type="hidden" name="nuevonombre_empleado_cubrir_vacante" id="nuevonombre_empleado_cubrir_vacante">
            <input type="hidden" name="nuevocodigo_ubicacion_cubrir_vacante" id="nuevocodigo_ubicacion_cubrir_vacante">
            <input type="hidden" name="nuevonombre_ubicacion_cubrir_vacante" id="nuevonombre_ubicacion_cubrir_vacante">


          <!-- ******************************* -->

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

          $crear = new Controladorvacante();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarvacante" class="modal fade" role="dialog">
  
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
             

             <div class="form-group   grupovacante_ubicacion_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Ubicación</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_ubicacion_vacante"></i></span> 
 
                   <select  class="form-control input-lg input_ubicacion_vacante mi-selector" name="editarubicacion_vacante" id="editarubicacion_vacante">
                         <option value="" id="ubicacion_vacante">Seleccione Ubicación</option>
                         <?php
                         $data01 = consultar_hora();
                         foreach($data01 as $value) {
                           echo "<option idubicacion='".$value["id"]."' codigo='".$value["codigo_ubicacion"]."' nombre='".$value["nombre_ubicacion"]."' value='".$value["codigo_ubicacion"]."'>".$value["codigo_ubicacion"]."-".$value["nombre_ubicacion"]." </option>";
                         }
                         ?>
                     </select>
 
                     <input type="hidden" name="editarnombre_ubicacion_vacante" class="nombre_ubicacion_vacante" id="editarnombre_ubicacion_vacante">
 
 
               </div>
             </div>
 
             <?php
              $correlativo="";
              $data0 = ObtenerCorrelativo();
              foreach($data0 as $row0) {
               $numero = $row0['correlativo_vacante'];
               $quitarceros = ltrim($numero, "0"); 
               $addnumber= $quitarceros+1;
               $correlativo = sprintf("%09d",$addnumber);
               
               /* echo $correlativo; */
               
             }
             if($correlativo == "")
             {
               $correlativo="000000001";
             }
             
             ?>
             <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
               <label for="" class="">Correlativo</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <input type="text" class="form-control input-lg input_correlativo_vacante" name="editarcorrelativo_vacante" id="editarcorrelativo_vacante" placeholder="Correlativo" value="<?php echo $correlativo?>" autocomplete="off" readonly>
               </div>
             </div>
 
 
             <div class="form-group   grupovacante_fecha_vacante" bis_skin_checked="1">
               <label for="" class="">Fecha</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_fecha_vacante"></i></span> 
                 <input type="text" class="form-control input-lg input_fecha_vacante" name="editarfecha_vacante" id="editarfecha_vacante" placeholder="" value="" autocomplete="off" required="" readonly>
               </div>
             </div>
 
             <div class="form-group   grupovacante_hora_vacante" bis_skin_checked="1">
               <label for="" class="">Hora</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_hora_vacante"></i></span> 
                 <input type="text" class="form-control input-lg input_hora_vacante" name="editarhora_vacante" id="editarhora_vacante" placeholder="" value="" autocomplete="off" required="" readonly>
               </div>
             </div>
 
             <div class="form-group   grupovacante_codigo_agente_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Personal</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_codigo_agente_vacante"></i></span> 
          
                 <select  class="form-control input-lg input_codigo_agente_vacante mi-selector" name="editarcodigo_agente_vacante" id="editarcodigo_agente_vacante">
                         <option value="" id="personal_vacante">Seleccione Personal</option>
                         <?php
                         $data01 = consultar_personal();
                         foreach($data01 as $value) {
                           echo "<option codigo='".$value["codigo_empleado"]."' nombre='".$value["primer_nombre"].' '.$value["primer_apellido"]."' value='".$value["codigo_empleado"]."'>".$value["codigo_empleado"]."-".$value["primer_nombre"].' '.$value["primer_apellido"]." </option>";
                         }
                         ?>
                 </select>
                 <input type="hidden" class="form-control input-lg input_nombre_agente_vacante" name="editarnombre_agente_vacante" id="editarnombre_agente_vacante" placeholder="Nombre" value="" autocomplete="off" required="">
 
               </div>
             </div>
 
     
             
 
             <div class="form-group   grupovacante_posicion_vacante" bis_skin_checked="1">
               <label for="" class="">Ingresar Posición</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_posicion_vacante"></i></span> 

                <input type="text" class="form-control input-lg txt_posicion" placeholder="Agregar Nueva Posición">
                 <select  class="form-control input-lg input_posicion_vacante" name="editarposicion_vacante" id="editarposicion_vacante">
                  
                </select>


               </div>
             </div>
 
             <div class="form-group   grupovacante_estado_vacante" bis_skin_checked="1">
               <label for="" class="">Ingresar Estado</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_estado_vacante"></i></span> 
            
                 <select class="form-control input-lg input_estado_vacante" name="editarestado_vacante" id="editarestado_vacante">
                  <option value="">Seleccionar Estado</option>
                  <option value="Pendiente">Pendiente</option>
                  <option value="Cubierta">Cubierta</option>
                </select>


               </div>
             </div>
 
             <div class="form-group   grupovacante_fecha_cobertura_vacante" bis_skin_checked="1">
               <label for="" class="">Ingresar Fecha Cobertura</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_fecha_cobertura_vacante"></i></span> 
                 <input type="text" class="form-control input-lg input_fecha_cobertura_vacante calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="editarfecha_cobertura_vacante" id="editarfecha_cobertura_vacante" placeholder="Ingresar Fecha Cobertura" value="" autocomplete="off"  readonly>
               </div>
             </div>
 
 
             <div class="form-group   grupovacante_hora_cobertura_vacante" bis_skin_checked="1">
               <label for="" class="">Ingresar Hora Cobertura</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_hora_cobertura_vacante"></i></span> 
                 <input type="text" class="form-control input-lg input_hora_cobertura_vacante tiempo" name="editarhora_cobertura_vacante" id="editarhora_cobertura_vacante" placeholder="Ingresar Hora Cobertura" value="" autocomplete="off" >
               </div>
             </div>


             <div class="form-group   grupovacante_hora_cobertura_vacante" bis_skin_checked="1">
              <label for="" class="">Ingresar Observación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_hora_cobertura_vacante"></i></span> 
                <input type="text" class="form-control input-lg  " name="editarobserva_vacante" id="editarobserva_vacante" placeholder="Ingresar Hora Cobertura" value="" autocomplete="off" >
              </div>
            </div>

             <!-- ***************** -->

             <input type="hidden" name="editarfecha_cubrir_vacante" id="editarfecha_cubrir_vacante">
             <input type="hidden" name="editarhora_cubrir_vacante" id="editarhora_cubrir_vacante">
             <input type="hidden" name="editaraccion_cubrir_vacante" id="editaraccion_cubrir_vacante">
             <input type="hidden" name="editarcodigo_empleado_cubrir_vacante" id="editarcodigo_empleado_cubrir_vacante">
             <input type="hidden" name="editarnombre_empleado_cubrir_vacante" id="editarnombre_empleado_cubrir_vacante">
             <input type="hidden" name="editarcodigo_ubicacion_cubrir_vacante" id="editarcodigo_ubicacion_cubrir_vacante">
             <input type="hidden" name="editarnombre_ubicacion_cubrir_vacante" id="editarnombre_ubicacion_cubrir_vacante">


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

          $editar = new Controladorvacante();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorvacante();
  $borrar -> ctrBorrar();

?> 

<!--=====================================
MODAL administrar 
======================================-->

<div id="modaladministrar" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

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

            <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
               <label for="" class="">Fecha</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <input type="text" class="form-control input-lg calendario" name="editarfecha_cubrir_vacante" id="fecha_cubrir_vacante" placeholder="Fecha" autocomplete="off" readonly>
               </div>
             </div>


             <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
               <label for="" class="">Ingresar Hora</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <input type="text" class="form-control input-lg tiempo" name="editarhora_cubrir_vacante" id="hora_cubrir_vacante" placeholder="Ingresar Hora" autocomplete="off">
               </div>
             </div>


             <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Acción</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <select  class="form-control input-lg" name="editaraccion_cubrir_vacante" id="accion_cubrir_vacante">
                         <option value="">Seleccionar Acción</option>
                         <option value="Reingreso">Reingreso</option>
                         <option value="Traslado">Traslado</option>
                         <option value="Nuevo ingreso">Nuevo ingreso</option>
                 </select>
               </div>
             </div>


             <div class="form-group   grupovacante_codigo_agente_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Personal</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_codigo_agente_vacante"></i></span> 
          
                 <select  class="form-control input-lg input_codigo_agente_vacante mi-selector" name="editarcodigo_empleado_cubrir_vacante" id="codigo_empleado_cubrir_vacante">
                         <option value="" id="personal_cubrir_vacante">Seleccione Personal</option>
                         <?php
                         $data01 = consultar_personal();
                         foreach($data01 as $value) {
                           echo "<option idempleado='".$value["id"]."'  codigo='".$value["codigo_empleado"]."' nombre='".$value["primer_nombre"].' '.$value["primer_apellido"]."' value='".$value["codigo_empleado"]."'>".$value["codigo_empleado"]."-".$value["primer_nombre"].' '.$value["primer_apellido"]." </option>";
                         }
                         ?>
                 </select>
                 <input type="hidden" class="form-control input-lg input_nombre_agente_vacante" name="editarnombre_empleado_cubrir_vacante" id="nombre_empleado_cubrir_vacante" placeholder="Nombre" value="" autocomplete="off" required="">
 
               </div>
             </div>
 


             <div class="form-group   grupovacante_ubicacion_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Ubicación</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_ubicacion_vacante"></i></span> 
 
                   <select  class="form-control input-lg input_ubicacion_vacante mi-selector" name="editarcodigo_ubicacion_cubrir_vacante" id="codigo_ubicacion_cubrir_vacante">
                         <option value="" id="ubicacion_cubrir_vacante">Seleccione Ubicación</option>
                         <?php
                         $data01 = consultar_hora();
                         foreach($data01 as $value) {
                           echo "<option idubicacion='".$value["id"]."' codigo='".$value["codigo_ubicacion"]."' nombre='".$value["nombre_ubicacion"]."' value='".$value["codigo_ubicacion"]."'>".$value["codigo_ubicacion"]."-".$value["nombre_ubicacion"]." </option>";
                         }
                         ?>
                     </select>
 
                     <input type="hidden" name="editarnombre_ubicacion_cubrir_vacante" class="nombre_ubicacion_vacante" id="nombre_ubicacion_cubrir_vacante">
 
 
               </div>
             </div>


             <div class="form-group   " bis_skin_checked="1" style="height: 0px; visibility:hidden;">
               <label for="" class="">Seleccione Estado</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <select  class="form-control input-lg" name="editarestado_vacante" id="estado_vacante">
                         <option value="">Seleccionar Estado</option>
                         <option value="Pendiente">Pendiente</option>
                         <option value="Cubierta">Cubierta</option>
                 </select>
               </div>
             </div>



                        <input type="hidden" name="editarid" id="id">
                        <input type="hidden" name="editarubicacion_vacante" id="aubicacion_vacante">
                        <input type="hidden" name="editarcorrelativo_vacante" id="correlativo_vacante">
                        <input type="hidden" name="editarfecha_vacante" id="fecha_vacante">
                        <input type="hidden" name="editarhora_vacante" id="hora_vacante">
                        <input type="hidden" name="editarcodigo_agente_vacante" id="codigo_agente_vacante">
                        <input type="hidden" name="editarnombre_agente_vacante" id="nombre_agente_vacante">
                        <input type="hidden" name="editarposicion_vacante" id="posicion_vacante">
                        <input type="hidden" name="" id="">
                        <input type="hidden" name="editarfecha_cobertura_vacante" id="fecha_cobertura_vacante">
                        <input type="hidden" name="editarhora_cobertura_vacante" id="hora_cobertura_vacante">
                        <input type="hidden" name="editarnombre_ubicacion_vacante" id="nombre_ubicacion_vacante">

   
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardaradmin">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        
              <?php

          $editar = new Controladorvacante();
          $editar -> ctrEditar();

          ?> 


      </form>
   

    </div>

  </div>

</div>

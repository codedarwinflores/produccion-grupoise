<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Agente Ubicación";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_agenteubicacion;
  $query = "SHOW COLUMNS FROM $nombretabla_agenteubicacion";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);

$idhistorial0 = $results['id'];


?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="ubicacionc" class="btn btn-danger">Volver</a>
  
       <!--  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaragenteubicacion">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button> -->

      </div>

      <div class="box-body">
        
      
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            <th>Código Agente</th>
            <th>Nombre Agente</th>
          <!--   <th style="display: none;">Acciones</th> -->
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladoragenteubicacion::ctrMostrar($item, $valor);

         function ubicacion($e) {
          $query = "SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionasignada, `idubicacion_agente`, `codigo_agente`,tbl_empleados.* 
          FROM `tbl_ubicaciones_agentes_asignados` , tbl_empleados
          WHERE idubicacion_agente=$e and tbl_ubicaciones_agentes_asignados.codigo_agente=tbl_empleados.codigo_empleado group by tbl_empleados.codigo_empleado";
        
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();			
          return $sql->fetchAll();
        };

        $data01 = ubicacion($idhistorial0);
        foreach($data01 as $value) {
          
           echo ' <tr>
                   <td>'.$value["codigo_agente"].'</td>
                   <td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'</td>';
 
                  
 
                   echo '<td style="display: none;">
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditaragenteubicacion" idagenteubicacion="'.$value["idubicacionasignada"].'" data-toggle="modal" data-target="#modalEditaragenteubicacion"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminaragenteubicacion" idagenteubicacion="'.$value["idubicacionasignada"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregaragenteubicacion" class="modal fade" role="dialog">
  
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

            <div class="form-group">
              <label for="" class="">Agente</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="nuevonombre_agente" id="" class="form-control input-lg mi-selector nuevonombre_agente" required >
                      <option value="">Seleccione Agente</option>
                      <?php 
                                   function tblempleados() {
                                     $query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                     INNER JOIN cargos_desempenados 
                                     WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='Agente de Seguridad' ";
                                     $sql = Conexion::conectar()->prepare($query01);
                                     $sql->execute();			
                                     return $sql->fetchAll();
                                     }

                                     $data01 = tblempleados();
                                     foreach($data01 as $rowempleado) {
                                        echo "<option codigo='".$rowempleado["codigo_empleado"]."' value='".$rowempleado["primer_nombre"].' '.$rowempleado["segundo_nombre"].' '.$rowempleado["tercer_nombre"].' '.$rowempleado["primer_apellido"].' '.$rowempleado["segundo_apellido"].' '.$rowempleado["apellido_casada"]."' >".$rowempleado["primer_nombre"].' '.$rowempleado["segundo_nombre"].' '.$rowempleado["tercer_nombre"].' '.$rowempleado["primer_apellido"].' '.$rowempleado["segundo_apellido"].' '.$rowempleado["apellido_casada"]."</option>";
                                  
                                     }
                                   ?>
                    </select>


              </div>
            </div>

            <!-- ********** -->

            
            <div class="form-group">
              <label for="" class="">Código Agente</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control codigo_agente" name="nuevocodigo_agente" id="" readonly>
              </div>
            </div>
            
            <input type="hidden" class="" name="nuevoidubicacion_agente" value="<?php echo $idhistorial0?>">
            <input type="hidden" name="nuevoid">
             

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

          $crear = new Controladoragenteubicacion();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditaragenteubicacion" class="modal fade" role="dialog">
  
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

            
<div class="form-group">
<label for="" class="">Agente</label> 
<div class="input-group">
  <span class="input-group-addon"><i class=""></i></span> 
  <select name="editarnombre_agente" id="editarnombre_agente" class="form-control input-lg mi-selector editarnombre_agente" required >
        <option value="" id="seleccion">Seleccione Agente</option>
        <?php 
                     function tblempleadose() {
                       $query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                       INNER JOIN cargos_desempenados 
                       WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='Agente de Seguridad' ";
                       $sql = Conexion::conectar()->prepare($query01);
                       $sql->execute();			
                       return $sql->fetchAll();
                       }

                       $data012 = tblempleadose();
                       foreach($data012 as $rowempleado) {
                          echo "<option codigo='".$rowempleado["codigo_empleado"]."' value='".$rowempleado["primer_nombre"].' '.$rowempleado["segundo_nombre"].' '.$rowempleado["tercer_nombre"].' '.$rowempleado["primer_apellido"].' '.$rowempleado["segundo_apellido"].' '.$rowempleado["apellido_casada"]."' >".$rowempleado["primer_nombre"].' '.$rowempleado["segundo_nombre"].' '.$rowempleado["tercer_nombre"].' '.$rowempleado["primer_apellido"].' '.$rowempleado["segundo_apellido"].' '.$rowempleado["apellido_casada"]."</option>";
                    
                       }
                     ?>
                </select>


              </div>
              </div>

              <!-- ********** -->


              <div class="form-group">
              <label for="" class="">Código Agente</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control codigo_agente" name="editarcodigo_agente" id="editarcodigo_agente" readonly>
              </div>
              </div>

              <input type="hidden" class="" name="editaridubicacion_agente" value="<?php echo $idhistorial0?>">
              <input type="hidden" name="editarid" id="editarid">

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

          $editar = new Controladoragenteubicacion();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladoragenteubicacion();
  $borrar -> ctrBorrar();

?> 



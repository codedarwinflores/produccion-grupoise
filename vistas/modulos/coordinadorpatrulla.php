<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Coordinador";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_coordinadorpatrulla;
  $query = "SHOW COLUMNS FROM $nombretabla_coordinadorpatrulla";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};



$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
$idpatrulla = $results['id'];



?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="patrulla" class="btn btn-danger">Volver</a>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarcoordinadorpatrulla">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            <th>Coodinador</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
          function coordinador($id) {
            $query = "SELECT * FROM `coordinadorpatrulla` WHERE idpatrulla_coordinadorpatrulla=$id";
            $sql = Conexion::conectar()->prepare($query);
            $sql->execute();			
            return $sql->fetchAll();
          };
          $data0 = coordinador($idpatrulla);
          foreach($data0 as $value) {
          
           echo ' <tr>
                   <td>'.$value["codigo_nombre_coordinador"].'</td>';
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarcoordinadorpatrulla" idcoordinadorpatrulla="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarcoordinadorpatrulla"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarcoordinadorpatrulla" idcoordinadorpatrulla="'.$value["id"].'"  Codigo="'.$value["idpatrulla_coordinadorpatrulla"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarcoordinadorpatrulla" class="modal fade" role="dialog">
  
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

                <input type="hidden" class="form-control input-lg input_idpatrulla_coordinadorpatrulla" name="nuevoidpatrulla_coordinadorpatrulla" id="nuevoidpatrulla_coordinadorpatrulla" placeholder="" value="<?php echo $idpatrulla?>" autocomplete="off"  >
            
                <input type="hidden" name="nuevoidcoordinador_patrulla" class="nuevoidcoordinador_patrulla" id="">

            <div class="form-group   grupocoordinadorpatrulla_codigo_nombre_coordinador">
              <label for="" class="">Seleccione Coordinador</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_codigo_nombre_coordinador"></i></span> 
                <select  class="form-control input-lg input_codigo_nombre_coordinador mi-selector" name="nuevocodigo_nombre_coordinador" id="nuevocodigo_nombre_coordinador">
                  <option value="">Seleccione Coordinador</option>
                  <?php
                  function obtenerempleado() {
                    $query = "SELECT empleado.id as idempleados, empleado.* FROM tbl_empleados AS empleado
                              INNER JOIN
                              cargos_desempenados AS cargos
                              ON empleado.nivel_cargo = cargos.id and cargos.descripcion='COORDINADOR DE ZONA'";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                  };
                  $data0 = obtenerempleado();
                  foreach($data0 as $value) {
                  ?>
                  <option ids="<?php echo $value["idempleados"];?>" value="<?php echo $value["codigo_empleado"].' - '. $value["primer_nombre"].' '.$value["primer_apellido"]; ?>" >
                  
                    <?php echo $value["codigo_empleado"].' - '. $value["primer_nombre"].' '.$value["primer_apellido"]; ?>

                  </option>
                  <?php
                  }
                  
                  ?>
                </select>


              </div>
            </div>
         
            <!-- ************************ -->

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

          $crear = new Controladorcoordinadorpatrulla();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarcoordinadorpatrulla" class="modal fade" role="dialog">
  
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

            


            <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off"/>

            <input type="hidden" class="form-control input-lg input_idpatrulla_coordinadorpatrulla" name="editaridpatrulla_coordinadorpatrulla" id="editaridpatrulla_coordinadorpatrulla" placeholder="" value="<?php echo $idpatrulla?>" autocomplete="off"/>

            <input type="hidden" name="editaridcoordinador_patrulla" class="nuevoidcoordinador_patrulla" id="editaridcoordinador_patrulla">

            <div class="form-group   grupocoordinadorpatrulla_codigo_nombre_coordinador">
                <label for="" class="">Seleccione Coordinador</label> 
                <div class="input-group">
                      <span class="input-group-addon"><i class="icono_codigo_nombre_coordinador"></i></span> 
                      <select  class="form-control input-lg input_codigo_nombre_coordinador mi-selector" name="editarcodigo_nombre_coordinador" id="editarcodigo_nombre_coordinador">
                        <option value="" id="idcoordinador">Seleccione Coordinador</option>
                        <?php
                        $data0 = obtenerempleado();
                        foreach($data0 as $value) {
                        ?>
                        <option ids="<?php echo $value["idempleados"];?>" value="<?php echo $value["codigo_empleado"].' - '. $value["primer_nombre"].' '.$value["primer_apellido"]; ?>" >
                        
                          <?php echo $value["codigo_empleado"].' - '. $value["primer_nombre"].' '.$value["primer_apellido"]; ?>

                        </option>
                        <?php
                        }
                        ?>
                  </select>
              </div>
            </div>
            <!-- ********************** -->


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

          $editar = new Controladorcoordinadorpatrulla();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorcoordinadorpatrulla();
  $borrar -> ctrBorrar();

?> 



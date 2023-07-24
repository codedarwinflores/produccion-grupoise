<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Patrulla";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_patrulla;
  $query = "SHOW COLUMNS FROM $nombretabla_patrulla";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarpatrulla">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
      <div class="row">


      <div class="col-md-12">
          
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
              
              <thead>
                
                <tr>
                  
                  <th style="width:10px">#</th>
                  
                  <th>Código Patrulla</th>
                  <th>Descripción</th>
                  <th>Jefe Operación</th>
                  <th>Acciones</th>
      
                </tr> 
      
              </thead>
      
              <tbody>
      
              <?php
      
              $item = null;
              $valor = null;
      
              $bancos = Controladorpatrulla::ctrMostrar($item, $valor);
      
              foreach ($bancos as $key => $value){
                
                echo ' <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["codigo_patrulla"].'</td>
                        <td>'.$value["descripcion_patrulla"].'</td>
                        <td>'.$value["primer_nombre"].' '.$value["primer_apellido"]. '</td>';
      
                        
      
                        echo '<td>
      
                          <div class="btn-group">
                              
                            <button class="btn btn-warning btnEditarpatrulla" idpatrulla="'.$value["idpatrulla"].'" data-toggle="modal" data-target="#modalEditarpatrulla"><i class="fa fa-pencil"></i></button>
      
                            <button class="btn btn-danger btnEliminarpatrulla" idpatrulla="'.$value["idpatrulla"].'"  Codigo="'.$value["codigo_patrulla"].'"><i class="fa fa-times"></i></button>

                            <a href="administrarpatrulla?id='.$value["idpatrulla"].'" class="btn btn-primary "><i class="fa fa-eye"></i></a>

                            <a href="coordinadorpatrulla?id='.$value["idpatrulla"].'" class="btn btn-success "><i class="fa fa-users"></i></a>
      
                          </div>  
      
                        </td>
      
                      </tr>';
              }
      
      
              ?> 
      
              </tbody>
      
        </table>
      </div>
      </div>
      
      
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarpatrulla" class="modal fade" role="dialog">
  
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

          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group <?php echo $row['Field'];?>  grupopatrulla_<?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_patrullas" item_validar="codigo_patrulla">

              </div>

            </div>

          <?php
             }
          ?>
             

             
            <div class="sempleado">
                <label for="">Seleccione Jefe de Operaciones:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="nuevoid_jefe_operaciones_patrulla" id="" class="form-control input-lg " required>
                      <option value="">Seleccione Jefe de Operaciones</option>

                                   <?php
                                   
                                    function tblempleados() {
                                      $query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                      INNER JOIN cargos_desempenados 
                                      WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='Jefe de Operaciones'";
                                      $sql = Conexion::conectar()->prepare($query01);
                                      $sql->execute();			
                                      return $sql->fetchAll();
                                      };

                                      $data01 = tblempleados();
                                      foreach($data01 as $rowempleado) {
                                    

                                         echo "<option value='".$rowempleado["idempleado"]."' >".$rowempleado["primer_nombre"].' '.$rowempleado["segundo_nombre"].' '.$rowempleado["tercer_nombre"].' '.$rowempleado["primer_apellido"].' '.$rowempleado["segundo_apellido"].' '.$rowempleado["apellido_casada"]."</option>";
                                   
                                      }

                                    ?>


                    </select>
                </div>
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

          $crear = new Controladorpatrulla();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarpatrulla" class="modal fade" role="dialog">
  
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

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group <?php echo $row['Field'];?> egrupopatrulla_<?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>

          <div class="editarsempleado">
                <label for="">Seleccione Jefe de Operaciones:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="editarid_jefe_operaciones_patrulla" id="editarid_jefe_operaciones_patrulla" class="form-control input-lg " required>
                      <option value="">Seleccione Jefe de Operaciones</option>
                      <?php
                                   
                                    function tblempleadosmodificar() {
                                      $query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                      INNER JOIN cargos_desempenados 
                                      WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='Jefe de Operaciones'";
                                      $sql = Conexion::conectar()->prepare($query01);
                                      $sql->execute();			
                                      return $sql->fetchAll();
                                      }

                                      $data01 = tblempleadosmodificar();
                                      foreach($data01 as $rowempleado) {
                                    

                                         echo "<option value='".$rowempleado["idempleado"]."' >".$rowempleado["primer_nombre"].' '.$rowempleado["segundo_nombre"].' '.$rowempleado["tercer_nombre"].' '.$rowempleado["primer_apellido"].' '.$rowempleado["segundo_apellido"].' '.$rowempleado["apellido_casada"]."</option>";
                                   
                                      }

                                    ?>


                    </select>
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

          $editar = new Controladorpatrulla();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorpatrulla();
  $borrar -> ctrBorrar();

?> 



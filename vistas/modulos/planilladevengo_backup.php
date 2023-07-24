<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Planilla Devengo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  $query = "SHOW COLUMNS FROM planilladevengo";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="nuevaplanilladevengo?id=0" class="btn btn-primary" >
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </a>

      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- ***************** -->
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>No. Planilla</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
          
                    </tr> 
          
                  </thead>
          
                  <tbody>
          
                  <?php
          
                  function planilladevengo() {
                    $query = "SELECT*FROM planilladevengo group by numero_planilladevengo";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                  };
                  $data01 = planilladevengo();
                  foreach($data01 as $value) {
                    echo ' <tr>
                            <td>'.$value["fecha_planilladevengo"].'</td>
                            <td>'.$value["numero_planilladevengo"].'</td>
                            <td>'.$value["descripcion_planilladevengo"].'</td>';
          
                            
          
                            echo '<td>
          
                              <div class="btn-group">
                                  
                                <a href="nuevaplanilladevengo?id='.$value["id"].'" class="btn btn-warning btnEditarabase" idabase="'.$value["id"].'"><i class="fa fa-pencil"></i></a>
          
                                <button class="btn btn-danger btnEliminarabase" idabase="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
          
                              </div>  
          
                            </td>
          
                          </tr>';
                  }
          
          
                  ?> 
          
                  </tbody>
          
                </table>

              </div>

          <!-- ***************** -->
        </div>

      </div>
    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarabase" class="modal fade" role="dialog">
  
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
           ?>
            <div class="form-group   grupoabase_<?php echo $row['Field'];?>">
              <label for="" class=""></label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 
                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" id="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
              </div>
            </div>
          <?php
             }
          ?>

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

          $crear = new Controladorabase();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarabase" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?> egrupoabase_<?php echo $row['Field'];?>">
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
                      $query = "select * from ajustes where name_table='tarjetas_abase' and accion='editar' and elemento='Seleccione Operador'
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

          $editar = new Controladorabase();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorabase();
  $borrar -> ctrBorrar();

?> 


<script src="../../js/planilladevengo.js"></script>

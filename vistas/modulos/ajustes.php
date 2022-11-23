<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Ajuste";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_ajustes;
  $query = "SHOW COLUMNS FROM $nombretabla_ajustes";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarajustes">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Código</th>
            <th>Modulo</th>
            <th>Tipo Acción</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorajustes::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td><textarea class="form-control"  rows="15" style="width:100%" >
                   '.$value["code"].'</textarea></td>
                   <td>'.$value["name_table"].'</td>
                   <td>'.$value["accion"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarajustes" idajustes="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarajustes"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarajustes" idajustes="'.$value["id"].'" ><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarajustes" class="modal fade" role="dialog">
  
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

        <div class="box-body" bis_skin_checked="1">

            <!-- ENTRADA PARA CAMPOS  -->

              <div class="form-group id  grupoajustes_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_id"></i></span> 
                <input type="text" class="form-control input-lg input_id" name="nuevoid" placeholder="" value="" autocomplete="off">
              </div>
            </div>


           <div class="form-group code  grupoajustes_code" bis_skin_checked="1">
              <label for="" class="label_code">Código</label> 
              
              <div class="input-group" bis_skin_checked="1">
             
                <textarea class="form-control" rows="10" cols="100" name="nuevocode" style="width: 100%;"></textarea>

              </div>

            </div>


            <div class="form-group name_table  grupoajustes_name_table" bis_skin_checked="1">
              <label for="" class="label_name_table">Nombre Modulo</label> 
              
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_name_table"></i></span> 
                <input type="text" class="form-control input-lg input_name_table" name="nuevoname_table" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


             <div class="form-group elemento  grupoajustes_elemento" bis_skin_checked="1">
              <label for="" class="label_elemento">Elemento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_elemento"></i></span> 

                <input type="text" class="form-control input-lg input_elemento" name="nuevoelemento" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group accion  grupoajustes_accion" bis_skin_checked="1">
              <label for="" class="label_accion">Tipo de Acción</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_accion"></i></span> 

                <?php
                    function Obtenernuevo() {
                      $query = "select * from ajustes where name_table='ajustes' and accion='nuevo'";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = Obtenernuevo();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>
                
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

          $crear = new Controladorajustes();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarajustes" class="modal fade" role="dialog">
  
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

        <div class="box-body" bis_skin_checked="1">

            <!-- ENTRADA PARA CAMPOS  -->

              <div class="form-group id  grupoajustes_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_id"></i></span> 
                <input type="text" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
              </div>
            </div>


           <div class="form-group code  grupoajustes_code" bis_skin_checked="1">
              <label for="" class="label_code">Código</label> 
              
              <div class="input-group" bis_skin_checked="1">
             
                <textarea class="form-control" rows="10" cols="100" name="editarcode" id="editarcode" style="width: 100%;"></textarea>

              </div>

            </div>


            <div class="form-group name_table  grupoajustes_name_table" bis_skin_checked="1">
              <label for="" class="label_name_table">Nombre Modulo</label> 
              
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_name_table"></i></span> 
                <input type="text" class="form-control input-lg input_name_table" name="editarname_table" id="editarname_table" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


             <div class="form-group elemento  grupoajustes_elemento" bis_skin_checked="1">
              <label for="" class="label_elemento">Elemento</label> 
              
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_elemento"></i></span> 
                <input type="text" class="form-control input-lg input_elemento" name="editarelemento" id="editarelemento" placeholder="" value="" autocomplete="off" required="">

              </div>

            </div>


            <div class="form-group accion  grupoajustes_accion" bis_skin_checked="1">
              <label for="" class="label_accion">Tipo de Acción</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_accion"></i></span> 
                
                      
                <?php
                  function Obtenereditar() {
                      $query = "select * from ajustes where name_table='ajustes' and accion='editar'";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = Obtenereditar();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>
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

          $editar = new Controladorajustes();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorajustes();
  $borrar -> ctrBorrar();

?> 



<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Regalo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_regalo;
  $query = "SHOW COLUMNS FROM $nombretabla_regalo";
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
          <div class="col-md-6">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarregalo">
                
                Agregar <?php echo $Nombre_del_Modulo;?>

              </button>
          </div>
          <div class="col-md-6" align="right">
              <a href="empleados" class="btn btn-danger">Volver</a>
          </div>
        </div>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            
            <th>Fecha</th>
            <th>Código Uniforme</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody id="tablaregalo">
 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarregalo" class="modal fade" role="dialog">
  
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
            <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group <?php echo $row['Field'];?>  gruporegalo_<?php echo $row['Field'];?>">
              <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>  regalo_input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>

              </div>

            </div>


          <?php
             }
          ?>
             

        

           <div class="insert_equipo">
            <label for="">Seleccione Equipo</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="nuevoregalo_prenda" id="nuevoregalo_prenda" class="form-control input-lg" required>
                  <option value="">Seleccione Equipo</option>
                <?php
                    $datos_mostrar = Controladorequipos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo_equipo'] ?>" descripcion="<?php echo $value['descripcion'] ?>"><?php echo $value["codigo_equipo"] ?></option>  
                <?php
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

          $crear = new Controladorregalo();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarregalo" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?> egruporegalo_<?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?> eregalo_input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>
           

           

           <div class="update_equipo">
            <label for="">Seleccione Equipo</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editarregalo_prenda" id="editarregalo_prenda2" class="form-control input-lg" required>
                  <option value="">Seleccione Equipo</option>
                <?php
                    $datos_mostrar = Controladorequipos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo_equipo'] ?>"  descripcion="<?php echo $value['descripcion'] ?>"> <?php echo $value["codigo_equipo"] ?></option>  
                <?php
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

          $editar = new Controladorregalo();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorregalo();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/regalo.js"></script>

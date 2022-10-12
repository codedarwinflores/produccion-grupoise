<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Uniforme";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_uniforme;
  $query = "SHOW COLUMNS FROM $nombretabla_uniforme";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaruniforme">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Tipo Uniforme</th>
            <th>Talla</th>
            <th>Estado</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladoruniforme::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["tipo_uniforme"].'</td>
                   <td>'.$value["talla"].'</td>
                   <td>'.$value["estado"].'</td>
                   <td>'.$value["precio"].'</td>
                   <td>'.$value["stock"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditaruniforme" iduniforme="'.$value["id"].'" data-toggle="modal" data-target="#modalEditaruniforme"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminaruniforme" iduniforme="'.$value["id"].'"  Codigo="'.$value["talla"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregaruniforme" class="modal fade" role="dialog">
  
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
            <div class="form-group grupo_<?php echo $row['Field'];?> ugrupo_<?php echo $row['Field'];?>  <?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>

              </div>

            </div>

          <?php
             }
          ?>
             
             <div class="input-group tipo_uniforme_s">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="nuevotipo_uniforme" required  id="" class="form-control input-lg nuevotipo_uniforme">
                  <option value="">Seleccionar Tipo Uniforme</option>
                  <option value="Camisa">Camisa</option>
                  <option value="Camiseta">Camiseta</option>
                  <option value="Pantalón">Pantalón</option>
                  <option value="Gorra">Gorra</option>
                </select>
             </div>

             <div class="input-group estado_uniforme">
                <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                <select name="nuevoestado" required  id="" class="form-control input-lg nuevoestado">
                  <option value="">Seleccionar Estado</option>
                  <option value="Usado">Usado</option>
                  <option value="Nuevo">Nuevo</option>
                </select>
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

          $crear = new Controladoruniforme();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditaruniforme" class="modal fade" role="dialog">
  
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
            <div class="form-group egrupo_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>
             
             
             <div class="input-group tipo_uniforme_s_editar">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editartipo_uniforme" required  id="editartipo_uniforme" class="form-control input-lg editartipo_uniforme">
                  <option value="">Seleccionar Tipo Uniforme</option>
                  <option value="Camisa">Camisa</option>
                  <option value="Camiseta">Camiseta</option>
                  <option value="Pantalón">Pantalón</option>
                  <option value="Gorra">Gorra</option>
                </select>
             </div>

             <div class="input-group estado_uniforme_editar">
                <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                <select name="editarestado" required  id="editarestado" class="form-control input-lg editarestado">
                  <option value="">Seleccionar Estado</option>
                  <option value="Usado">Usado</option>
                  <option value="Nuevo">Nuevo</option>
                </select>
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

          $editar = new Controladoruniforme();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladoruniforme();
  $borrar -> ctrBorrar();

?> 



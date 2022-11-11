<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="radio";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_radio;
  $query = "SHOW COLUMNS FROM $nombretabla_radio";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarradio">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Familia</th>
            <th>Tipo Radio</th>
            <th>Marca</th>
            <th>Número Serie</th>
            <th>Código</th>
            <th>Costo</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorradio::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["nombrefamilia"].'</td>
                   <td>'.$value["nombretiporadio"].'</td>
                   <td>'.$value["marca"].'</td>
                   <td>'.$value["numero_serie"].'</td>
                   <td>'.$value["codigo_radio"].'</td>
                   <td>'.$value["descripcion_radio"].'</td>
                   <td>'.$value["costo_radio"].'</td>
                   <td>'.$value["modelo_radio"].'</td>
                   <td>'.$value["color_radio"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarradio" idradios="'.$value["idradios"].'" data-toggle="modal" data-target="#modalEditarradio"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarradio" idradio="'.$value["idradios"].'"  Codigo="'.$value["marca"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarradio" class="modal fade" role="dialog">
  
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
            <div class="form-group grupo_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_radios" item_validar="codigo_radio">

              </div>

            </div>

            <script>
              /* *********LABEL*********** */
                var input_<?php echo $row['Field'];?> = $(".input_<?php echo $row['Field'];?>").attr("placeholder");
                $(".label_<?php echo $row['Field'];?>").text(input_<?php echo $row['Field'];?>);

            </script>
          <?php
             }
          ?>
             


             <div class="s_familia_r">
              <label for="">Seleccione Familia</label>
             <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoid_familia" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Familia</option>
                <?php
                    $datos_mostrar = Controladorfamilia::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
            </div>
            </div>

          <div class="r_tipo">
            <label for="">Seleccione Tipo radio</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="nuevoid_tipo_de_radio" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo radio</option>
                <?php
                    $datos_mostrar = Controladortiporadio::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
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

          $crear = new Controladorradio();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarradio" class="modal fade" role="dialog">
  
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
            <div class="form-group grupoeditar_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>
             

             
             <div class="r_familia_editar">
              <label for="">Seleccione Familia</label>
             <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="editarid_familia" id="editarid_familia" class="form-control input-lg" required>
                  <option value="">Seleccione Familia</option>
                <?php
                    $datos_mostrar = Controladorfamilia::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
            </div>
            </div>

          <div class="r_tipo_editar">
            <label for="">Seleccione Tipo radio</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editarid_tipo_de_radio" id="editarid_tipo_de_radio" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo radio</option>
                <?php
                    $datos_mostrar = Controladortiporadio::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
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

          $editar = new Controladorradio();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorradio();
  $borrar -> ctrBorrar();

?> 



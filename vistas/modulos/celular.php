<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Celular";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_celular;
  $query = "SHOW COLUMNS FROM $nombretabla_celular";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarcelular">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Código</th>
            <th>Descripcion</th>
            <th>Costo</th>
            <th>Numero</th>
            <th>SIM</th>
            <th>IMEI</th>
            <th>Operador</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Tipo Celular</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorcelular::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["codigocelular"].'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["costo"].'</td>
                   <td>'.$value["numero"].'</td>
                   <td>'.$value["simcelular"].'</td>
                   <td>'.$value["IMEI"].'</td>
                   <td>'.$value["operador"].'</td>
                   <td>'.$value["marca"].'</td>
                   <td>'.$value["modelo"].'</td>
                   <td>'.$value["color"].'</td>
                   <td>'.$value["nombretipocelular"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarcelular" idcelular="'.$value["idcelular"].'" data-toggle="modal" data-target="#modalEditarcelular"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarcelular" idcelular="'.$value["idcelular"].'"  Codigo="'.$value["codigocelular"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarcelular" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?>  grupocelular_<?php echo $row['Field'];?>">
              <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="celular" item_validar="codigo">

              </div>

            </div>


            
          <?php
             }
          ?>
             

             <div id="">
             <label for="" class="">Seleccione Tipo celular</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevotipocelular" id="" class="form-control input-lg " required>
                  <option value="">Seleccione Tipo celular</option>
                <?php
                    $datos_mostrar = Controladortipocelular::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" ><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>

             <div id="">
             <label for="" class="">Seleccione SIM</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevosim" id="nuevoscelular_sim" class="form-control input-lg ubicacioncid_cliente" required>
                  <option value="">Seleccione SIM</option>
                <?php
                    $datos_mostrar = Controladorsim::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" operador="<?php echo $value['operador'] ?>" imei="<?php echo $value['IMEI'] ?>"><?php echo $value["sim"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>

             <div class="form-group ">
              <label for="" class="">Operador</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" id="noperador"  class="form-control input-lg" placeholder="Operador"  readonly >
              </div>
            </div>

            <div class="form-group ">
              <label for="" class="">IMEI</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" id="nimei"  class="form-control input-lg" placeholder="IMEI"  readonly >
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

          $crear = new Controladorcelular();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarcelular" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?> egrupocelular_<?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>


<div id="">
             <label for="" class="">Seleccione Tipo celular</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editartipocelular" id="editartipocelular" class="form-control input-lg " required>
                  <option value="">Seleccione Tipo celular</option>
                <?php
                    $datos_mostrar = Controladortipocelular::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" ><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>


<div id="nuevooperador">
             <label for="" class="">Seleccione SIM</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editarsim" id="editarsim" class="form-control input-lg ubicacioncid_cliente" required>
                  <option value="">Seleccione SIM</option>
                <?php
                    $datos_mostrar = Controladorsim::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" operador="<?php echo $value['operador'] ?>" imei="<?php echo $value['IMEI'] ?>"><?php echo $value["sim"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>

             <div class="form-group ">
              <label for="" class="">Operador</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" id="eoperador"  class="form-control input-lg" placeholder="Operador"  readonly >
              </div>
            </div>

            <div class="form-group ">
              <label for="" class="">IMEI</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" id="eimei"  class="form-control input-lg" placeholder="IMEI"  readonly >
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

          $editar = new Controladorcelular();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorcelular();
  $borrar -> ctrBorrar();

?> 



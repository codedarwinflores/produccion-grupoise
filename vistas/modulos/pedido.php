<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Pedido";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_pedido;
  $query = "SHOW COLUMNS FROM $nombretabla_pedido";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarpedido">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorpedido::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha_pedido"].'</td>
                   <td>'.$value["id_proveedor"].'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["monto"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarpedido" idpedido="'.$value["idpedido"].'" data-toggle="modal" data-target="#modalEditarpedido"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarpedido" idpedido="'.$value["idpedido"].'"  Codigo="'.$value["descripcion"].'"><i class="fa fa-times"></i></button>


                       
                       <a class="btn btn-primary" href="pago?id='.$value["idpedido"].'"><i class="fa fa-eye"></i></a>
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

<div id="modalAgregarpedido" class="modal fade" role="dialog">
  
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

            
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_pedido form-control input-lg" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_pedido" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_pedido" name="nuevofecha_pedido" style="display: none;">
            </div>
         
          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group <?php echo $row['Field'];?>  grupopedido_<?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>

              </div>

            </div>

          <?php
             }
          ?>
             

             <div class="input-group proveedor_pedido_s">
                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                <select name="nuevoid_proveedor" id="" class="form-control input-lg sproveedor_pedido" required>
                  <option value="">Seleccione Proveedor</option>
                <?php
                    $datos_mostrar = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" ><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
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

          $crear = new Controladorpedido();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarpedido" class="modal fade" role="dialog">
  
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

            
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_pedido form-control input-lg" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_pedido" placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                <input type="text" class="oficial_editarfecha_pedido" name="editarfecha_pedido" style="display: none;" id="editarfecha_pedido">
            </div>


            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group <?php echo $row['Field'];?> egrupopedido_<?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>

             <div class="input-group eproveedor_pedido_s">
                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                <select name="editarid_proveedor" id="editarid_proveedor" class="form-control input-lg sproveedor_pedido" required>
                  <option value="">Seleccione Proveedor</option>
                <?php
                    $datos_mostrar = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" ><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
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

          $editar = new Controladorpedido();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorpedido();
  $borrar -> ctrBorrar();

?> 



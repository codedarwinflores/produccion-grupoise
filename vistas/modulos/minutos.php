<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="minutos";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_minutos;
  $query = "SHOW COLUMNS FROM $nombretabla_minutos";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="clientes" class="btn btn-danger">Volver</a>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarminutos">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Minutos Desde</th>
            <th>Minutos Hasta</th>
            <th>Valor</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
         $id = $_GET['id'];
 
      
      function cliente($id) {
        $query = "SELECT*FROM clientes where id=$id";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();			
        return $sql->fetchAll();
      };
      $data01 = cliente($id);
      foreach($data01 as $value) {
      echo "<h4>".$value["nombre"]."<h4>";
      }

         
         function minutos($idcliente) {
          $query = "SELECT*FROM minutos where id_cliente_minutos=$idcliente";
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();			
          return $sql->fetchAll();
        };
        $data01 = minutos($id);
        foreach($data01 as $value) {
          
           echo ' <tr>
                   <td>'.$value["minutos_desde"].'</td>
                   <td>'.$value["minutos_hasta"].'</td>
                   <td>'.$value["valor_minutos"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarminutos" idminutos="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarminutos"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarminutos" idminutos="'.$value["id"].'"  Codigo="'.$value["id_cliente_minutos"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarminutos" class="modal fade" role="dialog">
  
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



          <!-- *********** -->
                <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
              


            <div class="form-group   grupominutos_minutos_desde" bis_skin_checked="1">
              <label for="" class="">Minutos Desde</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_minutos_desde"></i></span> 
                <input type="text" class="form-control input-lg input_minutos_desde" name="nuevominutos_desde" id="nuevominutos_desde" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
              </div>
            </div>

            <div class="form-group   grupominutos_minutos_hasta" bis_skin_checked="1">
              <label for="" class="">Minutos Hasta</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_minutos_hasta"></i></span> 
                <input type="text" class="form-control input-lg input_minutos_hasta" name="nuevominutos_hasta" id="nuevominutos_hasta" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
              </div>
            </div>

            <div class="form-group   grupominutos_valor_minutos" bis_skin_checked="1">
              <label for="" class="">Valor</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_valor_minutos"></i></span> 
                <input type="text" class="form-control input-lg input_valor_minutos" name="nuevovalor_minutos" id="nuevovalor_minutos" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
              </div>
            </div>

            <input type="hidden" class="form-control input-lg input_id_cliente_minutos" name="nuevoid_cliente_minutos" id="nuevoid_cliente_minutos" placeholder="" value="" autocomplete="off" required="">
              
          <!-- ********** -->
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

          $crear = new Controladorminutos();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarminutos" class="modal fade" role="dialog">
  
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




          <!-- *********** -->
          <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
              


              <div class="form-group   grupominutos_minutos_desde" bis_skin_checked="1">
                <label for="" class="">Minutos Desde</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_minutos_desde"></i></span> 
                  <input type="text" class="form-control input-lg input_minutos_desde" name="editarminutos_desde" id="editarminutos_desde" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                </div>
              </div>
  
              <div class="form-group   grupominutos_minutos_hasta" bis_skin_checked="1">
                <label for="" class="">Minutos Hasta</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_minutos_hasta"></i></span> 
                  <input type="text" class="form-control input-lg input_minutos_hasta" name="editarminutos_hasta" id="editarminutos_hasta" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                </div>
              </div>
  
              <div class="form-group   grupominutos_valor_minutos" bis_skin_checked="1">
                <label for="" class="">Valor</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_valor_minutos"></i></span> 
                  <input type="text" class="form-control input-lg input_valor_minutos" name="editarvalor_minutos" id="editarvalor_minutos" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                </div>
              </div>
  
              <input type="hidden" class="form-control input-lg input_id_cliente_minutos" name="editarid_cliente_minutos" id="editarid_cliente_minutos" placeholder="" value="" autocomplete="off" required="">
                
            <!-- ********** -->

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

          $editar = new Controladorminutos();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorminutos();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/minutos.js"></script>

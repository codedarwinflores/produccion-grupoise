<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Series";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_series_ventas;
  $query = "SHOW COLUMNS FROM $nombretabla_series_ventas";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarseries_ventas">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Tipo</th>
            <th>Serie</th>
            <th>Cuenta Contable</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorseries_ventas::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["tipo_serie"].'</td>
                   <td>'.$value["num_serie"].'</td>
                   <td>'.$value["cuenta_contable"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarseries_ventas" idseries_ventas="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarseries_ventas"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarseries_ventas" idseries_ventas="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarseries_ventas" class="modal fade" role="dialog">
  
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

            <div class="form-group   gruposeries_ventas_tipo_serie" bis_skin_checked="1">
              <label for="" class="">Tipo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_tipo_serie"></i></span> 
                <input type="text" class="form-control input-lg input_tipo_serie" name="nuevotipo_serie" id="nuevotipo_serie" placeholder="" value="" autocomplete="off" required="">
              </div>
            </div>

            <div class="form-group   gruposeries_ventas_num_serie" bis_skin_checked="1">
              <label for="" class="">Serie</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_num_serie"></i></span> 
                <input type="text" class="form-control input-lg input_num_serie" name="nuevonum_serie" id="nuevonum_serie" placeholder="" value="" autocomplete="off" required="">
              </div>
            </div>

            
            <div class="form-group   gruposeries_ventas_tipo_serie" bis_skin_checked="1">
              <label for="" class="">Cuenta Contable</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_tipo_serie"></i></span> 
                <input type="text" class="form-control input-lg input_tipo_serie" name="nuevocuenta_contable" id="nuevocuenta_contable" placeholder="" value="" autocomplete="off" required="">
              </div>
            </div>
          
           <!-- ********************* -->
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

          $crear = new Controladorseries_ventas();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarseries_ventas" class="modal fade" role="dialog">
  
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

            
            <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">

            <div class="form-group   gruposeries_ventas_tipo_serie" bis_skin_checked="1">
              <label for="" class="">Tipo</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_tipo_serie"></i></span> 
                <input type="text" class="form-control input-lg input_tipo_serie" name="editartipo_serie" id="editartipo_serie" placeholder="" value="" autocomplete="off" required="">
              </div>
            </div>

            <div class="form-group   gruposeries_ventas_num_serie" bis_skin_checked="1">
              <label for="" class="">Serie</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_num_serie"></i></span> 
                <input type="text" class="form-control input-lg input_num_serie" name="editarnum_serie" id="editarnum_serie" placeholder="" value="" autocomplete="off" required="">
              </div>
            </div>


            <div class="form-group   gruposeries_ventas_tipo_serie" bis_skin_checked="1">
              <label for="" class="">Cuenta Contable</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_tipo_serie"></i></span> 
                <input type="text" class="form-control input-lg input_tipo_serie" name="editarcuenta_contable" id="editarcuenta_contable" placeholder="" value="" autocomplete="off" required="">
              </div>
            </div>
            <!-- ******************* -->
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

          $editar = new Controladorseries_ventas();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorseries_ventas();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/series.js"></script>

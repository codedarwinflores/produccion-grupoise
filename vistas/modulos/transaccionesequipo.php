<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Transancciones de Equipo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_transaccionesequipo;
  $query = "SHOW COLUMNS FROM $nombretabla_transaccionesequipo";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregartransaccionesequipo">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Código</th>
            <th>Transacciones Equipo</th>
            <th>Tipo de Transancción</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladortransaccionesequipo::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["codigo"].'</td>
                   <td>'.$value["nombre"].'</td>
                   <td>'.$value["tipo_transaccion_equipo"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditartransaccionesequipo" idtransaccionesequipo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditartransaccionesequipo"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminartransaccionesequipo" idtransaccionesequipo="'.$value["id"].'"  Codigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregartransaccionesequipo" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_transacciones_equipo" item_validar="codigo">

              </div>

            </div>

            
          <?php
             }
          ?>
             
                          <!-- ****** -->

             
                          <?php
                
                function ObtenerCorrelativo() {
                  $query = "select numero_transaccion_equipo from tbl_transacciones_equipo order by id desc limit 1";
                  $sql = Conexion::conectar()->prepare($query);
                  $sql->execute();			
                  return $sql->fetchAll();
                };

                
              $data0 = ObtenerCorrelativo();
              foreach($data0 as $row0) {
                $numero = $row0['numero_transaccion_equipo'];
            
                $addnumber= $numero+1;


                $correlativo = sprintf("%09d",$addnumber);
                
                /* echo $correlativo; */
                $html="<script>";
                $html.="$(document).ready(function(){";
                  $html.="$('.nuevonumero_transaccion_equipo').val('".$correlativo."');";
                  $html.="$('.editarnumero_transaccion_equipo').val('".$correlativo."');";
                 
                $html.="});";
                $html.="</script>";
                echo $html;
              }
            ?>

              <input type="hidden" name="nuevonumero_transaccion_equipo" class="nuevonumero_transaccion_equipo"/>

         <!-- ****** -->


             <div id="">
             <label for="" class="">Seleccione Tipo de Transacción</label> 
            
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevotipo_transaccion_equipo" id="" class="form-control input-lg" required>
                <option value="">Seleccione Tipo de Transacción</option>
                <option value="Aumenta">Aumenta</option>
                <option value="Disminuye">Disminuye</option>
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

          $crear = new Controladortransaccionesequipo();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartransaccionesequipo" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>

              <input type="hidden" name="editarnumero_transaccion_equipo" id="editarnumero_transaccion_equipo" class=""/>

             
             <div id="">
             <label for="" class="">Seleccione Tipo de Transacción</label> 
            
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editartipo_transaccion_equipo" id="editartipo_transaccion_equipo" class="form-control input-lg" required>
                <option value="">Seleccione Tipo de Transacción</option>
                <option value="Aumenta">Aumenta</option>
                <option value="Disminuye">Disminuye</option>
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

          $editar = new Controladortransaccionesequipo();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladortransaccionesequipo();
  $borrar -> ctrBorrar();

?> 



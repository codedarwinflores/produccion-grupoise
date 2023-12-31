<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Transacciones Personal";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_transaccionespersonal;
  $query = "SHOW COLUMNS FROM $nombretabla_transaccionespersonal";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregartransaccionespersonal">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Código</th>
            <th>Nombre</th>
            <th>Tipo de Movimiento</th>
            <th>¿Requiere devolución de uniforme?</th>
            <th>¿Cubrir Vacante?</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladortransaccionespersonal::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["codigo"].'</td>
                   <td>'.$value["nombre"].'</td>
                   <td>'.$value["tipo_movimiento_personal"].'</td>
                   <td>'.$value["devolucion"].'</td>
                   <td>'.$value["cubrir_vacante"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditartransaccionespersonal" idtransaccionespersonal="'.$value["id"].'" data-toggle="modal" data-target="#modalEditartransaccionespersonal"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminartransaccionespersonal" idtransaccionespersonal="'.$value["id"].'"  Codigo="'.$value["nombre"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregartransaccionespersonal" class="modal fade" role="dialog">
  
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
         <label for="" class="personallabel_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg personalinput_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_transacciones_personal" item_validar="codigo">

              </div>

            </div>


          <?php
             }
          ?>
             
             
                          <!-- ****** -->

             
                          <?php
                
                              function ObtenerCorrelativo() {
                                $query = "select numero_transaccion_personal from tbl_transacciones_personal order by id desc limit 1";
                                $sql = Conexion::conectar()->prepare($query);
                                $sql->execute();			
                                return $sql->fetchAll();
                              };

                              
                            $data0 = ObtenerCorrelativo();
                            $correlativo="";
                            foreach($data0 as $row0) {
                              $numero = $row0['numero_transaccion_personal'];
                          
                              $addnumber= $numero+1;


                              $correlativo = sprintf("%09d",$addnumber);
                              
                              /* echo $correlativo; */
                              
                            }
                            if($correlativo==""){
                              $correlativo = sprintf("%09d",1);

                            }
                            $html="<script>";
                              $html.="$(document).ready(function(){";
                                $html.="$('.nuevonumero_transaccion_personal').val('".$correlativo."');";
                                $html.="$('.editarnumero_transaccion_personal').val('".$correlativo."');";
                              
                              $html.="});";
                              $html.="</script>";
                              echo $html;
                          ?>

                     <input type="hidden" name="nuevonumero_transaccion_personal" class="nuevonumero_transaccion_personal"/>

         <!-- ****** -->


             
             <div id="">
             <label for="" class="">¿Requiere devolución de uniforme?</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevodevolucion" id="" class="form-control input-lg" required>
                <option value="">¿Requiere devolución de uniforme?</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>
             </div>


             <div id="">
             <label for="" class="">¿Cubrir vacante? </label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevocubrir_vacante" id="" class="form-control input-lg" required>
                <option value="">¿Cubrir vacante? </option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>
             </div>


             <!-- <div id="">
             <label for="" class="">Seleccione Tipo de Movimiento</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevotipo_movimiento_personal" id="" class="form-control input-lg" required>
                <option value="">Seleccione Tipo de Movimiento</option>
                <option value="Ingreso">Ingreso</option>
                <option value="Egreso">Egreso</option>
              </select>
             </div>
             </div> -->

             <?php
                    function tipo_nuevo() {
                      $query = "select * from ajustes where name_table='tbl_transacciones_personal' and accion='nuevo'
                      ";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = tipo_nuevo();
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

          <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladortransaccionespersonal();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartransaccionespersonal" class="modal fade" role="dialog">
  
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
         <label for="" class="personallabel_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg epersonalinput_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>
             
             

             <input type="hidden" name="editarnumero_transaccion_personal" class="editarnumero_transaccion_personal" id="editarnumero_transaccion_personal"/>
             
             
             <div id="">
             <label for="" class="">¿Requiere devolución de uniforme?</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editardevolucion" id="editardevolucion" class="form-control input-lg" required>
                <option value="">¿Requiere devolución de uniforme?</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>
             </div>


             <div id="">
             <label for="" class="">¿Cubrir vacante? </label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editarcubrir_vacante" id="editarcubrir_vacante" class="form-control input-lg" required>
                <option value="">¿Cubrir vacante? </option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>
             </div>




             <!-- <div id="">
             <label for="" class="">Seleccione Tipo de Movimiento</label> 
            
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editartipo_movimiento_personal" id="editartipo_movimiento_personal" class="form-control input-lg" required>
                <option value="">Seleccione Tipo de Movimiento</option>
                <option value="Ingreso">Ingreso</option>
                <option value="Egreso">Egreso</option>
              </select>
             </div>
             </div> -->

             
             <?php
                    function tipo_editar() {
                      $query = "select * from ajustes where name_table='tbl_transacciones_personal' and accion='editar'
                      ";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = tipo_editar();
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

          $editar = new Controladortransaccionespersonal();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladortransaccionespersonal();
  $borrar -> ctrBorrar();

?> 



<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Vehiculo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_vehiculo;
  $query = "SHOW COLUMNS FROM $nombretabla_vehiculo";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarvehiculo">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Familia</th>
            <th>Tipo Vehículo</th>
            <th>Número Chasis</th>
            <th>Número Motor</th>
            <th>Capacidad</th>
            <th>Logotipo</th>
            <th>Nombre entidad</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Placa</th>
            <th>Color</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorvehiculo::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["nombrefamiliaoriginal"].'</td>
                   <td>'.$value["nombre_tipo"].'</td>
                   <td>'.$value["numero_chasis"].'</td>
                   <td>'.$value["numero_motor"].'</td>
                   <td>'.$value["capacidad"].'</td>
                   <td>'.$value["tiene_logotipo"].'</td>
                   <td>'.$value["tiene_nombre_entidad"].'</td>
                   <td>'.$value["marca"].'</td>
                   <td>'.$value["modelo"].'</td>
                   <td>'.$value["anio"].'</td>
                   <td>'.$value["placa"].'</td>
                   <td>'.$value["color"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarvehiculo" idvehiculo="'.$value["idvehiculos"].'" data-toggle="modal" data-target="#modalEditarvehiculo"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarvehiculo" idvehiculo="'.$value["idvehiculos"].'"  Codigo="'.$value["numero_chasis"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarvehiculo" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?>  grupovehiculo_<?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>

              </div>

            </div>

          <?php
             }
          ?>
             

             <div class="input-group" id="ntiene_logotipo">
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevotiene_logotipo" id="" class="form-control input-lg" required>
                <option value="">¿Tiene Logotipo?</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>

             <div class="input-group" id="ntiene_nombre_entidad">
              <span class="input-group-addon"><i class="fa fa-book"></i></span> 
              <select name="nuevotiene_nombre_entidad" id="" class="form-control input-lg" required>
                <option value="">¿Tiene Nombre Entidad?</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>

             <div class="input-group s_familia_vehiculo">
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

            <div class="input-group s_tipo_vehiculo">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="nuevoid_tipo_vehiculo" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Vehículo</option>
                <?php
                    $datos_mostrar = Controladortipovehiculo::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre_tipo"] ?></option>  
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

          $crear = new Controladorvehiculo();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarvehiculo" class="modal fade" role="dialog">
  
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
            <div class="form-group <?php echo $row['Field'];?> egrupovehiculo_<?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>



<div class="input-group" id="etiene_logotipo">
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editartiene_logotipo" id="editartiene_logotipo" class="form-control input-lg" required>
                <option value="">¿Tiene Logotipo?</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>

             <div class="input-group" id="etiene_nombre_entidad">
              <span class="input-group-addon"><i class="fa fa-book"></i></span> 
              <select name="editartiene_nombre_entidad" id="editartiene_nombre_entidad" class="form-control input-lg" required>
                <option value="">¿Tiene Nombre Entidad?</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
              </select>
             </div>

             <div class="input-group es_familia_vehiculo">
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

            <div class="input-group es_tipo_vehiculo">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editarid_tipo_vehiculo" id="editarid_tipo_vehiculo" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Vehículo</option>
                <?php
                    $datos_mostrar = Controladortipovehiculo::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre_tipo"] ?></option>  
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

          $editar = new Controladorvehiculo();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorvehiculo();
  $borrar -> ctrBorrar();

?> 


<script>
  /* COLOCACION DE ICONOS */
$(document).ready(function(){

    var  texto= "Ingresar";

    /* grupovehiculo_ */
    /* input_ */
    /* $(".input_"). */

    $(".input_id").removeAttr("required");

    $(".grupovehiculo_tiene_logotipo").empty();
    $('.grupovehiculo_tiene_logotipo').append($('#ntiene_logotipo'));

    $(".grupovehiculo_tiene_nombre_entidad").empty();
    $('.grupovehiculo_tiene_nombre_entidad').append($('#ntiene_nombre_entidad'));

    
    $(".grupovehiculo_id_familia").empty();
    $('.grupovehiculo_id_familia').append($('.s_familia_vehiculo'));

    
    $(".grupovehiculo_id_tipo_vehiculo").empty();
    $('.grupovehiculo_id_tipo_vehiculo').append($('.s_tipo_vehiculo'));


    /* editar */


    $(".egrupovehiculo_tiene_logotipo").empty();
    $('.egrupovehiculo_tiene_logotipo').append($('#etiene_logotipo'));

    $(".egrupovehiculo_tiene_nombre_entidad").empty();
    $('.egrupovehiculo_tiene_nombre_entidad').append($('#etiene_nombre_entidad'));


        
    $(".egrupovehiculo_id_familia").empty();
    $('.egrupovehiculo_id_familia').append($('.es_familia_vehiculo'));

    
    $(".egrupovehiculo_id_tipo_vehiculo").empty();
    $('.egrupovehiculo_id_tipo_vehiculo').append($('.es_tipo_vehiculo'));







    $(".icono_numero_chasis").addClass("fa  fa-address-card");
    $(".input_numero_chasis").attr("placeholder", texto+" Número Chasis");


    $(".icono_numero_motor").addClass("fa fa-bandcamp");
    $(".input_numero_motor").attr("placeholder", texto+" Número Motor");


    $(".icono_capacidad").addClass("fa fa-bus");
    $(".input_capacidad").attr("placeholder", texto+" Capacidad");


    $(".icono_tiene_logotipo").addClass("fa fa-hand-paper-o");
    $(".input_tiene_logotipo").attr("placeholder", texto+" Logotipo");






    $(".icono_anio").addClass("fa fa-braille");
    $(".input_anio").attr("placeholder", texto+" Año");


    $(".icono_placa").addClass("fa fa-address-card");
    $(".input_placa").attr("placeholder", texto+" Placa");


    $(".icono_color").addClass("fa fa-spinner");
    $(".input_color").attr("placeholder", texto+" Color");





    })
</script>
<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Daños y Extravios";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_extravios;
  $query = "SHOW COLUMNS FROM $nombretabla_extravios";
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
                  
              <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarextravios">
                Agregar <?php echo $Nombre_del_Modulo;?>
              </button>
          </div>
          <div class="col-md-6" align="right">
              <a href="empleados" class="btn btn-primary">Volver</a>
          </div>
          <div class="col-md-12">
            <h3 class="nombreempleado">Empleado: </h3>
          </div>
        </div>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha</th>
            <th>Descuento</th>
            <th>Valor</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorextravios::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha_extravio"].'</td>
                   <td>'.$value["descuento_extravio"].'</td>
                   <td>'.$value["valor_extravio"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarextravios" idextravios="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarextravios"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarextravios" idextravios="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarextravios" class="modal fade" role="dialog">
  
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

            <div class="form-group id  grupoextravios_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" name="nuevoid" placeholder="" value="" autocomplete="off">

              </div>

            </div>

            <div class="form-group fecha_extravio  grupoextravios_fecha_extravio" bis_skin_checked="1">
              <label for="" class="label_fecha_extravio">Fecha Daño o Extravio</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha_extravio"></i></span> 

                <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
                <input type="text" class="form-control input-lg input_fecha_extravio calendario" name="nuevofecha_extravio" id="" placeholder="Fecha Daño o Extravio" value="" autocomplete="off" required="">

              </div>

            </div>

            <div class="form-group descuento_extravio  grupoextravios_descuento_extravio" bis_skin_checked="1">
              <label for="" class="label_descuento_extravio">Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_descuento_extravio"></i></span> 

                <select  class="form-control input-lg input_descuento_extravio" name="nuevodescuento_extravio" id="" placeholder="Descuento" value="" autocomplete="off" required="">
                <option value="">Seleccione Descuento</option>
                <?php
                    $datos_mostrar = ControladorDescuentos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo'] ?>" ><?php echo $value['codigo'] ?></option>  
                <?php
                    }
                  ?>
                </select>

              </div>

            </div>

            <div class="form-group valor_extravio  grupoextravios_valor_extravio" bis_skin_checked="1">
              <label for="" class="label_valor_extravio">Valor del Extravio</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_valor_extravio"></i></span> 

                <input type="text" class="form-control input-lg input_valor_extravio" name="nuevovalor_extravio" id="" placeholder="Valor del Extravio" value="" autocomplete="off" required="">

              </div>

            </div>


            <input type="hidden" class="form-control input-lg input_idempleado_extravio" name="nuevoidempleado_extravio" placeholder="" value="" autocomplete="off" required="">



            <!-- ************** -->



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

          $crear = new Controladorextravios();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarextravios" class="modal fade" role="dialog">
  
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

            <!-- ****** -->

            


            <div class="form-group id  grupoextravios_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">

              </div>

            </div>

            <div class="form-group fecha_extravio  grupoextravios_fecha_extravio" bis_skin_checked="1">
              <label for="" class="label_fecha_extravio">Fecha Daño o Extravio</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha_extravio"></i></span> 

                <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
                <input type="text" class="form-control input-lg input_fecha_extravio calendario" name="editarfecha_extravio" id="editarfecha_extravio" placeholder="Fecha Daño o Extravio" value="" autocomplete="off" required="">

              </div>

            </div>

            <div class="form-group descuento_extravio  grupoextravios_descuento_extravio" bis_skin_checked="1">
              <label for="" class="label_descuento_extravio">Descuento</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_descuento_extravio"></i></span> 

                <select  class="form-control input-lg input_descuento_extravio" name="editardescuento_extravio" id="editardescuento_extravio" placeholder="Descuento" value="" autocomplete="off" required="">
                <option value="">Seleccione Descuento</option>
                <?php
                    $datos_mostrar = ControladorDescuentos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo'] ?>" ><?php echo $value['codigo'] ?></option>  
                <?php
                    }
                  ?>
                </select>

              </div>

            </div>

            <div class="form-group valor_extravio  grupoextravios_valor_extravio" bis_skin_checked="1">
              <label for="" class="label_valor_extravio">Valor del Extravio</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_valor_extravio"></i></span> 

                <input type="text" class="form-control input-lg input_valor_extravio" name="editarvalor_extravio" id="editarvalor_extravio" placeholder="Valor del Extravio" value="" autocomplete="off" required="">

              </div>

            </div>


            <input type="hidden" class="form-control input-lg input_idempleado_extravio" name="editaridempleado_extravio" id="editaridempleado_extravio" placeholder="" value="" autocomplete="off" required="">


            <!--  ******* -->
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

          $editar = new Controladorextravios();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorextravios();
  $borrar -> ctrBorrar();

?> 



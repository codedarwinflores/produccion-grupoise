<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Personal no Contratable";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_personal_no_contratable;
  $query = "SHOW COLUMNS FROM $nombretabla_personal_no_contratable";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarpersonal_no_contratable">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Correlativo</th>
            <th>Nombres</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>DUI</th>
            <th>Fecha</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorpersonal_no_contratable::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["correlativo"].'</td>
                   <td>'.$value["nombres"].'</td>
                   <td>'.$value["primer_apellido"].'</td>
                   <td>'.$value["segundo_apellido"].'</td>
                   <td>'.$value["dui"].'</td>
                   <td>'.$value["fecha"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarpersonal_no_contratable" idpersonal_no_contratable="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarpersonal_no_contratable"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarpersonal_no_contratable" idpersonal_no_contratable="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarpersonal_no_contratable" class="modal fade" role="dialog">
  
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
          <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
  
            <!-- ENTRADA PARA CAMPOS  -->


            <div class="form-group id  grupopersonal_no_contratable_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" name="nuevoid" placeholder="" value="" autocomplete="off">

              </div>

            </div>

            <div class="form-group correlativo  grupopersonal_no_contratable_correlativo" bis_skin_checked="1">
              <label for="" class="label_correlativo">Ingrese Correlativo</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_correlativo fa  fa-signal"></i></span> 

                <input type="text" class="form-control input-lg input_correlativo input_correlativo_lista" name="nuevocorrelativo" placeholder="Ingrese Correlativo" value="" autocomplete="off" required="" >

              </div>

            </div>

            <div class="form-group nombres  grupopersonal_no_contratable_nombres" bis_skin_checked="1">
              <label for="" class="label_nombres">Ingrese Nombres Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_nombres fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg input_nombres" name="nuevonombres" placeholder="Ingrese Nombres Empleado" value="" autocomplete="off" required="">

              </div>

            </div>

            <div class="form-group primer_apellido  grupopersonal_no_contratable_primer_apellido" bis_skin_checked="1">
              <label for="" class="label_primer_apellido">Ingrese Primer Apellido Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_primer_apellido fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg input_primer_apellido" name="nuevoprimer_apellido" placeholder="Ingrese Primer Apellido Empleado" value="" autocomplete="off" required="">

              </div>

            </div>

            <div class="form-group segundo_apellido  grupopersonal_no_contratable_segundo_apellido" bis_skin_checked="1">
              <label for="" class="label_segundo_apellido">Ingrese Segundo Apellido Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_segundo_apellido fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg input_segundo_apellido" name="nuevosegundo_apellido" placeholder="Ingrese Segundo Apellido Empleado" value="" autocomplete="off" required="">

              </div>

            </div>

            <div class="form-group dui  grupopersonal_no_contratable_dui" bis_skin_checked="1">
              <label for="" class="label_dui">Ingrese DUI Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_dui fa  fa-address-card"></i></span> 

                <input type="text" class="form-control input-lg input_dui duis" name="nuevodui" placeholder="Ingrese DUI Empleado" value="" autocomplete="off" required="">

              </div>

            </div>

            <div class="form-group fecha  grupopersonal_no_contratable_fecha" bis_skin_checked="1">
              <label for="" class="label_fecha">Ingresar Fecha</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg input_fecha calendario" name="nuevofecha" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly="readonly">

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

          $crear = new Controladorpersonal_no_contratable();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarpersonal_no_contratable" class="modal fade" role="dialog">
  
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

            
            <div class="form-group id  grupopersonal_no_contratable_id" bis_skin_checked="1">
              <label for="" class="label_id"></label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_id"></i></span> 

                <input type="text" class="form-control input-lg input_id" name="editarid" placeholder="" value="" autocomplete="off" id="editarid">

              </div>

            </div>

            <div class="form-group correlativo  grupopersonal_no_contratable_correlativo" bis_skin_checked="1">
              <label for="" class="label_correlativo">Ingrese Correlativo</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_correlativo fa  fa-signal"></i></span> 

                <input type="text" class="form-control input-lg input_correlativo input_correlativo_lista" name="editarcorrelativo" placeholder="Ingrese Correlativo" value="" autocomplete="off" required="" id="editarcorrelativo" >

              </div>

            </div>

            <div class="form-group nombres  grupopersonal_no_contratable_nombres" bis_skin_checked="1">
              <label for="" class="label_nombres">Ingrese Nombres Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_nombres fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg input_nombres" name="editarnombres" placeholder="Ingrese Nombres Empleado" value="" autocomplete="off" required="" id="editarnombres">

              </div>

            </div>

            <div class="form-group primer_apellido  grupopersonal_no_contratable_primer_apellido" bis_skin_checked="1">
              <label for="" class="label_primer_apellido">Ingrese Primer Apellido Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_primer_apellido fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg input_primer_apellido" name="editarprimer_apellido" placeholder="Ingrese Primer Apellido Empleado" value="" autocomplete="off" required="" id="editarprimer_apellido">

              </div>

            </div>

            <div class="form-group segundo_apellido  grupopersonal_no_contratable_segundo_apellido" bis_skin_checked="1">
              <label for="" class="label_segundo_apellido">Ingrese Segundo Apellido Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_segundo_apellido fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg input_segundo_apellido" name="editarsegundo_apellido" placeholder="Ingrese Segundo Apellido Empleado" value="" autocomplete="off" required="" id="editarsegundo_apellido">

              </div>

            </div>

            <div class="form-group dui  grupopersonal_no_contratable_dui" bis_skin_checked="1">
              <label for="" class="label_dui">Ingrese DUI Empleado</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_dui fa  fa-address-card"></i></span> 

                <input type="text" class="form-control input-lg input_dui duis" name="editardui" placeholder="Ingrese DUI Empleado" value="" autocomplete="off" required="" id="editardui">

              </div>

            </div>

            <div class="form-group fecha  grupopersonal_no_contratable_fecha" bis_skin_checked="1">
              <label for="" class="label_fecha">Ingresar Fecha</label> 
              
              <div class="input-group" bis_skin_checked="1">
              
                <span class="input-group-addon"><i class="icono_fecha fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg input_fecha calendario" name="editarfecha" placeholder="Ingresar Fecha" value="" autocomplete="off" required="" readonly="readonly" id="editarfecha">

              </div>

            </div>

          
            <!-- ******************** -->
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

          $editar = new Controladorpersonal_no_contratable();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorpersonal_no_contratable();
  $borrar -> ctrBorrar();

?> 


<script src="vistas/js/personalnocontratable.js"></script>

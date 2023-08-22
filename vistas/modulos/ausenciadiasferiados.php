<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Ausencia";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_ausenciadiasferiados;
  $query = "SHOW COLUMNS FROM $nombretabla_ausenciadiasferiados";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarausenciadiasferiados">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Empleado</th>
            <th>Dia de ausencia</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorausenciadiasferiados::ctrMostrar($item, $valor);

         function empleados_filtro($id1) {
          $query = "SELECT * FROM `tbl_empleados`WHERE id='$id1'";
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();			
          return $sql->fetchAll();
          };
 
        foreach ($bancos as $key => $value){
          

          $data_empleados = empleados_filtro($value["empleado_ausencia"]);
          $nombre_empleado="";
          foreach($data_empleados as $value_empleado) {
          $nombre_empleado.=$value_empleado["codigo_empleado"].'-'.$value_empleado["primer_nombre"].' '.$value_empleado["segundo_nombre"].' '.$value_empleado["primer_apellido"];
          }  
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$nombre_empleado.'</td>
                   <td>'.$value["fecha_feriado"].'</td>';

                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarausenciadiasferiados" idausenciadiasferiados="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarausenciadiasferiados"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarausenciadiasferiados" idausenciadiasferiados="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarausenciadiasferiados" class="modal fade" role="dialog">
  
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
              

            <div class="form-group   grupoausenciadiasferiados_empleado_ausencia">
              <label for="" class="">Seleccione al Empleado</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_empleado_ausencia"></i></span> 
                
                <select name="nuevoempleado_ausencia" id="nuevoempleado_ausencia" class="form-control mi-selector" >
                    <option value="*"> Seleccionar Empleados</option>
                         <?php
                             function empleados() {
                                $query = "SELECT * FROM `tbl_empleados`order by id ASC";
                                $sql = Conexion::conectar()->prepare($query);
                                $sql->execute();			
                                return $sql->fetchAll();
                                };
                              $data_empleado = empleados();
                              foreach($data_empleado as $value) {
                                  echo "<option value=".$value["id"].">".$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"]."</option>";
                                    }
                          ?>
                  </select>

              </div>
            </div>


            <div class="form-group   grupoausenciadiasferiados_fecha_feriado">
              <label for="" class="">Fecha ausencia</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_fecha_feriado"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_feriado calendario" name="nuevofecha_feriado" id="nuevofecha_feriado" placeholder="" value="" autocomplete="off" required="" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY">
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

          $crear = new Controladorausenciadiasferiados();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarausenciadiasferiados" class="modal fade" role="dialog">
  
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
              

              <div class="form-group   grupoausenciadiasferiados_empleado_ausencia">
                <label for="" class="">Seleccione al Empleado</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_empleado_ausencia"></i></span> 
                  
                  <select name="editarempleado_ausencia" id="editarempleado_ausencia" class="form-control mi-selector" >
                      <option value="*"> Seleccionar Empleados</option>
                           <?php
                                $data_empleado = empleados();
                                foreach($data_empleado as $value) {
                                    echo "<option value=".$value["id"].">".$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"]."</option>";
                                      }
                            ?>
                    </select>
  
                </div>
              </div>
  
  
              <div class="form-group   grupoausenciadiasferiados_fecha_feriado">
                <label for="" class="">Fecha ausencia</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="icono_fecha_feriado"></i></span> 
                  <input type="text" class="form-control input-lg input_fecha_feriado calendario" name="editarfecha_feriado" id="editarfecha_feriado" placeholder="" value="" autocomplete="off" required="" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY">
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

          $editar = new Controladorausenciadiasferiados();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorausenciadiasferiados();
  $borrar -> ctrBorrar();

?> 



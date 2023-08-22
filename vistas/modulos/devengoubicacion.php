<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Devengo Ubicación";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_devengoubicacion;
  $query = "SHOW COLUMNS FROM $nombretabla_devengoubicacion";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);

$idhistorial0 = $results['id'];

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="descuentos" class="btn btn-danger">Volver</a>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregardevengoubicacion">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Código Ubicación</th>
            <th>Nombre Ubicación</th>
            <th>Periodo</th>
            <th>Valor</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladordevengoubicacion::ctrMostrar($item, $valor);

         function mostrardevengo($ids) {
          $query01 = "SELECT * FROM `tbl_devengo_ubicacion` WHERE iddescuentodevengo=$ids";
          $sql = Conexion::conectar()->prepare($query01);
          $sql->execute();			
          return $sql->fetchAll();
          }

          $data01 = mostrardevengo($idhistorial0);
 
        foreach ($data01 as $value){
          
           echo ' <tr>
                   <td>'.$value["codigo_devengo_ubicacion"].'</td>
                   <td>'.$value["nombre_devengo_ubicacion"].'</td>
                   <td>'.$value["periodo_devengo_ubicacion"].'</td>
                   <td>'.$value["valor_devengo_ubicacion"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditardevengoubicacion" iddevengoubicacion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditardevengoubicacion"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminardevengoubicacion" iddevengoubicacion="'.$value["id"].'" Codigo="'.$value["iddescuentodevengo"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregardevengoubicacion" class="modal fade" role="dialog">
  
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
            <div class="form-group">
              <label for="" class="">Nombre Ubicación</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="nuevonombre_devengo_ubicacion" id="nuevonombre_devengo_ubicacion" class="form-control input-lg mi-selector nuevonombre_devengo_ubicacion" required >
                      <option value="">Seleccione Ubicación</option>
                      <?php 
                                   function tblempleados() {
                                     $query01 = "SELECT * FROM `tbl_clientes_ubicaciones`";
                                     $sql = Conexion::conectar()->prepare($query01);
                                     $sql->execute();			
                                     return $sql->fetchAll();
                                     }

                                     $data01 = tblempleados();
                                     foreach($data01 as $row) {
                                        echo "<option idubicacion='".$row["id"]."' codigo='".$row["codigo_ubicacion"]."' value='".$row["nombre_ubicacion"]."' >".$row["nombre_ubicacion"]."</option>";
                                  
                                     }
                                   ?>
                    </select>
              </div>
            </div>
            <!-- ************** -->
            <div class="form-group">
              <label for="" class="">Código Ubicación</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg nuevocodigo_devengo_ubicacion" name="nuevocodigo_devengo_ubicacion" id="nuevocodigo_devengo_ubicacion" placeholder="Ingresar Código" value="" autocomplete="off" required>
              </div>
            </div>


            <div class="form-group">
              <label for="" class="">Periodo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="nuevoperiodo_devengo_ubicacion" id="nuevoperiodo_devengo_ubicacion" class="form-control">
                  <option value="">Seleccione Periodo</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="Siempre">Siempre</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="">Valor</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg " name="nuevovalor_devengo_ubicacion" id="nuevovalor_devengo_ubicacion" placeholder="Ingresar Valor" value="" autocomplete="off" required oninput="validateNumber(this);">
              </div>
            </div>

            <input type="hidden" name="nuevoid" id="nuevoid">
            <input type="hidden" name="nuevoidubicacion_devengo" id="nuevoidubicacion_devengo" class="nuevoidubicacion_devengo">
            <input type="hidden" name="nuevoiddescuentodevengo" value="<?php echo $idhistorial0?>">


         

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

          $crear = new Controladordevengoubicacion();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditardevengoubicacion" class="modal fade" role="dialog">
  
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

         
            

  <!-- ENTRADA PARA CAMPOS  -->
  <div class="form-group">
              <label for="" class="">Nombre Ubicación</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="editarnombre_devengo_ubicacion" id="editarnombre_devengo_ubicacion" class="form-control input-lg mi-selector nuevonombre_devengo_ubicacion" required >
                      <option value="" id="seleccionblanco">Seleccione Ubicación</option>
                      <?php 
                                   function tblempleados2() {
                                     $query01 = "SELECT * FROM `tbl_clientes_ubicaciones` ";
                                     $sql = Conexion::conectar()->prepare($query01);
                                     $sql->execute();			
                                     return $sql->fetchAll();
                                     }

                                     $data01 = tblempleados2();
                                     foreach($data01 as $rowempleado) {
                                        echo "<option idubicacion='".$rowempleado["id"]."' codigo='".$rowempleado["codigo_ubicacion"]."' value='".$rowempleado["nombre_ubicacion"]."' >".$rowempleado["nombre_ubicacion"]."</option>";
                                  
                                     }
                                   ?>
                    </select>
              </div>
            </div>
            <!-- ************** -->
            <div class="form-group">
              <label for="" class="">Código Ubicación</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg editarcodigo_devengo_ubicacion" name="editarcodigo_devengo_ubicacion" id="editarcodigo_devengo_ubicacion" placeholder="Ingresar Código" value="" autocomplete="off" required>
              </div>
            </div>


            <div class="form-group">
              <label for="" class="">Periodo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="editarperiodo_devengo_ubicacion" id="editarperiodo_devengo_ubicacion" class="form-control">
                  <option value="">Seleccione Periodo</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="Siempre">Siempre</option>

                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="">Valor</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg " name="editarvalor_devengo_ubicacion" id="editarvalor_devengo_ubicacion" placeholder="Ingresar Valor" value="" autocomplete="off" required oninput="validateNumber(this);">
              </div>
            </div>

            <input type="hidden" name="editarid" id="editarid">
            <input type="hidden" name="editaridubicacion_devengo" id="editaridubicacion_devengo" class="editaridubicacion_devengo">
            <input type="hidden" name="editariddescuentodevengo" value="<?php echo $idhistorial0?>">



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

          $editar = new Controladordevengoubicacion();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladordevengoubicacion();
  $borrar -> ctrBorrar();

?> 



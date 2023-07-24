<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Pocisión Ubicación";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_posicionubicacion;
  $query = "SHOW COLUMNS FROM $nombretabla_posicionubicacion";
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
        <a href="ubicacionc" class="btn btn-danger">Volver</a>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarposicionubicacion">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            <th>Nombre de posición</th>
            <th>Número</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
        
          function consultar($e)
          {
            $query01 = "SELECT `id`, `nombre_posicion`, `numero`, `idubicacion_posicion` FROM `posicion_ubicacion` WHERE idubicacion_posicion=$e";
            $sql = Conexion::conectar()->prepare($query01);
            $sql->execute();
            return $sql->fetchAll();
          };
		     $data01 = consultar($idhistorial0);

         foreach ($data01 as $value) {
          
           echo ' <tr>
                   <td>'.$value["nombre_posicion"].'</td>
                   <td>'.$value["numero"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarposicionubicacion" idposicionubicacion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarposicionubicacion"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarposicionubicacion" idposicionubicacion="'.$value["id"].'"  Codigo="'.$idhistorial0.'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarposicionubicacion" class="modal fade" role="dialog">
  
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

            <input type="hidden" name="nuevoid" id="nuevoid">
            <input type="hidden" name="nuevoidubicacion_posicion" id="nuevoidubicacion_posicion" value="<?php echo $idhistorial0?>">

            <div class="form-group nombre_posicion  grupoposicionubicacion_nombre_posicion">
              <label for="" class="label_nombre_posicion">Nombre de posición</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_nombre_posicion"></i></span> 
                <input type="text" class="form-control input-lg input_nombre_posicion" name="nuevonombre_posicion" id="nuevonombre_posicion" placeholder="Ingresar Nombre de posición" value="" autocomplete="off" required="">
              </div>
            </div>

            <!-- ******************* -->

            <div class="form-group numero  grupoposicionubicacion_numero">
              <label for="" class="label_numero">Número</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_numero"></i></span> 
                <input type="text" class="form-control input-lg input_numero" name="nuevonumero" id="nuevonumero" placeholder="Ingresar Número" value="" autocomplete="off" required="" oninput="validateNumber(this);" >
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

          $crear = new Controladorposicionubicacion();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarposicionubicacion" class="modal fade" role="dialog">
  
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

             <input type="hidden" name="editarid" id="editarid">
             <input type="hidden" name="editaridubicacion_posicion" id="editaridubicacion_posicion" value="<?php echo $idhistorial0?>">

            <div class="form-group nombre_posicion  grupoposicionubicacion_nombre_posicion">
              <label for="" class="label_nombre_posicion">Nombre de posición</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_nombre_posicion"></i></span> 
                <input type="text" class="form-control input-lg input_nombre_posicion" name="editarnombre_posicion" id="editarnombre_posicion" placeholder="Ingresar Nombre de posición" value="" autocomplete="off" required="">
              </div>
            </div>

            <!-- ******************* -->

            <div class="form-group numero  grupoposicionubicacion_numero">
              <label for="" class="label_numero">Número</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_numero"></i></span> 
                <input type="text" class="form-control input-lg input_numero" name="editarnumero" id="editarnumero" placeholder="Ingresar Número" value="" autocomplete="off" required="" oninput="validateNumber(this);" >
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

          $editar = new Controladorposicionubicacion();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorposicionubicacion();
  $borrar -> ctrBorrar();

?> 



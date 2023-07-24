<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Comentario";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_comentario;
  $query = "SHOW COLUMNS FROM $nombretabla_comentario";
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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarcomentario">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha</th>
            <th>Comentario</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorcomentario::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha_comentario"].'</td>
                   <td>'.$value["comentario"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarcomentario" idcomentario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarcomentario"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarcomentario" idcomentario="'.$value["id"].'"  ><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarcomentario" class="modal fade" role="dialog">
  
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

          <input type="hidden" name="nuevoid">
          <input type="hidden" name="nuevoidubicacioncliente_comentario" value="<?php echo $idhistorial0?>">
            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">Fecha</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg calendario" name="nuevofecha_comentario" placeholder="" value="" autocomplete="off" required readonly  data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" >
              </div>
            </div>


            <div class="form-group">
              <label for="" class="">Comentario</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg" name="nuevocomentario" placeholder="" value="" autocomplete="off" required>
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

          $crear = new Controladorcomentario();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarcomentario" class="modal fade" role="dialog">
  
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

          
           <input type="hidden" name="editarid" id="editarid">
          <input type="hidden" name="editaridubicacioncliente_comentario" id="editaridubicacioncliente_comentario" value="<?php echo $idhistorial0?>">
            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">Fecha</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg calendario" name="editarfecha_comentario" id="editarfecha_comentario" placeholder="" value="" autocomplete="off" required readonly>
              </div>
            </div>


            <div class="form-group">
              <label for="" class="">Comentario</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg" name="editarcomentario" id="editarcomentario" placeholder="" value="" autocomplete="off" required>
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

          $editar = new Controladorcomentario();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorcomentario();
  $borrar -> ctrBorrar();

?> 



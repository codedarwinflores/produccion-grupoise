<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Dias Feriados";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_dias_feriados;
  $query = "SHOW COLUMNS FROM $nombretabla_dias_feriados";
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
          <div class="col-md-6" align="left">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregardias_feriados">
            Agregar <?php echo $Nombre_del_Modulo;?>
            </button>
          </div>
          <div class="col-md-6" align="right">
              <a href="configuracion" class="btn btn-warning">Volver Configuracion</a>
          </div>
        </div>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Numero de Dias</th>
            <th>Fechas</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladordias_feriados::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
              
              echo ' <tr>
              <td>'.($key+1).'</td>
              <td>'.$value["num_dias"].'</td>
              <td>'.$value["fecha_desde"].' - '.$value["fecha_hasta"].'</td>';
              echo '<td>

                <div class="btn-group">
                    
                  <button class="btn btn-warning btnEditardias_feriados" iddias_feriados="'.$value["id"].'" data-toggle="modal" data-target="#modalEditardias_feriados"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger btnEliminardias_feriados" iddias_feriados="'.$value["id"].'"  Codigo="'.$value["num_dias"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregardias_feriados" class="modal fade" role="dialog">
  
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
              <label for="" class="">Fecha Desde:</label> 
              <div class="">
                <input type="text" class="form-control input-lg calendario fechainicialdias" name="nuevofecha_desde" placeholder="" value="" autocomplete="off" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  required>
              </div>
            </div>
            
            
            <div class="form-group">
              <label for="" class="">Fecha Hasta:</label> 
              <div class="">
                <input type="text" class="form-control input-lg calendario fechafinaldias" name="nuevofecha_hasta" placeholder="" value="" autocomplete="off" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  required>
              </div>
            </div>


            <div class="form-group">
              <label for="" class="">Numero Dias</label> 
              <div class="">
                <input type="text" class="form-control input-lg numerodias" name="nuevonum_dias" placeholder="" value="" autocomplete="off" required readonly="readonly">
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

          $crear = new Controladordias_feriados();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditardias_feriados" class="modal fade" role="dialog">
  
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
            
            <div class="form-group">
              <label for="" class="">Fecha Desde:</label> 
              <div class="">
                <input type="text" class="form-control input-lg calendario editarfechainicialdias" name="editarfecha_desde" id="editarfecha_desde" placeholder="" value="" autocomplete="off" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  required>
              </div>
            </div>
            
            
            <div class="form-group">
              <label for="" class="">Fecha Hasta:</label> 
              <div class="">
                <input type="text" class="form-control input-lg calendario editarfechafinaldias" name="editarfecha_hasta" id="editarfecha_hasta" placeholder="" value="" autocomplete="off" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  required>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="">Numero Dias</label> 
              <div class="">
                <input type="text" class="form-control input-lg" name="editarnum_dias" id="editarnum_dias" placeholder="" value="" autocomplete="off" required readonly="readonly">
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

          $editar = new Controladordias_feriados();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladordias_feriados();
  $borrar -> ctrBorrar();

?> 



<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaises">
          
          Agregar Paises

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Nombre</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $bancos = ControladorPaises::ctrMostrarPaises($item, $valor);

       foreach ($bancos as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["nombre"].'</td>';

                 

                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarPaises" idPaises="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPaises"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarPaises" idPaises="'.$value["id"].'"  Codigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregarPaises" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar País</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL Codigo  -->
            
            <div class="form-group">
                <label for="" >Ingresar Código</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Código" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

             <div class="form-group">
             <label for="" >Ingresar Nombre</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" id="nuevoNombre" required>

              </div>

            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Paises</button>

        </div>

        <?php

          $crear = new ControladorPaises();
          $crear -> ctrCrearPaises();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarPaises" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar País</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id -- -->

          <input type="hidden" name="id" id="editarid">

            <!-- ENTRADA PARA EL CODIGO  -->
            
            <div class="form-group">
             <label for="" >Ingresar Código</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" placeholder="Ingresar Código" class="form-control input-lg" id="editarCodigo" name="editarCodigo" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE-->

             <div class="form-group">
             <label for="" >Ingresar Nombre</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                <input type="text" placeholder="Ingresar Nombre" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar País</button>

        </div>

     <?php

          $editar = new ControladorPaises();
          $editar -> ctrEditarPaises();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new ControladorPaises();
  $borrar -> ctrBorrarPaises();

?> 



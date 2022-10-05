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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAfp">
          
          Agregar AFP

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Nombre</th>
           <th>Código superintendencia</th>
           <th>Porcentaje</th>
           <th>Cuota patronal</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $afp = ControladorAfp::ctrMostrarAfp($item, $valor);

       foreach ($afp as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["codigo_superintendencia"].'</td>
                  <td>'.$value["porcentaje"].'</td>
                  <td>'.$value["cuota_patronal"].'</td>';
                  

                 

                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarAfp" idAfp="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarAfp"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarAfp" idAfp="'.$value["id"].'"  Codigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregarAfp" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar AFP</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL Codigo  -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Código" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" id="nuevoNombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SUPERINTENDENCIA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo_superintendencia" placeholder="Ingresar Código superintendencia" id="nuevoCodigo_superintendencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL porcentaje -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-percent"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoPorcentaje" placeholder="Ingresar Porcentaje" id="nuevoPorcentaje" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL cuota patronal -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-percent"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCuota_patronal" placeholder="Ingresar Cuota Patronal" id="nuevoCuota_patronal" required>

              </div>

            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Afp</button>

        </div>

        <?php

          $crear = new ControladorAfp();
          $crear -> ctrCrearAfp();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarAfp" class="modal fade" role="dialog">
  
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

             <!-- ENTRADA PARA EL Codigo  -->
            
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" placeholder="Ingresar Código" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" placeholder="Ingresar Nombre" id="editarNombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SUPERINTENDENCIA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo_superintendencia" placeholder="Ingresar Código superintendencia" id="editarCodigo_superintendencia" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL porcentaje -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-percent"></i></span> 

                <input type="number" class="form-control input-lg" name="editarPorcentaje" placeholder="Ingresar Porcentaje" id="editarPorcentaje" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL cuota patronal -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-percent"></i></span> 

                <input type="number" class="form-control input-lg" name="editarCuota_patronal" placeholder="Ingresar Cuota Patronal" id="editarCuota_patronal" required>

              </div>

            </div>




          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar AFP</button>

        </div>

     <?php

          $editar = new ControladorAfp();
          $editar -> ctrEditarAfp();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new ControladorAfp();
  $borrar -> ctrBorrarAfp();

?> 



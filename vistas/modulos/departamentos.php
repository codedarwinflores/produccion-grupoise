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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDepartamentos">
          
          Agregar Departamentos de Empresa

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nivel de Importacia</th>
           <th>Nombre</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $bancos = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);

       foreach ($bancos as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["nombre"].'</td>';

                 

                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarDepartamentos" idDepartamentos="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarDepartamentos"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarDepartamentos" idDepartamentos="'.$value["id"].'"  Codigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

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

<div id="modalAgregarDepartamentos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Departamentos de Empresa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL Codigo  -->
            
            <div class="form-group">
              <label for="">Ingresar Nivel de Importancia</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg codigo_validar" name="nuevoCodigo" placeholder="Ingresar Código" required tabla_validar="departamentos_empresa" item_validar="codigo" maxlength="4">

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

             <div class="form-group">
              <label for="">Ingresar Nombre</label>
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

          <button type="submit" class="btn btn-primary">Guardar Departamentos</button>

        </div>

        <?php

          $crear = new ControladorDepartamentos();
          $crear -> ctrCrearDepartamentos();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarDepartamentos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Departamentos de Empresa</h4>

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
            <label for="">Ingresar Nivel de Importancia</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg codigo trescaracter" id="editarCodigo" name="editarCodigo" placeholder="Ingresar Código" value="" required tabla_validar="departamentos_empresa" item_validar="codigo">

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE-->

             <div class="form-group">
             <label for="">Ingresar Nombre</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" placeholder="Ingresar Nombre" value="" required>

              </div>

            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Departamento de Empresa</button>

        </div>

     <?php

          $editar = new ControladorDepartamentos();
          $editar -> ctrEditarDepartamentos();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new ControladorDepartamentos();
  $borrar -> ctrBorrarDepartamentos();

?> 



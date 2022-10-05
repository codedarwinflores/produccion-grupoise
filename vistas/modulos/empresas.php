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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpresa">
          
          Agregar Empresa

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código Empresa</th>
           <th>Nombre</th>
           <th>Logo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

       foreach ($empresas as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo_empresa"].'</td>
                  <td>'.$value["nombre"].'</td>';

                  if($value["logo"] != ""){

                    echo '<td><img src="'.$value["logo"].'" class="img-thumbnail" width="40px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }


                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarEmpresa" idEmpresa="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEmpresa"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarEmpresa" idEmpresa="'.$value["id"].'" logoEmpresas="'.$value["logo"].'" Codigo_empresa="'.$value["codigo_empresa"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR EMPRESAS
======================================-->

<div id="modalAgregarEmpresa" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empresa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL Codigo Empresa -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo_empresa" placeholder="Ingresar Código Empresa" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-building"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" id="nuevoNombre" required>

              </div>

            </div>



            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR LOGO</div>

              <input type="file" class="nuevaLogo" name="nuevaLogo">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Empresa</button>

        </div>

        <?php

          $crearEmpresa = new ControladorEmpresas();
          $crearEmpresa -> ctrCrearEmpresas();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPRESAS
======================================-->

<div id="modalEditarEmpresa" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar empresa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id de la empresa-- -->

          <input type="hidden" name="id" id="editarid">

            <!-- ENTRADA PARA EL CODIGO EMRPESA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo_empresa" name="editarCodigo_empresa" placeholder="Ingresar Código Empresa" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-building"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" placeholder="Ingresar Nombre" required>

              </div>

            </div>


            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaLogo" name="editarLogo">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="logoActual" id="logoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Empresa</button>

        </div>

     <?php

          $editarEmpresa = new ControladorEmpresas();
          $editarEmpresa -> ctrEditarEmpresas();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarEmpresas = new ControladorEmpresas();
  $borrarEmpresas -> ctrBorrarEmpresas();

?> 



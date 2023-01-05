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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedores">
          
          Agregar Proveedor

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Nombre</th>
           <th>Dirección</th>
           <th>Teléfono</th>
           <th>Extensión</th>
           <th>Nª Registro</th>
           <th>Encargado</th>
           <th>Comentarios</th>
           <th>Nacionalidad</th>
           <th>Código Contable</th>
           <th>Contribuyente</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $empresas = ControladorProveedores::ctrMostrarProveedores($item, $valor);

       foreach ($empresas as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["direccion"].'</td>
                  <td>'.$value["telefono"].'</td>
                  <td>'.$value["extension"].'</td>
                  <td>'.$value["numero_de_resgistro"].'</td>
                  <td>'.$value["encargado"].'</td>
                  <td>'.$value["comentarios"].'</td>
                  <td>'.$value["nacionalidad"].'</td>
                  <td>'.$value["codigo_contable"].'</td>
                  <td>'.$value["contribuyente"].'</td>';
                  

                  

                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarProveedores" idProveedores="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarProveedores"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarProveedores" idProveedores="'.$value["id"].'" Codigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR PROVEEDORES
======================================-->

<div id="modalAgregarProveedores" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="row">
            <!-- ENTRADA PARA EL Codigo  -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Ingresar Código</label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                  <input type="text" class="form-control input-lg codigo_validar cuatrocaracter" name="nuevoCodigo" placeholder="Ingresar Código" required tabla_validar="proveedores" item_validar="codigo">

                </div>

              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="col-md-12">
             <div class="form-group">
             <label for="">Ingresar Nombre</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" id="nuevoNombre" required>

              </div>

             </div>
            </div>

            <!-- ENTRADA PARA EL DIRECCION -->
            <div class="col-md-12">
             <div class="form-group">
            <label for="">Ingresar Dirección</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Dirección" id="nuevoDireccion" required>

              </div>

             </div>
            </div>


            
            <!-- ENTRADA PARA EL EXTENSION -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Extensión</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoExtension" placeholder="Ingresar Extensión" id="nuevoExtension" required>

              </div>

             </div>
            </div>

            
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Teléfono</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg telefono" name="nuevoTelefono" placeholder="Ingresar Teléfono" id="nuevoTelefono"       required>

                
              </div>

             </div>
            </div>


            <!-- ENTRADA PARA EL ENCARGADO -->
            <div class="col-md-12">
             <div class="form-group">
            <label for="">Ingresar Encargado</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoEncargado" placeholder="Ingresar Encargado" id="nuevoEncargado" required>

              </div>

             </div>
            </div>
            

            
            <!-- ENTRADA PARA EL NACIONALIDAD -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Nacionalidad</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-flag"></i></span> 

<!--                 <input type="text"  placeholder="Ingresar Nacionalidad" id="nuevoNacionalidad" required>
 -->
                <!-- <select id="" class="form-control input-lg" name="nuevoNacionalidad" required>
                  <option value=" ">Seleccionar Nacionalidad </option>
                  <option value="Nacional ">Nacional </option>
                  <option value="Exterior">Exterior</option>
                </select> -->

                <?php
                    function ObtenerNacinalidadnuevo() {
                      $query = "select * from ajustes where name_table='proveedores' and accion='nuevo' and elemento='Ingresar Nacionalidad'";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = ObtenerNacinalidadnuevo();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>

                
              </div>

             </div>
            </div>


            <!-- ENTRADA PARA EL NUMERO DE REGISTRO -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Número de Registro</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNumero_de_registro" placeholder="Ingresar Número de Registro" id="nuevoNumero_de_registro" required>

              </div>

             </div>
            </div>

            

            
            <!-- ENTRADA PARA EL COMENTARIOS -->
            <div class="col-md-12">
             <div class="form-group">
            <label for="">Ingresar Comentarios</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-life-ring"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoComentario" placeholder="Ingresar Comentarios" id="nuevoComentario" required>

              </div>

             </div>
            </div>

            

            <!-- ENTRADA PARA EL CONTRIBUYENTE -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Proveedor</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <!-- <select name="nuevoContribuyente" id="nuevoContribuyente" class="form-control input-lg" required>
                  <option value="">Tipo Proveedor</option>
                  <option value="Contribuyente">Contribuyente</option>
                  <option value="Exento">Exento</option>
                </select> -->

                
                <?php
                    function ObtenerCorrelativonuevo() {
                      $query = "select * from ajustes where name_table='proveedor' and accion='nuevo' and elemento='Ingresar Proveedor'";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = ObtenerCorrelativonuevo();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>

              </div>

             </div>
            </div>

            
            <!-- ENTRADA PARA EL CODIGO CONTABLE -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Código Contable</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo_contable" placeholder="Ingresar Código Contable" id="nuevoCodigo_contable" required>

              </div>

             </div>
            </div>

            

          </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Proveedores</button>

        </div>

        <?php

          $crearProveedores = new ControladorProveedores();
          $crearProveedores -> ctrCrearProveedores();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDORES
======================================-->

<div id="modalEditarProveedores" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proveedores</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id -- -->

          <input type="hidden" name="id" id="editarid">


          
          <div class="row">
            <!-- ENTRADA PARA EL Codigo  -->
            <div class="col-md-6">
              <div class="form-group">
            <label for="">Ingresar Código</label>
                
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                  <input type="text" class="form-control input-lg cuatrocaracter" name="editarCodigo" id="editarCodigo" placeholder="Ingresar Código" required>

                </div>

              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="col-md-12">
             <div class="form-group">
            <label for="">Ingresar Nombre</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNombre" placeholder="Ingresar Nombre" id="editarNombre" required>

              </div>

             </div>
            </div>

            <!-- ENTRADA PARA EL DIRECCION -->
            <div class="col-md-12">
             <div class="form-group">
             <label for="">Ingresar Dirección</label>

              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-address-card-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDireccion" placeholder="Ingresar Dirección" id="editarDireccion" required>

              </div>

             </div>
            </div>


            
            <!-- ENTRADA PARA EL EXTENSION -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Extensión</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-tag"></i></span> 

                <input type="text" class="form-control input-lg" name="editarExtension" placeholder="Ingresar Extensión" id="editarExtension" required>

              </div>

             </div>
            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Teléfono</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTelefono" placeholder="Ingresar Teléfono" id="editarTelefono" required>

              </div>

             </div>
            </div>

            
            <!-- ENTRADA PARA EL ENCARGADO -->
            <div class="col-md-12">
             <div class="form-group">
            <label for="">Ingresar Encargado</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarEncargado" placeholder="Ingresar Encargado" id="editarEncargado" required>

              </div>

             </div>
            </div>


            
            <!-- ENTRADA PARA EL NACIONALIDAD -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Nacionalidad</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-flag"></i></span> 
<!-- 
                <input type="text" class="form-control input-lg" name="editarNacionalidad" placeholder="Ingresar Nacionalidad" id="editarNacionalidad" required> -->

                <!-- <select class="form-control input-lg" name="editarNacionalidad" id="editarNacionalidad" required>
                  <option value=" ">Seleccionar Nacionalidad </option>
                  <option value="Nacional ">Nacional </option>
                  <option value="Exterior">Exterior</option>
                </select> -->

                <?php
                    function ObtenerCorrelativo() {
                      $query = "select * from ajustes where name_table='proveedores' and accion='editar' and elemento='Ingresar Nacionalidad'";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = ObtenerCorrelativo();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>

              </div>

             </div>
            </div>

            
            <!-- ENTRADA PARA EL NUMERO DE REGISTRO -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Número de Registro</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-address-book-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarNumero_de_registro" placeholder="Ingresar Número de Registro" id="editarNumero_de_registro" required>

              </div>

             </div>
            </div>

            

            
            <!-- ENTRADA PARA EL COMENTARIOS -->
            <div class="col-md-12">
             <div class="form-group">
            <label for="">Ingresar Comentarios</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-life-ring"></i></span> 

                <input type="text" class="form-control input-lg" name="editarComentarios" placeholder="Ingresar Comentarios" id="editarComentarios" required>

              </div>

             </div>
            </div>

            

             <!-- ENTRADA PARA EL CONTRIBUYENTE -->
             <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Proveedor</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                <!-- <input type="text"> -->

                <!-- <select  class="form-control input-lg" name="editarContribuyente" placeholder="Ingresar Contribuyente" id="editarContribuyente" required>
                  <option value="">Tipo Proveedor</option>
                  <option value="Contribuyente">Contribuyente</option>
                  <option value="Exento">Exento</option>
                </select> -->

                <?php
                    function ObtenerCorrelativo2() {
                      $query = "select * from ajustes where name_table='proveedores' and accion='editar' and elemento='Ingresar Proveedor'";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = ObtenerCorrelativo2();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>

              </div>

             </div>
            </div>

            
            <!-- ENTRADA PARA EL CODIGO CONTABLE -->
            <div class="col-md-6">
             <div class="form-group">
            <label for="">Ingresar Código Contable</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo_contable" placeholder="Ingresar Código Contable" id="editarCodigo_contable" required>

              </div>

             </div>
            </div>

            
           

          </div>





          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Proveedor</button>

        </div>

     <?php

          $editarProveedores = new ControladorProveedores();
          $editarProveedores -> ctrEditarProveedores();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarProveedores = new ControladorProveedores();
  $borrarProveedores -> ctrBorrarProveedores();

?> 



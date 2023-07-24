<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Devengo o Descuento";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_descuento;
  $query = "SHOW COLUMNS FROM $nombretabla_descuento";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDescuentos">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           
           <th>Código</th>
           <th>Descripci&oacute;n</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $bancos = ControladorDescuentos::ctrMostrar($item, $valor);

       foreach ($bancos as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["descripcion"].'</td>';

                 

                  echo '<td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarDescuentos" idDescuentos="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarDescuentos"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarDescuentos" idDescuentos="'.$value["id"].'"  Codigo="'.$value["codigo"].'"><i class="fa fa-times"></i></button>

                      <a href="devengoubicacion?id='.$value["id"].'" class="btn btn-primary" >Asignar Ubicacón</a>

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

<div id="modalAgregarDescuentos" class="modal fade" role="dialog">
  
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
                <?php 
                $data = getContent();
                foreach($data as $row) {             
                    ?>
                    <div class="form-group <?php echo $row['Field'];?> descuentos_<?php echo $row['Field'];?>">
                        <label for="" class="label_<?php echo $row['Field'];?>"></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 
                            <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?> descuentoinput_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" tabla_validar="tbl_devengo_descuento" item_validar="codigo">
                        </div>
                    </div>
                    <?php
                    }
                    ?>


                  <div id="tipo_insert">
                    <div class="form-group">
                      <label for="">Ingresar Tipo</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control tipodescuento" name="nuevotipo" id="nuevotipo">
                          <option value="">Seleccione Tipo</option>
                          <option value="+Suma">+Suma</option>
                          <option value="-Resta">-Resta</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->
                  <div id="isss_select">
                    <div class="form-group">
                      <label for="">ISSS</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control" name="nuevoisss_devengo" id="nuevoisss_devengo">
                          <option value="">Seleccione ISSS</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->
                  <div id="afp_select">
                    <div class="form-group">
                      <label for="">AFP</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control" name="nuevoafp_devengo" id="nuevoafp_devengo">
                          <option value="">Seleccione AFP</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->
                  <div id="renta_select">
                    <div class="form-group">
                      <label for="">Renta</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control" name="nuevorenta_devengo" id="nuevorenta_devengo">
                          <option value="">Seleccione Renta</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->
            </div>

    </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Registro</button>

        </div>

        <?php

          $crear = new ControladorDescuentos();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarDescuentos" class="modal fade" role="dialog">
  
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

          <!-- -- entrada id 

          <input type="hidden" name="editarid" id="editarid">-- -->
 

 
            <!-- ENTRADA PARA CAMPOS  -->

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group <?php echo $row['Field'];?> edescuentos_<?php echo $row['Field'];?>">
            <label for="" class="label_<?php echo $row['Field'];?>"></label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?> edescuentoinput_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="">

              </div>

            </div>

          <?php
             }
          ?>
             
             <div id="etipo_insert">
                    <div class="form-group">
                      <label for="">Ingresar Tipo</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control tipodescuento" name="editartipo" id="editartipo">
                          <option value="">Seleccione Tipo</option>
                          <option value="+Suma">+Suma</option>
                          <option value="-Resta">-Resta</option>
                        </select>
                      </div>
                    </div>
              </div>

            <!-- **************** -->
            <div id="isss_select">
                    <div class="form-group">
                      <label for="">ISSS</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control" name="editarisss_devengo" id="editarisss_devengo">
                          <option value="">Seleccione ISSS</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->
                  <div id="afp_select">
                    <div class="form-group">
                      <label for="">AFP</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control" name="editarafp_devengo" id="editarafp_devengo">
                          <option value="">Seleccione AFP</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->
                  <div id="renta_select">
                    <div class="form-group">
                      <label for="">Renta</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control" name="editarrenta_devengo" id="editarrenta_devengo">
                          <option value="">Seleccione Renta</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- **************** -->


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

          $editar = new ControladorDescuentos();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new ControladorDescuentos();
  $borrar -> ctrBorrar();

?> 



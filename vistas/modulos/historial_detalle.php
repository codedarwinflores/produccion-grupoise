<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Detalle Ubicacion";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_tbl_ubicaciones_detalle;
  $query = "SHOW COLUMNS FROM $nombretabla_tbl_ubicaciones_detalle";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};


$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
$idubicacion = $results['id'];


?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregartbl_ubicaciones_detalle">
          Agregar <?php echo $Nombre_del_Modulo;?>
        </button>
      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive">
                      <thead>
                        <tr>
                          <th>Fecha de Modificacion</th>
                          <th>Número de Hombre</th>
                          <th>Valor</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        function historial() {
                          global $idubicacion;
                          $query = "select *from tbl_ubicaciones_detalle_historial where iddetalleubicacion=$idubicacion";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();			
                          return $sql->fetchAll();
                        };
                        $data = historial();
                    ?>
                      <?php
                        foreach($data as $row0) {
                      ?>
                        <tr>
                          <td><?php echo $row0["fecha_modificacion"];?></td>
                          <td><?php echo $row0["numero_hombres_historial"];?></td>
                          <td><?php echo $row0["valor_historial"];?></td>
                         

                        </tr>
                      <?php
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

<div id="modalAgregartbl_ubicaciones_detalle" class="modal fade" role="dialog">
  
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

           <input type="hidden" class="form-control input-lg " name="nuevoid" > 

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Número Hombre</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" class="form-control input-lg " name="nuevonumero_hombres" placeholder="Ingresar Número Hombre" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Precio</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" step="0.01" class="form-control input-lg " name="nuevoprecio" placeholder="Ingresar Precio" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->


               <!-- ENTRADA PARA CAMPOS  -->
              <div class="form-group ">
              <label for="" class="">Valor</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" step="0.01" class="form-control input-lg " name="nuevovalor" placeholder="Ingresar Valor" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->


             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group ">
              <label for="" class="">Total</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" step="0.01" class="form-control input-lg " name="nuevototal" placeholder="Ingresar Total" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->
            <?php
                   function cliente() {
                      $query = "select *from clientes";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data = cliente();
                ?>

              <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group ">
              <label for="" class="">Facturar A</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select class="form-control mi-selector" name="nuevofacturar" required>
                      <option value="">Seleccione Cliente</option>
                  <?php
                    foreach($data as $row0) {
                      echo "<option value='".$row0['nombre']."'>".$row0['nombre']."</option>";
                    }
                  ?>
                  </select>
              </div>
            </div>


            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Tipo Documento</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="nuevotipo_documento" id="" class="form-control" required>
                  <option value="">Seleccione Tipo de Documento</option>
                  <option value="CCF">CCF</option>
                  <option value="FA">FA</option>
                  <option value="FE">FE</option>
                </select>
              </div>
            </div>


            
            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Forma de Pago</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="nuevoforma_pago" id="" class="form-control" required>
                  <option value="">Seleccione Forma de Pago</option>
                  <option value="Mensual">Mensual</option>
                  <option value="Bimensual">Bimensual</option>
                  <option value="Trimestral">Trimestral</option>
                  <option value="Semestral">Semestral</option>
                  <option value="Anual">Anual</option>
                  <option value="24 meses">24 meses</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">¿No suma HS? </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="nuevonosumahs" id="" class="form-control" required>
                  <option value="">¿No suma HS?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group ">
              <label for="" class="">Concepto</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text"class="form-control input-lg " name="nuevoconcepto" placeholder="Ingresar Concepto" value="" autocomplete="off" required>
              </div>
            </div>

            <input type="hidden" name="nuevoidubicacion" value="<?php echo $idubicacion?>">








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

          $crear = new Controladortbl_ubicaciones_detalle();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartbl_ubicaciones_detalle" class="modal fade" role="dialog">
  
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


 
            <!-- ENTRADA PARA CAMPOS  -->
            <input type="hidden" class="form-control input-lg " name="editarid" id="editarid" > 

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Número Hombre</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" class="form-control input-lg " name="editarnumero_hombres" id="editarnumero_hombres" placeholder="Ingresar Número Hombre" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Precio</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" step="0.01" class="form-control input-lg " name="editarprecio" id="editarprecio" placeholder="Ingresar Precio" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->


              <!-- ENTRADA PARA CAMPOS  -->
              <div class="form-group ">
              <label for="" class="">Valor</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" step="0.01" class="form-control input-lg " name="editarvalor" id="editarvalor" placeholder="Ingresar Valor" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->


            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Total</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="number" step="0.01" class="form-control input-lg " name="editartotal" id="editartotal" placeholder="Ingresar Total" value="" autocomplete="off" required>
              </div>
            </div>
            <!-- ******** -->
            <?php
                  function clienteeditar() {
                      $query = "select *from clientes";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $dataeditar = clienteeditar();
                ?>

              <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Facturar A</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select class="form-control mi-selector" name="editarfacturar" id="editarfacturar" required>
                      <option value="">Seleccione Cliente</option>
                  <?php
                    foreach($dataeditar as $row0) {
                      echo "<option value='".$row0['nombre']."'>".$row0['nombre']."</option>";
                    }
                  ?>
                  </select>
              </div>
            </div>


            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Tipo Documento</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="editartipo_documento" id="editartipo_documento" class="form-control" required>
                  <option value="">Seleccione Tipo de Documento</option>
                  <option value="CCF">CCF</option>
                  <option value="FA">FA</option>
                  <option value="FE">FE</option>
                </select>
              </div>
            </div>



            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Forma de Pago</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="editarforma_pago" id="editarforma_pago" class="form-control" required>
                  <option value="">Seleccione Forma de Pago</option>
                  <option value="Mensual">Mensual</option>
                  <option value="Bimensual">Bimensual</option>
                  <option value="Trimestral">Trimestral</option>
                  <option value="Semestral">Semestral</option>
                  <option value="Anual">Anual</option>
                  <option value="24 meses">24 meses</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">¿No suma HS? </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <select name="editarnosumahs" id="editarnosumahs" class="form-control" required>
                  <option value="">¿No suma HS?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Concepto</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text"class="form-control input-lg " name="editarconcepto" id="editarconcepto" placeholder="Ingresar Concepto" value="" autocomplete="off" required>
              </div>
            </div>

            <input type="hidden" name="editaridubicacion" id="editaridubicacion" value="<?php echo $idubicacion?>">





            <!-- ********** -->
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

          $editar = new Controladortbl_ubicaciones_detalle();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladortbl_ubicaciones_detalle();
  $borrar -> ctrBorrar();

?> 



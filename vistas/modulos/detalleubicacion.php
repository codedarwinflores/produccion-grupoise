<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Hombres Autorizados";

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
$idubicacion01 = $results['id'];



function historial($e) {
  $query = "SELECT `id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento` FROM `aumentos_hombres` WHERE idubicacion_aumento=$e  order by id desc limit 1";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};
$data0 = historial($idubicacion01);


?>

<?php
$anterior="";
$cuenta="0";
foreach($data0 as $row0) {

  echo "<input type='hidden' id='idaumento' value=".$row0["id"]." />";


  if($row0["anterior_aumento"]==""){
    $anterior .="0";
  }
  else{
  $anterior .= $row0["anterior_aumento"];
  }
/* $cuenta.= $row0["cuenta"]; */

}

/* ****************************** */

function ubicacion($e) {
  $query = "SELECT tbl_clientes_ubicaciones.id as idubicacion, `id_cliente`, `codigo_cliente`, `codigo_ubicacion`, `facturar`, `id_coordinador_zona`, tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`
  FROM `tbl_clientes_ubicaciones`, tbl_empleados
  WHERE tbl_empleados.id=tbl_clientes_ubicaciones.id_coordinador_zona and tbl_clientes_ubicaciones.id = $e";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};
$data0 = ubicacion($idubicacion01);
$nombreempleado="";
foreach($data0 as $row0) {
  $nombreempleado.=$row0["primer_nombre"].' '.$row0["primer_apellido"];
  echo "<input type='hidden' id='codigo_ubicacion_aumento' value=".$row0["codigo_ubicacion"]." />";

}


/* ****************************** */
 ?>
 <input type='hidden' id='supervisor_aumento' value="<?php echo $nombreempleado ?>"  />
<style>
.active{
  color: #222d32;
}
.noactive{
  color: #7c7c7c;

}
</style>
<div class="content-wrapper">

 


  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>

        <button class="btn btn-primary mostrarformulario">
          Agregar <?php echo $Nombre_del_Modulo;?>
        </button>
      </div>

      <div class="box-body " >
        <div class="row">
          <div class="col-md-4 ">
            <a href="aumentarhombres?id=<?php echo $idubicacion01;?>">
              <h4 class="noactive">Paso 1: Aumente o Disminuya Hombres A.</h4>
            </a>
          </div>
          <div class="col-md-4 ">
            <a href="turnos?id=<?php echo $idubicacion01;?>">
              <h4 class="noactive">Paso 2: Asignación de Turno</h4>
            </a>
          </div>
          <div class="col-md-4 ">
            <a href="detalleubicacion?id=<?php echo $idubicacion01;?>">
               <h4 class="active">Paso 3: Facturación</h4>
            </a>
          </div>
        </div>
      </div>
      
      <div class="box-body">
        
    
      <div class="row">
        <div class="col-md-12">
          <h4>Hombres Autorizados: <?php echo $anterior?></h4>
          <input type="hidden" id="numerodehombresactual" value="<?php echo $anterior?>">
        </div>
        <!-- formulario agregar -->
        <div class="col-md-6 formagregar" >
          <!-- ****************************** -->
          <form role="form" method="post" enctype="multipart/form-data">
          
              <div class="row">

                  <input type="hidden" class="form-control input-lg " name="nuevoid" > 

                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group col-md-4">
                    <label for="" class="">Número Hombre</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="number" class="form-control input-lg numerohombres" name="nuevonumero_hombres" placeholder="Ingresar Número Hombre" value="" autocomplete="off" required="">
                    </div>
                  </div>
                  <!-- ******** -->

                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group col-md-4">
                    <label for="" class="">Precio</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="number" step="0.01" class="form-control input-lg preciohombre" name="nuevoprecio" placeholder="Ingresar Precio" value="" autocomplete="off" required="">
                    </div>
                  </div>
                  <!-- ******** -->


                      <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-4">
                    <label for="" class="">Valor</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="number" step="0.01" class="form-control input-lg valorhombre" name="nuevovalor" placeholder="Ingresar Valor" value="" autocomplete="off" required="" readonly>
                    </div>
                  </div>
                  <!-- ******** -->


                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-12" style="visibility:hidden; height:0;">
                    <label for="" class="">Total</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span>
                      <?php
                          function total($e) {
                            $query = "SELECT sum( `valor`) as suma FROM `tbl_ubicaciones_detalle` WHERE idubicacion=$e";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = total($idubicacion01);
                        $valor="";
                        foreach($data as $row0) {
                          $valor=$row0["suma"];
                        }
                      ?>
                      <input type="number" step="0.01" class="form-control input-lg " name="nuevototal" id="nuevototal" placeholder="Ingresar Total" value="<?php echo $valor;?>" autocomplete="off" required="" readonly>
                    </div>
                  </div>
                  <!-- ******** -->
                  <?php
                          function cliente2() {
                            $query = "select *from clientes";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = cliente2();
                      ?>

                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-6" >
                    <label for="" class="">Facturar A</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <select class="form-control mi-selector" name="nuevofacturar" required="">
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
                  <div class="form-group col-md-6" >
                    <label for="" class="">Tipo Documento</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <select name="nuevotipo_documento" id="" class="form-control" required="">
                        <option value="">Seleccione Tipo de Documento</option>
                        <option value="CCF">CCF</option>
                        <option value="FA">FA</option>
                        <option value="FE">FE</option>
                      </select>
                    </div>
                  </div>


                  
                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group col-md-12" >
                    <label for="" class="">Forma de Pago</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <select name="nuevoforma_pago" id="" class="form-control" required="">
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
                  <div class="form-group col-md-4">
                    <label for="" class="">%</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="number" step="0.01" class="form-control input-lg" name="nuevoporcentaje_detalle" id="nuevoporcentaje_detalle" placeholder="Ingresar Porcentaje" value="" autocomplete="off" required="">
                    </div>
                  </div>
                  <!-- ******** -->



                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-12" >
                    <label for="" class="">Concepto</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text"class="form-control input-lg " name="nuevoconcepto" placeholder="Ingresar Concepto" value="" autocomplete="off" required="">
                    </div>
                  </div>

                     <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group col-md-12" >
                    <label for="" class="">¿No suma HS? </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <select name="nuevonosumahs" id="" class="form-control" >
                        <option value="">¿No suma HS?</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>

                  <input type="hidden" name="nuevoidubicacion" value="<?php echo $idubicacion01?>">

                  <?php
                  

                  ?>

                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary guardartodo">Guardar</button>
                  </div>

                  <?php
                    $crear = new Controladortbl_ubicaciones_detalle();
                    $crear -> ctrCrear();
                  ?>
              </div>

          </form>
          
          <!-- ****************************** -->

        </div>
        <!-- formulario modificar -->
        <div class="col-md-6 formmodificar" style="display: none;">
          <!-- ****************** -->
          <form role="form" method="post" enctype="multipart/form-data">
              <div class="row">

                    <!-- ENTRADA PARA CAMPOS  -->
                    <input type="hidden" class="form-control input-lg " name="editarid" id="editarid" > 

                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-4">
                      <label for="" class="">Número Hombre</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <input type="number" class="form-control input-lg enumerohombres" name="editarnumero_hombres" id="editarnumero_hombres" placeholder="Ingresar Número Hombre" value="" autocomplete="off" required>
                      </div>
                    </div>
                    <!-- ******** -->

                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-4">
                      <label for="" class="">Precio</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <input type="number" step="0.01" class="form-control input-lg epreciohombre" name="editarprecio" id="editarprecio" placeholder="Ingresar Precio" value="" autocomplete="off" required>
                      </div>
                    </div>
                    <!-- ******** -->


                      <!-- ENTRADA PARA CAMPOS  -->
                      <div class="form-group col-md-4">
                      <label for="" class="">Valor</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <input type="number" step="0.01" class="form-control input-lg evalorhombre" name="editarvalor" id="editarvalor" placeholder="Ingresar Valor" value="" autocomplete="off" required="" readonly>
                      </div>
                    </div>
                    <!-- ******** -->


                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-12" style="visibility:hidden; height:0;">
                      <label for="" class="">Total</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 

                        <?php
                          function totaleditar($e) {
                            $query = "SELECT sum( `valor`) as suma FROM `tbl_ubicaciones_detalle` WHERE idubicacion=$e";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = totaleditar($idubicacion01);
                        $valor="";
                        foreach($data as $row0) {
                          $valor=$row0["suma"];
                        }
                      ?>
                        <input type="number" step="0.01" class="form-control input-lg " name="editartotal" id="editartotal" placeholder="Ingresar Total" value="<?php echo $valor;?>" autocomplete="off" required="" readonly>
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
                    <div class="form-group col-md-6" >
                      <label for="" class="">Facturar A</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <select class="form-control mi-selector" name="editarfacturar" id="editarfacturar" required="">
                              <option value="" id="seleccionfactura">Seleccione Cliente</option>
                          <?php
                            foreach($dataeditar as $row0) {
                              echo "<option value='".$row0['nombre']."'>".$row0['nombre']."</option>";
                            }
                          ?>
                          </select>
                      </div>
                    </div>


                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-6" >
                      <label for="" class="">Tipo Documento</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <select name="editartipo_documento" id="editartipo_documento" class="form-control" >
                          <option value="">Seleccione Tipo de Documento</option>
                          <option value="CCF">CCF</option>
                          <option value="FA">FA</option>
                          <option value="FE">FE</option>
                        </select>
                      </div>
                    </div>



                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-12" >
                      <label for="" class="">Forma de Pago</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <select name="editarforma_pago" id="editarforma_pago" class="form-control" required="">
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
                    <div class="form-group col-md-12" >
                      <label for="" class="">¿No suma HS? </label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <select name="editarnosumahs" id="editarnosumahs" class="form-control" required="">
                          <option value="">¿No suma HS?</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>

                     <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group col-md-12">
                    <label for="" class="">%</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="number" step="0.01" class="form-control input-lg" name="editarporcentaje_detalle" id="editarporcentaje_detalle" placeholder="Ingresar Porcentaje" value="" autocomplete="off" required="">
                    </div>
                  </div>
                  <!-- ******** -->



                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group col-md-12" >
                      <label for="" class="">Concepto</label> 
                      <div class="input-group">
                        <span class="input-group-addon"><i class=""></i></span> 
                        <input type="text"class="form-control input-lg " name="editarconcepto" id="editarconcepto" placeholder="Ingresar Concepto" value="" autocomplete="off" required="">
                      </div>
                    </div>

                    <input type="hidden" name="editaridubicacion" id="editaridubicacion" value="<?php echo $idubicacion01?>">

                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary guardarmodficar">Modificar</button>
                  </div>

                  <?php
                    $editar = new Controladortbl_ubicaciones_detalle();
                    $editar -> ctrEditar();
                  ?> 

                <!-- ********** -->
              </div>
          </form>
          <!-- ****************** -->
        </div>
        <!-- **tabla -->
        <div class="col-md-6">
          <!-- **************** -->

          <div style="overflow:scroll; height:300px;">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    
                    <thead>
                      
                      <tr>
                        <th>Numero Hombres</th>
                        <th>Precio</th>
                        <th>Valor</th>
                        <th>Acciones</th>
            
                      </tr> 
            
                    </thead>
            
                    <tbody>
            
                    <?php
                          function total2($e) {
                            $query = "SELECT * FROM `tbl_ubicaciones_detalle` WHERE idubicacion=$e";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = total2($idubicacion01);
                        $valor="";
                        foreach($data as $value) {
                          
                   
                      echo ' <tr>
                              <td>'.$value["numero_hombres"].'</td>
                              <td>'.$value["precio"].'</td>
                              <td>'.$value["valor"].'</td>';
            
                              
            
                              echo '<td>
            
                                <div class="btn-group">
                                    
                                  <button class="btn btn-warning btnEditartbl_ubicaciones_detalle" idtbl_ubicaciones_detalle="'.$value["id"].'" ><i class="fa fa-pencil"></i></button>
            
                                  <button class="btn btn-danger btnEliminartbl_ubicaciones_detalle" idtbl_ubicaciones_detalle="'.$value["id"].'" codigo="'.$value["idubicacion"].'" ><i class="fa fa-times"></i></button>
            
                                </div>  
            
                              </td>
            
                            </tr>';
                    }
            
            
                    ?> 
            
                    </tbody>

                </table>
          </div>
          <!-- **************** -->

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group col-md-12" >
                    <label for="" class="">Total</label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span>
                      <?php
                          function totalglobal($e) {
                            $query = "SELECT sum( `valor`) as suma FROM `tbl_ubicaciones_detalle` WHERE idubicacion=$e";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = totalglobal($idubicacion01);
                        $valor="";
                        foreach($data as $row0) {
                          $valor=$row0["suma"];
                        }
                      ?>
                      <input type="number" step="0.01" class="form-control input-lg " name="" id="" placeholder="Ingresar Total" value="<?php echo $valor;?>" autocomplete="off" required="" readonly>

                      <!-- *************** -->

                      <?php
                          function hombrenumero($e) {
                            $query = "SELECT sum( `numero_hombres`) as suma FROM `tbl_ubicaciones_detalle` WHERE idubicacion=$e";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = hombrenumero($idubicacion01);
                        $valor2="";
                        foreach($data as $row0) {
                          $valor2.=$row0["suma"];
                        }
                      ?>
                      <input type="hidden" id="numerodehombres" value="<?php echo $valor2?>">

                    </div>
                  </div>
                  <!-- ******** -->
        </div>
      </div>



        <!-- ************************************* -->
        <input type="hidden" value="<?php echo $idhistorial0; ?>" name="idubicacion_turno" id="idubicacion_turno">



    </div>

  </section>

</div>


<?php

  $borrar = new Controladortbl_ubicaciones_detalle();
  $borrar -> ctrBorrar();

?> 



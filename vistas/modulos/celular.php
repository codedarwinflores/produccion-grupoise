<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Celular";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_celular;
  $query = "SHOW COLUMNS FROM $nombretabla_celular";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarcelular">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
      <input type="hidden" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Código</th>
            <th>Descripcion</th>
            <th>Costo</th>
            <th>Numero</th>
            <th>SIM</th>
            <th>IMEI</th>
            <th>Operador</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Tipo Celular</th>
            <th>Fecha Asignacion Celular</th>
            <th>Código Nombre EMPLEADO</th>
            <th>Plan de Datos Celular</th>
            <th>Observación</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorcelular::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["codigocelular"].'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["costo"].'</td>
                   <td>'.$value["numero"].'</td>
                   <td>'.$value["simcelular"].'</td>
                   <td>'.$value["imei_celular"].'</td>
                   <td>'.$value["operador_celular"].'</td>
                   <td>'.$value["marca"].'</td>
                   <td>'.$value["modelo"].'</td>
                   <td>'.$value["color"].'</td>
                   <td>'.$value["nombretipocelular"].'</td>
                   <td>'.$value["fecha_asignacion_celular"].'</td>
                   <td>'.$value["codigo_nombre_empleado_celular"].'</td>
                   <td>'.$value["plan_datos_celular"].'</td>
                   <td>'.$value["observacion_celular"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarcelular" idcelular="'.$value["idcelular"].'" data-toggle="modal" data-target="#modalEditarcelular"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarcelular" idcelular="'.$value["idcelular"].'"  Codigo="'.$value["codigocelular"].'"><i class="fa fa-times"></i></button>

                       <a class="btn btn-success btndetalles" href="historialcelular?id='.$value["idcelular"].'">ASIGNACION</a>


                       
 
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

<div id="modalAgregarcelular" class="modal fade" role="dialog">
  
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


            <!-- ************** -->

            <script>
              
              /* ****ASIGNAR CODIGO SEGUN TIPO DE ARMA */
              $(document).on('change', '#nuevotipocelular', function(event) {
                   var obtenercodigo = $("#nuevotipocelular option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_celular.ajax.php",
                          method:"POST",
                          data: datos,
                          success:function(respuesta){
                          
                            /* alert(respuesta.replace(/["']/g, "")); */
                            /* alert(respuesta); */
                            $(".input_codigo").val(respuesta.replace(/["']/g, ""));
                          }

                        })
                 /* *** */
              });
              /* ********* */
            </script>




             
             <!--  ********* -->
             <div id="stipocelular">
             <label for="" class="">Seleccione Tipo celular</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevotipocelular" id="nuevotipocelular" class="form-control input-lg " required>
                  <option value="">Seleccione Tipo celular</option>
                <?php
                    $datos_mostrar = Controladortipocelular::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" codigo="<?php echo $value['codigo'] ?>" ><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>


             <!-- ******************* -->

             <div class="form-group codigo  grupocelular_codigo">
              <label for="" class="label_codigo">Ingresar Código</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_codigo fa fa-qrcode fa-qr"></i></span> 
                <input type="text" class="form-control input-lg input_codigo" name="nuevocodigo" id="nuevocodigo" placeholder="Ingresar Código" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>

            <!-- ************* -->

            <div class="form-group descripcion  grupocelular_descripcion">
              <label for="" class="label_descripcion">Ingresar Decripción</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_descripcion fa fa-sticky-note-o fa-server fa-tags"></i></span> 
                <input type="text" class="form-control input-lg input_descripcion" name="nuevodescripcion" id="nuevodescripcion" placeholder="Ingresar Decripción" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>
             <!-- ************ -->

             <div id="seleccionar_sim">
              <label for="" class="">Seleccione SIM</label> 
              <div class="input-group" >
                <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                <input name="nuevosim" id="nuevosim" class="form-control input-lg " required autocomplete="off"/>
              </div>
             </div>
            <!-- ***************** -->

            <div class="imei_celular">
              <div class="form-group ">
                <label for="" class="">IMEI</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                  <input type="text" name="nuevoimei_celular" id="nuevoimei_celular"  class="form-control input-lg" placeholder="IMEI"   >
                </div>
              </div>
            </div>

            <!-- ********************* -->
            <div class="operador_celular">
              <div class="form-group ">
                <label for="" class="">Seleccionar Operador</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                  <select name="nuevooperador_celular" id="nuevooperador_celular" class="form-control" required>
                    <option value="">Seleccionar Operador</option>
                    <option value="Tigo">Tigo</option>
                    <option value="Claro">Claro</option>
                    <option value="Digicel">Digicel</option>
                    <option value="Movistar">Movistar</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- *************** -->

            <div class="form-group costo  grupocelular_costo">
              <label for="" class="label_costo">Ingresar Costo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_costo fa fa-money"></i></span> 
                <input type="number" class="form-control input-lg input_costo" id="nuevocosto" name="nuevocosto" placeholder="Ingresar Costo" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" step="0.01">
              </div>
            </div>
            <!-- ***************** -->

            <div class="form-group numero  grupocelular_numero">
              <label for="" class="label_numero">Ingresar Numero</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_numero fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg input_numero telefono" id="nuevonumero" name="nuevonumero" placeholder="Ingresar Numero" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" maxlength="9">
              </div>
            </div>


            <div class="form-group   ">
              <label for="" class="">Ingresar Serie</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_numero fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg " id="nuevoserie_celular" name="nuevoserie_celular" placeholder="Ingresar Serie" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" maxlength="9">
              </div>
            </div>



            <div class="form-group marca  grupocelular_marca">
              <label for="" class="label_marca">Ingresar Marca</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_marca fa fa-tags"></i></span> 
                <input type="text" class="form-control input-lg input_marca" id="nuevomarca" name="nuevomarca" placeholder="Ingresar Marca" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>

            <div class="form-group modelo  grupocelular_modelo">
              <label for="" class="label_modelo">Ingresar Modelo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_modelo fa fa-star"></i></span> 
                <input type="text" class="form-control input-lg input_modelo" id="nuevomodelo" name="nuevomodelo" placeholder="Ingresar Modelo" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>


            <div class="form-group color  grupocelular_color">
              <label for="" class="label_color">Ingresar Color</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_color fa fa-th-large"></i></span> 
                <input type="text" class="form-control input-lg input_color" name="nuevocolor" id="nuevocolor" placeholder="Ingresar Color" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>


            <div class="form-group fecha_asignacion_celular  grupocelular_fecha_asignacion_celular">
              <label for="" class="label_fecha_asignacion_celular">Ingresar Fecha de Asignación Celular</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_fecha_asignacion_celular fa fa-file-excel-o"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_asignacion_celular calendario" name="nuevofecha_asignacion_celular" id="nuevofecha_asignacion_celular" placeholder="Ingresar Fecha de Asignación Celular" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" readonly="readonly">
              </div>
            </div>


            <div id="grupocelular_codigo_nombre_empleado_celular">
             <label for="" class="">Seleccione Empleado</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="nuevocodigo_nombre_empleado_celular" id="nuevocodigo_nombre_empleado_celular" class="form-control input-lg  mi-selector" required>
                  <option value="">Seleccione Empleado</option>
                <?php
                    $datos_mostrar = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo_empleado'] ?> - <?php echo $value["primer_nombre"] ?> <?php echo $value["primer_apellido"] ?>" ><?php echo $value['codigo_empleado'] ?> - <?php echo $value["primer_nombre"] ?> <?php echo $value["primer_apellido"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>


             <div class="form-group plan_datos_celular  grupocelular_plan_datos_celular">
              <label for="" class="label_plan_datos_celular">Ingresar Plan de datos Celular</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_plan_datos_celular fa fa-file-excel-o"></i></span> 
                <input type="text" class="form-control input-lg input_plan_datos_celular" name="nuevoplan_datos_celular" id="nuevoplan_datos_celular" placeholder="Ingresar Plan de datos Celular" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>

        
             <div class="form-group observacion_celular  ">
              <label for="" class="label_observacion_celular">Ingresar Observación</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_observacion_celular"></i></span> 
                <input type="text" class="form-control input-lg input_observacion_celular" name="nuevoobservacion_celular" id="nuevoobservacion_celular" placeholder="Ingresar Observación" value="" autocomplete="off" required="" >
              </div>
            </div>
             <!-- ************** -->
            

             <input type="hidden" name="nuevoid" id="">



           


           


           
          
          


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

          $crear = new Controladorcelular();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarcelular" class="modal fade" role="dialog">
  
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

            <script>
              /* ****ASIGNAR CODIGO SEGUN TIPO DE ARMA */
              $(document).on('change', '#editartipocelular', function(event) {
                   var obtenercodigo = $("#editartipocelular option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_celular.ajax.php",
                          method:"POST",
                          data: datos,
                          success:function(respuesta){
                            /* alert(respuesta.replace(/["']/g, "")); */
                            /* alert(respuesta); */
                            $("#editarcodigo").val(respuesta.replace(/["']/g, ""));
                          }

                        })
                 /* *** */
              });
              /* ********* */
            </script>



 
            <!-- ENTRADA PARA CAMPOS  -->




      <!-- ************ -->

       
      <input type="hidden" name="editarid" id="editarid">

          <!--  ********* -->
          <div id="stipocelular">
             <label for="" class="">Seleccione Tipo celular</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editartipocelular" id="editartipocelular" class="form-control input-lg " required>
                  <option value="">Seleccione Tipo celular</option>
                <?php
                    $datos_mostrar = Controladortipocelular::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" codigo="<?php echo $value['codigo'] ?>" ><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>


             <!-- ******************* -->

             <div class="form-group codigo  grupocelular_codigo">
              <label for="" class="label_codigo">Ingresar Código</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_codigo fa fa-qrcode fa-qr"></i></span> 
                <input type="text" class="form-control input-lg input_codigo" name="editarcodigo" id="editarcodigo" placeholder="Ingresar Código" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>

            <!-- ************* -->

            <div class="form-group descripcion  grupocelular_descripcion">
              <label for="" class="label_descripcion">Ingresar Decripción</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_descripcion fa fa-sticky-note-o fa-server fa-tags"></i></span> 
                <input type="text" class="form-control input-lg input_descripcion" name="editardescripcion" id="editardescripcion" placeholder="Ingresar Decripción" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>
             <!-- ************ -->

             <div id="seleccionar_sim">
              <label for="" class="">Seleccione SIM</label> 
              <div class="input-group" >
                <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                <input name="editarsim" id="editarsim" class="form-control input-lg " required autocomplete="off"/>
              </div>
             </div>
            <!-- ***************** -->

            <div class="imei_celular">
              <div class="form-group ">
                <label for="" class="">Ingresar IMEI</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                  <input type="text" name="editarimei_celular" id="editarimei_celular"  class="form-control input-lg" placeholder="IMEI"   >
                </div>
              </div>
            </div>

            <!-- ********************* -->
            <div class="operador_celular">
              <div class="form-group ">
                <label for="" class="">Seleccionar Operador</label> 
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                  <select name="editaroperador_celular" id="editaroperador_celular" class="form-control" required>
                    <option value="">Seleccionar Operador</option>
                    <option value="Tigo">Tigo</option>
                    <option value="Claro">Claro</option>
                    <option value="Digicel">Digicel</option>
                    <option value="Movistar">Movistar</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- *************** -->

            <div class="form-group costo  grupocelular_costo">
              <label for="" class="label_costo">Ingresar Costo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_costo fa fa-money"></i></span> 
                <input type="number" class="form-control input-lg input_costo" id="editarcosto" name="editarcosto" placeholder="Ingresar Costo" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" step="0.01">
              </div>
            </div>
            <!-- ***************** -->

            <div class="form-group numero  grupocelular_numero">
              <label for="" class="label_numero">Ingresar Numero</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_numero fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg input_numero telefono" id="editarnumero" name="editarnumero" placeholder="Ingresar Numero" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" maxlength="9">
              </div>
            </div>

            <div class="form-group  ">
              <label for="" class="">Ingresar Serie</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_numero fa fa-phone"></i></span> 
                <input type="text" class="form-control input-lg " id="editarserie_celular" name="editarserie_celular" placeholder="Ingresar Serie" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" maxlength="9">
              </div>
            </div>


            <div class="form-group marca  grupocelular_marca">
              <label for="" class="label_marca">Ingresar Marca</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_marca fa fa-tags"></i></span> 
                <input type="text" class="form-control input-lg input_marca" id="editarmarca" name="editarmarca" placeholder="Ingresar Marca" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>

            <div class="form-group modelo  grupocelular_modelo">
              <label for="" class="label_modelo">Ingresar Modelo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_modelo fa fa-star"></i></span> 
                <input type="text" class="form-control input-lg input_modelo" id="editarmodelo" name="editarmodelo" placeholder="Ingresar Modelo" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>


            <div class="form-group color  grupocelular_color">
              <label for="" class="label_color">Ingresar Color</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_color fa fa-th-large"></i></span> 
                <input type="text" class="form-control input-lg input_color" name="editarcolor" id="editarcolor" placeholder="Ingresar Color" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>


            <div class="form-group fecha_asignacion_celular  grupocelular_fecha_asignacion_celular">
              <label for="" class="label_fecha_asignacion_celular">Ingresar Fecha de Asignación Celular</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_fecha_asignacion_celular fa fa-file-excel-o"></i></span> 
                <input type="text" class="form-control input-lg input_fecha_asignacion_celular calendario" name="editarfecha_asignacion_celular" id="editarfecha_asignacion_celular" placeholder="Ingresar Fecha de Asignación Celular" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo" readonly="readonly">
              </div>
            </div>


            <div id="grupocelular_codigo_nombre_empleado_celular">
             <label for="" class="">Seleccione Empleado</label> 
             <div class="input-group" >
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editarcodigo_nombre_empleado_celular" id="editarcodigo_nombre_empleado_celular" class="form-control input-lg  mi-selector" required>
                  <option value="" id="seleccionar_empleado_celular">Seleccione Empleado</option>
                <?php
                    $datos_mostrar = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['codigo_empleado'] ?> - <?php echo $value["primer_nombre"] ?> <?php echo $value["primer_apellido"] ?>" ><?php echo $value['codigo_empleado'] ?> - <?php echo $value["primer_nombre"] ?> <?php echo $value["primer_apellido"] ?></option>  
                <?php
                    }
                  ?>
                </select>
             </div>
             </div>


             <div class="form-group plan_datos_celular  grupocelular_plan_datos_celular">
              <label for="" class="label_plan_datos_celular">Ingresar Plan de datos Celular</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_plan_datos_celular fa fa-file-excel-o"></i></span> 
                <input type="text" class="form-control input-lg input_plan_datos_celular" name="editarplan_datos_celular" id="editarplan_datos_celular" placeholder="Ingresar Plan de datos Celular" value="" autocomplete="off" required="" tabla_validar="celular" item_validar="codigo">
              </div>
            </div>


       



             <div class="form-group observacion_celular  ">
              <label for="" class="label_observacion_celular">Ingresar Observación</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_observacion_celular"></i></span> 
                <input type="text" class="form-control input-lg input_observacion_celular" name="editarobservacion_celular" id="editarobservacion_celular" placeholder="Ingresar Observación" value="" autocomplete="off" required="" >
              </div>
            </div>
             <!-- ************** -->


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

          $editar = new Controladorcelular();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL detalle 
======================================-->

<div id="modaldetalle" class="modal fade" role="dialog">
  
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
                    
                   <table class="table table-bordered table-striped dt-responsive">
                      <thead>
                        <tr>
                          <th>Fecha de Modificacion</th>
                          <th>Fecha Asignacion</th>
                          <th>Código y Nombre Empleado</th>
                          <th>Plan de Datos</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        function historialcelular() {
                          $query = "select *from historial_celular";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();			
                          return $sql->fetchAll();
                        };
                        $data = historialcelular();
                    ?>
                      <?php
                        foreach($data as $row0) {
                      ?>
                        <tr>
                          <td><?php echo $row0["fecha_modificacion"];?></td>
                          <td><?php echo $row0["historial_fecha_asignacion"];?></td>
                          <td><?php echo $row0["historial_codigo_nombre_empleado"];?></td>
                          <td><?php echo $row0["historial_plan_datos"];?></td>
                         

                        </tr>
                      <?php
                        }
                      ?>

                      </tbody>
                   </table>

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

          $editar = new Controladorcelular();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorcelular();
  $borrar -> ctrBorrar();

?> 



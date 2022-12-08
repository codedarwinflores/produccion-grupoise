<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Ubicacion Cliente";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_ubicacionc;
  $query = "SHOW COLUMNS FROM $nombretabla_ubicacionc";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarubicacionc">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body table-responsive">
        
      <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            <th>ID Cliente</th>
            <th>Nombre Cliente</th>
            <th>Código Cliente</th>
            <th>Código Ubicación</th>
            <th>Facturado a</th>
            <th>ID Coordinador de Zona</th>
            <th>Nombre Ubicación</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Dirección</th>
            <th>Persona Contacto</th>
            <th>Teléfono Contacto</th>
            <th>Email</th>
            <th>Cantidad de Armas</th>
            <th>Cantidad de Radios</th>
            <th>Cantidad de Celulares</th>
            
            <th>Visitas</th>
            <th>Zona</th>
            <th>Rubro</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Horas Permitidas</th>
            <th>Departamento</th>
            <th>Municipio</th>
            <th>Observaciones</th>
            <th>Última Fecha de Inventario</th>
            <th>Hombres Autorizados</th>
            <th>Tipo documento</th>
            <th>Forma Pago</th>
            <th>Concepto</th>
            <th>¿No suma HS?</th>
            <th>¿Tine PON?</th>
            <th>BONO POR LABORAR EN UNIDAD ESPECIAL</th>
            <th>BONO POR TRABAJAR 12 HORAS</th>
            <th>¿SE LE FACTURA?</th>
            <th>Zona</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorubicacionc::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["id_cliente"].'</td>
                   <td>'.$value["nombrecliente"].'</td>
                   <td>'.$value["codigo_cliente"].'</td>
                   <td>'.$value["codigo_ubicacion"].'</td>
                   <td>'.$value["facturar"].'</td>
                   <td>'.$value["id_coordinador_zona"].'</td>
                   <td>'.$value["nombre_ubicacion"].'</td>
                   <td>'.$value["latitude"].'</td>
                   <td>'.$value["longitude"].'</td>
                   <td>'.$value["direccionubicacionc"].'</td>
                   <td>'.$value["persona_contacto"].'</td>
                   <td>'.$value["telefono_contacto"].'</td>
                   <td>'.$value["email_contacto"].'</td>
                   <td>'.$value["cantidad_armas"].'</td>
                   <td>'.$value["cantidad_radios"].'</td>
                   <td>'.$value["cantidad_celulares"].'</td>
                  
                   <td>'.$value["visitas"].'</td>
                   <td>'.$value["zona"].'</td>
                   <td>'.$value["rubro"].'</td>
                   <td>'.$value["fecha_inicio"].'</td>
                   <td>'.$value["fecha_fin"].'</td>
                   <td>'.$value["horas_permitidas"].'</td>
                   <td>'.$value["nombredepartamento"].'</td>
                   <td>'.$value["Nombre_m"].'</td>
                   <td>'.$value["observaciones_generales"].'</td>
                   <td>'.$value["fecha_ultimo_inventario"].'</td>
                   <td>'.$value["hombres_autorizados"].'</td>
                   <td>'.$value["tipo_documento"].'</td>
                   <td>'.$value["forma_pago"].'</td>
                   <td>'.$value["concepto"].'</td>
                   <td>'.$value["sumahs"].'</td>
                   <td>'.$value["tienepon"].'</td>
                   <td>'.$value["bono_unidad"].'</td>
                   <td>'.$value["bono_horas"].'</td>
                   <td>'.$value["selefactura"].'</td>
                   <td>'.$value["zonaubicacion"].'</td>';
                   
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarubicacionc" idubicacionc="'.$value["idubicacionc"].'" data-toggle="modal" data-target="#modalEditarubicacionc"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarubicacionc" idubicacionc="'.$value["idubicacionc"].'"  Codigo="'.$value["codigo_cliente"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarubicacionc" class="modal fade" role="dialog">
  
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


        <!-- ********generar codigo ubicacion******** -->

        <!-- ****** -->

             
        <?php
                
                function ObtenerCorrelativo() {
                  $query = "select codigo_ubicacion  from tbl_clientes_ubicaciones  order by id desc limit 1";
                  $sql = Conexion::conectar()->prepare($query);
                  $sql->execute();			
                  return $sql->fetchAll();
                };


              /* **** */
            ?>

            <script>
              
              /* ****ASIGNAR CODIGO SEGUN TIPO DE ARMA */
              $(document).on('change', '#infocliente', function(event) {
                   var obtenercodigo = $("#infocliente option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_cliente.ajax.php",
                          method:"POST",
                          data: datos,
                          success:function(respuesta){
                          
                            /* alert(respuesta.replace(/["']/g, "")); */
                            /* alert(respuesta); */
                            $(".ubicacioninput_codigo_ubicacion").val(respuesta.replace(/["']/g, ""));
                          }

                        })
                 /* *** */
              });
              /* ********* */

              
              
              /* ****ASIGNAR CODIGO SEGUN TIPO DE ARMA */
              $(document).on('change', '#editarid_cliente', function(event) {
                   var obtenercodigo = $("#editarid_cliente option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_cliente.ajax.php",
                          method:"POST",
                          data: datos,
                          success:function(respuesta){
                          
                            /* alert(respuesta.replace(/["']/g, "")); */
                            /* alert(respuesta); */
                            $("#editarcodigo_ubicacion").val(respuesta.replace(/["']/g, ""));
                          }

                        })
                 /* *** */
              });
              /* ********* */


            </script>

        <!-- ***************************** -->


        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group ubicacioncgrupo_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
              <label for="" class="nuevoubicacionlabel_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg nuevoubicacioninput_<?php echo $row['Field'];?>  ubicacioninput_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>

              </div>

            </div>




          <?php
             }
          ?>
             
             
             
             <div id="sbonos">
              <input type="hidden" name="nuevobonos" value="bono">
             </div>

             <div id="svisitas">
                <label for="" class="">Seleccione Visitas</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevovisitas" id="nuevovisitas" class="form-control input-lg" required>
                    <option value="">Seleccione Visitas</option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                  </select>
                </div>
             </div>
             
             
             <div id="">
                <label for="" class="">Seleccione Tipo Documento</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevotipo_documento" id="" class="form-control input-lg" required>
                    <option value="">Seleccione Tipo Documento</option>
                    <option value="CCF">CCF</option>
                    <option value="FA">FA</option>
                    <option value="FE">FE</option>
                  </select>
                </div>
             </div>

             
             <div id="">
                <label for="" class="">Seleccione Forma de Pago</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevoforma_pago" id="" class="form-control input-lg" required>
                    <option value="">Seleccione Forma de Pago</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Bimensual">Bimensual</option>
                    <option value="Trimestral">Trimestral</option>
                    <option value="Semestral">Semestral</option>
                    <option value="Anual">Anual</option>
                    <option value="24 Meses">24 Meses</option>
                  </select>
                </div>
             </div>

             
             <div id="">
                <label for="" class="">Concepto</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-bars"></i></span> 
                  <textarea name="nuevoconcepto" id="" cols="30" rows="10" class="form-control input-lg"></textarea>
                </div>
             </div>

             
             <div id="">
                <label for="" class="">¿No suma HS?</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-list-ol"></i></span> 
                  <select name="nuevosumahs" id="" class="form-control input-lg" required>
                    <option value="">¿No suma HS?</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>
             </div>

             <div id="spon">
                <label for="" class="">¿TIENE PON?</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevotienepon" id="" class="form-control input-lg" required>
                    <option value="">¿TIENE PON?</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
             </div>

             <!-- ****************** -->
             <br>
             <div id="spon">
                  <div class="mitad">
                    <label for="" class="">BONO POR LABORAR EN UNIDAD ESPECIAL</label>
                  </div>
                  <div class="mitad">
                    <div class="" >
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="SI" id="sibonounidad">
                          <label class="form-check-label" for="flexCheckDefault">
                            SI
                          </label>
                        </div>
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="NO" id="nobonounidad">
                          <label class="form-check-label" for="flexCheckChecked">
                            NO
                          </label>
                        </div>
                      <input type="hidden" name="nuevobono_unidad" id="nuevobono_unidad">
                    </div>
                  </div>
             </div>

             <!-- ****************** -->
             <br>
             <div id="spon">
                  <div class="mitad">
                    <label for="" class="">BONO POR TRABAJAR 12 HORAS</label>
                  </div>
                  <div class="mitad">
                    <div class="" >
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="SI" id="sibonohoras">
                          <label class="form-check-label" for="flexCheckDefault">
                            SI
                          </label>
                        </div>
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="NO" id="nobonohoras">
                          <label class="form-check-label" for="flexCheckChecked">
                            NO
                          </label>
                        </div>
                      <input type="hidden" name="nuevobono_horas" id="nuevobono_horas">
                    </div>
                  </div>
             </div>

             <!-- *********** -->


             <div id="sselefactura">
                <label for="" class="">¿SE LE FACTURA?</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevoselefactura" id="nuevoselefactura" class="form-control input-lg" required>
                    <option value="">¿SE LE FACTURA?</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
             </div>


             <div id="">
                <label for="" class="">Seleccione la Zona</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevozonaubicacion" id="" class="form-control input-lg" required>
                    <option value="">Seleccione la Zona</option>
                    <option value="ORIENTAL">ORIENTAL</option>
                    <option value="OCCIDENTAL">OCCIDENTAL</option>
                    <option value="CENTRAL">CENTRAL</option>
                    <option value="NORTE">NORTE</option>
                    <option value="PARACENTRAL">PARACENTRAL</option>
                  </select>
                </div>
             </div>



             

             
             <div id="snuevorubro">
                <label for="" class="">Seleccione Rubro</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="nuevorubro" id="" class="form-control input-lg" required>
                    <option value="">Seleccione Rubro</option>
                    <option value="RESIDENCIAL">RESIDENCIAL</option>
                    <option value="COMERCIO">COMERCIO</option>
                    <option value="SERVICIO">SERVICIO</option>
                    <option value="TEXTIL">TEXTIL</option>
                    <option value="BANCA">BANCA</option>
                    <option value="EMPRESA">EMPRESA</option>
                  </select>
                </div>
             </div>


             <input type="text" name="nuevofecha_inicio" class="nuevoubicacionfechainicio" placeholder="fecha_inicio" style="display: none;">
             <input type="text" name="nuevofecha_fin" class="nuevoubicacionfechafin" placeholder="fecha_fin" style="display: none;">
             <input type="text" name="nuevofecha_ultimo_inventario" class="nuevoubicacionfechaultimo" placeholder="fecha_ultimo" style="display: none;">

             <div class="ubicacionc_s_cliente">
                <label for="">Seleccione Cliente</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="nuevoid_cliente" id="infocliente" class="form-control input-lg ubicacioncid_cliente mi-selector" required>
                      <option value="">Seleccione Cliente</option>
                    <?php
                        $datos_mostrar = Controladorclientes::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['clienteid'] ?>" codigo="<?php echo $value['clientecodigo'] ?>"><?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?></option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

            <!-- ***************** -->

            
            <div class="facturar_cliente">
                <label for="">Facturar a:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="nuevofacturar" id="nuevofacturar" class="form-control input-lg mi-selector" required>
                      <option value="">Seleccione Cliente</option>
                    <?php
                        $datos_mostrar = Controladorclientes::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?>"><?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?></option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

            <!-- ****************** -->


            <div class="coordinador">
                <label for="">Seleccione ID coordinador de zona. :</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="nuevoid_coordinador_zona" id="" class="form-control input-lg " required>
                      <option value="">Seleccione ID coordinador de zona. </option>
                    <?php
                        $datos_mostrar = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['id'] ?>">
                          <?php echo $value["primer_nombre"].' '.$value["primer_apellido"] ?>
                        </option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>
          
            <!-- ********************* -->

             <div class="ubicacionc_s_depa">
              <label for="">Seleccione Departamento</label>
              <div class="input-group ">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <select name="nuevoid_departamento" id="" class="form-control input-lg opciondepartamento" required>
                    <option value="">Seleccione Departamento</option>
                  <?php
                      $datos_mostrar = Controladorcat_departamento::ctrMostrar($item, $valor);
                      foreach ($datos_mostrar as $key => $value){
                  ?>
                      <option value="<?php echo $value['id'] ?>" ><?php echo $value["Nombre"] ?></option>  
                  <?php
                      }
                    ?>
                  </select>
              </div>
            </div>

            <div class="ubicacionc_s_muni">
              <label for="">Seleccione Municipio</label>
              <div class="input-group ">
                  <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                  <select name="nuevoid_municipio" id="nuevoid_municipio" class="form-control input-lg" required>
                    <option value="">Seleccione Municipio</option>
                  </select>
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

          $crear = new Controladorubicacionc();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarubicacionc" class="modal fade" role="dialog">
  
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

 
             
 <?php
                
                
              $data0 = ObtenerCorrelativo();
              foreach($data0 as $row0) {
                /* $numero = $row0['codigo_ubicacion'];
                $addnumber= $numero+1;
                $correlativo = sprintf("%03d",$addnumber);
                 */
                /* echo $correlativo; */
                /* $html="<script>";
                $html.="$(document).ready(function(){";
                $html .="$(document).on('change', '#editarid_cliente', function(event) {";
                $html .='var letra = $("#editarid_cliente option:selected").attr("codigo");';
                $html.="$('#editarcodigo_ubicacion').val(letra+'".$correlativo."');";
                $html.="$('.ecodigo_ubicacion').val('".$correlativo."');";
                $html.="});";
              $html.="});";
              $html.="</script>";
              echo $html; */
              }
            ?>

              <input type="hidden" name="editarcodigo_ubicacion" id="editarcodigo_ubicacion2" class="ecodigo_ubicacion">

 
            <!-- ENTRADA PARA CAMPOS  -->

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group eubicacioncgrupo_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
         <label for="" class="nuevoubicacionlabel_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg ubicacioninput_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required >
 
              </div>

            </div>

          <?php
             }
          ?>
             
             
             
             <div id="esbonos">
             <input type="hidden" name="editarbonos" id="editarbonos02" value="bono">
             </div>

             
             <div id="esvisitas">
                <label for="" class="">Seleccione Visitas</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editarvisitas" id="editarvisitas02" class="form-control input-lg" required>
                    <option value="">Seleccione Visitas</option>
                    <option value="SEMANAL">SEMANAL</option>
                    <option value="QUINCENAL">QUINCENAL</option>
                  </select>
                </div>
             </div>


             
             <div id="">
                <label for="" class="">Seleccione Tipo Documento</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editartipo_documento" id="editartipo_documento" class="form-control input-lg" required>
                    <option value="">Seleccione Tipo Documento</option>
                    <option value="CCF">CCF</option>
                    <option value="FA">FA</option>
                    <option value="FE">FE</option>
                  </select>
                </div>
             </div>

             
             <div id="">
                <label for="" class="">Seleccione Forma de Pago</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editarforma_pago" id="editarforma_pago" class="form-control input-lg" required>
                    <option value="">Seleccione Forma de Pago</option>
                    <option value="Mensual">Mensual</option>
                    <option value="Bimensual">Bimensual</option>
                    <option value="Trimestral">Trimestral</option>
                    <option value="Semestral">Semestral</option>
                    <option value="Anual">Anual</option>
                    <option value="24 Meses">24 Meses</option>
                  </select>
                </div>
             </div>

             
             <div id="">
                <label for="" class="">Concepto</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-bars"></i></span> 
                  <textarea name="editarconcepto" id="editarconcepto" cols="30" rows="10" class="form-control input-lg"></textarea>
                </div>
             </div>

             
             <div id="">
                <label for="" class="">¿No suma HS?</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-list-ol"></i></span> 
                  <select name="editarsumahs" id="editarsumahs" class="form-control input-lg" required>
                    <option value="">¿No suma HS?</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>
             </div>


             
             <div id="spon">
                <label for="" class="">¿TIENE PON?</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editartienepon" id="editartienepon" class="form-control input-lg" required>
                    <option value="">¿TIENE PON?</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
             </div>
             

             
             <!-- ****************** -->
             <br>
             <div id="spon">
                  <div class="mitad">
                    <label for="" class="">BONO POR LABORAR EN UNIDAD ESPECIAL</label>
                  </div>
                  <div class="mitad">
                    <div class="" >
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="SI" id="esibonounidad">
                          <label class="form-check-label" for="flexCheckDefault">
                            SI
                          </label>
                        </div>
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="NO" id="enobonounidad">
                          <label class="form-check-label" for="flexCheckChecked">
                            NO
                          </label>
                        </div>
                      <input type="hidden" name="editarbono_unidad" id="editarbono_unidad" class="editarbono_unidad">
                    </div>
                  </div>
             </div>

             <!-- ****************** -->
             <br>
             <div id="spon">
                  <div class="mitad">
                    <label for="" class="">BONO POR TRABAJAR 12 HORAS</label>
                  </div>
                  <div class="mitad">
                    <div class="" >
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="SI" id="esibonohoras">
                          <label class="form-check-label" for="flexCheckDefault">
                            SI
                          </label>
                        </div>
                        <div class="form-check mitad center">
                          <input class="form-check-input" type="checkbox" value="NO" id="enobonohoras">
                          <label class="form-check-label" for="flexCheckChecked">
                            NO
                          </label>
                        </div>
                      <input type="hidden" name="editarbono_horas" id="editarbono_horas" class="editarbono_horas">
                    </div>
                  </div>
             </div>

             <!-- *********** -->


             <div id="sselefactura">
                <label for="" class="">¿SE LE FACTURA?</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editarselefactura" id="editarselefactura" class="form-control input-lg" required>
                    <option value="">¿SE LE FACTURA?</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                  </select>
                </div>
             </div>


             <div id="">
                <label for="" class="">Seleccione la Zona</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editarzonaubicacion" id="editarzonaubicacion" class="form-control input-lg" required>
                    <option value="">Seleccione la Zona</option>
                    <option value="ORIENTAL">ORIENTAL</option>
                    <option value="OCCIDENTAL">OCCIDENTAL</option>
                    <option value="CENTRAL">CENTRAL</option>
                    <option value="NORTE">NORTE</option>
                    <option value="PARACENTRAL">PARACENTRAL</option>
                  </select>
                </div>
             </div>

             <!-- *************** -->

             
             <div id="esnuevorubro">
                <label for="" class="">Seleccione Rubro</label>
                <div class="input-group" >
                  <span class="input-group-addon"><i class="fa fa-server"></i></span> 
                  <select name="editarrubro" id="editarrubro" class="form-control input-lg" required>
                    <option value="">Seleccione Rubro</option>
                    <option value="RESIDENCIAL">RESIDENCIAL</option>
                    <option value="COMERCIO">COMERCIO</option>
                    <option value="SERVICIO">SERVICIO</option>
                    <option value="TEXTIL">TEXTIL</option>
                    <option value="BANCA">BANCA</option>
                    <option value="EMPRESA">EMPRESA</option>
                  </select>
                </div>
             </div>

             
             <input type="text" name="editarfecha_inicio" id="inputeditarfecha_inicio" class="ubicacionfechainicio" placeholder="fecha_inicio" style="display: none;">
             <input type="text" name="editarfecha_fin" id="inputeditarfecha_fin" class="ubicacionfechafin" placeholder="fecha_fin" style="display: none;">
             <input type="text" name="editarfecha_ultimo_inventario" id="inputeditarfecha_ultimo_inventario" class="ubicacionfechaultimo" placeholder="fecha_ultimo" style="display: none;">

             <div class="eubicacionc_s_cliente">
            <label for="">Seleccione Cliente</label>

             <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="editarid_cliente" id="editarid_cliente" class="form-control input-lg ubicacioncid_cliente mi-selector" required>
                  <option value="">Seleccione Cliente</option>
                <?php
                    $datos_mostrar = Controladorclientes::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['clienteid'] ?>" codigo="<?php echo $value['clientecodigo'] ?>"><?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
            </div>
            </div>

            

            <!-- ***************** -->

            
            <div class="efacturar_cliente">
                <label for="">Facturar a:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="editarfacturar" id="editarfacturar" class="form-control input-lg " required>
                      <option value="">Seleccione Cliente</option>
                    <?php
                        $datos_mostrar = Controladorclientes::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?>"><?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?></option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

            <!-- ****************** -->



             <div class="eubicacionc_s_depa">
            <label for="">Seleccione Departamento</label>

             <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                <select name="editarid_departamento" id="editarid_departamento" class="form-control input-lg eopciondepartamento" required>
                  <option value="">Seleccione Departamento</option>
                <?php
                    $datos_mostrar = Controladorcat_departamento::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" ><?php echo $value["Nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
            </div>
            </div>

            <div class="eubicacionc_s_muni">
            <label for="">Seleccione Municipio</label>

            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                <select name="editarid_municipio" id="editarid_municipio" class="form-control input-lg" required>
                  <option value="">Seleccione Municipio</option>
                  <?php
                    $datos_mostrar = Controladorcat_municipios::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" ><?php echo $value["Nombre_m"] ?></option>  
                <?php
                    }
                  ?>
 
                </select>
            </div>
            </div>
          

            

            <div class="ecoordinador">
                <label for="">Seleccione ID coordinador de zona. :</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="editarid_coordinador_zona" id="editarid_coordinador_zona" class="form-control input-lg " required>
                      <option value="">Seleccione ID coordinador de zona. </option>
                    <?php
                        $datos_mostrar = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['id'] ?>">
                          <?php echo $value["primer_nombre"].' '.$value["primer_apellido"] ?>
                        </option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

             <!-- ****************** -->
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

          $editar = new Controladorubicacionc();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorubicacionc();
  $borrar -> ctrBorrar();

?> 



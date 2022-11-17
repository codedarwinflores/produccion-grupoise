<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Arma";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_armas;
  $query = "SHOW COLUMNS FROM $nombretabla_armas";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregararmas">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
      <input type="text" value="" class="calendario" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY" style="display: none;">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha Ingreso</th>
            <th>Empresa</th>
            <th>Familia</th>
            <th>Tipo Arma</th>
            <th>Código</th>
            <th>Número Serie</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Número Matrícula</th>
            <th>Fecha Vencimiento</th>
            <th>Tipo Matrícula</th>
            <th>Tipo Munición</th>
            <th>Lugar Adquisición</th>
            <th>Precio Costo</th>
            <th>Estado</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorarmas::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha_ingreso"].'</td>
                   <td>'.$value["id_empresa"].'</td>
                   <td>'.$value["nombrefamilia"].'</td>
                   <td>'.$value["nombre_tipo"].'</td>
                   <td>'.$value["codigoarmas"].'</td>
                   <td>'.$value["numero_serie"].'</td>
                   <td>'.$value["marca"].'</td>
                   <td>'.$value["modelo"].'</td>
                   <td>'.$value["color"].'</td>
                   <td>'.$value["numero_matricula"].'</td>
                   <td>'.$value["fecha_vencimiento"].'</td>
                   <td>'.$value["tipo_matricula"].'</td>
                   <td>'.$value["tipo_municion"].'</td>
                   <td>'.$value["lugar_adquisicion"].'</td>
                   <td>'.$value["precio_costo"].'</td>
                   <td>'.$value["estado"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditararmas" idarmas="'.$value["idarmas"].'" data-toggle="modal" data-target="#modalEditararmas"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminararmas" idarmas="'.$value["idarmas"].'"  Codigo="'.$value["codigoarmas"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregararmas" class="modal fade" role="dialog">
  
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

          
          <input type="text" name="nuevofecha_ingreso" id="fecha_ingreso" class="fecha_ingreso" style="display: none;" >
          <input type="text" name="nuevofecha_vencimiento" id="fecha_vencimiento" class="fecha_vencimiento" style="display: none;">
          
          <input type="text" name="nuevoid_empresa" value="Grupo Ise" style="display: none;">

             
          
            <!-- *************************** -->

            <script>
              $(document).on('change', '#nuevoid_tipo_arma', function(event) {
                   var obtenercodigo = $("#nuevoid_tipo_arma option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_armas.ajax.php",
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

              $(document).on('change', '#nuevotipo_municion', function(event) {
                   var otro = $("#nuevotipo_municion option:selected").val();
                   
                   if(otro=="otros"){
                    $("#nuevotipo_municion option:selected").val("otros");
                    $("#texto_tipomunicion").attr("style","display:block");

                    $("#texto_tipomunicion").change(function(){
                      $("#nuevotipo_municion option:selected").val($("#texto_tipomunicion").val());

                    });

                   }
                   else{
                    $("#texto_tipomunicion").attr("style","display:none");

                   }
              });

            </script>

            <?php
            
              function ObtenerCorrelativo() {
                global $nombretabla_clientes;
                $query = "select id,codigo from $nombretabla_clientes order by id desc limit 1";
                $sql = Conexion::conectar()->prepare($query);
                $sql->execute();			
                return $sql->fetchAll();
              };

              
             $data0 = ObtenerCorrelativo();
             foreach($data0 as $row0) {
              $numero = $row0['codigo'];
              $quitarletra = substr($numero, 1);
              $quitarceros = ltrim($quitarletra, "0"); 
              $addnumber= $quitarceros+1;


              $correlativo = sprintf("%04d",$addnumber);
              
              /* echo $correlativo; */
              $html="<script>";
              $html.="$(document).ready(function(){";
                $html .='$(".input_nombre").keydown(function(event){';
                $html .="var letra = $(this).val().charAt(0);";
                $html.="$('.input_codigo').val(letra+'".$correlativo."');";
                $html.="});";
              $html.="});";
              $html.="</script>";
              echo $html;
            }
          ?>


        <!-- ***************************** -->



            <!-- ENTRADA PARA CAMPOS  -->

          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
           
           <div class="form-group farmagrupo_<?php echo $row['Field'];?> "> </div>

            <div class="form-group grupo_<?php echo $row['Field'];?> armagrupo_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
              <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?> armasinput_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_armas" item_validar="codigo">

              </div>

            </div>

          <?php
             }
          ?>

                              
        <!-- <div class="s_idempresa">
            <label for="">Seleccione Empresa</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-university"></i></span>
                <select name="nuevoid_empresa" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Empresa</option>
                <?php
                    $datos_mostrar = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
            </div>
      </div> -->

            <div class="s_idtipoarma">
              <label for="">Seleccione Tipo Arma</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                    <select name="nuevoid_tipo_arma" id="nuevoid_tipo_arma" class="form-control input-lg" required>
                      <option value="">Seleccione Tipo Arma</option>
                    <?php
                        $datos_mostrar = Controladortipoarmas::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['id'] ?>" codigo="<?php echo $value['codigo'] ?>"><?php echo $value["nombre_tipo"] ?></option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

        <div class="s_familia_arma">
          <label for="">Seleccione Familia</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoid_familia" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Familia</option>
                <?php
                    $datos_mostrar = Controladorfamilia::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
            </div>
        </div>

          <div class="s_matricula_tipo">
            <label for="">Seleccione Tipo Matricula</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="nuevotipo_matricula" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Matricula</option>
                    <option value="Portacion">Portacion</option>  
                    <option value="Tenencia">Tenencia</option>  
                </select>
            </div>
          </div>

            <div class="s_municion_tipo">
              <label for="">Seleccione Tipo Munición</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                    <select name="nuevotipo_municion" id="nuevotipo_municion" class="form-control input-lg" required>
                      <option value="">Seleccione Tipo Munición</option>
                        <option value="9mm">9mm</option>  
                        <option value="12mm">12mm</option>  
                        <option value="22mm">22mm</option>  
                        <option value="38mm">38mm</option>  
                        <option value="45mm">45mm</option>  
                        <option value="3.57mm">3.57mm</option>  
                        <option value="5.56mm">5.56mm</option>  
                        <option value="7.62mm">7.62mm</option> 
                        <option value="otros">otros</option>
                    </select>
                    <input type="text" class="form-control input-lg " id="texto_tipomunicion" style="display: none;">
                </div>
            </div>


            <div class="s_estado">
              <label for="">Seleccionar Estado</label>
            <div class="input-group ">
               <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                <select name="nuevoestado" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Estado</option>
                    <option value="Activa">Activa</option>  
                    <option value="Inactiva">Inactiva</option>  
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

          $crear = new Controladorarmas();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditararmas" class="modal fade" role="dialog">
  
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

 
 
          <input type="text" name="editarfecha_ingreso" id="fecha_ingreso_editar" class="editar_fecha_ingreso" style="display: none;" >
          <input type="text" name="editarfecha_vencimiento" id="fecha_vencimiento_editar" class="editar_fecha_vencimiento" style="display: none;">

          <input type="hidden" name="editarid_empresa" value="Grupo Ise">

            <!-- *************************** -->



        <!-- ***************************** -->

            <!-- ENTRADA PARA CAMPOS  -->

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group grupo_editar_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>
             

             <!-- **** -->
             <!-- <div class="s_idempresa_editar">
              <label for="" class="">Seleccione Empresa</label> 

                
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-university"></i></span>
                    <select name="editarid_empresa" id="editarid_empresa" class="form-control input-lg" required>
                      <option value="">Seleccione Empresa</option>
                    <?php
                        $datos_mostrar = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div> -->

            <div class="s_idtipoarma_editar">
            <label for="" class="">Seleccione Tipo Arma</label> 


              <div class="input-group ">
                  <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                  <select name="editarid_tipo_arma" id="editarid_tipo_arma" class="form-control input-lg" required>
                    <option value="">Seleccione Tipo Arma</option>
                  <?php
                      $datos_mostrar = Controladortipoarmas::ctrMostrar($item, $valor);
                      foreach ($datos_mostrar as $key => $value){
                  ?>
                      <option value="<?php echo $value['id'] ?>" codigo="<?php echo $value['codigo'] ?>"><?php echo $value["nombre_tipo"] ?></option>  
                  <?php
                      }
                    ?>
                  </select>
              </div>
            </div>

            <div class="s_familia_editar">
            <label for="" class="">Seleccione Tipo Arma</label> 
              
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="editarid_familia" id="editarid_familia" class="form-control input-lg" required>
                      <option value="">Seleccione Familia</option>
                    <?php
                        $datos_mostrar = Controladorfamilia::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
                    ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>



            <div class="editar_s_matricula_tipo">
            <label for="">Seleccione Tipo Matricula</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editartipo_matricula" id="editartipo_matricula" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Matricula</option>
                    <option value="Portacion">Portacion</option>  
                    <option value="Tenencia">Tenencia</option>  
                </select>
            </div>
            </div>

            <div class="editar_s_municion_tipo">
              <label for="">Seleccione Tipo Munición</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editartipo_municion" id="editartipo_municion" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Munición</option>
                    <option value="9mm">9mm</option>  
                    <option value="12mm">12mm</option>  
                    <option value="22mm">22mm</option>  
                    <option value="38mm">38mm</option>  
                    <option value="45mm">45mm</option>  
                    <option value="3.57mm">3.57mm</option>
                    <option value="5.56mm">5.56mm</option>    
                    <option value="7.62mm">7.62mm</option>  
                    <option value="otros">otros</option>
                </select>
                <input type="text" class="form-control input-lg" id="editartipo_municion02" style="display: none;">
            </div>
            </div>


            <div class="editar_s_estado">
              <label for="">Seleccione Estado</label>
            <div class="input-group ">
               <span class="input-group-addon"><i class="fa fa-shield"></i></span>
                <select name="editarestado" id="editarestado" class="form-control input-lg" required>
                  <option value="">Seleccione Estado</option>
                    <option value="Activa">Activa</option>  
                    <option value="Inactiva">Inactiva</option>  
                </select>
            </div>
            </div>


            
            <!-- **** -->

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

          $editar = new Controladorarmas();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorarmas();
  $borrar -> ctrBorrar();

?> 



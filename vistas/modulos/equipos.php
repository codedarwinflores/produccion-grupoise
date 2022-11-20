<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Otro Equipo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_equipos;
  $query = "SHOW COLUMNS FROM $nombretabla_equipos";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>

<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarequipos">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
      
      <input type="text" value="" class="calendario" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY" style="display: none;">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Familia</th>
            <th>Descripción</th>
            <th>Número Serie</th>
            <th>Tipo de otro equipo</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th>Modelo</th>
            <th>Color </th>
            
            <th>Fecha de adquisición</th>
            <th>Observaciones</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorequipos::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["nombrefamilia"].'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["numero_serie"].'</td>
                   <td>'.$value["codigo_equipo"].'</td>
                   <td>'.$value["descripcion_equipo"].'</td>
                   <td>'.$value["costo_equipo"].'</td>
                   <td>'.$value["modelo_equipo"].'</td>
                   <td>'.$value["color_equipo"].'</td>
                   <td>'.$value["nombretipo"].'</td>
                   
                   <td>'.$value["fecha_adquisicion"].'</td>
                   <td>'.$value["observaciones"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarequipos" idequipos="'.$value["idequipos"].'" data-toggle="modal" data-target="#modalEditarequipos"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarequipos" idequipos="'.$value["idequipos"].'"  Codigo="'.$value["descripcion"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarequipos" class="modal fade" role="dialog">
  
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
            
            function ObtenerCorrelativo() {
              global $nombretabla_clientes;
              $query = "select codigo_equipo  from tbl_otros_equipos  order by id desc limit 1";
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };

          $correlativo="";
           $data0 = ObtenerCorrelativo();
           foreach($data0 as $row0) {
            $numero = $row0['codigo_equipo'];
            $quitarletra = substr($numero, 4);
            $quitarceros = ltrim($quitarletra, "0"); 
            $addnumber= $quitarceros+1;
            $correlativo = sprintf("%04d",$addnumber);
            
            /* echo $correlativo; */
            
          }
          if($correlativo == "")
          {
            $correlativo="0001";
          }
          $html="<script>";
            $html.="$(document).ready(function(){";

              /* $html .="var letra = 'DEMT';";
              $html.="$('.input_codigo_equipo').val(letra+'".$correlativo."');";
               */
            $html.="});";
            $html.="</script>";
            echo $html;
        ?>

            <!-- ************** -->





          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group <?php echo $row['Field'];?> equipogrupo_<?php echo $row['Field'];?>">
            <label for="" class="label_<?php echo $row['Field'];?>"></label> 

              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_otros_equipos" item_validar="codigo_equipo">

              </div>

            </div>

            
<script>
              /* *********LABEL*********** */
                var input_<?php echo $row['Field'];?> = $(".input_<?php echo $row['Field'];?>").attr("placeholder");
                $(".label_<?php echo $row['Field'];?>").text(input_<?php echo $row['Field'];?>);

            </script>

          <?php
             }
          ?>
             

             <input type="hidden" name="nuevofecha_adquisicion" id="" class="fecha_adquisiondate">


          <input type="text" name="nuevoid_familia" class="input_id_familia_1" style="display: none;">

          <!-- *** -->
          <div id="s_familia" class="dropdown-content  s_familia s_familia02">
          <?php
         $datos_mostrar = Controladorfamilia::ctrMostrar($item, $valor);
         foreach ($datos_mostrar as $key => $value){
          echo ' <span class="select_familia"  idfamilia="'.$value["id"].'" nombrefamilia="'.$value["nombre"].'">'.$value["nombre"].'</span>';   
         
           }
          ?>
          </div>   
          <!-- *** -->

          <script>

              /* ****ASIGNAR CODIGO SEGUN TIPO  */
              $(document).on('change', '#nuevotipo_equipos', function(event) {
                   var obtenercodigo = $("#nuevotipo_equipos option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_tipoequipo.ajax.php",
                          method:"POST",
                          data: datos,
                          success:function(respuesta){
                          
                            /* alert(respuesta.replace(/["']/g, "")); */
                            /* alert(respuesta); */
                            $(".input_codigo_equipo").val(respuesta.replace(/["']/g, ""));
                          }

                        })
                 /* *** */
              });
              /* ********* */

              

              /* ****ASIGNAR CODIGO SEGUN TIPO  */
              $(document).on('change', '#editartipo_equipos', function(event) {
                   var obtenercodigo = $("#editartipo_equipos option:selected").attr("codigo");
                   
                   /* *** */
                   
                        var datos = "obtenercodigo="+obtenercodigo;

                        $.ajax({
                          url:"ajax/code_tipoequipo.ajax.php",
                          method:"POST",
                          data: datos,
                          success:function(respuesta){
                          
                            /* alert(respuesta.replace(/["']/g, "")); */
                            /* alert(respuesta); */
                            $(".input_codigo_equipo").val(respuesta.replace(/["']/g, ""));
                          }

                        })
                 /* *** */
              });
              /* ********* */
          </script>

          
          <div class="stipo_equipos">
              <label for="">Seleccione Tipo de otro equipo</label>
             <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevotipo_equipos" id="nuevotipo_equipos" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo de otro equipo</option>
                <?php
                    $datos_mostrar = Controladortipootrosequipos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" codigo="<?php echo $value['codigo'] ?>"><?php echo $value['nombre'] ?></option>  
                <?php
                    }
                  ?>
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

          $crear = new Controladorequipos();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarequipos" class="modal fade" role="dialog">
  
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

 
            <!-- ENTRADA PARA CAMPOS  -->

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group <?php echo $row['Field'];?> eequipogrupo_<?php echo $row['Field'];?>">
         <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required>
 
              </div>

            </div>

          <?php
             }
          ?>
             


             <input type="hidden" name="editarfecha_adquisicion" id="editarfecha_adquisicion2" class="fecha_adquisiondate">

             <input type="text" name="editarid_familia" class="input_id_familia_1" style="display: none;" id="editarid_familia_1">

                    <!-- *** -->
                    <div id="s_familia" class="dropdown-content s_familia  s_familia02">
                    <?php
                    $datos_mostrar = Controladorfamilia::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                    echo ' <span class="select_familia"  idfamilia="'.$value["id"].'" nombrefamilia="'.$value["nombre"].'">'.$value["nombre"].'</span>';   

                    }
                    ?>
                    </div>   
                    <!-- *** -->

            
          <div class="stipo_equipose">
              <label for="">Seleccione Tipo de otro equipo</label>
             <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="editartipo_equipos" id="editartipo_equipos" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo de otro equipo</option>
                <?php
                    $datos_mostrar = Controladortipootrosequipos::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>" codigo="<?php echo $value['codigo'] ?>"><?php echo $value['nombre'] ?></option>  
                <?php
                    }
                  ?>
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

          <button type="submit" class="btn btn-primary">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladorequipos();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorequipos();
  $borrar -> ctrBorrar();

?> 



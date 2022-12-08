<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Bicicleta";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_bicicleta;
  $query = "SHOW COLUMNS FROM $nombretabla_bicicleta";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarbicicleta">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
      <input type="text" value="" class="calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" style="display: none;">
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Familia</th>
            <th>Tipo Bicicleta</th>
            <th>Marca</th>
            <th>Número Serie</th>
            <th>Código Bicicleta</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Fecha de adquisición</th>
            <th>Observaciones</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorbicicleta::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["nombrefamilia"].'</td>
                   <td>'.$value["nombretipobicicleta"].'</td>
                   <td>'.$value["marca"].'</td>
                   <td>'.$value["numero_serie"].'</td>
                   
                   <td>'.$value["codigo_bicicleta"].'</td>
                   <td>'.$value["descripcion_bicicleta"].'</td>
                   <td>'.$value["costo_bicicleta"].'</td>
                   <td>'.$value["modelo_bicicleta"].'</td>
                   <td>'.$value["color_bicicleta"].'</td>
                   <td>'.$value["fecha_adquisicion"].'</td>
                   <td>'.$value["observaciones"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarbicicleta" idbicicleta="'.$value["idbicicleta"].'" data-toggle="modal" data-target="#modalEditarbicicleta"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarbicicleta" idbicicleta="'.$value["idbicicleta"].'"  Codigo="'.$value["marca"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarbicicleta" class="modal fade" role="dialog">
  
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
              $query = "select codigo_bicicleta  from tbl_bicicleta  order by id desc limit 1";
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };

          $correlativo="";
           $data0 = ObtenerCorrelativo();
           foreach($data0 as $row0) {
            $numero = $row0['codigo_bicicleta'];
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

              $html .="var letra = 'BICI';";
              $html.="$('.input_codigo_bicicleta').val(letra+'".$correlativo."');";
              
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
            <div class="form-group bicicleta_grupo_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
            <label for="" class="label_<?php echo $row['Field'];?>"></label> 
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off" required tabla_validar="tbl_bicicleta" item_validar="codigo_bicicleta">

              </div>

            </div>

            

          <?php
             }
          ?>
             

             <input type="hidden" name="nuevofecha_adquisicion" id="" class="fecha_adquisiondate">

             <div class="s_familia_b">
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

          
            <div class="s_tipo">
              <label for="">Seleccione Tipo Bicicleta</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="nuevoid_tipo_bicicleta" id="" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Bicicleta</option>
                <?php
                    $datos_mostrar = Controladortipobicicleta::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
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

          $crear = new Controladorbicicleta();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarbicicleta" class="modal fade" role="dialog">
  
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
            <div class="form-group bicicleta_grupoeditar_<?php echo $row['Field'];?> <?php echo $row['Field'];?>">
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
             

             <div class="s_familia_b_editar">
              <label for="">Seleccione Familia</label>
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

          <div class="s_tipo_editar">
            <label for="">Seleccione Tipo Bicicleta</label>
            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="editarid_tipo_bicicleta" id="editarid_tipo_bicicleta" class="form-control input-lg" required>
                  <option value="">Seleccione Tipo Bicicleta</option>
                <?php
                    $datos_mostrar = Controladortipobicicleta::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['id'] ?>"><?php echo $value["nombre"] ?></option>  
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

          $editar = new Controladorbicicleta();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorbicicleta();
  $borrar -> ctrBorrar();

?> 



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
$idubicaciones_coordinador = $results['id'];


?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>

      </div>

      <div class="box-body">
        
          <!-- ********** -->

          <input type="hidden" id="idubicaciones_coordinador" value="<?php echo $idubicaciones_coordinador;?>">

          <div class="">
                <label for="">Seleccione Patrulla:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="coordinadoractual" id="patrulla" class="form-control input-lg mi-selector" required>
                      <option value="">Seleccione Patrulla:</option>
                      <?php 
                                   function tblempleados() {
                                     $query01 = "SELECT `id`, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla` FROM `tbl_patrullas`";
                                     $sql = Conexion::conectar()->prepare($query01);
                                     $sql->execute();			
                                     return $sql->fetchAll();
                                     }

                                     $data01 = tblempleados();
                                     foreach($data01 as $value) {
                        ?>
                        <option value="<?php echo $value['id'] ?>">
                          <?php echo $value["codigo_patrulla"].' - '.$value["descripcion_patrulla"] ?>
                        </option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

            <!-- *************************** -->

            <div class="">
                <label for="">Seleccione Coordinador:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="coordinador" id="coordinador_selecion" class="form-control input-lg " required>
                      <option value="">Seleccione Coordinador :</option>
                    </select>
                </div>
            </div>
          <!-- ********** -->


            <!-- *************** -->
            <br>
            <br>
            <button class="btn btn-primary guardarasignacion">Actualizar</button>
       

      </div>

    </div>

  </section>

</div>



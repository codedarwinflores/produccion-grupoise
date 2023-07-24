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

$idhistorial0 = $results['id'];

function historial($e) {

  $query = "select*from tbl_ubicaciones_bono where idubicacion_historial='$e'";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};
$data0 = historial($idhistorial0);


?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered ">
                      <thead>
                        <tr>
                          <th>Fecha de Modificacion</th>
                          <th>Usuario</th>
                          <th>Cambio de Bono</th>
                          <th>Código Ubicacion</th>
                        </tr>
                      </thead>
                      <tbody>
                     
                      <?php
                        foreach($data0 as $row0) {
                      ?>
                        <tr>
                          <td><?php echo $row0["fecha_historial"];?></td>
                          <td><?php echo $row0["usuario_historial"];?></td>
                          <td><?php echo $row0["accion_historial"];?></td>
                          <td><?php echo $row0["codigoubicacion_historial"];?></td>
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



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
  $query = "SELECT `id`, `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento` FROM `aumentos_hombres` WHERE idubicacion_aumento=$e  order by id desc limit 1";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};
$data0 = historial($idhistorial0);
$anterior="";
$cuenta="0";
foreach($data0 as $row0) {
  if($row0["anterior_aumento"]==""){
    $anterior .="0";
  }
  else{
  $anterior .= $row0["anterior_aumento"];
  }
/* $cuenta.= $row0["cuenta"]; */

}


function tbl_clientes_ubicaciones($e) {
  $query = "SELECT `id`, `id_cliente`, `codigo_cliente`, `codigo_ubicacion`, `facturar`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, `direccion`, `persona_contacto`, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, `id_departamento`, `id_municipio`, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados`, `tipo_documento`, `forma_pago`, `concepto`, `sumahs`, `tienepon`, `bono_unidad`, `bono_horas`, `selefactura`, `zonaubicacion`, `estado_cliente_ubicacion`, `turno_eventual`, `criterio_ubicacionc`, `calcula_comodin_ubicacionc`, `comodin_unidad_ubicacionc`, `comodin_base_ubicacionc`, `reporte_equipo_ubicacionc` FROM `tbl_clientes_ubicaciones` WHERE  id=$e  ";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};
$data01 = tbl_clientes_ubicaciones($idhistorial0);
$hombres_autorizados="";
foreach($data01 as $row0) {
  $hombres_autorizados.=$row0["hombres_autorizados"];
}
 ?>
<style>
.active{
  color: #222d32;
}
.noactive{
  color: #7c7c7c;

}
</style>
<div class="content-wrapper">

 <input type="hidden" id="cuanta_registro" value="<?php echo $cuenta;?>">

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>

      </div>

      <!-- PANEL 1*************** -->
      <div class="box-body ">
        <div class="row">
          <div class="col-md-4 ">
            <h4 class="active">Paso 1: Aumente o Disminuya Hombres A.</h4>
          </div>
          <div class="col-md-4 ">
            <a href="turnos?id=<?php echo $idhistorial0;?>">
                <h4 class="noactive">Paso 2: Asignación de Turno</h4>
            </a>
          </div>
          <div class="col-md-4 ">
            <a href="detalleubicacion?id=<?php echo $idhistorial0;?>">
               <h4 class="noactive">Paso 3: Facturación</h4>
            </a>
          </div>
        </div>
        
        <!-- input maestros -->
          <input type="hidden" id="hombres_autorizados" value="<?php echo $hombres_autorizados;?>">
          <input type="hidden" value="<?php echo $idhistorial0; ?>" name="idubicacion_turno" id="idubicacion_turno">
                  
          <!-- ********** -->
          <div class="form-group">
            <label for="exampleInputEmail1">Fecha</label>
            <input type="text" class="form-control"   placeholder="Fecha" name="fecha_aumentar" id="fecha_aumentar" readonly>
          </div>
           <!-- ********** -->
           <div class="form-group">
            <label for="exampleInputEmail1">Hora</label>
            <input type="text" class="form-control"   placeholder="Hora" name="hora_aumentar" id="hora_aumentar" readonly>
           </div>

           <!-- ********** -->
           <div class="form-group">
            <label for="exampleInputEmail1">Anterior</label>
            <input type="text" class="form-control"   placeholder="Anterior" name="anterior_aumentar" id="anterior_aumentar" readonly value="<?php echo $anterior;?>">
          </div>

             <!-- ********** -->
           <div class="form-group">
            <label for="exampleInputEmail1">Ingresar Aumento</label>
            <input type="text" class="form-control"   placeholder="Ingresar Aumento" name="aumentar_hombres" id="aumentar_hombres">
          </div>

          
             <!-- ********** -->
          <div class="form-group">
            <label for="exampleInputEmail1">Ingresar Disminuye</label>
            <input type="text" class="form-control"   placeholder="Ingresar Disminuye" name="disminuye_hombres" id="disminuye_hombres">
          </div>

              <!-- ********** -->
          <div class="form-group">
            <label for="exampleInputEmail1">Hombres Actual</label>
            <input type="text" class="form-control"   name="actual_hombre" id="actual_hombre" readonly value="<?php echo $anterior;?>"> 
          </div>

          <input type="hidden" value="<?php echo $idhistorial0; ?>" name="idubicacion_aumento" id="idubicacion_aumento">

          <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6" align="right">
              <button class="btn btn-primary guardar_aumento">Guardar Y Siguiente</button>
            </div>
          </div>

     
   

      </div>

      <!-- **************** -->

     



    </div>

  </section>

</div>



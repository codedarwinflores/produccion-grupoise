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



      <!-- **************** -->

       <!-- PANEL 2*************** -->
       <div class="box-body panel2" >
        <div class="row">
          <div class="col-md-4 ">
           <a href="aumentarhombres?id=<?php echo $idhistorial0;?>">
              <h4 class="noactive">Paso 1: Aumente o Disminuya Hombres A.</h4>
            </a>
            
          </div>
          <div class="col-md-4 ">
            <h4 class="active">Paso 2: Asignación de Turno</h4>
             <!-- input maestros -->
            <input type="hidden" id="hombres_autorizados" value="<?php echo $hombres_autorizados;?>">
                 
          </div>
          <div class="col-md-4 ">
            <a href="detalleubicacion?id=<?php echo $idhistorial0;?>">
               <h4 class="noactive">Paso 3: Facturación</h4>
            </a>
          </div>
        </div>
  
        <!-- ************ -->



        <?php
        function historial2($e) {
          $query = "SELECT `id`, `24hr`, `12hde`, `12hd6`, `12hn6`, `12hd7`, `12hn7`, `extraordinario`, `septimo`, `turnos_comodin`, `notas`, `idubicacion` FROM `tbl_ubicaciones_turnos`  WHERE idubicacion=$e";
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();			
          return $sql->fetchAll();
        };
        $data0 = historial2($idhistorial0);
        $id="";
        $v24hr="";
        $v12hde="";
        $v12hd6="";
        $v12hn6="";
        $v12hd7="";
        $v12hn7="";
        $vextraordinario="";
        $vseptimo="";
        $vturnos_comodin="";
        $vnotas="";
        $vidubicacion="";
        foreach($data0 as $row0) {
        $id.= $row0["id"];
        $v24hr.= $row0["24hr"];
        $v12hde.= $row0["12hde"];
        $v12hd6.= $row0["12hd6"];
        $v12hn6.= $row0["12hn6"];
        $v12hd7.= $row0["12hd7"];
        $v12hn7.= $row0["12hn7"];
        $vextraordinario.= $row0["extraordinario"];
        $vseptimo.= $row0["septimo"];
        $vturnos_comodin.= $row0["turnos_comodin"];
        $vnotas.= $row0["notas"];
        $vidubicacion.= $row0["idubicacion"];
        }
        ?>
        <input type="hidden" id="idcache" value="<?php echo $id ?>">
        <input type="hidden" id="v24hrcache" value="<?php echo $v24hr ?>">
        <input type="hidden" id="v12hdecache" value="<?php echo $v12hde ?>">
        <input type="hidden" id="v12hd6cache" value="<?php echo $v12hd6 ?>">
        <input type="hidden" id="v12hn6cache" value="<?php echo $v12hn6 ?>">
        <input type="hidden" id="v12hd7cache" value="<?php echo $v12hd7 ?>">
        <input type="hidden" id="v12hn7cache" value="<?php echo $v12hn7 ?>">
        <input type="hidden" id="vextraordinariocache" value="<?php echo $vextraordinario ?>">
        <input type="hidden" id="vseptimocache" value="<?php echo $vseptimo ?>">
        <input type="hidden" id="vturnos_comodincache" value="<?php echo $vturnos_comodin ?>">
        <input type="hidden" id="vnotascache" value="<?php echo $vnotas ?>">
        <input type="hidden" id="vidubicacioncache" value="<?php echo $vidubicacion ?>">

        <div class="row">
          <div class="col-md-6">
            <!-- *********** -->
                <!-- ENTRADA PARA CAMPOS  -->
                <div class="form-group">
                              <label for="" class="">24h/r</label> 
                              <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span> 
                                <input type="text" class="form-control input-lg t_1" name="nuevo24hr" id="nuevo24hr" placeholder="Ingresar 24h/r" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                              </div>
                            </div>

                            <!-- ENTRADA PARA CAMPOS  -->
                            <div class="form-group">
                              <label for="" class="">  12h/d5 </label> 
                              <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span> 
                                <input type="text" class="form-control input-lg t_2" name="nuevo12hde" id="nuevo12hde" placeholder="Ingresar 12h/d5" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                              </div>
                            </div>

                            <!-- ENTRADA PARA CAMPOS  -->
                            <div class="form-group">
                              <label for="" class="">  12h/d6  </label> 
                              <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span> 
                                <input type="text" class="form-control input-lg t_3" name="nuevo12hd6" id="nuevo12hd6" placeholder="Ingresar 12h/d6" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                              </div>
                            </div>

                            <!-- ENTRADA PARA CAMPOS  -->
                            <div class="form-group">
                              <label for="" class="">  12h/n6  </label> 
                              <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span> 
                                <input type="text" class="form-control input-lg t_4" name="nuevo12hn6" id="nuevo12hn6" placeholder="Ingresar  12h/n6" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                              </div>
                            </div>

                            <!-- ENTRADA PARA CAMPOS  -->
                            <div class="form-group">
                              <label for="" class="">  12h/d7  </label> 
                              <div class="input-group">
                                <span class="input-group-addon"><i class=""></i></span> 
                                <input type="text" class="form-control input-lg t_5" name="nuevo12hd7" id="nuevo12hd7" placeholder="Ingresar 12h/d7" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                              </div>
                            </div>
            <!-- *********** -->
          </div>
          <div class="col-md-6">
              <!-- *************** -->
              
                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group">
                    <label for="" class="">  12h/n7  </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text" class="form-control input-lg t_6" name="nuevo12hn7" id="nuevo12hn7" placeholder="Ingresar 12h/n7 " value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                    </div>
                  </div>

                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group">
                    <label for="" class=""> Extraordinario  </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text" class="form-control input-lg t_7" name="nuevoextraordinario" id="nuevoextraordinario" placeholder="Ingresar Extraordinario" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                    </div>
                  </div>

                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group">
                    <label for="" class=""> Séptimo  </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text" class="form-control input-lg t_8" name="nuevoseptimo" id="nuevoseptimo" placeholder="Ingresar Séptimo" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
                    </div>
                  </div>

                  <!-- ENTRADA PARA CAMPOS  -->
                  <div class="form-group">
                    <label for="" class="">  Turnos de comodín   </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text" class="form-control input-lg t_9" name="nuevoturnos_comodin" id="nuevoturnos_comodin" placeholder="Ingresar Turnos de comodín" value="0" autocomplete="off" required maxlength="3" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="" class="">  Número de Hombres Autorizados   </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text" class="form-control input-lg" name="numerohombresautorizados" id="numerohombresautorizados" placeholder="" value="0" autocomplete="off"  readonly>
                    </div>
                  </div>

                    <!-- ENTRADA PARA CAMPOS  -->
                    <div class="form-group">
                    <label for="" class="">  Notas   </label> 
                    <div class="input-group">
                      <span class="input-group-addon"><i class=""></i></span> 
                      <input type="text" class="form-control input-lg t_10" name="nuevonotas" id="nuevonotas" placeholder="Ingresar Notas" value="" autocomplete="off" required >
                    </div>
                  </div>
              <!-- *************** -->
          </div>
        </div>


          <input type="hidden" value="<?php echo $idhistorial0; ?>" name="idubicacion_turno" id="idubicacion_turno">
        <!-- ************ -->

          <div class="row">
            <div class="col-md-6">
         
            </div>
            <div class="col-md-6" align="right">
              <button class="btn btn-primary guardar_turnos">Guardar Y Siguiente</button>
            </div>
          </div>

   
   

       </div>
      <!-- **************** -->



    </div>

  </section>

</div>



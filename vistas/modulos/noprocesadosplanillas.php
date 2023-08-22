<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Planilla Administrativa";

/* CAPTURAR NOMBRE COLUMNAS*/

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
  $id= $results['id'];
  $estado= $results['estado'];
  echo "<input type='hidden' class='idplanilladevengo_admin' value='".$id."'>";
  echo "<input type='hidden' class='noprocesado' value='".$estado."'>";

  /* ********************* */
  function configuracion()
  {
        $query01 = "SELECT * FROM configuracion";
        $sql = Conexion::conectar()->prepare($query01);
        $sql->execute();
        return $sql->fetchAll();
  }
  $data04 = configuracion();
  foreach ($data04 as $value) {
    echo "<input type='hidden' value=".$value["tope_isss"]." id='tope_isss'>";
  }
  /* ********************* */

    function validarempleado01($e)
		{
					$query01 = "SELECT * FROM planilladevengo_admin WHERE numero_planilladevengo_admin='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($id);
		foreach ($data03 as $value) {
    ?>
    <input type="hidden" class="tipo_planilladevengo_admin1" value="<?php echo $value["tipo_planilladevengo_admin"]?>">
    <input type="hidden" class="periodo_planilladevengo_admin1" value="<?php echo $value["periodo_planilladevengo_admin"]?>">
    <input type="hidden" class="fecha_desde_planilladevengo_admin1" value="<?php echo $value["fecha_desde_planilladevengo_admin"]?>">
    <input type="hidden" class="fecha_hasta_planilladevengo_admin1" value="<?php echo $value["fecha_hasta_planilladevengo_admin"]?>">
    <input type="hidden" class="numero_planilladevengo_admin1" value="<?php echo $value["numero_planilladevengo_admin"]?>">
    <input type="hidden" class="fecha_planilladevengo_admin1" value="<?php echo $value["fecha_planilladevengo_admin"]?>">
    <input type="hidden" class="descripcion_planilladevengo_admin1" value="<?php echo $value["descripcion_planilladevengo_admin"]?>">
    <input type="hidden" class="empleado_rango_desde1" value="<?php echo $value["empleado_rango_desde"]?>">
    <input type="hidden" class="empleado_rango_hasta1" value="<?php echo $value["empleado_rango_hasta"]?>">
    <input type="hidden" class="fecha_gratificacion_admin_hidden" value="<?php echo $value["fecha_gratificacion_admin"]?>">

    <?php
		}
    ?>

    <style>
     #visiondelempleado 
        {
          position: -webkit-sticky; /* Safari */
          position: sticky;
          top: -11px;
          background-color: #BEE0E8 !important;
        } 

        /* body{
          overflow-y: hidden;
        } */
    </style>
<div class="content-wrapper quitarscroll">

 

  <section class="content">

    <div class="box">


      <div class="row">

      <!-- **********formulario************ -->
      <div class="box-body">
        <div class="col-md-12">
          <a href="nuevaplanillaadmin?id=<?php echo $id;?>" class="btn btn-danger">Volver</a>
        </div>
        <div class="col-md-9">

            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tipo Planilla:</label>
                  <input type="text" class="form-control " name="tipo_planilladevengo_admin" id="tipo_planilladevengo_admin" placeholder="Tipo Planilla" value="Administrativa">
                </div>
            </div>


          <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Periodo:</label>
                  <select class=" form-control " name="periodo_planilladevengo_admin" id="periodo_planilladevengo_admin" placeholder="Periodo">
                    <option value="">Seleccione Periodo</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                  </select>
                </div>
          </div>
          <input type="hidden" class="calendario form-control " name="" id=""   data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY">

            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Fecha Desde:</label>
                <input type="text" class="calendario form-control " name="fecha_desde_planilladevengo_admin" id="fecha_desde_planilladevengo_admin"    readonly placeholder="Fecha Desde">
              </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha Hasta:</label>
                  <input type="text" class="calendario form-control " name="fecha_hasta_planilladevengo_admin" id="fecha_hasta_planilladevengo_admin"    readonly placeholder="Fecha Hasta">
                </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Número:</label>
                  <input type="text" class=" form-control " name="numero_planilladevengo_admin" id="numero_planilladevengo_admin"   placeholder="Número" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha:</label>
                  <input type="text" class="calendario form-control " name="fecha_planilladevengo_admin" id="fecha_planilladevengo_admin"   readonly placeholder="Fecha">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Descripción:</label>
                  <input type="text" class=" form-control " name="descripcion_planilladevengo_admin" id="descripcion_planilladevengo_admin" placeholder="Fecha" value="Planilla  Administrativa desde">
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Empleados Desde:</label>
                  <select name="empleado_rango_desde" id="empleado_rango_desde" class="form-control  mi-selector">
                      <option value="*">*</option>
                      <?php
                      
                      function empleados()
                        {
                          $query01 = "SELECT * FROM `tbl_empleados`";
                          $sql = Conexion::conectar()->prepare($query01);
                          $sql->execute();
                          return $sql->fetchAll();
                        };
                        $data01 = empleados();
                        foreach ($data01 as $value) {
                        ?>
                        <option value="<?php echo $value["id"];?>"><?php echo $value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["primer_apellido"]; ?></option>
                      <?php
                        }
                      ?>
                  </select>

                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Empleados Hasta:</label>
                  <select name="empleado_rango_hasta" id="empleado_rango_hasta" class="form-control  mi-selector">
                      <option value="*">*</option>
                      <?php
                        $data01 = empleados();
                        foreach ($data01 as $value) {
                        ?>
                        <option value="<?php echo $value["id"];?>"><?php echo $value["codigo_empleado"].'-'.$value["primer_nombre"].' '.$value["primer_apellido"]; ?></option>
                      <?php
                        }
                      ?>
                  </select>


                </div>
            </div>

            
            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha Gratificación por no faltar:</label>
                  <input type="text" class="calendario form-control " name="fecha_gratificacion_admin" id="fecha_gratificacion_admin"   readonly placeholder="Fecha">
                </div>
            </div>

            <div class="col-md-12">
              <button class="btn btn-primary filtrar_empleados"> Filtrar</button>

            </div>

            
        </div>

        <div class="col-md-12"><hr></div>
      </div>
  <!-- *************************** -->
        <div class="col-md-5">
          <!-- ***************** -->
            <div class="box-body" id="tabla_empleados" style=" height: 500px; overflow: scroll; ">
                
      
            </div>

            <div class="row box-body">
              <div class="col-md-4 box-body">
                <button class="btn btn-primary mostrar_devengo_admin" tipo="Suma" data-toggle="modal" data-target="#myModal" disabled="disabled">Agregar Devengo</button>
              </div>

              <div class="col-md-4 box-body">
                <button class="btn btn-success mostrar_devengo_admin" tipo="Resta" data-toggle="modal" data-target="#descuento" disabled="disabled">Agregar Descuento</button>
              </div>

              <div class="col-md-4 box-body">
                <button class="btn btn-info nuevo_empleado" data-toggle="modal" data-target="#empleados">Agregar Empleado</button>
              </div>

             

            </div>


          <!-- ***************** -->
        </div>

        <div class="col-md-1"></div>
        <div class="col-md-6" style=" height: 600px; overflow: scroll; ">
          <!-- ***************** -->
            <div class="box-body">
              
            <input type="hidden" id="accion_realizar">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="codigo_empleado_planilladevengo_admin" id="codigo_empleado_planilladevengo_admin">
            <input type="hidden" name="nombre_empleado_planilladevengo_admin" id="nombre_empleado_planilladevengo_admin">
            <input type="hidden" name="id_empleado_planilladevengo_admin" id="id_empleado_planilladevengo_admin">
            <div class="col-md-12">
            <div class="form-group"> <label>Empleado Seleccionado: <span id="nombreempleado"></span></label></div>
            </div>
            <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dias Trabajado:</label>
                    <input type="text" class=" form-control " name="dias_trabajo_planilladevengo_admin" id="dias_trabajo_planilladevengo_admin" placeholder="Dias Trabajado" readonly>
                  </div>
              </div>

              <div class="col-md-4 " >
                  <div class="form-group">
                    <label for="exampleInputEmail1">Salario Diario:</label>
                    <input type="text" class=" form-control " name="" id="sueldo_diario" placeholder="" readonly>
                  </div>
              </div>


              <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sueldo:</label>
                    <input type="text" class=" form-control " name="sueldo_planilladevengo_admin" id="sueldo_planilladevengo_admin" placeholder="Sueldo" readonly>
                  </div>
              </div>

              <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dias Incapacidad:</label>
                    <input type="number" class=" form-control " name="dias_incapacidad" id="dias_incapacidad" placeholder="Dias Incapacidad">
                  </div>
              </div>

              <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Septimo:</label>
                    <input type="number" class=" form-control " name="septimo_admin" id="septimo_admin" placeholder="Septimo">
                  </div>
              </div>

              <div class="col-md-4 ">
                  <div class="form-group">
                    <label for="">Dias Ausencia:</label>
                    <input type="number" class=" form-control " name="dias_ausencia" id="dias_ausencia" placeholder="Dias Ausencia">
                  </div>
              </div>
              <div class="col-md-12">
                <div class="btn btn-primary" id="restardias">Actualizar Dias</div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label style="font-size: 11px;">Hora Extra Diurna:</label>
                    <input type="text" class=" form-control " name="hora_extra_diurna_planilladevengo_admin" id="hora_extra_diurna_planilladevengo_admin" placeholder="Hora Extra Diurna" calculo="calculo_extra_diurna" >
                    <input type="text" class="form-control calculo_extra_diurna" value="0" readonly>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label style="font-size: 11px;">Hora Extra Nocturna:</label>
                    <input type="text" class=" form-control " name="hora_extra_nocturna_planilladevengo_admin" id="hora_extra_nocturna_planilladevengo_admin" placeholder="Hora Extra Nocturna" calculo="calculo_extra_nocturna" >
                    <input type="text" class="form-control calculo_extra_nocturna" value="0" readonly>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label style="font-size: 11px;">Hora Extra Domingo:</label>
                    <input type="text" class=" form-control " name="hora_extra_domingo_planilladevengo_admin" id="hora_extra_domingo_planilladevengo_admin" placeholder="Hora Extra Domingo" calculo="calculo_extra_domingo" >
                    <input type="text" class="form-control calculo_extra_domingo" value="0" readonly>

                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label style="font-size: 10px;">Hora Extra Domi. Noctu.:</label>
                    <input type="text" class=" form-control " name="hora_extra_domingo_nocturna_planilladevengo_admin" id="hora_extra_domingo_nocturna_planilladevengo_admin" placeholder="Hora Extra Domingo Nocturna" calculo="calculo_extra_domingo_noctu" >
                    <input type="text" class="form-control calculo_extra_domingo_noctu" value="0" readonly>

                  </div>
              </div>
              <div class="col-md-12">
                <div class="btn btn-primary" id="btnsumarhoras">Actualizar</div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Otro Devengo:</label>
                    <input type="text" class=" form-control " name="otro_devengo_admin_planilladevengo_admin" id="otro_devengo_admin_planilladevengo_admin" placeholder="Otro devengo_admin" readonly>
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Devengado:</label>
                    <input type="text" class=" form-control " name="total_devengo_admin_planilladevengo_admin" id="total_devengo_admin_planilladevengo_admin" placeholder="Total Devengado" style="border:1px solid green;" readonly>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descuento ISSS:</label>
                    <input type="text" class=" form-control " name="descuento_isss_planilladevengo_admin" id="descuento_isss_planilladevengo_admin" placeholder="Descuento ISSS" readonly>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descuento AFP:</label>
                    <input type="text" class=" form-control " name="descuento_afp_planilladevengo_admin" id="descuento_afp_planilladevengo_admin" placeholder="Descuento AFP" readonly>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descuento Renta:</label>
                    <input type="text" class=" form-control " name="descuento_renta_planilladevengo_admin" id="descuento_renta_planilladevengo_admin" placeholder="Descuento Renta" readonly>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Otro Descuento:</label>
                    <input type="text" class="form-control " name="otro_descuento_planilladevengo_admin" id="otro_descuento_planilladevengo_admin" placeholder="Otro Descuento" readonly>
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Descuento:</label>
                    <input type="text" class="form-control " name="total_descuento_planilladevengo_admin" id="total_descuento_planilladevengo_admin" placeholder="Total Descuento" style="border:1px solid red;" readonly>
                  </div>
              </div>

              
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Liquido:</label>
                    <input type="hidden" class="originalliquido">
                    <input type="text" class="form-control " name="total_liquidado_planilladevengo_admin" id="total_liquidado_planilladevengo_admin" placeholder="Total Liquidado" value="0" style="border:1px solid blue;" readonly>
                  </div>
              </div>


              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sujeto Renta:</label>
                    <input type="text" class="form-control " name="sueldo_renta_planilladevengo_admin" id="sueldo_renta_planilladevengo_admin" placeholder="Sueldo Renta" readonly>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sujeto ISSS:</label>
                    <input type="text" class="form-control " name="sueldo_isss_planilladevengo_admin" id="sueldo_isss_planilladevengo_admin" placeholder="Sueldo ISSS" readonly>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sujeto AFP:</label>
                    <input type="text" class="form-control " name="sueldo_afp_planilladevengo_admin" id="sueldo_afp_planilladevengo_admin" placeholder="Sueldo AFP" readonly>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Departamento:</label>
                    <select class="form-control mi-selector" name="departamento_planilladevengo_admin" id="departamento_planilladevengo_admin">
                      <option value="">Seleccione Departamento</option>

                    <?php                  
                      function consultar_situacion2()
                        {
                          $query01="SELECT * FROM `departamentos_empresa`";
                          
                          $sql = Conexion::conectar()->prepare($query01);
                          $sql->execute();
                          return $sql->fetchAll();
                          
                        };
                        $data01 = consultar_situacion2();
                        foreach ($data01 as $value) {
                    ?>
                          <option value="<?php echo $value["nombre"]?>"><?php echo $value["nombre"]?></option>
                    <?php
                        }
                    ?>
                    </select>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ubicación:</label>
                    <input type="hidden" name="codigo_ubicacion_planilladevengo_admin" id="codigo_ubicacion_planilladevengo_admin">

                    <input type="text" class="form-control " name="nombre_ubicacion_planilladevengo_admin" id="nombre_ubicacion_planilladevengo_admin" placeholder="Ubicación" readonly>

                    <input type="hidden" name="id_ubicacion_planilladevengo_admin" id="id_ubicacion_planilladevengo_admin">
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Fecha Contratación:</label>
                    <input type="text" class="form-control " name="" id="fecha_contratacion" placeholder="" readonly>
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="">Observación:</label>
                    <input type="text" class="form-control " name="observacion_planilladevengo_admin" id="observacion_planilladevengo_admin" placeholder="Observación">
                  </div>
              </div>

              <div class="col-md-12">
                <button class="btn btn-primary guardarplanilla">Guardar</button>
              </div>



            </div>

          <!-- ***************** -->
        </div>

      </div>
    </div>

  </section>

</div>


<!-- CAMPOS DATOS PRIMARIOS maestros -->
<input type="hidden"  id="sumavalor">
<input type="hidden"  id="sumavalor2">
<input type="hidden"  id="totalglobaldevengo">
<input type="hidden"  id="devengodevengo_admin">
<input type="hidden"  id="porcentajeafp">
<input type="hidden"  id="porcentajeisss">
<input type="hidden"  id="salario_por_hora">
<input type="hidden"  id="hora_extra_diurna">
<input type="hidden"  id="hora_extra_nocturna">
<input type="hidden"  id="hora_extra_domingo">
<input type="hidden"  id="hora_extra_nocturna_domingo">
<input type="hidden"  id="sum_descuento_nativa">
<input type="hidden"  id="sum_descuento_original">
<input type="hidden"  id="totalglobaldescuento">
<input type="hidden"  id="totalsujetorenta">
<input type="hidden"  id="totalsujetoisss">
<input type="hidden"  id="totalsujetoafp">
<input type="hidden"  id="porcentaje_isss" value="0">
<input type="hidden"  id="porcentaje_afp" value="0">
<input type="hidden"  id="porcentaje_base1" value="0">
<input type="hidden"  id="porcentaje_base2" value="0">
<input type="hidden"  id="tasa_sobre_excedente" value="0">
<input type="hidden"  id="historial_fecha_desde">
<input type="hidden"  id="historial_fecha_hasta">
<input type="hidden"  id="txt_codigo">
<input type="hidden"  id="txt_idempleado">
<input type="hidden"  id="txt_nombre">
<input type="hidden"  id="txt_sueldo">
<input type="hidden"  id="txt_salario_por_hora">
<input type="hidden"  id="valor_renta_original">
<input type="hidden"  id="valor_isss_original">
<input type="hidden"  id="valor_afp_original">
<input type="hidden"  id="historial_periodo">
<input type="hidden"  id="pensionado_empleado">
<input type="hidden"  id="his_dias_trabajo_admin">
<input type="hidden"  id="tienevacacion">
<input type="hidden"  id="">
<input type="hidden"  id="">


<!-- Modal -->
<div id="myModal" class="modal fade modales" role="dialog">
  <div class="modal-dialog" style="width: 1000px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Devengos</h4>
      </div>
      <div class="modal-body">
          <!-- ***************** -->
          <input type="hidden" name="" id="" class="id_devengo">
          <input type="hidden" name="" id="" class="codigo_planilla_devengo">

          <input type="hidden" name="codigo_devengo_descuento_planilla" class="codigo_devengo_descuento_planilla" id="codigo_devengo_descuento_planilla">
          <input type="hidden" name="descripcion_devengo_descuento_planilla" class="descripcion_devengo_descuento_planilla" id="descripcion_devengo_descuento_planilla">

            <div class="form-group col-md-12">
              <label for="">Seleccionar Devengo :</label>             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg tipo_devengo_descuento_planilla tipodevengo" name="tipo_devengo_descuento_planilla" id="tipo_devengo_descuento_planilla" required>                  
                  <option value="" >Seleccione una opci&oacute;n</option>  
                  <?php
                     	function consultar1()
                       {
                         $query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE tipo='+Suma'";
                         $sql = Conexion::conectar()->prepare($query01);
                         $sql->execute();
                         return $sql->fetchAll();
                       };
                       $data01 = consultar1();
      
      
                          foreach ($data01 as $value){
                      echo '<option  tipo_valor="'.$value["tipo"].'" renta_devengo="'.$value["renta_devengo"].'" afp_devengo="'.$value["afp_devengo"].'" isss_devengo="'.$value["isss_devengo"].'"  descripcion="'.$value["descripcion"].'" codigo="'.$value["codigo"].'" value="'.$value["id"].'">'.$value["codigo"].','.$value["descripcion"].','.$value["porcentaje"].'% - $'.$value["tipo"].','.$value["cargo_abono"].','.$value["cuenta_contable"].'</option>';                     
                    }
                ?>
                </select>
              </div>
            </div>

           


            <div class="form-group col-md-4" bis_skin_checked="1">
                      <label for="">ISSS</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control isss_devengo_devengo_descuento_planilla" name="isss_devengo_devengo_descuento_planilla" id="isss_devengo_devengo_descuento_planilla" disabled>
                          <option value="">Seleccione ISSS</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
            </div>


             <div class="form-group col-md-4" bis_skin_checked="1">
                      <label for="">AFP</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control afp_devengo_devengo_descuento_planilla" name="afp_devengo_devengo_descuento_planilla" id="afp_devengo_devengo_descuento_planilla" disabled>
                          <option value="">Seleccione AFP</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
             </div>


                    <div class="form-group col-md-4" bis_skin_checked="1">
                      <label for="">Renta</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control renta_devengo_devengo_descuento_planilla" name="renta_devengo_devengo_descuento_planilla" id="renta_devengo_devengo_descuento_planilla" disabled>
                          <option value="">Seleccione Renta</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>

            <div class="form-group col-md-12" bis_skin_checked="1">
                      <label for="">Valor</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg valor_devengo_planilla" name="valor_devengo_planilla" id="valor_devengo_planilla">
                      </div>
            </div>

            <!-- *********DIAS TRABAJADOS INCAPACIDAD -->
            <div class="form-group col-md-6 dias_trabajados_inca" bis_skin_checked="1" style="visibility:hidden; height:0px">
                      <label for="">Dias </label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg dias_tra_inca_admin" name="dias_tra_inca_admin" id="dias_tra_inca_admin" readonly>
                      </div>
            </div>
            <div class="form-group col-md-6 dias_trabajados_inca" bis_skin_checked="1" style="visibility:hidden; height:0px">
                      <label for="">Valor Dias </label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg pago_dias_tra_inca_admin" name="pago_dias_tra_inca_admin" id="pago_dias_tra_inca_admin" readonly>
                      </div>
            </div>
          <!-- ******************** -->
          

          <!-- *********DIAS  INCAPACIDAD -->
          <div class="form-group col-md-6 diasincapacidad" bis_skin_checked="1" style="visibility:hidden; height:0px">
                      <label for="">Dias </label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg dias_incapacidad_admin" name="dias_incapacidad_admin" id="dias_incapacidad_admin" readonly>
                      </div>
          </div>
          <div class="form-group col-md-6 diasincapacidad" bis_skin_checked="1" style="visibility:hidden; height:0px">
                      <label for="">Valor Dias </label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg pago_dias_incapacidad_admin" name="pago_dias_incapacidad_admin" id="pago_dias_incapacidad_admin" readonly>
                      </div>
          </div>
          <!-- ******************** -->


           <!-- *********DIAS FERIADOS -->
            <div class="form-group col-md-6 ocultardiasferiados" bis_skin_checked="1" style="visibility:hidden; height:0px">
                      <label for="">Dias Feriados</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg dias_Feriados" name="dias_Feriados" id="dias_Feriados">
                      </div>
            </div>
            <div class="form-group col-md-6 ocultardiasferiados" bis_skin_checked="1" style="visibility:hidden; height:0px">
                      <label for="">Valor Dias Feriados</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg valor_dias_Feriados" name="valor_dias_Feriados" id="valor_dias_Feriados" readonly>
                      </div>
            </div>
          <!-- ******************** -->
          <input type="hidden" name="porcentaje_isss_devengo_descuento_planilla" class="porcentaje_isss_devengo_descuento_planilla" id="porcentaje_isss_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_afp_devengo_descuento_planilla" class="porcentaje_afp_devengo_descuento_planilla" id="porcentaje_afp_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_renta_devengo_descuento_planilla" class="porcentaje_renta_devengo_descuento_planilla" id="porcentaje_renta_devengo_descuento_planilla">

          <input type="hidden" class="accion_devengo" id="accion_devengo" value="agregardevengo">

          <input type="hidden" name="" class="idempleado_devengo" id="idempleado_devengo">

          <input type="hidden" name="" class="tipo_valor" id="tipo_valor">

          <button class="btn btn-primary guardardevengo">Guardar</button>
          <br>
          <br>

          

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%" style="display:none;">
            <thead>
              <tr>
                <th style="width:90px">Código</th>
                <th>Descripcióm</th>
                <th>Valor</th>
                <th>ISSS</th>
                <th>AFP</th>
                <th>Renta</th>
                <th>Accion</th>
              </tr> 
            </thead>
            <tbody class="empleados_devengos_descuentos" id="empleados_devengos_descuentos"> 

            </tbody>
          </table>

          <!-- ***************** -->

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
              <tr>
                <th style="width:90px">Código</th>
                <th>Descripcióm</th>
                <th>Valor</th>
                <th>ISSS</th>
                <th>AFP</th>
                <th>Renta</th>
                <th>Accion</th>
              </tr> 
            </thead>
            <tbody class="devengodelempleado" id="devengodelempleado"> 

            </tbody>
          </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal DESCUENTO -->
<div id="descuento" class="modal fade modales" role="dialog">
  <div class="modal-dialog" style="width: 1000px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Descuentos</h4>
      </div>
      <div class="modal-body">
          <!-- ***************** -->
          <input type="hidden" name="" id="" class="id_devengo">
          <input type="hidden" name="" id="" class="codigo_planilla_devengo">

          <input type="hidden" name="codigo_devengo_descuento_planilla" class="codigo_devengo_descuento_planilla" id="codigo_devengo_descuento_planilla">
          <input type="hidden" name="descripcion_devengo_descuento_planilla" class="descripcion_devengo_descuento_planilla" id="descripcion_devengo_descuento_planilla">

          <div class="form-group col-md-12">
              <label for="">Recibos Pendientes:</label>             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg   " name="recibospendientes" id="recibospendientes" required>                  
                 
                 
                </select>
                <input type="hidden" id="idrecibo" value="no">
              </div>
            </div>


            <div class="form-group col-md-12">
              <label for="">Seleccionar Descuento:</label>             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg tipo_devengo_descuento_planilla  tipodescuento" name="tipo_devengo_descuento_planilla" id="tipo_devengo_descuento_planilla" required>                  
                  <option value="" >Seleccione una opci&oacute;n</option>  
                  <?php
                     	function consultar2()
                       {
                         $query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE tipo='-Resta'";
                         $sql = Conexion::conectar()->prepare($query01);
                         $sql->execute();
                         return $sql->fetchAll();
                       };
                       $data01 = consultar2();
      
      
                          foreach ($data01 as $value){
                      echo '<option  tipo_valor="'.$value["tipo"].'" renta_devengo="'.$value["renta_devengo"].'" afp_devengo="'.$value["afp_devengo"].'" isss_devengo="'.$value["isss_devengo"].'"  descripcion="'.$value["descripcion"].'" codigo="'.$value["codigo"].'" value="'.$value["id"].'">'.$value["codigo"].','.$value["descripcion"].','.$value["porcentaje"].'% - $'.$value["tipo"].','.$value["cargo_abono"].','.$value["cuenta_contable"].'</option>';                     
                    }
                ?>
                </select>
              </div>
            </div>

           


            <div class="form-group col-md-4" bis_skin_checked="1">
                      <label for="">ISSS</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control isss_devengo_devengo_descuento_planilla" name="isss_devengo_devengo_descuento_planilla" id="isss_devengo_devengo_descuento_planilla" disabled>
                          <option value="">Seleccione ISSS</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
            </div>


             <div class="form-group col-md-4" bis_skin_checked="1">
                      <label for="">AFP</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control afp_devengo_devengo_descuento_planilla" name="afp_devengo_devengo_descuento_planilla" id="afp_devengo_devengo_descuento_planilla" disabled>
                          <option value="">Seleccione AFP</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
             </div>


                    <div class="form-group col-md-4" bis_skin_checked="1">
                      <label for="">Renta</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <select class="form-control renta_devengo_devengo_descuento_planilla" name="renta_devengo_devengo_descuento_planilla" id="renta_devengo_devengo_descuento_planilla" disabled>
                          <option value="">Seleccione Renta</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>

            <div class="form-group col-md-12" bis_skin_checked="1">
                      <label for="">Valor</label>
                      <div class="input-group" bis_skin_checked="1">
                        <span class="input-group-addon"><i></i></span>
                        <input type="text" class="form-control input-lg valor_devengo_planilla1" name="valor_devengo_planilla" id="valor_devengo_planilla">
                      </div>
            </div>
          
          <input type="hidden" name="porcentaje_isss_devengo_descuento_planilla" class="porcentaje_isss_devengo_descuento_planilla" id="porcentaje_isss_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_afp_devengo_descuento_planilla" class="porcentaje_afp_devengo_descuento_planilla" id="porcentaje_afp_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_renta_devengo_descuento_planilla" class="porcentaje_renta_devengo_descuento_planilla" id="porcentaje_renta_devengo_descuento_planilla">

          <input type="hidden" class="accion_devengo" id="accion_devengo" value="agregardevengo">

          <input type="hidden" name="" class="idempleado_devengo" id="idempleado_devengo">

          <input type="hidden" name="" class="tipo_valor" id="tipo_valor">

          <button class="btn btn-primary guardardevengo">Guardar</button>
          <br>
          <br>

          

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%" style="display: none;">
            <thead>
              <tr>
                <th style="width:90px">Código</th>
                <th>Descripcióm</th>
                <th>Valor</th>
                <th>ISSS</th>
                <th>AFP</th>
                <th>Renta</th>
                <th>Accion</th>
              </tr> 
            </thead>
            <tbody class=" descuentos_empleados_original" id=""> 

            </tbody>
          </table>

          

          <!-- ***************** -->

          <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
            <thead>
              <tr>
                <th style="width:90px">Código</th>
                <th>Descripcióm</th>
                <th>Valor</th>
                <th>ISSS</th>
                <th>AFP</th>
                <th>Renta</th>
                <th>Accion</th>
              </tr> 
            </thead>
            <tbody class=" descuentos_empleado_nativa" id=""> 

            </tbody>
          </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal empleado -->
<div id="empleados" class="modal fade modales" role="dialog">
  <div class="modal-dialog" style="width: 1000px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Empleados</h4>
      </div>
      <div class="modal-body">
          <!-- ***************** -->

            <div class="form-group col-md-12">
       
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                  <thead>
                    <tr>
                      <th style="width:90px">Empleado</th>
                      <th>Accion</th>
                    </tr> 
                  </thead>
                  <tbody class=" " id=""> 

                  <?php
                     	function consultar3()
                       {
                         $query01 = "SELECT `id`, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, `observaciones`, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo`, `pantalon_empleado`, `camisa_empleado`, `zapatos_empleado`, `recomendado_empleado`, `contacto_empleado`, `documentacion_empleado`, `ansp_empleado`, `uniformeregalado_empleado`, `fecha_ingreso`, `fecha_contratacion`, `id_departamento_empresa`, `periodo_pago`, `horas_normales_trabajo`, `sueldo`, `sueldo_diario`, `salario_por_hora`, `hora_extra_diurna`, `hora_extra_nocturna`, `hora_extra_domingo`, `hora_extra_nocturna_domingo`, `id_tipo_portacion`, `descontar_isss`, `descontar_afp`, `id_tipo_planilla`, `id_banco`, `numero_cuenta`, `id_jefe_operaciones`, `imagen_contrato`, `anticipo`, `reportado_a_pnc`, `tipo_empleado`, `fecha_vencimiento_lpa`, `constancia_psicologica`, `nombre_psicologo`, `fecha_curso_ansp`, `numero_aprobacion_ansp`, `examen_poligrafico`, `Fecha_poligrafico`, `antecedente_policial`, `codigo_empleado`, `numero_telefono_trabajo_actual`, `carnet_empleado`, `idconfiguracion`, `luaf`, `imagenlpa`, `carnetafp`, `fotoisss`, `fotoansp`, `pensionado_empleado` FROM `tbl_empleados`";
                         $sql = Conexion::conectar()->prepare($query01);
                         $sql->execute();
                         return $sql->fetchAll();
                       };
                       $data01 = consultar3();

                      foreach ($data01 as $value){
                        ?>

                        <tr>
                          <td><?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]; ?></td>
                          <td>
                            <button class="btn btn-success select_empleado" id="<?php echo $value["id"]?>" codigo="<?php echo $value["codigo_empleado"]?>" nombre="<?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]?>">Agregar</button>
                          </td>
                        </tr>
                                      
                       <?php
                        }
                      ?>

                  </tbody>
                </table>

                
            </div>
          <!-- <button class="btn btn-primary guardarempleado">Guardar</button>
          <br>
          <br> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div>

  </div>
</div>



<!-- ******** MODAL CARGA********** -->

<div class="modal fade modal_carga" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" align="center">
        <img src="vistas/modulos/carga.gif" alt="">
        <h5 class="datos_informacion">Guardando y Cargando los Datos</h5>
      </div>
    </div>
  </div>
</div>

<!-- **************************** -->

<!-- ******** MODAL empleados********** -->

<div class="modal fade modal_carga_empleados" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" align="center">
        <img src="vistas/modulos/carga.gif" alt="" width="90">
        <h5 class="datos_informacion">Guardando y Cargando los Datos</h5><br>
        <span class="cantidad_empleados_pro">Guardando y Cargando los Datos</span><br>
        <span class="conteo_actual">Guardando y Cargando los Datos</span>
      </div>
    </div>
  </div>
</div>

<!-- **************************** -->




<script src="vistas/js/planillaadmin.js"></script>


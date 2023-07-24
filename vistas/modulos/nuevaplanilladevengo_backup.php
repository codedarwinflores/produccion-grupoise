<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Planilla Devengo";

/* CAPTURAR NOMBRE COLUMNAS*/

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
  $id= $results['id'];
  echo "<input type='hidden' class='idplanilladevengo' value='".$id."'>";

    function validarempleado01($e)
		{
					$query01 = "SELECT * FROM planilladevengo WHERE id='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($id);
		foreach ($data03 as $value) {
    ?>
    <input type="hidden" class="tipo_planilladevengo1" value="<?php echo $value["tipo_planilladevengo"]?>">
    <input type="hidden" class="periodo_planilladevengo1" value="<?php echo $value["periodo_planilladevengo"]?>">
    <input type="hidden" class="fecha_desde_planilladevengo1" value="<?php echo $value["fecha_desde_planilladevengo"]?>">
    <input type="hidden" class="fecha_hasta_planilladevengo1" value="<?php echo $value["fecha_hasta_planilladevengo"]?>">
    <input type="hidden" class="numero_planilladevengo1" value="<?php echo $value["numero_planilladevengo"]?>">
    <input type="hidden" class="fecha_planilladevengo1" value="<?php echo $value["fecha_planilladevengo"]?>">
    <input type="hidden" class="descripcion_planilladevengo1" value="<?php echo $value["descripcion_planilladevengo"]?>">
    <input type="hidden" class="empleado_rango_desde1" value="<?php echo $value["empleado_rango_desde"]?>">
    <input type="hidden" class="empleado_rango_hasta1" value="<?php echo $value["empleado_rango_hasta"]?>">

    <?php
	
		}


?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">


      <div class="row">

      <!-- **********formulario************ -->
      <div class="box-body">
        <div class="col-md-12">
          <a href="planilladevengo" class="btn btn-danger">Volver</a>
        </div>
        <div class="col-md-9">

            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tipo Planilla:</label>
                  <input type="text" class="form-control " name="tipo_planilladevengo" id="tipo_planilladevengo" placeholder="Tipo Planilla" value="Anticipos">
                </div>
            </div>


          <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Periodo:</label>
                  <input type="text" class=" form-control " name="periodo_planilladevengo" id="periodo_planilladevengo" placeholder="Periodo">
                </div>
          </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Fecha Desde:</label>
                <input type="text" class="calendario form-control " name="fecha_desde_planilladevengo" id="fecha_desde_planilladevengo"   data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" readonly placeholder="Fecha Desde">
              </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha Hasta:</label>
                  <input type="text" class="calendario form-control " name="fecha_hasta_planilladevengo" id="fecha_hasta_planilladevengo"   data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" readonly placeholder="Fecha Hasta">
                </div>
            </div>
            <div class="col-md-12"></div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Número:</label>
                  <input type="text" class=" form-control " name="numero_planilladevengo" id="numero_planilladevengo"   placeholder="Número">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha:</label>
                  <input type="text" class="calendario form-control " name="fecha_planilladevengo" id="fecha_planilladevengo"   readonly placeholder="Fecha">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Descripción:</label>
                  <input type="text" class=" form-control " name="descripcion_planilladevengo" id="descripcion_planilladevengo" placeholder="Fecha" value="Planilla de Anticipos desde">
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
                        <option value="<?php echo $value["id"];?>"><?php echo $value["primer_nombre"].' '.$value["primer_apellido"]; ?></option>
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
                        <option value="<?php echo $value["id"];?>"><?php echo $value["primer_nombre"].' '.$value["primer_apellido"]; ?></option>
                      <?php
                        }
                      ?>
                  </select>


                </div>
            </div>

            <div class="col-md-6">
              <button class="btn btn-primary filtrar_empleados"> Filtrar</button>

            </div>

            
        </div>

        <div class="col-md-12"><hr></div>
      </div>
  <!-- *************************** -->
        <div class="col-md-4">
          <!-- ***************** -->
            <div class="box-body" id="tabla_empleados" style=" height: 500px; overflow: scroll;">
            
            </div>

            <div class="row box-body">
              <div class="col-md-6 box-body">
                <button class="btn btn-primary mostrar_devengo" tipo="Suma" data-toggle="modal" data-target="#myModal" disabled="disabled">Agregar Devengo</button>
              </div>

              <div class="col-md-6 box-body">
                <button class="btn btn-success mostrar_devengo" tipo="Resta" data-toggle="modal" data-target="#descuento" disabled="disabled">Agregar Descuento</button>
              </div>
            </div>


          <!-- ***************** -->
        </div>

        <div class="col-md-8">
          <!-- ***************** -->
            <div class="box-body">
              
            <input type="hidden" id="accion_realizar">
            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
            <input type="hidden" name="codigo_empleado_planilladevengo" id="codigo_empleado_planilladevengo">
            <input type="hidden" name="nombre_empleado_planilladevengo" id="nombre_empleado_planilladevengo">
            <input type="hidden" name="id_empleado_planilladevengo" id="id_empleado_planilladevengo">

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dias Trabajado:</label>
                    <input type="text" class=" form-control " name="dias_trabajo_planilladevengo" id="dias_trabajo_planilladevengo" placeholder="Dias Trabajado">
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Dias Incapacidad:</label>
                    <input type="text" class=" form-control " name="dias_incapacidad" id="dias_incapacidad" placeholder="Dias Incapacidad">
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sueldo:</label>
                    <input type="text" class=" form-control " name="sueldo_planilladevengo" id="sueldo_planilladevengo" placeholder="Sueldo">
                  </div>
              </div>


              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hora Extra Diurna:</label>
                    <input type="text" class=" form-control " name="hora_extra_diurna_planilladevengo" id="hora_extra_diurna_planilladevengo" placeholder="Hora Extra Diurna">
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hora Extra Nocturna:</label>
                    <input type="text" class=" form-control " name="hora_extra_nocturna_planilladevengo" id="hora_extra_nocturna_planilladevengo" placeholder="Hora Extra Nocturna">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hora Extra Domingo:</label>
                    <input type="text" class=" form-control " name="hora_extra_domingo_planilladevengo" id="hora_extra_domingo_planilladevengo" placeholder="Hora Extra Domingo">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Hora Extra Domi. Noctu.:</label>
                    <input type="text" class=" form-control " name="hora_extra_domingo_nocturna_planilladevengo" id="hora_extra_domingo_nocturna_planilladevengo" placeholder="Hora Extra Domingo Nocturna">
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Otro Devengo:</label>
                    <input type="text" class=" form-control " name="otro_devengo_planilladevengo" id="otro_devengo_planilladevengo" placeholder="Otro Devengo">
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Devengado:</label>
                    <input type="text" class=" form-control " name="total_devengo_planilladevengo" id="total_devengo_planilladevengo" placeholder="Total Devengado">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descuento ISSS:</label>
                    <input type="text" class=" form-control " name="descuento_isss_planilladevengo" id="descuento_isss_planilladevengo" placeholder="Descuento ISSS">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descuento AFP:</label>
                    <input type="text" class=" form-control " name="descuento_afp_planilladevengo" id="descuento_afp_planilladevengo" placeholder="Descuento AFP">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Descuento Renta:</label>
                    <input type="text" class=" form-control " name="descuento_renta_planilladevengo" id="descuento_renta_planilladevengo" placeholder="Descuento Renta">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Otro Descuento:</label>
                    <input type="text" class="form-control " name="otro_descuento_planilladevengo" id="otro_descuento_planilladevengo" placeholder="Otro Descuento">
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Descuento:</label>
                    <input type="text" class="form-control " name="total_descuento_planilladevengo" id="total_descuento_planilladevengo" placeholder="Total Descuento">
                  </div>
              </div>

              
              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Liquido:</label>
                    <input type="hidden" class="originalliquido">
                    <input type="text" class="form-control " name="total_liquidado_planilladevengo" id="total_liquidado_planilladevengo" placeholder="Total Liquidado" value="0">
                  </div>
              </div>


              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sueldo Renta:</label>
                    <input type="text" class="form-control " name="sueldo_renta_planilladevengo" id="sueldo_renta_planilladevengo" placeholder="Sueldo Renta">
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sueldo ISSS:</label>
                    <input type="text" class="form-control " name="sueldo_isss_planilladevengo" id="sueldo_isss_planilladevengo" placeholder="Sueldo ISSS">
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sueldo AFP:</label>
                    <input type="text" class="form-control " name="sueldo_afp_planilladevengo" id="sueldo_afp_planilladevengo" placeholder="Sueldo AFP">
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Departamento:</label>
                    <input type="text" class="form-control " name="departamento_planilladevengo" id="departamento_planilladevengo" placeholder="Departamento">
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ubicación:</label>
                    <input type="hidden" name="codigo_ubicacion_planilladevengo" id="codigo_ubicacion_planilladevengo">

                    <input type="text" class="form-control " name="nombre_ubicacion_planilladevengo" id="nombre_ubicacion_planilladevengo" placeholder="Ubicación">

                    <input type="hidden" name="id_ubicacion_planilladevengo" id="id_ubicacion_planilladevengo">
                  </div>
              </div>

              <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Observación:</label>
                    <input type="text" class="form-control " name="observacion_planilladevengo" id="observacion_planilladevengo" placeholder="Observación">
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

<!-- Modal -->
<div id="myModal" class="modal fade modales" role="dialog">
  <div class="modal-dialog" style="width: 1000px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Devengo Y descuentos</h4>
      </div>
      <div class="modal-body">
          <!-- ***************** -->
          <input type="hidden" name="" id="" class="id_devengo">
          <input type="hidden" name="" id="" class="codigo_planilla_devengo">

          <input type="hidden" name="codigo_devengo_descuento_planilla" class="codigo_devengo_descuento_planilla" id="codigo_devengo_descuento_planilla">
          <input type="hidden" name="descripcion_devengo_descuento_planilla" class="descripcion_devengo_descuento_planilla" id="descripcion_devengo_descuento_planilla">

            <div class="form-group col-md-12">
              <label for="">Seleccionar Devengo o Descuento:</label>             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg tipo_devengo_descuento_planilla" name="tipo_devengo_descuento_planilla" id="tipo_devengo_descuento_planilla" required>                  
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
          
          <input type="hidden" name="porcentaje_isss_devengo_descuento_planilla" class="porcentaje_isss_devengo_descuento_planilla" id="porcentaje_isss_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_afp_devengo_descuento_planilla" class="porcentaje_afp_devengo_descuento_planilla" id="porcentaje_afp_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_renta_devengo_descuento_planilla" class="porcentaje_renta_devengo_descuento_planilla" id="porcentaje_renta_devengo_descuento_planilla">

          <input type="hidden" class="accion_devengo" id="accion_devengo" value="agregardevengo">

          <input type="hidden" name="" class="idempleado_devengo" id="idempleado_devengo">

          <input type="hidden" name="" class="tipo_valor" id="tipo_valor">


          <button class="btn btn-primary guardardevengo">Guardar</button>
          <br>
          <br>

          

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
          <input type="hidden" name="" id=""  class="id_devengo">
          <input type="hidden" name="" id="" class="codigo_planilla_devengo">
          <input type="hidden" name="codigo_devengo_descuento_planilla" class="codigo_devengo_descuento_planilla" id="codigo_devengo_descuento_planilla">
          <input type="hidden" name="descripcion_devengo_descuento_planilla" class="descripcion_devengo_descuento_planilla" id="descripcion_devengo_descuento_planilla">

            <div class="form-group col-md-12">
              <label for="">Seleccionar Devengo o Descuento:</label>             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg tipo_devengo_descuento_planilla" name="tipo_devengo_descuento_planilla" id="tipo_devengo_descuento_planilla" required>                  
                  <option value="" >Seleccione una opci&oacute;n</option>  
                  <?php
               	function consultar()
                 {
                   $query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE tipo='-Resta'";
                   $sql = Conexion::conectar()->prepare($query01);
                   $sql->execute();
                   return $sql->fetchAll();
                 };
                 $data01 = consultar();


                    foreach ($data01 as $value){
                      echo '<option tipo_valor="'.$value["tipo"].'" renta_devengo="'.$value["renta_devengo"].'" afp_devengo="'.$value["afp_devengo"].'" isss_devengo="'.$value["isss_devengo"].'"  descripcion="'.$value["descripcion"].'" codigo="'.$value["codigo"].'" value="'.$value["id"].'">'.$value["codigo"].','.$value["descripcion"].','.$value["porcentaje"].'% - $'.$value["tipo"].','.$value["cargo_abono"].','.$value["cuenta_contable"].'</option>';                     
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
          
            <input type="hidden" name="porcentaje_isss_devengo_descuento_planilla" class="porcentaje_isss_devengo_descuento_planilla" id="porcentaje_isss_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_afp_devengo_descuento_planilla" class="porcentaje_afp_devengo_descuento_planilla" id="porcentaje_afp_devengo_descuento_planilla">
          <input type="hidden" name="porcentaje_renta_devengo_descuento_planilla" class="porcentaje_renta_devengo_descuento_planilla" id="porcentaje_renta_devengo_descuento_planilla">

          <input type="hidden" class="accion_devengo" id="accion_devengo" value="agregardevengo">

          <input type="hidden" name="" class="idempleado_devengo" id="idempleado_devengo">
          <input type="hidden" name="" class="tipo_valor" id="tipo_valor">

          <button class="btn btn-primary guardardevengo">Guardar</button>
          <br>
          <br>

          

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




<script src="vistas/js/planilladevengo.js"></script>

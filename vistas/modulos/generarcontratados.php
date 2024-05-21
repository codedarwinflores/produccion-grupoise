<?php
date_default_timezone_set('America/El_Salvador');

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}



/* $fecha_actual = new DateTime();
 $fecha_inicio = clone $fecha_actual;
$fecha_inicio->modify('-1 month'); 

$primerDiaMes = $fecha_actual->format('Y-m-01');
$ultimoDiaMes = $fecha_actual->format('Y-m-t');
 */

?>
<div class="content-wrapper">



  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="empleados" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body bg-info">
        <div id="loader" style="display: none;">

        </div>
        <h3><strong>Búsqueda</strong></h3>
        <div class="row ">

          <form action="./vistas/modulos/reporteempleados.php" target="_blank" id="form_empleados" method="POST" autocomplete="off">
            <input type="hidden" name="consultar" value="hi">
            <div class="col-md-12">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Departamento 1</label>
                  <select name="departamento1" id="departamento1" class="form-control mi-selector">
                    <option value="*"> Seleccionar Departamentos</option>
                    <?php
                    function agente($orden)
                    {
                      $query = "SELECT * FROM `departamentos_empresa`order by id " . $orden;
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();
                      return $sql->fetchAll();
                    };
                    $data = agente("asc");
                    foreach ($data as $value) {
                      echo "<option value=" . $value["id"] . ">" . $value["codigo"] . '-' . $value["nombre"] . "</option>";
                    }
                    ?>
                  </select>

                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Departamento 2</label>
                  <select name="departamento2" id="departamento2" class="form-control mi-selector">
                    <option value="*"> Seleccionar Departamentos</option>
                    <?php
                    $data = agente("asc");
                    foreach ($data as $value) {
                      echo "<option value=" . $value["id"] . ">" . $value["codigo"] . '-' . $value["nombre"] . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>


              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Empleados</label>
                  <select name="empleados" id="empleados" class="form-control mi-selector">
                    <option value="*"> Seleccionar Empleados</option>
                    <?php
                    function empleados()
                    {
                      $query = "SELECT * FROM `tbl_empleados`order by id DESC";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();
                      return $sql->fetchAll();
                    };
                    $data_empleado = empleados();
                    foreach ($data_empleado as $value) {
                      echo "<option value=" . $value["id"] . ">" . "(" .  $value["codigo_empleado"] . ") - " . $value["numero_documento_identidad"] . " - " . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' '  . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Fecha desde</label>
                  <input type="date" class="form-control" value="" name="fechadesde" id="fechadesde">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Fecha hasta</label>
                  <input type="date" class="form-control" name="fechahasta" value="" id="fechahasta">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Agentes Reporte</label>
                  <select name="reportado_a_pnc" id="reportado_a_pnc" class="form-control">
                    <option value=""> Seleccionar Opción</option>
                    <option value="No"> Sin Reportar</option>
                    <option value="Si">Reportar sin Número</option>
                    <option value="Si">Reportados</option>
                    <option value="todos">Todos</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Tipo Agentes</label>
                  <select name="tipoagente" id="tipoagente" class="form-control">
                    <option value=""> Seleccionar Opción</option>
                    <option value="2"> Contratados</option>
                    <option value="3">Inactivos</option>
                    <option value="todos">Todos</option>
                  </select>
                </div>
              </div>


              <div class="col-md-12">
                <div class="pull-left">
                  <button type="submit" style="margin-right: 15px;" class="btn btn-info btn-searchform"><span class="fa fa-search-plus"></span> Filtrar</button>
                  <label for="rrhh" class="checkbox-inline">
                    <input type="checkbox" id="rrhh" name="rrhh" value="rrhh">
                    <strong>R.R.H.H</strong>
                  </label>
                </div>
                <div class="pull-right">
                  &nbsp;<button type="button" class="btn btn-default btn-cleanform"><span class="fa fa-eraser"></span> Limpiar</button>
                </div>
              </div>

            </div>
          </form>
        </div>


      </div>
      <div class="box-body">

        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
              <div class="pull-left">
                <h3><strong class="text-info">👆Filtrar Empleados</strong></h3><!-- AGREGAR BOTON DE IMPRIMIR -->
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
              <div id="mensajeview"></div>
            </div>

          </div>

        </div><!--//container-fluid-->





      </div>

    </div>




</div>
</section>


<script>
  var date = new Date();
  var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
  var hr2 = moment(primerDia, 'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

  var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
  var hr3 = moment(ultimoDia, 'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



  $(" .fechainicial").val(hr2);
  $(".fechaultimo").val(hr3);
</script>


<script src="./vistas/js/empleadosearch.js" async></script>
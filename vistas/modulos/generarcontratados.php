<?php

if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="content-wrapper">



  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="empleados" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body bg-info">
        <h3><strong>Búsqueda</strong></h3>
        <div class="row ">

          <form action="javascript:void()" id="form_empleados" method="GET">

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
                    $data = agente("desc");
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
                      $query = "SELECT * FROM `tbl_empleados`order by id ASC";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();
                      return $sql->fetchAll();
                    };
                    $data_empleado = empleados();
                    foreach ($data_empleado as $value) {
                      echo "<option value=" . $value["id"] . ">" . $value["numero_documento_identidad"] . " - " . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . "</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Fecha desde</label>
                  <input type="text" class="form-control calendario" name="fechadesde" id="fechadesde" data-lang="es" data-format="DD-MM-YYYY" readonly>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="">Fecha hasta</label>
                  <input type="text" class="form-control calendario" name="fechahasta" id="fechahasta" data-lang="es" data-format="DD-MM-YYYY" readonly>
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
                <button type="submit" onclick="cargar();" class="btn btn-info"><span class="fa fa-search-plus"></span> Filtrar</button>
                &nbsp;<button type="reset" class="btn btn-default" onclick="limpiar()"><span class="fa fa-eraser"></span> Limpiar</button>

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
                <h3><strong class="text-info">Litado de Empleados</strong></h3><!-- AGREGAR BOTON DE IMPRIMIR -->
              </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
              <div id="mensaje"></div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
              <div class="pull-right">
                <div class="dropdown" style="display: inline-block;">
                  <button class="btn btn-success dropdown-toggle left" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-file-excel-o"></i>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                    <li><a href="javascript:();" onclick="imprimir('xlsx')"><i class="bg-success fa fa-file-excel-o"></i> .xlsx</a></li>
                    <li><a href="javascript:();" onclick="imprimir('xls')"><i class="bg-success fa fa-file-excel-o"></i> .xls</a></li>
                    <li><a href="javascript:();" onclick="imprimir('csv')"><i class="bg-success fa fa-file-excel-o"></i> .csv</a></li>

                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div><!--//container-fluid-->
        <div id="loader" style="font-weight: bold; top:40vh; position: absolute; text-align: center;z-index: 9999;  width: 100%; display:none;"></div>
        <div id="verTabla">
        </div>



      </div>

    </div>




</div>
</section>
</div>

<script>
  var date = new Date();
  var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
  var hr2 = moment(primerDia, 'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

  var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
  var hr3 = moment(ultimoDia, 'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



  $(" .fechainicial").val(hr2);
  $(".fechaultimo").val(hr3);
</script>


<script src="./vistas/modulos/empleados/js/empleadosearch.js" async></script>
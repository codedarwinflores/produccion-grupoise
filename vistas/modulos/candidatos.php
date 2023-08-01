<?php


if ($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor") {

  echo '<script>
  
  window.location = "inicio";
  
  </script>';

  return;
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/modelos/conexion2.php");
/* echo "<script> alert('" . $_SERVER['DOCUMENT_ROOT'] . "')</script> "; */

/* require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php"); */
/* require($_SERVER['DOCUMENT_ROOT']."/armoni/git/modelos/conexion2.php"); */



?>



<div class="content-wrapper">

  <!-- ***********DATO DE CONFIGURACION -->

  <?php
  function idcargo()
  {
    $query = "SELECT * FROM cargos_desempenados where descripcion='Agente de seguridad' ";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
  };
  $data = idcargo();
  foreach ($data as $row) {
    echo "<input type='hidden' value='" . $row["id"] . "' class='idcargo' >";
  }
  ?>


  <?php
  function configuracion_inicial()
  {
    $query = "SELECT * FROM configuracion";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
  };
  $data = configuracion_inicial();
  foreach ($data as $row) {
    $salario_minimo = $row["salario_minimo"] / 2;
    $salario_diario = $row["salario_minimo"] / $row["periodo_de_pago"];
    $salario_hora = $row["salario_minimo"] / 240;
    $hora_diurna = $row["extra_diurna"];
    $hora_nocturna = $row["extra_nocturna"];
    $hora_diurna_domingo = $row["extra_dominical_diurna"];
    $hora_nocturna_domingo = $row["extra_dominical_nocturna"];


    echo "<input type='hidden' value='" . $salario_minimo . "' class='salario_minimo' >";
    echo "<input type='hidden' value='" . bcdiv($salario_diario, '1', 4) . "' class='salario_diario' >";
    echo "<input type='hidden' value='" . bcdiv($salario_hora, '1', 4) . "' class='salario_hora' >";
    echo "<input type='hidden' value='" . bcdiv($hora_diurna, '1', 4) . "' class='hora_diurna' >";
    echo "<input type='hidden' value='" . bcdiv($hora_nocturna, '1', 4) . "' class='hora_nocturna' >";
    echo "<input type='hidden' value='" . bcdiv($hora_diurna_domingo, '1', 4) . "' class='hora_diurna_domingo' >";
    echo "<input type='hidden' value='" . bcdiv($hora_nocturna_domingo, '1', 4) . "' class='hora_nocturna_domingo' >";
  }
  ?>


  <!-- **************** -->

  <section class="content">



    <div class="box-header with-border">
      <section class="content-header">
        <h1>
          Empleados
          <small>Agregar Contrataci&oacute;n</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="empleados"><i class="fa fa fa-drivers-license-o"></i> Empleados</a></li>
          <li class="active">Volver</li>
        </ol>
      </section>





    </div>
    <div class="box">
      <div class="box-body" id="impresion">

        <!--DATOS GENERALES-->
        <div class="col-md-12" align="left">
          <form role="form" method="post" enctype="multipart/form-data">

            <?php
            function idconfiguracion()
            {
              $query = "SELECT * FROM configuracion";
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();
              return $sql->fetchAll();
            };
            $data = idconfiguracion();
            foreach ($data as $row) {
              echo "<input type='hidden' value='" . $row["id"] . "' name='nuevoidconfiguracion' class='nuevoidconfiguracion' >";
            }
            ?>

            <input type="hidden" name="idEmpleado" value="<?php echo isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : '' ?>">

            <div class="modal-body">

              <div class="box-body">

                <div class="col-md-12">
                  <label style="font-size: xx-large;color: #f7af10;">Datos generales</label>
                  <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                  </hr>
                </div>

                <!-- *********** -->

                <div class="col-md-12">
                  <!-- ENTRADA PARA SELECCIONAR ESTADO -->
                  <div class="form-group">
                    Estado:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg estadoempleado" name="nuevoEstado" campo="">
                        <!-- <option value="" id="nuevoEstado"></option>      -->
                        <option value="2">Contratado</option>
                        <option value="1">Solicitud</option>
                        <option value="3">Inactivo</option>
                        <option value="4">Incapacitado</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- *********** -->
                <div class="col-md-12">
                  <!-- ENTRADA PARA SUBIR FOTO -->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO</div>
                    <input type="file" class="nuevaFoto" name="nuevoFoto">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
                    <input type="hidden" name="fotoActual" id="fotoActual">
                  </div>
                </div>



                <div class="col-md-12">
                  <div class="col-md-4">
                    <!-- ENTRADA PARA EL PRIMER NOMBRE -->
                    <div class="form-group">
                      Primer Nombre:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoNombre" name="nuevoNombre" value="" campo="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- ENTRADA PARA EL SEGUNDO NOMBRE -->
                    <div class="form-group">
                      Segundo Nombre:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoSegundoNombre" name="nuevoSegundoNombre" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- ENTRADA PARA EL TERCER NOMBRE -->
                    <div class="form-group">
                      Tercer Nombre:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoTercerNombre" name="nuevoTercerNombre" value="">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-4">
                    <!-- ENTRADA PARA EL PRIMER APELLIDO -->
                    <div class="form-group">
                      Primer Apellido:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoPrimerApellido" name="nuevoPrimerApellido" value="" campo="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->
                    <div class="form-group">
                      Segundo Apellido:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoSegundoApellido" name="nuevoSegundoApellido" value="" campo="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 apellidocasada">
                    <!-- ENTRADA PARA EL APELLIDO DE CASADA-->
                    <div class="form-group">
                      Apellido Casada:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg apellido_casada" id="nuevoApellidoCasada" name="nuevoApellidoCasada" value="">
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="col-md-6">
                    <!-- ENTRADA PARA SELECCIONAR ESTADO CIVIL -->
                    <div class="form-group">
                      Estado Civil:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select class="form-control input-lg" name="nuevoEstadoCivil">
                          <option value="" id="nuevoEstadoCivil"></option>
                          <option value="Soltero(a)">Soltero(a)</option>
                          <option value="Casado(a)">Casado(a)</option>
                          <option value="Divorciado(a)">Divorciado(a)</option>
                          <option value="Viudo(a)">Viudo(a)</option>
                          <option value="Uni&oacute;n no Matrimonial">Uni&oacute;n no Matrimonial</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- ENTRADA PARA SELECCIONAR SEXO -->
                    <div class="form-group">
                      Sexo:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select class="form-control input-lg camposexo" name="nuevoSexo">
                          <option value="" id="nuevoSexo"></option>
                          <option value="Masculino">Masculino</option>
                          <option value="Femenino">Femenino</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-12">
                    <!-- ENTRADA PARA LA DIRECCION DE RESIDENCIA -->
                    <div class="form-group">
                      Direcci&oacute;n de Residencia:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoDireccion" name="nuevoDireccion" value="">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-4">

                    <!-- ***DEPARTAMENTO -->
                    <!-- *** -->
                    <div class="form-group">
                      Departamento:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" id="showdepa" readonly>
                        <select class="form-control input-lg  mi-selector departamento" name="nuevoDepartamento">
                          <option id="editarDepartamento"></option>
                          <?php
                          $datos_mostrar_departamento = Controladorcat_departamento::ctrMostrar($item, $valor);
                          foreach ($datos_mostrar_departamento as $key => $value) {
                            echo '<option value="' . $value["id"] . '">' . $value["Nombre"] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">

                    <!-- ***MUNICIPIO -->
                    <!-- *** -->
                    <div class="form-group">
                      Municipio:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <input type="text" class="form-control" id="showmunicipio" readonly>

                        <select class="form-control input-lg mi-selector municipios" name="nuevoMunicipio">
                          <option id="nuevoMunicipio"></option>
                          <?php
                          $datos_mostrar_municipio = Controladorcat_municipios::ctrMostrar($item, $valor);
                          foreach ($datos_mostrar_municipio as $key => $value) {
                            echo '<option value="' . $value["id"] . '">' . $value["Nombre_m"] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <!-- ENTRADA PARA EL NUMERO DE TELEFONO -->
                    <div class="form-group">
                      N&uacute;mero de Tel&eacute;fono:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg input_telefono_1 telefono" id="nuevoNumeroTelefono" name="nuevoTelefono" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <label style="font-size: xx-large;color: #f7af10;">Documentaci&oacute;n</label>
                  <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                  </hr>
                </div>

                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="form-group">
                      ¿Es pensionado?
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <select class="form-control input-lg pensionado_empleado" name="pensionado_empleado" id="pensionado_empleado">
                          <option value="">¿Es pensionado?</option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- ********ISSSS CAMPOS******** -->
                <div class="col-md-12 ocultarisss">
                  <div class="col-md-6">
                    <!-- ENTRADA PARA EL NUMERO ISSS-->
                    <div class="form-group">
                      N&uacute;mero de ISSS:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoNumeroIsss" name="nuevoNumeroIsss" value="" placeholder="Ingresar N&uacute;mero de ISSS">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- ENTRADA PARA EL NOMBRE ISSS -->
                    <div class="form-group">
                      Nombre Seg&uacute;n ISSS:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoNombreIsss" name="nuevoNombreIsss" value="" placeholder="Ingresar Nombre Seg&uacute;n ISSS">
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12 ocultarisss">
                  <div class="col-md-12">
                    <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
                    <div class="form-group">
                      <div class="panel">Subir foto de ISSS</div>
                      <input type="file" class="fotoisss" name="nuevofotoisss">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarfotoisss" width="100px">
                      <input type="hidden" name="editfotoisss" id="editfotoisss">
                    </div>

                  </div>
                </div>

                <!-- ********ISSSS CAMPOS******** -->

                <div class="col-md-12">
                  <div class="col-md-6">
                    <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
                    <div class="form-group">
                      Tipo de Documento:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select class="form-control input-lg" name="nuevoTipoDocumento" campo="">
                          <option value="" id="nuevoTipoDocumento">Tipo de Documento</option>
                          <option value="DUI">DUI</option>
                          <option value="Pasaporte">Pasaporte</option>
                          <option value="Carnet residente">Carnet residente</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- ENTRADA PARA EL NUMERO DOCUMENTO IDENTIDAD -->
                    <div class="form-group">
                      N&uacute;mero Documento Identidad:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg input_dui duis" id="nuevoNumeroDocumento" name="nuevoNumeroDocumento" value="" campo="">
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="col-md-4">
                    <!-- ENTRADA PARA FECHA EXPEDICION DOCUMENTO -->
                    <div class="form-group">
                      Fecha Expedici&oacute;n Documento:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="" class="calendario nuevofecha_expedicion form-control input-lg" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_expedicion" placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                        <input type="text" class="oficial_nuevofecha_expedicion" name="nuevofecha_expedicion" style="display: none;" id="nuevofecha_expedicion">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- ENTRADA PARA FECHA VENCIMIENTO DOCUMENTO -->
                    <div class="form-group">
                      Fecha Vencimiento Documento:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="" class="calendario nuevofecha_vencimiento form-control input-lg" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_vencimiento" placeholder="Ingresar Fecha" id="mascarafechav" readonly>
                        <input type="text" class="oficial_nuevofecha_vencimiento" name="nuevofecha_vencimiento" style="display: none;" id="nuevofecha_vencimiento">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <!-- ENTRADA PARA LUGAR EXPEDICION DOCUMENTO -->
                    <div class="form-group">
                      Lugar Expedici&oacute;n Documento:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="nuevoLugarExpedicionDoc" name="nuevoLugarExpedicionDoc" value="" placeholder="Ingresar Lugar Expedici&oacute;n Documento">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-12">
                    <!-- ENTRADA PARA SUBIR FOTO -->
                    <div class="form-group">
                      <div class="panel">SUBIR FOTO DOCUMENTO IDENTIDAD</div>
                      <input type="file" class="nuevaFotoDoc" name="nuevoFotoDoc">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarDoc" width="100px">
                      <input type="hidden" name="fotoActualDoc" id="fotoActualDoc">
                    </div>
                  </div>
                </div>



                <div class="col-md-12">
                  <div class="col-md-6">
                    <!-- ENTRADA PARA LICENCIA DE CONDUCIR-->
                    <div class="form-group">
                      N&uacute;mero de Licencia de Conducir:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg input_nit nits" id="nuevoNumeroLicenciaConducir" name="nuevoLicenciaConducir" value="" placeholder="Ingresar N&uacute;mero de Licencia de Conducir">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- ENTRADA PARA SELECCIONAR TIPO LICENCIA CONDUCIR -->
                    <div class="form-group">
                      Tipo Licencia de Conducir:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select class="form-control input-lg" name="nuevoTipoLicenciaConducir">
                          <option value="" id="nuevoTipoLicenciaConducir"></option>
                          <option value="Particular">Particular</option>
                          <option value="Liviana">Liviana</option>
                          <option value="Motociclista">Motociclista</option>
                          <option value="Pesada">Pesada</option>
                          <option value="TPesada">TPesada</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>



                <div class="col-md-12">
                  <div class="col-md-12 ocultartodo">
                    <!-- ENTRADA PARA SUBIR FOTO LICENCIA CONDUCIR-->
                    <div class="form-group">
                      <div class="panel">SUBIR FOTO LICENCIA DE CONDUCIR</div>
                      <input type="file" class="nuevaFotoLicCond" name="nuevoFotoLicCond">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarLicCond" width="100px">
                      <input type="hidden" name="fotoActualLicCond" id="fotoActualLicCond">
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="col-md-12">
                    <!-- ENTRADA PARA NIT-->
                    <div class="form-group">
                      N&uacute;mero de NIT:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg input_nit nits" id="nuevoNumeroNit" name="nuevoNumeroNIT" value="" placeholder="Ingresar N&uacute;mero de NIT">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <!-- ENTRADA PARA SUBIR NIT -->
                    <div class="form-group">
                      <div class="panel">SUBIR FOTO NIT</div>
                      <input type="file" class="nuevaFotoNIT" name="nuevoFotoNIT">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarNIT" width="100px">
                      <input type="hidden" name="fotoActualNIT" id="fotoActualNIT">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA AFP  -->
                  <div class="form-group">
                    AFP:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="nuevoAFP" id="editarAFPselect">
                        <option id="nuevoAFP">Seleccione AFP</option>
                        <?php
                        $datos_mostrar_afp = ControladorAfp::ctrMostrarAfp($item, $valor);
                        foreach ($datos_mostrar_afp as $key => $value) {
                          echo '<option nombre="' . $value["nombre"] . '"  value="' . $value["codigo"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- ENTRADA PARA NUUP-->
                  <div class="form-group">
                    N&uacute;mero de NUP:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroNup" name="nuevoNumeroNUP" value="" placeholder="Ingresar N&uacute;mero NUP">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
                  <div class="form-group">
                    <div class="panel">Subir foto de Carnet de AFP</div>
                    <input type="file" class="carnetafp" name="nuevocarnetafp">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarcarnetafp" width="100px">
                    <input type="hidden" name="editcarnetafp" id="editcarnetafp">
                  </div>

                </div>
              </div>

              <div class="col-md-12">
                <label style="font-size: xx-large;color: #f7af10;">Documentaci&oacute;n complementaria</label>
                <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                </hr>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <!-- ENTRADA PARA PROFESION OFICIO -->
                  <div class="form-group">
                    Profesi&oacute;n u Oficio:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoProfesionOficio" name="nuevoProfesionOficio" value="" placeholder="Ingresar Profesi&oacute;n u Oficio">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA NACIONALIDAD -->
                  <div class="form-group">
                    Nacionalidad:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoNacionalidad" name="nuevoNacionalidad" value="" placeholder="Ingresar Nacionalidad">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA LUGAR NACIEMIENTO -->
                  <div class="form-group">
                    Lugar de Nacimiento:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoLugarNacimiento" name="nuevoLugarNacimiento" value="" placeholder="Ingresar Lugar de Nacimiento">
                    </div>
                  </div>
                </div>
              </div>




              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA FECHA NACIEMIENT -->
                  <div class="form-group">
                    Fecha Nacimiento:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_nacimiento form-control input-lg capturarfechanac" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_nacimiento" placeholder="Ingresar Fecha" id="mascarafechanac" readonly>
                      <input type="text" class="oficial_nuevofecha_nacimiento " name="nuevofecha_nacimiento" style="display: none;" id="editarfecha_nacimiento">
                      <p style="color:red;" class="mostrarerror">ERROR. NO ES MAYOR A 18 AÑOS</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- ENTRADA PARA RELIGION -->
                  <div class="form-group">
                    Religi&oacute;n:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoReligion" name="nuevoReligion" value="" placeholder="Ingresar Religi&oacute;n">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA GRADO DE ESTUDIOS -->
                  <div class="form-group">
                    Grado de Estudios:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoGradoEstudios" name="nuevoGradoEstudio" value="" placeholder="Ingresar Grado de Estudios">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- ENTRADA PARA PLANTEL-->
                  <div class="form-group">
                    Plantel:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoPlantel" name="nuevoPlantel" value="" placeholder="Ingresar Plantel">
                    </div>
                  </div>
                </div>
              </div>






              <div class="col-md-12">
                <div class="col-md-4">
                  <!-- ENTRADA PARA PESO-->
                  <div class="form-group">
                    Peso:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoPeso" name="nuevoPeso" value="" placeholder="Ingresar Peso">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA NUESTATURAP-->
                  <div class="form-group">
                    Estatura:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoEstatura" name="nuevoEstatura" value="" placeholder="Ingresar Estatura">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA PIEL-->
                  <div class="form-group">
                    Color de Piel:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoPiel" name="nuevoPiel" value="" placeholder="Ingresar Color Piel">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-4">
                  <!-- ENTRADA PARA OJOS-->
                  <div class="form-group">
                    Color de Ojos:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoOjos" name="nuevoOjos" value="" placeholder="Ingresar Color Ojos">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA CABELLO-->
                  <div class="form-group">
                    Color de Cabello:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoCabello" name="nuevoCabello" value="" placeholder="Ingresar Color Cabello">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA CARA-->
                  <div class="form-group">
                    Cara:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input-lg" id="nuevoCara" name="nuevoCara">
                        <option value="">Seleccione Tipo de Cara</option>
                        <option value="Redonda">Redonda</option>
                        <option value="Ovalada">Ovalada</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA SELECCIONAR TIPO DE SANGRE-->
                  <div class="form-group">
                    Tipo de Sangre:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="nuevoTipoSangre">
                        <option value="" id="nuevoTipoSangre"></option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="Pendiente">Pendiente</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA PARA SENALES ESPECIALES-->
                  <div class="form-group">
                    Se&nacute;ales Especiales:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoSenalesEspeciales" name="nuevoSenalesEspeciales" value="" placeholder="Ingresar Se&nacute;ales Especiales">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA TIENE LICENCIA TDA-->
                  <div class="form-group">
                    Licencia de portación de arma (LPA):
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="nuevoLicenciaTDA">
                        <option value="" id="nuevoLicenciaTDA"></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA PARA NUMERO LICENCIA TDA-->
                  <div class="form-group">
                    N&uacute;mero Licencia Tenencia de Armas:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoNumeroLicenciaTDA" name="nuevoNumeroLicenciaTDA" value="" placeholder="Ingresar N&uacute;mero Licencia Tenencia de Armas">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
                  <div class="form-group">
                    <div class="panel">Subir foto de Licencia de portación de arma (LPA)</div>
                    <input type="file" class="imagenlpa" name="nuevoimagenlpa">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarimagenlpa" width="100px">
                    <input type="hidden" name="editimagenlpa" id="editimagenlpa">
                  </div>

                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA SELECCIONAR SI TIENE LICENCIA D EARMAS-->
                  <div class="form-group">
                    Licencia para uso de arma de fuego(LUAF):
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-address-card"></i></span>
                      <input type="text" class="form-control input-lg" name="nuevoluaf" placeholder="Ingresar Licencia para uso de arma de fuego(LUAF)" id="nuevoluaf">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA FECHA VENCIMIENTO LTA-->
                  <div class="form-group">
                    Fecha vencimiento de Licencia de portación de arma (LPA):
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_venLTA form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_venLTA" placeholder="Ingresar Fecha" id="mascarafecha_venLTA" readonly>
                      <input type="text" class="oficial_nuevofecha_venLTA" name="nuevofecha_nuevofecha_venLTA" style="display: none;" id="nuevofecha_venLTA">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 ocultartodo">
                  <!-- ENTRADA PARA SUBIR FOTO LICENCIA LTA-->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO LICENCIA TENENCIA DE ARMAS</div>
                    <input type="file" class="nuevaFotoLicLTA" name="nuevoFotoLicLTA">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarLicLTA" width="100px">
                    <input type="hidden" name="fotoActualLicLTA" id="fotoActualLicLTA">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <label style="font-size: xx-large;color: #f7af10;">Servicio militar y PNC</label>
                <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                </hr>
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA TIENE SERVICIO MILITAR-->
                  <div class="form-group">
                    Hizo Servicio Militar:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg serviciomilitar" name="nuevoServicioMilitar">
                        <option value="" id="nuevoServicioMilitar"></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-4 noservicio">
                  <!-- ENTRADA PARA FECHA INI SER MIL-->
                  <div class="form-group">
                    Fecha Inicio Servicio Militar:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="fechainicioservicio calendario nuevofecha_inism form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_inism" placeholder="Ingresar Fecha" id="mascarafechainism" readonly>
                      <input type="text" class="oficial_nuevofecha_inism" name="nuevofecha_inism" style="display: none;" id="nuevofecha_inism">
                    </div>
                  </div>
                </div>
                <div class="col-md-4 noservicio">
                  <!-- ENTRADA PARA FECHA FIN SER MIL-->
                  <div class="form-group">
                    Fecha Fin Servicio Militar:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_finsm form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_finsm" placeholder="Ingresar Fecha" id="mascarafechafinsm" readonly>
                      <input type="text" class="oficial_nuevofecha_finsm" name="nuevofecha_finsm" style="display: none;" id="nuevofecha_finsm">
                    </div>
                  </div>
                </div>
                <div class="col-md-4 noservicio">
                  <!-- ENTRADA PARA LUGAR SERVICIO MILITAR-->
                  <div class="form-group">
                    Lugar de Servicio Militar:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoLugarServicioMilitar" name="nuevoLugarServicioMilitar" value="" placeholder="Ingresar Lugar de Servicio Militar">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6 noservicio">
                  <!-- ENTRADA PARA GRADO MILITAR-->
                  <div class="form-group">
                    Grado Militar:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoGradoMilitar" name="nuevoGradoMilitar" value="" placeholder="Ingresar Grado Militar">
                    </div>
                  </div>
                </div>

                <div class="col-md-6 noservicio">
                  <!-- ENTRADA PARA MOTIVO BAJA-->
                  <div class="form-group">
                    MOtivo Baja:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoMotivoBaja" name="nuevoMotivoBaja" value="" placeholder="Ingresar Motivo de la Baja">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA SABER SI ES EX PNC-->
                  <div class="form-group">
                    Es Ex-PNC?
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="nuevoExPnc">
                        <option value="" id="nuevoExPNC"></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA PARA SABER HA CURSADO ANSP-->
                  <div class="form-group">
                    HA CURSADO ANSP?
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg nuevoCursoANSP" name="nuevoCursoANSP">
                        <option value="" id="nuevoCursoANSP"></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>



                <!-- *******NUEVO CODIGO******** -->




                <div class="col-md-6 nuevofecha_curso_ansp fecha_ansp" style="display: none;">
                  <!-- ENTRADA PARA SELECCIONAR SI TIENE Aprobó curso ANSP -->
                  <div class="form-group nuevofecha_curso_ansp">
                    Fecha en la que aprobó curso ANSP:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_curso_ansp form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="nuevofecha_curso_ansp" id="nuevofecha_curso_ansp" fecha="nuevofecha_curso_ansp" placeholder="Ingresar Fecha" readonly="">
                    </div>
                  </div>
                </div>

                <div class="col-md-6 nuevofecha_curso_ansp fecha_ansp" style="display: none;">

                  <!-- ENTRADA PARA SELECCIONAR SI TIENE Aprobó curso ANSP -->
                  <div class="form-group nuevofecha_curso_ansp">
                    Número de Aprobación :
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="solonumero nuevonumero_aprobacion_ansp  form-control input-lg" name="nuevonumero_aprobacion_ansp" id="nuevonumero_aprobacion_ansp" maxlength="20" placeholder="Ingresar Número de Aprobación">
                    </div>
                  </div>

                </div>

                <!-- **************** -->
              </div>

              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
                  <div class="form-group">
                    <div class="panel">Subir foto de Certificado del ANSP</div>
                    <input type="file" class="fotoansp" name="nuevofotoansp">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarfotoansp" width="100px">
                    <input type="hidden" name="editfotoansp" id="editfotoansp">
                  </div>

                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DIPLOMA ANSP</div>
                    <input type="file" class="nuevaFotoANSP" name="nuevoFotoANSP">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarANSP" width="100px">
                    <input type="hidden" name="fotoActualANSP" id="fotoActualANSP">
                  </div>

                </div>
              </div>
              <div class="col-md-12">
                <label style="font-size: xx-large;color: #f7af10;">Datos laborales</label>
                <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                </hr>
              </div>
              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA TRABAJO ANTERIOR-->
                  <div class="form-group">
                    Nombre Trabajo Anterior:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg " id="nuevoTrabajoAnterior" name="nuevoTrabajoAnterior" value="" placeholder="Ingresar Trabajo Anterior">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA PARA SUELDO QUE DEVENGO-->
                  <div class="form-group">
                    Sueldo que Deveng&oacute;:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoSueldoDevengo" name="nuevoSueldoDevengo" value="" placeholder="Ingresar Sueldo que Deveng&oacute;">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA NUMERO DE TEL TRABAJO ANTERIOR-->
                  <div class="form-group">
                    N&uacute;mero de Tel&eacute;fono Trabajo Anterior:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg telefono" id="nuevoNumTelTrabajoAnterior" name="nuevoNumeroTelTrabajoAnterior" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono Trabajo Anterior">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA NUMERO DE REF TEL TRABAJO ANTERIOR-->
                  <div class="form-group">
                    Nombre de Referencia Trabajo Anterior:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoNomRefTrabajoAnterior" name="nuevoNombreRefTrabajoAnterior" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Anterior">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA EVALUACION ANTERIOR-->
                  <div class="form-group">
                    Evaluaci&oacute;n Anterior:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoEvaluacionAnterior" name="nuevoEvaluacionAnterior" value="" placeholder="Ingresar Evaluaci&oacute;n Anterior">
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA TRABAJO ACTUAL-->
                  <div class="form-group">
                    Nombre Trabajo Actual:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoTrabajoActual" name="nuevoTrabajoActual" value="" placeholder="Ingresar Trabajo Actual">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA PARA SUELDO QUE DEVENGa-->
                  <div class="form-group">
                    Sueldo que Devenga:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoSueldoDevenga" name="nuevoSueldoDevenga" value="" placeholder="Ingresar Sueldo que Devenga">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA NOM DE REF TEL TRABAJO ACTUAL-->
                  <div class="form-group">
                    Nombre de Referencia Trabajo Actual:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoNomRefTrabajoActual" name="nuevoNomRefTrabajoActual" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Actual">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- ENTRADA PARA EVALUACION ACTUAL-->
                  <div class="form-group">
                    Evaluaci&oacute;n Actual:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoEvaluacionActual" name="nuevoEvaluacionActual" value="" placeholder="Ingresar Evaluaci&oacute;n Actual">
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA SABER SI FUE SUSPENDIDO ANTERIO-->
                  <div class="form-group">
                    Ha sido Suspendido en Trabajos anteriores?
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg suspendido" name="nuevoSuspendidoAnterior">
                        <option value="" id="nuevoSuspendidoAnterior"></option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 nosuspendido">
                  <!-- ENTRADA PARA EMPRESA SUSPENDIO-->
                  <div class="form-group">
                    Empresa que lo Suspendi&oacute;
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg empresasuspencion" id="nuevoEmpresaSuspendio" name="nuevoEmpresaSuspendio" value="" placeholder="Ingresar Empresa que lo Suspendi&oacute;">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6 nosuspendido">
                  <!-- ENTRADA PARA FECHA SUSPENSION-->
                  <div class="form-group">
                    Fecha Suspensi&oacute;n:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_susp fechasuspencion form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_susp" placeholder="Ingresar Fecha" id="mascarafechasusp" readonly>
                      <input type="text" class="oficial_nuevofecha_susp" name="nuevofecha_susp" style="display: none;" id="nuevofecha_susp">
                    </div>
                  </div>
                </div>

                <div class="col-md-6 nosuspendido">
                  <!-- ENTRADA PARA MOTIVO SUSPENSION-->
                  <div class="form-group">
                    Motivo Suspensi&oacute;n:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg motivosuspension" id="nuevoMotivoSuspension" name="nuevoMotivoSuspension" value="" placeholder="Ingresar Motivo Suspensi&oacute;n">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-12 ">
                  <!-- ENTRADA PARA EXPERIENCI ALABORAL-->
                  <div class="form-group">
                    Experiencia Laboral:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoExperienciaLaboral" name="nuevoExperienciaLaboral" value="" placeholder="Ingresar Experiencia Laboral">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <label style="font-size: xx-large;color: #f7af10;">Im&aacute;genes de documentos e informaci&oacute;n complementaria</label>
                <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                </hr>
              </div>


              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA RAZON ISE-->
                  <div class="form-group">
                    Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoRazonIse" name="nuevoRazonIse" value="" placeholder="Ingresar Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <!-- ENTRADA PARA PERSONAS DEPENDIENTES-->
                  <div class="form-group">
                    N&uacute;mero de Personas Dependientes:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="nuevoPersonasDependientes" name="nuevoNumeroPersonasDependientes" value="" placeholder="Ingresar N&uacute;mero de Personas Dependientes">
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <!-- ENTRADA PARA OBSERVACIONES-->
                  <div class="form-group">
                    Observaciones:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="nuevoObservaciones" name="nuevoObservaciones" value="" placeholder="Ingresar Observaciones">
                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-12">
                  <!-- ENTRADA PARA INFO VERIFICADA-->
                  <div class="form-group">
                    Ha verificado la informaci&oacute;n?
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg" name="nuevoInfoVerificada">
                        <!-- <option value="" id="nuevoInfoVerificada"></option>   -->
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-6" style="display: none;">
                  <!-- ENTRADA PARA SUBIR DE SOLICITUD-->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DE SOLICITUD</div>
                    <input type="text" class="nuevaFotoSOLICITUD" name="nuevoFotoSOLICITUD">
                    <!--   <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarSOLICITUD" width="100px">
                        <input type="hidden" name="fotoActualSOLICITUD" id="fotoActualSOLICITUD"> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- ENTRADA PARA SUBIR FOTO  PARTIDA NACIMIENTO-->
                  <div class="form-group ocultartodo">
                    <div class="panel">SUBIR FOTO DE PARTIDA DE NACIMIENTO</div>
                    <input type="file" class="nuevaFotoPARTIDA" name="nuevoFotoPARTIDA">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPARTIDA" width="100px">
                    <input type="hidden" name="fotoActualPARTIDA" id="fotoActualPARTIDA">
                  </div>
                </div>
              </div>

              <!-- *********** -->




              <div class="col-md-12">

                <div class="col-md-12" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                    Tiene Antecedentes policiales:
                    <div class="input-group" bis_skin_checked="1">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input-lg nuevoantecedente_policial" name="nuevoantecedente_policial" id="nuevoantecedente_policial">
                        <option value="">Tiene Antecedentes policiales</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>

                    </div>
                  </div>
                </div>


              </div>

              <!-- ************* -->

              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA FECHA VENC AP-->
                  <div class="form-group">
                    Fecha Vencimiento Antecedentes Penales:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_venceAP form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_venceAP" placeholder="Ingresar Fecha" id="mascarafechavenceAP" readonly>
                      <input type="text" class="oficial_nuevofecha_venceAP" name="nuevofecha_venceAP" style="display: none;" id="nuevofecha_venceAP">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- ENTRADA PARA SUBIR FOTO DE ANTECEDENTES PENALES-->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DE ANTECEDENTES PENALES</div>
                    <input type="file" class="nuevaFotoANTECEDENTES" name="nuevoFotoANTECEDENTES">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarANTECEDENTES" width="100px">
                    <input type="hidden" name="fotoActualANTECEDENTES" id="fotoActualANTECEDENTES">
                  </div>
                </div>
              </div>


              <div class="col-md-12">
                <div class="col-md-6">
                  <!-- ENTRADA PARA FECHA VENCIMIENTO SOLV PNC-->
                  <div class="form-group">
                    Fecha Vencimiento Solvencia PNC:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" value="" class="calendario nuevofecha_venceSPNC form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_venceSPNC" placeholder="Ingresar Fecha" id="mascarafechavenceSPNC" readonly>
                      <input type="text" class="oficial_nuevofecha_venceSPNC" name="nuevofecha_venceSPNC" style="display: none;" id="nuevofecha_venceSPNC">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <!-- ENTRADA PARA SUBIR SOLVENCIA PNC -->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DE SOLVENCIA PNC</div>
                    <input type="file" class="nuevaFotoSOLVENCIAPNC" name="nuevoFotoSOLVENCIAPNC">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarSOLVENCIAPNC" width="100px">
                    <input type="hidden" name="fotoActualSOLVENCIAPNC" id="fotoActualSOLVENCIAPNC">
                  </div>
                </div>
              </div>


              <!-- **********NUEVO CAMPOS******** -->


              <div class="col-md-12">

                <div class="col-md-6" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                    Constancia Psicológica:
                    <div class="input-group" bis_skin_checked="1">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input-lg nuevoconstancia_psicologica" name="nuevoconstancia_psicologica" id="nuevoconstancia_psicologica">
                        <!-- <option value="">Constancia Psicológica</option> -->
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>

                    </div>
                  </div>
                </div>


                <div class="col-md-6">
                  <div class="form-group">
                    <div class="">Nombre del Psicologo</div>
                    <div class="">
                      <select class="form-control  input-lg nuevonombre_psicologo" name="nuevonombre_psicologo" id="nuevonombre_psicologo" style="display: none;">
                        <option value="vacio">Seleccione el Nombre del Psicologo</option>
                        <?php
                        function getcargo()
                        {
                          $query = "SELECT * FROM configuracion";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();
                          return $sql->fetchAll();
                        };

                        $data = getcargo();
                        foreach ($data as $row) {
                          echo "<option value='" . $row["psicologo"] . "' >" . $row["psicologo"] . "</option>";
                        }
                        ?>
                      </select>

                    </div>
                  </div>
                </div>
              </div>


              <div class="col-md-12">

                <div class="col-md-6" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                    Tiene examen poligráfico:
                    <div class="input-group" bis_skin_checked="1">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input-lg nuevoexamen_poligrafico" name="nuevoexamen_poligrafico" id="nuevoexamen_poligrafico">
                        <!-- <option value="">Tiene examen poligráfico</option> -->
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>

                    </div>
                  </div>
                </div>

                <div class="col-md-4" bis_skin_checked="1">
                  <div class="form-group" bis_skin_checked="1">
                    Fecha examen poligráfico:
                    <div class="input-group" bis_skin_checked="1">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input type="text" class="form-control input-lg calendario nuevoFecha_poligrafico" name="nuevoFecha_poligrafico" id="nuevoFecha_poligrafico" readonly="readonly" style="display: none;">


                    </div>
                  </div>
                </div>

                <div class="col-md-12 esconfiable">
                  <!-- ENTRADA PARA CONFIABLE-->
                  <div class="form-group">
                    Es Confiable?
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg " name="nuevoConfiable">
                        <!-- <option value="" id="nuevoConfiable"></option>   -->
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>



              <!-- ***************************** -->
              <div class="col-md-12">
                <div class="col-md-4 ocultartodo">
                  <!-- ENTRADA PARA SUBIR CONSTANCIA PSYCOLOGICA -->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DE CONSTANCIA PSICOLOGICA</div>
                    <input type="file" class="nuevaFotoPSYCO" name="nuevoFotoPSYCO">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPSYCO" width="100px">
                    <input type="hidden" name="fotoActualPSYCO" id="fotoActualPSYCO">
                  </div>
                </div>
                <div class="col-md-4 ocultartodo">
                  <!-- ENTRADA PARA SUBIR EXAMEN POLIGRAFICO -->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DE EXAMEN POLIGRAFICO</div>
                    <input type="file" class="nuevaFotoPOLI" name="nuevoFotoPOLI">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPOLI" width="100px">
                    <input type="hidden" name="fotoActualPOLI" id="fotoActualPOLI">
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA SUBIR HUELLAS DIGITALES -->
                  <div class="form-group">
                    <div class="panel">SUBIR FOTO DE HUELLAS DIGITALES</div>
                    <input type="file" class="nuevaFotoHUELLAS" name="nuevoFotoHUELLAS">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarHUELLAS" width="100px">
                    <input type="hidden" name="fotoActualHUELLAS" id="fotoActualHUELLAS">
                  </div>
                </div>
              </div>




              <div class="col-md-12">



                <div class="col-md-4">
                  <!-- ENTRADA PARA SELECCIONAR ESTADO -->
                  <div class="form-group">
                    Código Empleado:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                      <input type="text" class="form-control input-lg" id="editarcodigo_empleado" name="nuevocodigo_empleado" readonly>


                      <?php
                      function getempleado()
                      {
                        $query = "SELECT * FROM tbl_empleados where estado='2' order by id desc limit 1";
                        $sql = Conexion::conectar()->prepare($query);
                        $sql->execute();
                        return $sql->fetchAll();
                      };

                      $data = getempleado();
                      $datos = "";
                      $correlativo_dato = "";
                      foreach ($data as $row) {
                        $numero = $row["codigo_empleado"];
                        $quitarceros = ltrim($numero, "0");
                        if ($quitarceros == "") {
                          $addnumber = 0 + 1;
                        } else {
                          $addnumber = addslashes($quitarceros) + 1;
                        }
                        $correlativo_numero = sprintf("%05d", $addnumber);
                        $correlativo_dato = $correlativo_numero;
                        /*   $datos .=$row["codigo_empleado"]; */
                      }
                      if ($correlativo_dato == "") {
                        $correlativo_dato = "000001";
                      }
                      echo '<input type="hidden" value=' . $correlativo_dato . '  class="form-control ultimoempleado"  readonly>';
                      ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA SELECCIONAR CARGO -->
                  <div class="form-group">
                    CARGO:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <select class="form-control input-lg nuevoCARGO" name="nuevoCARGO" id="editarCARGO0">
                        <option value="">Seleccione el Cargo</option>
                        <?php
                        $datos_mostrar_cargo = ControladorCargos::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar_cargo as $key => $value) {
                          echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-md-12">

                <?php
                function trabajoactual()
                {
                  $query = "SELECT * FROM configuracion";
                  $sql = Conexion::conectar()->prepare($query);
                  $sql->execute();
                  return $sql->fetchAll();
                };

                $data = trabajoactual();
                foreach ($data as $row) {
                  echo "<input type='hidden' value='" . $row["telefono"] . "' class='configtelefono' >";
                }
                ?>

                <div class="col-md-4">
                  <!-- ENTRADA PARA SELECCIONAR ESTADO -->
                  <div class="form-group">
                    Número del Trabajo actual:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <input type="text" class="form-control input-lg" name="nuevonumero_telefono_trabajo_actual" id="editarnumero_telefono_trabajo_actual" readonly>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <!-- ENTRADA PARA SELECCIONAR ESTADO -->
                  <div class="form-group">
                    Carnet Empleado:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <input type="text" class="form-control input-lg" name="nuevocarnet_empleado" id="editarcarnet_empleado" readonly>
                    </div>
                  </div>
                </div>

              </div>


              <div class="col-md-12">
                <div class="col-md-4">
                  <!-- ENTRADA PARA PANTALON-->
                  <div class="form-group">
                    Pantalón:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" value="" class="form-control input-lg" name="nuevopantalon_empleado" id="nuevopantalon_empleado" placeholder="Ingresar Pantalón" maxlength="3">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA camisa-->
                  <div class="form-group">
                    Camisa:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" value="" class="form-control input-lg" name="nuevocamisa_empleado" id="nuevocamisa_empleado" placeholder="Ingresar Camisa" maxlength="3">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA Zapatos-->
                  <div class="form-group">
                    Zapatos:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" value="" class="form-control input-lg" name="nuevozapatos_empleado" id="nuevozapatos_empleado" placeholder="Ingresar Zapatos" maxlength="3">
                    </div>
                  </div>
                </div>
              </div>




              <div class="col-md-12">
                <div class="col-md-4">
                  <!-- ENTRADA PARA Recomendado por:-->
                  <div class="form-group">
                    Recomendado por:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input-lg mi-selector" name="nuevorecomendado_empleado" id="nuevorecomendado_empleado" campo="">
                        <option value="">Seleccionar Recomendado</option>
                        <?php
                        $datos_mostrar_cargo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                        foreach ($datos_mostrar_cargo as $key => $value) {
                          echo '<option value="' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . '">' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . ' - ' . $value["nivel_cargo"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA medio de contacto-->
                  <div class="form-group">
                    Medio de contacto:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" value="" class="form-control input-lg " name="nuevocontacto_empleado" id="nuevocontacto_empleado" placeholder="Ingresar Medio de contacto" onKeyPress="if(this.value.length==40) return false;">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA documentacion completa-->
                  <div class="form-group">
                    Documentación completa:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input-lg" name="nuevodocumentacion_empleado" id="nuevodocumentacion_empleado" campo="">
                        <!-- <option value="">Seleccionar Documentación completa</option> -->
                        <option value="No">No</option>
                        <option value="Si">Si</option>

                      </select>
                    </div>
                  </div>

                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-6" style="visibility: hidden; height:0">
                  <div class="form-group">
                    ¿Tiene ANSP?:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input-lg" name="nuevoansp_empleado" id="nuevoansp_empleado" campo="">
                        <option value="">¿Tiene ANSP?</option>
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    Uniforme regalado:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input-lg" name="nuevouniformeregalado_empleado" id="nuevouniformeregalado_empleado" campo="">
                        <!-- <option value="">Uniforme regalado</option> -->
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <label style="font-size: xx-large;color: #2b2468;">Datos de contrataci&oacute;n</label>
                <hr style="margin-top: 0px;border-top: 1px solid #101010;">
                </hr>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA FECHA DE INGRESO-->
                    <div class="form-group">
                      Fecha de ingreso:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" value="" class="calendario nuevofecha_ingreso form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_ingreso" placeholder="Ingresar Fecha" id="mascarafechaingreso" readonly>
                        <input type="text" class="oficial_editarfecha_ingreso" name="nuevofecha_ingreso" style="display: none;" id="editarfecha_ingreso">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA FECHA DE CONTRATACION-->
                    <div class="form-group">
                      Fecha de contrataci&oacute;n:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" value="" class="calendario nuevofecha_contratacion form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_contratacion" placeholder="Ingresar Fecha" id="mascarafechacontratacion" readonly>
                        <input type="text" class="oficial_editarfecha_contratacion" name="nuevofecha_contratacion" style="display: none;" id="editarfecha_contratacion">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- ENTRADA PARA SELECCIONAR DEPARTAMENTO DE EMPRESA -->
                  <div class="form-group">
                    Departamento :
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-users"></i></span>
                      <input type="text" id="showdepartamento" class="form-control" readonly="readonly">
                      <select class="form-control input-lg mi-selector" name="nuevoDepartamentoEmpresa">
                        <option id="nuevoDepartamentoEmpresa"></option>
                        <?php
                        $datos_mostrar_departamento = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
                        foreach ($datos_mostrar_departamento as $key => $value) {
                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA PERIODO DE PAGO-->
                    Per&iacute;odo de pago:
                    <select class="form-control input-lg" name="nuevoPeriodoPago" id="PeriodoPago">
                      <option value="" id="nuevoPeriodoPago"> Per&iacute;odo de pago</option>
                      <option value="015">015</option>
                      <option value="030">030</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA HORAS NORMALES-->
                    <div class="form-group">
                      Horas normales de trabajo:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg solonumero" name="nuevo_horas_normales_trabajo" id="editar_horas_normales_trabajo" placeholder="Ingresar horas" onKeyPress="if(this.value.length==2) return false;" value="08">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA SUELDO -->
                    <div class="form-group">
                      Sueldo:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" min="0.01" step="0.01" class="form-control input-lg " name="nuevo_sueldo" id="editar_sueldo" placeholder="Ingresar sueldo" onKeyPress="if(this.value.length==6) return false;">
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA SUELDO DIARIO-->
                    <div class="form-group">
                      Sueldo diario:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" step="any" class="form-control input-lg " name="nuevo_sueldo_diario" id="editar_sueldo_diario" placeholder="Ingresar sueldo diario" onKeyPress="if(this.value.length==7) return false;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA SALARIO x HORA-->
                    <div class="form-group">
                      Salario por hora:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" step="any" class="form-control input-lg " name="nuevo_salario_por_hora" id="editar_salario_por_hora" placeholder="Ingresar salario por hora" onKeyPress="if(this.value.length==7) return false;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA HX diurna -->
                    <div class="form-group">
                      Hora extra diurna:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" step="any" class="form-control input-lg " name="nuevo_hora_extra_diurna" id="editar_hora_extra_diurna" placeholder="Ingresar hora extra diurna" onKeyPress="if(this.value.length==7) return false;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA HX NOCTURNA-->
                    <div class="form-group">
                      Hora extra nocturna:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" step="any" class="form-control input-lg " name="nuevo_hora_extra_nocturna" id="editar_hora_extra_nocturna" placeholder="Ingresar hora extra nocturna" onKeyPress="if(this.value.length==7) return false;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA HX DOMINGO-->
                    <div class="form-group">
                      Hora extra diurna domingo:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" min="0.01" step="0.01" class="form-control input-lg " name="nuevo_hora_extra_domingo" id="editar_hora_extra_domingo" placeholder="Ingresar hora extra domingo" onKeyPress="if(this.value.length==7) return false;">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA HX NOCTURNA DOMINGO -->
                    <div class="form-group">
                      Hora extra nocturna domingo:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="number" min="0.01" step="0.01" class="form-control input-lg " name="nuevo_hora_extra_nocturna_domingo" id="editar_hora_extra_nocturna_domingo" placeholder="Ingresar hora extra nocturna domingo" onKeyPress="if(this.value.length==7) return false;">
                      </div>
                    </div>
                  </div>
                </div>
              </div>




              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA TIPO PORTACION ARMA-->
                    <div class="form-group">
                      Tipo de portaci&oacute;n de armas:
                      <select class="form-control input-lg" name="nuevoTipoPortacionArmas">
                        <option id="nuevoTipoPortacionArmas"></option>
                        <?php
                        $datos_mostrar_tipo_portacion_arma = Controladorportacionarma::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar_tipo_portacion_arma as $key => $value) {
                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA DESCONTAR ISSS -->
                    Descontar ISSS:
                    <select class="form-control input-lg" name="nuevo_descontar_isss">
                      <option value="" id="nuevo_descontar_isss"></option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA DESCONTAR AFP -->
                    Descontar AFP:
                    <select class="form-control input-lg" name="nuevo_descontar_afp">
                      <option value="" id="editar_descontar_afp"></option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA TIPO PLANILLA-->
                    <div class="form-group">
                      Tipo de planilla:
                      <select class="form-control input-lg" name="nuevoTipoPlanilla">
                        <option id="nuevoTipoPlanilla"></option>
                        <?php
                        $datos_mostrar_tipo_planilla = Controladorplantillas::ctrMostrar($item, $valor);
                        foreach ($datos_mostrar_tipo_planilla as $key => $value) {
                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA BANCO-->
                    <div class="form-group">
                      Banco:
                      <select class="form-control input-lg nuevoBanco" name="nuevoBanco" id="bancoempleado">
                        <option id="nuevoBanco">Seleccione un Banco</option>
                        <?php
                        $datos_mostrar_banco = ControladorBancos::ctrMostrarBancos($item, $valor);
                        foreach ($datos_mostrar_banco as $key => $value) {
                          echo '<option value="' . $value["nombre"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA NUMERO CUENTA BANCO-->
                    <div class="form-group">
                      N&uacute;mero de cuenta:
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg " name="nuevo_numero_cuenta" id="editar_numero_cuenta" placeholder="Ingresar N. cuenta banco">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="col-md-4 jefeoperacion_empleado" id="divJOP">
                  <!-- ENTRADA PARA JEFE OPERQACIONES A CARGO-->
                  <div class="form-group">
                    Jefe operaciones:
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input-lg " name="nuevojefe_empleado">
                        <option id="nuevojefe_empleado" value="">Seleccione Jefe de Operaciones</option>

                        <?php

                        function configuracion()
                        {

                          $query = "SELECT tbl_empleados.id as idempleado,  tbl_empleados.* FROM tbl_empleados
                                  INNER JOIN cargos_desempenados 
                                  WHERE cargos_desempenados.id = tbl_empleados.nivel_cargo and cargos_desempenados.descripcion='Jefe de Operaciones'";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();
                          return $sql->fetchAll();
                        };
                        $data = configuracion();
                        foreach ($data as $value) {
                          echo "<option value=" . $value["idempleado"] . ">" . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . "</option>";
                        }
                        ?>


                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-4" style="display: none;">
                  <!-- ENTRADA PARA IMAGEN CONTRATO-->
                  <div class="form-group">
                    <div class="panel">SUBIR IMAGEN DE CONTRATO</div>
                    <input type="text" class="nuevaFotoContra" name="nuevoFotoContra">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <!-- <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarContra" width="100px">
                        <input type="hidden" name="fotoActualContra" id="fotoActualContra"> -->
                  </div>
                </div>
              </div>



              <div class="col-md-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA ANTICIPO -->
                    Anticipo:
                    <select class="form-control input-lg" name="nuevo_anticipo">
                      <option value="" id="nuevo_anticipo"></option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA REPORTADO A LA JURA -->
                    Reportado a PNC:
                    <select class="form-control input-lg" name="nuevo_reportado_a_pnc">
                      <option value="" id="nuevo_reportado_a_pnc"></option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- ENTRADA PARA TIPO EMPLEADO -->
                    Tipo empleado:
                    <select class="form-control input-lg" name="nuevo_tipo_empleado">
                      <option value="" id="nuevo_tipo_empleado"></option>
                      <option value="Administrativo">Administrativo</option>
                      <option value="Operativo">Operativo</option>
                    </select>
                  </div>
                </div>
              </div>






















































































            </div>
        </div>

        <!--=====================================
            PIE DEL MODAL
            ======================================-->

        <div class="modal-footer">

          <a href="empleados" class="btn btn-default pull-left" data-dismiss="modal">Salir</a>

          <button type="submit" class="btn btn-primary">Guardar empleado</button>

        </div>


        <?php

        $crearEmpleado = new ControladorEmpleados();
        $crearEmpleado->ctrCrearEmpleado();

        ?>

        </form>
      </div>

    </div>

</div>

</section>

</div>

<!-- 
<script>
$( document ).ready(function() {
  var idEmpleadox = <?php echo $_POST["idEmpleado"] ?>; 
  poblarFormulario(idEmpleadox);
});
</script>  -->
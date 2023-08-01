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
        <div class="container-fluid">
          <div class="row">


            <button class="btn btn-info " style="background-color: #3c8dbc;" id="btnAgregarCandidato"><i class="fa fa-handshake-o"></i> Agregar Candidato</button>

            <a href="reporteanticipo" class="btn btn-success">Imprimir solicitud de anticipo</a>
            <a href="retiro" class="btn btn-warning">Listado de Empleados Inactivos</a>
            <a href="fichapolicia" class="btn btn-primary">Imprimir ficha policia nuevo ingreso</a>
            <a href="fichadactilar" class="btn btn-danger">Imprimir dactilar</a>
            <a href="fichapersonal" class="btn btn-info">Imprimir Ficha Personal</a>
            <a href="generarcontratados" class="btn btn-warning">Imprimir Contratados</a>


          </div>
        </div>
      </div>

      <div class="box-body">
        <!-- <div id="respuesta"></div>
        <div id="tableEmpleadoTodos">
        </div> -->
        <table class="table table-bordered table-striped dt-responsive tablas" id="example" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Foto</th>
              <th>Nombre completo</th>
              <th>Nivel</th>
              <th>Documento</th>

              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;




            $empleados = ModeloEmpleados::mdlMostrarEmpleados("tbl_empleados", $item, $valor);
            $badge = "dark";
            foreach ($empleados as $key => $value) {

              //REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
              if ($value["estado"] == 1) {
                $nombreEstado = "Solicitud";
                $badge = "dark";
              } else if ($value["estado"] == 2) {
                $nombreEstado = "Contratado";
                $badge = "success";
              } else if ($value["estado"] == 3) {
                $nombreEstado = "Inactivo";
                $badge = "danger";
              } else if ($value["estado"] == 4) {
                $nombreEstado = "Incapacitado";
                $badge = "warning";
              } else {
                $nombreEstado = "Error";
                $badge = "defaul";
              }




              /* ******* */
              echo ' <tr>

                  <td>' . ($key + 1) . '</td>';


              if ($value["fotografia"] != "") {
                echo '<td><img src="' . $value["fotografia"] . '" class="img-thumbnail" width="40px"></td>';
              } else {
                echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
              }

              echo '<td>' . $value["codigo_empleado"] . '-' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"] . '</td>';



              echo '<td>' . $value["nivel_cargo"] . '</td>';

              echo '<td>' . $value["documento_identidad"] . ': ' . $value["numero_documento_identidad"] . '</td>';






              echo '<td><label class="badge btn-' . $badge . '">' . $nombreEstado . '</label></td>';

              echo '
                  <td>
                  
                 
                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarEmpleado"  idEmpleado="' . $value["id"] . '" ><i class="fa fa-pencil"></i></button>         
                  
                      <button class="btn btn-danger btnEliminarEmpleado" idEmpleado="' . $value["id"] . '" fotoEmpleado="' . $value["fotografia"] . '" empleado="' . $value["numero_documento_identidad"] . '"><i class="fa fa-times"></i></button>


                    </div> 
                    
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle"
                            data-toggle="dropdown">
                     Mas Opciones<span class="caret"></span>
                    </button>
                  
                    <ul class="dropdown-menu" role="menu">
                      <li>
                        <button class="btn btn-info btnImprimirImagenes"  style="width: 100%; background-color: #3c8dbc;"   empleado="' . $value["numero_documento_identidad"] . '">Imprimir Documentación</button>
                      </li>
                      <li>
                        <button class="btn btn-info btnParentesco"  style="width: 100%; background-color: #3c8dbc;" idEmpleado="' . $value["id"] . '"  data-toggle="modal" data-target="#modalParentesco" empleado="' . $value["numero_documento_identidad"] . '">Familiares</button> 
                      </li>
                      <li>
                      <button class="btn btn-info btnDescuentos"  style="width: 100%; background-color: #3c8dbc;" idEmpleado="' . $value["id"] . '"  data-toggle="modal" data-target="#modalDescuento" empleado="' . $value["numero_documento_identidad"] . '">Devengos y Descuentos</button>  
                      </li>
                      <li>
                       <button class="btn btn-info btnSeminarios"  style="width: 100%; background-color: #3c8dbc;" idEmpleado="' . $value["id"] . '"  data-toggle="modal" data-target="#modalSeminario" empleado="' . $value["numero_documento_identidad"] . '">Seminarios</button> 
                      </li>
                      <li>
                        <button class="btn btn-info btnImprimirFicha"  style="width: 100%; background-color: #3c8dbc;"   empleado="' . $value["numero_documento_identidad"] . '">Imprimir Ficha</button>
                      </li>
                      <li>
                        <a href="regalo?id=' . $value["id"] . '" class="btn btn-info" style="background-color: #3c8dbc; color:#fff;">Regalo Uniforme</a>
                      </li>
                      <li>
                        <a href="uniformedescuento?id=' . $value["id"] . '" style="background-color: #3c8dbc; color:#fff;" class="btn btn-info">Descuento Uniforme</a>
                      </li>
                      <li>
                         <a href="formretiro?id=' . $value["id"] . '" class="btn btn-info" style="background-color: #3c8dbc; color:#fff;">Formulario Retiro</a>
                      </li>
                      <li>
                       <a href="extravios?id=' . $value["id"] . '" class="btn btn-info" style="background-color: #3c8dbc; color:#fff;">Extravios</a>
                      </li>
                      <li>
                         <a href="vistas/modulos/carnet.php?id=' . $value["id"] . '" class="btn btn-info" idempleado=' . $value["id"] . ' target="_blank" style="background-color: #3c8dbc; color:#fff;">Imprimir Carnet</a>
                      </li>
                      <li>
                        <a href="vistas/modulos/solicitudpnc.php?id=' . $value["id"] . '" class="btn btn-info" idempleado=' . $value["id"] . ' target="_blank" style="background-color: #3c8dbc; color:#fff;" >Solicitud PNC</a>
                      </li>
                      <li>
                        
                      <a href="vistas/modulos/contrato.php?id=' . $value["id"] . '" class="btn btn-info" idempleado=' . $value["id"] . ' target="_blank" style="background-color: #3c8dbc; color:#fff;">Contrato</a>
                      
                      </li>
                    </ul>
                  </div>

                  </td>

                </tr>';

              /* ******* */
            }



            ?>

          </tbody>

        </table>


      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR EMPLEADO
======================================-->

<div id="modalAgregarEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO </div>

              <input type="file" class="nuevaFotoEmp" name="nuevaFotoEmp">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>
            <!-- ENTRADA PARA EL PRIMER NOMBRE -->
            <div class="form-group">
              Primer Nombre:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg nombre1" name="nuevoNombre" placeholder="Ingresar Primer Nombre" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL SEGUNDO  NOMBRE -->
            <div class="form-group">
              Segundo Nombre:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg nombre2" name="nuevoSegundoNombre" placeholder="Ingresar Segundo Nombre">

              </div>

            </div>

            <!-- ENTRADA PARA EL TERCER  NOMBRE -->
            <div class="form-group">
              Tercer Nombre:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg nombre3" name="nuevoTercerNombre" placeholder="Ingresar Tercer Nombre">

              </div>

            </div>


            <!-- ENTRADA PARA EL PRIMER APELLIDO -->
            <div class="form-group">
              Primer Apellido:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg apellido1" name="nuevoPrimerApellido" placeholder="Ingresar Primer Apellido" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->
            <div class="form-group">
              Segundo Apellido:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg apellido2" name="nuevoSegundoApellido" placeholder="Ingresar Segundo Apellido" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL APELLIDO DE CASADA -->
            <div class="form-group">
              Apellido Casada:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg " name="nuevoApellidoCasada" placeholder="Ingresar Apellido Casada">

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO CIVIL -->

            <div class="form-group">
              Estado Civil:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoEstadoCivil">

                  <option value="">Seleccionar Estado Civil</option>

                  <option value="Soltero(a)">Soltero(a)</option>

                  <option value="Casado(a)">Casado(a)</option>

                  <option value="Divorciado(a)">Divorciado(a)</option>

                  <option value="Viudo(a)">Viudo(a)</option>

                  <option value="Uni&oacute;n no Matrimonial">Uni&oacute;n no Matrimonial</option>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL SEXO -->

            <div class="form-group">
              Sexo:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoSexo">

                  <option value="">Seleccionar Sexo</option>

                  <option value="Masculino">Masculino</option>

                  <option value="Femenino">Femenino</option>


                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION DE RESIDENCIA-->
            <div class="form-group">
              Direcci&oacute;n Residencia:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Direcci&oacute;n">

              </div>

            </div>
            <!-- ***DEPARTAMENTO -->
            <!-- *** -->
            <div class="form-group">
              Departamento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoDepartamento" id="nuevoDepartamento" onchange='poblarMuni()'>
                  <option value="">Seleccionar Departamento</option>
                  <?php
                  $datos_mostrar_departamento = Controladorcat_departamento::ctrMostrar($item, $valor);
                  foreach ($datos_mostrar_departamento as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["Nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>



            <!-- *** -->
            <!-- *** -->


            <!-- ***MUNICIPIO -->
            <!-- *** -->
            <div class="form-group">
              Municipio:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoMunicipio" id="nuevoMunicipio">
                  <option value="">Seleccionar Municipio</option>

                </select>
              </div>
            </div>
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="form-group">
              Tel&eacute;fono:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_telefono_1 telefono" name="nuevoTelefono" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono">
              </div>
            </div>
            <!-- ENTRADA PARA EL numero ISSS -->
            <div class="form-group">
              N&uacute;mero ISSS:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroIsss" placeholder="Ingresar N&uacute;mero de ISSS">
              </div>
            </div>
            <!-- ENTRADA PARA EL nombre segun  ISSS -->
            <div class="form-group">
              Nombre Seg&uacute;n ISSS:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombreIsss" placeholder="Ingresar Nombre seg&uacute;n ISSS">
              </div>
            </div>

            <!-- ENTRADA PARA EL DOCUMENTO -->

            <div class="form-group">
              Tipo Documento:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoTipoDocumento" required>

                  <option value="">Seleccionar tipo de documento</option>

                  <option value="DUI">DUI</option>

                  <option value="Pasaporte">Pasaporte</option>

                  <option value="Carnet residente">Carnet residente</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO DOCUMENTO IDENTIDAD -->

            <div class="form-group">
              N&uacute;mero Documento
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg input_dui duis numerodui" nombres="" apellido1="" apellido2="" name="nuevoNumeroDocumento" id="nuevoNumeroDocumento" placeholder="Ingresar n&uacute;mero documento identidad" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL lugar expedicion documento   -->
            <div class="form-group">
              Lugar expedici&oacute;n Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoLugarExpedicionDoc" placeholder="Lugar expedicion del documento">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA DE  expedicion documento   -->
            <div class="form-group">
              Fecha Expedici&oacute;n Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_expedicion form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_expedicion" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_expedicion" name="nuevofecha_expedicion" style="display: none;">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA DE  vencimiento documento   -->
            <div class="form-group">
              Fecha Vencimiento Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_vencimiento form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_vencimiento" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_vencimiento" name="nuevofecha_vencimiento" style="display: none;">
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO DOCUMENTO -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DOCUMENTO IDENTIDAD</div>
              <input type="file" class="nuevaFotoDoc" name="nuevaFotoDoc">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarDoc" width="100px">
            </div>

            <!-- ENTRADA PARA licencia de conducir  -->
            <div class="form-group">
              N&uacute;mero Licencia Conducir:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_nit nits" name="nuevoLicenciaConducir" placeholder="Ingresar N&uacute;mero de Licencia Conducir">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DE LICENCIA DE CONDUCIR -->
            <div class="form-group">
              Tipo Licencia Conducir:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoTipoLicenciaConducir">
                  <option value="">Seleccionar tipo licencia de conducir</option>
                  <option value="Particular">Particular</option>
                  <option value="Liviana">Liviana</option>
                  <option value="Motociclista">Motociclista</option>
                  <option value="Pesada">Pesada</option>
                  <option value="TPesada">TPesada</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO  DE LICENCIA-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO LICENCIA DE CONDUCIR</div>
              <input type="file" class="nuevaFotoLicCond" name="nuevaFotoLicCond">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarLicCond" width="100px">
            </div>



            <!-- ENTRADA PARA NIT  -->
            <div class="form-group">
              N&uacute;mero NIT:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_nit nits" name="nuevoNumeroNIT" placeholder="Ingresar N&uacute;mero de NIT">
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR FOTO NIT-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO NIT</div>
              <input type="file" class="nuevaFotoNIT" name="nuevaFotoNIT">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarNIT" width="100px">
            </div>

            <div class="form-group">
              AFP:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoAFP" id="nuevoAFP">
                  <option value="">Seleccionar AFP</option>
                  <?php
                  $datos_mostrar_afp = ControladorAfp::ctrMostrarAfp($item, $valor);
                  foreach ($datos_mostrar_afp as $key => $value) {
                    echo '<option value="' . $value["codigo"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>




            <!-- ENTRADA PARA NUP  -->
            <div class="form-group">
              N&uacute;mero NUP:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroNUP" placeholder="Ingresar N&uacute;mero NUP">
              </div>
            </div>
            <!-- ENTRADA PARA PROFESION OFICIO  -->
            <div class="form-group">
              Profesi&oacute;n u Oficio
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoProfesionOficio" placeholder="Ingresar Profesi&oacute;n u Oficio">
              </div>
            </div>
            <!-- ENTRADA PARA NACIONALIDAD  -->
            <div class="form-group">
              Nacionalidad:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNacionalidad" placeholder="Ingresar Nacionalidad">
              </div>
            </div>

            <!-- ENTRADA PARA LUGAR NACIEMIENTO -->
            <div class="form-group">
              Lugar de Nacimiento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoLugarNacimiento" placeholder="Ingresar Lugar de Nacimiento">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA DE  NACIMIENTO  -->
            <div class="form-group">
              Fecha Nacimiento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_nacimiento form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_nacimiento" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_nacimiento" name="nuevofecha_nacimiento" style="display: none;">
              </div>
            </div>
            <!-- ENTRADA PARA RELIGION -->
            <div class="form-group">
              Religi&oacute;n:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoReligion" placeholder="Ingresar Religi&oacute;n">
              </div>
            </div>

            <!-- ENTRADA PARA GRADO ESTUDIO -->
            <div class="form-group">
              Grado de Estudios:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoGradoEstudio" placeholder="Ingresar Grado de Estudios">
              </div>
            </div>
            <!-- ENTRADA PARA PLANTEL -->
            <div class="form-group">
              Plantel:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoPlantel" placeholder="Ingresar Plantel">
              </div>
            </div>

            <!-- ENTRADA PARA PESO -->
            <div class="form-group">
              Peso:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoPeso" placeholder="Ingresar Peso">
              </div>
            </div>
            <!-- ENTRADA PARA ESTATURA -->
            <div class="form-group">
              Estatura:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoEstatura" placeholder="Ingresar Estatura">
              </div>
            </div>
            <!-- ENTRADA PARA PIEL -->
            <div class="form-group">
              Color de Piel:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoPiel" placeholder="Ingresar Color de Piel">
              </div>
            </div>
            <!-- ENTRADA PARA OJOS -->
            <div class="form-group">
              Color de Ojos:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoOjos" placeholder="Ingresar Color de Ojos">
              </div>
            </div>
            <!-- ENTRADA PARA CABELLO -->
            <div class="form-group">
              Color de Cabello:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCabello" placeholder="Ingresar Color Cabello">
              </div>
            </div>
            <!-- ENTRADA PARA CARA -->
            <div class="form-group">
              Cara:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCara" placeholder="Ingresar Cara">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DE SANGRE-->
            <div class="form-group">
              Tipo de Sangre:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoTipoSangre">
                  <option value="">Seleccionar Tipo de Sangre</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA CARSENALES ESPECIALES -->
            <div class="form-group">
              Se&nacute;ales Especiales:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoSenalesEspeciales" placeholder="Ingresar Se&nacute;ales Especiales">
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR SI TIENE LICENCIA D EARMAS-->
            <div class="form-group">
              Licencia de Tenencia de Armas:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoLicenciaTDA">
                  <option value="">Tiene Licencia de Tenencia de Armas</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA NUMERO LICENCIA TENENCIA ARMA -->
            <div class="form-group">
              N&uacute;mero Licencia de Tenencia de Armas:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNumeroLicenciaTDA" placeholder="Ingresar N&uacute;mero Licencia de Tenencia de Armas">
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR FOTO  DE LICENCIA-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO LICENCIA TENENCIA DE ARMAS</div>
              <input type="file" class="nuevaFotoLicLTA" name="nuevaFotoLicLTA">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarLicLTA" width="100px">
            </div>
            <!-- ENTRADA PARA SELECCIONAR SI HIZO SERVICIOMILITAR-->
            <div class="form-group">
              Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoServicioMilitar">
                  <option value="">Hizo Servicio Militar</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA FECHA INICIO SERV MIL  -->
            <div class="form-group">
              Fecha Inicio Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_inism form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_inism" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_inism" name="nuevofecha_inism" style="display: none;">
              </div>
            </div>
            <!-- ENTRADA PARA FIN SERV MIML  -->
            <div class="form-group">
              Fecha Fin Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_finsm form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_finsm" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_finsm" name="nuevofecha_finsm" style="display: none;">
              </div>
            </div>
            <!-- ENTRADA PARA LUGAR SEV MIL -->
            <div class="form-group">
              Lugar Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoLugarServicioMilitar" placeholder="Ingresar Lugar Servicio Militar">
              </div>
            </div>

            <!-- ENTRADA PARA GRADO MILITAR -->
            <div class="form-group">
              Grado Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoGradoMilitar" placeholder="Ingresar Grado Militar">
              </div>
            </div>


            <!-- ENTRADA PARA MOTIVO BAJA -->
            <div class="form-group">
              Motivo de la Baja:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoMotivoBaja" placeholder="Ingresar Motivo de la Baja">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SI ES EX PNC -->
            <div class="form-group">
              Ex-PNC:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoExPnc">
                  <option value="">Es Ex-PNC</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SI TIENE CURSO ANSP -->
            <div class="form-group">
              Curso ANSP:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoCursoANSP">
                  <option value="">Tiene Curso ANSP</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO  DE DIPLOMA ANSP-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO PARA DIPLOMA ANSP</div>
              <input type="file" class="nuevaFotoANSP" name="nuevaFotoANSP">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarANSP" width="100px">
            </div>



            <!-- ENTRADA PARA TRABAJO ANTERIOR-->
            <div class="form-group">
              Nombre Trabajo Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoTrabajoAnterior" placeholder="Ingresar Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA SUELDO QUE DEVENGO-->
            <div class="form-group">
              Sueldo que Deveng&oacute;:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoSueldoDevengo" placeholder="Ingresar Sueldo que Deveng&oacute;">
              </div>
            </div>
            <!-- ENTRADA PARA TRABAJO ACTUAL-->
            <div class="form-group">
              Nombre Trabajo Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoTrabajoActual" placeholder="Ingresar Trabajo Actual">
              </div>
            </div>
            <!-- ENTRADA PARA SUELDO QUE DEVENGA-->
            <div class="form-group">
              Sueldo que Devenga:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoSueldoDevenga" placeholder="Ingresar Sueldo que Devenga">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR SI TIENE SUSPENDIDO TRABAJO ANTERIOR -->
            <div class="form-group">
              Suspendido en Trabajos Anteriores:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoSuspendidoAnterior">
                  <option value="">Ha sido Suspendido en Trabajos Anteriores</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA EMPRESA SUSPENDIO-->
            <div class="form-group">
              Empresa que Suspendi&oacute;:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoEmpresaSuspendio" placeholder="Ingresar Empresa que Suspendi&oacute;">
              </div>
            </div>
            <!-- ENTRADA PARA MOTIVO SUSPENSION-->
            <div class="form-group">
              Motivo de Suspensi&oacute;n:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoMotivoSuspension" placeholder="Ingresar Motivo de Suspensi&oacute;n">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA SUSPENSION -->
            <div class="form-group">
              Fecha Suspensi&oacute;n:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_susp form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_susp" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_susp" name="nuevofecha_susp" style="display: none;">
              </div>
            </div>

            <!-- ENTRADA PARA EXPERIENCIA LABORAL-->
            <div class="form-group">
              Experiencia Laboral:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoExperienciaLaboral" placeholder="Ingresar Experiencia Laboral">
              </div>
            </div>
            <!-- ENTRADA PARA RAZON POR LA CUAL DESEA TRABAJAR EN ISE-->
            <div class="form-group">
              Raz&oacute;n por la cu&aacute;l quiere trabajar en G.ISE:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoRazonIse" placeholder="Raz&oacute;n por la cu&aacute;l quiere trabajar en G.ISE">
              </div>
            </div>

            <!-- ENTRADA PARA NUMERO PERSONAS DEPENDIENTES-->
            <div class="form-group">
              N&uacute;mero de Personas Dependientes:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroPersonasDependientes" placeholder="Ingresar N&uacute;mero de Personas Dependientes">
              </div>
            </div>
            <!-- ENTRADA PARA OBSERVACIONES-->
            <div class="form-group">
              Observaciones:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoObservaciones" placeholder="Ingresar Observaciones">
              </div>
            </div>

            <!-- ENTRADA PARA TELEFONO TRABAJO ANTERIOR-->
            <div class="form-group">
              N&uacute;mero de Tel&eacute;fono Trabajo Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_telefono_1 telefono" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="nuevoNumeroTelTrabajoAnterior" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA TRABAJO ACTUAL-->
            <div class="form-group" style="display:none;">
              Nombre Trabajo Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoTrabajoActual" placeholder="Ingresar Trabajo Actual">
              </div>
            </div>

            <!-- ENTRADA PARA NOMBRE REFEREWANCIA ANTERIOR-->
            <div class="form-group">
              Nombre Referencia Trabajo Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombreRefTrabajoAnterior" placeholder="Ingresar Nombre Referencia Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA EVALUACION ANTERIOR-->
            <div class="form-group">
              Evaluaci&oacute;n Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoEvaluacionAnterior" placeholder="Ingresar Evaluaci&oacute;n Anterior">
              </div>
            </div>


            <!-- ENTRADA PARA TELEFONO REFEREWANCIA ACTUAL-->
            <div class="form-group">
              Nombre Referencia Trabajo Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg telefono" name="nuevoNomRefTrabajoActual" placeholder="Ingresar Nombre Referencia Trabajo Actual">
              </div>
            </div>
            <!-- ENTRADA PARA EVALUACION ACTUAL-->
            <div class="form-group">
              Evaluaci&oacute;n Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoEvaluacionActual" placeholder="Ingresar Evaluaci&oacute;n Actual">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR INFO VERIFICADA -->
            <div class="form-group">
              HA SIDO VERIFICADA LA INFORMACION
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoInfoVerificada">
                  <option value="">HA SIDO VERIFICADA LA INFORMACION?</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR FOTO  DE LA SOLICITUD-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE LA SOLICITUD</div>
              <input type="file" class="nuevaFotoSOLICITUD" name="nuevaFotoSOLICITUD">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarSOLICITUD" width="100px">
            </div>
            <!-- ENTRADA PARA SUBIR FOTO  PARTINA NACIMIENTO-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE LA PARTIDA DE NACIMIENTO</div>
              <input type="file" class="nuevaFotoPARTIDA" name="nuevaFotoPARTIDA">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPARTIDA" width="100px">
            </div>
            <!-- ENTRADA PARA SUBIR FOTO  ANTECEDENTES PENALES-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE ANTECEDENTES PENALES</div>
              <input type="file" class="nuevaFotoANTECEDENTES" name="nuevaFotoANTECEDENTES">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarANTECEDENTES" width="100px">
            </div>
            <!-- ENTRADA PARA FECHA VENCIMIENTO AP-->
            <div class="form-group">
              Fecha Vencimiento Antecedentes Penales:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_venceAP form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_venceAP" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_venceAP" name="nuevofecha_venceAP" style="display: none;">
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR FOTO  SOLVENCIA PNC-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE SOLVENCIA PNC</div>
              <input type="file" class="nuevaFotoSOLVENCIAPNC" name="nuevaFotoSOLVENCIAPNC">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarSOLVENCIAPNC" width="100px">
            </div>
            <!-- ENTRADA PARA FECHA VENCIMIENTO SOLV PNC-->
            <div class="form-group">
              Fecha Vencimiento Solvencia PNC:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_venceSPNC form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_venceSPNC" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_venceSPNC" name="nuevofecha_venceSPNC" style="display: none;">
              </div>
            </div>
            <!-- ENTRADA PARA CONSTANCIA PSICOLOGICA -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE CONSTANCIA PSICOLOGICA</div>
              <input type="file" class="nuevaFotoPSYCO" name="nuevaFotoPSYCO">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPSYCO" width="100px">
            </div>

            <!-- ENTRADA PARA EXAMEN POLIGRAFICO -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE EXAMEN POLIGRAFICO</div>
              <input type="file" class="nuevaFotoPOLI" name="nuevaFotoPOLI">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPOLI" width="100px">
            </div>

            <!-- ENTRADA PARA IMAGEN HUELLAS DIGITALES -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE IMAGEN HUELLAS DIGITALES</div>
              <input type="file" class="nuevaFotoHUELLAS" name="nuevaFotoHUELLAS">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarHUELLAS" width="100px">
            </div>


            <!-- ENTRADA PARA SELECCIONAR SI ES CONFIABLE -->
            <div class="form-group">
              Es Confiable?
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoConfiable">
                  <option value="">Es Confiable?</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>

            <!-- *** -->
            <!-- *** -->

            <!-- ENTRADA PARA SELECCIONAR EL ESTADO -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoEstado" required>
                  <option value="">Seleccionar estado</option>
                  <option value="1">Solicitud</option>
                  <option value="2">Contratado</option>
                  <option value="3">Inactivo</option>
                  <option value="4">Incapacitado</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR EL CARGO -->
            <div class="form-group">
              CARGO:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoCARGO" id="nuevoCARGO" required>
                  <option value="">Seleccionar Cargo</option>
                  <?php
                  $datos_mostrar_cargo = ControladorCargos::ctrMostrar($item, $valor);
                  foreach ($datos_mostrar_cargo as $key => $value) {
                    echo '<option value="' . $value["nivel"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA PANTALON-->
            <div class="form-group">
              Pantalón:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg" name="nuevopantalon_empleado" id="" placeholder="Ingresar Pantalón" maxlength="3">
              </div>
            </div>

            <!-- ENTRADA PARA camisa-->
            <div class="form-group">
              Camisa:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg" name="nuevocamisa_empleado" id="" placeholder="Ingresar Camisa" maxlength="3">
              </div>
            </div>


            <!-- ENTRADA PARA Zapatos-->
            <div class="form-group">
              Zapatos:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg" name="nuevozapatos_empleado" id="" placeholder="Ingresar Zapatos" maxlength="3">
              </div>
            </div>


            <!-- ENTRADA PARA Recomendado por:-->
            <div class="form-group">
              Recomendado por:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="nuevorecomendado_empleado" id="" required>
                  <option value="">Seleccionar Recomendado</option>
                  <?php
                  $datos_mostrar_cargo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                  foreach ($datos_mostrar_cargo as $key => $value) {
                    echo '<option value="' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . '">' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>



            <!-- ENTRADA PARA Zapatos-->
            <div class="form-group">
              Medio de contacto:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg telefono" name="nuevocontacto_empleado" id="" placeholder="Ingresar Medio de contacto">
              </div>
            </div>


            <div class="form-group">
              Documentación completa:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="nuevodocumentacion_empleado" id="" required>
                  <option value="">Seleccionar Documentación completa</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


            <div class="form-group">
              ¿Tiene ANSP?:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="nuevoansp_empleado" id="" required>
                  <option value="">¿Tiene ANSP?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


            <div class="form-group">
              Uniforme regalado:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="nuevouniformeregalado_empleado" id="" required>
                  <option value="">Uniforme regalado</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
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

          <button type="submit" class="btn btn-primary" id="btnGuardarEmpleado">Guardar empleado</button>

        </div>

        <?php

        $crearEmpleado = new ControladorEmpleados();
        $crearEmpleado->ctrCrearEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar empleado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <input type="hidden" id="idEmpleado" name="idEmpleado">
            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

            <!-- ENTRADA PARA EL PRIMER NOMBRE -->

            <div class="form-group">
              Primer Nombre:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL SEGUNDO NOMBRE -->

            <div class="form-group">
              Segundo Nombre:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarSegundoNombre" name="editarSegundoNombre" value="">

              </div>

            </div>
            <!-- ENTRADA PARA EL TERCER NOMBRE -->

            <div class="form-group">
              Tercer Nombre:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarTercerNombre" name="editarTercerNombre" value="">

              </div>

            </div>
            <!-- ENTRADA PARA EL PRIMER APELLIDO -->

            <div class="form-group">
              Primer Apellido:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarPrimerApellido" name="editarPrimerApellido" value="" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->

            <div class="form-group">
              Segundo Apellido:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarSegundoApellido" name="editarSegundoApellido" value="" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL APELLIDO DE CASADA-->

            <div class="form-group">
              Apellido Casada:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarApellidoCasada" name="editarApellidoCasada" value="">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR ESTADO CIVIL -->
            <div class="form-group">
              Estado Civil:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarEstadoCivil">

                  <option value="" id="editarEstadoCivil"></option>

                  <option value="Soltero(a)">Soltero(a)</option>

                  <option value="Casado(a)">Casado(a)</option>

                  <option value="Divorciado(a)">Divorciado(a)</option>

                  <option value="Viudo(a)">Viudo(a)</option>

                  <option value="Uni&oacute;n no Matrimonial">Uni&oacute;n no Matrimonial</option>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR SEXO -->
            <div class="form-group">
              Sexo:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarSexo">

                  <option value="" id="editarSexo"></option>

                  <option value="Masculino">Masculino</option>

                  <option value="Femenino">Femenino</option>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA LA DIRECCION DE RESIDENCIA -->

            <div class="form-group">
              Direcci&oacute;n de Residencia:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" value="">

              </div>

            </div>


            <!-- ***DEPARTAMENTO -->
            <!-- *** -->
            <div class="form-group">
              Departamento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarDepartamento">
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



            <!-- *** -->
            <!-- *** -->


            <!-- ***MUNICIPIO -->
            <!-- *** -->
            <div class="form-group">
              Municipio:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarMunicipio">
                  <option id="editarMunicipio"></option>
                  <?php
                  $datos_mostrar_municipio = Controladorcat_municipios::ctrMostrar($item, $valor);
                  foreach ($datos_mostrar_municipio as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["Nombre_m"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA EL NUMERO DE TELEFONO -->
            <div class="form-group">
              N&uacute;mero de Tel&eacute;fono:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_telefono_1 telefono" id="editarNumeroTelefono" name="editarNumeroTelefono" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono">
              </div>
            </div>

            <!-- ENTRADA PARA EL NUMERO ISSS-->
            <div class="form-group">
              N&uacute;mero de ISSS:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroIsss" name="editarNumeroIsss" value="" placeholder="Ingresar N&uacute;mero de ISSS">
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE ISSS -->
            <div class="form-group">
              Nombre Seg&uacute;n ISSS:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNombreIsss" name="editarNombreIsss" value="" placeholder="Ingresar Nombre Seg&uacute;n ISSS">
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
            <div class="form-group">
              Tipo de Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarTipoDocumento" required>
                  <option value="" id="editarTipoDocumento"></option>
                  <option value="DUI">DUI</option>
                  <option value="Pasaporte">DUI</option>
                  <option value="Carnet residente">Carnet residente</option>
                </select>
              </div>
            </div>


            <!-- ENTRADA PARA EL NUMERO DOCUMENTO IDENTIDAD -->

            <div class="form-group">
              N&uacute;mero Documento Identidad:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg input_dui duis" id="editarNumeroDocumento" name="editarNumeroDocumento" value="" required>

              </div>

            </div>


            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DOCUMENTO IDENTIDAD</div>
              <input type="file" class="nuevaFotoDoc" name="editarFotoDoc">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarDoc" width="100px">
              <input type="hidden" name="fotoActualDoc" id="fotoActualDoc">
            </div>

            <!-- ENTRADA PARA LUGAR EXPEDICION DOCUMENTO -->
            <div class="form-group">
              Lugar Expedici&oacute;n Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarLugarExpedicionDoc" name="editarLugarExpedicionDoc" value="" placeholder="Ingresar Lugar Expedici&oacute;n Documento">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA EXPEDICION DOCUMENTO -->
            <div class="form-group">
              Fecha Expedici&oacute;n Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_expedicion form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="" fecha="editarfecha_expedicion" placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                <input type="text" class="oficial_editarfecha_expedicion" name="editarfecha_expedicion" style="display: none;" id="editarfecha_expedicion">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA VENCIMIENTO DOCUMENTO -->
            <div class="form-group">
              Fecha Vencimiento Documento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_vencimiento form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" name="" fecha="editarfecha_vencimiento" placeholder="Ingresar Fecha" id="mascarafechav" readonly>
                <input type="text" class="oficial_editarfecha_vencimiento" name="editarfecha_vencimiento" style="display: none;" id="editarfecha_vencimiento">
              </div>
            </div>
            <!-- ENTRADA PARA LICENCIA DE CONDUCIR-->
            <div class="form-group">
              N&uacute;mero de Licencia de Conducir:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg input_nit nits" id="editarNumeroLicenciaConducir" name="editarNumeroLicenciaConducir" value="" placeholder="Ingresar N&uacute;mero de Licencia de Conducir">
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR TIPO LICENCIA CONDUCIR -->
            <div class="form-group">
              Tipo Licencia de Conducir:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarTipoLicenciaConducir">
                  <option value="" id="editarTipoLicenciaConducir"></option>
                  <option value="Particular">Particular</option>
                  <option value="Liviana">Liviana</option>
                  <option value="Motociclista">Motociclista</option>
                  <option value="Pesada">Pesada</option>
                  <option value="TPesada">TPesada</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO LICENCIA CONDUCIR-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO LICENCIA DE CONDUCIR</div>
              <input type="file" class="nuevaFotoLicCond" name="editarFotoLicCond">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarLicCond" width="100px">
              <input type="hidden" name="fotoActualLicCond" id="fotoActualLicCond">
            </div>



            <!-- ENTRADA PARA NIT-->
            <div class="form-group">
              N&uacute;mero de NIT:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_nit nits" id="editarNumeroNit" name="editarNumeroNit" value="" placeholder="Ingresar N&uacute;mero de NIT">
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR NIT -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO NIT</div>
              <input type="file" class="nuevaFotoNIT" name="editarFotoNIT">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarNIT" width="100px">
              <input type="hidden" name="fotoActualNIT" id="fotoActualNIT">
            </div>
            <div class="form-group">
              AFP:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarAFP">
                  <option id="editarAFP"></option>
                  <?php
                  $datos_mostrar_afp = ControladorAfp::ctrMostrarAfp($item, $valor);
                  foreach ($datos_mostrar_afp as $key => $value) {
                    echo '<option value="' . $value["codigo"] . '">' . $value["nombre"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>




            <!-- ENTRADA PARA NUUP-->
            <div class="form-group">
              N&uacute;mero de NUP:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroNup" name="editarNumeroNup" value="" placeholder="Ingresar N&uacute;mero NUP">
              </div>
            </div>

            <!-- ENTRADA PARA PROFESION OFICIO -->
            <div class="form-group">
              Profesi&oacute;n u Oficio:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarProfesionOficio" name="editarProfesionOficio" value="" placeholder="Ingresar Profesi&oacute;n u Oficio">
              </div>
            </div>
            <!-- ENTRADA PARA NACIONALIDAD -->
            <div class="form-group">
              Nacionalidad:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNacionalidad" name="editarNacionalidad" value="" placeholder="Ingresar Nacionalidad">
              </div>
            </div>
            <!-- ENTRADA PARA LUGAR NACIEMIENTO -->
            <div class="form-group">
              Lugar de Nacimiento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarLugarNac" name="editarLugarNac" value="" placeholder="Ingresar Lugar de Nacimiento">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA NACIEMIENT -->
            <div class="form-group">
              Fecha Nacimiento:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_nacimiento form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="editarfecha_nacimiento" placeholder="Ingresar Fecha" id="mascarafechanac" readonly>
                <input type="text" class="oficial_editarfecha_nacimiento" name="editarfecha_nacimiento" style="display: none;" id="editarfecha_nacimiento">
              </div>
            </div>

            <!-- ENTRADA PARA RELIGION -->
            <div class="form-group">
              Religi&oacute;n:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarReligion" name="editarReligion" value="" placeholder="Ingresar Religi&oacute;n">
              </div>
            </div>
            <!-- ENTRADA PARA GRADO DE ESTUDIOS -->
            <div class="form-group">
              Grado de Estudios:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarGradoEstudios" name="editarGradoEstudios" value="" placeholder="Ingresar Grado de Estudios">
              </div>
            </div>
            <!-- ENTRADA PARA PLANTEL-->
            <div class="form-group">
              Plantel:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarPlantel" name="editarPlantel" value="" placeholder="Ingresar Plantel">
              </div>
            </div>
            <!-- ENTRADA PARA PESO-->
            <div class="form-group">
              Peso:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarPeso" name="editarPeso" value="" placeholder="Ingresar Peso">
              </div>
            </div>
            <!-- ENTRADA PARA NUESTATURAP-->
            <div class="form-group">
              Estatura:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarEstatura" name="editarEstatura" value="" placeholder="Ingresar Estatura">
              </div>
            </div>
            <!-- ENTRADA PARA PIEL-->
            <div class="form-group">
              Color de Piel:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarPiel" name="editarPiel" value="" placeholder="Ingresar Color Piel">
              </div>
            </div>
            <!-- ENTRADA PARA OJOS-->
            <div class="form-group">
              Color de Ojos:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarOjos" name="editarOjos" value="" placeholder="Ingresar Color Ojos">
              </div>
            </div>
            <!-- ENTRADA PARA CABELLO-->
            <div class="form-group">
              Color de Cabello:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarCabello" name="editarCabello" value="" placeholder="Ingresar Color Cabello">
              </div>
            </div>
            <!-- ENTRADA PARA CARA-->
            <div class="form-group">
              Cara:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarCara" name="editarCara" value="" placeholder="Ingresar Cara">
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR TIPO DE SANGRE-->
            <div class="form-group">
              Tipo de Sangre:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarTipoSangre">
                  <option value="" id="editarTipoSangre"></option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SENALES ESPECIALES-->
            <div class="form-group">
              Se&nacute;ales Especiales:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarSenalesEspeciales" name="editarSenalesEspeciales" value="" placeholder="Ingresar Se&nacute;ales Especiales">
              </div>
            </div>
            <!-- ENTRADA PARA TIENE LICENCIA TDA-->
            <div class="form-group">
              Licencia de Tenencia de Armas:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarLicenciaTDA">
                  <option value="" id="editarLicenciaTDA"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>



            <!-- ENTRADA PARA NUMERO LICENCIA TDA-->
            <div class="form-group">
              N&uacute;mero Licencia Tenencia de Armas:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroLicenciaTDA" name="editarNumeroLicenciaTDA" value="" placeholder="Ingresar N&uacute;mero Licencia Tenencia de Armas">
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO LICENCIA LTA-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO LICENCIA TENENCIA DE ARMAS</div>
              <input type="file" class="nuevaFotoLicLTA" name="editarFotoLicLTA">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarLicLTA" width="100px">
              <input type="hidden" name="fotoActualLicLTA" id="fotoActualLicLTA">
            </div>



            <!-- ENTRADA PARA TIENE SERVICIO MILITAR-->
            <div class="form-group">
              Hizo Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarServicioMilitar">
                  <option value="" id="editarServicioMilitar"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA FECHA INI SER MIL-->
            <div class="form-group">
              Fecha Inicio Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_inism form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="editarfecha_inism" placeholder="Ingresar Fecha" id="mascarafechainism" readonly>
                <input type="text" class="oficial_editarfecha_inism" name="editarfecha_inism" style="display: none;" id="editarfecha_inism">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA FIN SER MIL-->
            <div class="form-group">
              Fecha Fin Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_finsm form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="editarfecha_finsm" placeholder="Ingresar Fecha" id="mascarafechafinsm" readonly>
                <input type="text" class="oficial_editarfecha_finsm" name="editarfecha_finsm" style="display: none;" id="editarfecha_finsm">
              </div>
            </div>
            <!-- ENTRADA PARA LUGAR SERVICIO MILITAR-->
            <div class="form-group">
              Lugar de Servicio Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarLugarServicioMilitar" name="editarLugarServicioMilitar" value="" placeholder="Ingresar Lugar de Servicio Militar">
              </div>
            </div>
            <!-- ENTRADA PARA GRADO MILITAR-->
            <div class="form-group">
              Grado Militar:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarGradoMilitar" name="editarGradoMilitar" value="" placeholder="Ingresar Grado Militar">
              </div>
            </div>
            <!-- ENTRADA PARA MOTIVO BAJA-->
            <div class="form-group">
              MOtivo Baja:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarMotivoBaja" name="editarMotivoBaja" value="" placeholder="Ingresar Motivo de la Baja">
              </div>
            </div>
            <!-- ENTRADA PARA SABER SI ES EX PNC-->
            <div class="form-group">
              Es Ex-PNC?
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarExPNC">
                  <option value="" id="editarExPNC"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SABER HA CURSADO ANSP-->
            <div class="form-group">
              HA CURSADO ANSP?
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarCursoANSP">
                  <option value="" id="editarCursoANSP"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DIPLOMA ANSP</div>
              <input type="file" class="nuevaFotoANSP" name="editarFotoANSP">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarANSP" width="100px">
              <input type="hidden" name="fotoActualANSP" id="fotoActualANSP">
            </div>
            <!-- ENTRADA PARA TRABAJO ANTERIOR-->
            <div class="form-group">
              Nombre Trabajo Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarTrabajoAnterior" name="editarTrabajoAnterior" value="" placeholder="Ingresar Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA SUELDO QUE DEVENGO-->
            <div class="form-group">
              Sueldo que Deveng&oacute;:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarSueldoDevengo" name="editarSueldoDevengo" value="" placeholder="Ingresar Sueldo que Deveng&oacute;">
              </div>
            </div>
            <!-- ENTRADA PARA TRABAJO ACTUAL-->
            <div class="form-group">
              Nombre Trabajo Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarTrabajoActual" name="editarTrabajoActual" value="" placeholder="Ingresar Trabajo Actual">
              </div>
            </div>
            <!-- ENTRADA PARA SUELDO QUE DEVENGa-->
            <div class="form-group">
              Sueldo que Devenga:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarSueldoDevenga" name="editarSueldoDevenga" value="" placeholder="Ingresar Sueldo que Devenga">
              </div>
            </div>
            <!-- ENTRADA PARA SABER SI FUE SUSPENDIDO ANTERIO-->
            <div class="form-group">
              Ha sido Suspendido en Trabajos anteriores?
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarSuspendidoAnterior">
                  <option value="" id="editarSuspendidoAnterior"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA EMPRESA SUSPENDIO-->
            <div class="form-group">
              Empresa que lo Suspendi&oacute;
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarEmpresaSuspendio" name="editarEmpresaSuspendio" value="" placeholder="Ingresar Empresa que lo Suspendi&oacute;">
              </div>
            </div>
            <!-- ENTRADA PARA MOTIVO SUSPENDION-->
            <div class="form-group">
              Motivo Suspensi&oacute;n:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarMotivoSuspension" name="editarMotivoSuspension" value="" placeholder="Ingresar Motivo Suspensi&oacute;n">
              </div>
            </div>
            <!-- ENTRADA PARA FECHA SUSPENSION-->
            <div class="form-group">
              Fecha Suspensi&oacute;n:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_susp form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="editarfecha_susp" placeholder="Ingresar Fecha" id="mascarafechasusp" readonly>
                <input type="text" class="oficial_editarfecha_susp" name="editarfecha_susp" style="display: none;" id="editarfecha_susp">
              </div>
            </div>
            <!-- ENTRADA PARA EXPERIENCI ALABORAL-->
            <div class="form-group">
              Experiencia Laboral:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarExperienciaLaboral" name="editarExperienciaLaboral" value="" placeholder="Ingresar Experiencia Laboral">
              </div>
            </div>
            <!-- ENTRADA PARA RAZXON ISE-->
            <div class="form-group">
              Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarRazonIse" name="editarRazonIse" value="" placeholder="Ingresar Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE">
              </div>
            </div>
            <!-- ENTRADA PARA PERSONAS DEPENDIENTES-->
            <div class="form-group">
              N&uacute;mero de Personas Dependientes:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarPersonasDependientes" name="editarPersonasDependientes" value="" placeholder="Ingresar N&uacute;mero de Personas Dependientes">
              </div>
            </div>
            <!-- ENTRADA PARA OBSERVACIONES-->
            <div class="form-group">
              Observaciones:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarObservaciones" name="editarObservaciones" value="" placeholder="Ingresar Observaciones">
              </div>
            </div>
            <!-- ENTRADA NUMERO DE TEL TRABAJO ANTERIOR-->
            <div class="form-group">
              N&uacute;mero de Tel&eacute;fono Trabajo Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumTelTrabajoAnterior" name="editarNumTelTrabajoAnterior" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA TRABAJO ACTUAL-->
            <div class="form-group" style="display:none;">
              Nombre Trabajo Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarTrabajoActual" name="editarTrabajoActual" value="" placeholder="Ingresar Trabajo Actual">
              </div>
            </div>
            <!-- ENTRADA NUMERO DE REF TEL TRABAJO ANTERIOR-->
            <div class="form-group">
              Nombre de Referencia Trabajo Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNomRefTrabajoAnterior" name="editarNomRefTrabajoAnterior" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA EVALUACION ANTERIOR-->
            <div class="form-group">
              Evaluaci&oacute;n Anterior:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarEvaluacionAnterior" name="editarEvaluacionAnterior" value="" placeholder="Ingresar Evaluaci&oacute;n Anterior">
              </div>
            </div>
            <!-- ENTRADA NOM DE REF TEL TRABAJO ACTUAL-->
            <div class="form-group">
              Nombre de Referencia Trabajo Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNomRefTrabajoActual" name="editarNomRefTrabajoActual" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Actual">
              </div>
            </div>
            <!-- ENTRADA PARA EVALUACION ACTUAL-->
            <div class="form-group">
              Evaluaci&oacute;n Actual:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarEvaluacionActual" name="editarEvaluacionActual" value="" placeholder="Ingresar Evaluaci&oacute;n Actual">
              </div>
            </div>
            <!-- ENTRADA PARA INFO VERIFICADA-->
            <div class="form-group">
              Ha verificado la informaci&oacute;n?
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarInfoVerificada">
                  <option value="" id="editarInfoVerificada"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR DE SOLICITUD-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE SOLICITUD</div>
              <input type="file" class="nuevaFotoSOLICITUD" name="editarFotoSOLICITUD">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarSOLICITUD" width="100px">
              <input type="hidden" name="fotoActualSOLICITUD" id="fotoActualSOLICITUD">
            </div>
            <!-- ENTRADA PARA SUBIR DE SOLICITUD-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE PARTIDA DE NACIMIENTO</div>
              <input type="file" class="nuevaFotoPARTIDA" name="editarFotoPARTIDA">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPARTIDA" width="100px">
              <input type="hidden" name="fotoActualPARTIDA" id="fotoActualPARTIDA">
            </div>
            <!-- ENTRADA PARA SUBIR DE ANTECEDENTES PENALES-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE ANTECEDENTES PENALES</div>
              <input type="file" class="nuevaFotoANTECEDENTES" name="editarFotoANTECEDENTES">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarANTECEDENTES" width="100px">
              <input type="hidden" name="fotoActualANTECEDENTES" id="fotoActualANTECEDENTES">
            </div>
            <!-- ENTRADA PARA FECHA VENC AP-->
            <div class="form-group">
              Fecha Vencimiento Antecedentes Penales:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_venceAP form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="editarfecha_venceAP" placeholder="Ingresar Fecha" id="mascarafechavenceAP" readonly>
                <input type="text" class="oficial_editarfecha_venceAP" name="editarfecha_venceAP" style="display: none;" id="editarfecha_venceAP">
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR SOLVENCIA PNC -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE SOLVENCIA PNC</div>
              <input type="file" class="nuevaFotoSOLVENCIAPNC" name="editarFotoSOLVENCIAPNC">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarSOLVENCIAPNC" width="100px">
              <input type="hidden" name="fotoActualSOLVENCIAPNC" id="fotoActualSOLVENCIAPNC">
            </div>
            <!-- ENTRADA PARA FECHA VENC AP-->
            <div class="form-group">
              Fecha Vencimiento Solvencia PNC:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario editarfecha_venceSPNC form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="editarfecha_venceSPNC" placeholder="Ingresar Fecha" id="mascarafechavenceSPNC" readonly>
                <input type="text" class="oficial_editarfecha_venceSPNC" name="editarfecha_venceSPNC" style="display: none;" id="editarfecha_venceSPNC">
              </div>
            </div>
            <!-- ENTRADA PARA SUBIR CONSTANCIA PSYCOLOGICA -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE CONSTANCIA PSICOLOGICA</div>
              <input type="file" class="nuevaFotoPSYCO" name="editarFotoPSYCO">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPSYCO" width="100px">
              <input type="hidden" name="fotoActualPSYCO" id="fotoActualPSYCO">
            </div>


            <!-- ENTRADA PARA SUBIR EXAMEN POLIGRAFICO -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE EXAMEN POLIGRAFICO</div>
              <input type="file" class="nuevaFotoPOLI" name="editarFotoPOLI">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPOLI" width="100px">
              <input type="hidden" name="fotoActualPOLI" id="fotoActualPOLI">
            </div>
            <!-- ENTRADA PARA SUBIR HUELLAS DIGITALES -->
            <div class="form-group">
              <div class="panel">SUBIR FOTO DE HUELLAS DIGITALES</div>
              <input type="file" class="nuevaFotoHUELLAS" name="editarFotoHUELLAS">
              <p class="help-block">Peso máximo de la foto 2MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarHUELLAS" width="100px">
              <input type="hidden" name="fotoActualHUELLAS" id="fotoActualHUELLAS">
            </div>


            <!-- ENTRADA PARA CONFIABLE-->
            <div class="form-group">
              Es Confiable?
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarConfiable">
                  <option value="" id="editarConfiable"></option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>









            <!-- ENTRADA PARA SELECCIONAR ESTADO -->
            <div class="form-group">
              Estado:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarEstado" required>
                  <option value="" id="editarEstado"></option>
                  <option value="1">Solicitud</option>
                  <option value="2">Contratado</option>
                  <option value="3">Inactivo</option>
                  <option value="4">Incapacitado</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR CARGO -->
            <div class="form-group">
              CARGO:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarCARGO">
                  <option id="editarCARGO"></option>
                  <?php
                  $datos_mostrar_cargo = ControladorCargos::ctrMostrar($item, $valor);
                  foreach ($datos_mostrar_cargo as $key => $value) {
                    echo '<option value="' . $value["nivel"] . '">' . $value["descripcion"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>






            <!-- ENTRADA PARA PANTALON-->
            <div class="form-group">
              Pantalón:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg" name="editarpantalon_empleado" id="editarpantalon_empleado" placeholder="Ingresar Pantalón" maxlength="3">
              </div>
            </div>

            <!-- ENTRADA PARA camisa-->
            <div class="form-group">
              Camisa:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg" name="editarcamisa_empleado" id="editarcamisa_empleado" placeholder="Ingresar Camisa" maxlength="3">
              </div>
            </div>


            <!-- ENTRADA PARA Zapatos-->
            <div class="form-group">
              Zapatos:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg" name="editarzapatos_empleado" id="editarzapatos_empleado" placeholder="Ingresar Zapatos" maxlength="3">
              </div>
            </div>


            <!-- ENTRADA PARA Recomendado por:-->
            <div class="form-group">
              Recomendado por:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="editarrecomendado_empleado" id="editarrecomendado_empleado" required>
                  <option value="">Seleccionar Recomendado</option>
                  <?php
                  $datos_mostrar_cargo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                  foreach ($datos_mostrar_cargo as $key => $value) {
                    echo '<option value="' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . '">' . $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["primer_apellido"] . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>



            <!-- ENTRADA PARA Zapatos-->
            <div class="form-group">
              Medio de contacto:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" value="" class="form-control input-lg telefono" name="editarcontacto_empleado" id="editarcontacto_empleado" placeholder="Ingresar Medio de contacto">
              </div>
            </div>


            <div class="form-group">
              Documentación completa:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="editardocumentacion_empleado" id="editardocumentacion_empleado" required>
                  <option value="">Seleccionar Documentación completa</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


            <div class="form-group">
              ¿Tiene ANSP?:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="editaransp_empleado" id="editaransp_empleado" required>
                  <option value="">¿Tiene ANSP?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


            <div class="form-group">
              Uniforme regalado:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select class="form-control input-lg" name="editaruniformeregalado_empleado" id="editaruniformeregalado_empleado" required>
                  <option value="">Uniforme regalado</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>


            <!--  **** -->



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar empleado</button>

        </div>

        <?php

        $editarEmpleado = new ControladorEmpleados();
        $editarEmpleado->ctrEditarEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL PARENTESCO 
======================================-->

<div id="modalParentesco" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">



      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Parentesco</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
      <div class="modal-body">

        <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data">
            <label for="" style="width: 100%;font-size: large;text-align: center;color: #3c388b;">FORMULARIO DE INGRESO DE NUEVO PARIENTE</label>
            <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
            <input type="hidden" name="idEmpleadoParentesco" id="idEmpleadoParentesco" value="">
            <div class="form-group">
              <label for="">Parentesco:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoParentesco" required>
                  <option value="">Seleccione Parentesco</option>
                  <option value="Esposo(a)">Esposo(a)</option>
                  <option value="Hijo(a)">Hijo(a)</option>
                  <option value="Padre">Padre</option>
                  <option value="Madre">Madre</option>
                  <option value="Hermano(a)">Hermano(a)</option>
                  <option value="Tio(a)">Tio(a)</option>
                  <option value="Primo(a)">Primo(a)</option>
                  <option value="Sobrino(a)">Sobrino(a)</option>
                  <option value="Abuelo(a)">Abuelo(a)</option>
                  <option value="cunado(a)">cunado(a)</option>

                </select>
              </div>
            </div>


            <!-- ENTRADA PARA EL Codigo  -->
            <div class="form-group">
              <label for="">Ingresar Nombre Completo</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span>
                <input type="text" class="form-control input-lg codigo_validar" name="nuevoNombreParentesco" placeholder="Ingresar Nombre Completo" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              <label for="">Fecha Nacimiento</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building"></i></span>
                <input type="text" class="form-control input-lg calendario" name="nuevoEdadParentesco" placeholder="Ingresar Edad" required readonly>
              </div>
            </div>
            <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
            <div class="form-group">
              <label for="">Con Vida:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoConVidaParentesco" required>
                  <option value="">Seleccione </option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <!-- ENTRADA PARA LA DIRECCION DE RESIDENCIA-->
            <div class="form-group">
              Direcci&oacute;n Residencia:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDireccionParentesco" placeholder="Ingresar Direcci&oacute;n">
              </div>
            </div>
            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="form-group">
              Tel&eacute;fono:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg input_telefono_1 telefono" name="nuevoTelefonoParentesco" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono">
              </div>
            </div>

        </div>



      </div>

      <!--=====================================
        PIE DEL MODAL
        ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar Pariente</button>

      </div>
      <div class="modal-body">

        <div id="headerParentesco"></div>
      </div>



      <?php

      $crearp = new ControladorParentesco();
      $crearp->ctrCrearParentesco();

      ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL DESCUENTOS 
======================================-->

<div id="modalDescuento" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">



      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Devengos y Descuentos</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
      <div class="modal-body">
        <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data">
            <label for="" style="width: 100%;font-size: large;text-align: center;color: #3c388b;">FORMULARIO DE INGRESO DE NUEVO DEVENGO O DESCUENTO</label>
            <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
            <input type="hidden" name="idEmpleadoDescuento" id="idEmpleadoDescuento" value="">

            <div class="form-group">
              <label for="">Seleccionar Devengo o Descuento:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoIdDescuento" required>
                  <option value="">Seleccione una opci&oacute;n</option>
                  <?php
                  $datos_mostrar_descuento = ControladorDescuentos::ctrMostrar($item, $valor);
                  foreach ($datos_mostrar_descuento as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["codigo"] . ',' . $value["descripcion"] . ',' . $value["porcentaje"] . '% - $' . $value["tipo"] . ',' . $value["cargo_abono"] . ',' . $value["cuenta_contable"] . '</option>';
                  }
                  ?>

                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="">Seleccionar Tipo:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevotipodescuento" required>
                  <option value="">Seleccione una opci&oacute;n</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="Siempre">Siempre</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              Valor:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoValor" placeholder="Ingresar Valor">
              </div>
            </div>

            <!-- ENTRADA PARA FECHA DE  vencimiento DEscuento,devengo   -->
            <div class="form-group">
              Fecha Caducidad:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_caducidad form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_caducidad" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_caducidad" name="nuevofecha_caducidad" style="display: none;">
              </div>
            </div>

            <!-- ENTRADA referencia -->
            <div class="form-group">
              Referencia:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoReferencia" placeholder="Ingresar Referencia">
              </div>
            </div>

        </div>

      </div>

      <!--=====================================
        PIE DEL MODAL
        ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar Devengo o Descuento</button>

      </div>

      <div class="modal-body">
        <div id="headerEmpleadoDescuento"></div>

      </div>

      <?php

      $creardesc = new ControladorEmpleadoDescuento();
      $creardesc->ctrCrearEmpleadoDescuento();

      ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL SEMINARIO 
======================================-->

<div id="modalSeminario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">



      <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Seminarios</h4>

      </div>

      <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
      <div class="modal-body">

        <div class="box-body">

          <form role="form" method="post" enctype="multipart/form-data">
            <label for="" style="width: 100%;font-size: large;text-align: center;color: #3c388b;">FORMULARIO DE NUEVO SEMINARIO</label>
            <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
            <input type="hidden" name="idEmpleadoSeminario" id="idEmpleadoSeminario" value="">

            <div class="form-group">
              <label for="">Seleccionar Seminario:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoIdSeminario" required>
                  <option value="">Seleccione una opci&oacute;n</option>
                  <?php
                  $datos_mostrar_seminario = Controladorseminarios::ctrMostrar($item, $valor);
                  foreach ($datos_mostrar_seminario as $key => $value) {
                    echo '<option value="' . $value["id"] . '-' . $value["codigo"] . '">' . $value["codigo"] . ' - ' . $value["nombre"] . '</option>';
                  }
                  ?>

                </select>
              </div>
            </div>

            <!-- ENTRADA FECHA REALIZACION SEMINARIO   -->
            <div class="form-group">
              Fecha Realizado:
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" value="" class="calendario nuevofecha_seminarior form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="" fecha="nuevofecha_seminarior" placeholder="Ingresar Fecha" readonly>
                <input type="text" class="oficial_nuevofecha_seminarior" name="nuevofecha_seminarior" style="display: none;">
              </div>

              <!-- LUGAR REALIZACION SEMINARIO   -->
              <div class="form-group">
                Lugar Realizado:
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" class="form-control input-lg" name="nuevoLugarSeminario" id="nuevoLugarSeminario">
                </div>

              </div>



            </div>
            <div class="box-body">
              <div id="headerEmpleadoSeminario"></div>
            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Seminario</button>

        </div>

        <?php

        $crearsem = new ControladorEmpleadoSeminario();
        $crearsem->ctrCrearEmpleadoSeminario();

        ?>

        </form>

      </div>

    </div>

  </div>




  <?php

  $borrarEmpleado = new ControladorEmpleados();
  $borrarEmpleado->ctrBorrarEmpleado();

  ?>


  <script src="vistas/js/validarempleado.js"></script>
  <script src="vistas/js/cargardevengos.js"></script>
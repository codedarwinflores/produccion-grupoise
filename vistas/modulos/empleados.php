<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">
          
          Agregar empleado

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Foto</th>
           <th>Primer Nombre</th>
           <th>Tipo Documento</th> 
           <th># Documento</th>  
           <th>Imagen Documento</th>        
           <th>Estado</th>           
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

       foreach ($empleados as $key => $value){
         
            //REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
            if($value["estado"] == 1 ){
                $nombreEstado = "Solicitud";
            }
            else if($value["estado"] == 2 ){
                $nombreEstado = "Contratado";
            }
            else if($value["estado"] == 3 ){
                $nombreEstado = "Inactivo";
            }
            else if($value["estado"] == 4 ){
                $nombreEstado = "Incapacitado";
            }
            else{
                $nombreEstado = "Error";
            }   


          echo ' <tr>

                  <td>'.($key+1).'</td>';


                  if($value["fotografia"] != ""){
                    echo '<td><img src="'.$value["fotografia"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }

                 echo '<td>'.$value["primer_nombre"].'</td>';

                  

                  echo '<td>'.$value["documento_identidad"].'</td>';
                  echo '<td>'.$value["numero_documento_identidad"].'</td>';


                  if($value["imagen_documento_identidad"] != ""){
                    echo '<td><img src="'.$value["imagen_documento_identidad"].'" class="img-thumbnail" width="40px"></td>';
                  }else{
                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                  }


                  echo '<td>'.$nombreEstado.'</td>';          

                  echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarEmpleado" idEmpleado="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarEmpleado"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarEmpleado" idEmpleado="'.$value["id"].'" fotoEmpleado="'.$value["fotografia"].'" empleado="'.$value["numero_documento_identidad"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>

                </tr>';
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

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Primer Nombre" required>

              </div>

            </div>
            <!-- ENTRADA PARA EL SEGUNDO  NOMBRE -->            
            <div class="form-group">
            Segundo Nombre:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoSegundoNombre" placeholder="Ingresar Segundo Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TERCER  NOMBRE -->            
            <div class="form-group">
            Tercer Nombre:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTercerNombre" placeholder="Ingresar Tercer Nombre" >

              </div>

            </div>


            <!-- ENTRADA PARA EL PRIMER APELLIDO -->            
            <div class="form-group">
            Primer Apellido:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPrimerApellido" placeholder="Ingresar Primer Apellido" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->            
            <div class="form-group">
            Segundo Apellido:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoSegundoApellido" placeholder="Ingresar Segundo Apellido" >

              </div>

            </div>


            <!-- ENTRADA PARA EL APELLIDO DE CASADA -->            
            <div class="form-group">
             Apellido Casada:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoApellidoCasada" placeholder="Ingresar Apellido Casada" >

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

                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Direcci&oacute;n" >

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
                    foreach ($datos_mostrar_departamento as $key => $value){
                      echo '<option value="'.$value["id"].'">'.$value["Nombre"].'</option>';                     
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
                <select class="form-control input-lg" name="nuevoMunicipio" id="nuevoMunicipio" >                  
                  <option value="">Seleccionar Municipio</option>
                  
                </select>
              </div>
            </div>
          <!-- ENTRADA PARA EL TELEFONO -->            
          <div class="form-group">  
            Tel&eacute;fono:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono" >
              </div>
          </div>
          <!-- ENTRADA PARA EL numero ISSS -->            
          <div class="form-group"> 
            N&uacute;mero ISSS:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroIsss" placeholder="Ingresar N&uacute;mero de ISSS" >
              </div>
          </div>
           <!-- ENTRADA PARA EL nombre segun  ISSS -->            
           <div class="form-group">  
           Nombre Seg&uacute;n ISSS:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNombreIsss" placeholder="Ingresar Nombre seg&uacute;n ISSS" >
              </div>
          </div>
         
           <!-- ENTRADA PARA EL DOCUMENTO -->
            
           <div class="form-group">
              Tipo Documento:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoTipoDocumento">
                  
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

                <input type="text" class="form-control input-lg" name="nuevoNumeroDocumento" id="nuevoNumeroDocumento" placeholder="Ingresar n&uacute;mero documento identidad" required>

              </div>

            </div>
             <!-- ENTRADA PARA EL lugar expedicion documento   -->            
          <div class="form-group">
            Lugar expedici&oacute;n Documento:              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoLugarExpedicionDoc" placeholder="Lugar expedicion del documento" required>
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
                <input type="text" class="form-control input-lg" name="nuevoLicenciaConducir" placeholder="Ingresar N&uacute;mero de Licencia Conducir" >
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
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroNIT" placeholder="Ingresar N&uacute;mero de NIT" >
              </div>
          </div>
          <!-- ENTRADA PARA NUP  -->            
          <div class="form-group"> 
          N&uacute;mero NUP:              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroNUP" placeholder="Ingresar N&uacute;mero NUP" >
              </div>
          </div>
            <!-- ENTRADA PARA PROFESION OFICIO  -->            
            <div class="form-group"> 
              Profesi&oacute;n u Oficio             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoProfesionOficio" placeholder="Ingresar Profesi&oacute;n u Oficio" >
              </div>
          </div>
          <!-- ENTRADA PARA NACIONALIDAD  -->            
          <div class="form-group">    
          Nacionalidad:          
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoNacionalidad" placeholder="Ingresar Nacionalidad" >
              </div>
          </div>

          <!-- ENTRADA PARA LUGAR NACIEMIENTO -->            
          <div class="form-group"> 
          Lugar de Nacimiento:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoLugarNacimiento" placeholder="Ingresar Lugar de Nacimiento" >
              </div>
          </div>
          <!-- ENTRADA PARA RELIGION -->            
          <div class="form-group"> 
          Religi&oacute;n:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoReligion" placeholder="Ingresar Religi&oacute;n" >
              </div>
          </div>

           <!-- ENTRADA PARA GRADO ESTUDIO -->            
           <div class="form-group">  
           Grado de Estudios:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoGradoEstudio" placeholder="Ingresar Grado de Estudios" >
              </div>
          </div>
          <!-- ENTRADA PARA PLANTEL -->            
          <div class="form-group"> 
          Plantel:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoPlantel" placeholder="Ingresar Plantel" >
              </div>
          </div>

          <!-- ENTRADA PARA PESO -->            
          <div class="form-group"> 
          Peso:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoPeso" placeholder="Ingresar Peso" >
              </div>
          </div>
          <!-- ENTRADA PARA ESTATURA -->            
          <div class="form-group"> 
            Estatura:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"class="form-control input-lg" name="nuevoEstatura" placeholder="Ingresar Estatura" >
              </div>
          </div>
          <!-- ENTRADA PARA PIEL -->            
          <div class="form-group">  
            Color de Piel:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoPiel" placeholder="Ingresar Color de Piel" >
              </div>
          </div>
          <!-- ENTRADA PARA OJOS -->            
          <div class="form-group">
          Color de Ojos:               
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoOjos" placeholder="Ingresar Color de Ojos" >
              </div>
          </div>
          <!-- ENTRADA PARA CABELLO -->            
          <div class="form-group">
          Color de Cabello:               
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCabello" placeholder="Ingresar Color Cabello" >
              </div>
          </div>
          <!-- ENTRADA PARA CARA -->            
          <div class="form-group"> 
            Cara:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCara" placeholder="Ingresar Cara" >
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
                <input type="text" class="form-control input-lg" name="nuevoSenalesEspeciales" placeholder="Ingresar Se&nacute;ales Especiales" >
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
                <input type="text" class="form-control input-lg" name="nuevoNumeroLicenciaTDA" placeholder="Ingresar N&uacute;mero Licencia de Tenencia de Armas" >
              </div>
          </div>
           <!-- ENTRADA PARA SUBIR FOTO  DE LICENCIA-->
           <div class="form-group">              
              <div class="panel">SUBIR FOTO LICENCIA  TENENCIA DE ARMAS</div>
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
          <!-- ENTRADA PARA LUGAR SEV MIL -->            
          <div class="form-group"> 
          Lugar Servicio Militar:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoLugarServicioMilitar" placeholder="Ingresar Lugar Servicio Militar" >
              </div>
          </div>

          <!-- ENTRADA PARA GRADO MILITAR -->            
          <div class="form-group"> 
          Grado Militar:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoGradoMilitar" placeholder="Ingresar Grado Militar" >
              </div>
          </div>

          
          <!-- ENTRADA PARA MOTIVO BAJA -->            
          <div class="form-group">   
          Motivo de la Baja:           
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoMotivoBaja" placeholder="Ingresar Motivo de la Baja" >
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

           <!-- ENTRADA PARA TRABAJO ANTERIOR-->            
           <div class="form-group">      
           Nombre Trabajo Anterior:        
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTrabajoAnterior" placeholder="Ingresar Trabajo Anterior" >
              </div>
          </div>
          <!-- ENTRADA PARA SUELDO QUE DEVENGO-->            
          <div class="form-group"> 
          Sueldo que Deveng&oacute;o:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoSueldoDevengo" placeholder="Ingresar Sueldo que Deveng&oacute;o" >
              </div>
          </div>
          <!-- ENTRADA PARA TRABAJO ACTUAL-->            
          <div class="form-group">  
          Nombre Trabajo Actual:          
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTrabajoActual" placeholder="Ingresar Trabajo Actual" >
              </div>
          </div>
          <!-- ENTRADA PARA SUELDO QUE DEVENGA-->            
          <div class="form-group"> 
          Sueldo que Devenga:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoSueldoDevenga" placeholder="Ingresar Sueldo que Devenga" >
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
                <input type="text" class="form-control input-lg" name="nuevoEmpresaSuspendio" placeholder="Ingresar Empresa que Suspendi&oacute;" >
              </div>
          </div>
          <!-- ENTRADA PARA MOTIVO SUSPENSION-->            
          <div class="form-group">     
          Motivo de Suspensi&oacute;n:         
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoMotivoSuspension" placeholder="Ingresar Motivo de Suspensi&oacute;n" >
              </div>
          </div>

          
          <!-- ENTRADA PARA EXPERIENCIA LABORAL-->            
          <div class="form-group">  
          Experiencia Laboral:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoExperienciaLaboral" placeholder="Ingresar Experiencia Laboral" >
              </div>
          </div>
          <!-- ENTRADA PARA RAZON POR LA CUAL DESEA TRABAJAR EN ISE-->            
          <div class="form-group">         
          Raz&oacute;n por la cu&aacute;l quiere trabajar en G.ISE:     
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoRazonIse" placeholder="Raz&oacute;n por la cu&aacute;l quiere trabajar en G.ISE" >
              </div>
          </div>

          <!-- ENTRADA PARA NUMERO PERSONAS DEPENDIENTES-->            
          <div class="form-group">   
          N&uacute;mero de Personas Dependientes:           
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroPersonasDependientes" placeholder="Ingresar N&uacute;mero de Personas Dependientes" >
              </div>
          </div>
          <!-- ENTRADA PARA OBSERVACIONES-->            
          <div class="form-group">      
          Observaciones:        
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoObservaciones" placeholder="Ingresar Observaciones" >
              </div>
          </div>

          <!-- ENTRADA PARA TELEFONO TRABAJO ANTERIOR-->            
          <div class="form-group">  
          N&uacute;mero de Tel&eacute;fono Trabajo Anterior:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="nuevoNumeroTelTrabajoAnterior" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono Trabajo Anterior" >
              </div>
          </div>
          <!-- ENTRADA PARA TRABAJO ACTUAL-->            
          <div class="form-group"> 
          Nombre Trabajo Actual:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoTrabajoActual" placeholder="Ingresar Trabajo Actual" >
              </div>
          </div>

           <!-- ENTRADA PARA TELEFONO REFEREWANCIA ANTERIOR-->            
           <div class="form-group"> 
           Nombre Referencia Trabajo Anterior:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" name="nuevoNombreRefTrabajoAnterior" placeholder="Ingresar Nombre Referencia Trabajo Anterior" >
              </div>
          </div>
          <!-- ENTRADA PARA EVALUACION ANTERIOR-->            
          <div class="form-group">        
          Evaluaci&oacute;n Anterior:      
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoEvaluacionAnterior" placeholder="Ingresar Evaluaci&oacute;n Anterior" >
              </div>
          </div>


           <!-- ENTRADA PARA TELEFONO REFEREWANCIA ACTUAL-->            
           <div class="form-group">  
           Nombre Referencia Trabajo Actual:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" name="nuevoNomRefTrabajoActual" placeholder="Ingresar Nombre Referencia Trabajo Actual" >
              </div>
          </div>
          <!-- ENTRADA PARA EVALUACION ACTUAL-->            
          <div class="form-group">  
          Evaluaci&oacute;n Actual:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoEvaluacionActual" placeholder="Ingresar Evaluaci&oacute;n Actual" >
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

                <select class="form-control input-lg" name="nuevoEstado">
                  
                  <option value="">Seleccionar estado</option>

                  <option value="1">Solicitud</option>

                  <option value="2">Contratado</option>

                  <option value="3">Inactivo</option>

                  <option value="4">Incapacitado</option>

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

          <button type="submit" class="btn btn-primary">Guardar empleado</button>

        </div>

        <?php

          $crearEmpleado = new ControladorEmpleados();
          $crearEmpleado -> ctrCrearEmpleado();

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


            <input type="hidden" id="idEmpleado" name="idEmpleado" >
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

                <input type="text" class="form-control input-lg" id="editarSegundoNombre" name="editarSegundoNombre" value="" >

              </div>

            </div>
            <!-- ENTRADA PARA EL TERCER NOMBRE -->
            
            <div class="form-group">
              Tercer Nombre:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTercerNombre" name="editarTercerNombre" value="" >

              </div>

            </div>
            <!-- ENTRADA PARA EL PRIMER APELLIDO -->
            
            <div class="form-group">
              Primer Apellido:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarPrimerApellido" name="editarPrimerApellido" value="" reqired>

              </div>

            </div>
            <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->
            
            <div class="form-group">
              Segundo Apellido:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarSegundoApellido" name="editarSegundoApellido" value="" >

              </div>

            </div>
            <!-- ENTRADA PARA EL APELLIDO DE CASADA-->
            
            <div class="form-group">
            Apellido Casada:
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarApellidoCasada" name="editarApellidoCasada" value="" >

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

                <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" value="" >

              </div>

            </div>


           <!-- ***DEPARTAMENTO -->
          <!-- *** -->
          <div class="form-group">  
            Departamento:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarDepartamento"  onchange='poblarMuniEditar()'>                  
                <option id="editarDepartamento"></option>
                  <?php
                    $datos_mostrar_departamento = Controladorcat_departamento::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar_departamento as $key => $value){
                      echo '<option value="'.$value["id"].'">'.$value["Nombre"].'</option>';                     
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
                <select class="form-control input-lg" name="editarMunicipio"  >                  
                <option id="editarMunicipio"></option>
               
                </select>
              </div>
            </div>
          
            <!-- ENTRADA PARA EL NUMERO DE TELEFONO -->            
            <div class="form-group"> 
            N&uacute;mero de Tel&eacute;fono:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroTelefono" name="editarNumeroDocumento" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono">
              </div>
            </div>

            <!-- ENTRADA PARA EL NUMERO ISSS-->            
            <div class="form-group"> 
            N&uacute;mero de ISSS:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroIsss" name="editarNumeroDocumento" value="" placeholder="Ingresar N&uacute;mero de ISSS">
              </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE ISSS -->            
            <div class="form-group">
            Nombre Seg&uacute;n ISSS:              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarNombreIsss" name="editarNombreIsss" value="" placeholder="Ingresar Nombre Seg&uacute;n ISSS">
              </div>
            </div>
            
            <!-- ENTRADA PARA SELECCIONAR TIPO DOCUMENTO -->
            <div class="form-group">
              Tipo de Documento:              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarTipoDocumento">                  
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

                <input type="text" class="form-control input-lg" id="editarNumeroDocumento" name="editarNumeroDocumento" value="" >

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
                <input type="text"  class="form-control input-lg" id="editarLugarExpedicionDoc" name="editarLugarExpedicionDoc" value="" placeholder="Ingresar Lugar Expedici&oacute;n Documento">
              </div>
            </div>

            <!-- ENTRADA PARA LICENCIA DE CONDUCIR-->            
            <div class="form-group"> 
            N&uacute;mero de Licencia de Conducir:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroLicenciaConducir" name="editarNumeroLicenciaConducir" value="" placeholder="Ingresar N&uacute;mero de Licencia de Conducir">
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
                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroNit" name="editarNumeroNit" value="" placeholder="Ingresar N&uacute;mero de NIT">
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
                <input type="text"  class="form-control input-lg" id="editarProfesionOficio" name="editarProfesionOficio" value="" placeholder="Ingresar Profesi&oacute;n u Oficio">
              </div>
            </div>
            <!-- ENTRADA PARA NACIONALIDAD -->            
           <div class="form-group">  
           Nacionalidad:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarNacionalidad" name="editarNacionalidad" value="" placeholder="Ingresar Nacionalidad">
              </div>
            </div>
             <!-- ENTRADA PARA LUGAR NACIEMIENTO -->            
           <div class="form-group">   
           Lugar de Nacimiento:           
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarLugarNac" name="editarLugarNac" value="" placeholder="Ingresar Lugar de Nacimiento">
              </div>
            </div>
            <!-- ENTRADA PARA RELIGION -->            
           <div class="form-group">    
           Religi&oacute;n:          
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarReligion" name="editarReligion" value="" placeholder="Ingresar Religi&oacute;n">
              </div>
            </div>
             <!-- ENTRADA PARA GRADO DE ESTUDIOS -->            
           <div class="form-group"> 
           Grado de Estudios:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarGradoEstudios" name="editarGradoEstudios" value="" placeholder="Ingresar Grado de Estudios">
              </div>
            </div>
            <!-- ENTRADA PARA PLANTEL-->            
           <div class="form-group"> 
           Plantel:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarPlantel" name="editarPlantel" value="" placeholder="Ingresar Plantel">
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
                <input type="text"  class="form-control input-lg" id="editarPiel" name="editarPiel" value="" placeholder="Ingresar Color Piel">
              </div>
            </div>
            <!-- ENTRADA PARA OJOS-->            
           <div class="form-group"> 
           Color de Ojos:              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarOjos" name="editarOjos" value="" placeholder="Ingresar Color Ojos">
              </div>
            </div>
            <!-- ENTRADA PARA CABELLO-->            
           <div class="form-group">  
           Color de Cabello:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarCabello" name="editarCabello" value="" placeholder="Ingresar Color Cabello">
              </div>
            </div>
            <!-- ENTRADA PARA CARA-->            
           <div class="form-group"> 
            Cara:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarCara" name="editarCara" value="" placeholder="Ingresar Cara">
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
                <input type="text"  class="form-control input-lg" id="editarSenalesEspeciales" name="editarSenalesEspeciales" value="" placeholder="Ingresar Se&nacute;ales Especiales">
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
             <!-- ENTRADA PARA LUGAR SERVICIO MILITAR-->            
           <div class="form-group"> 
           Lugar de Servicio Militar:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarLugarServicioMilitar" name="editarLugarServicioMilitar" value="" placeholder="Ingresar Lugar de Servicio Militar">
              </div>
            </div>
            <!-- ENTRADA PARA GRADO MILITAR-->            
           <div class="form-group">  
           Grado Militar:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarGradoMilitar" name="editarGradoMilitar" value="" placeholder="Ingresar Grado Militar">
              </div>
            </div>
            <!-- ENTRADA PARA MOTIVO BAJA-->            
           <div class="form-group">   
            MOtivo Baja:           
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarMotivoBaja" name="editarMotivoBaja" value="" placeholder="Ingresar Motivo de la Baja">
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
            <!-- ENTRADA PARA TRABAJO ANTERIOR-->            
           <div class="form-group">
           Nombre Trabajo Anterior:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarTrabajoAnterior" name="editarTrabajoAnterior" value="" placeholder="Ingresar Trabajo Anterior">
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
                <input type="text"  class="form-control input-lg" id="editarTrabajoActual" name="editarTrabajoActual" value="" placeholder="Ingresar Trabajo Actual">
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
                <input type="text"  class="form-control input-lg" id="editarEmpresaSuspendio" name="editarEmpresaSuspendio" value="" placeholder="Ingresar Empresa que lo Suspendi&oacute;">
              </div>
            </div>
             <!-- ENTRADA PARA MOTIVO SUSPENDION-->            
           <div class="form-group">  
           Motivo Suspensi&oacute;n:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarMotivoSuspension" name="editarMotivoSuspension" value="" placeholder="Ingresar Motivo Suspensi&oacute;n">
              </div>
            </div>
             <!-- ENTRADA PARA EXPERIENCI ALABORAL-->            
           <div class="form-group">  
            Experiencia Laboral:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarExperienciaLaboral" name="editarExperienciaLaboral" value="" placeholder="Ingresar Experiencia Laboral">
              </div>
            </div>
             <!-- ENTRADA PARA RAZXON ISE-->            
           <div class="form-group">  
           Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE:            
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarRazonIse" name="editarRazonIse" value="" placeholder="Ingresar Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE">
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
                <input type="text"  class="form-control input-lg" id="editarObservaciones" name="editarObservaciones" value="" placeholder="Ingresar Observaciones">
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
           <div class="form-group"> 
           Nombre Trabajo Actual:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarTrabajoActual" name="editarTrabajoActual" value="" placeholder="Ingresar Trabajo Actual">
              </div>
            </div>
             <!-- ENTRADA NUMERO DE REF TEL TRABAJO ANTERIOR-->            
             <div class="form-group"> 
             Nombre de Referencia  Trabajo Anterior:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarNomRefTrabajoAnterior" name="editarNomRefTrabajoAnterior" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Anterior">
              </div>
            </div>
            <!-- ENTRADA PARA EVALUACION ANTERIOR-->            
           <div class="form-group">
           Evaluaci&oacute;n Anterior:              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarEvaluacionAnterior" name="editarEvaluacionAnterior" value="" placeholder="Ingresar Evaluaci&oacute;n Anterior">
              </div>
            </div>
            <!-- ENTRADA NUMERO DE REF TEL TRABAJO ACTUAL-->            
            <div class="form-group"> 
            Nombre de Referencia  Trabajo Actual:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarNomRefTrabajoActual" name="editarNomRefTrabajoActual" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Actual">
              </div>
            </div>
             <!-- ENTRADA PARA EVALUACION ACTUAL-->            
           <div class="form-group"> 
           Evaluaci&oacute;n Actual:             
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                <input type="text"  class="form-control input-lg" id="editarEvaluacionActual" name="editarEvaluacionActual" value="" placeholder="Ingresar Evaluaci&oacute;n Actual">
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

                <select class="form-control input-lg" name="editarEstado">
                  
                  <option value="" id="editarEstado"></option>                  

                  <option value="1">Solicitud</option>

                  <option value="2">Contratado</option>

                  <option value="3">Inactivo</option>

                  <option value="4">Incapacitado</option>

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

          <button type="submit" class="btn btn-primary">Modificar empleado</button>

        </div>

     <?php

          $editarEmpleado = new ControladorEmpleados();
          $editarEmpleado -> ctrEditarEmpleado();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarEmpleado = new ControladorEmpleados();
  $borrarEmpleado -> ctrBorrarEmpleado();

?> 



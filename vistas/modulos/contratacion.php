<?php


if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
//require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");
require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php");


?>

<div class="content-wrapper">

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

            

            

            <div class="modal-body">

            <div class="box-body">

            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Datos generales</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>

            <div class="col-md-12" > 
                <!-- ENTRADA PARA SUBIR FOTO -->
                <div class="form-group">              
                  <div class="panel">SUBIR FOTO</div>
                  <input type="file" class="nuevaFoto" name="editarFoto">
                  <p class="help-block">Peso máximo de la foto 2MB</p>
                  <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditar" width="100px">
                  <input type="hidden" name="fotoActual" id="fotoActual">
                </div>
            </div>
            
            
            
            <div class="col-md-12" > 
                <div class="col-md-4" > 
                  <!-- ENTRADA PARA EL PRIMER NOMBRE -->            
                  <div class="form-group">
                    Primer Nombre:
                    <div class="input-group">              
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>
                    </div>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL SEGUNDO NOMBRE -->            
                    <div class="form-group">
                      Segundo Nombre:
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="editarSegundoNombre" name="editarSegundoNombre" value="" >
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA EL TERCER NOMBRE -->            
                    <div class="form-group">
                      Tercer Nombre:
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control input-lg" id="editarTercerNombre" name="editarTercerNombre" value="" >
                      </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" > 
                <div class="col-md-4" > 
                    	<!-- ENTRADA PARA EL PRIMER APELLIDO -->            
                      <div class="form-group">
                        Primer Apellido:
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text" class="form-control input-lg" id="editarPrimerApellido" name="editarPrimerApellido" value="" required>
                        </div>
                      </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->            
                    <div class="form-group">
                      Segundo Apellido:
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" class="form-control input-lg" id="editarSegundoApellido" name="editarSegundoApellido" value="" required>
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL APELLIDO DE CASADA-->            
                    <div class="form-group">
                    Apellido Casada:
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" class="form-control input-lg" id="editarApellidoCasada" name="editarApellidoCasada" value="" >
                      </div>
                    </div>
                </div>
            </div>

           
            <div class="col-md-12" > 
                <div class="col-md-6" > 
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
                </div>
                <div class="col-md-6" > 
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
                </div>               
            </div>

            <div class="col-md-12" > 
                <div class="col-md-12" > 
                     <!-- ENTRADA PARA LA DIRECCION DE RESIDENCIA -->            
                    <div class="form-group">
                        Direcci&oacute;n de Residencia:
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" value="" >
                        </div>
                      </div>
                </div>
            </div>

            <div class="col-md-12" > 
                <div class="col-md-4" >

                   <!-- ***DEPARTAMENTO -->
                  <!-- *** -->
                  <div class="form-group">  
                    Departamento:            
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                        <select class="form-control input-lg" name="editarDepartamento"  >                  
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

                </div>
                <div class="col-md-4" > 

                    <!-- ***MUNICIPIO -->
                    <!-- *** -->
                    <div class="form-group"> 
                      Municipio:             
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                          <select class="form-control input-lg" name="editarMunicipio"  >                  
                          <option id="editarMunicipio"></option>
                          <?php
                              $datos_mostrar_municipio = Controladorcat_municipios::ctrMostrar($item, $valor);
                              foreach ($datos_mostrar_municipio as $key => $value){
                                echo '<option value="'.$value["id"].'">'.$value["Nombre_m"].'</option>';                     
                              }
                          ?>
                          </select>
                        </div>
                      </div>

                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL NUMERO DE TELEFONO -->            
                    <div class="form-group"> 
                    N&uacute;mero de Tel&eacute;fono:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"   class="form-control input-lg input_telefono_1 telefono" id="editarNumeroTelefono" name="editarNumeroTelefono" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono">
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Documentaci&oacute;n</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>
            <div class="col-md-12" > 
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL NUMERO ISSS-->            
                    <div class="form-group"> 
                    N&uacute;mero de ISSS:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroIsss" name="editarNumeroIsss" value="" placeholder="Ingresar N&uacute;mero de ISSS">
                      </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL NOMBRE ISSS -->            
                    <div class="form-group">
                    Nombre Seg&uacute;n ISSS:              
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"  class="form-control input-lg" id="editarNombreIsss" name="editarNombreIsss" value="" placeholder="Ingresar Nombre Seg&uacute;n ISSS">
                      </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" > 
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
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL NUMERO DOCUMENTO IDENTIDAD -->            
                    <div class="form-group">
                    N&uacute;mero Documento Identidad:
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" class="form-control input-lg input_dui duis"  id="editarNumeroDocumento" name="editarNumeroDocumento" value="" required>
                      </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" >                
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA FECHA EXPEDICION DOCUMENTO -->  
                    <div class="form-group"> 
                      Fecha Expedici&oacute;n Documento:
                      <div class="input-group">                  
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" value="" class="calendario editarfecha_expedicion form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_expedicion" placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                          <input type="text" class="oficial_editarfecha_expedicion" name="editarfecha_expedicion" style="display: none;" id="editarfecha_expedicion">
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA FECHA VENCIMIENTO DOCUMENTO -->  
                    <div class="form-group"> 
                      Fecha Vencimiento  Documento:
                      <div class="input-group">                  
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <input type="text" value="" class="calendario editarfecha_vencimiento form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_vencimiento" placeholder="Ingresar Fecha" id="mascarafechav" readonly>
                          <input type="text" class="oficial_editarfecha_vencimiento" name="editarfecha_vencimiento" style="display: none;" id="editarfecha_vencimiento">
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                   <!-- ENTRADA PARA LUGAR EXPEDICION DOCUMENTO -->            
                    <div class="form-group"> 
                    Lugar Expedici&oacute;n Documento:
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarLugarExpedicionDoc" name="editarLugarExpedicionDoc" value="" placeholder="Ingresar Lugar Expedici&oacute;n Documento">
                        </div>
                      </div>
                </div>
            </div>

            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA SUBIR FOTO -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DOCUMENTO IDENTIDAD</div>
                        <input type="file" class="nuevaFotoDoc" name="editarFotoDoc">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarDoc" width="100px">
                        <input type="hidden" name="fotoActualDoc" id="fotoActualDoc">
                    </div>
                </div> 
            </div> 


            
            <div class="col-md-12" > 
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA LICENCIA DE CONDUCIR-->            
                    <div class="form-group"> 
                    N&uacute;mero de Licencia de Conducir:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg input_nit nits" id="editarNumeroLicenciaConducir" name="editarNumeroLicenciaConducir" value="" placeholder="Ingresar N&uacute;mero de Licencia de Conducir">
                      </div>
                    </div>
                </div>
                <div class="col-md-6" > 
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
                </div>               
            </div>



            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA SUBIR FOTO LICENCIA CONDUCIR-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO LICENCIA DE CONDUCIR</div>
                        <input type="file" class="nuevaFotoLicCond" name="editarFotoLicCond">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarLicCond" width="100px">
                        <input type="hidden" name="fotoActualLicCond" id="fotoActualLicCond">
                    </div>
                </div> 
            </div> 

            <div class="col-md-12" > 
                <div class="col-md-12" > 
                    <!-- ENTRADA PARA NIT-->            
                    <div class="form-group"> 
                    N&uacute;mero de NIT:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"    class="form-control input-lg input_nit nits" id="editarNumeroNit" name="editarNumeroNit" value="" placeholder="Ingresar N&uacute;mero de NIT">
                      </div>
                    </div>
                </div>
                <div class="col-md-12" > 
                    <!-- ENTRADA PARA SUBIR NIT -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO NIT</div>
                        <input type="file" class="nuevaFotoNIT" name="editarFotoNIT">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarNIT" width="100px">
                        <input type="hidden" name="fotoActualNIT" id="fotoActualNIT">
                    </div>
                    </div>               
                </div>
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA AFP  -->  
                    <div class="form-group">  
                      AFP:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                          <select class="form-control input-lg" name="editarAFP"  >                  
                          <option id="editarAFP"></option>
                            <?php
                              $datos_mostrar_afp = ControladorAfp::ctrMostrarAfp($item, $valor);
                              foreach ($datos_mostrar_afp as $key => $value){
                                echo '<option value="'.$value["codigo"].'">'.$value["nombre"].'</option>';                     
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA NUUP-->            
                    <div class="form-group">  
                    N&uacute;mero de NUP:            
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroNup" name="editarNumeroNup" value="" placeholder="Ingresar N&uacute;mero NUP">
                      </div>
                    </div>
                </div>               
            </div>

            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Documentaci&oacute;n complementaria</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>

            <div class="col-md-12" >                
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA PROFESION OFICIO -->            
                    <div class="form-group">  
                    Profesi&oacute;n u Oficio:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarProfesionOficio" name="editarProfesionOficio" value="" placeholder="Ingresar Profesi&oacute;n u Oficio">
                        </div>
                      </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA NACIONALIDAD -->            
                      <div class="form-group">  
                      Nacionalidad:            
                          <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text"  class="form-control input-lg" id="editarNacionalidad" name="editarNacionalidad" value="" placeholder="Ingresar Nacionalidad">
                          </div>
                      </div>
                </div>
                <div class="col-md-4" > 
                   <!-- ENTRADA PARA LUGAR NACIEMIENTO -->            
                    <div class="form-group">   
                    Lugar de Nacimiento:           
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarLugarNac" name="editarLugarNac" value="" placeholder="Ingresar Lugar de Nacimiento">
                        </div>
                      </div>
                </div>
            </div>

            


            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA FECHA NACIEMIENT -->  
                    <div class="form-group"> 
                        Fecha Nacimiento:
                        <div class="input-group">                  
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario editarfecha_nacimiento form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_nacimiento" placeholder="Ingresar Fecha" id="mascarafechanac" readonly>
                            <input type="text" class="oficial_editarfecha_nacimiento" name="editarfecha_nacimiento" style="display: none;" id="editarfecha_nacimiento">
                        </div>
                      </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA RELIGION -->            
                    <div class="form-group">    
                    Religi&oacute;n:          
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarReligion" name="editarReligion" value="" placeholder="Ingresar Religi&oacute;n">
                        </div>
                    </div>
                </div>               
            </div>

            <div class="col-md-12" > 
                <div class="col-md-6" >
                      <!-- ENTRADA PARA GRADO DE ESTUDIOS -->            
                      <div class="form-group"> 
                      Grado de Estudios:             
                          <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text"  class="form-control input-lg" id="editarGradoEstudios" name="editarGradoEstudios" value="" placeholder="Ingresar Grado de Estudios">
                          </div>
                      </div>
                </div>
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA PLANTEL-->            
                    <div class="form-group"> 
                    Plantel:             
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarPlantel" name="editarPlantel" value="" placeholder="Ingresar Plantel">
                        </div>
                    </div>
                </div>               
            </div>






            <div class="col-md-12" >                
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA PESO-->            
                      <div class="form-group">  
                      Peso:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarPeso" name="editarPeso" value="" placeholder="Ingresar Peso">
                        </div>
                      </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA NUESTATURAP-->            
                    <div class="form-group"> 
                    Estatura:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarEstatura" name="editarEstatura" value="" placeholder="Ingresar Estatura">
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA PIEL-->            
                    <div class="form-group">  
                      Color de Piel:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarPiel" name="editarPiel" value="" placeholder="Ingresar Color Piel">
                        </div>
                      </div>
                </div>
            </div>


            <div class="col-md-12" >                
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA OJOS-->            
                    <div class="form-group"> 
                    Color de Ojos:              
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarOjos" name="editarOjos" value="" placeholder="Ingresar Color Ojos">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA CABELLO-->            
                    <div class="form-group">  
                    Color de Cabello:             
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarCabello" name="editarCabello" value="" placeholder="Ingresar Color Cabello">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA CARA-->            
                    <div class="form-group"> 
                      Cara:             
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarCara" name="editarCara" value="" placeholder="Ingresar Cara">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12" > 
                <div class="col-md-6" >
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
                </div>
                
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA SENALES ESPECIALES-->            
                    <div class="form-group">  
                    Se&nacute;ales Especiales:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarSenalesEspeciales" name="editarSenalesEspeciales" value="" placeholder="Ingresar Se&nacute;ales Especiales">
                        </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
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
                </div>
                
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA NUMERO LICENCIA TDA-->            
                    <div class="form-group">
                    N&uacute;mero Licencia Tenencia de Armas:              
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumeroLicenciaTDA" name="editarNumeroLicenciaTDA" value="" placeholder="Ingresar N&uacute;mero Licencia Tenencia de Armas">
                      </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" >                
                <div class="col-md-12" >
                     <!-- ENTRADA PARA SUBIR FOTO LICENCIA LTA-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO LICENCIA TENENCIA DE ARMAS</div>
                        <input type="file" class="nuevaFotoLicLTA" name="editarFotoLicLTA">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarLicLTA" width="100px">
                        <input type="hidden" name="fotoActualLicLTA" id="fotoActualLicLTA">
                    </div>
                </div> 
            </div> 
            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Servicio militar y PNC</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>
            <div class="col-md-12" >                
                <div class="col-md-12" >
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
                </div> 
            </div>

            
            <div class="col-md-12" >                
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA FECHA INI SER MIL-->  
                    <div class="form-group"> 
                        Fecha Inicio Servicio Militar:
                        <div class="input-group">                  
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario editarfecha_inism form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_inism" placeholder="Ingresar Fecha" id="mascarafechainism" readonly>
                            <input type="text" class="oficial_editarfecha_inism" name="editarfecha_inism" style="display: none;" id="editarfecha_inism">
                        </div>
                      </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA FECHA FIN SER MIL-->  
                    <div class="form-group"> 
                        Fecha Fin Servicio Militar:
                        <div class="input-group">                  
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario editarfecha_finsm form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_finsm" placeholder="Ingresar Fecha" id="mascarafechafinsm" readonly>
                            <input type="text" class="oficial_editarfecha_finsm" name="editarfecha_finsm" style="display: none;" id="editarfecha_finsm">
                        </div>
                      </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA LUGAR SERVICIO MILITAR-->            
                    <div class="form-group"> 
                    Lugar de Servicio Militar:             
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarLugarServicioMilitar" name="editarLugarServicioMilitar" value="" placeholder="Ingresar Lugar de Servicio Militar">
                        </div>
                      </div>
                </div>
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA GRADO MILITAR-->            
                    <div class="form-group">  
                    Grado Militar:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarGradoMilitar" name="editarGradoMilitar" value="" placeholder="Ingresar Grado Militar">
                        </div>
                      </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA MOTIVO BAJA-->            
                    <div class="form-group">   
                      MOtivo Baja:           
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarMotivoBaja" name="editarMotivoBaja" value="" placeholder="Ingresar Motivo de la Baja">
                        </div>
                      </div>
                </div>               
            </div>
           
           
            <div class="col-md-12" > 
                <div class="col-md-6" >
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
                </div>
                
                <div class="col-md-6" > 
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
                </div>               
            </div>

            <div class="col-md-12" >                
                <div class="col-md-12" >
                       <!-- ENTRADA PARA SUBIR FOTO DIPLOMA ANSP-->
                      <div class="form-group">              
                          <div class="panel">SUBIR FOTO DIPLOMA ANSP</div>
                          <input type="file" class="nuevaFotoANSP" name="editarFotoANSP">
                          <p class="help-block">Peso máximo de la foto 2MB</p>
                          <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarANSP" width="100px">
                          <input type="hidden" name="fotoActualANSP" id="fotoActualANSP">
                      </div>
                    
                </div> 
            </div>
            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Datos laborales</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>
            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA TRABAJO ANTERIOR-->            
                    <div class="form-group">      
                        Nombre Trabajo Anterior:        
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoTrabajoAnterior" placeholder="Ingresar Trabajo Anterior" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUELDO QUE DEVENGO-->            
                    <div class="form-group"> 
                        Sueldo que Deveng&oacute;:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoSueldoDevengo" placeholder="Ingresar Sueldo que Deveng&oacute;" >
                        </div>
                    </div>
                </div>               
            </div>
            
            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA TELEFONO TRABAJO ANTERIOR-->            
                    <div class="form-group">  
                        N&uacute;mero de Tel&eacute;fono Trabajo Anterior:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                            <input type="text" class="form-control input-lg input_telefono_1 telefono"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="nuevoNumeroTelTrabajoAnterior" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono Trabajo Anterior" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA NOMBRE REFEREWANCIA ANTERIOR-->            
                    <div class="form-group"> 
                        Nombre Referencia Trabajo Anterior:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text"  class="form-control input-lg" name="nuevoNombreRefTrabajoAnterior" placeholder="Ingresar Nombre Referencia Trabajo Anterior" >
                        </div>
                    </div>
                </div>               
            </div>
            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA EVALUACION ANTERIOR-->            
                    <div class="form-group">        
                         Evaluaci&oacute;n Anterior:      
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoEvaluacionAnterior" placeholder="Ingresar Evaluaci&oacute;n Anterior" >
                        </div>
                    </div>
                </div> 
            </div>

            

            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA TRABAJO ACTUAL-->            
                    <div class="form-group">  
                        Nombre Trabajo Actual:          
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoTrabajoActual" placeholder="Ingresar Trabajo Actual" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUELDO QUE DEVENGA-->            
                    <div class="form-group"> 
                        Sueldo que Devenga:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoSueldoDevenga" placeholder="Ingresar Sueldo que Devenga" >
                        </div>
                    </div>
                </div>               
            </div>

            
            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA TELEFONO REFEREWANCIA ACTUAL-->            
                    <div class="form-group">  
                         Nombre Referencia Trabajo Actual:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text"   class="form-control input-lg telefono" name="nuevoNomRefTrabajoActual" placeholder="Ingresar Nombre Referencia Trabajo Actual" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                   <!-- ENTRADA PARA EVALUACION ACTUAL-->            
                   <div class="form-group">  
                        Evaluaci&oacute;n Actual:            
                        <div class="input-group">              
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoEvaluacionActual" placeholder="Ingresar Evaluaci&oacute;n Actual" >
                        </div>
                    </div>
                </div>               
            </div>
            


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA SELECCIONAR SI TIENE SUSPENDIDO TRABAJO ANTERIOR -->
                    <div class="form-group">
                        Suspendido en Trabajos Anteriores:              
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="nuevoSuspendidoAnterior" id="nuevoSuspendidoAnterior" onchange="deshabilitarOpcionesSuspension()">                  
                                <option value="">Ha sido Suspendido en Trabajos Anteriores</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EMPRESA SUSPENDIO-->            
                    <div class="form-group">   
                        Empresa que Suspendi&oacute;:           
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoEmpresaSuspendio" id="nuevoEmpresaSuspendio" placeholder="Ingresar Empresa que Suspendi&oacute;" >
                        </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA FECHA SUSPENSION --> 
                    <div class="form-group">
                        Fecha Suspensi&oacute;n:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_susp form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" id="fechasuspnew" fecha="nuevofecha_susp" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_susp" name="nuevofecha_susp" style="display: none;">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA MOTIVO SUSPENSION-->            
                    <div class="form-group">     
                        Motivo de Suspensi&oacute;n:         
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoMotivoSuspension" id="nuevoMotivoSuspension" placeholder="Ingresar Motivo de Suspensi&oacute;n" >
                        </div>
                    </div>
                </div>               
            </div>
            

            <div class="col-md-12" >                
                <div class="col-md-12" >
                     <!-- ENTRADA PARA EXPERIENCIA LABORAL-->            
                    <div class="form-group">  
                        Experiencia Laboral:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoExperienciaLaboral" placeholder="Ingresar Experiencia Laboral" >
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Im&aacute;genes de documentos e informaci&oacute; complementaria</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>


            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA RAZON POR LA CUAL DESEA TRABAJAR EN ISE-->            
                    <div class="form-group">         
                        Raz&oacute;n por la cu&aacute;l quiere trabajar en G.ISE:     
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoRazonIse" placeholder="Raz&oacute;n por la cu&aacute;l quiere trabajar en G.ISE" >
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="col-md-12" > 
                <div class="col-md-4" >
                    <!-- ENTRADA PARA NUMERO PERSONAS DEPENDIENTES-->            
                    <div class="form-group">   
                        N&uacute;mero de Personas Dependientes:           
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroPersonasDependientes" placeholder="N&uacute;mero de Personas Dependientes" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8" > 
                     <!-- ENTRADA PARA OBSERVACIONES-->            
                    <div class="form-group">      
                        Observaciones:        
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoObservaciones" placeholder="Ingresar Observaciones" >
                        </div>
                    </div>
                </div>               
            </div>

            
            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA SELECCIONAR INFO VERIFICADA -->
                    <div class="form-group">  
                        HA SIDO VERIFICADA LA INFORMACION            
                        <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <select class="form-control input-lg" name="nuevoInfoVerificada">                  
                            <option value="">HA SIDO VERIFICADA LA INFORMACION?</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                        </select>
                        </div>
                    </div>
                </div> 
            </div>
            

            
            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA SUBIR FOTO  DE LA SOLICITUD-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE LA SOLICITUD</div>
                            <input type="file" class="nuevaFotoSOLICITUD" name="nuevaFotoSOLICITUD">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarSOLICITUD" width="100px">
                        
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUBIR FOTO  PARTINA NACIMIENTO-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE LA PARTIDA DE NACIMIENTO</div>
                            <input type="file" class="nuevaFotoPARTIDA" name="nuevaFotoPARTIDA">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPARTIDA" width="100px">
                        
                    </div>
                </div>                
            </div>

            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA FECHA VENCIMIENTO AP--> 
                    <div class="form-group">
                        Fecha Vencimiento Antecedentes Penales:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_venceAP form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_venceAP" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_venceAP" name="nuevofecha_venceAP" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA SUBIR FOTO  ANTECEDENTES PENALES-->
                    <div class="form-group">              
                    <div class="panel">SUBIR FOTO DE ANTECEDENTES PENALES</div>
                    <input type="file" class="nuevaFotoANTECEDENTES" name="nuevaFotoANTECEDENTES">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarANTECEDENTES" width="100px">
                    </div>
                </div>                
            </div>
            
           
            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA FECHA VENCIMIENTO SOLV PNC--> 
                    <div class="form-group">
                        Fecha Vencimiento Solvencia PNC:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_venceSPNC form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_venceSPNC" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_venceSPNC" name="nuevofecha_venceSPNC" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUBIR FOTO  SOLVENCIA PNC-->
                    <div class="form-group">              
                    <div class="panel">SUBIR FOTO DE SOLVENCIA PNC</div>
                    <input type="file" class="nuevaFotoSOLVENCIAPNC" name="nuevaFotoSOLVENCIAPNC">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarSOLVENCIAPNC" width="100px">
                    </div>
                </div>                
            </div>
           
           

            <div class="col-md-12" >                
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA CONSTANCIA PSICOLOGICA -->
                    <div class="form-group">              
                    <div class="panel">SUBIR FOTO DE CONSTANCIA PSICOLOGICA</div>
                    <input type="file" class="nuevaFotoPSYCO" name="nuevaFotoPSYCO">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPSYCO" width="100px">
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EXAMEN POLIGRAFICO -->
                    <div class="form-group">              
                    <div class="panel">SUBIR FOTO DE EXAMEN POLIGRAFICO</div>
                    <input type="file" class="nuevaFotoPOLI" name="nuevaFotoPOLI">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPOLI" width="100px">
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA IMAGEN HUELLAS DIGITALES -->
                    <div class="form-group">              
                    <div class="panel">SUBIR FOTO DE IMAGEN HUELLAS DIGITALES</div>
                    <input type="file" class="nuevaFotoHUELLAS" name="nuevaFotoHUELLAS">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarHUELLAS" width="100px">
                    </div>
                </div>
            </div>
           
           
            
           
            <div class="col-md-12" >
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SELECCIONAR SI ES CONFIABLE -->
                    <div class="form-group">
                        Es Confiable?              
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                                <select class="form-control input-lg" name="nuevoConfiable">                  
                                    <option value="">Es Confiable?</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SELECCIONAR EL ESTADO -->
                    <div class="form-group"> 
                        Estado:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-circle"></i></span> 
                            <select class="form-control input-lg" name="nuevoEstado" required>                  
                                <option value="">Seleccionar estado</option>
                                <option value="1">Solicitud</option>
                                <option value="2">Contratado</option>
                                <option value="3">Inactivo</option>
                                <option value="4">Incapacitado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SELECCIONAR EL CARGO -->  
                    <div class="form-group"> 
                        CARGO:           
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="nuevoCARGO" id="nuevoCARGO" required>                  
                                <option value="">Seleccionar Cargo</option>
                                <?php
                                $datos_mostrar_cargo = ControladorCargos::ctrMostrar($item, $valor);
                                foreach ($datos_mostrar_cargo as $key => $value){
                                    echo '<option value="'.$value["nivel"].'">'.$value["descripcion"].'</option>';                     
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>                
            </div>
           
            
            <div class="col-md-12" >
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA PANTALON--> 
                    <div class="form-group">
                        Pantalón:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" value="" class="form-control input-lg" name="nuevopantalon_empleado" id="" placeholder="Ingresar Pantalón"  maxlength="3">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA camisa--> 
                    <div class="form-group">
                        Camisa:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" value="" class="form-control input-lg" name="nuevocamisa_empleado" id="" placeholder="Ingresar Camisa" maxlength="3">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA Zapatos--> 
                    <div class="form-group">
                        Zapatos:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" value="" class="form-control input-lg" name="nuevozapatos_empleado" id="" placeholder="Ingresar Zapatos" maxlength="3">
                        </div>
                    </div>
                </div>                
            </div>

           


            <div class="col-md-12" >
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA Recomendado por:--> 
                    <div class="form-group">
                        Recomendado por:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <select class="form-control input-lg" name="nuevorecomendado_empleado" id="" required>                  
                                <option value="">Seleccionar Recomendado</option>
                                <?php
                                    $datos_mostrar_cargo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                                    foreach ($datos_mostrar_cargo as $key => $value){
                                        echo '<option value="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"].'">'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"].'</option>';                     
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA Zapatos--> 
                    <div class="form-group">
                        Medio de contacto:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" value="" class="form-control input-lg telefono" name="nuevocontacto_empleado" id="" placeholder="Ingresar Medio de contacto">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
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
                </div>                
            </div>

           

            <div class="col-md-12" > 
                <div class="col-md-6" >
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
                </div>
                <div class="col-md-6" > 
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
            $crearEmpleado -> ctrCrearEmpleado();

            ?>

            </form>
            </div> 
        
      </div>

    </div>

  </section>

</div>


<script>
$( document ).ready(function() {
  var idEmpleadox = <?php echo $_POST["idEmpleado"]?>; 
  poblarFormulario(idEmpleadox);
});
</script> 


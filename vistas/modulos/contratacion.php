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

            

             <input type="hidden" name="idEmpleado" value="<?php echo $_POST["idEmpleado"]?>"> 

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
                          <input type="text" value="" class="calendario editarfecha_expedicion form-control input-lg" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_expedicion" placeholder="Ingresar Fecha" id="mascarafecha" readonly>
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
                          <input type="text" value="" class="calendario editarfecha_vencimiento form-control input-lg" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_vencimiento" placeholder="Ingresar Fecha" id="mascarafechav" readonly>
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
                <div class="col-md-6" >
                     <!-- ENTRADA PARA FECHA VENCIMIENTO LTA-->
                     <div class="form-group"> 
                        Fecha vencimiento de Licencia de Tenencia de Armas:
                        <div class="input-group">                  
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario editarfecha_venLTA form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_venLTA" placeholder="Ingresar Fecha" id="mascarafecha_venLTA" readonly>
                            <input type="text" class="oficial_editarfecha_venLTA" name="editarfecha_venLTA" style="display: none;" id="editarfecha_venLTA">
                        </div>
                      </div>
                </div>                 
                <div class="col-md-6" >
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
                          <input type="text"  class="form-control input-lg" id="editarTrabajoAnterior" name="editarTrabajoAnterior" value="" placeholder="Ingresar Trabajo Anterior">
                        </div>
                      </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUELDO QUE DEVENGO-->            
                    <div class="form-group">  
                    Sueldo que Deveng&oacute;:            
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarSueldoDevengo" name="editarSueldoDevengo" value="" placeholder="Ingresar Sueldo que Deveng&oacute;">
                      </div>
                    </div>
                </div>               
            </div>
            
            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA NUMERO DE TEL TRABAJO ANTERIOR-->            
                    <div class="form-group">  
                    N&uacute;mero de Tel&eacute;fono Trabajo Anterior:            
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarNumTelTrabajoAnterior" name="editarNumTelTrabajoAnterior" value="" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono Trabajo Anterior">
                      </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA NUMERO DE REF TEL TRABAJO ANTERIOR-->            
                    <div class="form-group"> 
                    Nombre de Referencia  Trabajo Anterior:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"  class="form-control input-lg" id="editarNomRefTrabajoAnterior" name="editarNomRefTrabajoAnterior" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Anterior">
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
                          <input type="text"  class="form-control input-lg" id="editarEvaluacionAnterior" name="editarEvaluacionAnterior" value="" placeholder="Ingresar Evaluaci&oacute;n Anterior">
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
                          <input type="text"  class="form-control input-lg" id="editarTrabajoActual" name="editarTrabajoActual" value="" placeholder="Ingresar Trabajo Actual">
                        </div>
                      </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUELDO QUE DEVENGa-->            
                    <div class="form-group">              
                    Sueldo que Devenga:
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarSueldoDevenga" name="editarSueldoDevenga" value="" placeholder="Ingresar Sueldo que Devenga">
                      </div>
                    </div>
                </div>               
            </div>

            
            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA NOM DE REF TEL TRABAJO ACTUAL-->            
                    <div class="form-group"> 
                    Nombre de Referencia  Trabajo Actual:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"  class="form-control input-lg" id="editarNomRefTrabajoActual" name="editarNomRefTrabajoActual" value="" placeholder="Ingresar Nombre de Referencia  Trabajo Actual">
                      </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                   <!-- ENTRADA PARA EVALUACION ACTUAL-->            
                  <div class="form-group"> 
                  Evaluaci&oacute;n Actual:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"  class="form-control input-lg" id="editarEvaluacionActual" name="editarEvaluacionActual" value="" placeholder="Ingresar Evaluaci&oacute;n Actual">
                      </div>
                    </div>
                </div>               
            </div>
            


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA SABER SI FUE SUSPENDIDO ANTERIO-->
                    <div class="form-group">
                      Ha sido Suspendido en Trabajos anteriores?              
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                        <select class="form-control input-lg" name="editarSuspendidoAnterior" >                  
                          <option value="" id="editarSuspendidoAnterior"></option>  
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>                  
                        </select>
                      </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EMPRESA SUSPENDIO-->            
                    <div class="form-group">              
                    Empresa que lo Suspendi&oacute;   
                      <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarEmpresaSuspendio" name="editarEmpresaSuspendio" value="" placeholder="Ingresar Empresa que lo Suspendi&oacute;">
                        </div>
                      </div>
                </div>               
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA FECHA SUSPENSION-->  
                    <div class="form-group"> 
                        Fecha Suspensi&oacute;n:
                        <div class="input-group">                  
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario editarfecha_susp form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_susp" placeholder="Ingresar Fecha" id="mascarafechasusp" readonly>
                            <input type="text" class="oficial_editarfecha_susp" name="editarfecha_susp" style="display: none;" id="editarfecha_susp">
                        </div>
                      </div>
                </div>
                
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA MOTIVO SUSPENSION-->            
                    <div class="form-group">  
                    Motivo Suspensi&oacute;n:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarMotivoSuspension" name="editarMotivoSuspension" value="" placeholder="Ingresar Motivo Suspensi&oacute;n">
                        </div>
                      </div>
                </div>               
            </div>
            

            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA EXPERIENCI ALABORAL-->            
                  <div class="form-group">  
                    Experiencia Laboral:            
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"  class="form-control input-lg" id="editarExperienciaLaboral" name="editarExperienciaLaboral" value="" placeholder="Ingresar Experiencia Laboral">
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
                     <!-- ENTRADA PARA RAZON ISE-->            
                    <div class="form-group">  
                    Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE:            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="text"  class="form-control input-lg" id="editarRazonIse" name="editarRazonIse" value="" placeholder="Ingresar Raz&oacute;n por qu&eacute; quiere trabajar en G. ISE">
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="col-md-12" > 
                <div class="col-md-4" >
                    <!-- ENTRADA PARA PERSONAS DEPENDIENTES-->            
                    <div class="form-group"> 
                    N&uacute;mero de Personas Dependientes:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" id="editarPersonasDependientes" name="editarPersonasDependientes" value="" placeholder="Ingresar N&uacute;mero de Personas Dependientes">
                      </div>
                    </div>
                </div>
                
                <div class="col-md-8" > 
                    <!-- ENTRADA PARA OBSERVACIONES-->            
                  <div class="form-group"> 
                    Observaciones:             
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                        <input type="text"  class="form-control input-lg" id="editarObservaciones" name="editarObservaciones" value="" placeholder="Ingresar Observaciones">
                      </div>
                    </div>
                </div>               
            </div>

            
            <div class="col-md-12" >                
                <div class="col-md-12" >
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
                </div> 
            </div>
            

            
            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA SUBIR DE SOLICITUD-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE SOLICITUD</div>
                        <input type="file" class="nuevaFotoSOLICITUD" name="editarFotoSOLICITUD">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarSOLICITUD" width="100px">
                        <input type="hidden" name="fotoActualSOLICITUD" id="fotoActualSOLICITUD">
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUBIR FOTO  PARTIDA NACIMIENTO-->                    
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE PARTIDA DE NACIMIENTO</div>
                        <input type="file" class="nuevaFotoPARTIDA" name="editarFotoPARTIDA">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPARTIDA" width="100px">
                        <input type="hidden" name="fotoActualPARTIDA" id="fotoActualPARTIDA">
                    </div>
                </div>                
            </div>

            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA FECHA VENC AP-->  
                    <div class="form-group"> 
                        Fecha Vencimiento Antecedentes Penales:
                        <div class="input-group">                  
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario editarfecha_venceAP form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_venceAP" placeholder="Ingresar Fecha" id="mascarafechavenceAP" readonly>
                            <input type="text" class="oficial_editarfecha_venceAP" name="editarfecha_venceAP" style="display: none;" id="editarfecha_venceAP">
                        </div>
                      </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUBIR FOTO DE ANTECEDENTES PENALES-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE ANTECEDENTES PENALES</div>
                        <input type="file" class="nuevaFotoANTECEDENTES" name="editarFotoANTECEDENTES">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarANTECEDENTES" width="100px">
                        <input type="hidden" name="fotoActualANTECEDENTES" id="fotoActualANTECEDENTES">
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
                            <input type="text" value="" class="calendario editarfecha_venceSPNC form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_venceSPNC" placeholder="Ingresar Fecha" id="mascarafechavenceSPNC" readonly>
                            <input type="text" class="oficial_editarfecha_venceSPNC" name="editarfecha_venceSPNC" style="display: none;" id="editarfecha_venceSPNC">
                        </div>
                      </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SUBIR SOLVENCIA PNC -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE SOLVENCIA PNC</div>
                        <input type="file" class="nuevaFotoSOLVENCIAPNC" name="editarFotoSOLVENCIAPNC">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarSOLVENCIAPNC" width="100px">
                        <input type="hidden" name="fotoActualSOLVENCIAPNC" id="fotoActualSOLVENCIAPNC">
                    </div>
                </div>                
            </div>
           
           

            <div class="col-md-12" >                
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA SUBIR CONSTANCIA PSYCOLOGICA -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE CONSTANCIA PSICOLOGICA</div>
                        <input type="file" class="nuevaFotoPSYCO" name="editarFotoPSYCO">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPSYCO" width="100px">
                        <input type="hidden" name="fotoActualPSYCO" id="fotoActualPSYCO">
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SUBIR EXAMEN POLIGRAFICO -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE EXAMEN POLIGRAFICO</div>
                        <input type="file" class="nuevaFotoPOLI" name="editarFotoPOLI">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarPOLI" width="100px">
                        <input type="hidden" name="fotoActualPOLI" id="fotoActualPOLI">
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SUBIR HUELLAS DIGITALES -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DE HUELLAS DIGITALES</div>
                        <input type="file" class="nuevaFotoHUELLAS" name="editarFotoHUELLAS">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarHUELLAS" width="100px">
                        <input type="hidden" name="fotoActualHUELLAS" id="fotoActualHUELLAS">
                    </div>
                </div>
            </div>
           
           
            
           
            <div class="col-md-12" >
                <div class="col-md-4" > 
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
                </div>
                <div class="col-md-4" > 
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
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SELECCIONAR CARGO -->
                    <div class="form-group">  
                    CARGO:            
                      <div class="input-group">              
                        <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                        <select class="form-control input-lg editarCARGO" name="editarCARGO"   >
                          <option id="editarCARGO"></option>
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
                          <input type="text" value="" class="form-control input-lg" name="editarpantalon_empleado" id="editarpantalon_empleado" placeholder="Ingresar Pantalón"  maxlength="3">
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA camisa--> 
                    <div class="form-group">
                    Camisa:
                      <div class="input-group">           
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" value="" class="form-control input-lg" name="editarcamisa_empleado" id="editarcamisa_empleado" placeholder="Ingresar Camisa" maxlength="3">
                      </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA Zapatos--> 
                    <div class="form-group">
                    Zapatos:
                      <div class="input-group">           
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" value="" class="form-control input-lg" name="editarzapatos_empleado" id="editarzapatos_empleado" placeholder="Ingresar Zapatos" maxlength="3">
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
                          <select class="form-control input-lg" name="editarrecomendado_empleado" id="editarrecomendado_empleado" required>                  
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
                    <!-- ENTRADA PARA medio de contacto--> 
                    <div class="form-group">
                    Medio de contacto:
                      <div class="input-group">           
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" value="" class="form-control input-lg telefono" name="editarcontacto_empleado" id="editarcontacto_empleado" placeholder="Ingresar Medio de contacto">
                      </div>
                    </div>
                </div>
                <div class="col-md-4" >
                  <!-- ENTRADA PARA documentacion completa-->
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

                </div>                
            </div>

           

            <div class="col-md-12" > 
                <div class="col-md-6" >
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
                </div>
                <div class="col-md-6" > 
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
                </div>                
            </div>

            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #2b2468;">Datos de contrataci&oacute;n</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>

            <div class="col-md-12" > 
                <div class="col-md-4" >
                  <div class="form-group">
                       <!-- ENTRADA PARA FECHA DE INGRESO-->  
                      <div class="form-group"> 
                          Fecha de ingreso:
                          <div class="input-group">                  
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              <input type="text" value="" class="calendario editarfecha_ingreso form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_ingreso" placeholder="Ingresar Fecha" id="mascarafechaingreso" readonly>
                              <input type="text" class="oficial_editarfecha_ingreso" name="editarfecha_ingreso" style="display: none;" id="editarfecha_ingreso">
                          </div>
                        </div>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                     <!-- ENTRADA PARA FECHA DE CONTRATACION-->  
                     <div class="form-group"> 
                          Fecha de contrataci&oacute;n:
                          <div class="input-group">                  
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              <input type="text" value="" class="calendario editarfecha_contratacion form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_contratacion" placeholder="Ingresar Fecha" id="mascarafechacontratacion" readonly>
                              <input type="text" class="oficial_editarfecha_contratacion" name="editarfecha_contratacion" style="display: none;" id="editarfecha_contratacion">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA SELECCIONAR DEPARTAMENTO DE EMPRESA -->
                      <div class="form-group">  
                        Departamento :            
                        <div class="input-group">              
                          <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                          <select class="form-control input-lg" name="editarDepartamentoEmpresa"  >                  
                          <option id="editarDepartamentoEmpresa"></option>
                            <?php
                              $datos_mostrar_departamento = ControladorDepartamentos::ctrMostrarDepartamentos($item, $valor);
                              foreach ($datos_mostrar_departamento as $key => $value){
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';                     
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                </div>                
            </div>

            <div class="col-md-12" > 
                <div class="col-md-4" >
                  <div class="form-group">
                       <!-- ENTRADA PARA PERIODO DE PAGO--> 
                       Per&iacute;odo de pago: 
                        <select class="form-control input-lg" name="editarPeriodoPago"  >                  
                          <option value="" id="editarPeriodoPago"></option>
                          <option value="Quincenal">Quincenal</option>
                          <option value="Mensual">Mensual</option>
                        </select>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                        <!-- ENTRADA PARA HORAS NORMALES-->  
                        <div class="form-group"> 
                          Horas normales de trabajo:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01" class="form-control input-lg " name="editar_horas_normales_trabajo" id="editar_horas_normales_trabajo" placeholder="Ingresar horas">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >                    
                    <div class="form-group">  
                       <!-- ENTRADA PARA SUELDO --> 
                        <div class="form-group"> 
                          Sueldo:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01"  class="form-control input-lg " name="editar_sueldo" id="editar_sueldo" placeholder="Ingresar sueldo">
                          </div>
                        </div>
                    </div>
                      
                </div>                
            </div>

            <div class="col-md-12" > 
                <div class="col-md-4" >
                  <div class="form-group">
                       <!-- ENTRADA PARA SUELDO DIARIO-->                         
                       <div class="form-group"> 
                          Sueldo diario:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01" class="form-control input-lg " name="editar_sueldo_diario" id="editar_sueldo_diario" placeholder="Ingresar sueldo diario">
                          </div>
                        </div>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                        <!-- ENTRADA PARA SALARIO x HORA-->  
                        <div class="form-group"> 
                          Salario por hora:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01" class="form-control input-lg " name="editar_salario_por_hora" id="editar_salario_por_hora" placeholder="Ingresar salario por hora">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >                    
                    <div class="form-group">  
                       <!-- ENTRADA PARA HX diurna --> 
                        <div class="form-group"> 
                          Hora extra diurna:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01"  class="form-control input-lg " name="editar_hora_extra_diurna" id="editar_hora_extra_diurna" placeholder="Ingresar hora extra diurna">
                          </div>
                        </div>
                    </div>                      
                </div>                
            </div>

            <div class="col-md-12" > 
                <div class="col-md-4" >
                  <div class="form-group">
                       <!-- ENTRADA PARA HX NOCTURNA-->                         
                       <div class="form-group"> 
                          Hora extra nocturna:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01" class="form-control input-lg " name="editar_hora_extra_nocturna" id="editar_hora_extra_nocturna" placeholder="Ingresar hora extra nocturna">
                          </div>
                        </div>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                        <!-- ENTRADA PARA HX DOMINGO-->  
                        <div class="form-group"> 
                          Hora extra domingo:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01" class="form-control input-lg " name="editar_hora_extra_domingo" id="editar_hora_extra_domingo" placeholder="Ingresar hora extra domingo">
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >                    
                    <div class="form-group">  
                       <!-- ENTRADA PARA HX NOCTURNA DOMINGO --> 
                        <div class="form-group"> 
                          Hora extra nocturna domingo:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="number"  min="0.01" step="0.01"  class="form-control input-lg " name="editar_hora_extra_nocturna_domingo" id="editar_hora_extra_nocturna_domingo" placeholder="Ingresar hora extra nocturna domingo">
                          </div>
                        </div>
                    </div>                      
                </div>                
            </div>




            <div class="col-md-12" > 
                <div class="col-md-4" >
                  <div class="form-group">
                       <!-- ENTRADA PARA TIPO PORTACION ARMA-->                         
                       <div class="form-group"> 
                          Tipo de portaci&oacute;n de armas:
                          <select class="form-control input-lg" name="editarTipoPortacionArmas"  >                  
                          <option id="editarTipoPortacionArmas"></option>
                            <?php
                              $datos_mostrar_tipo_portacion_arma = Controladorportacionarma::ctrMostrar($item, $valor);
                              foreach ($datos_mostrar_tipo_portacion_arma as $key => $value){
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';                     
                              }
                            ?>
                          </select>
                        </div>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                        <!-- ENTRADA PARA DESCONTAR ISSS -->                        
                        Descontar ISSS: 
                        <select class="form-control input-lg" name="editar_descontar_isss"  >                  
                          <option value="" id="editar_descontar_isss"></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" >                    
                    <div class="form-group">
                        <!-- ENTRADA PARA DESCONTAR AFP -->                        
                        Descontar AFP: 
                        <select class="form-control input-lg" name="editar_descontar_afp"  >                  
                          <option value="" id="editar_descontar_afp"></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                    </div>                      
                </div>                
            </div>
            


            <div class="col-md-12" > 
                <div class="col-md-4" >
                  <div class="form-group">
                       <!-- ENTRADA PARA TIPO PLANILLA-->                         
                       <div class="form-group"> 
                          Tipo de planilla:
                          <select class="form-control input-lg" name="editarTipoPlanilla"  >                  
                          <option id="editarTipoPlanilla"></option>
                            <?php
                              $datos_mostrar_tipo_planilla = Controladorplantillas::ctrMostrar($item, $valor);
                              foreach ($datos_mostrar_tipo_planilla as $key => $value){
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';                     
                              }
                            ?>
                          </select>
                        </div>
                  </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                        <!-- ENTRADA PARA BANCO-->                         
                       <div class="form-group"> 
                          Banco:
                          <select class="form-control input-lg" name="editarBanco"  >                  
                          <option id="editarBanco"></option>
                            <?php
                              $datos_mostrar_banco = ControladorBancos::ctrMostrarBancos($item, $valor);
                              foreach ($datos_mostrar_banco as $key => $value){
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';                     
                              }
                            ?>
                          </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" >                    
                    <div class="form-group">
                       <!-- ENTRADA PARA NUMERO CUENTA BANCO--> 
                       <div class="form-group"> 
                          N&uacute;mero de cuenta:
                          <div class="input-group">           
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="text"   class="form-control input-lg " name="editar_numero_cuenta" id="editar_numero_cuenta" placeholder="Ingresar N. cuenta banco">
                          </div>
                        </div>
                    </div>                      
                </div>                
            </div>

            <div class="col-md-12" >
              <div class="col-md-4" id="divJOP" > 
                  <!-- ENTRADA PARA JEFE OPERQACIONES A CARGO--> 
                  <div class="form-group" >
                    Jefe operaciones:
                      <div class="input-group">           
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <select class="form-control input-lg" name="editarjefe_empleado"  >                  
                            <option id="editarjefe_empleado"></option>

                            <?php
                              $datos_mostrar_cargo = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);
                              foreach ($datos_mostrar_cargo as $key => $value){                                 
                                echo '<option value="'.$value["id"].'">'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"].'</option>';                     
                              }
                          ?>
                          </select>
                      </div>
                    </div>  
                </div>              
                <div class="col-md-4" >
                    <!-- ENTRADA PARA IMAGEN CONTRATO-->
                    <div class="form-group">              
                        <div class="panel">SUBIR IMAGEN DE CONTRATO</div>
                        <input type="file" class="nuevaFotoContra" name="editarFotoContra">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEditarContra" width="100px">
                        <input type="hidden" name="fotoActualContra" id="fotoActualContra">
                    </div>
                </div> 
            </div>
            
            

            <div class="col-md-12" > 
                <div class="col-md-4" >
                    <div class="form-group">
                        <!-- ENTRADA PARA ANTICIPO -->                        
                        Anticipo: 
                        <select class="form-control input-lg" name="editar_anticipo"  >                  
                          <option value="" id="editar_anticipo"></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <div class="form-group">
                        <!-- ENTRADA PARA REPORTADO A LA JURA -->                        
                        Reportado a PNC: 
                        <select class="form-control input-lg" name="editar_reportado_a_pnc"  >                  
                          <option value="" id="editar_reportado_a_pnc"></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" >                    
                    <div class="form-group">
                        <!-- ENTRADA PARA TIPO EMPLEADO -->                        
                        Tipo empleado: 
                        <select class="form-control input-lg" name="editar_tipo_empleado"  >                  
                          <option value="" id="editar_tipo_empleado"></option>
                          <option value="Administrativo">Administrativo</option>
                          <option value="Operativo">Operativo</option>
                        </select>
                    </div>                      
                </div>                
            </div>
            <div class="col-md-12" >                
                <div class="col-md-6" >
                    <!-- ENTRADA PARA SELECCIONAR CONSTANCIA PSICOLOGICA-->         
                    <div class="form-group">  
                        Tiene constancia psicol&oacute;gica?:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="editarConstanciaPS"  >                  
                              <option value="" id="editarConstanciaPS" ></option>
                              <option value="SI">SI</option>
                              <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div> 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA NOMBRE PSICOLOGO--> 
                    <div class="form-group"> 
                      Nombre del Psic&oacute;logo:
                      <div class="input-group">           
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text"   class="form-control input-lg " name="editar_nombre_psicologo" id="editar_nombre_psicologo" placeholder="Ingresar Nombre psicologo" readonly>
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

  </section>

</div>


<script>
$( document ).ready(function() {
  var idEmpleadox = <?php echo $_POST["idEmpleado"]?>; 
  poblarFormulario(idEmpleadox);
});
</script> 


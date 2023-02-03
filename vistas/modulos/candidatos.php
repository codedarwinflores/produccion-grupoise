<?php


if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
//require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");
//require($_SERVER['DOCUMENT_ROOT']."/armoni/git/modelos/conexion2.php");
require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php");


?>

<div class="content-wrapper">

        <section class="content">

        

        <div class="box-header with-border">
        <section class="content-header">    
        <h1>      
        Empleados     
        <small>Agregar Candidatos</small>    
        </h1>
        <ol class="breadcrumb">      
        <li><a href="empleados"><i class="fa fa fa-drivers-license-o"></i> Empleados</a></li>      
        <li class="active" > <a href="empleados"> Volver </a></li>    
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
                    <div class="panel">SUBIR FOTO </div>
                        <input type="file" class="nuevaFotoEmp" name="nuevaFotoEmp">
                        <p class="help-block">Peso máximo de la foto 2MB</p>
                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                </div>
            </div>
            
            
            
            <div class="col-md-12" > 
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL PRIMER NOMBRE -->            
                    <div class="form-group">
                        Primer Nombre:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg nombre1" name="nuevoNombre" placeholder="Ingresar Primer Nombre" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL SEGUNDO  NOMBRE -->            
                    <div class="form-group">
                        Segundo Nombre:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg nombre2" name="nuevoSegundoNombre" placeholder="Ingresar Segundo Nombre" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL TERCER  NOMBRE -->            
                    <div class="form-group">
                        Tercer Nombre:
                        <div class="input-group">
                             <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg nombre3" name="nuevoTercerNombre" placeholder="Ingresar Tercer Nombre" >
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
                            <input type="text" class="form-control input-lg apellido1" name="nuevoPrimerApellido" placeholder="Ingresar Primer Apellido" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL SEGUNDO APELLIDO -->            
                    <div class="form-group">
                        Segundo Apellido:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg apellido2" name="nuevoSegundoApellido" placeholder="Ingresar Segundo Apellido" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL APELLIDO DE CASADA -->            
                    <div class="form-group">
                        Apellido Casada:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control input-lg " name="nuevoApellidoCasada" placeholder="Ingresar Apellido Casada" >
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="col-md-12" > 
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL ESTADO CIVIL -->
                    <div class="form-group">
                        Estado Civil:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
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
                </div>
                <div class="col-md-6" > 
                     <!-- ENTRADA PARA EL SEXO -->
                    <div class="form-group">
                        Sexo:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="nuevoSexo">                        
                                <option value="">Seleccionar Sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>                        
                            </select>
                        </div>
                    </div>
                </div>               
            </div>

            <div class="col-md-12" > 
                <div class="col-md-12" > 
                    <!-- ENTRADA PARA LA DIRECCION DE RESIDENCIA-->            
                    <div class="form-group">
                        Direcci&oacute;n Residencia:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar Direcci&oacute;n" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12" > 
                <div class="col-md-4" > 
                    <!-- ***DEPARTAMENTO -->                    
                    <div class="form-group"> 
                        Departamento:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
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
                </div>
                <div class="col-md-4" > 
                    <!-- ***MUNICIPIO -->                    
                    <div class="form-group"> 
                        Municipio:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
                            <select class="form-control input-lg" name="nuevoMunicipio" id="nuevoMunicipio" >                  
                                <option value="">Seleccionar Municipio</option>                        
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA EL TELEFONO -->            
                    <div class="form-group">  
                        Tel&eacute;fono:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 
                            <input type="text"   class="form-control input-lg input_telefono_1 telefono" name="nuevoTelefono" placeholder="Ingresar N&uacute;mero de Tel&eacute;fono" >
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
                     <!-- ENTRADA PARA EL numero ISSS -->            
                    <div class="form-group"> 
                        N&uacute;mero ISSS:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroIsss" placeholder="Ingresar N&uacute;mero de ISSS" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL nombre segun  ISSS -->            
                    <div class="form-group">  
                        Nombre Seg&uacute;n ISSS:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoNombreIsss" placeholder="Ingresar Nombre seg&uacute;n ISSS" >
                        </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL DOCUMENTO -->
                    <div class="form-group">
                        Tipo Documento:
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa fa-drivers-license-o"></i></span> 
                            <select class="form-control input-lg" name="nuevoTipoDocumento" required>                        
                                <option value="">Seleccionar tipo de documento</option>
                                <option value="DUI">DUI</option>
                                <option value="Pasaporte">Pasaporte</option>
                                <option value="Carnet residente">Carnet residente</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA EL NUMERO DOCUMENTO IDENTIDAD -->
                    <div class="form-group">
                        N&uacute;mero Documento 
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span> 
                            <input type="text" class="form-control input-lg input_dui duis numerodui"  nombres="" apellido1="" apellido2="" name="nuevoNumeroDocumento" id="nuevoNumeroDocumento" placeholder="Ingresar n&uacute;mero documento identidad" required>
                        </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" >                
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA FECHA DE  expedicion documento   --> 
                    <div class="form-group">
                        Fecha Expedici&oacute;n Documento:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_expedicion form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_expedicion" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_expedicion" name="nuevofecha_expedicion" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA FECHA DE  vencimiento documento   --> 
                    <div class="form-group">
                        Fecha Vencimiento Documento:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_vencimiento form-control input-lg" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_vencimiento" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_vencimiento" name="nuevofecha_vencimiento" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA EL lugar expedicion documento   -->            
                    <div class="form-group">
                        Lugar expedici&oacute;n Documento:              
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoLugarExpedicionDoc" placeholder="Lugar expedicion del documento" >
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA SUBIR FOTO DOCUMENTO -->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO DOCUMENTO IDENTIDAD</div>
                            <input type="file" class="nuevaFotoDoc" name="nuevaFotoDoc">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarDoc" width="100px">
                        
                    </div>
                </div> 
            </div> 


            
            <div class="col-md-12" > 
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA licencia de conducir  -->            
                    <div class="form-group"> 
                        N&uacute;mero Licencia Conducir:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-drivers-license"></i></span> 
                            <input type="text" class="form-control input-lg input_nit nits"  name="nuevoLicenciaConducir" placeholder="Ingresar N&uacute;mero de Licencia Conducir" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SELECCIONAR TIPO DE LICENCIA DE CONDUCIR -->
                    <div class="form-group">
                        Tipo Licencia Conducir:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-drivers-license"></i></span> 
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
                </div>               
            </div>



            <div class="col-md-12" >                
                <div class="col-md-12 ocultartodo" >
                    <!-- ENTRADA PARA SUBIR FOTO  DE LICENCIA-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO LICENCIA DE CONDUCIR</div>
                            <input type="file" class="nuevaFotoLicCond" name="nuevaFotoLicCond">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarLicCond" width="100px">
                                    
                    </div> 
                </div> 
            </div> 

            <div class="col-md-12" > 
                <div class="col-md-12" > 
                    <!-- ENTRADA PARA NIT  -->            
                    <div class="form-group">  
                        N&uacute;mero NIT:              
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-drivers-license-o"></i></span> 
                            <input type="text"    class="form-control input-lg input_nit nits" name="nuevoNumeroNIT" placeholder="Ingresar N&uacute;mero de NIT" >
                        </div>
                    </div>
                </div>
                <div class="col-md-12" > 
                    <!-- ENTRADA PARA SUBIR FOTO NIT-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO NIT</div>
                            <input type="file" class="nuevaFotoNIT" name="nuevaFotoNIT">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarNIT" width="100px">
                        
                    </div>               
                </div>
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA AFP  -->  
                    <div class="form-group"> 
                        AFP:           
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="nuevoAFP" id="nuevoAFP" >                  
                                <option value="">Seleccionar AFP</option>
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
                    <!-- ENTRADA PARA NUP  -->            
                    <div class="form-group"> 
                        N&uacute;mero NUP:              
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoNumeroNUP" placeholder="Ingresar N&uacute;mero NUP" >
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
                    <!-- ENTRADA PARA PROFESION OFICIO  -->            
                    <div class="form-group"> 
                        Profesi&oacute;n u Oficio             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoProfesionOficio" placeholder="Ingresar Profesi&oacute;n u Oficio" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA NACIONALIDAD  -->            
                    <div class="form-group">    
                        Nacionalidad:          
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoNacionalidad" placeholder="Ingresar Nacionalidad" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA LUGAR NACIEMIENTO -->            
                    <div class="form-group"> 
                         Lugar de Nacimiento:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoLugarNacimiento" placeholder="Ingresar Lugar de Nacimiento" >
                        </div>
                    </div>
                </div>
            </div>

            


            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA FECHA DE  NACIMIENTO  --> 
                    <div class="form-group">
                        Fecha Nacimiento:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_nacimiento form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_nacimiento" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_nacimiento" name="nuevofecha_nacimiento" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA RELIGION -->            
                    <div class="form-group"> 
                        Religi&oacute;n:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoReligion" placeholder="Ingresar Religi&oacute;n" >
                        </div>
                    </div>
                </div>               
            </div>

            <div class="col-md-12" > 
                <div class="col-md-6" >
                    <!-- ENTRADA PARA GRADO ESTUDIO -->            
                    <div class="form-group">  
                        Grado de Estudios:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoGradoEstudio" placeholder="Ingresar Grado de Estudios" >
                        </div>
                </div>
                </div>
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA PLANTEL -->            
                    <div class="form-group"> 
                        Plantel:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoPlantel" placeholder="Ingresar Plantel" >
                        </div>
                    </div>
                </div>               
            </div>






            <div class="col-md-12" >                
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA PESO -->            
                    <div class="form-group"> 
                        Peso:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span> 
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control input-lg" name="nuevoPeso" placeholder="Ingresar Peso" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA ESTATURA -->            
                    <div class="form-group"> 
                        Estatura:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span> 
                            <input type="text"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"class="form-control input-lg" name="nuevoEstatura" placeholder="Ingresar Estatura" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA PIEL -->            
                    <div class="form-group">  
                        Color de Piel:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoPiel" placeholder="Ingresar Color de Piel" >
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12" >                
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA OJOS -->            
                    <div class="form-group">
                        Color de Ojos:               
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-eye"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoOjos" placeholder="Ingresar Color de Ojos" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA CABELLO -->            
                    <div class="form-group">
                        Color de Cabello:               
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoCabello" placeholder="Ingresar Color Cabello" >
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA CARA -->            
                    <div class="form-group"> 
                        Cara:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoCara" placeholder="Ingresar Cara" >
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
                            <span class="input-group-addon"><i class="fa fa-heartbeat"></i></span> 
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
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA CARSENALES ESPECIALES -->            
                    <div class="form-group">     
                        Se&nacute;ales Especiales:         
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoSenalesEspeciales" placeholder="Ingresar Se&nacute;ales Especiales" >
                        </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA SELECCIONAR SI TIENE LICENCIA D EARMAS-->          
                    <div class="form-group"> 
                        Licencia de Tenencia de Armas:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span> 
                            <select class="form-control input-lg" name="nuevoLicenciaTDA">                  
                                <option value="">Tiene Licencia de Tenencia de Armas</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA NUMERO LICENCIA TENENCIA ARMA -->            
                    <div class="form-group">
                        N&uacute;mero Licencia de Tenencia de Armas:              
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-address-card"></i></span> 
                        <input type="text" class="form-control input-lg" name="nuevoNumeroLicenciaTDA" placeholder="Ingresar N&uacute;mero Licencia de Tenencia de Armas" >
                        </div>
                    </div>
                </div>               
            </div>


            <div class="col-md-12" >
                <div class="col-md-4" >
                    <!-- FECHA VENCIMIENTO LTA-->
                    <div class="form-group">
                        Fecha vencimiento de Licencia de Tenencia de Armas:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_venLTA form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_venLTA" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_venLTA" name="nuevofecha_nuevofecha_venLTA" style="display: none;">
                        </div>
                    </div>
                </div>                 
                <div class="col-md-8" >
                    <!-- ENTRADA PARA SUBIR FOTO  DE TENENCIA ARMAS-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO LICENCIA  TENENCIA DE ARMAS</div>
                            <input type="file" class="nuevaFotoLicLTA" name="nuevaFotoLicLTA">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarLicLTA" width="100px">
                    </div>
                </div> 
            </div> 
            <div class="col-md-12" >
                <label style="font-size: xx-large;color: #f7af10;">Servicio militar y PNC</label> 
                <hr style="margin-top: 0px;border-top: 1px solid #101010;"></hr>
            </div>
            <div class="col-md-12" >                
                <div class="col-md-12" >
                    <!-- ENTRADA PARA SELECCIONAR SI HIZO SERVICIOMILITAR-->         
                    <div class="form-group">  
                        Servicio Militar:            
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="nuevoServicioMilitar">                  
                                <option value="">Hizo Servicio Militar</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div> 
            </div>

            
            <div class="col-md-12" >                
                <div class="col-md-4" > 
                     <!-- ENTRADA PARA FECHA INICIO SERV MIL  --> 
                    <div class="form-group">
                        Fecha Inicio Servicio Militar:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_inism form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_inism" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_inism" name="nuevofecha_inism" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA FIN SERV MIML  --> 
                    <div class="form-group">
                        Fecha Fin Servicio Militar:
                        <div class="input-group">           
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" value="" class="calendario nuevofecha_finsm form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_finsm" placeholder="Ingresar Fecha" readonly>
                            <input type="text" class="oficial_nuevofecha_finsm" name="nuevofecha_finsm" style="display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-md-4" > 
                    <!-- ENTRADA PARA LUGAR SEV MIL -->            
                    <div class="form-group"> 
                        Lugar Servicio Militar:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-map"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoLugarServicioMilitar" placeholder="Ingresar Lugar Servicio Militar" >
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA GRADO MILITAR -->            
                    <div class="form-group"> 
                        Grado Militar:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoGradoMilitar" placeholder="Ingresar Grado Militar" >
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA MOTIVO BAJA -->            
                    <div class="form-group">   
                        Motivo de la Baja:           
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="form-control input-lg" name="nuevoMotivoBaja" placeholder="Ingresar Motivo de la Baja" >
                        </div>
                    </div>
                </div>               
            </div>
           
           
            <div class="col-md-12" > 
                <div class="col-md-6" >
                     <!-- ENTRADA PARA SELECCIONAR SI ES EX PNC -->
                    <div class="form-group"> 
                        Ex-PNC:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg" name="nuevoExPnc">                  
                                <option value="">Es Ex-PNC</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" > 
                    <!-- ENTRADA PARA SELECCIONAR SI TIENE Aprobó curso ANSP -->
                    <div class="form-group"> 
                        Aprobó curso ANSP:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <select class="form-control input-lg nuevoCursoANSP" name="nuevoCursoANSP">                  
                                <option value=""> Aprobó curso ANSP</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div>     
                
                
              <!--   <div class="col-md-6" > 
                   
                    <div class="form-group nuevofecha_curso_ansp" style="display: none;"> 
                        Fecha en la que aprobó curso ANSP:             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                            <input type="text" value="" class="calendario nuevofecha_curso_ansp form-control input-lg" data-lang="es" data-years="1940-2035" data-format="DD-MM-YYYY" name="nuevofecha_curso_ansp" fecha="nuevofecha_curso_ansp" placeholder="Ingresar Fecha" readonly="">
                        </div>
                    </div>
                </div>    
                
                <div class="col-md-6">
                 <div class="form-group nuevofecha_curso_ansp" style="display: none;"> 
                        Número de Aprobación :             
                        <div class="input-group">              
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                            <input type="text" class="solonumero nuevonumero_aprobacion_ansp  form-control input-lg"  name="nuevonumero_aprobacion_ansp"  maxlength="20" placeholder="Ingresar Número de Aprobación">
                        </div>
                    </div>

                </div>
 -->

            </div>



            <div class="col-md-12" >                
                <div class="col-md-12" >
                     <!-- ENTRADA PARA SUBIR FOTO  DE DIPLOMA ANSP-->
                    <div class="form-group">              
                        <div class="panel">SUBIR FOTO PARA DIPLOMA ANSP</div>
                            <input type="file" class="nuevaFotoANSP" name="nuevaFotoANSP">
                            <p class="help-block">Peso máximo de la foto 2MB</p>
                            <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarANSP" width="100px">
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
                <div class="col-md-6 ocultartodo" > 
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
                
                <!-- <div class="col-md-12" bis_skin_checked="1">           
                        <div class="form-group" bis_skin_checked="1">   
                            Tiene Antecedentes policiales:           
                            <div class="input-group" bis_skin_checked="1">              
                                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                                <select class="form-control input-lg nuevoantecedente_policial" name="nuevoantecedente_policial" id="">
                                    <option value="">Tiene Antecedentes policiales</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>

                            </div>
                        </div>
                    </div>
 -->
           
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

           <!--  <div class="col-md-12">
                
                    <div class="col-md-6" bis_skin_checked="1">           
                        <div class="form-group" bis_skin_checked="1">   
                            Constancia Psicológica:           
                            <div class="input-group" bis_skin_checked="1">              
                                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                                <select class="form-control input-lg nuevoconstancia_psicologica" name="nuevoconstancia_psicologica" id="">
                                    <option value="">Constancia Psicológica</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>

                            </div>
                        </div>
                    </div>
                                     
                    
                <div class="col-md-6" >     
                    <div class="form-group">
                        <div class="">Nombre del Psicologo</div>
                        <div class="">
                            <select id="editarcargo"  class="form-control  input-lg nuevonombre_psicologo" name="nuevonombre_psicologo" id="" style="display: none;">
                                    <option value="vacio">Seleccione el Nombre del Psicologo</option>
                                    <?php
                                    function getcargo() {
                                    $query = "SELECT * FROM configuracion ";
                                    $sql = Conexion::conectar()->prepare($query);
                                    $sql->execute();			
                                    return $sql->fetchAll();
                                    };
                                    
                                    $data = getcargo();
                                    foreach($data as $row) {
                                    echo "<option value='".$row["psicologo"]."' >".$row["psicologo"]."</option>";
                                    }
                                    ?>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            -->

           <!--  <div class="col-md-12">

                    <div class="col-md-6" bis_skin_checked="1">           
                        <div class="form-group" bis_skin_checked="1">   
                            Tiene examen poligráfico:           
                            <div class="input-group" bis_skin_checked="1">              
                                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                                <select class="form-control input-lg nuevoexamen_poligrafico" name="nuevoexamen_poligrafico" id="">
                                    <option value="">Tiene examen poligráfico</option>
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

                                <input type="text" class="form-control input-lg calendario nuevoFecha_poligrafico" name="nuevoFecha_poligrafico" readonly="readonly" style="display: none;">
                              

                            </div>
                        </div>
                    </div>

            </div>
            -->

            <div class="col-md-12" >                
                <div class="col-md-4 ocultartodo" > 
                    <!-- ENTRADA PARA CONSTANCIA PSICOLOGICA -->
                    <div class="form-group">              
                    <div class="panel">SUBIR FOTO DE CONSTANCIA PSICOLOGICA</div>
                    <input type="file" class="nuevaFotoPSYCO" name="nuevaFotoPSYCO">
                    <p class="help-block">Peso máximo de la foto 2MB</p>
                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarPSYCO" width="100px">
                    </div>
                </div>
                <div class="col-md-4 ocultartodo" > 
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
                            <select class="form-control input-lg" name="nuevoCARGO" id="nuevoCARGO" >                  
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
                            <select class="form-control input-lg" name="nuevorecomendado_empleado" id="" >                  
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
                            <select class="form-control input-lg" name="nuevodocumentacion_empleado" id="" >                  
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
                            <select class="form-control input-lg" name="nuevoansp_empleado" id="">                  
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
                            <select class="form-control input-lg" name="nuevouniformeregalado_empleado" id="" >                  
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

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal"> <a href="empleados"> Salir</a></button>

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





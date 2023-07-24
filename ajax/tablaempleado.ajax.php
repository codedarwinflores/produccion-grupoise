<?php 
require_once "../modelos/conexion.php";

$patrulla = $_POST['patrulla'] ;
$ubicacion= $_POST['ubicacion']; 

if(empty($patrulla) && empty($ubicacion))
{
   
             
    function empleado() {
        global $nombretabla_sim;
        $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`,  tbl_frm_visita_jefe_operaciones.id as idjefe, `fecha_registro`, `id_empleado`, `codigo_cliente`, `persona_contacto`, `id_patrulla`, `conoce_coordinador_zona`, `frecuencia_visitas_por_mes`, `capacidad_respuesta`, `solucion_de_problemas`, `hay_supervisor_perimetro`, `actitud_del_superior`, `exigencia_cumplimiento_pom`, `solucion_problemas`, `informa_oportunamente_novedades`, `puntualidad_horarios`, `actitud_hs`, `presentacion_personal`, `cumplimiento_pon`, `acata_indicaciones`, `informa_oportuna_novedades`, `atento_a_su_servicio`, `atencion_hacia_cliente`, tbl_frm_visita_jefe_operaciones.observaciones as jefeobservaciones  , tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, tbl_empleados.observaciones as observacionesempleado, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo` 
        FROM `tbl_patrullas` ,tbl_frm_visita_jefe_operaciones, tbl_empleados
        WHERE tbl_patrullas.id_jefe_operaciones_patrulla = tbl_frm_visita_jefe_operaciones.id and tbl_empleados.id=tbl_frm_visita_jefe_operaciones.id_empleado group by tbl_empleados.id";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();			
        return $sql->fetchAll();
      };
    $data = empleado();
    foreach($data as $value) {
      
        /* ********** */
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

        $html="";
      $html.= ' <tr>';


              if($value["fotografia"] != ""){
                $html.= '<td><img src="'.$value["fotografia"].'" class="img-thumbnail" width="40px"></td>';
              }else{
                $html.= '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
              }

             $html.= '<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]. '</td>';

              

            
              $html.= '<td>'.$value["documento_identidad"].': '.$value["numero_documento_identidad"].'</td>';

              $html.= '<td>'.$nombreEstado.'</td>';          

              $html.= '
              <td>

                <div class="btn-group">
                    
                  <a href="vistas/modulos/reporte.php?id='.$value["idempleado"].'" class="btn btn-success" idEmpleado="'.$value["idempleado"].'" target="_blank" ><i class="fa fa-file-word-o"></i></a>

                </div>  

              </td>

            </tr>';
        /* ************ */

        echo $html;

    }         



}
else{

  if (!empty($patrulla) && $ubicacion=="") {

    /* ******* */
  
        function empleado() {
        global $patrulla;


              $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`,  tbl_frm_visita_jefe_operaciones.id as idjefe, `fecha_registro`, `id_empleado`, `codigo_cliente`, `persona_contacto`, `id_patrulla`, `conoce_coordinador_zona`, `frecuencia_visitas_por_mes`, `capacidad_respuesta`, `solucion_de_problemas`, `hay_supervisor_perimetro`, `actitud_del_superior`, `exigencia_cumplimiento_pom`, `solucion_problemas`, `informa_oportunamente_novedades`, `puntualidad_horarios`, `actitud_hs`, `presentacion_personal`, `cumplimiento_pon`, `acata_indicaciones`, `informa_oportuna_novedades`, `atento_a_su_servicio`, `atencion_hacia_cliente`, tbl_frm_visita_jefe_operaciones.observaciones as jefeobservaciones  , tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, tbl_empleados.observaciones as observacionesempleado, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo` 
              FROM `tbl_patrullas` ,tbl_frm_visita_jefe_operaciones, tbl_empleados
              WHERE tbl_patrullas.id_jefe_operaciones_patrulla = tbl_frm_visita_jefe_operaciones.id and tbl_empleados.id=tbl_frm_visita_jefe_operaciones.id_empleado and tbl_patrullas.codigo_patrulla=$patrulla group by tbl_empleados.id";
              $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };
              $data = empleado();
              foreach($data as $value) {
                
                  /* ********** */
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

                  $html="";
                  $html.= ' <tr>';


                        if($value["fotografia"] != ""){
                          $html.= '<td><img src="'.$value["fotografia"].'" class="img-thumbnail" width="40px"></td>';
                        }else{
                          $html.= '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                        }

                      $html.= '<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]. '</td>';

                        

                      
                        $html.= '<td>'.$value["documento_identidad"].': '.$value["numero_documento_identidad"].'</td>';

                        $html.= '<td>'.$nombreEstado.'</td>';          

                        $html.= '
                        <td>

                          <div class="btn-group">
                              
                            <a href="vistas/modulos/reporte.php?id='.$value["idempleado"].'" class="btn btn-success" idEmpleado="'.$value["idempleado"].'" target="_blank" ><i class="fa fa-file-word-o"></i></a>

                          </div>  

                        </td>

                      </tr>';
                  /* ************ */

                  echo $html;

    }         


      /* ********* */

  }

  if (!empty($ubicacion) && $patrulla=="") {

    /* ******* */
  
        function empleado() {
        global $ubicacion;


            $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`,  tbl_frm_visita_jefe_operaciones.id as idjefe, `fecha_registro`, `id_empleado`, tbl_frm_visita_jefe_operaciones.codigo_cliente as codigoclientejefe, tbl_frm_visita_jefe_operaciones.persona_contacto as personacontactojefe, `id_patrulla`, `conoce_coordinador_zona`, `frecuencia_visitas_por_mes`, `capacidad_respuesta`, `solucion_de_problemas`, `hay_supervisor_perimetro`, `actitud_del_superior`, `exigencia_cumplimiento_pom`, `solucion_problemas`, `informa_oportunamente_novedades`, `puntualidad_horarios`, `actitud_hs`, `presentacion_personal`, `cumplimiento_pon`, `acata_indicaciones`, `informa_oportuna_novedades`, `atento_a_su_servicio`, `atencion_hacia_cliente`, tbl_frm_visita_jefe_operaciones.observaciones as jefeobservaciones  , tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, tbl_empleados.direccion as direccionempleado, tbl_empleados.id_departamento as departamentoempleado, tbl_empleados.id_municipio as municipioempleado, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, tbl_empleados.observaciones as observacionesempleado, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo` , tbl_patrullas_ubicaciones.id as idpatrullaubicacion, `id_patrullas_pu`, `id_ubicacion_pu`, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.id_cliente as idclienteubicacion, tbl_clientes_ubicaciones.codigo_cliente as codigoclienteubicacion, `codigo_ubicacion`, `facturar`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, tbl_clientes_ubicaciones.direccion as direccionubicacion, tbl_clientes_ubicaciones.persona_contacto as personacontactoubicacion, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, tbl_clientes_ubicaciones.id_departamento as departamentoubicacion, tbl_clientes_ubicaciones.id_municipio as municipioubicacion, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados`, `tipo_documento`, `forma_pago`, `concepto`, `sumahs`, `tienepon`, `bono_unidad`, `bono_horas`, `selefactura`, `zonaubicacion` 
              FROM `tbl_patrullas` ,tbl_frm_visita_jefe_operaciones, tbl_empleados, tbl_patrullas_ubicaciones,tbl_clientes_ubicaciones
              WHERE tbl_patrullas.id_jefe_operaciones_patrulla = tbl_frm_visita_jefe_operaciones.id and tbl_empleados.id=tbl_frm_visita_jefe_operaciones.id_empleado and id_patrullas_pu=tbl_patrullas.id and tbl_clientes_ubicaciones.id and tbl_patrullas_ubicaciones.id_ubicacion_pu and tbl_clientes_ubicaciones.nombre_ubicacion=$ubicacion group by tbl_empleados.id";
                $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };
              $data = empleado();
              foreach($data as $value) {
                
                  /* ********** */
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

                  $html="";
                  $html.= ' <tr>';


                        if($value["fotografia"] != ""){
                          $html.= '<td><img src="'.$value["fotografia"].'" class="img-thumbnail" width="40px"></td>';
                        }else{
                          $html.= '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                        }

                      $html.= '<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]. '</td>';

                        

                      
                        $html.= '<td>'.$value["documento_identidad"].': '.$value["numero_documento_identidad"].'</td>';

                        $html.= '<td>'.$nombreEstado.'</td>';          

                        $html.= '
                        <td>

                          <div class="btn-group">
                              
                            <a href="vistas/modulos/reporte.php?id='.$value["idempleado"].'" class="btn btn-success" idEmpleado="'.$value["idempleado"].'" target="_blank" ><i class="fa fa-file-word-o"></i></a>

                          </div>  

                        </td>

                      </tr>';
                  /* ************ */

                  echo $html;

    }         


      /* ********* */

  }
  
  
  if (!empty($ubicacion) && !empty($patrulla)) {

    /* ******* */
  
        function empleado() {
          global $ubicacion;
          global $patrulla;
          $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`,  tbl_frm_visita_jefe_operaciones.id as idjefe, `fecha_registro`, `id_empleado`, tbl_frm_visita_jefe_operaciones.codigo_cliente as codigoclientejefe, tbl_frm_visita_jefe_operaciones.persona_contacto as personacontactojefe, `id_patrulla`, `conoce_coordinador_zona`, `frecuencia_visitas_por_mes`, `capacidad_respuesta`, `solucion_de_problemas`, `hay_supervisor_perimetro`, `actitud_del_superior`, `exigencia_cumplimiento_pom`, `solucion_problemas`, `informa_oportunamente_novedades`, `puntualidad_horarios`, `actitud_hs`, `presentacion_personal`, `cumplimiento_pon`, `acata_indicaciones`, `informa_oportuna_novedades`, `atento_a_su_servicio`, `atencion_hacia_cliente`, tbl_frm_visita_jefe_operaciones.observaciones as jefeobservaciones  , tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, tbl_empleados.direccion as direccionempleado, tbl_empleados.id_departamento as departamentoempleado, tbl_empleados.id_municipio as municipioempleado, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, tbl_empleados.observaciones as observacionesempleado, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo` , tbl_patrullas_ubicaciones.id as idpatrullaubicacion, `id_patrullas_pu`, `id_ubicacion_pu`, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.id_cliente as idclienteubicacion, tbl_clientes_ubicaciones.codigo_cliente as codigoclienteubicacion, `codigo_ubicacion`, `facturar`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, tbl_clientes_ubicaciones.direccion as direccionubicacion, tbl_clientes_ubicaciones.persona_contacto as personacontactoubicacion, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, tbl_clientes_ubicaciones.id_departamento as departamentoubicacion, tbl_clientes_ubicaciones.id_municipio as municipioubicacion, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados`, `tipo_documento`, `forma_pago`, `concepto`, `sumahs`, `tienepon`, `bono_unidad`, `bono_horas`, `selefactura`, `zonaubicacion` 
          FROM `tbl_patrullas` ,tbl_frm_visita_jefe_operaciones, tbl_empleados, tbl_patrullas_ubicaciones,tbl_clientes_ubicaciones
          WHERE tbl_patrullas.id_jefe_operaciones_patrulla = tbl_frm_visita_jefe_operaciones.id and tbl_empleados.id=tbl_frm_visita_jefe_operaciones.id_empleado and id_patrullas_pu=tbl_patrullas.id and tbl_clientes_ubicaciones.id and tbl_patrullas_ubicaciones.id_ubicacion_pu and tbl_clientes_ubicaciones.nombre_ubicacion='$ubicacion' and tbl_patrullas.codigo_patrulla=$patrulla  group by tbl_empleados.id";
       
                $sql = Conexion::conectar()->prepare($query);
              $sql->execute();			
              return $sql->fetchAll();
            };
              $data = empleado();
              foreach($data as $value) {
                
                  /* ********** */
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

                  $html="";
                  $html.= ' <tr>';


                        if($value["fotografia"] != ""){
                          $html.= '<td><img src="'.$value["fotografia"].'" class="img-thumbnail" width="40px"></td>';
                        }else{
                          $html.= '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
                        }

                      $html.= '<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]. '</td>';

                        

                      
                        $html.= '<td>'.$value["documento_identidad"].': '.$value["numero_documento_identidad"].'</td>';

                        $html.= '<td>'.$nombreEstado.'</td>';          

                        $html.= '
                        <td>

                          <div class="btn-group">
                              
                            <a href="vistas/modulos/reporte.php?id='.$value["idempleado"].'" class="btn btn-success" idEmpleado="'.$value["idempleado"].'" target="_blank" ><i class="fa fa-file-word-o"></i></a>

                          </div>  

                        </td>

                      </tr>';
                  /* ************ */

                  echo $html;

    }         


      /* ********* */

  }
}

?>
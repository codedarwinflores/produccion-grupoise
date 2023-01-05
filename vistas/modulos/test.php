<?php
require_once "../../modelos/conexion.php";        

$start = '<html><body>';
$body  = '<p>Date | Details </p>';
           
function empleado() {
    global $nombretabla_sim;
    $query = "SELECT tbl_patrullas.id as idpatrulla, `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla`,  tbl_frm_visita_jefe_operaciones.id as idjefe, `fecha_registro`, `id_empleado`, `codigo_cliente`, `persona_contacto`, `id_patrulla`, `conoce_coordinador_zona`, `frecuencia_visitas_por_mes`, `capacidad_respuesta`, `solucion_de_problemas`, `hay_supervisor_perimetro`, `actitud_del_superior`, `exigencia_cumplimiento_pom`, `solucion_problemas`, `informa_oportunamente_novedades`, `puntualidad_horarios`, `actitud_hs`, `presentacion_personal`, `cumplimiento_pon`, `acata_indicaciones`, `informa_oportuna_novedades`, `atento_a_su_servicio`, `atencion_hacia_cliente`, tbl_frm_visita_jefe_operaciones.observaciones as jefeobservaciones  , tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `imagen_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, tbl_empleados.observaciones as observacionesempleado, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_partida_nacimiento`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `imagen_constancia_psicologica`, `imagen_examen_poligrafico`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo` 
    FROM `tbl_patrullas` ,tbl_frm_visita_jefe_operaciones, tbl_empleados
    WHERE tbl_patrullas.id_jefe_operaciones_patrulla = tbl_frm_visita_jefe_operaciones.id and tbl_empleados.id=tbl_frm_visita_jefe_operaciones.id_empleado";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };
$data = empleado();
foreach($data as $value) {

  
        $body .= '<span style="font-size: 14px; line-height: 2.5;">
        En las oficinas de la Sociedad, ubicadas en Avenida Las Buganvillas #7 "M", Colonia San Francisco, San Salvador; yo, '.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' , con Documento Único de Identidad número'.$value["numero_documento_identidad"].' actuando en mi calidad personal y como trabajador con el cargo de'.$value["nivel_cargo"].'
        de la Sociedad INVESTIGACIONES Y SEGURIDAD, SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE, que se abreviaISE, S.A. DE C.V., SOLICITO a la Sociedad que me conceda ANTICIPO DE SALARIO en cada uno de mis pagos quincenales;
        es decir que los días SIETE y VEINTIUNO de cada mes, me sean depositados en mi cuenta bancaria número'. '___numero de cuenta pendiente__' .' del BANCO'.'__banco pendiente__' .' la cantidad de '. '___cantidad pendiente DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA, ($ 10.00 )___'.' en concepto de ANTICIPO DE SALARIO como una ayuda económica, mientras dure la relación laboral o hasta que yo indique que ya no quiero la prestación, y AUTORIZO a la Sociedad para que me descuente la cantidad recibida en la fecha de pago de mi salario, es decir la suma'.' ___deCIENTO OCHENTA Y DOS 50/100 DÓLARES DE LOS ESTADOS UNIDOS DE AMÉRICA, ($ 182.50 )___ PENDIENTE'.'
        del salario que corresponde a la quincena próxima a la que se me fue entregado el anticipo mencionado en
        virtud de mi solicitud a la Sociedad.
        </span>
        
        <div style="height:200px"></div>';


    



    }
$end= '</body></html>';
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml($start.$body.$body.$end);
$dompdf->render();
$pdf = $dompdf->output();
$filename = "ejemplo.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>

<?php ob_start(); ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $idempleado =$_GET["id"];
?>

<!-- **********INICIO DEL REPORTE************ -->



<?php
require_once "../../modelos/conexion.php";        
function empleado() {
    global $idempleado;
    $query = "SELECT tbl_empleados.id as idempleado,  tbl_empleados.*, cargos_desempenados.id as idcargos, descripcion, cargos_desempenados.* FROM `tbl_empleados`
     INNER JOIN cargos_desempenados 
     WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id
     and tbl_empleados.id = $idempleado";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };
$data = empleado();
foreach($data as $value) {

   
       
    $d = $value["fecha_contratacion"];
 

    function dia($fecha) {
        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
        $dia = $dias[date('w', strtotime($fecha))];
        return $dia;
    }
    function obtenerFechaEnLetra($fecha){
        $dia= dia($fecha);
        $num = date("j", strtotime($fecha));
        $anno = date("Y", strtotime($fecha));
        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        $mes = $mes[(date('m', strtotime($fecha))*1)-1];
        return $dia.', '.$num.' de '.$mes.' del '.$anno;
    }
    
    obtenerFechaEnLetra($d);

?>


<div style="width: 100%;">
    <div style="width: 100%;" align="center">
        <span style="font-size: 12;">CONTRATO INDIVIDUAL DE TRABAJO</span>
    </div>
    <div style="width: 100%; clear:both">
    <br><br>
    </div>
    <!-- ******** -->
    <div style="width: 50%; float:left;" align="left">
        <span style="font-size: 12px; font-weight: bold;">GENERALES DEL TRABAJADOR</span>
        <br>
        <span style="font-size: 12px;  ">
            <span style="font-weight: bold;">NOMBRE:</span><?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">SEXO:</span>  <?php echo $value["sexo"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">EDAD:</span> <?php echo $value["sexo"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">ESTADO CIVIL:</span> <?php echo $value["estado_civil"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">PROFESION U OFICIO:</span> <?php echo $value["profesion_oficio"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">DOMICILIO:</span> <?php echo $value["direccion"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">NACIONALIDAD:</span> <?php echo $value["nacionalidad"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">DUI No:</span> <?php echo $value["numero_documento_identidad"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">EXPEDIDO EN:</span> <?php echo $value["fecha_expedicion_documento"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">OTROS DATOS DE IDENTIFICACION :</span> <?php echo $value["sexo"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
            
        </span>
        <br>
        <span style="font-size: 12px;">
            
        </span>
    </div>
    <div style="width: 50%; float:left;" align="left">
        <span style="font-size: 12px; font-weight: bold;">GENERALES DEL CONTRATANTE PATRONAL</span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">NOMBRE:</span> VLADIMIR ROBERTO MARIO ABRAHAM IGLESIAS
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;"> SEXO:</span>    MASCULINO
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">EDAD:</span> 63 AÑOS
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">ESTADO CIVIL:</span> CASADO
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">PROFESION U OFICIO:</span> ADMINISTRADOR
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">DOMICILIO:</span> ANTIGUO CUSCATLAN, LA LIBERTAD
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">RESIDENCIA:</span> BOSQUES DE SANTA ELENA QUEZALTEPEQUE PASAJE LOS LAURELES No. 23
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">NACIONALIDAD:</span> SALVADOREÑA
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">DUI No:</span>  02445939-4
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">EXPEDIDO EN:</span> ANTIGUO CUSCATLAN, LA LIBERTAD, 09/10/2002 05/07/2010
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">OTROS DATOS DE IDENTIFICACION :</span>
        </span>
        <br>
        <span style="font-size: 12px;">
        <span style="font-weight: bold;">ACTIVIDAD ECONOMICA DE LA EMPRESA:</span> SERVICIOS DESEGURIDAD
        </span>
    </div>
    <div style="width: 100%; clear:both">
    </div>
    <!-- ******* -->
    <div style="width: 100%;">
        <span style="font-size: 12px;">
        <br>
        <br>
        NOSOTROS: Vladimir Roberto Mario Abraham Iglesias en representación de la Sociedad INVESTIGACIONES Y SEGURIDAD,
            SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE, que se abrevia ISE, S.A. DE C.V., y <?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"] ?>
            de las generales expresadas, convenimos en celebrar Contrato Individual de Trabajo
            sujeto a las estipulaciones siguientes:

        </span>
    </div>
    <div style="width: 100%; clear:both">
    </div>
    <!-- ******* -->
    
    <div style="width: 100%;">
        <span style="font-size: 12px;">
            <br>
            <br>

            1º CLASE DE TRABAJO O SERVICIO:
            <br><br>
            La persona trabajadora se obliga a prestar sus servicios al patrono como, <?php echo $value["descripcion"] ?> además de las obligaciones que le impongan las leyes laborales y sus reglamos, el Reglamento Interno de Trabajo, Código de ética y demás legislaciones de la Sociedad; tendrá como obligaciones propias de su cargo: Prestar  el Servicio de Seguridad  con Eficiencia y colabora con las demás actividades que le sean solicitadas, siempre y cuando seanrelacionadas con el desempeño de sus labores.
            <br>
            <br>

       
            2º DURACION DEL CONTRATO Y TIEMPO DE SERVICIOS: <br><br>
            El presente contrato se celebra por tiempo Indefinido a partir del día <!-- ***DOS DE ENERO DE DOS MIL DIECISEIS** --><?php   echo obtenerFechaEnLetra($d); ?>
            fecha desde la cual la persona trabajadora presta servicios al patrono sin que la relación laboral se haya disuelto. Queda
            estipulado para la persona trabajadora de nuevo ingreso que los primeros treinta días serán de prueba y dentro de estetermino, las partes podrá dar por terminado el Contrato, sin expresión de causa ni responsabilidad alguna.
            <br><br>
            3º LUGAR DE PRESTACIONES DE SERVICIOS: <br><br>
            El lugar de prestación de los servicios será el que el patrono le designe según las necesidades por la naturaleza del giro del
            servicio, sin embargo, las partes contratantes convienen en que la persona trabajadora podrá ser trasladado a desarrollar
            sus labores a cualquier otro lugar de la Republica de El Salvador de conformidad a las necesidades y requerimientos dela Sociedad. La persona Trabajadora habitará en su domicilio, dado que la empresa no le proporciona alojamiento.
            <br><br>
            4º HORARIO DE TRABAJO:
            <br><br>
            Del día lunes al día viernes, de 8:00 am, a 12:00 m<br>
            Y de 01:00 pm a 05:00 pm<br>
            Día sábado de 8:00 am, a 12:00 m<br>
            Semana Laboral 44 horas.<br><br>
            Únicamente podrán ejecutarse trabajos extraordinarios cuando sean pactados de común acuerdo entre el Patrono oRepresentante Legal o la persona asignada por éstos y la persona trabajadora.
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            5º SALARIO FORMA, PERIODO Y LUGAR DE SU PAGO:<br><br>
            El salario que recibirá la persona trabajadora, por sus servicios será de  <?php echo $value["sueldo"]+ $value["sueldo"] ?>
            DE LOS ESTADOS UNIDOS DE AMÉRICA ( $<?php echo $value["sueldo"]+ $value["sueldo"] ?> ) MENSUALES, los cuales serán cancelados en dos cuotasmensuales de $<?php echo $value["sueldo"] ?> 00/100 DOLARES los días quince y treinta de cada mes. El salario sepagará en moneda de curso legal, dicho pago se depositará quincenalmente en su cuenta bancaria. La operación de pago
            principiará y se continuará sin interrupción, salvo caso fortuito o fuerza mayor, a más tardar dentro de las dos horas siguientes a la terminación de la jornada de trabajo correspondiente a la fecha respectiva. . Únicamente se admitirá reclamodespués de pagada la planilla o el día hábil siguiente.
            <br><br>
            6º HERRAMIENTAS Y MATERIALES:<br><br>
            El patrono suministrara a la persona trabajadora todas las herramientas y materiales necesarios, las cuales deberán ser
            devueltas cuando estas sean requeridas al efecto por el jefe inmediato superior, salvo la disminución o deterioro causados
            por caso fortuito o fuerza mayor o por la acción del tiempo, o por el consumo y uso normal de los mismos.
            <br><br>
            7º PERSONAS QUE DEPENDEN ECONOMICAMENTE DEL TRABAJADOR:<br><br>
        </span>
        <table border="1" align="center" bordercolor="black" cellspacing="0">
       
            <tr valign="bottom" align="center">
                <th width="100" >NOMBRES</th>
                <th width="100" >APELLIDOS</th>
                <th width="100" >EDAD</th>
                <th width="230" >DIRECCION</th>
                </tr>

                <tr>
                    <th height="10" ></th>
                    <th height="10" ></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                </tr>
                <tr>
                    <th height="10" ></th>
                    <th height="10" ></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                </tr>
                <tr>
                    <th height="10" ></th>
                    <th height="10" ></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                </tr>
            </table>

        <span style="font-size: 12px;">
        <br><br>
        8º OTRAS ESTIPULACIONES:<br><br>
        a) La persona trabajadora no velará ni usará, en ningún momento, durante la vigencia del contrato de Trabajo, en forma directao indirecta, ninguna información confidencial de la Empresa, así como tampoco, propiedad intelectual ni industrial del patrono,
        excepto la que sea requerida para el desempeño de sus obligaciones bajo el presente contrato. b) El presente contratosustituye a cualquier otro que haya sido otorgado con anterioridad entre las partes ya sea escrito o verbal, que haya estadoestado vigente entre el patrono y la persona trabajadora, pero no altera en manera alguna los derechos y prerrogativas
        de la persona trabajadora que amañen de su antigüedad en el servicio.
        </span>
    </div>
    <div style="width: 100%; clear:both">
    </div>
    <!-- ******* -->
    <div style="width: 100%;" align="center">
        
    <span style="text-align: center; font-size:12px">
    <br><br>
        En fe de la cual firmamos el presente documento por triplicado en: San Salvador, <br><?php   echo obtenerFechaEnLetra($d); ?> <br><br>
        </span>
    </div>
    <div style="width: 100%; clear:both">
    </div>
   <!-- ********* --> 
    <div style="width: 50%; float:left" align="center">
        <span style="text-align: center; font-size:12px">
            <br><br>
            ______________________________
            <br>
            Firma del Patrono 
        </span>
    </div>
    <div style="width: 50%; float:left" align="center">

        <span style="text-align: center; font-size:12px">
                <br><br>
                ______________________________
                <br>
                Firma del Trabajador 
            </span>
    </div>
    
    <div style="width: 100%; clear:both">
    </div>
   <!-- ********* --> 
    


</div>


<?php
}   
?>

<!-- *************FIN REPORTE************* -->



<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "contrato.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
$dompdf->stream($filename, array("Attachment" => false));

?>
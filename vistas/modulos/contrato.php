
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
    $query = "SELECT * FROM `tbl_empleados` where id = $idempleado";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();			
    return $sql->fetchAll();
  };
$data = empleado();
foreach($data as $value) {
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
        <span style="font-size: 12px;">GENERALES DEL TRABAJADOR</span>
        <br>
        <span style="font-size: 12px;">
            NOMBRE:<?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
            SEXO: <?php echo $value["sexo"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        EDAD: <?php echo $value["sexo"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        ESTADO CIVIL: <?php echo $value["estado_civil"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        PROFESION U OFICIO: <?php echo $value["profesion_oficio"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        DOMICILIO: <?php echo $value["direccion"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        NACIONALIDAD: <?php echo $value["nacionalidad"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        DUI No: <?php echo $value["numero_documento_identidad"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        EXPEDIDO EN: <?php echo $value["fecha_expedicion_documento"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
        OTROS DATOS DE IDENTIFICACION : <?php echo $value["sexo"] ?>
        </span>
        <br>
        <span style="font-size: 12px;">
            
        </span>
    </div>
    <div style="width: 50%; float:left;" align="right">
        <span style="font-size: 12px;">GENERALES DEL CONTRATANTE PATRONAL</span>
        <br>
        <span style="font-size: 12px;">
            NOMBRE:
        </span>
        <br>
        <span style="font-size: 12px;">
            SEXO:
        </span>
        <br>
        <span style="font-size: 12px;">
        EDAD:
        </span>
        <br>
        <span style="font-size: 12px;">
        ESTADO CIVIL:
        </span>
        <br>
        <span style="font-size: 12px;">
        PROFESION U OFICIO:
        </span>
        <br>
        <span style="font-size: 12px;">
        DOMICILIO:
        </span>
        <br>
        <span style="font-size: 12px;">
        NACIONALIDAD:
        </span>
        <br>
        <span style="font-size: 12px;">
        DUI No:
        </span>
        <br>
        <span style="font-size: 12px;">
        EXPEDIDO EN:
        </span>
        <br>
        <span style="font-size: 12px;">
        OTROS DATOS DE IDENTIFICACION :
        </span>
        <br>
        <span style="font-size: 12px;">
        ACTIVIDAD ECONOMICA DE LA EMPRESA:
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
            SOCIEDAD ANÓNIMA DE CAPITAL VARIABLE, que se abrevia ISE, S.A. DE C.V., y *********EMPLEADO****************
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
            La persona trabajadora se obliga a prestar sus servicios al patrono como, **JEFE DE OPERACIONES**
            además de las obligaciones que le impongan las leyes laborales y sus reglamos, el Reglamento Interno de Trabajo, Código de ética y demás legislaciones de la Sociedad; tendrá como obligaciones propias de su cargo: **Prestar el Servicio de Seguridad** con Eficiencia y colabora con las demás actividades que le sean solicitadas, siempre y cuando seanrelacionadas con el desempeño de sus labores.
            <br>
            <br>
            2º DURACION DEL CONTRATO Y TIEMPO DE SERVICIOS: <br><br>
            El presente contrato se celebra por tiempo Indefinido a partir del día ***DOS DE ENERO DE DOS MIL DIECISEIS**
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
            <br><br><br><br><br><br><br><br><br><br><br>
            5º SALARIO FORMA, PERIODO Y LUGAR DE SU PAGO:<br><br>
            El salario que recibirá la persona trabajadora, por sus servicios será de **NOVECIENTOS 00/100 DOLARES
            DE LOS ESTADOS UNIDOS DE AMÉRICA ( $900.00 ) MENSUALES**, los cuales serán cancelados en dos cuotasmensuales de ***CUATROCIENTOS CINCUENTA 00/100 DOLARES** los días quince y treinta de cada mes. El salario sepagará en moneda de curso legal, dicho pago se depositará quincenalmente en su cuenta bancaria. La operación de pago
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
                <th width="100" >DIRECCION</th>
                </tr>
                <tr>
                    <th height="10" ></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                </tr>
                <tr>
                    <th height="10" ></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                    <th  height="10"></th>
                </tr>
                <tr>
                    <th height="10" ></th>
                    <th  height="10"></th>
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
        En fe de la cual firmamos el presente documento por triplicado en: San Salvador, <br>al dia
        ******UNO DE DICIEMBRE DE DOS MIL VEINTE Y DOS****** <br><br>
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
$dompdf->stream($filename);
?>
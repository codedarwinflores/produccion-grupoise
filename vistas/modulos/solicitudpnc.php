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

<?php
$nombreImagenlogo = "../imgcarnet/logoise.jpg";
$imagenBase64logo = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagenlogo));
?>


<?php
$nombreImagenpie = "../imgcarnet/piecarnet.png";
$imagenBase64pie = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagenpie));
?>


<?php
$fotoempleado = "../../".$value["fotografia"];
$imagenBase64empleado = "data:image/png;base64," . base64_encode(file_get_contents($fotoempleado));
?>
<!-- ***CABECERA -->
<table style="width: 100%;" align="center">
    <tr>
        <td align="center"  style="width: 25%;">
            <img src="<?php echo $imagenBase64logo?>" width="80" alt="">
            <br>
            <span style="font-size: 10px;">
                POLICIA NACIONAL CIVIL<br>
                DIV. REGISTRO Y CONTROL DE
                SERVICIO PRIVADO DE SEGURIDAD
            </span>
        </td>
        <td align="center"  style="width: 60%;">
            <h2 style="font-size: 15px;">DATOS GENERALES</h2>
            <h2 style="font-size: 15px;">PERSONAL SERVICIOS PRIVADOS DE SEGURIDAD</h2>
        </td>
        <td  style="width: 10%;">
        <img src="<?php echo $imagenBase64empleado?>" width="80" alt="">
        </td>
    </tr>
</table>
<!-- **** -->

<!-- ***SEGUNDA CABECERA -->
<div style="width: 100%; ">
    <table style="border-collapse: collapse; width: 80%; margin-left: auto; margin-right: auto;">
        <tr style="border: 1px solid #000;">
            <td rowspan=2 style="width: 30%; border: 1px solid #000;">
                <span style="font-size: 12px;">CATEGORIA</span>
            </td>
            <td>
                <span style="font-size: 12px;">OPERATIVO</span> 
            </td> 
        </tr>
        <tr style="border: 1px solid #000;">
            <td>
            <span style="font-size: 12px;">ADMINISTRATIVO</span> 
            </td> 
        </tr>
    </table>
</div>

<!-- **ACTUALIZADO AL MES DE -->
<div style="width: 100%; ">
    <table style="border-collapse: collapse; width: 80%; margin-left: auto; margin-right: auto;">
        <tr style="border: 1px solid #000;">
            <td  style="width: 30%; border: 1px solid #000;">
                <span style="font-size: 12px;">ACTUALIZADO AL MES DE:</span>
            </td>  
        </tr>
    </table>
</div>

<!-- INFORMACION EMPLEADO -->
<div style="width: 100%; ">
    <table style="width: 100%; margin-left: auto; margin-right: auto;">
        <tr>
            <td align="center" style="width: 15%;">
                <span style="font-size: 11px;">MANO IZQUIERDA</span>
            </td>
            <td align="center">
                <span style="font-size: 11px;">NOMBRE DE LA EMPRESA: </span>
            </td>
            <td align="center" style="width: 15%;">
                <span style="font-size: 11px;">MANO DERECHA</span>
            </td>
        </tr>

        <tr>
            <td style="border: 1px solid #000;" align="center">
                <span>MEÑIQUE</span>
                <div style="height: 70px;"></div>
            </td>
            <td >
                
            <div style="width: 100%;">
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        NOMBRES: <?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"]?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        APELLIDOS: <?php echo $value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"] ?>
                    </span>
                </div>  
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- **** -->
                <div style="width: 100%; text-align:left;">
                    <span style="font-size: 12px;">
                        DIRECCION PARTICULAR DEL AGENTE: 
                        <?php echo $value["direccion"] ?>
                    </span>
                </div> 
                <!-- ***** -->
                <div style="width: 33.333%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        DUI: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div>
                <div style="width: 33.333%; float:left; text-align:center;">
                    <span style="font-size: 12px;">
                        EXTENDIDO: 
                    </span>
                </div>
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        FECHA: <?php echo $value["fecha_expedicion_documento"] ?> 
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ***** -->
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        ORIGINARIO DE: 
                    </span>
                </div>
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        FECHA DE NACIMIENTO: <?php echo $value["fecha_nacimiento"] ?>
                    </span>
                </div> 
            </div>
            <div style="height: 30px;"></div>
            </td>
            <td style="border: 1px solid #000;" align="center">
                <span>MEÑIQUE</span>
                <div style="height: 70px;"></div>
            </td>
        </tr>
        <!-- ***** -->
        
        <tr>
            <td style="border: 1px solid #000;" align="center">
                <span>ANULAR</span>
                <div style="height: 80px;"></div>
            </td>
            <td align="center">
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        NIVEL DE ESTUDIO: <?php echo $value["grado_estudio"] ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        TEL: <?php echo $value["telefono"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        No. ISSS: <?php echo $value["numero_isss"] ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        NIT: <?php echo $value["nit"] ?>
                    </span>
                </div>
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        LIC. DE CONDUCIR: <?php echo $value["licencia_conducir"] ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        CLASE: <?php echo $value["tipo_licencia_conducir"] ?>
                    </span>
                </div>
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        LIC. USO ARMA No. <?php echo $value["numero_licencia_tenencia_armas"] ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        VENCIMIENTO: <?php echo "*******" ?>
                    </span>
                </div>
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        MATRICULA DE ARMA No: <?php echo "*******" ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        No SERIE: <?php echo "*******" ?>
                    </span>
                </div> 
                

            </td>
            <td style="border: 1px solid #000;" align="center">
                <span>ANULAR</span>
                <div style="height: 80px;"></div>
            </td>
        </tr>
        
        <!-- ***** -->
        
        <tr>
            <td style="border: 1px solid #000;" align="center">
                <span>MEDIO</span>
                <div style="height: 80px;"></div>
            </td>
            <td align="center">
                <div style="width: 33.333%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        APROBO CURSO ANSP: <?php echo $value["curso_ansp"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        FECHA: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        No: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 33.333%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        CONSTANCIA MEDICA: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        FECHA: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        EXT.DR.: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        CONSTANCIA PSICOLOGICA: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        LICDO.(A): <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->

                
                <div style="width: 33.333%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        ESTATURA MTS: <?php echo $value["estatura"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        PESO LBS: <?php echo $value["peso"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        SEXO: <?php echo $value["sexo"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->

                
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        TIPO SANGUINEO: <?php echo $value["tipo_sangre"] ?>
                    </span>
                </div> 
                <div style="width: 50%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        ESTADO CIVIL: <?php echo $value["estado_civil"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
            </td>
            <td style="border: 1px solid #000;" align="center">
                <span>MEDIO</span>
                <div style="height: 80px;"></div>
            </td>
        </tr>

        
        <!-- ***** -->
        
        <tr>
            <td style="border: 1px solid #000;" align="center">
                <span>INDICE</span>
                <div style="height: 80px;"></div>
            </td>
            <td align="center">
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;"> 
                        NOMBRE DEL CONYUGE: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                     NOMBRE PADRE: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        NOMBRE MADRE: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->

                
                <div style="width: 33.333%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        EXPERIENCIA LABORAL: <?php echo $value["experiencia_laboral"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->

                
                <div style="width: 33.333%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        EX MIEMBRO DE LA PNC: <?php echo $value["ex_pnc"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        ONI: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 33.333%; float:left; text-align:right;">
                    <span style="font-size: 12px;">
                        FECHA RETIRO: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        UBICACION EN: <?php echo $value["numero_documento_identidad"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
            </td>
            <td style="border: 1px solid #000;" align="center">
                <span>INDICE</span>
                <div style="height: 80px;"></div>
            </td>
        </tr>

        
        <tr>
            <td style="border: 1px solid #000;" align="center">
                <span>PULGAR</span>
                <div style="height: 80px;"></div>
            </td>
            <td align="center">
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        FECHA DE INGRESO: <?php echo $value["fecha_solicitud"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        CARGO: <?php echo $value["nivel_cargo"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        SEÑALES ESPECIALES: <?php echo $value["senales_especiales"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->

                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                        OBSERVACIONES: <?php echo $value["observaciones"] ?>
                    </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->

                <div style="width: 100%; float:left; text-align:left;">
                    <br>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
                
                <div style="width: 100%; float:left; text-align:left;">
                    <span style="font-size: 12px;">FIRMA:________________________ </span>
                </div> 
                <div style="width: 100%;  clear: both;">
                </div>
                <!-- ******** -->
                
            </td>
            <td style="border: 1px solid #000;" align="center">
                <span>PULGAR</span>
                <div style="height: 80px;"></div>
            </td>
        </tr>

    </table>
    <br>
    <!-- INDICACIONES -->
    <table style="border-collapse: collapse; width: 100%;">
        <tr style="border: 1px solid #000;">
            <td style="" align="center">
                <span style="font-size: 12px;">
                    DOCUMENTOS QUE DEBEN PRESENTAR SEGUN ARTICULO 20 DE LA LEY DE SERVICIOS PRIVADOS DE SEGURIDAD
                </span>
                <div class="width:100%"></div>
                <div style="clear: both;"></div>
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                    * COPIA DE CONSTANCIA MEDICA Y PSICOLOGICA
                    </span>
                    <br>
                    <span style="font-size: 12px;">
                    * HOJA DE DATOS CON FOTOGRAFIA EN ORIGINAL
                    </span>
                    <br>
                    <span style="font-size: 12px;">
                    * COPIA DE DUI
                    </span>
                    <br>
                    <span style="font-size: 12px;">
                    * COPIA DE LICENCIA DE USO DE ARMA DE FUEGO
                    </span>
                    <br>
                    <span style="font-size: 12px;">
                    * COPIA DE CERTIFICADO DE ESTUDIOS MINIMO SEXTO GRADO
                    </span>
                    
                </div>
                <div style="width: 50%; float:left; text-align:left;">
                    <span style="font-size: 12px;">
                    * ORIGINAL DE ANTECEDENTES PENALES
                    </span>
                    <br>
                    <span style="font-size: 12px;">
                    * ORIGINAL DE ANTECEDENTES POLICIALES
                    </span>
                    <br>
                    <span style="font-size: 12px;">
                    * COPIA DE DIPLOMA DE LA A.N.S.P.
                    </span>
                    <br>
                </div>
                <div style="clear: both;"></div>
            </td>
        </tr>
    </table>
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
$filename = "Solicitud-PNC.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
/* $dompdf->stream("", array("Attachment" => false)); */
$dompdf->stream($filename, array("Attachment" => false));


?>

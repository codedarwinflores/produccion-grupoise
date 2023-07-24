
<?php ob_start(); ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $agente = $_POST["agente"];
 $fechainicial =$_POST["fechainicial"];
 $fechaultimo =$_POST["fechaultimo"];

 $formatofechainicial = date("Y-m-d", strtotime($fechainicial));
 $formatofechaultimo = date("Y-m-d", strtotime($fechaultimo));

 $entrega =$_POST["entrega"];
 $dui =$_POST["dui"];
 $tomadapor =$_POST["tomadapor"];
?>

<!-- **********INICIO DEL REPORTE************ -->

<?php
    if($_POST["agente"] == "*"){
?>

<!-- ********** -->



<?php
                require_once "../../modelos/conexion.php";        
                function empleadofecha() {
                    global $formatofechainicial;
                    global $formatofechaultimo;
                    $query = "SELECT * from tbl_empleados where fecha_ingreso between ('".$formatofechainicial."') and ('".$formatofechaultimo."')";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                };
                $data = empleadofecha();
                foreach($data as $value) {
                ?>
                <!-- ************UNA HOJA************ -->
                    <div style="width: 100%; border: 1px solid #000;">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 15px;">POLICÍA NACIONAL CIVIL</span>
                        </div>
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">
                                DIVISIÓN DE REGISTRO Y CONTROL DE SERVICIOS PRIVADOS DE SEGURIDAD <br>
                                FORMATO DE CONPROBACIÓN DE REQUISITOS DE PERSONAL PARA NUEVO INGRESO
                            </span>
                            <br>
                            <span style="font-size: 12px;">
                            NOMBRE DE ENTIDAD: INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.
                            </span>
                        </div>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 10%;"></td>
                                <td style="border:1px solid #000; width:80%;">
                                    <div style="width: 100%;" align="center">
                                        <span style="font-weight: 12px;">PERSONA DE NUEVA CONTRATACIÓN:</span>
                                    </div>
                                    <span style="font-weight: 12px;">
                                        NOMBRE:<?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"] ?>
                                    </span>
                                    <br>

                                    <div style="float: left; width:50%">
                                     <span style="font-weight: 12px;">
                                        NÚM.  DUI: <?php echo $value["numero_documento_identidad"];?>
                                     </span>
                                    </div>
                                    <div style="float: left; width:50%">
                                        <span style="font-weight: 12px;">
                                            FEC. DE ING.: <?php echo $value["fecha_ingreso"];?>
                                        </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                </td>
                                <td style="width: 10%;"></td>
                            </tr>
                        </table>
                        <br>
                    </div>
                    <div style="width: 100%; border: 1px solid #000; ">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">
                            REQUISITOS SEGÚN ARTÍCULO 20 LEY DE LOS SERVICIOS PRIVADOS DE SEGURIDAD
                            </span>
                        </div>
                        <br>
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 1) HOJA DE DATOS CON FOTOGRAFÍA EN ORIGINAL
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 2) DOCUMENTO ÚNICO DE IDENTIDAD (COPIA SIMPLE)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 3) LICENCIA DE USO DE ARMA DE FUEGO (COPIA SIMPLE)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 4) CERTIFICADO DE ESCOLARIDAD  (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 5) ANTECEDENTES PENALES (ORIGINAL )
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 6) ANTECEDENTES  POLICIALES (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 7) DIPLOMA DE LA ANSP (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 8) CONSTANCIA MÉDICA (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 9) CONSTANCIA PSICOLÓGICA (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                    </div>
                      <br>
                      <br>
                    <!-- ********** -->
                    <div style="width: 80%; border:1px solid #000; float:left;">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">ENTREGA CONFORME</span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; NOMBRE:<?php echo $entrega; ?>
                            </span>
                         </div>
                        
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; N° DE DUI:<?php echo $dui;?>
                            </span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">&nbsp; FIRMA:</span>
                        </div>
                    </div>
                    <div style="width: 20%; border:1px solid #000; float:left; height:76px"></div>
                    <div style="clear:both;"></div>
                    <!-- ********** -->
                    <br>
                    <br>
                    <!-- ********** -->
                    <div style="width: 80%; border:1px solid #000; float:left;">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">RECIBE CONFORME(PNC)</span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; NOMBRE:
                            </span>
                         </div>
                        
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; ONI:
                            </span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">&nbsp; FIRMA:</span>
                        </div>
                    </div>
                    <div style="width: 20%; border:1px solid #000; float:left; height:76px"></div>
                    <div style="clear:both;"></div>
                    <!-- ********** -->
                    
                    <br>
                    <br>
                    <!-- ********** -->
                    <div style="width: 20%; border:1px solid #000; float:left;">
                     
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; FECHA:
                            </span>
                         </div>
                    </div>
                    <div style="width: 20%; border:1px solid #000; float:left; height:19px"></div>
                    <div style="clear:both;"></div>
                    <!-- ********** -->
                    
                    <br>
                    <br>
                    <!-- ********** -->
                    <div style="width: 100%; border:1px solid #000; ">
                     
                        <div style="width: 100%;">
                            <span style="font-size: 11px;">
                             NOTA DE ADVERTENCIA: EN CASO DE DETECTARSE IRREGULARIDADES EN ALGUNO DE LOS DOCUMENTOS PRESENTADOS, QUE HAGAN PRESUMIR LA FALSEDAD DEL MISMO,
                            SE RETENDRÁ PARA HACER LAS INVESTIGACIONES LEGALES CORRESPONDIENTES. DE ELLO SE LEVANTARÁ ACTA, DE LA CUAL SE ENTREGARÁ COPIA AL EMPLEADO DE LA
                            ENTIDAD QUE PRESENTA LA DOCUMENTACIÓN. EL DOCUMENTO QUE RESULTARE FIDEDIGNO SE DEVOLVERÁ A LA ENTIDAD A TRAVÉS DE ACTA DE ENTREGA.
                            </span>
                         </div>
                    </div>
                    <!-- ********** -->
                    <div style="width: 100%; height:50px"></div>
              <!-- ************UNA HOJA************ -->
                <?php } ?>

<!-- *********** -->
<?php }else{?>


                <?php
                require_once "../../modelos/conexion.php";        
                function empleado() {
                    global $agente;
                    $query = "SELECT * FROM `tbl_empleados` where id = $agente";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                };
                $data = empleado();
                foreach($data as $value) {
                ?>
                <!-- ************UNA HOJA************ -->
                    <div style="width: 100%; border: 1px solid #000;">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 15px;">POLICÍA NACIONAL CIVIL</span>
                        </div>
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">
                                DIVISIÓN DE REGISTRO Y CONTROL DE SERVICIOS PRIVADOS DE SEGURIDAD <br>
                                FORMATO DE CONPROBACIÓN DE REQUISITOS DE PERSONAL PARA NUEVO INGRESO
                            </span>
                            <br>
                            <span style="font-size: 12px;">
                            NOMBRE DE ENTIDAD: INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.
                            </span>
                        </div>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 10%;"></td>
                                <td style="border:1px solid #000; width:80%;">
                                    <div style="width: 100%;" align="center">
                                        <span style="font-weight: 12px;">PERSONA DE NUEVA CONTRATACIÓN:</span>
                                    </div>
                                    <span style="font-weight: 12px;">
                                        NOMBRE:<?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"] ?>
                                    </span>
                                    <br>

                                    <div style="float: left; width:50%">
                                     <span style="font-weight: 12px;">
                                        NÚM.  DUI: <?php echo $value["numero_documento_identidad"];?>
                                     </span>
                                    </div>
                                    <div style="float: left; width:50%">
                                        <span style="font-weight: 12px;">
                                            FEC. DE ING.: <?php echo $value["fecha_ingreso"];?>
                                        </span>
                                    </div>
                                    <div style="clear: both;"></div>
                                </td>
                                <td style="width: 10%;"></td>
                            </tr>
                        </table>
                        <br>
                    </div>
                    <div style="width: 100%; border: 1px solid #000; ">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">
                            REQUISITOS SEGÚN ARTÍCULO 20 LEY DE LOS SERVICIOS PRIVADOS DE SEGURIDAD
                            </span>
                        </div>
                        <br>
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 1) HOJA DE DATOS CON FOTOGRAFÍA EN ORIGINAL
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 2) DOCUMENTO ÚNICO DE IDENTIDAD (COPIA SIMPLE)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 3) LICENCIA DE USO DE ARMA DE FUEGO (COPIA SIMPLE)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 4) CERTIFICADO DE ESCOLARIDAD  (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 5) ANTECEDENTES PENALES (ORIGINAL )
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 6) ANTECEDENTES  POLICIALES (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 7) DIPLOMA DE LA ANSP (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 8) CONSTANCIA MÉDICA (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                        
                        <!-- ******* -->
                        <div style="width: 80%; float:left;">
                            <span style="font-size: 12px;">
                            &nbsp; 9) CONSTANCIA PSICOLÓGICA (ORIGINAL)
                            </span>
                        </div>
                        <div style="width: 20%; float:left;">
                            <div style="border: 1px solid #000; height:10px; width:10px"></div>
                        </div>
                        <div style="clear:both;"></div>
                        <!-- ***** -->
                    </div>
                      <br>
                      <br>
                    <!-- ********** -->
                    <div style="width: 80%; border:1px solid #000; float:left;">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">ENTREGA CONFORME</span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; NOMBRE:<?php echo $entrega; ?>
                            </span>
                         </div>
                        
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; N° DE DUI:<?php echo $dui;?>
                            </span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">&nbsp; FIRMA:</span>
                        </div>
                    </div>
                    <div style="width: 20%; border:1px solid #000; float:left; height:76px"></div>
                    <div style="clear:both;"></div>
                    <!-- ********** -->
                    <br>
                    <br>
                    <!-- ********** -->
                    <div style="width: 80%; border:1px solid #000; float:left;">
                        <div style="width: 100%;" align="center">
                            <span style="font-size: 12px;">RECIBE CONFORME(PNC)</span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; NOMBRE:
                            </span>
                         </div>
                        
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; ONI:
                            </span>
                        </div>
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">&nbsp; FIRMA:</span>
                        </div>
                    </div>
                    <div style="width: 20%; border:1px solid #000; float:left; height:76px"></div>
                    <div style="clear:both;"></div>
                    <!-- ********** -->
                    
                    <br>
                    <br>
                    <!-- ********** -->
                    <div style="width: 20%; border:1px solid #000; float:left;">
                     
                        <div style="width: 100%;">
                            <span style="font-size: 12px;">
                            &nbsp; FECHA:
                            </span>
                         </div>
                    </div>
                    <div style="width: 20%; border:1px solid #000; float:left; height:19px"></div>
                    <div style="clear:both;"></div>
                    <!-- ********** -->
                    
                    <br>
                    <br>
                    <!-- ********** -->
                    <div style="width: 100%; border:1px solid #000; ">
                     
                        <div style="width: 100%;">
                            <span style="font-size: 11px;">
                             NOTA DE ADVERTENCIA: EN CASO DE DETECTARSE IRREGULARIDADES EN ALGUNO DE LOS DOCUMENTOS PRESENTADOS, QUE HAGAN PRESUMIR LA FALSEDAD DEL MISMO,
                            SE RETENDRÁ PARA HACER LAS INVESTIGACIONES LEGALES CORRESPONDIENTES. DE ELLO SE LEVANTARÁ ACTA, DE LA CUAL SE ENTREGARÁ COPIA AL EMPLEADO DE LA
                            ENTIDAD QUE PRESENTA LA DOCUMENTACIÓN. EL DOCUMENTO QUE RESULTARE FIDEDIGNO SE DEVOLVERÁ A LA ENTIDAD A TRAVÉS DE ACTA DE ENTREGA.
                            </span>
                         </div>
                    </div>
                    <!-- ********** -->
              <!-- ************UNA HOJA************ -->
                <?php } ?>

<?php } ?>

<!-- *************FIN REPORTE************* -->



<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Ficha Policia.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
$dompdf->stream($filename, array("Attachment" => false));

?>
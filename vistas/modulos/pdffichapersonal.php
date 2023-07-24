
<?php ob_start(); ?>


<?php
date_default_timezone_set("America/Mexico_City");
$mes = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"][date("n") - 1];
 $agentedesde = $_POST["agentedesde"];
 $agentehasta = $_POST["agentehasta"];

?>

<!-- **********INICIO DEL REPORTE************ -->




    <?php
                require_once "../../modelos/conexion.php";   
                
                function cargos_desempenados($id1) {
                    $query = "SELECT `id`, `descripcion`, `nivel`, `codigo_contable`, `personal_asignado`, `pago_feriados`, `calculo` FROM `cargos_desempenados` WHERE id='$id1'";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                };

                function empleadofecha($agentehasta1,$agentedesde1) {
                    $query = "SELECT * from tbl_empleados   where id >= $agentedesde1 and id <= $agentehasta1";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                };
                
                $data = empleadofecha($agentehasta,$agentedesde);
                foreach($data as $value) {
                ?>
                 <?php

                    $empleado2="../img/usuarios/default/anonymous.png";
                    $fotoempleado;
                    if($value["fotografia"] != ""){
                        $empleado = $value["fotografia"];
                        $ubicacionempleado = explode("/", $empleado);
                        $ubicacionfinalempleado="../".$ubicacionempleado[1]."/".$ubicacionempleado[2]."/".$ubicacionempleado[3]."/".$ubicacionempleado[4];

                         $fotoempleado = "data:image/png;base64," . base64_encode(file_get_contents($ubicacionfinalempleado));

    
                    }
                    else{
                    $fotoempleado = "data:image/png;base64," . base64_encode(file_get_contents($empleado2));
                    }
                ?>
                <!-- ************UNA HOJA************ -->

                <div style="width: 100%; height: 5px;"></div>
                <div style="width: 100%; border-top:1px solid #000; border-bottom:1px solid #000; height:60px">
                    <div style="width: 100%; ">
                        </hr>
                    </div>
                    <br>
                    <div style="width: 50%; float:left;" align="center">
                        <span style="font-size: 15px; color:#0071B9">
                        INVESTIGACIONES Y SEGURIDAD S.A. DE C.V. 
                        </span>
                    </div>
                    <div style="width: 50%; float:left;" align="center">
                        <span style="font-size: 15px; color:#0071B9">
                            FICHA PERSONAL
                        </span>
                    </div>
                    <div style="width: 100%; ">
                        </hr>
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div style="width: 100%;">
                    <div style="width: 33%; float:left;">
                        <span style="font-size: 12px;">No. <?php echo $value["id"]?></span>
                        <br>
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                    Nombres: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                 Cargo Desempeñado: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:30px;">
                                <span style="font-size: 12px;">
                                    <?php
                                    $data_cargo = cargos_desempenados($value["nivel_cargo"]);
                                    $cargo="";
                                    foreach($data_cargo as $value_cargo) {
                                    $cargo.=$value_cargo["descripcion"];
                                    }
                                    ?>
                                    <?php echo $cargo ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                    Teléfono: 
                                </span> 
                                </td>
                                <td>
                                <span style="font-size: 12px;">
                                     Fecha de Nacimiento: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["telefono"]; ?>
                                    </span> 
                                </td>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["fecha_nacimiento"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                    DUI: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px ">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["numero_documento_identidad"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                    Pero: 
                                </span> 
                                </td>
                                <td>
                                <span style="font-size: 12px;">
                                     Estatura: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["peso"]; ?>
                                    </span> 
                                </td>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["estatura"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                 AFP: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["codigo_afp"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                 Cabello: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["cabello"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>
                     
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                    Ojos: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["ojos"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>
                        
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Señales Especiales: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["senales_especiales"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Grado de Estudio: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["grado_estudio"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                    Servicio Militar: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["servicio_militar"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Lugar: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["lugar_servicio"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Grado Militar: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["grado_militar"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Solvencia de Antecedentes Policiales: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                       ***********************
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Trabajo Anterior: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["trabajo_anterior"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Trabajo Actual: 
                                </span> 
                                </td>
                                <td>
                                <span style="font-size: 12px;">
                                
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["trabajo_actual"]; ?>
                                    </span> 
                                </td>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["telefono_trabajo_actual"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                        <table style="width: 100%;">
                            <tr>
                                <td>
                                <span style="font-size: 12px;">
                                Licencia para el uso de arma de fuego: 
                                </span> 
                                </td>
                            </tr>
                            <tr>
                                <td style="border:1px solid #000; height:20px">
                                    <span style="font-size: 12px;">
                                        <?php echo $value["numero_licencia_tenencia_armas"]; ?>
                                    </span> 
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div style="width: 53%; float:left;">
                       <div style="width: 100%;" >
                        <span style="font-size: 12px;">Fecha Contratación:<?php echo $value["fecha_contratacion"]?></span> 
                       </div>
                       <div style="width: 100%;">
                            <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <span style="font-size: 12px;">
                                                Primer Apellido: 
                                            </span> 
                                        </td>

                                        <td>
                                            <span style="font-size: 12px;">
                                                Segundo Apellido: 
                                            </span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000; height:20px">
                                            <span style="font-size: 12px;">
                                            <?php echo $value["primer_apellido"]; ?>
                                            </span> 
                                        </td>
                                        <td style="border:1px solid #000; height:20px">
                                            <span style="font-size: 12px;">
                                            <?php echo $value["segundo_apellido"]; ?>
                                            </span> 
                                        </td>
                                    </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                        Dirección: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:30px">
                                        <span style="font-size: 10px;">
                                            <?php echo $value["direccion"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                        Estado civil: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["estado_civil"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                    <tr>
                                        <td>
                                        <span style="font-size: 12px;">
                                        NIT: 
                                        </span> 
                                        </td>
                                        <td>
                                        <span style="font-size: 12px;">
                                        Nacionalidad: 
                                        </span> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000; height:20px">
                                            <span style="font-size: 12px;">
                                                <?php echo $value["nit"]; ?>
                                            </span> 
                                        </td>
                                        <td style="border:1px solid #000; height:20px">
                                            <span style="font-size: 12px;">
                                                <?php echo $value["nacionalidad"]; ?>
                                            </span> 
                                        </td>
                                    </tr>
                            </table>

                            
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                        Tipo de Sangre: 
                                    </span> 
                                    </td>
                                    <td>
                                    <span style="font-size: 12px;">
                                         No. I.S.S.S.: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["tipo_sangre"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["numero_isss"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    NUP: 
                                    </span> 
                                    </td>
                                    <td>
                                    <span style="font-size: 12px;">
                                    CERTIFICADO SEGURO DE VIDA: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["nup"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            *********************************
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Piel: 
                                    </span> 
                                    </td>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Tipo Licencia de conducir: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["piel"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["tipo_licencia_conducir"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Cara: 
                                    </span> 
                                    </td>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Religión: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["cara"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["religion"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Profesión u Oficio: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["profesion_oficio"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Lugar de Estudio: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                        *********************
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                           <div style="height:51px;"></div>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Desde: 
                                    </span> 
                                    </td>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Hasta: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["fecha_servicio_inicio"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["fecha_servicio_fin"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Motivo de Baja: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["motivo_baja"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Graduado ANSP: 
                                    </span> 
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                            
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                        ***********************
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["fecha_curso_ansp"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["numero_aprobacion_ansp"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Referencia trabajo anterior: 
                                    </span> 
                                    </td>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Evaluacion: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["referencia_anterior"]; ?>
                                        </span> 
                                    </td>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["evaluacion_anterior"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Referencia trabajo actual: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                            <?php echo $value["referencia_actual"]; ?>
                                        </span> 
                                    </td>
                                </tr>
                            </table>

                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                    <span style="font-size: 12px;">
                                    Vencimiento: 
                                    </span> 
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #000; height:20px">
                                        <span style="font-size: 12px;">
                                           *****************
                                        </span> 
                                    </td>
                                </tr>
                            </table>
                       </div>
                    </div>
                    <div style="width: 10%; float:left;">
                        <img src="<?php echo $fotoempleado ?>" width="100" />
                    </div>
                    <div style="clear: both;"></div>
                </div>

              

                
       

                <!-- ************UNA HOJA************ -->
                <?php } ?>


<!-- *********** -->



<!-- *************FIN REPORTE************* -->



<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Ficha Dactilar.pdf";
file_put_contents($filename, $pdf);
/* $dompdf->stream($filename); */
$dompdf->stream($filename, array("Attachment" => false));
?>
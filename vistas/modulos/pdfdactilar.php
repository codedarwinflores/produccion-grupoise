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
                <?php
                    $nombrepolicia = "../imgpolicia/logopolicia.jpg";
                    $logopolicia = "data:image/png;base64," . base64_encode(file_get_contents($nombrepolicia));

                    $nombrecompa = "../imgpolicia/LOGO2.jpg";
                    $logocompa = "data:image/png;base64," . base64_encode(file_get_contents($nombrecompa));
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


                <div style="width: 100%; border:1px solid #000; height:90px">
                    <div style="width: 20%; float:left;">
                        <img src="<?php echo $logopolicia ?>" width="100" />
                    </div>
                    <div style="width: 60%; float:left;" align="center">
                        <br>
                        <span style="font-size: 12px;">
                        POLICÍA NACIONAL CIVIL<br>
                        DIVISION DE REGISTRO Y CONTROL DE SERVICIOS<br>
                        PRIVADOS DE SEGURIDAD<br>
                        </span>
                    </div>
                    <div style="width: 20%; float:left;">
                        <img src="<?php echo $logocompa ?>" width="80" />
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div style="width: 100%;">
                    <div style="width: 20%; float:left;">
                        <span style="font-size: 12px;">No.</span>
                    </div>
                    <div style="width: 60%; float:left;">
                       <div style="width: 100%;" align="center">
                        <span style="font-size: 12px;">TARJETA DECADACTILAR</span> 
                       </div>
                       <div style="width: 100%;">
                        <span style="font-size: 12px;">
                            APELLIDOS:<?php echo $value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]; ?>
                        </span> 
                        <br>
                        <span style="font-size: 12px;">
                            NOMBRES: <?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"]; ?>
                        </span> 
                        <br>
                        <span style="font-size: 12px;">
                            NOMBRE DE LA EMPRESA: INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.
                        </span> 
                        
                        </div>
                    </div>
                    <div style="width: 20%; float:left;">
                        <img src="<?php echo $fotoempleado ?>" width="100" />
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div style="width: 30%;  border:1px solid #000;" align="center">
                    <span style="font-size: 12px;">
                        FECHA DE ACTUALIZACION:
                    </span>
                </div>
                <!-- ********* -->
                <div style="width: 30%;  border:1px solid #000;" align="center">
                    <span style="font-size: 12px;">
                        IMPRESIONES TOMADAS POR:
                    </span>
                </div>
                <div style="width: 30%;  border:1px solid #000; float:left; height:53px;" align="center">
                    <span style="font-size: 12px;">
                       <?php echo $tomadapor ?>
                    </span>
                </div>
                <div style="width: 30%;  border:1px solid #000; float:left; height:53px" align="center">
                   <table style="width: 100%;">
                        <tr>
                            <td width="20">
                                <span style="font-size: 12;">SEXO:</span>
                            </td>
                            
                            <td  width="1">
                                <span style="font-size: 12;">M:</span>
                            </td>
                            <td   width="15">
                            <?php if($value["sexo"]=="Masculino"){
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px">X</div>';
                                }else{
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px"></div>';
                                } ?>
                                
                            </td>
                            <td width="1">
                                <span style="font-size: 12;">F:</span>
                            </td>
                            <td width="15" >
                                <!-- <div style="width: 20px; border:1px solid #000; height:20px"></div> -->
                                <?php if($value["sexo"]=="Femenino"){
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px">X</div>';
                                }else{
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px"></div>';
                                } ?>
                            </td>
                        </tr>
                   </table>
                </div>
                <div style="width: 40%;  border:1px solid #000; float:left" align="center">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <span style="font-size: 10;">CATEGORIA</span>
                            </td>
                            <td>
                                <span style="font-size: 10;">ADMINISTRATIVO</span>
                            </td>
                            <td>
                            <div style="width: 20px; border:1px solid #000; height:20px"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size: 10;"></span>
                            </td>
                            <td>
                                <span style="font-size: 10;">OPERATIVO</span>
                            </td>
                            <td>
                                <div style="width: 20px; border:1px solid #000; height:20px"></div>
                            </td>
                        </tr>
                   </table>
                </div>
                <div style="clear: both;"></div>
                <!-- ********** -->

                
                <div style="width: 30%; border:1px solid #000; float:left; height:50px;" align="center">
                <div style="height: 20px;"></div>
                </div>
                <div style="width: 30%;  border:1px solid #000; float:left; height:50px" align="center">
                   <span>FECHA DE NACIMIENTO</span>
                </div>
                <div style="width: 40%;  border:1px solid #000; float:left; height:50px" align="center">
                   <span><?php echo $value["fecha_nacimiento"];?></span>
                </div>
                
                <div style="clear: both;"></div>
                <!-- ********** -->
                <div style="width: 30%; border:1px solid #000; float:left; height:50px;" align="center">
                <div style="height: 20px;">
                    <span style="font-size: 12px;">
                    FIRMA DEL IDENTIFICADO
                    </span>
                </div>
                </div>
                <div style="width: 70%;  border:1px solid #000; float:left; height:50px" align="center">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <span style="font-size: 12px;">ESTADO CIVIL: </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;"> <?php echo $value["estado_civil"] ?></span>
                            </td>
                      <!--       <td>
                                <span style="font-size: 12px;">C ( ) </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">V ( ) </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">A ( ) </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">D ( ) </span>
                            </td> -->
                        </tr>
                    </table>
                </div>
                <div style="clear: both;"></div>
                <!-- ********** -->

                <table style="width: 100%;">
                    <tr>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">1 Pulgar Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">2 Índice Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">3 Medio Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">4 Anular Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">5 Auricular Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>

                    </tr>
                </table>
                <!-- ********************** -->
                
                <table style="width: 100%;">
                    <tr>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">1 Pulgar izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">2 Índice izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">3 Medio izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">4 Anular izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">5 Auricular izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>

                    </tr>
                </table>

                
                <table style="width: 100%;">
                    <tr>
                        <td  align="center">
                            <div style="height: 150px;"></div>
                            <span style="font-size: 12px;">Simultaneas Mano Izquierda</span>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">Pulgar Izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">Pulgar Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td  align="center">
                            <div style="height: 150px;"></div>
                            <span style="font-size: 12px;">Simultaneas Mano Derecha</span>
                        </td>
                    </tr>
                </table>

                <div style="height: 100px;"></div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                DIRECCION PARTICULAR DEL AGENTE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["direccion"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>
                    
                <div style="width:100%">
                    <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    DUI.:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_documento_identidad"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    EXTENDIDO EN:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["lugar_expedicion_documento"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="200">
                                <span style="font-size: 12px;">
                                FECHA: <?php echo $value["fecha_expedicion_documento"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                ORIGINARIO DE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                  dato falta
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                NIVEL ACADEMICO:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["grado_estudio"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                 TEL: <?php echo $value["telefono"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                No. DE ISSS.:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_isss"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. NIT.: <?php echo $value["nit"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                No. DE ISSS.:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_isss"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. NIT.: <?php echo $value["nit"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                LIC. DE CONDUCIR:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["licencia_conducir"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                CLASE: <?php echo $value["tipo_licencia_conducir"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                LIC. DE USO DE ARMA No.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_licencia_tenencia_armas"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                VENCIMIENTO: *********
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                MATRICULA DE ARMA No.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    **************
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. SERIE: *********
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                CURSO A.N.S.P
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["curso_ansp"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                FECHA: <?php echo $value["fecha_curso_ansp"]?>
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. <?php echo $value["numero_aprobacion_ansp"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                CONSTANCIA MEDICA
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   ******************
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                FECHA:*******************
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    EXTENDIDA POR DOCT@R: ***********
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 70%; float:left;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                ESTATURA Mts.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                PESO Lbs.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                TIPO DE SANGRE
                                </span>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                <?php echo $value["estatura"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["peso"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["tipo_sangre"]?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="width: 30%; float:left;">
                <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                <br><br><br>
                                </span>
                            </td>
                        </tr>
                    </table></div>
                <div style="clear: both;"></div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                NOMBRE DEL CONYUGUE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   *************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                NOMBRE DEL PADRE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   *************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                NOMBRE DE LA MADRE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   *************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                EXPERIENCIA LABORAL:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["experiencia_laboral"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                EX.-MIEMBRO PNC:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["ex_pnc"]?>
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                ONI:***************
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                FECHA DE RETIRO: ******************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>
                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                DESTACADO EN:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                               ******************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                Dirección del cliente de la entidad:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                               *******************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                FECHA DE INGRESO: <?php echo $value["fecha_ingreso"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                CARGO QUE DESEMPEÑA: <?php echo $value["nivel_cargo"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                SEÑALES ESPECIALES: <?php echo $value["senales_especiales"]?>
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                OBSERVACIONES: <?php echo $value["observaciones"]?>
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                REQUISITOS QUE DEBE CONTENER EL EXPEDIENTE:
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                CONSTANCIA MEDICA
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                ORIGINAL DE ANTECEDENTES PENALES
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                HOJA DE DATOS CON FOTOGRAFIA. EN ORIGINAL
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                ORIGINAL DE ANTECEDENTES POLICIALES
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                COPIA DE DUI
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                DIPLOMA DE LA A.N.S.P
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                COPIA DE LICENCIA DE USO DE ARMA DE FUEGO
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                COPIA DE CERTIFICADO DE ESTUDIOS MINIMO SEXTO GRADO
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="height: 20px;"></div>
                <!-- ************UNA HOJA************ -->
                <?php } ?>


<!-- *********** -->
<?php }else{?>




    <?php
                require_once "../../modelos/conexion.php";        
                function empleadofecha() {
                    global $agente;
                    $query = "SELECT * from tbl_empleados   where id = $agente";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                };
                $data = empleadofecha();
                foreach($data as $value) {
                ?>
                <?php
                    $nombrepolicia = "../imgpolicia/logopolicia.jpg";
                    $logopolicia = "data:image/png;base64," . base64_encode(file_get_contents($nombrepolicia));

                    $nombrecompa = "../imgpolicia/logocompa.jpg";
                    $logocompa = "data:image/png;base64," . base64_encode(file_get_contents($nombrecompa));
                ?>
                 <?php

                    $empleado2="../img/usuarios/default/anonymous.png";
                    $fotoempleado;
                    if($value["fotografia"] != ""){
                        $empleado = $value["fotografia"];
                        
                        $ubicacionfinalempleado="";
                       
                        $ubicacionempleado = explode("/", $empleado);
                        if (count($ubicacionempleado) > 1) {
                            // El delimitador '/' se encontró en la cadena
                        $ubicacionfinalempleado="../".$ubicacionempleado[1]."/".$ubicacionempleado[2]."/".$ubicacionempleado[3]."/".$ubicacionempleado[4];
                        }
                        else{
                            $ubicacionfinalempleado="../imgcarnet/anonymous.png";
                        }

                         $fotoempleado = "data:image/png;base64," . base64_encode(file_get_contents($ubicacionfinalempleado));

    
                    }
                    else{
                    $fotoempleado = "data:image/png;base64," . base64_encode(file_get_contents($empleado2));
                    }
                ?>
                <!-- ************UNA HOJA************ -->


                <div style="width: 100%; border:1px solid #000; height:90px">
                    <div style="width: 20%; float:left;">

                        <img src="<?php echo $logopolicia ?>" width="100" />
                    </div>
                    <div style="width: 60%; float:left;" align="center">
                        <br>
                        <span style="font-size: 12px;">
                        <?php echo $empleado;?>
                        POLICÍA NACIONAL CIVIL<br>
                        DIVISION DE REGISTRO Y CONTROL DE SERVICIOS<br>
                        PRIVADOS DE SEGURIDAD<br>
                        </span>
                    </div>
                    <div style="width: 20%; float:left;">
                        <img src="<?php echo $logocompa ?>" width="80" />
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div style="width: 100%;">
                    <div style="width: 20%; float:left;">
                        <span style="font-size: 12px;">No.</span>
                    </div>
                    <div style="width: 60%; float:left;">
                       <div style="width: 100%;" align="center">
                        <span style="font-size: 12px;">TARJETA DECADACTILAR</span> 
                       </div>
                       <div style="width: 100%;">
                        <span style="font-size: 12px;">
                            APELLIDOS:<?php echo $value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]; ?>
                        </span> 
                        <br>
                        <span style="font-size: 12px;">
                            NOMBRES: <?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"]; ?>
                        </span> 
                        <br>
                        <span style="font-size: 12px;">
                            NOMBRE DE LA EMPRESA: INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.
                        </span> 
                        
                        </div>
                    </div>
                    <div style="width: 20%; float:left;">
                        <img src="<?php echo $fotoempleado ?>" width="100" />
                    </div>
                    <div style="clear: both;"></div>
                </div>

                <div style="width: 30%;  border:1px solid #000;" align="center">
                    <span style="font-size: 12px;">
                        FECHA DE ACTUALIZACION:
                    </span>
                </div>
                <!-- ********* -->
                <div style="width: 30%;  border:1px solid #000;" align="center">
                    <span style="font-size: 12px;">
                        IMPRESIONES TOMADAS POR:
                    </span>
                </div>
                <div style="width: 30%;  border:1px solid #000; float:left; height:53px;" align="center">
                    <span style="font-size: 12px;">
                       <?php echo $tomadapor ?>
                    </span>
                </div>
                <div style="width: 30%;  border:1px solid #000; float:left; height:53px" align="center">
                   <table style="width: 100%;">
                        <tr>
                            <td width="20">
                                <span style="font-size: 12;">SEXO:</span>
                            </td>
                            
                            <td  width="1">
                                <span style="font-size: 12;">M:</span>
                            </td>
                            <td   width="15">
                            <?php if($value["sexo"]=="Masculino"){
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px">X</div>';
                                }else{
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px"></div>';
                                } ?>
                                
                            </td>
                            <td width="1">
                                <span style="font-size: 12;">F:</span>
                            </td>
                            <td width="15" >
                                <!-- <div style="width: 20px; border:1px solid #000; height:20px"></div> -->
                                <?php if($value["sexo"]=="Femenino"){
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px">X</div>';
                                }else{
                                    echo '<div style="width: 20px; border:1px solid #000; height:20px"></div>';
                                } ?>
                            </td>
                        </tr>
                   </table>
                </div>
                <div style="width: 40%;  border:1px solid #000; float:left" align="center">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <span style="font-size: 10;">CATEGORIA</span>
                            </td>
                            <td>
                                <span style="font-size: 10;">ADMINISTRATIVO</span>
                            </td>
                            <td>
                            <div style="width: 20px; border:1px solid #000; height:20px"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size: 10;"></span>
                            </td>
                            <td>
                                <span style="font-size: 10;">OPERATIVO</span>
                            </td>
                            <td>
                                <div style="width: 20px; border:1px solid #000; height:20px"></div>
                            </td>
                        </tr>
                   </table>
                </div>
                <div style="clear: both;"></div>
                <!-- ********** -->

                
                <div style="width: 30%; border:1px solid #000; float:left; height:50px;" align="center">
                <div style="height: 20px;"></div>
                </div>
                <div style="width: 30%;  border:1px solid #000; float:left; height:50px" align="center">
                   <span>FECHA DE NACIMIENTO</span>
                </div>
                <div style="width: 40%;  border:1px solid #000; float:left; height:50px" align="center">
                   <span><?php echo $value["fecha_nacimiento"];?></span>
                </div>
                
                <div style="clear: both;"></div>
                <!-- ********** -->
                <div style="width: 30%; border:1px solid #000; float:left; height:50px;" align="center">
                <div style="height: 20px;">
                    <span style="font-size: 12px;">
                    FIRMA DEL IDENTIFICADO
                    </span>
                </div>
                </div>
                <div style="width: 70%;  border:1px solid #000; float:left; height:50px" align="center">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <span style="font-size: 12px;">ESTADO CIVIL: </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;"> <?php echo $value["estado_civil"] ?></span>
                            </td>
                      <!--       <td>
                                <span style="font-size: 12px;">C ( ) </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">V ( ) </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">A ( ) </span>
                            </td>
                            <td>
                                <span style="font-size: 12px;">D ( ) </span>
                            </td> -->
                        </tr>
                    </table>
                </div>
                <div style="clear: both;"></div>
                <!-- ********** -->

                <table style="width: 100%;">
                    <tr>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">1 Pulgar Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">2 Índice Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">3 Medio Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">4 Anular Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">5 Auricular Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>

                    </tr>
                </table>
                <!-- ********************** -->
                
                <table style="width: 100%;">
                    <tr>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">1 Pulgar izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">2 Índice izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">3 Medio izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">4 Anular izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">5 Auricular izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>

                    </tr>
                </table>

                
                <table style="width: 100%;">
                    <tr>
                        <td  align="center">
                            <div style="height: 150px;"></div>
                            <span style="font-size: 12px;">Simultaneas Mano Izquierda</span>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">Pulgar Izquierdo</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td style="border: 1px solid #000;" align="center">
                            <span style="font-size: 12px;">Pulgar Derecho</span>
                            <div style="height: 150px;"></div>
                        </td>
                        <td  align="center">
                            <div style="height: 150px;"></div>
                            <span style="font-size: 12px;">Simultaneas Mano Derecha</span>
                        </td>
                    </tr>
                </table>

                <div style="height: 100px;"></div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                DIRECCION PARTICULAR DEL AGENTE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["direccion"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>
                    
                <div style="width:100%">
                    <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    DUI.:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_documento_identidad"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    EXTENDIDO EN:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["lugar_expedicion_documento"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="200">
                                <span style="font-size: 12px;">
                                FECHA: <?php echo $value["fecha_expedicion_documento"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                ORIGINARIO DE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                  dato falta
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                NIVEL ACADEMICO:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["grado_estudio"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                 TEL: <?php echo $value["telefono"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                No. DE ISSS.:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_isss"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. NIT.: <?php echo $value["nit"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                No. DE ISSS.:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_isss"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. NIT.: <?php echo $value["nit"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                LIC. DE CONDUCIR:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["licencia_conducir"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                CLASE: <?php echo $value["tipo_licencia_conducir"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                LIC. DE USO DE ARMA No.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["numero_licencia_tenencia_armas"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                VENCIMIENTO: *********
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                MATRICULA DE ARMA No.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    **************
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. SERIE: *********
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                CURSO A.N.S.P
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    <?php echo $value["curso_ansp"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                FECHA: <?php echo $value["fecha_curso_ansp"]?>
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                No. <?php echo $value["numero_aprobacion_ansp"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                CONSTANCIA MEDICA
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   ******************
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                FECHA:*******************
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                    EXTENDIDA POR DOCT@R: ***********
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 70%; float:left;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                ESTATURA Mts.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                PESO Lbs.
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                TIPO DE SANGRE
                                </span>
                            </td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                <?php echo $value["estatura"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["peso"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["tipo_sangre"]?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="width: 30%; float:left;">
                <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                <br><br><br>
                                </span>
                            </td>
                        </tr>
                    </table></div>
                <div style="clear: both;"></div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                NOMBRE DEL CONYUGUE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   *************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                NOMBRE DEL PADRE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   *************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                NOMBRE DE LA MADRE:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                   *************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                EXPERIENCIA LABORAL:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["experiencia_laboral"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                EX.-MIEMBRO PNC:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                <?php echo $value["ex_pnc"]?>
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                ONI:***************
                                </span>
                            </td>
                            
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                FECHA DE RETIRO: ******************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>
                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                DESTACADO EN:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                               ******************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" width="180">
                                <span style="font-size: 12px;">
                                Dirección del cliente de la entidad:
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                               *******************
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                FECHA DE INGRESO: <?php echo $value["fecha_ingreso"]?>
                                </span>
                            </td>
                            <td style="border: 1px solid #000;">
                                <span style="font-size: 12px;">
                                CARGO QUE DESEMPEÑA: <?php echo $value["nivel_cargo"]?>
                                </span>
                            </td>
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                SEÑALES ESPECIALES: <?php echo $value["senales_especiales"]?>
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                OBSERVACIONES: <?php echo $value["observaciones"]?>
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                REQUISITOS QUE DEBE CONTENER EL EXPEDIENTE:
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                CONSTANCIA MEDICA
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                ORIGINAL DE ANTECEDENTES PENALES
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                HOJA DE DATOS CON FOTOGRAFIA. EN ORIGINAL
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                ORIGINAL DE ANTECEDENTES POLICIALES
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                
                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                COPIA DE DUI
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                DIPLOMA DE LA A.N.S.P
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                COPIA DE LICENCIA DE USO DE ARMA DE FUEGO
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="width: 100%;">
                     <table style="width: 100%;">
                        <tr>
                            <td style="border: 1px solid #000;" >
                                <span style="font-size: 12px;">
                                COPIA DE CERTIFICADO DE ESTUDIOS MINIMO SEXTO GRADO
                                </span>
                            </td>
                            <td style="border: 1px solid #000;" width="250">
                                <span style="font-size: 12px;">
                                
                                </span>
                            </td>
                           
                        
                        </tr>
                    </table>
                </div>

                <div style="height: 80px;"></div>

                <!-- ************UNA HOJA************ -->
                <?php } ?>


<!-- *********** -->

<?php } ?>

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
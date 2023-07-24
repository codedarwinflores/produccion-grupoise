
<?php
    header('Content-Type: text/html; charset=ISO-8859-1');
?>

<?php


if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");
/* require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php"); */
/* require($_SERVER['DOCUMENT_ROOT']."/armoni/git/modelos/conexion2.php"); */



?>

<style>
.topics tr { line-height: 14px; }
  </style>
<div class="content-wrapper">

<section class="content-header">    
    <h1>      
      Ficha     
      <small>Imprimir ficha</small>    
    </h1>
    <ol class="breadcrumb">      
      <li><a href="empleados"><i class="fa fa fa-drivers-license-o"></i> Empleados</a></li>      
      <li class="active">Volver</li>    
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


        <div class="row">
          <div class="col-md-12" align="left">
               <button class="btn btn-primary" onclick="imprimirOrden('impresion')" ><i class="fa fa fa-print"></i>          
                Imprimir 
                </button>
          </div>
                  
        </div>

      </div>

      <div class="box-body" id="impresion">
        
        <?php       
        
        $db=Conexion2();   
            
        $query=$db->query("SELECT * FROM tbl_empleados WHERE numero_documento_identidad='".$_POST["numDoc"]."' ");
        if(!$query){
            echo'<div class="error_ mensajes"><strong>Error</strong><br/>ERROR</div>';            
            exit();
        }
        $row=$query->fetch_row();
        //fecha_contratacion
        //nombre
        //primer apellido
        //segundo apellido
        //cargo desempenado        
        $queryCargo=$db->query("SELECT * FROM  cargos_desempenados WHERE nivel='".$row[87]."' ");
        if(!$queryCargo){
            echo'<div class="error_ mensajes"><strong>Error</strong><br/>ERROR cargo</div>';            
            exit();
        }
        $rowcargo=$queryCargo->fetch_row();
        
        //direccion
        //telefono
        //fecha_nacimiento
        //estado_civil
        //dui
        //nit
        //nacionalidad
        //peso 
        //estatura
        //tiposangre
        //no ISSS
        //afp
  
        $queryAFP=$db->query("SELECT * FROM  afp WHERE codigo='".$row[27]."' ");
        if(!$queryAFP){
            echo'<div class="error_ mensajes"><strong>Error</strong><br/>ERROR afp</div>';            
            exit();
        }
        $rowafp=$queryAFP->fetch_row();
        //nup//certificado seguro vida(num ero)
        //cabello
        //piel
        //tipo licencia conduicir
        //ojos
        //cara
        //religion
        //senales especiales
        //profesion u oficio
        //grado de estudio
        //kugar donde estudio
        //servicio militar 
        //lugar sm
        //desde sm
        //hasta sm
        //solv antec pen
        //graduado ansp
        //trabajo anterior
        //num tel trab anterior
        //evaluacion
        //referencia trabajo anterior
        //trabajo actual
        //num tel trab actual
        //ref trab actual
        //licencia uso armas
        //vencimiento
    
        ?>
        <!--ENCABEZADO--> 
        <div class="col-md-12" align="left">              
          <!--   <img src="/grupoise/vistas/img/plantilla/logo_original.png" style="width: 152px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label style="font-size: xx-large;">FICHA PERSONAL</label> -->
          <table>
            <tr>
              <td WIDTH="500"><label style="font-size: 20px; color:blue;">INVESTIGACIONES Y SEGURIDAD S.A. DE C.V.</label></td>
              <td ><label style="font-size:20px;  color:blue;">FICHA PERSONAL</label></td>
            </tr>
          </table>
          
        </div> 

        <!--FOTO--> 
        <div class="col-md-12" align="left">  
          <?php
       
  /*         $fotoempleado = "../../".$row[56];
          $imagenBase64empleado = "data:image/png;base64," . base64_encode(file_get_contents($fotoempleado)); */
          ?>  
        
            
        </div> 
<style>
  td{
    font-size: 12px;
  }
</style>
        <table>
          <tr>
            <td WIDTH="900">
        
              <!-- ****** -->
              <div class="col-md-12" align="left">   
                    <table style="width: 100%;" >
                      <!--NUMERO Y FECHA CONTRATACION--> 
                      <tr    style="line-height: 25px">
                        <td> <b>N&uacute;mero:<br><?php echo $row[0]?> </td>
                        <td colspan="3"> <b>Fecha contrataci&oacute;n:<br> <?php echo $row[1]?></td>
                      </tr>

                      <!--NOMBRE, PRIMER APELLIDO SEGUNDOAPELLIDO-->  
                      <tr style="line-height: 25px">
                        <td> <b>Nombres:</b><br><?php echo $row[2]." ".$row[3]." ".$row[4]?> </td>
                        <td> <b>Primer apellido:</b> <br><?php echo $row[5]?></td>
                        <td colspan="2"> <b>Segundo apellido:</b> <br><?php echo $row[6]?></td>
                      </tr>

                      <!--CARGO Y DIRECCION-->
                      <tr style="line-height: 25px">
                        <td> <b>Cargo desempe&ntilde;ado:</b><br><?php echo $rowcargo[1]?> </td>
                        <td colspan="3">  <b>Direcci&oacute;n:</b><br> <?php echo $row[10]?></td>
                      </tr>
                      <!--TELEFONO,FECHANAc, ESTADO CIVIL-->  
                      <tr style="line-height: 25px">
                        <td> <b>Tel&eacute;fono:</b><br><?php echo $row[13]?> </td>
                        <td>  <b>Fecha de nacimiento:</b><br> <?php echo $row[31]?></td>
                        <td colspan="2"> <b>Estado civil:</b><br> <?php echo $row[8]?></td>
                      </tr>
                    <!--DUI, NIt, NACIONALIDAD--> 
                      <tr style="line-height: 25px">
                        <td> <b>DUI:</b><br><?php echo $row[17]?> </td>
                        <td>  <b>NIT:</b><br> <?php echo $row[25]?></td>
                        <td colspan="2">  <b>Nacionalidad:</b><br><?php echo $row[30]?></td>
                      </tr>
                    <!--PESO, ESTARUTA, TIPO SANGRE,No ISSS--> 
                    <tr style="line-height: 25px">
                        <td> <b>Peso:</b><br><?php echo $row[35]?> lb </td>
                        <td>   <b>Estatura:</b><br> <?php echo $row[36]?> m</td>
                        <td>   <b>Tipo de sangre:</b><br> <?php echo $row[41]?></td>
                        <td>  <b>No. ISSS:</b> <br><?php echo $row[13]?></td>
                      </tr>
                      <!--AFP, NUP, CERTIFICADO SEGURO VIDA--> 
                      <tr style="line-height: 25px">
                        <td> <b>AFP:</b><br><?php echo $rowafp[1]?> </td>
                        <td>  <b>NUP:</b><br> <?php echo $row[27]?></td>
                        <td colspan="2">  <b>Certificado seguro de vida:</b><br> N/D</td>
                      </tr>
                      <!--CABELLO,PIEL , TIPO LICENCIA CONDUCIR--> 
                      <tr style="line-height: 25px">
                        <td> <b>Cabello:</b><br><?php echo $row[39]?>  </td>
                        <td>  <b>Piel:</b><br> <?php echo $row[37]?></td>
                        <td colspan="2">  <b>Tipo licencia de conducir:</b><br><?php echo $row[22]?></td>
                      </tr>
                      <!--OJOS,CARA, RELIGION--> 
                      <tr style="line-height: 25px">
                        <td> <b>Ojos:</b><br><?php echo $row[38]?>  </td>
                        <td> <b>Cara:</b><br> <?php echo $row[40]?></td>
                        <td colspan="2">  <b>Religi&oacute;n:</b><br><?php echo $row[32]?></td>
                      </tr>
                      <!--SENALES ESPECIALES, PROFESION U OFICIO--> 
                      <tr style="line-height: 25px">
                        <td> <b>Se&ntilde;ales especiales:</b><?php echo $row[42]?> </td>
                        <td colspan="3">  <b>Profesi&oacute;n/Oficio:</b><?php echo $row[28]?></td>
                      </tr>

                    <!--GRADO DE ESTUDIOS, LUGAR DONDE ESTUDIO--> 
                      <tr style="line-height: 25px">
                        <td> <b>Grado de estudios:</b><?php echo $row[33]?>  </td>
                        <td colspan="3"> <b>Lugar donde estudi&oacute;:</b> <?php echo $row[34]?></td>
                      </tr>

                    <!--Servicio militar--> 
                    <tr style="line-height: 25px">             
                      <td colspan="4"> <b>Servicio militar:</b><?php echo $row[46]?> </td>
                    </tr>
                    <tr style="line-height: 25px">
                      <td> <b>Lugar:</b><br><?php echo $row[49]?> </td>
                      <td> <b>Desde:</b><br> <?php echo $row[47]?></td>
                      <td colspan="2">  <b>Hasta:</b><br> <?php echo $row[48]?></td>
                    </tr>
                    <tr style="line-height: 25px">
                      <td> <b>Grado militar:</b><br><?php echo $row[50]?> </td>
                      <td colspan="3">  <b>Motivo baja:</b><br><?php echo $row[51]?> </td>
                    </tr>

                    <!--SOLVENCIA ANTECEDENTES POLICIALES [convertir]--> 
                    <tr style="line-height: 25px">
                      <td> <b>Solvencia antecedentes policiales:</b><br> N/D</td>
                      <td colspan="3">  <b>Graduado ANSP:</b><br> <?php echo $row[54]?> <b>Fecha:</b> N/D  <b>Promoci&oacute;n:</b> N/D </td>
                    </tr>

                    <!--TRABAJO ANTERIOR--> 
                    <tr style="line-height: 25px">
                        <td>  <b>Trabajo anterior:</b><br><?php echo $row[56]?></td>
                        <td>  <b>Tel&eacute;fono:</b><br> <?php echo $row[68]?></td>
                        <td>   <b>Referencia:</b><br><?php echo $row[70]?></td>
                        <td>  <b>Evaluaci&oacute;n:</b><br> <?php echo $row[71]?> </td>
                      </tr>
                    <!--TRABAJO ACTUAL--> 
                    <tr style="line-height: 25px">
                        <td> <b>Trabajo actual:</b><br><?php echo $row[58]?></td>
                        <td>   <b>Tel&eacute;fono:</b><br> <?php echo $row[69]?> </td>
                        <td>   <b>Referencia:</b><br><?php echo $row[72]?></td>
                        <td> <b>Evaluaci&oacute;n:</b><br><?php echo $row[73]?> </td>
                      </tr>
                    <!--LICENCIA PARA USO ARMAS DE FUEGO--> 
                    <tr style="line-height: 25px">
                      <td>  <b>Licencia para el uso de armas de fuego:</b><br> <?php echo $row[43]?> </td>
                      <td colspan="3">  <b>N&uacute;mero:</b> <br><?php echo $row[44]?> </td>
                    </tr>


                    </table>
                  </div> 
              <!-- ***** -->
            </td>
            <td>
              <!-- ***** -->
                <div class="col-md-12">
                  <img src="<?php echo $row[55]?>" style="width: 100px;margin: 15px;border-style: solid;border-width: 1px;">
                </div>
                <div style="height: 700px;"></div>
              <!-- ***** -->
            </td>
          </tr>
        </table>
     



      </div>

    </div>

  </section>

</div>




<script>
function imprimirOrden(divaimprimir)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title></title>');
    mywindow.document.write('</head><body >');
  
    mywindow.document.write(document.getElementById(divaimprimir).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
</script>

<?php
if($_SESSION["perfil"] == "Especial"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;	
}

//obtener los datos maestros 
//require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");

require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php");

if(isset($_POST["numDoc"])){




	//buscsar datos de imagenes
    $db=Conexion2();
	//echo "SELECT * FROM tbl_empleados WHERE numero_documento_identidad='".$_POST["numDoc"]."' ";
	$query=$db->query("SELECT * FROM tbl_empleados WHERE numero_documento_identidad='".$_POST["numDoc"]."' ");
	if(!$query){
		echo'<div class="error_ mensajes"><strong>Error</strong><br/>ERROR</div>';
		//echo $db->last_error();
		exit();
	}
	$row=$query->fetch_row();

    $img_empleado=$row[56];
	$img_documento_identidad=$row[18];
	$img_licencia_conducir=$row[24];
	$img_nit=$row[26];
	$img_licencia_tenencia_armas=$row[46];
	$img_diploma_ansp=$row[55];
	$img_solicitud=$row[76];
	$img_partida_nacimiento=$row[77];
	$img_antecedentes_penales=$row[78];
	$img_solvencia_pnc=$row[80];
	$img_constancia_psico=$row[82];
	$img_examen_pol=$row[83];
	$img_huellas=$row[85];

}
else{
	echo '<script>

        window.location = "empleados";

    </script>';

    return;
	
}
	







?>
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
<div class="content-wrapper" style="background: #fff;">

  <section class="content-header">
    
    <h1>
      
     
	<button class="btn btn-primary" onclick="imprimirOrden('impresion')">          
          Imprimir Todo
    </button>
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Imprimir Documentos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box" style="background: #ffffff00;">

      <div class="box-header " id="impresion">
  
		<div class="row">
			<div class="col-lg-1 col-xs-1">
				<img src="vistas/img/plantilla/icono-negro.png" style="max-height: 56px;">
			</div>
			<div class="col-lg-11 col-xs-11" style="font-size: xx-large;top: 4px;">
				IMPRIMIR DOCUMENTOS <b></b><br>			
			</div>
			<hr>
			
		</div>
		<div class="row">
			<hr>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Fotograf&iacute;a</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_empleado?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_empleado?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Documento</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_documento_identidad?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_documento_identidad?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Licencia Conducir</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_licencia_conducir?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_licencia_conducir?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">NIT</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_nit?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_nit?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>

			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Licencia TDA</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_licencia_tenencia_armas?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_licencia_tenencia_armas?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Diploma ANSP</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_diploma_ansp?>" style="width: 75px;height: 75px;"></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_diploma_ansp?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			<hr>
		</div>	 

        <div class="row">
			<hr>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Solicitud</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_solicitud?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_solicitud?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Partida Nac.</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_partida_nacimiento?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_partida_nacimiento?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">A. Penales</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_antecedentes_penales?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_antecedentes_penales?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Solv. PNC</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_solvencia_pnc?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_solvencia_pnc?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>

			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">C.Psicol&oacute;ogica</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_constancia_psico?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_constancia_psico?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">E.Poligr&aacute;afico</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_examen_pol?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_examen_pol?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
			
		</div>	
		<div class="row">
			<hr>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Huellas Dig.</td>
					</tr>
					<tr>
						<td><img src="<?php echo  $img_huellas?>" style="width: 75px;height: 75px;" ></td>
					</tr>
					<tr>
						<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_huellas?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
					</tr>
				</table>	
			</div>
		</div>

        

      </div>

      <div class="box-body">
        
     

      
      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL IMPRIMIR  FOTOGRAFIA
======================================-->
<div id="modalImprimir" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
		<!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Imprimir</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA CAMPOS  -->
			<div id="fotoEmpleado"><img src="" class="previsualizarImagenaImprimir" style="width: -webkit-fill-available;"></div>	
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" onclick="imprimirOrden('fotoEmpleado')">Imprimir </button>
        </div> 
    </div>
  </div>
</div>


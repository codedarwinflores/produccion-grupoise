<?php
if($_SESSION["perfil"] == "Especial"){
  echo '<script>
    window.location = "inicio";
  </script>';
  return;	
}

//obtener los datos maestros 
require($_SERVER['DOCUMENT_ROOT']."/modelos/conexion2.php");

/* require($_SERVER['DOCUMENT_ROOT']."/grupoise/modelos/conexion2.php"); */

/* require($_SERVER['DOCUMENT_ROOT']."/armoni/git/modelos/conexion2.php"); */


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

    $img_empleado=$row[55];
	$img_documento_identidad=$row[18];
	$img_licencia_conducir=$row[22];
	$img_nit=$row[25];
	$img_licencia_tenencia_armas=$row[45];
	$img_diploma_ansp=$row[54];
	$img_solicitud=$row[75];
	$img_partida_nacimiento=$row[77];
	$img_antecedentes_penales=$row[76];
	$img_solvencia_pnc=$row[78];
	$img_constancia_psico=$row[116];
	$img_examen_pol=$row[82];
	$img_huellas=$row[81];
	

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
	<div class="col-md-12">
		
			<table class="table">
				<?php
				function tblempleados() {
					$query01 = "SELECT * FROM tbl_empleados WHERE numero_documento_identidad='".$_POST["numDoc"]."' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();			
					return $sql->fetchAll();
					}

					$data01 = tblempleados();
					foreach($data01 as $rowempleado) {
				?>
					<tr>
						<td>
							<?php
							if($rowempleado["imagen_solvencia_pnc"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_solvencia_pnc">
									<label class="form-check-label" >
										Solvencia de la Policia
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_solvencia_pnc">
									<label class="form-check-label" >
										Solvencia de la Policia
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["imagen_documento_identidad"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_documento_identidad">
									<label class="form-check-label" >
										Fotocopia de DUI
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_documento_identidad">
									<label class="form-check-label" >
										Fotocopia de DUI
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["imagen_huellas"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_huellas">
									<label class="form-check-label" >
										Huellas
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_huellas">
									<label class="form-check-label" >
										Huellas
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>

					<tr>
						<td>
							<?php
							if($rowempleado["imagen_solvencia_pnc"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_solvencia_pnc">
									<label class="form-check-label" >
										Examen poligrafico<!-- --pendiente -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_solvencia_pnc">
									<label class="form-check-label" >
									Examen poligrafico<!-- --pendiente -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["imagen_nit"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_nit">
									<label class="form-check-label" >
										Fotocopia del NIT
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_nit">
									<label class="form-check-label" >
										Fotocopia del NIT
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["imagen_huellas"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_huellas">
									<label class="form-check-label" >
										Seguro de Vida <!-- --PENDIENTE -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_huellas">
									<label class="form-check-label" >
										Seguro de Vida <!-- --PENDIENTE -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>
					
					<tr>
						<td>
							<?php
							if($rowempleado["imagen_solvencia_pnc"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_solvencia_pnc">
									<label class="form-check-label" >
										Constancia Medica<!-- --pendiente -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_solvencia_pnc">
									<label class="form-check-label" >
									Constancia Medica<!-- --pendiente -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["fotoisss"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="fotoisss">
									<label class="form-check-label" >
									Tarjeta del ISSS
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="fotoisss">
									<label class="form-check-label" >
									Tarjeta del ISSS
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["imagen_huellas"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_huellas">
									<label class="form-check-label" >
										Solicitud de Empleo <!-- --PENDIENTE -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_huellas">
									<label class="form-check-label" >
										Solicitud de Empleo <!-- --PENDIENTE -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>

					<tr>
						<td>
							<?php
							if($rowempleado["constancia_psicologica"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="constancia_psicologica">
									<label class="form-check-label" >
										Constancia Psicologica
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="constancia_psicologica">
									<label class="form-check-label" >
									Constancia Psicologica
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["carnetafp"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="carnetafp">
									<label class="form-check-label" >
										AFP
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="carnetafp">
									<label class="form-check-label" >
										AFP
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["imagen_solicitud"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_solicitud">
									<label class="form-check-label" >
										Contrato Firmado
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_solicitud">
									<label class="form-check-label" >
										Contrato Firmado 
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>

					<tr>
						<td>
							<?php
							if($rowempleado["licencia_conducir"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="licencia_conducir">
									<label class="form-check-label" >
										Licencia de Conducir
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="licencia_conducir">
									<label class="form-check-label" >
									Licencia de Conducir
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["carnetafp"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="carnetafp">
									<label class="form-check-label" >
										Curso de la Academia <!-- Pendiente -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="carnetafp">
									<label class="form-check-label" >
										Curso de la Academia <!-- Pendiente -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>


					<tr>
						<td>
							<?php
							if($rowempleado["imagen_antecedentes_penales"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_antecedentes_penales">
									<label class="form-check-label" >
										Antecedente Penales
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_antecedentes_penales">
									<label class="form-check-label" >
										Antecedente Penales
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["carnetafp"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="carnetafp">
									<label class="form-check-label" >
										Original de Partida de Nac. <!-- Pendiente -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="carnetafp">
									<label class="form-check-label" >
										Original de Partida de Nac. <!-- Pendiente -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>

					<tr>
						<td>
							<?php
							if($rowempleado["imagen_antecedentes_penales"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="imagen_antecedentes_penales">
									<label class="form-check-label" >
										Certificados <!-- pendiente -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="imagen_antecedentes_penales">
									<label class="form-check-label" >
										Certificados <!-- pendiente -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
						<td>
							<?php
							if($rowempleado["carnetafp"]=="")
							{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" columna="carnetafp">
									<label class="form-check-label" >
										Licencia de Portación de Arma <!-- --pendiente -->
									</label>
									
								</div>
							<?php	
							}else{
							?>
								<div class="form-check">
									<input class="form-check-input mostrarimagen" type="checkbox" value="" id="" checked columna="carnetafp">
									<label class="form-check-label" >
										Licencia de Portación de Arma <!-- --pendiente -->
									</label>
								</div>
							<?php
							}
							?>
							
						</td>
					</tr>

				<?php
				}
				?>
			</table>
	
		<br>
		<br>
	</div>
			<hr>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Fotograf&iacute;a</td>
					</tr>
					<?php
						if($img_empleado==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_empleado?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_empleado?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Documento</td>
					</tr>
					<?php
						if($img_documento_identidad==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_documento_identidad?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_documento_identidad?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Licencia Conducir</td>
					</tr>
					<?php
						if($img_licencia_conducir==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_licencia_conducir?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_licencia_conducir?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">NIT</td>
					</tr>
					<?php
						if($img_nit==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_nit?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_nit?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>

			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Licencia TDA</td>
					</tr>
					<?php
						if($img_licencia_tenencia_armas==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_licencia_tenencia_armas?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_licencia_tenencia_armas?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Diploma ANSP</td>
					</tr>
					<?php
						if($img_diploma_ansp==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_diploma_ansp?>" style="width: 75px;height: 75px;"></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_diploma_ansp?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
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
					<?php
						if($img_solicitud==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_solicitud?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_solicitud?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Partida Nac.</td>
					</tr>
					<?php
						if($img_partida_nacimiento==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_partida_nacimiento?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_partida_nacimiento?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">A. Penales</td>
					</tr>
					<?php
						if($img_antecedentes_penales==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_antecedentes_penales?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_antecedentes_penales?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">Solv. PNC</td>
					</tr>
					<?php
						if($img_solvencia_pnc==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_solvencia_pnc?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_solvencia_pnc?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>

			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">C.Psicol&oacute;ogica</td>
					</tr>
					<?php
						if($img_constancia_psico==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_constancia_psico?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_constancia_psico?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
				</table>	
			</div>
			<div class="col-lg-2 col-xs-2" style="font-size: large;text-align: -webkit-center;">
				<table>
					<tr>
						<td style="font-size: small;text-align: center;font-weight: 600;">E.Poligr&aacute;afico</td>
					</tr>
					<?php
						if($img_examen_pol==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_examen_pol?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_examen_pol?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
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
					<?php
						if($img_huellas==""){
							?>
								<tr>
									<td><img src="vistas/img/usuarios/default/anonymous.png" style="width: 75px;height: 75px;" ></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td><img src="<?php echo  $img_huellas?>" style="width: 75px;height: 75px;" ></td>
								</tr>
								<tr>
									<td><button class="btn btn-primary fotoaImprimir"  fotoaImprimir="<?php echo $img_huellas?>"  data-toggle="modal" data-target="#modalImprimir" style="width: 100%;"><i class="fa fa-print"> </i></button></td>
								</tr>
							<?php
						}
					?>
					
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




<!--=====================================
MODAL modificar imagen
======================================-->
<div id="modificarimagen" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
		<!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Subir archivo</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">
            <!-- ENTRADA PARA CAMPOS  -->

			<form id="formudata" role="form" method="post" enctype= 'multipart/form-data'>

				<div class="">
								<label>Subir Archivo</label>
								<input type="file" class="form-control fotos" name="fotos">
								<input type="hidden" class="nombre_columna" name="nombre_columna">
								<input type="hidden" class="iddato" name="iddato" value="<?php echo $_POST["numDoc"]?>">
								<br>
								<div class="btn btn-primary subirimagen">Guardar</div>
				</div>
			</form>
			
          </div>
        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
      <!--     <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary" onclick="imprimirOrden('fotoEmpleado')">Imprimir </button> -->
        </div> 
    </div>
  </div>
</div>
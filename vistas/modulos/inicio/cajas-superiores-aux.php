<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

//extraer todos los registros de tbl permisos y almacenarlos en array 
$permisos = ControladorPermiso::ctrMostrarPermiso($item, $valor);

$maAFPArray = array();
$maDepartamentosArray = array();
$mo_TransaccionesArray = array();
foreach ($permisos as $key => $value){
    $nombre_control = $value["nombre_control"];
	
    if (strpos($nombre_control, 'ma_AFP') !== false) { // Verifica si 'ma_AFP' está presente en la columna 'nombre_control'
        $maAFPArray[] = $value; // Agrega el registro actual a $maAFPArray
    }
	if (strpos($nombre_control, 'mo_Departamentos') !== false) { 
        $maDepartamentosArray[] = $value;
    }
	if (strpos($nombre_control, 'mo_Transacciones') !== false) { 
        $mo_TransaccionesArray[] = $value;
    }
}










?>






<div class="container">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#administracion">Administración</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#equipos">Equipos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#clientes">Clientes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#proveedores">Proveedores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#colaboradores">Colaboradores</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#patrullas">Patrullas</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#formularios">Formularios</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#mantenimientos">Administrar Mantenimientos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#reportes">REPORTES</a>
    </li>
  </ul>

  <div class="tab-content">
    <div id="administracion" class="container tab-pane active">
      <!-- Contenido de la sección de Administración -->
      <!-- Coloca tu código aquí para la sección de Administración -->
	  
		
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>AFP</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-usd"></i>    
						</div>    
						<a href="afp" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			
			
		
			<?php			
			foreach ($maDepartamentosArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Departamentos</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-tachometer"></i>    
						</div>    
						<a href="departamentos" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			
			<?php			
			foreach ($mo_TransaccionesArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>ISR</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-money"></i>    
						</div>    
						<a href="isr" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Cargos</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-address-card"></i>    
						</div>    
						<a href="cargos" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Descuentos y Devengos</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-exchange"></i>    
						</div>    
						<a href="descuentos" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Planillas</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-file-powerpoint-o"></i>    
						</div>    
						<a href="planillas" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-3 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Colaboradores</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa fa-drivers-license-o"></i>    
						</div>    
						<a href="empleados" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Familia</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-users"></i>    
						</div>    
						<a href="familia" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tipo Armas</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="tipoarmas" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Armas</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-binoculars"></i>    
						</div>    
						<a href="armas" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Portaci&oacute;n Armas</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-address-card"></i>    
						</div>    
						<a href="portacionarma" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tipo Veh&iacute;culo</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="tipovehiculo" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Veh&iacute;culos</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-car"></i>    
						</div>    
						<a href="vehiculo" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tipo Bicicleta</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="tipobicicleta" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Bicicleta</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-bicycle"></i>    
						</div>    
						<a href="bicicleta" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tipo Radio</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="tiporadio" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Radios</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-tty"></i>    
						</div>    
						<a href="radio" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tipo Otros Eq.</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="tipootrosequipos" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Otros Equipos</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="equipos" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tipo Celular</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-sitemap"></i>    
						</div>    
						<a href="tipocelular" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Celulares</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-phone"></i>    
						</div>    
						<a href="celular" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Tarjetas SIM</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-print"></i>    
						</div>    
						<a href="sim" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Trans. Equipo</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-retweet"></i>    
						</div>    
						<a href="transaccionesequipo" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">
						<div class="inner">
						<p>Talleres</p>
						</div>
						<div class="icon">
						<i class="fa fa-building"></i>
						</div>
						<a href="talleres" class="small-box-footer">
						Más info <i class="fa fa-arrow-circle-right"></i>
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
		
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">
						<div class="inner">
						<p>Reparaciones</p>
						</div>
						<div class="icon">
						<i class="fa fa-cogs"></i>
						</div>
						<a href="reparaciones" class="small-box-footer">
						Más info <i class="fa fa-arrow-circle-right"></i>
						</a>
						</div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-3 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Clientes</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-users"></i>    
						</div>    
						<a href="clientes" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Trans. Personal</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-retweet"></i>    
						</div>    
						<a href="transaccionespersonal" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-3 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Proveedores</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-users"></i>    
						</div>    
						<a href="proveedores" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Bancos</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-university"></i>    
						</div>    
						<a href="bancos" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Pa&iacute;ses</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-globe"></i>    
						</div>    
						<a href="paises" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Seminarios</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-trophy"></i>    
						</div>    
						<a href="seminarios" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Servicios</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-cube"></i>    
						</div>    
						<a href="servicios" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-3 col-xs-6">
					  <div class="small-box " style="background-color: #222d32eb;color: #ffb002;">    
						<div class="inner">    
						  <p>Vendedores</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-users"></i>    
						</div>    
						<a href="vendedor" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
			<?php			
			foreach ($maAFPArray as $registro) {
				if (strpos($registro['nombre_perfil'], "Gerencia General") !== false) {
					?>
					<div class="col-lg-2 col-xs-6">
					  <div class="small-box " style="background-color: #2b2468;color: #ffb002;">    
						<div class="inner">    
						  <p>Portaci&oacute;n Armas</p>    
						</div>    
						<div class="icon">      
						  <i class="fa fa-address-card"></i>    
						</div>    
						<a href="portacionarma" class="small-box-footer">      
						  Más info <i class="fa fa-arrow-circle-right"></i>    
						</a>
					  </div>
					</div>
					<?php
					break;
				}
			}			
			?>
		
		
		
		
		
		
    </div>

    <div id="equipos" class="container tab-pane fade">
      <!-- Contenido de la sección de Equipos -->
      <!-- Coloca tu código aquí para la sección de Equipos -->
    </div>

    <div id="clientes" class="container tab-pane fade">
      <!-- Contenido de la sección de Clientes -->
      <!-- Coloca tu código aquí para la sección de Clientes -->
    </div>

    <div id="proveedores" class="container tab-pane fade">
      <!-- Contenido de la sección de Proveedores -->
      <!-- Coloca tu código aquí para la sección de Proveedores -->
    </div>

    <div id="colaboradores" class="container tab-pane fade">
      <!-- Contenido de la sección de Colaboradores -->
      <!-- Coloca tu código aquí para la sección de Colaboradores -->
    </div>

    <div id="patrullas" class="container tab-pane fade">
      <!-- Contenido de la sección de Patrullas -->
      <!-- Coloca tu código aquí para la sección de Patrullas -->
    </div>

    <div id="formularios" class="container tab-pane fade">
      <!-- Contenido de la sección de Formularios -->
      <!-- Coloca tu código aquí para la sección de Formularios -->
    </div>

    <div id="mantenimientos" class="container tab-pane fade">
      <!-- Contenido de la sección de Administrar Mantenimientos -->
      <!-- Coloca tu código aquí para la sección de Administrar Mantenimientos -->
    </div>

    <div id="reportes" class="container tab-pane fade">
      <!-- Contenido de la sección de Reportes -->
      <!-- Coloca tu código aquí para la sección de Reportes -->
    </div>
  </div>
</div>
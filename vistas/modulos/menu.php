<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '
			<li >			
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>
			<li class="treeview">

				<a href="#">

					<i class="fa fa-sitemap"></i>
					
					<span>Administrar</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>
						<a href="usuarios">
							<i class="fa fa-user"></i>
							<span>Usuarios</span>
						</a>
					</li>
					<li>
						<a href="empresas">
							<i class="fa fa-building"></i>
							<span>Empresas</span>
						</a>
					</li>
					<li>
						<a href="departamentos">
							<i class="fa fa-tachometer"></i>
							<span>Departamentos </span>
						</a>
					</li>
					<li>
						<a href="cargos">
							<i class="fa fa-address-card"></i>
							<span>Cargos</span>
						</a>
					</li>
					<li>
						<a href="afp">
							<i class="fa fa-usd"></i>
							<span>AFP</span>
						</a>
					</li>
					<li>
						<a href="isr">
							<i class="fa fa-money"></i>
							<span>ISR</span>
						</a>
					</li>
					<li>
						<a href="periodos">
							<i class="fa fa-calendar"></i>
							<span>Per&iacute;odos de Pagos</span>
						</a>
					</li>
					<li>
						<a href="paises">
							<i class="fa fa-globe"></i>
							<span>Pa&iacute;ses</span>
						</a>
					</li>
					<li>
						<a href="bancos">
							<i class="fa fa-university"></i>
							<span>Bancos</span>
						</a>
					</li>
					<li>
						<a href="servicios">
							<i class="fa fa-cube"></i>
							<span>Servicios</span>
						</a>
					</li>
					<li>
						<a href="proveedores">
							<i class="fa fa-users"></i>
							<span>Proveedores</span>
						</a>
					</li>		
					<li>
						<a href="clientes">
							<i class="fa fa-users"></i>
							<span>Clientes</span>
						</a>
					</li>
					<li>
						<a href="seminarios">
							<i class="fa fa-trophy"></i>
							<span>Seminarios</span>
						</a>
					</li>
					<li>
						<a href="planillas">
							<i class="fa fa-file-powerpoint-o"></i>
							<span>Planillas</span>
						</a>
					</li>
					<li>
						<a href="descuentos">
							<i class="fa fa-exchange"></i>
							<span>Devengos y Descuentos</span>
						</a>
					</li>
					<li>
						<a href="sim">
							<i class="fa fa-print"></i>
							<span>Tarjeta SIM</span>
						</a>
					</li>
					<li>
						<a href="familia">
							<i class="fa fa-users"></i>
							<span>Familia</span>
						</a>
					</li>
					<li>
						<a href="tipoarmas">
							<i class="fa fa-sitemap"></i>
							<span>Tipo de Armas</span>
						</a>
					</li>
					<li>
						<a href="armas">
							<i class="fa fa-binoculars"></i>
							<span>Armas</span>
						</a>
					</li>
					<li>
						<a href="tipovehiculo">
							<i class="fa fa-sitemap"></i>
							<span>Tipo Vehiculo</span>
						</a>
					</li>
					<li>
						<a href="vehiculo">
							<i class="fa fa-car"></i>
							<span>Vehiculo</span>
						</a>
					</li>
					<li>
						<a href="tipobicicleta">
							<i class="fa fa-sitemap"></i>
							<span>Tipo Bicicleta</span>
						</a>
					</li>
					<li>
						<a href="bicicleta">
							<i class="fa fa-bicycle"></i>
							<span>Bicicleta</span>
						</a>
					</li>
					<li>
						<a href="tiporadio">
							<i class="fa fa-sitemap"></i>
							<span>Tipo Radio</span>
						</a>
					</li>
					<li>
						<a href="radio">
							<i class="fa fa-tty"></i>
							<span>Radio</span>
						</a>
					</li>
					<li>
						<a href="tipootrosequipos">
							<i class="fa fa-sitemap"></i>
							<span>Tipo Otros Equipos</span>
						</a>
					</li>
					<li>
						<a href="equipos">
							<i class="fa fa-sitemap"></i>
							<span>Otros Equipos</span>
						</a>
					</li>
					<li>
						<a href="tipocelular">
							<i class="fa fa-sitemap"></i>
							<span>Tipo Celular</span>
						</a>
					</li>
					<li>
						<a href="celular">
							<i class="fa fa-phone"></i>
							<span> Celular</span>
						</a>
					</li>
					<li>
						<a href="transaccionesequipo">
							<i class="fa fa-retweet"></i>
							<span>Transacciones Equipo</span>
						</a>
					</li>
				
					<li>
						<a href="transaccionespersonal">
							<i class="fa fa-retweet"></i>
							<span>Transacciones Personal</span>
						</a>
					</li>
					<li>
						<a href="ubicacionc">
							<i class="fa fa-sitemap"></i>
							<span>Ubicacion Cliente</span>
						</a>
					</li>
					<li>
						<a href="portacionarma">
							<i class="fa fa-address-card"></i>
							<span>Portación de Arma</span>
						</a>
					</li>
					

					<li>
						<a href="personalnocontratable">
							<i class="fa fa-user"></i>
							<span>Personal no Contratable</span>
						</a>
					</li>

					<li>
						<a href="retiro">
							<i class="fa fa-users"></i>
							<span>Personal Retirado</span>
						</a>
					</li>
					


					
				</ul>
			</li>
			<li class="treeview">
				<a href="#">

					<i class="fa fa-users"></i>
					
					<span>Proveedor</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
				
					 <li>
						<a href="pedido">
							<i class="fa fa-shopping-bag"></i>
							<span>Pedidos</span>
						</a>
					</li>
				</ul>
				
			</li>
			<li >
					<a href="empleados">

					<i class="fa fa fa-drivers-license-o"></i>
					
					<span>Empleados</span>
					
					

					</a>
				</li>
			
			<li class="treeview">
				<a href="#">

					<i class="fa  fa-address-book"></i>
					
					<span>Patrulla</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
				
					 <li>
						<a href="patrulla">
							<i class="fa  fa-address-book"></i>
							<span>Patrulla</span>
						</a>
					</li>
				</ul>
				
			</li>
			<li class="treeview">
				<a href="#">

					<i class="fa  fa fa-eye"></i>
					
					<span>Formularios</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
				
					 <li>
						<a href="jefeoperacion">
							<i class="fa  fa fa-circle-o"></i>
							<span>Visita Jefe Operaciones</span>
						</a>
					</li>
				</ul>
				
			</li>

			<li class="treeview">
				<a href="#">

					<i class="fa  fa  fa-plug"></i>
					
					<span>Formularios</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
				
					 <li>
						<a href="ajustes">
							<i class="fa  fa fa-circle-o"></i>
							<span>Ajustes</span>
						</a>
					</li>
				</ul>
				
			</li>
			
			
			<li class="treeview">
				<a href="#">

					<i class="fa  fa  fa-wrench"></i>
					
					<span>Configuración</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
				
					 <li>
						<a href="configuracion">
							<i class="fa  fa fa-wrench"></i>
							<span>Configuración</span>
						</a>
					</li>
				</ul>
				
			</li>
			
			';


				

		}

		

		

		

		?>

		</ul>

	 </section>

</aside>
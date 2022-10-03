<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '
				<li class="active">			
					<a href="inicio">
						<i class="fa fa-home"></i>
						<span>Inicio</span>
					</a>
				</li>
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
					<a href="proveedores">
						<i class="fa fa-users"></i>
						<span>Proveedores</span>
					</a>
				</li>
				<li>
					<a href="bancos">
						<i class="fa fa-university"></i>
						<span>Bancos</span>
					</a>
				</li>
				<li>
					<a href="paises">
						<i class="fa fa-globe"></i>
						<span>Paises</span>
					</a>
				</li>
				<li>
					<a href="departamentos">
						<i class="fa fa-tachometer"></i>
						<span>Departamentos Empresa</span>
					</a>
				</li>
				<li>
					<a href="afp">
						<i class="fa fa-usd"></i>
						<span>AFP</span>
					</a>
				</li>
				<li>
					<a href="servicios">
						<i class="fa fa-cube"></i>
						<span>Servicios</span>
					</a>
				</li>
				<li>
					<a href="cargos">
						<i class="fa fa-cube"></i>
						<span>cargos</span>
					</a>
				</li>';

		}

		

		

		

		?>

		</ul>

	 </section>

</aside>
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
				</li>';

		}

		

		

		

		?>

		</ul>

	 </section>

</aside>
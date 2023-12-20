<?php
if (isset($_SESSION["iniciarSesion"])) {
	logs_msg("Usuario", "Cerrar Sessión");
	ModeloLogsUser::ActualizarLogs($_SESSION["id_logs"]);
}


session_destroy();

echo '<script>

	window.location = "ingreso";

</script>';

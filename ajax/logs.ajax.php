<?php
session_start();
require_once "../modelos/logs.modelo.php";

class Logins_logs
{

    /*=============================================
	EDITAR CATEGORÍA
	=============================================*/

    public $id_usuario;
    public $fecha_inicio;
    public $fecha_fin;

    public function ajaxConsultarLoginsLogs()
    {

        $valor = $this->id_usuario;
        $condicion = "";

        if (!empty($valor) && $valor !== null) {
            $condicion = "logs.id_usuario=" . $valor;
        }

        $between = "";

        $fecha1 = $this->fecha_inicio;
        $fecha2 = $this->fecha_fin;

        if (!empty($fecha1) && !empty($fecha2)) {
            if ($fecha2 < $fecha1) {
                $temp = $fecha1; // Almacena temporalmente $fecha1 en una variable temporal
                $fecha1 = $fecha2; // Asigna $fecha2 a $fecha1
                $fecha2 = $temp; // Asigna el valor original de $fecha1 a $fecha2
            }
            $between = "DATE_FORMAT(logs.fecha_hora, '%Y-%m-%d') BETWEEN '" . $fecha1 . "' AND '" . $fecha2 . "'";
        } elseif (!empty($fecha1) && empty($fecha2)) {
            $between = "DATE_FORMAT(logs.fecha_hora, '%Y-%m-%d') BETWEEN '" . $fecha1 . "' AND '" . $fecha1 . "'";
        } elseif (empty($fecha1) && !empty($fecha2)) {
            $between = "DATE_FORMAT(logs.fecha_hora, '%Y-%m-%d') BETWEEN '" . $fecha2 . "' AND '" . $fecha2 . "'";
        }

        $condicionFinal = "";
        if (!empty($condicion) && !empty($between)) {
            $condicionFinal = $between . " AND " . $condicion;
        } else  if (!empty($between)) {
            $condicionFinal = $between;
        } else {
            $condicionFinal = $condicion;
        }
        $Nuevacondicion = "";
        if ($_SESSION["perfil"] != "Administrador") {
            if ($valor > 0) {
                $Nuevacondicion = " and logs.id_usuario=" . $_SESSION["id"];
            } else {
                $Nuevacondicion = " logs.id_usuario=" . $_SESSION["id"];
                if (!empty($between)) {
                    $Nuevacondicion = " and logs.id_usuario=" . $_SESSION["id"];
                }
            }
        }

        $condicionFinal = $condicionFinal . $Nuevacondicion;

        $campos = "logs.*, user.nombre";
        $tabla = "tbl_logs logs INNER JOIN usuarios user ON logs.id_usuario=user.id";

        $respuesta = ModeloLogsUser::mostrarDatosLogs($campos, $tabla, $condicionFinal, " ORDER BY logs.fecha_hora desc");
        return $respuesta;
    }


    public $id_usuario_logs;
    public $fecha_inicio_logs;
    public $fecha_fin_logs;

    public function ajaxConsultarLoginsLogs_Activity()
    {

        $id = $this->id_usuario_logs;


        $between = "";

        $fecha1 = $this->fecha_inicio_logs;
        $fecha2 = $this->fecha_fin_logs;

        if (!empty($fecha1) && !empty($fecha2)) {
            if ($fecha2 < $fecha1) {
                $temp = $fecha1; // Almacena temporalmente $fecha1 en una variable temporal
                $fecha1 = $fecha2; // Asigna $fecha2 a $fecha1
                $fecha2 = $temp; // Asigna el valor original de $fecha1 a $fecha2
            }
            $between = "DATE_FORMAT(fecha_hora, '%Y-%m-%d') BETWEEN '" . $fecha1 . "' AND '" . $fecha2 . "' AND ";
        } elseif (!empty($fecha1) && empty($fecha2)) {
            $between = "DATE_FORMAT(fecha_hora, '%Y-%m-%d') BETWEEN '" . $fecha1 . "' AND '" . $fecha1 . "' AND ";
        } elseif (empty($fecha1) && !empty($fecha2)) {
            $between = "DATE_FORMAT(fecha_hora, '%Y-%m-%d') BETWEEN '" . $fecha2 . "' AND '" . $fecha2 . "' AND ";
        }
        $condicion =  $between . "id_logs=" . $id;

        $campos = "*";
        $tabla = "tbl_actions_logs";

        $respuesta = ModeloLogsUser::mostrarDatosLogs($campos, $tabla, $condicion, "");
        return $respuesta;
    }

    public function mostrarTablaLogs()
    {

        $datos = self::ajaxConsultarLoginsLogs();


        $data = array();

        for ($i = 0; $i < count($datos); $i++) {

            $objeto = new  DateTime($datos[$i]["fecha_hora"]);
            $objetofin = new  DateTime($datos[$i]["fecha_fin"]);

            $diferencia_formateada = "00:00";
            if ($datos[$i]["fecha_fin"] != null && $datos[$i]["fecha_hora"] != null) {

                // Calcula la diferencia
                $intervalo = $objeto->diff($objetofin);
                $diferencia_segundos = $intervalo->s + ($intervalo->i * 60) + ($intervalo->h * 3600);

                // Formatea la diferencia en horas, minutos y segundos
                $diferencia_formateada = sprintf("%02d:%02d:%02d", floor($diferencia_segundos / 3600), floor(($diferencia_segundos % 3600) / 60), $diferencia_segundos % 60);
            }


            if (strtoupper($datos[$i]["estado"]) === "ACTIVO") {

                $btnActivar =  '<button class="btn btn-success bg-success btn-xs btnActivar" >Activado</button>';
            } else {

                $btnActivar = '<button class="btn btn-default bg-gray btn-xs btnActivar">Inactivo</button>';
            }

            $botones = '<button class="btn bg-purple btn-xs btnViewLogs" onclick="ViewLogs(\'' . $datos[$i]['id'] . '\', \'' . $datos[$i]['nombre'] . '\')" data-toggle="modal" data-target="#MyModalDetailLogs"> <span> <i class="fa fa-history"></i></span></button>';




            $row = array(
                $i + 1,
                $datos[$i]["nombre"],
                $objeto->format("l, d/m/Y h:i:s A"),
                $datos[$i]["fecha_fin"] != null ? $objetofin->format("l, d/m/Y h:i:s A") : "00:00:00",
                $diferencia_formateada . " H:m:s",
                $datos[$i]["dispositivo"],
                $datos[$i]["ip"],
                $btnActivar,
                $botones
            );

            $data[] = $row;
        }

        $response = array("data" => $data);
        echo json_encode($response);
    }
}


/*=============================================
EDITAR MOSTRAR DATA
=============================================*/
if (isset($_GET["idUsuario"]) && $_GET["actionsUser"]) {

    if (isset($_SESSION["perfil"])) {
        $logins_logs = new Logins_logs();
        $logins_logs->id_usuario = is_numeric($_GET["idUsuario"]) ? $_GET["idUsuario"] : null;
        $logins_logs->fecha_inicio =  (DateTime::createFromFormat('Y-m-d', $_GET["fecha_inicio_logs"]) ? $_GET["fecha_inicio_logs"] : null);;
        $logins_logs->fecha_fin  =   (DateTime::createFromFormat('Y-m-d', $_GET["fecha_fin_logs"]) ? $_GET["fecha_fin_logs"] : null);
        $logins_logs->mostrarTablaLogs();
    }
} elseif (isset($_POST["idUsuarioLogs"]) && $_POST["actionsUserLogs"]) {

    $logins_logs_acti = new Logins_logs();
    $logins_logs_acti->id_usuario_logs = $_POST["idUsuarioLogs"];
    $logins_logs_acti->fecha_inicio_logs = $_POST["fecha_inicio_act"];
    $logins_logs_acti->fecha_fin_logs = $_POST["fecha_fin_act"];
    $datos =  $logins_logs_acti->ajaxConsultarLoginsLogs_Activity();
?>

    <script>
        $(document).ready(function() {
            var tabla = $('.historialuserlogs').DataTable();

            tabla.order([
                [0, 'desc']
            ]).draw();
        });
    </script>

    <table class="table table-bordered table-striped dt-responsive historialuserlogs" width="100%">

        <thead>
            <tr>
                <th style="width: 4%;">#</th>
                <th style="width: 25%;">Fecha y Hora</th>
                <th>Módulo</th>
                <th>Descripción Actividad</th>
                <th>URL</th>

            </tr>

        </thead>

        <tbody>
            <?php

            $cont = 0;
            foreach ($datos as $key => $value) {

                $objeto = new  DateTime($value["fecha_hora"]);
            ?>
                <tr>
                    <td><?php echo $cont + 1 ?></td>
                    <td><?php echo $objeto->format("l, d/m/Y h:i:s A"); ?></td>
                    <td><?php echo $value["descripcion_modulo"] ?></td>
                    <td><?php echo $value["descripcion_actividad"] ?></td>
                    <td><span class="text-blue"><?php echo $value["urll"] ?></span></td>


                </tr>
            <?php
                $cont++;
            }
            ?>
        </tbody>

    </table>

<?php
}

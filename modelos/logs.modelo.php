<?php
require_once "conexion.php";

use UAParser\Parser;

class ModeloLogsUser
{

    static public function IngresarLogs($datos)
    {
        date_default_timezone_set('America/El_Salvador');

        // Ahora puedes usar funciones de fecha y hora en El Salvador
        $fechaActual = date('Y-m-d H:i:s');
        $dispositivo = self::getClientInfo();
        $ip = self::getClientIP();

        $stmt = Conexion::conectar()->prepare("INSERT INTO tbl_logs(id_usuario,fecha_hora,dispositivo,ip) VALUES (:id_usuario,:fecha_hora,:dispositivo, :ip)");

        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(":dispositivo", $dispositivo, PDO::PARAM_STR);
        $stmt->bindParam(":ip", $ip, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return true;
        } else {

            return false;
        }

        $stmt->close();

        $stmt = null;
    }

    static public function IngresarActionsLogs($datos)
    {
        date_default_timezone_set('America/El_Salvador');
        // Ahora puedes usar funciones de fecha y hora en El Salvador
        $fechaActual = date('Y-m-d H:i:s');
        $url = self::getUrl();

        $stmt = Conexion::conectar()->prepare("INSERT INTO tbl_actions_logs(id_logs,fecha_hora,descripcion_modulo,descripcion_actividad,urll) VALUES (:id_logs,:fecha_hora,:descripcion_modulo,:descripcion_actividad,:urll)");

        $stmt->bindParam(":id_logs", $datos["id_logs"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_hora", $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_modulo", $datos["modulo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_actividad", $datos["actividad"], PDO::PARAM_STR);
        $stmt->bindParam(":urll", $url, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
        $stmt = null;
    }



    static public function ActualizarLogs($id)
    {
        date_default_timezone_set('America/El_Salvador');
        // Ahora puedes usar funciones de fecha y hora en El Salvador
        $fechaActual = date('Y-m-d H:i:s');
        $estado = "Inactivo";
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_logs SET fecha_fin=:fecha_fin,estado=:estado WHERE id=:id;");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":fecha_fin", $fechaActual, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return true;
        } else {

            return false;
        }

        $stmt->close();

        $stmt = null;
    }

    /* OBTENER EL ÚLTIMO LOGS  */
    static public function LogsObtenerUltimoRegistro()
    {
        try {
            $query = "SELECT MAX(id) as idr FROM tbl_logs";
            $stmt = Conexion::conectar()->prepare($query);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return $resultado['idr'];
            } else {
                return null; // No se encontraron registros
            }
        } catch (PDOException $e) {
            // Manejo de errores en caso de problemas con la consulta
            // Puedes personalizar esto según tus necesidades
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    /* MOSTRAR DATOS LOGS */
    static public function mostrarDatosLogs($campos, $tabla, $condicion, $array)
    {
        try {
            if (empty($condicion)) {
                $stm = Conexion::conectar()->prepare("SELECT " . $campos . " FROM " . $tabla);
                $stm->execute();
            } else {
                $stm = Conexion::conectar()->prepare("SELECT " . $campos . " FROM " . $tabla . " WHERE " . $condicion);
                $stm->execute();
            }

            return $stm->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /* OBTENER URL */
    static private function getUrl()
    {
        // Obtiene el protocolo (http o https)
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

        // Obtiene el nombre del host (dominio)
        $host = $_SERVER['HTTP_HOST'];

        // Obtiene la URI (Uniform Resource Identifier) actual
        $uri = $_SERVER['REQUEST_URI'];

        // Combina las partes para formar la URL completa
        $url = $protocol . '://' . $host . $uri;
        return $url;
    }


    public static function getClientInfo()
    {
        $ip = $_SERVER["REMOTE_ADDR"] ?? "";

        // Obtiene la dirección IP del cliente
        $clientIP = self::getClientIP();

        // Obtiene la información del agente de usuario
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $parseador = Parser::create();
        $resultado = $parseador->parse($userAgent);

        $familiaNavegador = $resultado->ua->family;
        $navegador = $resultado->ua->toString();
        $dispositivo = $resultado->device->family;
        $familiaSistema = $resultado->os->family;
        $sistema = $resultado->os->toString();
        $completo = $resultado->toString();

        // Obtiene información de geolocalización
        $clientInfo = self::getClientGeoInfo($clientIP);

        // Formatea el mensaje final
        $message = "IP: $clientIP, $completo, $clientInfo";

        return $message;
    }

    public static function getClientIP()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    private static function getClientGeoInfo($ip)
    {
        $json = file_get_contents("https://ipgeolocation.abstractapi.com/v1/?api_key=f514d62515054b5c84af25b733951d92&ip_address=$ip");
        $json = json_decode($json, true);

        $country = isset($json['country']) ? $json['country'] : "";
        $region = isset($json['region']) ? $json['region'] : "";
        $city = isset($json['city']) ? $json['city'] : "";
        $org = isset($json['connection']["autonomous_system_organization"]) ? $json['connection']["autonomous_system_organization"] : "";
        $cable = isset($json['connection']["connection_type"]) ? $json['connection']["connection_type"] : "";

        return "$country, $region, $city,$org,$cable";
    }
}

function logs_msg($modulo, $actividad)
{
    if (isset($_SESSION['iniciarSesion'])) {
        ModeloLogsUser::IngresarActionsLogs(array("id_logs" => $_SESSION["id_logs"], "modulo" => $modulo, "actividad" => $actividad));
    }
}

/* 
$clase = new ModeloLogsUser();
echo $clase::LogsObtenerUltimoRegistro(); */

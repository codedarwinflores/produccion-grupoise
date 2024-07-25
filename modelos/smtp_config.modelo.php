<?php

require_once "conexion.php";

class ModeloConfigSMTP
{
    /*=============================================
	MOSTRAR ConfigSMTP
	=============================================*/

    static public function mdlMostrarConfigSMTP($campos, $tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT $campos FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
	REGISTRO DE ConfigSMTP
	=============================================*/

    static public function mdlIngresarConfigSMTP($tabla, $datos)
    {

        if ($datos["idsmtp"] > 0) {
            if ($datos["clave_remitente"] != "") {
                $clave = self::encrypt_password($datos["clave_remitente"]);
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET server_smtp=:server_smtp,server_puerto=:server_puerto,titulo_remitente=:titulo_remitente,correo_remitente=:correo_remitente,clave_remitente=:clave_remitente WHERE id=:id");

                $stmt->bindParam(":clave_remitente", $clave, PDO::PARAM_STR);
            } else {
                $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET server_smtp=:server_smtp,server_puerto=:server_puerto,titulo_remitente=:titulo_remitente,correo_remitente=:correo_remitente WHERE id=:id");
            }


            $stmt->bindParam(":id", $datos["idsmtp"], PDO::PARAM_INT);
            $stmt->bindParam(":server_smtp", $datos["server_smtp"], PDO::PARAM_STR);
            $stmt->bindParam(":server_puerto", $datos["server_puerto"], PDO::PARAM_INT);
            $stmt->bindParam(":titulo_remitente", $datos["titulo_remitente"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_remitente", $datos["correo_remitente"], PDO::PARAM_STR);
        } else {
            $clave = self::encrypt_password($datos["clave_remitente"]);
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(server_smtp,server_puerto,titulo_remitente,correo_remitente,clave_remitente) VALUES (:server_smtp, :server_puerto,:titulo_remitente,:correo_remitente,:clave_remitente)");
            $stmt->bindParam(":server_smtp", $datos["server_smtp"], PDO::PARAM_STR);
            $stmt->bindParam(":server_puerto", $datos["server_puerto"], PDO::PARAM_INT);
            $stmt->bindParam(":titulo_remitente", $datos["titulo_remitente"], PDO::PARAM_STR);
            $stmt->bindParam(":correo_remitente", $datos["correo_remitente"], PDO::PARAM_STR);
            $stmt->bindParam(":clave_remitente", $clave, PDO::PARAM_STR);
        }


        if ($stmt->execute()) {

            return true;
        } else {

            return false;
        }

        $stmt->close();

        $stmt = null;
    }

    static public function encrypt_password($password)
    {
        $key = "DarwinFlores2024...Armonico";
        // Genera un IV aleatorio
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encripta la contraseña
        $encrypted_password = openssl_encrypt($password, 'aes-256-cbc', $key, 0, $iv);
        // Combina la contraseña encriptada y el IV, luego conviértelo a base64
        return base64_encode($encrypted_password . '::' . $iv);
    }
}

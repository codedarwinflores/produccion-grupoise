<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CryptoUtils
{
    private $cipher = 'aes-256-cbc';
    private $key;

    public function __construct()
    {
        // Configura la clave por defecto (debe tener 32 bytes para AES-256)
        $this->key = 'DarwinFlores2024...Armonico'; // Asegúrate de que la clave tenga la longitud adecuada
    }

    public function encryptPassword($password)
    {
        // Genera un IV aleatorio
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        // Encripta la contraseña
        $encrypted_password = openssl_encrypt($password, $this->cipher, $this->key, 0, $iv);
        // Combina la contraseña encriptada y el IV, luego conviértelo a base64
        return base64_encode($encrypted_password . '::' . $iv);
    }

    public function decryptPassword($encrypted_password_base64)
    {
        // Separa la contraseña encriptada y el IV
        list($encrypted_password, $iv) = explode('::', base64_decode($encrypted_password_base64), 2);
        // Desencripta la contraseña
        return openssl_decrypt($encrypted_password, $this->cipher, $this->key, 0, $iv);
    }

    public function generateRandomCode($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomCode;
    }
}



class Mailer_Send
{
    private $mail;
    private $config;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->config = $this->getConfigFromDatabase();
        $crypto = new CryptoUtils();
        $clave = $crypto->decryptPassword($this->config['clave_remitente']);
        // Configura el servidor SMTP
        $this->mail->isSMTP();
        $this->mail->Host = $this->config['server_smtp'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->config['correo_remitente'];
        $this->mail->Password = $clave;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = $this->config['server_puerto'];
        $this->mail->CharSet = 'UTF-8'; // Establecer la codificación de caracteres a UTF-8
    }

    private function getConfigFromDatabase()
    {
        // Realiza la conexión a la base de datos y obtiene la configuración
        try {
            $pdo = Conexion::conectar(); // Usa la conexión establecida en tu archivo de conexión
            $stmt = $pdo->query("SELECT * FROM server_mail_smtp LIMIT 1");
            $config = $stmt->fetch(PDO::FETCH_ASSOC);
            return $config;
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function sendEmail($to, $subject, $message, $token, $usuario)
    {
        try {
            // Configura el correo
            $this->mail->setFrom($this->config['correo_remitente'], $this->config['titulo_remitente']);
            $this->mail->addAddress($to);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $this->createTemplate($message, $token, $usuario);
            $this->mail->AltBody = strip_tags($message);

            // Envía el correo
            $this->mail->send();
            return true; // El mensaje se envió correctamente
        } catch (Exception $e) {
            return false; // Hubo un error al enviar el mensaje
        }
    }

    private function createTemplate($message, $token, $usuario)
    {
        return "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Email Template - Grupo ISE</title>
                <style>
                    .email-container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                        background-color: #fff;
                        background-image: url('https://grupoise.com/wp-content/uploads/2023/04/2.jpg');
                        background-size: cover;
                        background-position: center;
                    }
                    .email-content {
                      border-radius: 6px;
                        padding: 20px;
                        background: rgba(255, 255, 255, 0.8);
                    }
                    .recovery-token {
                        font-weight: bold;
                        color: #ff0000;
                        background-color: #f0f0f0;
                        padding: 5px;
                        border-radius: 5px;
                    }
                </style>
            </head>
            <body style='font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;'>
                <div class='email-container'>
                    <div style='text-align: center; padding: 10px 0;'>
                        <img src='https://grupoise.com/wp-content/uploads/2023/04/logo_ise_180x60.png' alt='Logo' style='max-width: 150px;'>
                    </div>
                    <div class='email-content'>
                        <p><strong>Estimado/a:</strong> $usuario</p>
                        <p>$message</p>
                        <p>Su código es: <span class='recovery-token'>$token</span></p>
                        <p>Saludos cordiales,</p>
                        <p>ARMONICO S.A. DE C.V. - Soporte y Desarrollo Web </p>
                    </div>
                    <div style='text-align: center; padding: 10px 0; font-size: 15px; color: #fff;'>
                        &copy; 2024 GRUPO ISE DE CENTROAMÉRICA. Todos los derechos reservados.
                    </div>
                </div>
            </body>
            </html>";
    }
}

<?php

class CaptchaGenerator
{
    private $image_width = 280;
    private $image_height = 50;
    private $characters_on_image = 6;
    private $font;
    private $possible_letters = '23456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ'; // Añadir símbolos aquí
    private $random_dots = 30;
    private $random_lines = 20;
    private $captcha_text_color = "0x142866";
    private $captcha_noice_color = "0x142864";
    private $code;

    public function __construct($font_path)
    {
        $this->font = realpath($font_path);
    }

    public function generateCode()
    {
        $this->code = '';
        for ($i = 0; $i < $this->characters_on_image; $i++) {
            $this->code .= substr($this->possible_letters, mt_rand(0, strlen($this->possible_letters) - 1), 1);
        }
        $_SESSION['code_confirmation'] = $this->code;
    }

    private function hexrgb($hexstr)
    {
        $int = hexdec($hexstr);
        return array(
            "red" => 0xFF & ($int >> 0x10),
            "green" => 0xFF & ($int >> 0x8),
            "blue" => 0xFF & $int
        );
    }

    public function createImage()
    {
        $font_size = $this->image_height * 0.80;
        $image = @imagecreate($this->image_width, $this->image_height);

        /* setting the background, text and noise colours here */
        $background_color = imagecolorallocate($image, 255, 255, 255);

        $arr_text_color = $this->hexrgb($this->captcha_text_color);
        $text_color = imagecolorallocate($image, $arr_text_color['red'], $arr_text_color['green'], $arr_text_color['blue']);

        $arr_noice_color = $this->hexrgb($this->captcha_noice_color);
        $image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], $arr_noice_color['green'], $arr_noice_color['blue']);

        /* generating the dots randomly in background */
        for ($i = 0; $i < $this->random_dots; $i++) {
            imagefilledellipse($image, mt_rand(0, $this->image_width), mt_rand(0, $this->image_height), 2, 3, $image_noise_color);
        }

        /* generating lines randomly in background of image */
        for ($i = 0; $i < $this->random_lines; $i++) {
            imageline($image, mt_rand(0, $this->image_width), mt_rand(0, $this->image_height), mt_rand(0, $this->image_width), mt_rand(0, $this->image_height), $image_noise_color);
        }

        /* create a text box and add 6 letters code in it */
        $textbox = imagettfbbox($font_size, 0, $this->font, $this->code);
        $x = ($this->image_width - $textbox[4]) / 2;
        $y = ($this->image_height - $textbox[5]) / 2;
        imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font, $this->code);

        return $image;
    }

    public function showCaptcha()
    {
        $this->generateCode();
        $image = $this->createImage();
        header('Content-Type: image/jpeg');
        imagejpeg($image);
        imagedestroy($image);
    }
}

// Ejemplo de uso
session_start();
$captcha = new CaptchaGenerator('./monofont.ttf');
$captcha->showCaptcha();

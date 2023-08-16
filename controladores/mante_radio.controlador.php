<?php
require_once "../modelos/mante_radio.modelo.php";
/* cambiar _tiporadios por el nombre de la table correspondiente */
$Nombremodulo_mensaje_mante_radio = "mante_radio";
$nombremodelo_mante_radio = "mante_radio";
$namecolumnas__mante_radio = "";
$namecampos_mante_radio = "";
$nombretabla_mate_radio_mante_radio = "mante_radio";
$tabla_mante_radio = "mante_radio";


/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_mate_radio_mante_radio;
    $query = "SHOW COLUMNS FROM $nombretabla_mate_radio_mante_radio";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}




/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

if (isset($_GET["action"])) {
    # code...


    if (isset($_POST["nuevoidradio_mante"])) {



        global $tabla_mante_radio;
        global $namecolumnas__mante_radio;
        global $namecampos_mante_radio;
        global $Nombremodulo_mensaje_mante_radio;
        global $nombremodelo_mante_radio;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],);
            /* $namecolumnas__mante_radio .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],];
        }

        $datos = $array;
        $respuesta = ModeloManteRadio::mdlIngresar($tabla_mante_radio, $datos);

        if ($respuesta == "ok") {

            echo 'ok';
        } else {
            echo "error";
        }
    }
}


/*=============================================
	EDITAR REGISTRO
	=============================================*/

if (isset($_GET["edit"])) {
    if (isset($_POST["editarid"])) {



        global $tabla_mante_radio;
        global $namecolumnas__mante_radio;
        global $namecampos_mante_radio;
        global $Nombremodulo_mensaje_mante_radio;
        global $nombremodelo_mante_radio;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],);
            /* $namecolumnas__mante_radio .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],];
        }

        $datos = $array;


        /* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

        $respuesta = ModeloManteRadio::mdlEditar($tabla_mante_radio, $datos);

        if ($respuesta == "ok") {
            echo "ok";
        } else {
            echo "error";
        }
    }
}

/*=============================================
	BORRAR REGISTROS
	=============================================*/

if (isset($_GET["borrar"])) {
    # code...


    if (isset($_GET["id_mante"])) {

        global $tabla_mante_radio;
        global $namecolumnas__mante_radio;
        global $namecampos_mante_radio;
        global $Nombremodulo_mensaje_mante_radio;
        global $nombremodelo_mante_radio;
        $datos = $_GET["id_mante"];


        $respuesta = ModeloManteRadio::mdlBorrar($tabla_mante_radio, $datos);

        if ($respuesta == "ok") {

            echo "ok";
        } else {
            echo "error";
        }
    }
}

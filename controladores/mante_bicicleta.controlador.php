<?php
require_once "../modelos/mante_bicicleta.modelo.php";
/* cambiar _tipoarmas por el nombre de la table correspondiente */
$Nombremodulo_mensaje_mante_bicicleta = "mante_bicicleta";
$nombremodelo_mante_bicicleta = "mante_bicicleta";
$namecolumnas__mante_bicicleta = "";
$namecampos_mante_bicicleta = "";
$nombretabla_mate_bicicleta_mante_bicicleta = "mante_bicicleta";
$tabla_mante_bicicleta = "mante_bicicleta";


/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_mate_bicicleta_mante_bicicleta;
    $query = "SHOW COLUMNS FROM $nombretabla_mate_bicicleta_mante_bicicleta";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}



/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

if (isset($_GET["action"])) {
    # code...


    if (isset($_POST["nuevoidbicicleta_mante"])) {



        global $tabla_mante_bicicleta;
        global $namecolumnas__mante_bicicleta;
        global $namecampos_mante_bicicleta;
        global $Nombremodulo_mensaje_mante_bicicleta;
        global $nombremodelo_mante_bicicleta;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],);
            /* $namecolumnas__mante_bicicleta .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],];
        }

        $datos = $array;
        $respuesta = ModeloManteBicicleta::mdlIngresar($tabla_mante_bicicleta, $datos);

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



        global $tabla_mante_bicicleta;
        global $namecolumnas__mante_bicicleta;
        global $namecampos_mante_bicicleta;
        global $Nombremodulo_mensaje_mante_bicicleta;
        global $nombremodelo_mante_bicicleta;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],);
            /* $namecolumnas__mante_bicicleta .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],];
        }

        $datos = $array;


        /* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

        $respuesta = ModeloManteBicicleta::mdlEditar($tabla_mante_bicicleta, $datos);

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

        global $tabla_mante_bicicleta;
        global $namecolumnas__mante_bicicleta;
        global $namecampos_mante_bicicleta;
        global $Nombremodulo_mensaje_mante_bicicleta;
        global $nombremodelo_mante_bicicleta;
        $datos = $_GET["id_mante"];


        $respuesta = ModeloManteBicicleta::mdlBorrar($tabla_mante_bicicleta, $datos);

        if ($respuesta == "ok") {

            echo "ok";
        } else {
            echo "error";
        }
    }
}

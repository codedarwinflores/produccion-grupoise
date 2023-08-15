<?php
require_once "../modelos/mante_arma.modelo.php";
/* cambiar _tipoarmas por el nombre de la table correspondiente */
$Nombremodulo_mensaje_mante_arma = "mante_arma";
$nombremodelo_mante_arma = "mante_arma";
$namecolumnas__mante_arma = "";
$namecampos_mante_arma = "";
$nombretabla_mate_bicicleta_mante_arma = "mante_arma";
$tabla_mante_arma = "mante_arma";


/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_mate_bicicleta_mante_arma;
    $query = "SHOW COLUMNS FROM $nombretabla_mate_bicicleta_mante_arma";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}



/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

if (isset($_GET["action"])) {
    # code...


    if (isset($_POST["nuevoidarma_mante"])) {



        global $tabla_mante_arma;
        global $namecolumnas__mante_arma;
        global $namecampos_mante_arma;
        global $Nombremodulo_mensaje_mante_arma;
        global $nombremodelo_mante_arma;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],);
            /* $namecolumnas__mante_arma .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],];
        }

        $datos = $array;
        $respuesta = ModeloManteArma::mdlIngresar($tabla_mante_arma, $datos);

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



        global $tabla_mante_arma;
        global $namecolumnas__mante_arma;
        global $namecampos_mante_arma;
        global $Nombremodulo_mensaje_mante_arma;
        global $nombremodelo_mante_arma;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],);
            /* $namecolumnas__mante_arma .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],];
        }

        $datos = $array;


        /* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

        $respuesta = ModeloManteArma::mdlEditar($tabla_mante_arma, $datos);

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

        global $tabla_mante_arma;
        global $namecolumnas__mante_arma;
        global $namecampos_mante_arma;
        global $Nombremodulo_mensaje_mante_arma;
        global $nombremodelo_mante_arma;
        $datos = $_GET["id_mante"];


        $respuesta = ModeloManteArma::mdlBorrar($tabla_mante_arma, $datos);

        if ($respuesta == "ok") {

            echo "ok";
        } else {
            echo "error";
        }
    }
}

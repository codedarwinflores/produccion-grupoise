<?php
require_once "../modelos/mante_vehiculo.modelo.php";
/* cambiar _tipoarmas por el nombre de la table correspondiente */
$Nombremodulo_mensaje_mante_vehiculo = "mante_vehiculo";
$nombremodelo_mante_vehiculo = "mante_vehiculo";
$namecolumnas__mante_vehiculo = "";
$namecampos_mante_vehiculo = "";
$nombretabla_mate_vehiculo_mante_vehiculo = "mante_vehiculo";
$tabla_mante_vehiculo = "mante_vehiculo";


/* CAPTURAR NOMBRE COLUMNAS*/

function getContent()
{
    global $nombretabla_mate_vehiculo_mante_vehiculo;
    $query = "SHOW COLUMNS FROM $nombretabla_mate_vehiculo_mante_vehiculo";
    $sql = Conexion::conectar()->prepare($query);
    $sql->execute();
    return $sql->fetchAll();
}



/*=============================================
	INGRESAR REGISTRO 
	=============================================*/

if (isset($_GET["action"])) {
    # code...


    if (isset($_POST["nuevoidvehiculo_mante"])) {



        global $tabla_mante_vehiculo;
        global $namecolumnas__mante_vehiculo;
        global $namecampos_mante_vehiculo;
        global $Nombremodulo_mensaje_mante_vehiculo;
        global $nombremodelo_mante_vehiculo;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],);
            /* $namecolumnas__mante_vehiculo .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],];
        }

        $datos = $array;
        $respuesta = ModeloManteVehiculo::mdlIngresar($tabla_mante_vehiculo, $datos);

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



        global $tabla_mante_vehiculo;
        global $namecolumnas__mante_vehiculo;
        global $namecampos_mante_vehiculo;
        global $Nombremodulo_mensaje_mante_vehiculo;
        global $nombremodelo_mante_vehiculo;

        $data = getContent();
        $datos = "";
        $array = [];
        foreach ($data as $row) {
            $datos0 = array("" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],);
            /* $namecolumnas__mante_vehiculo .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
            $array += ["" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],];
        }

        $datos = $array;


        /* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

        $respuesta = ModeloManteVehiculo::mdlEditar($tabla_mante_vehiculo, $datos);

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

        global $tabla_mante_vehiculo;
        global $namecolumnas__mante_vehiculo;
        global $namecampos_mante_vehiculo;
        global $Nombremodulo_mensaje_mante_vehiculo;
        global $nombremodelo_mante_vehiculo;
        $datos = $_GET["id_mante"];


        $respuesta = ModeloManteVehiculo::mdlBorrar($tabla_mante_vehiculo, $datos);

        if ($respuesta == "ok") {

            echo "ok";
        } else {
            echo "error";
        }
    }
}

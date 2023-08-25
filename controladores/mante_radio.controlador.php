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
        session_start();

        global $tabla_mante_radio;
        global $namecolumnas__mante_radio;
        global $namecampos_mante_radio;
        global $Nombremodulo_mensaje_mante_radio;
        global $nombremodelo_mante_radio;

        $data = getContent();
        $datos = "";
        $array = [
            "idradio_mante" => $_POST["nuevoidradio_mante"],
            "correlativo_mradio" => $_POST["nuevocorrelativo_mradio"],
            "fecha_mradio" => $_POST["nuevofecha_mradio"],
            "diagnostico_mradio" => $_POST["nuevodiagnostico_mradio"],
            "descripcion" => $_POST["nuevodescripcion"],
            "id_movimiento_his" => $_POST["idmovimientoequipo"],
        ];

        $datos = $array;
        $respuesta = ModeloManteRadio::mdlIngresar($tabla_mante_radio, $datos);

        if ($respuesta == "ok") {


            // Obtener el último valor generado
            $stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maximo FROM `mante_radio`");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $lastValue = $row['maximo'];

                if (!empty($_SESSION['detalle_equipo'])) {
                    $count_equipo = count($_SESSION['detalle_equipo']);
                    for ($i = 0; $i < $count_equipo; $i++) {

                        // Prepare the SQL statement
                        $sql = "INSERT INTO mante_radio_detalle_equipo (	id_manto, id_equipo, descripcion,cantidad,costo_equipo,valor,tipo_equipo) VALUES (:value1, :value2, :value3, :value4, :value5, :value6, :value7)";
                        $stmt = Conexion::conectar()->prepare($sql);

                        // Bind parameters
                        $value1 = $lastValue;
                        $value2 = $_SESSION['detalle_equipo'][$i]['idequipo'];
                        $value3 = $_SESSION['detalle_equipo'][$i]['equipo_descripcion_unica'];
                        $value4 = $_SESSION['detalle_equipo'][$i]['equipo_cantidad'];
                        $value5 = $_SESSION['detalle_equipo'][$i]['equipo_costo_equipo'];
                        $value6 = $_SESSION['detalle_equipo'][$i]['equipo_valor'];
                        $value7 = $_SESSION['detalle_equipo'][$i]['equipo_codigo_tipo'];

                        $stmt->bindParam(':value1', $value1);
                        $stmt->bindParam(':value2', $value2);
                        $stmt->bindParam(':value3', $value3);
                        $stmt->bindParam(':value4', $value4);
                        $stmt->bindParam(':value5', $value5);
                        $stmt->bindParam(':value6', $value6);
                        $stmt->bindParam(':value7', $value7);

                        // Execute the prepared statement
                        $stmt->execute();
                    }
                }
            }


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

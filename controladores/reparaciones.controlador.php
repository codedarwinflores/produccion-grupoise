<?php
/* cambiar _tipoarmas por el nombre de la table correspondiente */
$Nombremodulo_mensaje_reparaciones = "Reparaciones";
$nombremodelo_reparaciones = "reparaciones";
$namecolumnas_reparaciones = "";
$namecampos_reparaciones = "";
$nombretabla_reparaciones_reparaciones = "reparaciones";
$tabla_reparaciones = "reparaciones";
class ControladorReparaciones
{

    /* CAPTURAR NOMBRE COLUMNAS*/

    function getContent()
    {
        global $nombretabla_reparaciones_reparaciones;
        $query = "SHOW COLUMNS FROM $nombretabla_reparaciones_reparaciones";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();
        return $sql->fetchAll();
    }



    /*=============================================
	INGRESAR REGISTRO 
	=============================================*/

    static public function ctrCrear()
    {

        if (isset($_POST["nuevocodigo_reparacion"])) {



            global $tabla_reparaciones;
            global $namecolumnas_reparaciones;
            global $namecampos_reparaciones;
            global $Nombremodulo_mensaje_reparaciones;
            global $nombremodelo_reparaciones;

            $data = getContent();
            $datos = "";
            $array = [];
            foreach ($data as $row) {
                $datos0 = array("" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],);
                /* $namecolumnas_reparaciones .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
                $array += ["" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],];
            }

            $datos = $array;
            $respuesta = ModeloReparaciones::mdlIngresar($tabla_reparaciones, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({

						type: "success",
						title: "¡' . $Nombremodulo_mensaje_reparaciones . ' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "' . $nombremodelo_reparaciones . '";

						}

					});
				

					</script>';
            }
        }
    }

    /*=============================================
	MOSTRAR REGISTROS
	=============================================*/

    static public function ctrMostrar($item, $valor)
    {

        global $tabla_reparaciones;

        $respuesta = ModeloReparaciones::mdlMostrar($tabla_reparaciones, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    static public function ctrEditar()
    {

        if (isset($_POST["editarcodigo_reparacion"])) {



            global $tabla_reparaciones;
            global $namecolumnas_reparaciones;
            global $namecampos_reparaciones;
            global $Nombremodulo_mensaje_reparaciones;
            global $nombremodelo_reparaciones;

            $data = getContent();
            $datos = "";
            $array = [];
            foreach ($data as $row) {
                $datos0 = array("" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],);
                /* $namecolumnas_reparaciones .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
                $array += ["" . $row['Field'] . "" => $_POST["editar" . $row['Field'] . ""],];
            }

            $datos = $array;


            /* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

            $respuesta = ModeloTalleres::mdlEditar($tabla_reparaciones, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						  type: "success",
						  title: "' . $Nombremodulo_mensaje_reparaciones . ' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "' . $nombremodelo_reparaciones . '";

									}
								})

					</script>';
            }
        }
    }

    /*=============================================
	BORRAR REGISTROS
	=============================================*/

    static public function ctrBorrar()
    {

        if (isset($_GET["idreparaciones"])) {

            global $tabla_reparaciones;
            global $namecolumnas_reparaciones;
            global $namecampos_reparaciones;
            global $Nombremodulo_mensaje_reparaciones;
            global $nombremodelo_reparaciones;
            $datos = $_GET["idreparaciones"];


            $respuesta = ModeloReparaciones::mdlBorrar($tabla_reparaciones, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "' . $Nombremodulo_mensaje_reparaciones . ' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "' . $nombremodelo_reparaciones . '";

								}
							})

				</script>';
            }
        }
    }
}

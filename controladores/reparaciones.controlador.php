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
	INGRESO 
	=============================================*/

    static public function ctrIngreso()
    {

        if (isset($_POST["ingUsuario"])) {

            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
            ) {

                $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla_reparaciones = "usuarios";

                $item = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla_reparaciones, $item, $valor);

                if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

                    if ($respuesta["estado"] == 1) {

                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];
                        $_SESSION["foto"] = $respuesta["foto"];
                        $_SESSION["perfil"] = $respuesta["perfil"];

                        /*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

                        date_default_timezone_set('America/El_Salvador');

                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');

                        $fechaActual = $fecha . ' ' . $hora;

                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;

                        $item2 = "id";
                        $valor2 = $respuesta["id"];

                        $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla_reparaciones, $item1, $valor1, $item2, $valor2);

                        if ($ultimoLogin == "ok") {

                            echo '<script>

								window.location = "inicio";

							</script>';
                        }
                    } else {

                        echo '<br>
							<div class="alert alert-danger">El usuario aún no está activado</div>';
                    }
                } else {

                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
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

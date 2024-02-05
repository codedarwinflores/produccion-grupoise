<?php
/* cambiar _tbl_vendedormorse por el nombre de la table correspondiente */
$Nombremodulo_mensaje_tbl_vendedormorse = "Vendedor Morse";
$nombremodelo_tbl_vendedormorse = "vendedormorse";
$namecolumnas_tbl_vendedormorse = "";
$namecampos_tbl_vendedormorse = "";
$nombretabla_tbl_vendedormorse_tbl_vendedormorse = "tbl_vendedormorse";
$tabla_tbl_vendedormorse = "tbl_vendedormorse";
class Controladortbl_vendedormorse
{

    /* CAPTURAR NOMBRE COLUMNAS*/

    function getContent()
    {
        global $nombretabla_tbl_vendedormorse_tbl_vendedormorse;
        $query = "SHOW COLUMNS FROM $nombretabla_tbl_vendedormorse_tbl_vendedormorse";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();
        return $sql->fetchAll();
    }


    /*=============================================
	INGRESAR REGISTRO 
	=============================================*/

    static public function ctrCrear()
    {

        if (isset($_POST["nuevoid"])) {



            global $tabla_tbl_vendedormorse;
            global $namecolumnas_tbl_vendedormorse;
            global $namecampos_tbl_vendedormorse;
            global $Nombremodulo_mensaje_tbl_vendedormorse;
            global $nombremodelo_tbl_vendedormorse;

            $data = getContent();
            $datos = "";
            $array = [];
            foreach ($data as $row) {
                $datos0 = array("" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],);
                /* $namecolumnas_tbl_vendedormorse .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
                $array += ["" . $row['Field'] . "" => $_POST["nuevo" . $row['Field'] . ""],];
            }

            $datos = $array;
            $respuesta = Modelotbl_vendedorMorse::mdlIngresar($tabla_tbl_vendedormorse, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({

						type: "success",
						title: "¡' . $Nombremodulo_mensaje_tbl_vendedormorse . ' ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "' . $nombremodelo_tbl_vendedormorse . '";

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

        global $tabla_tbl_vendedormorse;

        $respuesta = Modelotbl_vendedorMorse::mdlMostrar($tabla_tbl_vendedormorse, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    static public function ctrEditar()
    {

        if (isset($_POST["editar_id"])) {



            global $tabla_tbl_vendedormorse;
            global $namecolumnas_tbl_vendedormorse;
            global $namecampos_tbl_vendedormorse;
            global $Nombremodulo_mensaje_tbl_vendedormorse;
            global $nombremodelo_tbl_vendedormorse;

            $data = getContent();
            $datos = "";
            $array = [];
            foreach ($data as $row) {
                $datos0 = array("" . $row['Field'] . "" => $_POST["editar_" . $row['Field'] . ""],);
                /* $namecolumnas_tbl_vendedormorse .= "".$row['Field'].""." =>". $_POST["nuevo".$row['Field'].""].","; */
                $array += ["" . $row['Field'] . "" => $_POST["editar_" . $row['Field'] . ""],];
            }

            $datos = $array;


            /* $datos = array("id" => $_POST["id"],
							   "codigo" => $_POST["editarCodigo"],
							   "nombre" => $_POST["editarNombre"]); */

            $respuesta = Modelotbl_vendedorMorse::mdlEditar($tabla_tbl_vendedormorse, $datos);

            if ($respuesta == "ok") {

                echo '<script>

					swal({
						  type: "success",
						  title: "' . $Nombremodulo_mensaje_tbl_vendedormorse . ' ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "' . $nombremodelo_tbl_vendedormorse . '";

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

        if (isset($_GET["idtbl_vendedormorse"])) {

            global $tabla_tbl_vendedormorse;
            global $namecolumnas_tbl_vendedormorse;
            global $namecampos_tbl_vendedormorse;
            global $Nombremodulo_mensaje_tbl_vendedormorse;
            global $nombremodelo_tbl_vendedormorse;
            $datos = $_GET["idtbl_vendedormorse"];


            $respuesta = Modelotbl_vendedorMorse::mdlBorrar($tabla_tbl_vendedormorse, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "' . $Nombremodulo_mensaje_tbl_vendedormorse . ' ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "' . $nombremodelo_tbl_vendedormorse . '";

								}
							})

				</script>';
            }
        }
    }
}

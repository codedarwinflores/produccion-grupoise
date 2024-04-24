<?php

require_once "conexion.php";
class ModeloFormatoExamen
{

    /* MOSTRAR DATOS */
    static public function MostrarDatos($campos, $tabla, $condicion, $array)
    {
        try {
            if (empty($condicion)) {
                $stm = Conexion::conectar()->prepare("SELECT " . $campos . " FROM " . $tabla . $array);
                $stm->execute();
            } else {
                $stm = Conexion::conectar()->prepare("SELECT " . $campos . " FROM " . $tabla . " WHERE " . $condicion . $array);
                $stm->execute();
            }

            return $stm->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /* INGRESAR FORMATO EXAMEN */
    static public function mdlIngresarFormatoExamen($tabla, $datos)
    {
        // Establecer la zona horaria a El Salvador
        date_default_timezone_set('America/El_Salvador');
        $fecha = date("Y-m-d H:i:s");
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,id_tipo_examen,id_cliente_morse,concepto,fecha_creacion,id_usuario) VALUES (:codigo,:id_tipo_examen,:id_cliente_morse,:concepto,:fecha_creacion,:id_usuario)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_examen", $datos["id_tipo_examen"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente_morse", $datos["id_cliente_morse"], PDO::PARAM_INT);
        $stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_creacion", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    /* OBTENER INFORMACIÓN POD ID PARA EDITAR */
    static public function ObtenerDataSelect($tabla, $id)
    {
        $condicion = "";
        if ($id > 0) {
            $condicion = " WHERE " . $id;
        }
        $query = "SELECT * FROM $tabla $condicion";
        $sql = Conexion::conectar()->prepare($query);

        if ($sql->execute()) {
            // Obtener los resultados como un array asociativo
            $resultados = $sql->fetchAll();

            // Convertir a formato JSON
            $jsonResultados = json_encode($resultados);

            return $jsonResultados;
        }

        return false;
    }

    static public function obtenerOdenPreguntas($id)
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT MAX(orden) as maximo FROM tbl_formato_examen_pregunta WHERE id_formato_examen=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($row ? ($row['maximo'] + 1) : 1);
    }


    static public  function GenerarCodigoCorrelativo($id_tipo, $idEditar)
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maximo FROM preguntas");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $consult = Conexion::conectar()->prepare("SELECT codigo FROM tipos_preguntas WHERE id=?");
        $consult->execute([$id_tipo]);
        $response = $consult->fetch(PDO::FETCH_ASSOC);

        if ($row && $response) {
            $id_pregunta =  $row['maximo'];
            $codigoTipo = $response["codigo"];
            if ($idEditar > 0) {
                $id_pregunta = $idEditar;
            }

            // Generar el próximo correlativo
            $newValue = $id_pregunta;
            $correlativo = str_pad($newValue, 6, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros

            $newCodigo = $codigoTipo . $correlativo;
            $stmta = Conexion::conectar()->prepare("UPDATE preguntas SET codigo=:codigo WHERE id=:id");
            $stmta->bindParam(":codigo", $newCodigo, PDO::PARAM_STR);
            $stmta->bindParam(":id", $id_pregunta, PDO::PARAM_INT);

            if ($stmta->execute()) {
                return true;
            }
            return false;
        }

        return false;
    }


    /* INGRESAR PREGUNTAS */
    static public function mdlIngresarFormatoExamenPreguntas($tabla, $datos)
    {


        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_area,test,orden,id_pregunta,id_formato_examen) VALUES (:id_area,:test,:orden,:id_pregunta,:id_formato_examen)");
        $stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
        $stmt->bindParam(":test", $datos["test"], PDO::PARAM_STR);
        $stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_INT);
        $stmt->bindParam(":id_pregunta", $datos["id_pregunta"], PDO::PARAM_INT);
        $stmt->bindParam(":id_formato_examen", $datos["id_formato_examen"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            /* $resulta = self::GenerarCodigoCorrelativo($datos["id_tipo"], ""); */

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    static public function mdlEditarFormatoExamen($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo=:codigo,id_tipo_examen=:id_tipo_examen,id_cliente_morse=:id_cliente_morse,concepto=:concepto,id_usuario=:id_usuario WHERE id=:id");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tipo_examen", $datos["id_tipo_examen"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente_morse", $datos["id_cliente_morse"], PDO::PARAM_INT);
        $stmt->bindParam(":concepto", $datos["concepto"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }
        $stmt->close();

        $stmt = null;
    }

    static public function mdlEditarFormatoExamenPregunta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_area=:id_area,test=:test,orden=:orden,id_pregunta=:id_pregunta,id_formato_examen=:id_formato_examen WHERE id=:id");
        $stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
        $stmt->bindParam(":test", $datos["test"], PDO::PARAM_STR);
        $stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_INT);
        $stmt->bindParam(":id_pregunta", $datos["id_pregunta"], PDO::PARAM_INT);
        $stmt->bindParam(":id_formato_examen", $datos["id_formato_examen"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            /* self::GenerarCodigoCorrelativo($datos["id_tipo"], $datos["id"]); */

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    static public function ExisteRegistro($tabla, $condicion)
    {
        try {
            // Consulta para verificar la existencia de un registro
            $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as count FROM $tabla WHERE $condicion");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Obtener el valor de la columna 'count' que representa el número de registros
            $count = $row['count'];

            // Devolver true si hay al menos un registro, false en caso contrario
            return $count;
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            echo "Error de base de datos: " . $e->getMessage();
            return false;
        }
    }


    /*=============================================
	MOSTRAR 
	=============================================*/

    static public function mdlMostrar($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }


        $stmt->close();

        $stmt = null;
    }

    /*=============================================
	BORRAR REGISTRO
	=============================================*/

    static public function mdlBorrar($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    static public function mdlBorrarIDFormarExamenPreguntas($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_formato_examen = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}

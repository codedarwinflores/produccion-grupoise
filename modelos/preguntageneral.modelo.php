<?php

require_once "conexion.php";
class ModeloPreguntaGeneral
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


    /* INGRESAR TIPO PREGUNTA */
    static public function mdlIngresarTipopregunta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,descripcion) VALUES (:codigo,:descripcion)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
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
    static public function mdlIngresarPreguntas($tabla, $datos)
    {


        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo,pregunta) VALUES (:id_tipo,:pregunta)");
        $stmt->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_INT);
        $stmt->bindParam(":pregunta", $datos["pregunta"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $resulta = self::GenerarCodigoCorrelativo($datos["id_tipo"], "");

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    static public function mdlEditarTipoPregunta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo=:codigo,descripcion=:descripcion WHERE id=:id");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }
        $stmt->close();

        $stmt = null;
    }

    static public function mdlEditarPregunta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pregunta=:pregunta WHERE id=:id");
        $stmt->bindParam(":pregunta", $datos["pregunta"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            self::GenerarCodigoCorrelativo($datos["id_tipo"], $datos["id"]);

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


    static public function mdlBorrarIDTipoPreguntas($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_tipo = :id");

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

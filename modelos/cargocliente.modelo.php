<?php

require_once "conexion.php";
class ModeloCargoCliente
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

    static public function mdlIngresarCargoCliente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cargo) VALUES (:nombre_cargo)");

        $stmt->bindParam(":nombre_cargo", $datos["nombre_cargo"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    static public  function GenerarCodigoCorrelativo()
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maximo FROM `tbl_area_examen`");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastValue = $row['maximo'];
        } else {
            $lastValue = 0;
        }

        // Generar el próximo correlativo
        $newValue = $lastValue + 1;
        $correlativo = str_pad($newValue, 2, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros
        return $correlativo;
    }


    static public function mdlIngresarAreaExamen($tabla, $datos)
    {

        $codigo = self::GenerarCodigoCorrelativo();
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,motivo) VALUES (:codigo,:motivo)");

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }


    static public function mdlEditarCargoCliente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_cargo=:nombre_cargo WHERE id=:id");

        $stmt->bindParam(":nombre_cargo", $datos["nombre_cargo"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    static public function mdlEditarAreaExamen($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET motivo=:motivo WHERE id=:id");
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if ($stmt->execute()) {

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
}

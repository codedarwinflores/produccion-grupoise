<?php

require_once "conexion.php";
$namecolumnas = "";
$namecampos = "";
class ConsultasModelo
{
    /* CAPTURAR NOMBRE COLUMNAS*/

    static function getContent($nombreTabla)
    {
        $query = "SHOW COLUMNS FROM $nombreTabla";
        $stmt = Conexion::conectar()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;
    }


    /* AGREGAR CONSULTAS PERSONALIZADAS */

    /* Función para mostrar los empleados */
    static public function mostrarDatosDB($campos, $tabla, $condicion, $array)
    {
        try {
            if (empty($condicion)) {
                $stm = Conexion::conectar()->prepare("SELECT " . $campos . " FROM " . $tabla);
                $stm->execute();
            } else {
                $stm = Conexion::conectar()->prepare("SELECT " . $campos . " FROM " . $tabla . " WHERE " . $condicion);
                $stm->execute($array);
            }

            return $stm->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
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
	INGRESAR REGISTRO
	=============================================*/

    static public function mdlIngresar($tabla, $datos)
    {
        global $namecolumnas;
        global $namecampos;


        /* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
        $data = getContent($tabla);
        foreach ($data as $row) {
            $namecolumnas .= $row['Field'] . ",";
            $namecampos .= ":" . $row['Field'] . ",";
        }

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(" . trim($namecolumnas, ",") . ") VALUES (" . trim($namecampos, ",") . ")");

        foreach ($data as $row) {
            $stmt->bindParam(":" . $row['Field'], $datos["" . $row['Field'] . ""], PDO::PARAM_STR);
        }

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
	EDITAR REGISTRO
	=============================================*/

    static public function mdlEditar($tabla, $datos)
    {
        global $namecolumnas;
        global $namecampos;

        $data = getContent($tabla);
        foreach ($data as $row) {
            $namecolumnas .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
        }


        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET " . trim($namecolumnas, ",") . " WHERE id = :id");

        foreach ($data as $row) {
            $stmt->bindParam(":" . $row['Field'], $datos["" . $row['Field'] . ""], PDO::PARAM_STR);
        }


        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }

    /*=============================================
	ACTUALIZAR REGISTRO
	=============================================*/

    static public function mdlActualizar($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
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

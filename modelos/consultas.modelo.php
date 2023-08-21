<?php

require_once "conexion.php";

class ConsultasPersonalizadas
{



    /* AGREGAR CONSULTAS PERSONALIZADAS */

    /* Función para mostrar los empleados */
    static public function mostrarDatosDb($campos, $tabla, $condicion, $array)
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
}

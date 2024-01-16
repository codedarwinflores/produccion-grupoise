<?php

require_once "conexion.php";
class ModeloHorario
{
    static public function vaciarTablaHora()
    {
        // Truncar la tabla para eliminar todos los registros
        Conexion::conectar()->query("TRUNCATE TABLE tbl_hora");
    }

    static public function insertarHorario($datos)
    {
        // Insertar en la base de datos
        $stmt = Conexion::conectar()->prepare("INSERT INTO tbl_hora (hora_inicial, hora_final) VALUES (?, ?)");
        if ($stmt->execute([$datos["hora_inicial"], $datos["hora_final"]])) {
            return true;
        }
        return false;
    }

    static public function UpdateHorario($datos)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_hora SET hora_inicial = ?, hora_final = ? WHERE id_hora = ?");
        if ($stmt->execute([$datos["hora_inicial"], $datos["hora_final"], $datos["id"]])) {
            return true;
        }
        return false;
    }

    static public function InsertDataNew($fecha)
    {
        date_default_timezone_set('America/El_Salvador');
        $fechaActual = date('Y-m-d');
        // Ahora puedes usar funciones de fecha y hora en El Salvador
        if (!empty($fecha)) {
            $fechaActual = $fecha;
        }
        $hora = date('00:00');
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("INSERT tbl_poligrafo(fecha_programada,hora_programada) VALUES(?,?);");
        if ($stmt->execute([$fechaActual, $hora])) {
            return true;
        }
        return false;
    }




    static public function InsertDataNewHorario($fecha)
    {
        $campos = "*";
        $tabla = "tbl_hora";

        $resultados = self::MostrarDatos($campos, $tabla, "", "");

        foreach ($resultados as $key => $row) {
            // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
            $stmt = Conexion::conectar()->prepare("INSERT tbl_poligrafo(fecha_programada,hora_programada) VALUES(?,?);");
            $stmt->execute([$fecha, $row["hora_inicial"]]);
        }

        return true;
    }


    /* OBTENER HORARIO ORDENADO DE FORMA DESCENDENTE POR HORA INICIAL */
    static public function  ObtenerHorario()
    {
        $query01 = "SELECT * FROM tbl_hora order by hora_inicial desc";
        $sql = Conexion::conectar()->prepare($query01);
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return false;
    }


    /* OBTENER HORARIO ORDENADO DE FORMA DESCENDENTE POR HORA INICIAL */
    static public function  ObtenerPreguntas()
    {
        $query01 = "SELECT preg.*, tipo_preg.codigo, tipo_preg.descripcion FROM `preguntas` preg INNER JOIN tipos_preguntas tipo_preg on preg.id_tipo=tipo_preg.id";
        $sql = Conexion::conectar()->prepare($query01);
        if ($sql->execute()) {
            return $sql->fetchAll();
        }
        return false;
    }


    /* OBTENER INFORMACIÓN POD ID PARA EDITAR */
    static public function ObtenerHorarioID($id)
    {
        $query = "SELECT * FROM tbl_hora WHERE id_hora=?";
        $sql = Conexion::conectar()->prepare($query);

        if ($sql->execute([$id])) {
            // Obtener los resultados como un array asociativo
            $resultados = $sql->fetch();

            // Convertir a formato JSON
            $jsonResultados = json_encode($resultados);

            return $jsonResultados;
        }

        return false;
    }


    /* OBTENER INFORMACIÓN POD ID PARA EDITAR */
    static public function ObtenerrReservaPoligrafoID($id)
    {
        $query = "SELECT pol.estado_exam,pol.id_registro,pol.fecha_programada,pol.hora_programada,pol.hora_ingreso,pol.hora_inicio,pol.hora_finalizo, concat(evas.codigo,' - ',evas.nombres,' ',evas.primer_apellido,' ',evas.segundo_apellido) as nombre_evaluado,evas.id as id_evaluado_id, morse.*, CONCAT(emp.codigo_empleado,' - ',emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as nombre_pol,emp.id as id_poligrafista_id, concat(tipoexam.codigo,' - ',tipoexam.descripcion,' $',tipoexam.valor) as examenes,tipoexam.id as id_tipoexam_id,tipoexam.valor FROM `tbl_poligrafo` pol LEFT JOIN evaluados evas ON pol.id_evaluado = evas.id LEFT JOIN tbl_clientes_morse morse ON POL.id_cliente=morse.id LEFT JOIN tbl_empleados emp on pol.id_poligrafista = emp.id LEFT JOIN tipos_examenes tipoexam on pol.id_tipo_examen=tipoexam.id WHERE id_registro=?";
        $sql = Conexion::conectar()->prepare($query);

        if ($sql->execute([$id])) {
            // Obtener los resultados como un array asociativo
            $resultados = $sql->fetch();

            // Convertir a formato JSON
            $jsonResultados = json_encode($resultados);

            return $jsonResultados;
        }

        return false;
    }

    /* ELIMINAR POR ID*/
    static public function eliminarRegistro($id)
    {

        // Utilizar consultas preparadas para prevenir inyecciones SQL
        $stmt = Conexion::conectar()->prepare("DELETE FROM tbl_hora WHERE id_hora = ?");
        $stmt->execute([$id]);

        // Verificar si se realizó la eliminación correctamente
        if ($stmt->rowCount() > 0) {
            // Encode the array to JSON
            $jsonData = json_encode(["status" => "ok"]);
        } else {
            $jsonData = json_encode(["status" => "error", "message" => "No se encontró el registro para eliminar."]);
        }
        return $jsonData;
    }


    static public function ComprobarExisteRegistro($datos)
    {
        // Consulta para verificar si ya existe un registro con la misma fecha inicial y final
        $consult = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM tbl_hora WHERE hora_inicial = ? AND hora_final = ?");
        $consult->execute([$datos["hora_inicial"], $datos["hora_final"]]);
        $result = $consult->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        }
        return false;
    }


    /* MOSTRAR DATOS DE RESERVAS POLIGRÁFICAS */
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


    static public function obtenerDatosDeTabla($campos, $tabla, $condicion)
    {
        try {
            // Utiliza parámetros con declaraciones preparadas para evitar inyección de SQL
            $sql = "SELECT $campos FROM $tabla WHERE $condicion";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();

            // Obtiene los resultados
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Realiza el mapeo de los resultados al formato específico de X-Editable
            $datosFormateados = array_map(function ($row) {
                return array('value' => $row['id_select'], 'text' => $row['title']);
            }, $resultados);

            // Convierte los resultados formateados a formato JSON y los retorna en lugar de imprimirlos directamente
            return json_encode($datosFormateados, JSON_UNESCAPED_UNICODE);
        } catch (PDOException $e) {
            // Maneja cualquier excepción de la base de datos de manera adecuada
            error_log("Error en la consulta: " . $e->getMessage());
            // Puedes lanzar una nueva excepción o manejarla de otra manera según tus necesidades
            // throw new MiExcepcion("Error en la consulta: " . $e->getMessage());
            return false; // O retorna un valor específico en caso de error
        }
    }

    /* UPDATE POR CADA CAMPO */
    static public function UpdateTblPoligrafo($campo, $valor, $id)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET $campo = ? WHERE id_registro = ?");
        if ($stmt->execute([$valor, $id])) {
            return true;
        }
        return false;
    }
}

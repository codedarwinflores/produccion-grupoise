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


    static public  function obtenerYEditarIDProgramacion()
    {
        date_default_timezone_set('America/El_Salvador');
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT max(id_registro) as maximo FROM `tbl_poligrafo`");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {

            $id = $row["maximo"];
            // Generar el próximo correlativo
            $newValue = $id;
            $correlativo = str_pad($newValue, 5, '0', STR_PAD_LEFT); // Asegura que tenga 5 dígitos rellenando con ceros

            $codigo_programacion = $correlativo . "/" . date("Y");

            $stmt = Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET codigo_programar_exam=? where id_registro=?");
            if ($stmt->execute([$codigo_programacion, $id])) {

                return true;
            }
            return true;
        }
        return 0;
    }


    static public  function ConsultarPreguntasExamen($id)
    {
        date_default_timezone_set('America/El_Salvador');
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT count(*) as maximo FROM `tbl_preguntas_poligrafo` where id_tbl_poligrafo=?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row["maximo"] > 0) {
            return true;
        }
        return false;
    }


    static public  function GenerarPreguntasExamen($datos)
    {
        $campos = "preg_formato.*, preg.pregunta, preg.codigo, tipo_preg.descripcion";
        $tabla = "tbl_formato_examen_pregunta preg_formato INNER JOIN preguntas preg ON preg_formato.id_pregunta = preg.id INNER JOIN tipos_preguntas tipo_preg ON preg.id_tipo = tipo_preg.id";
        $condicion = "preg_formato.id_formato_examen = " . $datos["id_formato_examen"];

        $resultados = self::MostrarDatos($campos, $tabla, $condicion, " ORDER BY preg_formato.orden ASC");

        if ($resultados) {
            $sqlstatement =
                Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET id_formato_examen=?,hora_inicio=? WHERE id_registro=?");
            $sqlstatement->execute([$datos["id_formato_examen"], $datos["hora_inicio_programar"], $datos["id_tbl_poligrafo"]]);


            foreach ($resultados as $key => $row) {

                $newValue = $row["orden"];
                $correlativo = str_pad($newValue, 4, '0', STR_PAD_LEFT); // Asegura que tenga 5 dígitos rellenando con ceros
                // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
                $stmt = Conexion::conectar()->prepare("INSERT tbl_preguntas_poligrafo(numero,pregunta_poligrafo,id_tbl_poligrafo) VALUES(?,?,?);");
                $stmt->execute([$correlativo, $row["pregunta"], $datos["id_tbl_poligrafo"]]);
            }

            return true;
        } else {
            return false;
        }
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
            self::obtenerYEditarIDProgramacion();

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
    static public function  ObtenerPreguntas($id)
    {
        $query01 = "SELECT * FROM tbl_preguntas_poligrafo WHERE id_tbl_poligrafo=?";
        $sql = Conexion::conectar()->prepare($query01);
        if ($sql->execute([$id])) {
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
    /* OBTENER NUEVO PRECIO */

    static public  function obtenerPrecioTipoExamenCliente($id_cliente, $id_tipoExamen)
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT nuevo_precio FROM `tbl_examen_clientemorse` WHERE id_cliente_morse=? AND id_tipo_examen=?");
        $stmt->execute([$id_cliente, $id_tipoExamen]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row["nuevo_precio"];
        }
        return 0;
    }


    /* OBTENER INFORMACIÓN POD ID PARA EDITAR */
    static public function ObtenerrReservaPoligrafoID($id)
    {
        $query = "SELECT pol.id_formato_examen,pol.estado_exam,pol.id_registro,pol.fecha_programada,pol.hora_programada,pol.hora_ingreso,pol.hora_inicio,pol.hora_finalizo,pol.codigo_programar_exam, concat(evas.codigo,' - ',evas.nombres,' ',evas.primer_apellido,' ',evas.segundo_apellido) as nombre_evaluado,evas.id as id_evaluado_id, morse.*,cargo.nombre_cargo, CONCAT(emp.codigo_empleado,' - ',emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as nombre_pol,emp.id as id_poligrafista_id, concat(tipoexam.codigo,' - ',tipoexam.descripcion,' $',tipoexam.valor) as examenes,tipoexam.id as id_tipoexam_id,tipoexam.valor FROM `tbl_poligrafo` pol LEFT JOIN evaluados evas ON pol.id_evaluado = evas.id LEFT JOIN tbl_clientes_morse morse ON pol.id_cliente=morse.id LEFT JOIN tbl_empleados emp on pol.id_poligrafista = emp.id LEFT JOIN tipos_examenes tipoexam on pol.id_tipo_examen=tipoexam.id LEFT JOIN tbl_cargo_cliente cargo ON morse.solicitado_cargo=cargo.id WHERE id_registro=?";
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


    /* ELIMINAR POR PREGUNTA ID*/
    static public function EliminarPreguntaExamen($id)
    {

        // Utilizar consultas preparadas para prevenir inyecciones SQL
        $stmt = Conexion::conectar()->prepare("DELETE FROM tbl_preguntas_poligrafo WHERE id = ?");
        $stmt->execute([$id]);

        // Verificar si se realizó la eliminación correctamente
        if ($stmt->rowCount() > 0) {
            // Encode the array to JSON
            return true;
        }
        return false;
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

    /* UPDATE POR CADA CAMPO */
    static public function UpdateTblHoraEstado($hora, $id)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET hora_ingreso = ?,estado_exam=? WHERE id_registro = ?");
        if ($stmt->execute([$hora, "EN PROCESO", $id])) {
            return true;
        }
        return false;
    }


    /* ACTUALIZAR PREGUNTA DE EXAMEN */
    static public function UpdatePreguntaExamenPoligrafo($id, $campo, $valor)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_preguntas_poligrafo SET $campo = ? WHERE id = ?");
        if ($stmt->execute([$valor, $id])) {
            return true;
        }
        return false;
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
}

<?php

require_once "conexion.php";
class ModeloHorario
{

    static function encryptor($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";

        $secret_key = 'DarwinFloCode';
        $secret_iv = 'darwinflocode@2024';


        $key = hash('sha256', $secret_key);


        $iv = substr(hash('sha256', $secret_iv), 0, 16);


        if (
            $action == 'encrypt'
        ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {

            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0,      $iv);
        }

        return $output;
    }

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

    /* GENERAR PREGUNTA */
    static public  function GenerarPreguntasExamen($datos)
    {
        $campos = "preg_formato.*, preg.pregunta, preg.codigo, tipo_preg.descripcion";
        $tabla = "tbl_formato_examen_pregunta preg_formato INNER JOIN preguntas preg ON preg_formato.id_pregunta = preg.id INNER JOIN tipos_preguntas tipo_preg ON preg.id_tipo = tipo_preg.id";
        $condicion = "preg_formato.id_formato_examen = " . $datos["id_formato_examen"];

        $resultados = self::MostrarDatos($campos, $tabla, $condicion, " ORDER BY preg_formato.orden ASC");

        if ($resultados) {

            $consulta = Conexion::conectar()->prepare("SELECT hora_inicio FROM tbl_poligrafo WHERE hora_inicio != '00:00:00' AND id_registro = ?");
            $consulta->execute([$datos["id_tbl_poligrafo"]]);
            $res = $consulta->fetch(PDO::FETCH_ASSOC);
            $hora = $datos["hora_inicio_programar"];
            if ($res) {
                $hora = $res["hora_inicio"];
            }

            $sqlstatement =
                Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET id_formato_examen=?,hora_inicio=? WHERE id_registro=?");
            $sqlstatement->execute([$datos["id_formato_examen"], $hora, $datos["id_tbl_poligrafo"]]);


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

    static public function mdlIngresarPregunta($datos)
    {
        /* SACAR MAXIMO NUMERO DE ORDEN */
        // Consulta para verificar la existencia de un registro
        $consultaNumer = Conexion::conectar()->prepare("SELECT max(numero) as maximo FROM tbl_preguntas_poligrafo  WHERE id_tbl_poligrafo=" . $datos["id_tbl_poligrafo"]);
        $consultaNumer->execute();
        $row = $consultaNumer->fetch(PDO::FETCH_ASSOC);

        // Obtener el valor de la columna 'count' que representa el número de registros
        $numMaximo = $row['maximo'];

        $nuevoNumero  = $numMaximo + 1;
        $correlativo = str_pad($nuevoNumero, 4, '0', STR_PAD_LEFT);
        $stmt = Conexion::conectar()->prepare("INSERT INTO tbl_preguntas_poligrafo(pregunta_poligrafo, id_tbl_poligrafo,numero) VALUES (:pregunta_poligrafo, :id_tbl_poligrafo,:numero)");

        $stmt->bindParam(":pregunta_poligrafo", $datos["pregunta_poligrafo"], PDO::PARAM_STR);
        $stmt->bindParam(":id_tbl_poligrafo", $datos["id_tbl_poligrafo"], PDO::PARAM_INT);
        $stmt->bindParam(":numero", $correlativo, PDO::PARAM_STR);


        $regPreg = Conexion::conectar()->prepare("INSERT INTO preguntas(id_tipo, pregunta) VALUES (:id_tipo, :pregunta)");

        $regPreg->bindParam(":id_tipo", $datos["id_tipo"], PDO::PARAM_INT);
        $regPreg->bindParam(":pregunta", $datos["pregunta_poligrafo"], PDO::PARAM_STR);
        if ($stmt->execute() && $regPreg->execute()) {
            $resulta = self::GenerarCodigoCorrelativo($datos["id_tipo"], "");
            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
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
    static public function ObtenerReservaPoligrafoID($id)
    {
        $query = "SELECT pol.hora_solicitud_re,pol.fecha_solicitud_re,pol.cargo_solicitud_re,pol.conclusion_examen,pol.objetivo_examen,pol.resultado_final_examen,pol.porcentaje_evaluado,pol.porcentaje_cliente,pol.forma_pago,pol.precio_examen,pol.observaciones_examen,pol.id_formato_examen,pol.estado_exam,pol.id_registro,pol.fecha_programada,pol.hora_programada,pol.hora_ingreso,pol.hora_inicio,pol.hora_finalizo,pol.codigo_programar_exam,evas.estado_civil as estado_evas,evas.fecha_nac as fecha_nac_evas,evas.telefono as telefono_evas,evas.documento as dui_evas,evas.nombres as nombres_evas,evas.primer_apellido as a_paterno,evas.segundo_apellido as a_materno,evas.codigo as codigo_eva, concat(evas.nombres,' ',evas.primer_apellido,' ',evas.segundo_apellido) as nombre_evaluado,evas.id as id_evaluado_id,evas.foto as fotografia, morse.*,cargo.nombre_cargo, CONCAT(emp.codigo_empleado,' - ',emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as nombre_pol,CONCAT(emp.primer_nombre,' ',emp.segundo_nombre,' ',emp.tercer_nombre,' ',emp.primer_apellido,' ',emp.segundo_apellido,' ',emp.apellido_casada) as nombre_poligrafista,emp.id as id_poligrafista_id,emp.codigo_empleado as codigo_poligrafista,tipoexam.descripcion as descripcion_exam,tipoexam.codigo as codigo_examen_unico, concat(tipoexam.codigo,' - ',tipoexam.descripcion,' $',tipoexam.valor) as examenes,tipoexam.id as id_tipoexam_id,tipoexam.valor,formato_examen.concepto,formato_examen.codigo as codigo_formato_examen FROM `tbl_poligrafo` pol LEFT JOIN evaluados evas ON pol.id_evaluado = evas.id LEFT JOIN tbl_clientes_morse morse ON pol.id_cliente=morse.id LEFT JOIN tbl_empleados emp on pol.id_poligrafista = emp.id LEFT JOIN tipos_examenes tipoexam on pol.id_tipo_examen=tipoexam.id LEFT JOIN tbl_cargo_cliente cargo ON morse.solicitado_cargo=cargo.id LEFT JOIN tbl_formato_examenes formato_examen ON pol.id_formato_examen=formato_examen.id WHERE id_registro=?";
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


    /* ELIMINAR POR PREGUNTA ID*/
    static public function EliminarProgramacionExamen($id)
    {

        // Utilizar consultas preparadas para prevenir inyecciones SQL
        $stmt = Conexion::conectar()->prepare("DELETE FROM tbl_poligrafo WHERE id_registro = ?");
        $stmt->execute([$id]);

        // Verificar si se realizó la eliminación correctamente
        if ($stmt->rowCount() > 0) {
            // Utilizar consultas preparadas para prevenir inyecciones SQL
            $stmtt = Conexion::conectar()->prepare("DELETE FROM tbl_preguntas_poligrafo WHERE id_tbl_poligrafo = ?");
            $stmtt->execute([$id]);
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
    static public function UpdateTblHoraEstado($datos, $id)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET precio_examen=?,porcentaje_evaluado=?,porcentaje_cliente=?,forma_pago=?,hora_solicitud_re=?,fecha_solicitud_re=?,cargo_solicitud_re=?,hora_ingreso = ?,estado_exam=? WHERE id_registro = ?");
        if ($stmt->execute([$datos["precio_programar"], $datos["porcentaje_evaluado"], $datos["porcentaje_cliente"], $datos["forma_pago"], $datos["hora_solicitante"], $datos["fecha_solicitante"], $datos["cargo"], $datos["hora"], "EN PROCESO", $id])) {
            return true;
        }
        return false;
    }



    /* UPDATE PARA FINALIZAR PROCESO DE RESERVA */
    static public function UpdateTblHoraEstadoFinal($datos, $id)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET hora_finalizo = ?,estado_exam=?,resultado_final_examen=? WHERE id_registro = ?");
        if ($stmt->execute([$datos["hora_final"], $datos["estado"], $datos["resultado_examen"], $id])) {
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


    /* ACTUALIZAR PREGUNTA DE EXAMEN */
    static public function UpdateCamposDeReserva($id, $campo, $valor)
    {
        // Ya existe un registro con la misma fecha inicial y final, entonces actualizamos ese registro
        $stmt = Conexion::conectar()->prepare("UPDATE tbl_poligrafo SET $campo = ? WHERE id_registro = ?");
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

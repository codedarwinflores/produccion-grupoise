<?php

require_once "conexion.php";
class ClienteMorseModelo
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


    /* OBTENER INFORMACIÓN POD ID PARA EDITAR */
    static public function ObtenerDataSelect($tabla, $id)
    {
        $condicion = "";
        if ($id != "" && !empty($id)) {
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

    /* OBTENER INFORMACIÓN POD ID PARA EDITAR */
    static public function ObtenerDataEditar($id)
    {

        $query = "SELECT * FROM tbl_clientes_morse where id=?";
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


    static public  function BuscarIDClienteMorse()
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maximo FROM `tbl_clientes_morse`");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastValue = $row['maximo'];
        } else {
            $lastValue = 0;
        }

        // Generar el próximo correlativo
        $newValue = $lastValue + 1;
        $correlativo = str_pad($newValue, 5, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros
        return $correlativo;
    }

    static public  function BuscarIDClienteMorseUltimo()
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT MAX(id) as maximo FROM `tbl_clientes_morse`");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastValue = 0;
        if ($row) {
            $lastValue = $row['maximo'];
        }

        return $lastValue;
    }

    static public  function ObtenerCodigoTabla($campos, $tabla, $condicion)
    {
        // Obtener el último valor generado
        $stmt = Conexion::conectar()->prepare("SELECT $campos FROM $tabla WHERE $condicion");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $codigo = 0;
        if ($row) {
            $codigo = $row['codigo'];
        }


        return $codigo;
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

    static public function ObtenerDatosExamenes($tabla, $condicion)
    {
        try {
            // Consulta para verificar la existencia de un registro
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $condicion");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Devolver true si hay al menos un registro, false en caso contrario
            return $row;
        } catch (PDOException $e) {
            // Manejar errores de base de datos
            echo "Error de base de datos: " . $e->getMessage();
            return false;
        }
    }

    static public  function extraerPrimero($cadena)
    {
        // Utilizar expresión regular para encontrar la primera letra o número al principio
        preg_match('/[a-zA-Z0-9]/', $cadena, $coincidencias);

        // Obtener la primera letra o número encontrada
        $primer_caracter = $coincidencias[0] ?? null;

        return $primer_caracter;
    }
    /*=============================================
	INGRESAR REGISTRO
	=============================================*/

    static public function mdlIngresar($tabla, $datos)
    {
        $primeraLetra = self::extraerPrimero($datos["nombre"]);
        $codigo = self::BuscarIDClienteMorse();

        $codigo_cliente = $primeraLetra . $codigo;
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_cliente, " . implode(', ', array_keys($datos)) . ") VALUES (:codigo_cliente, :" . implode(', :', array_keys($datos)) . ")");

        $stmt->bindParam(":codigo_cliente", $codigo_cliente, PDO::PARAM_STR);
        // Vincular parámetros dinámicamente
        foreach ($datos as $campo => &$valor) {
            $stmt->bindParam(":$campo", $valor, PDO::PARAM_STR);
        }


        if ($stmt->execute()) {


            return "ok";
        } else {

            return "error";
        }
        print_r($stmt->errorInfo());
        $stmt->close();

        $stmt = null;
    }

    static public function mdlActualizar($tabla, $datos, $id)
    {
        $primeraLetra = self::extraerPrimero($datos["nombre"]);
        $idModificado = str_pad($id, 5, '0', STR_PAD_LEFT);


        $codigo_cliente = $primeraLetra . $idModificado;
        $setClause = "";

        // Build SET clause for the update query
        foreach ($datos as $campo => $valor) {
            $setClause .= "$campo = :$campo, ";
        }

        // Remove trailing comma and space
        $setClause = rtrim($setClause, ', ');

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $setClause, codigo_cliente = :codigo_cliente WHERE id = :id");

        // Bind parameters
        $stmt->bindParam(":codigo_cliente", $codigo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        foreach ($datos as $campo => &$valor) {
            $stmt->bindParam(":$campo", $valor, PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
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


    static public function mdlIngresarClienteExamen($tabla, $datos)
    {

        /* Código Examen */
        $cod_exam = self::ObtenerCodigoTabla("codigo", "tipos_examenes", "id=" . $datos["id_tipo_examen"]);
        /* Código CLIENTE */
        $cod_cliente = self::ObtenerCodigoTabla("codigo_cliente as codigo", "tbl_clientes_morse", "id=" . $datos["id_cliente_morse"]);

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_tipo_examen,cod_examen, id_cliente_morse, cod_cliente_morse, nuevo_precio) VALUES (:id_tipo_examen,:cod_examen, :id_cliente_morse, :cod_cliente_morse, :nuevo_precio)");

        $stmt->bindParam(":id_tipo_examen", $datos["id_tipo_examen"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_examen", $cod_exam, PDO::PARAM_STR);
        $stmt->bindParam(":id_cliente_morse", $datos["id_cliente_morse"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_cliente_morse", $cod_cliente, PDO::PARAM_STR);
        $stmt->bindParam(":nuevo_precio", $datos["nuevo_precio"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();

        $stmt = null;
    }
}

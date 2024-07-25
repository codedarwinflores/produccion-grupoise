<?php

require_once "conexion.php";

class ModeloUsuarios
{




	static public function mdlConsultarDatosUsuarioCodigo($tabla, $criterios)
	{
		// Prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id AND usuario = :usuario AND user_correo = :user_correo");

		// Vincula los parámetros
		$stmt->bindParam(":id", $criterios["id"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $criterios["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":user_correo", $criterios["user_correo"], PDO::PARAM_STR);

		// Ejecuta la consulta
		$stmt->execute();

		// Obtiene el resultado
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		// Cierra la conexión
		$stmt->closeCursor();
		$stmt = null;

		// Retorna el resultado o false si no se encontró nada
		return $resultado ? $resultado : false;
	}

	static public function mdlConsultarDatosUsuario($tabla, $criterios)
	{
		// Prepara la consulta
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id AND usuario = :usuario AND user_correo = :user_correo");

		// Vincula los parámetros
		$stmt->bindParam(":id", $criterios["id"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $criterios["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":user_correo", $criterios["user_correo"], PDO::PARAM_STR);

		// Ejecuta la consulta
		$stmt->execute();

		// Verifica si se encontró una fila que coincida con los criterios
		if ($stmt->fetch()) {
			return true;
		} else {
			return false;
		}

		// Cierra la conexión
		$stmt->close();
		$stmt = null;
	}




	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor)
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
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,user_correo, usuario, password, perfil, foto,2fa) VALUES (:nombre,:user_correo, :usuario, :password, :perfil, :foto,:2fa)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":user_correo", $datos["user_correo"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":2fa", $datos["_2fa"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,user_correo=:user_correo, password = :password, perfil = :perfil,foto=:foto, 2fa=:2fa,usuario=:usuario,intento=0 WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":user_correo", $datos["user_correo"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":2fa", $datos["_2fa"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
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


	static public function mdlActualizarTokenUsuario($tabla, $criterios)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token_code = :token_code WHERE id = :id");

		$stmt->bindParam(":token_code", $criterios["token_code"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $criterios["id"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {

			return false;
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlActualizarTokenUsuario2FA($tabla, $criterios)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token_code_2fa = :token_code_2fa WHERE id = :id");

		$stmt->bindParam(":token_code_2fa", $criterios["token_code_2fa"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $criterios["id"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {

			return false;
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlActualizarTokenIntentos($tabla, $criterios)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intento = 0, token_code = '' WHERE id = :id");

		$stmt->bindParam(":id", $criterios["id"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {

			return false;
		}

		$stmt->close();

		$stmt = null;
	}


	static public function mdlIncrementarIntentos($tabla, $criterios)
	{

		if ($criterios["condicion"] == "incrementar") {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intento = intento+1 WHERE id = :id and usuario=:usuario");
		} else {
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intento = 0 WHERE id = :id and usuario=:usuario");
		}


		$stmt->bindParam(":id", $criterios["id"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $criterios["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return true;
		} else {

			return false;
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos)
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

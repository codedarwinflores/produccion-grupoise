<?php

require_once "../modelos/conexion.php";


			$query = "INSERT INTO `configuracion`(`conf_empresa`, `extra_diurna`, `extra_nocturna`, `extra_dominical_diurna`, `extra_dominical_nocturna`, `periodo_de_pago`, `porcentaje_isss`, `tope_isss`, `salario_minimo`, `ultimo_empreado`, `ultimo_proveedor`, `num_registro`, `iva`, `firma_representante`, `firma_sello_notario`, `representante_legal`, `cargo`, `direccion`, `telefono`, `actividad_economica`, `nit`, `num_patronal`, `registro`, `pais`, `h_extra`) VALUES ('','','','','','','','','','','','','','','','','','','','','','','','','')";

			
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();		
          
          echo $query;


?>
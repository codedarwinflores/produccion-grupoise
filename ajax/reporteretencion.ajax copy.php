<?php 
require_once "../modelos/conexion.php";


function fun_planilla_admin_devengos($mes) {
        /*  $query = "SELECT sum(sueldo_planilladevengo_admin) as sueldo, SUM(descuento_renta_planilladevengo_admin) as renta, sum(descuento_afp_planilladevengo_admin) as afp, MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) as mes, planilladevengo_admin.* FROM planilladevengo_admin where id_empleado_planilladevengo_admin='$empleado' and MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) = $mes order by id_empleado_planilladevengo_admin"; */
        $query = "SELECT  MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) as mes, planilladevengo_admin.* FROM planilladevengo_admin where MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) = $mes order by id_empleado_planilladevengo_admin";
         $sql = Conexion::conectar()->prepare($query);
         $sql->execute();			
         return $sql->fetchAll();
         $sql=null;
     };
   

function devengos_contodo($idempleado1,$numero) {
         $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo
         FROM tbl_devengo_descuento_planilla_admin
         WHERE
             idempleado_devengo = '$idempleado1'
             AND (
                 (codigo_planilla_devengo='$numero' AND isss_devengo_devengo_descuento_planilla = 'Si')
                 OR
                 (codigo_planilla_devengo='$numero' AND afp_devengo_devengo_descuento_planilla = 'Si')
                 OR
                 (codigo_planilla_devengo='$numero' AND renta_devengo_devengo_descuento_planilla = 'Si')
             )
             AND tipo_valor LIKE '%suma%'
         GROUP BY idempleado_devengo";
         $sql = Conexion::conectar()->prepare($query);
         $sql->execute();			
         return $sql->fetchAll();
         $sql=null;

};

/*         function saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,$mes,$empleado){ */

            $datos_agrupados = array();
            $datos_empleado = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_planilla_devengos=fun_planilla_admin_devengos($i);
            $valor_gravado_mes=0;
            $rray_plan_admin_mes=[];
            foreach ($data_planilla_devengos as  $val_pla) {
         
                /* datos del array */
                $idempleado1=$val_pla["id_empleado_planilladevengo_admin"];
                $mes=$val_pla["mes"];
                $valorrenta=$val_pla["descuento_renta_planilladevengo_admin"];
                $valorafp=$val_pla["descuento_afp_planilladevengo_admin"];
                $valor_devengo=0;
                /* -------------- */
                $numero=$val_pla["numero_planilladevengo_admin"];
                $data_devengo=devengos_contodo($idempleado1,$numero);
                foreach ($data_devengo as $val_devengo) {
                    # code...
                    /* datos del array */
                    $valor_devengo=floatval($val_devengo["sumadevengo"]);
                    /* ***** */
                }
                $valor_devengo=$valor_devengo+floatval($val_pla["sueldo_planilladevengo_admin"]);
                $datos_empleado[] = ["empleado" => $idempleado1, "mes" => $mes, "valor" => $valor_devengo, "renta" => $valorrenta, "afp" => $valorafp];
              /*   echo "empleado" . $idempleado1. "mes" . $mes."valor" . $valor_devengo."renta". $valorrenta."afp".$valorafp."<br>"; */
            }
            
        }


        foreach ($datos_empleado as $datos) {
                echo $datos["empleado"];
        }

         /*    return $datos_agrupados;
        } */


        /* CODIGO EJEMPLO */
        /* $datos_saldo_mes=saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,8,'7');
        foreach ($datos_saldo_mes as $empleado => $datos) {
            echo "Empleado: " . $empleado . "<br>";
            foreach ($datos["detalle"] as $detalle) {
                echo "Mes: " . $detalle["mes"] . ", Valor: " . $detalle["valor"] . "<br>";
            }
            
            echo "Valor Total: " . $datos["total_valor"] . "<br>";
            echo "Valor renta: " . $datos["total_renta"] . "<br>";
            echo "Valor afp: " . $datos["total_afp"] . "<br>";
            echo "<br>";
             
        } */

     
       

      ?>

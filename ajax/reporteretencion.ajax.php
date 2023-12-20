<?php 
require_once "../modelos/conexion.php";


function fun_planilla_admin_devengos($mes) {
        /*  $query = "SELECT sum(sueldo_planilladevengo_admin) as sueldo, SUM(descuento_renta_planilladevengo_admin) as renta, sum(descuento_afp_planilladevengo_admin) as afp, MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) as mes, planilladevengo_admin.* FROM planilladevengo_admin where id_empleado_planilladevengo_admin='$empleado' and MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%Y-%m-%d')) = $mes order by id_empleado_planilladevengo_admin"; */
        $query = "SELECT MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y')) as mes, planilladevengo_admin.* FROM planilladevengo_admin where MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y')) = $mes order by id_empleado_planilladevengo_admin ";
         $sql = Conexion::conectar()->prepare($query);
         $sql->execute();			
         return $sql->fetchAll();
         $sql=null;
     };
   


function devengos_contodo($idempleado1,$mes) {
         $query = "SELECT SUM(valor_devengo_planilla) AS sumadevengo, idempleado_devengo
         FROM tbl_devengo_descuento_planilla_admin, planilladevengo_admin
         WHERE MONTH(STR_TO_DATE(fecha_planilladevengo_admin, '%d-%m-%Y')) = $mes and
             idempleado_devengo = '$idempleado1' and  tipo_valor like '%suma%'
             AND (
                 ( planilladevengo_admin.numero_planilladevengo_admin=tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo  AND isss_devengo_devengo_descuento_planilla = 'Si')
                 OR
                 ( planilladevengo_admin.numero_planilladevengo_admin=tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo  AND afp_devengo_devengo_descuento_planilla = 'Si')
                 OR
                 ( planilladevengo_admin.numero_planilladevengo_admin=tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo  AND renta_devengo_devengo_descuento_planilla = 'Si')
             )
         GROUP BY idempleado_devengo ";
         $sql = Conexion::conectar()->prepare($query);
         $sql->execute();			
         return $sql->fetchAll();
         $sql=null;
};

function devengos_nolimite() {
        $query = "SELECT*FROM tbl_devengo_descuento_planilla_admin
        WHERE tipo_valor like '%suma%'";
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();			
        return $sql->fetchAll();
        $sql=null;
};


/*         function saldo_mes($fecha_desde,$fecha_hasta,$devengos_table_maestra,$mes,$empleado){ */

            $datos_agrupados = array();
            $datos_empleado = [];
            $only_numero=[];
        for ($i = 1; $i <= 1; $i++) {
            $data_planilla_devengos=fun_planilla_admin_devengos($i);
            foreach ($data_planilla_devengos as  $val_pla) {
                $numero=$val_pla["numero_planilladevengo_admin"];
                /* datos del array */
                $idempleado1=$val_pla["id_empleado_planilladevengo_admin"];
                $mes=$val_pla["mes"];
                $valorrenta=$val_pla["descuento_renta_planilladevengo_admin"];
                $valorafp=$val_pla["descuento_afp_planilladevengo_admin"];
                /* -------------- */
               /*  $valor_devengo=$valor_devengo+floatval($val_pla["sueldo_planilladevengo_admin"]); */
                $datos_empleado[] = ["empleado" => $idempleado1, "mes" => $mes, "renta" => $valorrenta, "afp" => $valorafp, "numero" => $numero];
              /*   echo "empleado" . $idempleado1. "mes" . $mes."valor" . $valor_devengo."renta". $valorrenta."afp".$valorafp."<br>"; */
            }
        }

        $array_devengos=[];
        $devengos_nolimite=devengos_nolimite();
        foreach ($devengos_nolimite as $val_nolimite) {
                 $array_devengos[]=$val_nolimite;
        }


        echo json_encode($array_devengos);

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

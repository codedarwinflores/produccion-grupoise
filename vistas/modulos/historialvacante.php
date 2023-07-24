<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Movimiento Vacante";

/* CAPTURAR NOMBRE COLUMNAS*/



$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
$idhistorial0 = $results['id'];


function consultar_hora() {
  $query01 = "SELECT * FROM `tbl_clientes_ubicaciones` ";
   $sql = Conexion::conectar()->prepare($query01);
   $sql->execute();			
   return $sql->fetchAll();
};

function consultar_personal() {
  $query01 = "SELECT * FROM tbl_empleados";
   $sql = Conexion::conectar()->prepare($query01);
   $sql->execute();			
   return $sql->fetchAll();
};

?>
<div class="content-wrapper">


<input type="hidden" class="form-control input-lg input_fecha_cobertura_vacante calendario" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY">
 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <a class="btn btn-danger" href="vacante">Volver</a>
  
        <button class="btn btn-primary agregar" data-toggle="modal" data-target="#modalAgregarhistorialvacante">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acción</th>
            <th>Código Empleado</th>
            <th>Nombre Empleado</th>
            <th>Código Ubicación</th>
            <th>Nombre Ubicación</th>
            <th>Acciones</th>
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
            function consultar($e)
            {
              $query01 = "SELECT historialvacante.id, `id_vacante_historialvacante`, `fecha_historialvacante`, `hora_historialvacante`, `accion_historialvacante`, `id_empleado_historialvacante`, `id_ubicacion_historialvacante`, `comentario_historialvacante`, tbl_empleados.* , tbl_clientes_ubicaciones.* 
              FROM `historialvacante`,tbl_empleados, tbl_clientes_ubicaciones
               WHERE id_vacante_historialvacante=$e and historialvacante.id_empleado_historialvacante=tbl_empleados.id and historialvacante.id_ubicacion_historialvacante=tbl_clientes_ubicaciones.id";
             
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
            };

            $data01 = consultar($idhistorial0);
            foreach ($data01 as $value) {
          
           echo ' <tr>
                   <td>'.$value["fecha_historialvacante"].'</td>
                   <td>'.$value["hora_historialvacante"].'</td>
                   <td>'.$value["accion_historialvacante"].'</td>
                   <td>'.$value["codigo_empleado"].'</td>
                   <td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'</td>
                   
                   <td>'.$value["codigo_ubicacion"].'</td>
                   <td>'.$value["nombre_ubicacion"].'</td>';
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarhistorial" idhistorialvacante="'.$value["id"].'" data-toggle="modal" data-target="#modalAgregarhistorialvacante"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarhistorial" idhistorialvacante="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
                     </div>  
 
                   </td>
 
                 </tr>';
         }
 
 
         ?> 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
Administrar Modal  
======================================-->

<div id="modalAgregarhistorialvacante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

  
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar <?php echo $Nombre_del_Modulo;?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

            <input type="hidden" name="id" id="id">
            <input type="hidden" name="id_vacante_historialvacante" id="id_vacante_historialvacante" value="<?php echo $idhistorial0?>">


            <div class="form-group" bis_skin_checked="1">
               <label for="" class="">Fecha</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <input type="text" class="form-control input-lg calendario" name="" id="fecha_historialvacante" placeholder="Fecha" autocomplete="off" readonly>
               </div>
             </div>


             <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
               <label for="" class="">Ingresar Hora</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <input type="text" class="form-control input-lg tiempo" name="" id="hora_historialvacante" placeholder="Ingresar Hora" autocomplete="off">
               </div>
             </div>


             <div class="form-group   grupovacante_correlativo_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Acción</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_correlativo_vacante"></i></span> 
                 <select  class="form-control input-lg" name="" id="accion_historialvacante">
                         <option value="">Seleccionar Acción</option>
                         <option value="Reingreso">Reingreso</option>
                         <option value="Traslado">Traslado</option>
                         <option value="Nuevo ingreso">Nuevo ingreso</option>
                 </select>
               </div>
             </div>


             <div class="form-group   grupovacante_codigo_agente_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Personal</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class="icono_codigo_agente_vacante"></i></span> 
          
                 <select  class="form-control input-lg input_codigo_agente_vacante mi-selector" name="" id="codigo_empleado_cubrir_vacante">
                         <option value="" id="personal_cubrir_vacante">Seleccione Personal</option>
                         <?php
                         $data01 = consultar_personal();
                         foreach($data01 as $value) {
                           echo "<option idempleado='".$value["id"]."'  codigo='".$value["codigo_empleado"]."' nombre='".$value["primer_nombre"].' '.$value["primer_apellido"]."' value='".$value["id"]."'>".$value["codigo_empleado"]."-".$value["primer_nombre"].' '.$value["primer_apellido"]." </option>";
                         }
                         ?>
                 </select>
                 <input type="hidden" class="" name="" id="codigo_empleado_historialvacante" >
                 <input type="hidden" class="" name="" id="nombre_empleado_historialvacante" >

 
               </div>
             </div>
 


             <div class="form-group   grupovacante_ubicacion_vacante" bis_skin_checked="1">
               <label for="" class="">Seleccione Ubicación</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class=""></i></span> 
                   <select  class="form-control input-lg  mi-selector" name="" id="codigo_ubicacion_cubrir_vacante">
                         <option value="" id="ubicacion_cubrir_vacante">Seleccione Ubicación</option>
                         <?php
                         $data01 = consultar_hora();
                         foreach($data01 as $value) {
                           echo "<option idubicacion='".$value["id"]."' codigo='".$value["codigo_ubicacion"]."' nombre='".$value["nombre_ubicacion"]."' value='".$value["id"]."'>".$value["codigo_ubicacion"]."-".$value["nombre_ubicacion"]." </option>";
                         }
                         ?>
                     </select>
 
                     <input type="hidden" name="" class="" id="codigo_ubicacion_historialvacante">
                     <input type="hidden" name="" class="" id="nombre_ubicacion_historialvacante">
 
 
               </div>
             </div>

             <div class="form-group   " bis_skin_checked="1">
               <label for="" class="">Comentario</label> 
               <div class="input-group" bis_skin_checked="1">
                 <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control" name="comentario_historialvacante" id="comentario_historialvacante">
 
               </div>
             </div>

            <!-- ************************ -->
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary guardar_historial" accion="insertar">Guardar <?php echo $Nombre_del_Modulo?></button>
        </div>
 

    </div>

  </div>

</div>





<script src="vistas/js/historialvacante.js"></script>

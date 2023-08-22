<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Kardex";


$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
$correlativo_kardex= $results['id'];

/* CAPTURAR NOMBRE COLUMNAS*/

/* function getContent() {
  global $nombretabla_abase;
  $query = "SHOW COLUMNS FROM $nombretabla_abase";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
}; */

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="transancionkardexradios" class="btn btn-danger"> Volver</a>

      <div class="row">
        <?php
        function infokardex($correlativo_kardex1)
        {
              $query01 = "SELECT historial_kardex.id as idkardex, `correlativo_kardexh`, `fecha_kardexh`, `transancion_kardexh`, `empleado_kardexh`, `ubicacion_kardexh`, `equipo_kardexh`, `cantidad_kardexh`, `precio_kardexh`, `subtotal_kardexh`, `total_kardexh`,tbl_clientes_ubicaciones.* 
              FROM historial_kardex,tbl_clientes_ubicaciones 
              where tbl_clientes_ubicaciones.id=historial_kardex.ubicacion_kardexh and correlativo_kardexh='$correlativo_kardex1' group by correlativo_kardexh
              order by historial_kardex.id DESC";
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
        $data04 = infokardex($correlativo_kardex);
        $numero_transaccion="";
        $fecha="";
        $ubicacion="";
        $empleado="";
        $total="";
        foreach ($data04 as $value) {
          $numero_transaccion.=$value["correlativo_kardexh"];
          $fecha.=$value["fecha_kardexh"];
          $ubicacion.=$value["nombre_ubicacion"];
          $empleado.=$value["empleado_kardexh"];
          $total.=$value["total_kardexh"];
        }
        ?>
        <div class="col-md-12">
          <h3>Información Transacción</h3>
          <h4>Número Transacción: <?php echo $numero_transaccion;?></h4>
          <h4>Fecha: <?php echo $fecha;?></h4>
          <h4>Ubicación: <?php echo $ubicacion;?></h4>
          <h4>Empleado: <?php echo $empleado;?></h4>
          <h4>Total: </h4><input type="text" class="form-control totalglobal" value="<?php echo $total;?>" readonly />
          <input type="hidden" value="<?php echo $numero_transaccion ?>" id="correlativo_numero">
         
        </div>
      </div>
        <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarabase">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button> -->

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          <tr>
            <th>Fecha</th>
            <th>Equipo</th>
            <th>Transanción</th>
            <th>Tipo transaccion</th>
            <th>Empleado</th>
            <th>Ubicación</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Acción</th>
          </tr> 
 
         </thead>
 
         <tbody class="añadirequipo" > 
 
         <?php
            function kardex($equipo)
            {
                  $query01 = "SELECT historial_kardex.id as idkardex,historial_kardex.*,tbl_radios.*,tbl_transacciones_equipo.*,tbl_clientes_ubicaciones.*
                  FROM historial_kardex,tbl_radios,tbl_transacciones_equipo,tbl_clientes_ubicaciones
                  where historial_kardex.transancion_kardexh=tbl_transacciones_equipo.id and historial_kardex.equipo_kardexh=tbl_radios.codigo_radio and historial_kardex.ubicacion_kardexh= tbl_clientes_ubicaciones.id and historial_kardex.correlativo_kardexh='$equipo'";
                  $sql = Conexion::conectar()->prepare($query01);
                  $sql->execute();
                  return $sql->fetchAll();
            }
            $data03 = kardex($correlativo_kardex);
            foreach ($data03 as $value) {
          
           echo ' <tr>
                   <td>'.$value["fecha_kardexh"].'</td>
                   <td>'.$value["descripcion_radio"].'</td>
                   <td>'.$value["nombre"].'</td>
                   <td>'.$value["tipo_transaccion_equipo"].'</td>
                   <td>'.$value["empleado_kardexh"].'</td>
                   <td>'.$value["nombre_ubicacion"].'</td>';

                   echo '<td>'; 
                   echo '<input type="hidden" class="form-control nuevacantidad '.$value["equipo_kardexh"].'cantidad'.$value["idkardex"].'"/>';
                   echo '<span class="'.$value["equipo_kardexh"].'tabla'.$value["idkardex"].'">'.$value["cantidad_kardexh"].'</span>';
                   echo '</td>';

                   echo '<td>'; 
                   echo '<input type="hidden" class="form-control nuevacantidad '.$value["equipo_kardexh"].'precio'.$value["idkardex"].'"/>';
                   echo '<input type="hidden" readonly class="form-control nuevacantidad '.$value["equipo_kardexh"].'total'.$value["idkardex"].'"/>';
                   echo '<span class="'.$value["equipo_kardexh"].'tabla'.$value["idkardex"].'">'.$value["precio_kardexh"].'</span>';
                   echo '</td>';

                   echo '<td class="'.$value["equipo_kardexh"].'columna'.$value["idkardex"].'">'; 
                   echo  $value["subtotal_kardexh"];
                   echo '</td>';

                   echo "<td> <div class='btn btn-warning modificarproducto' producto=".$value["equipo_kardexh"]." idregistro=".$value["idkardex"]." cantidad=".$value["cantidad_kardexh"]." precio=".$value["precio_kardexh"]." total=".$value["subtotal_kardexh"]." guardar='no'><i class='fa fa-pencil'></i></div>

                   <div class='btn btn-danger eliminarproducto' producto=".$value["equipo_kardexh"]." idregistro=".$value["idkardex"]." ><i class='fa fa-times'></i></div>
                   </td>";
                   
                   echo '</tr>';
         }
 
 
         ?> 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarabase" class="modal fade" role="dialog">
  
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

          <input type="hidden" id="id">
          <input type="hidden" id="correlativo_kardex">

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group ">
              <label for="" class="">Fecha</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg calendario" name="fecha_kardex" id="fecha_kardex" placeholder="" value="" autocomplete="off" data-lang="es" data-years="1600-2060" data-format="DD-MM-YYYY" >
              </div>
            </div>

            <!-- ********************* -->

            <div class="form-group  col-md-6" bis_skin_checked="1">
              <label for="" class="">Transacción</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 
                <select class="form-control input-lg  mi-selector" name="transancion_kardex" id="transancion_kardex" placeholder="" value="" autocomplete="off" >
                  <option value="">Seleccione Transacción</option>
                  <?php
                  function transaccion()
                  {
                        $query01 = "SELECT * FROM tbl_transacciones_equipo";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data03 = transaccion();
                  foreach ($data03 as $value) {
                  ?>
                    <option value="<?php echo $value["id"]?>" tipo_transaccion_equipo="<?php echo $value["tipo_transaccion_equipo"]?>"  codigo="<?php echo $value["codigo"]?>"><?php echo $value["nombre"] ?></option>
                  <?php
                   }
                  ?>
                </select>
                <input type="hidden" id="tipo_transaccion_equipo">
              </div>
            </div>
            <!-- ******************* -->

            <div class="form-group   col-md-6" bis_skin_checked="1">
              <label for="" class="">Empleado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 

                <select class="form-control input-lg  mi-selector" name="empleado_kardex" id="empleado_kardex">
                  <option value="">Seleccione Empleado</option>
                  <?php
                  function empleado()
                  {
                        $query01 = "SELECT * FROM tbl_empleados";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data04 = empleado();
                  foreach ($data04 as $value) {
                  ?>
                    <option value="<?php echo $value["codigo_empleado"]?>"><?php echo $value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"]?></option>
                  <?php
                   }
                  ?>
                </select>
              </div>
            </div>
            <!-- ********************* -->

            <div class="form-group   " bis_skin_checked="1">
              <label for="" class="">Ubicación</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=""></i></span> 

                <select class="form-control input-lg  mi-selector" name="ubicacion_kardex" id="ubicacion_kardex">
                  <option value="">Seleccione Ubicación</option>
                  <?php
                  function ubicacion()
                  {
                        $query01 = "SELECT * FROM tbl_clientes_ubicaciones";
                        $sql = Conexion::conectar()->prepare($query01);
                        $sql->execute();
                        return $sql->fetchAll();
                  }
                  $data05 = ubicacion();
                  foreach ($data05 as $value) {
                  ?>
                    <option value="<?php echo $value["id"]?>"><?php echo $value["nombre_ubicacion"] ?></option>
                  <?php
                   }
                  ?>
                </select>
              </div>
            </div>
            <!-- ********************* -->
            
            <table class="table table-bordered table-striped dt-responsive " width="100%">
              <thead>
                <tr>
                  <th>Equipo</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Sub Total</th>
                </tr> 
              </thead>
              <tbody>
                <tr>
                  <td>
                      <select class="form-control mi-selector" name="equipo_kardex" id="equipo_kardex">
                        <option value="">Seleccione Ubicación</option>
                        <?php
                        function equipo()
                        {
                              $query01 = "SELECT * FROM tbl_otros_equipos";
                              $sql = Conexion::conectar()->prepare($query01);
                              $sql->execute();
                              return $sql->fetchAll();
                        }
                        $data06 = equipo();
                        foreach ($data06 as $value) {
                        ?>
                          <option value="<?php echo $value["codigo_equipo"]?>" descripcion="<?php echo $value["descripcion"]?>"><?php echo $value["descripcion"] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                  </td>
                  <td>
                    <input type="number" class="form-control" id="cantidad_kardex" value="0">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="precio_kardex" oninput="validateNumber(this);" value="0">
                  </td>
                  <td>
                    <input type="text" class="form-control" id="subtotal_kardex" readonly>
                  </td>
                </tr>
              <tbody>
          <table>
            <!-- ************ -->
          <div class="btn btn-primary guardarproducto">Añadir</div>
            <!-- ********** -->
            <table class="table table-bordered table-striped dt-responsive productos" width="100%">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Sub Total</th>
                  <th>Acciones</th>
                </tr> 
              </thead>
              <tbody id="añadirequipo">
              </tbody>
            </table>
            <!-- ************ -->

            <table class="table table-bordered table-striped dt-responsive " width="100%">
              <thead>
                <tr>
                  <th style="width:28%"></th>
                  <th></th>
                  <th>Cantidad</th>
                  <th style="width:14%"></th>
                  <th>Total</th>
                  <th style="width:20%"></th>
                </tr> 
              </thead>
              <tbody id="">
                <tr>
                  <td></td>
                  <td></td>
                  <td width="">
                    <input type="text" class="form-control" id="cantidad_total" readonly>                       
                  </td>
                  <td></td>
                  <td>
                    <input type="text" class="form-control" id="total_kardex" readonly>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            </table>

      

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardardata">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>


    </div>

  </div>

</div>





<script src="vistas/js/kardex.js"></script>

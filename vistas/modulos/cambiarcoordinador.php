<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Detalle Ubicacion";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_tbl_ubicaciones_detalle;
  $query = "SHOW COLUMNS FROM $nombretabla_tbl_ubicaciones_detalle";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};



?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>

      </div>

      <div class="box-body">
        
        <form action="">
          <!-- ********** -->

          <div class="">
                <label for="">Seleccione coordinador de zona actual :</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="coordinadoractual" id="coordinadoractual" class="form-control input-lg mi-selector" required>
                      <option value="">Seleccione coordinador de zona actual :</option>
                      <?php 
                                   function tblempleados() {
                                     $query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                     INNER JOIN cargos_desempenados 
                                     WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='COORDINADOR DE ZONA' ";
                                     $sql = Conexion::conectar()->prepare($query01);
                                     $sql->execute();			
                                     return $sql->fetchAll();
                                     }

                                     $data01 = tblempleados();
                                     foreach($data01 as $value) {
                        ?>
                        <option value="<?php echo $value['id'] ?>">
                          <?php echo $value["primer_nombre"].' '.$value["primer_apellido"] ?>
                        </option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

            <!-- *************************** -->

            <div class="">
                <label for="">Seleccione Ubicación:</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="ubicaciones" id="ubicaciones" class="form-control input-lg " required>
                      <option value="">Seleccione Ubicación :</option>
                    </select>
                </div>
            </div>
          <!-- ********** -->

          
          <div class="">
                <label for="">Seleccione coordinador de zona nuevo :</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select name="coordinadornuevo" id="coordinadornuevo" class="form-control input-lg mi-selector" required>
                      <option value="">Seleccione coordinador de zona nuevo :</option>
                      <?php 
                                   function tblempleados2() {
                                     $query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.* FROM tbl_empleados
                                     INNER JOIN cargos_desempenados 
                                     WHERE tbl_empleados.nivel_cargo = cargos_desempenados.id AND  cargos_desempenados.descripcion='COORDINADOR DE ZONA' ";
                                     $sql = Conexion::conectar()->prepare($query01);
                                     $sql->execute();			
                                     return $sql->fetchAll();
                                     }

                                     $data01 = tblempleados2();
                                     foreach($data01 as $value) {
                        ?>
                        <option value="<?php echo $value['id'] ?>">
                          <?php echo $value["primer_nombre"].' '.$value["primer_apellido"] ?>
                        </option>  
                    <?php
                        }
                      ?>
                    </select>
                </div>
            </div>

            <!-- *************** -->
            <br>
            <br>
            <button class="btn btn-primary guardarcoordinador">Actualizar</button>
        </form>

      </div>

    </div>

  </section>

</div>



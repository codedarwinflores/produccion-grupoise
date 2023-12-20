<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Seguro de Vida";


$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);

$idmaestro = $results['id'];

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_segurovida;
  $query = "SHOW COLUMNS FROM $nombretabla_segurovida";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

          function empleado($idmaestro)
                  {
                    $query01="SELECT * FROM `tbl_empleados` WHERE id=$idmaestro";
                    $sql = Conexion::conectar()->prepare($query01);
                    $sql->execute();
                    return $sql->fetchAll();
                    
                  };

                  $data_empleado= empleado($idmaestro);
                  $idempleado="";
                  $nombre_cargo="";
                  foreach ($data_empleado as  $value) {
                    $idempleado=trim($value["id"]);
                    $nombre_cargo=trim(trim($value["primer_nombre"])." ".trim($value["segundo_nombre"]).' '.trim($value["tercer_nombre"]).' '.trim($value["primer_apellido"]).' '.trim($value["segundo_apellido"]).' '.trim($value["apellido_casada"]));
                      $nombre_cargo = preg_replace('/\s+/', ' ', $nombre_cargo);
                  }

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <a href="empleados" class="btn btn-danger">Volver</a>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarsegurovida">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
      <h4>Empleado: <?php echo $nombre_cargo?></h4>
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Certificado</th>
            <th>Fecha Ingreso</th>
            <th>Monto Asegurado</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorsegurovida::ctrMostrar($item, $valor);

         function segurovida($idempleado)
                  {
                    $query01="SELECT * FROM `seguro_vida` WHERE idempleado=$idempleado";
                    $sql = Conexion::conectar()->prepare($query01);
                    $sql->execute();
                    return $sql->fetchAll();
                    
                  };
                  $data_segurovida= segurovida($idmaestro);
 
        foreach ($data_segurovida as $value){
          
           echo ' <tr>';
              echo'<td>'.$value["numero_centificado"].'</td>
                   <td>'.$value["fecha_ingreso"].'</td>
                   <td>'.$value["monto_asegurado"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarsegurovida" idsegurovida="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarsegurovida"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarsegurovida" idsegurovida="'.$value["id"].'"  Codigo="'.$value["idempleado"].'"><i class="fa fa-times"></i></button>
 
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
MODAL AGREGAR 
======================================-->

<div id="modalAgregarsegurovida" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

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

        <div class="box-body" bis_skin_checked="1">

              <?php
                  
                 
              ?>
        

            <!-- ENTRADA PARA CAMPOS  -->
            <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
              
            <div class="form-group   gruposegurovida_idempleado" bis_skin_checked="1">
              <label for="" class="">Empleado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_idempleado"></i></span> 

                <select class="form-control input-lg input_idempleado" name="nuevoidempleado" id="nuevoidempleado" placeholder="" value="" autocomplete="off" required="">
                  <option value="<?php echo $idempleado?>"><?php echo $nombre_cargo?></option>
                </select>
              </div>
            </div>

            <div class="form-group   gruposegurovida_numero_centificado" bis_skin_checked="1">
              <label for="" class="">Numero Certificado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_numero_centificado"></i></span> 
                <input type="text" class="form-control input-lg input_numero_centificado" name="nuevonumero_centificado" id="nuevonumero_centificado" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
              </div>
            </div>

            <div class="form-group   gruposegurovida_fecha_ingreso" bis_skin_checked="1">
              <label for="" class="">Fecha de Ingreso</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_fecha_ingreso fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg  calendario" name="nuevofecha_ingreso" id="nuevofecha_ingreso" placeholder="Ingresar Fecha Ingreso" autocomplete="off" required="" >
              </div>
            </div>


            <div class="form-group   gruposegurovida_monto_asegurado" bis_skin_checked="1">
              <label for="" class="">Monto Asegurado</label> 
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class="icono_monto_asegurado"></i></span> 
                <input type="text" class="form-control input-lg input_monto_asegurado" name="nuevomonto_asegurado" id="nuevomonto_asegurado" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
              </div>
            </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladorsegurovida();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarsegurovida" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar <?php echo $Nombre_del_Modulo?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

           
            


<!-- ENTRADA PARA CAMPOS  -->
<input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
              
              <div class="form-group   gruposegurovida_idempleado" bis_skin_checked="1">
                <label for="" class="">Empleado</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_idempleado"></i></span> 
  
                  <select class="form-control input-lg input_idempleado" name="editaridempleado" id="editaridempleado" placeholder="" value="" autocomplete="off" required="">
                    <option value="<?php echo $idempleado?>"><?php echo $nombre_cargo?></option>
                  </select>
                </div>
              </div>
  
              <div class="form-group   gruposegurovida_numero_centificado" bis_skin_checked="1">
                <label for="" class="">Numero Certificado</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_numero_centificado"></i></span> 
                  <input type="text" class="form-control input-lg input_numero_centificado" name="editarnumero_centificado" id="editarnumero_centificado" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                </div>
              </div>
  
              <div class="form-group   gruposegurovida_fecha_ingreso" bis_skin_checked="1">
                <label for="" class="">Fecha de Ingreso</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_fecha_ingreso fa fa-calendar"></i></span> 
                  <input type="text" class="form-control input-lg  calendario" name="editarfecha_ingreso" id="editarfecha_ingreso" placeholder="Ingresar Fecha Ingreso" autocomplete="off" required="" >
                </div>
              </div>
  
  
              <div class="form-group   gruposegurovida_monto_asegurado" bis_skin_checked="1">
                <label for="" class="">Monto Asegurado</label> 
                <div class="input-group" bis_skin_checked="1">
                  <span class="input-group-addon"><i class="icono_monto_asegurado"></i></span> 
                  <input type="text" class="form-control input-lg input_monto_asegurado" name="editarmonto_asegurado" id="editarmonto_asegurado" placeholder="" value="" autocomplete="off" required="" oninput="validateNumber(this);">
                </div>
              </div>
  

            <!--  -->


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladorsegurovida();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorsegurovida();
  $borrar -> ctrBorrar();

?> 



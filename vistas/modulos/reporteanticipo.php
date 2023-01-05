<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<script>
  $(document).ready(function(){
    
    var patrulla="";
    var ubicacion="";

       /*  ******** */
        var parametros = {
                "patrulla" : patrulla,
                "ubicacion" : ubicacion
        };
        $.ajax({
                data:  parametros,
                url:"ajax/tablaempleado.ajax.php",
                type:  'post',
                success:  function (response) {
                     $("#tableempleados").html(response);
                }
        });
        /* ********* */

        /* ****************** */

        $("#patrulla").change(function () {	 
          var patrulla =$(this).val();
          var ubicacion = $("#ubicacion").val();

          if(patrulla != "" && ubicacion==""){
            $("#imprimir").attr("href","vistas/modulos/reportepatrulla.php?patrulla='"+patrulla+"'&ubicacion='"+ubicacion+"'");
          }
           if(patrulla != "" && ubicacion != ""){
            $("#imprimir").attr("href","vistas/modulos/reportetotal.php?patrulla='"+patrulla+"'&ubicacion='"+ubicacion+"'");
          }   
              /*  ******** */
                var parametros = {
                        "patrulla" : patrulla,
                        "ubicacion" : ubicacion
                };
                $.ajax({
                        data:  parametros,
                        url:"ajax/tablaempleado.ajax.php",
                        type:  'post',
                        success:  function (response) {
                            $("#tableempleados").html(response);
                        }
                });
                /* ********* */



          });
        /* ********************* */

        $("#ubicacion").change(function () {	 
          var ubicacion =$(this).val();
          var patrulla = $("#patrulla").val();

          if(ubicacion != "" && patrulla==""){
            $("#imprimir").attr("href","vistas/modulos/reporteubicacion.php?patrulla='"+patrulla+"'&ubicacion='"+ubicacion+"'");
          }
           if(patrulla != "" && ubicacion != ""){
            $("#imprimir").attr("href","vistas/modulos/reportetotal.php?patrulla='"+patrulla+"'&ubicacion='"+ubicacion+"'");
          }   
              /*  ******** */
                var parametros = {
                        "patrulla" : patrulla,
                        "ubicacion" : ubicacion
                };
                $.ajax({
                        data:  parametros,
                        url:"ajax/tablaempleado.ajax.php",
                        type:  'post',
                        success:  function (response) {
                            $("#tableempleados").html(response);
                        }
                });
                /* ********* */



          });
        /* ********************* */

  })
</script>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <div class="row">
          <div class="col-md-6" >
              <a href="empleados" class="btn btn-primary">Volver</a>
          </div>
          <div class="col-md-12">
            <br>
          </div>
          <div class="col-md-5">
            <label>Patrulla</label>
            <select name="" class="form-control" id="patrulla">
              <option value="">Seleccione la Patrulla</option>
              <?php                    
                        function patrulla() {
                          global $nombretabla_sim;
                          $query = "SELECT * FROM `tbl_patrullas` GROUP BY codigo_patrulla";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();			
                          return $sql->fetchAll();
                        };
                      $data = patrulla();
                      foreach($data as $row) {
                        echo "<option value='".$row["codigo_patrulla"]."'>".$row["codigo_patrulla"]."</option>";
                      }         
              ?>
            </select>
          </div>
          <div class="col-md-5">
            <label>Ubicación</label>
            <select name="" class="form-control" id="ubicacion">
              <option value="">Seleccione la Ubicación</option>
                <?php                    
                          function ubicacion() {
                            $query = "SELECT tbl_patrullas_ubicaciones.id as id_patrullas_ubicaciones, `id_patrullas_pu`, `id_ubicacion_pu` , tbl_clientes_ubicaciones.id as idubicaciones, `id_cliente`, `codigo_cliente`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, `direccion`, `persona_contacto`, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, `id_departamento`, `id_municipio`, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados` , tbl_patrullas.id as idpatrulla , `codigo_patrulla`, `descripcion_patrulla`, `id_jefe_operaciones_patrulla` 
                            FROM `tbl_patrullas_ubicaciones`, tbl_clientes_ubicaciones, tbl_patrullas
                            WHERE tbl_clientes_ubicaciones.id=tbl_patrullas_ubicaciones.id_ubicacion_pu and tbl_patrullas.id = tbl_patrullas_ubicaciones.id_patrullas_pu ";
                            $sql = Conexion::conectar()->prepare($query);
                            $sql->execute();			
                            return $sql->fetchAll();
                          };
                        $data = ubicacion();
                        foreach($data as $row) {
                          echo "<option value='".$row["nombre_ubicacion"]."'>".$row["nombre_ubicacion"]."</option>";
                        }         
                ?>
            </select>
          </div>
          <div class="col-md-2">
            <div style="height: 25px;"></div>
            <a href="vistas/modulos/reportesgrupales.php?patrulla=''&ubicacion=''" target="_blank" class="btn btn-success" id="imprimir">Imprimir Todos</a>
          </div>
        </div>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
           <th>Foto</th>
           <th>Nombre completo</th>
           <th>Documento</th>  
           <th>Estado</th>           
           <th>Acciones</th>

          </tr> 
 
         </thead>
 
         <tbody id="tableempleados">
 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>


<?php

  $borrar = new Controladorsim();
  $borrar -> ctrBorrar();

?> 



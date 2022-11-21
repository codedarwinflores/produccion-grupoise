<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Dato";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_administrarpatrulla;
  $query = "SHOW COLUMNS FROM $nombretabla_administrarpatrulla";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>


<script>

$(document).ready(function(){
    //código jQuery adicional
    recagar();
let params = new URLSearchParams(location.search);
var id = params.get('id');

/* ****PATRULLA** */


var datos = new FormData();
	datos.append("idpatrulla", id);
  

$.ajax({

url:"ajax/patrulla.ajax.php",
method: "POST",
data: datos,
cache: false,
contentType: false,
processData: false,
dataType: "json",
success: function(respuesta){

      $(".codigo").text(respuesta["codigo_patrulla"]);
			$(".jefe").text(respuesta["id_jefe_operaciones_patrulla"]);
      $(".nuevoid_patrullas_pu").val(respuesta["id"])

}
});

/* ******* */




/* ****UBICACION** */


function recagar(){

  
    let params = new URLSearchParams(location.search);
    var id = params.get('id');

  
    var datos = new FormData();
      datos.append("idpatrulla", id);
      

    $.ajax({

    url:"ajax/ubicacionpatrulla.ajax.php",
    method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
    success: function(respuesta){

      $("#campos").html(respuesta);

      var table = $('.tablas').DataTable();
      
      $(".dataTables_filter").empty();
      
          // captura el evento keyup cuando escribes en el input
    $(".busqueda_input").keyup(function(){
        _this = this;
        // Muestra los tr que concuerdan con la busqueda, y oculta los demás.
        $.each($(".tablas tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 




    }
    });
}
/* ******* */





});
</script>
<div class="content-wrapper">


  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <div class="row">
          <div class="col-md-6">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregaradministrarpatrulla">   
              Agregar Ubicación
            </button>
          </div>
          <div class="col-md-6" align="right">
            <a href="patrulla" class="btn btn-success" >   
              Volver  
            </a>
          </div>
        </div>

        
          <div class="row">
            <div class="col-md-6" align="center">
              <span>Código Patrulla</span>
              <h3 class="codigo">Código</h3>
            </div>
            <div class="col-md-6" align="center">
              <span>Jefe de Operaciones</span>
              <h3 class="jefe">Jefe de Operaciones</h3>   
            </div>
        </div>
        <br>

      </div>

      <div class="box-body">
        
      <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6" align="right"> 
          <label for="">
            Buscar: <input type="text" class="busqueda_input">
          </label>
        </div>
      </div>
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Ubicaciones</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody id="campos">
 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregaradministrarpatrulla" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Ubicación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

                <input type="text" class="nuevoid_patrullas_pu" name="nuevoid_patrullas_pu" placeholder="" value="" autocomplete="off" required style="display: none;">

              <div class="input-group ">
                  <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                  <select name="nuevoid_ubicacion_pu" id="nuevoid_ubicacion_pu" class="form-control input-lg " required>
                    <option value="">Seleccione Ubicación</option>
                  <?php
                  $valor="";
                  $item="";
                      $datos_mostrar = Controladorubicacionc::ctrMostrar($item, $valor);
                      foreach ($datos_mostrar as $key => $value){
                  ?>
                      <option value="<?php echo $value['idubicacionc'] ?>" tabla_validar="tbl_patrullas_ubicaciones" item_validar="id_ubicacion_pu">
                         <?php echo $value["nombre_ubicacion"] ?>
                      </option>  
                  <?php
                      }
                    ?>
                  </select>
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

          $crear = new Controladoradministrarpatrulla();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditaradministrarpatrulla" class="modal fade" role="dialog">
  
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

          <!-- -- entrada id -- -->

<!--           <input type="hidden" name="id" id="editarid">
 -->

 
            <!-- ENTRADA PARA CAMPOS  -->

            
            <input type="text" name="editarid" placeholder="" value="" autocomplete="off" required style="display: none;" id="editarid_patrullas_ubicaciones">

            
            <input type="text" name="editarid_patrullas_pu" placeholder="" value="" autocomplete="off" required style="display: none;" id="editarid_patrullas_pu">

            <div class="input-group ">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <select name="editarid_ubicacion_pu" id="editarid_ubicacion_pu" class="form-control input-lg " required>
                  <option value="">Seleccione Ubicación</option>
                <?php
                    $datos_mostrar = Controladorubicacionc::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['idubicacionc'] ?>">
                      <?php echo $value["nombre_ubicacion"] ?>
                    </option>  
                <?php
                    }
                  ?>
                </select>
              </div>





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

          $editar = new Controladoradministrarpatrulla();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladoradministrarpatrulla();
  $borrar -> ctrBorrar();

?> 



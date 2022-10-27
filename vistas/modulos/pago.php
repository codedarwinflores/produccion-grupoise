<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Pago";

/* CAPTURAR NOMBRE COLUMNAS*/



function getContent() {
  global $nombretabla_pago;
  $query = "SHOW COLUMNS FROM $nombretabla_pago";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

<script>

$(document).ready(function(){
    //código jQuery adicional
  
let params = new URLSearchParams(location.search);
var contract = params.get('id');

function recagar(){
$(".idpedido").val(contract);
  var idpago = contract;
	var datos = new FormData();
	datos.append("idpago", idpago);

	$.ajax({

		url:"ajax/pago2.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
      $("#campos").html(respuesta);


		}

	});
}
/* ***********PEDIDO*********** */

  var datos = new FormData();
	datos.append("idpedido", contract);
  
	$.ajax({

		url:"ajax/pedido.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			$(".nuevoid_pedidop").val(respuesta["idpedido"]);
      $(".nuevosaldo_actualp").val(respuesta["monto"]);
			$(".nuevofechap").val(respuesta["fecha_pedido"]);

			$("#editarid_proveedor").val(respuesta["id_proveedor"]);
			$(".pedido").text(respuesta["descripcion"]);
			$(".proveedor").text(respuesta["nombreproveedor"]);
			$(".monto").text(respuesta["monto"]);


      
 /*  *************************** */

 var nuevoid_pedidop = $(".nuevoid_pedidop").val();
        var nuevosaldo_actualp = $(".nuevosaldo_actualp").val();
        var nuevofechap = $(".nuevofechap").val();
        var nuevosaldo_anteriorp = $(".nuevosaldo_anteriorp").val();
        var nuevoabonop = $(".nuevoabonop").val();

        var dataString = "nuevoid_pedidop="+nuevoid_pedidop+"&nuevosaldo_actualp="+nuevosaldo_actualp+ "&nuevofechap="+nuevofechap+"&nuevosaldo_anteriorp="+nuevosaldo_anteriorp+"&nuevoabonop="+nuevoabonop;

    $.ajax({
      
            url: "ajax/pagoinsert.ajax.php",
            method: "POST",
            data: dataString,
            success: function(){
              recagar();
      
            }
        });


      /* ******************** */

		}

	});

  recagar();

  /* *********** */

  $(".idpedido").val(contract);
  var idpago = contract;
	var datos = new FormData();
	datos.append("idpago", idpago);

	$.ajax({

		url:"ajax/pago3.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
      $(".nsaldo_anterior").val(respuesta['variable2']);
      $(".nsaldo_actual").val(respuesta['variable2']);
      

		}

	});
  /* ********* */

  $(".input_monto_pago").keydown(function(event){
		/* var bono= $(this).val();
    var saldoanterior=$(".nsaldo_anterior").val();
    var saldoactual=$(".nsaldo_actual").val();
    var calculo=saldoactual-bono;
    $(".nsaldo_actual").val(calculo);
     */
	}); 


  /* ******* */

  $(".einput_monto_pago").keyup(function(event){
		/* var bono= $(this).val();
    var saldoanterior=$("#editarsaldo_anterior").val();
    var saldoactual=$("#editarsaldo_actual").val();
    var calculo=saldoanterior-bono;
    $("#editarsaldo_actual").val(calculo); */
    
	}); 


  /* ******* */

  $( ".guardar" ).click(function() {
 
    var bono= $(".input_monto_pago").val();
    var saldoanterior=$(".nsaldo_anterior").val();
    var saldoactual=$(".nsaldo_actual").val();
    var calculo=saldoactual-bono;
    $(".nsaldo_actual").val(calculo);
    

});

/* ******* */

$( ".editar" ).click(function() {
 
    var bono= $(".einput_monto_pago").val();
    var saldoanterior=$("#editarsaldo_anterior").val();
    var saldoactual=$("#editarsaldo_actual").val();
    var calculo=saldoanterior-bono;
    $("#editarsaldo_actual").val(calculo);
 

});
/* 
  location.reload(); */
});

  

</script>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarpago">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

        <form  id="formulariop" method="post" style="display: none;">
          <input type="text" name="" class="nuevofechap">
          <input type="text" name="" class="nuevoid_pedidop">
          <input type="text" name="" value="0" class="nuevosaldo_anteriorp">
          <input type="text" name="" value="0" class="nuevoabonop">
          <input type="text" name="" class="nuevosaldo_actualp">
        </form>

        <br>
        <div class="row">
        <div class="col-md-4" align="center">
          <span>Pedido</span>
          <h3 class="pedido">Nombre del pedido</h3>
        </div>
        <div class="col-md-4" align="center">
          <span>Proveedor</span>
          <h3 class="proveedor">Nombre del proveedor</h3>   
        </div>
        <div class="col-md-4" align="center">
          <span>monto</span>
          <h3 class="monto">Nombre del proveedor</h3>
        </div>
        </div>


      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th>Fecha</th>
            <th>Saldo Anterior</th>
            <th>Abono</th>
            <th>Saldo Actual</th>
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

<div id="modalAgregarpago" class="modal fade" role="dialog">
  
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

          <div class="box-body">


            <!-- ENTRADA PARA CAMPOS  -->


          <input type="text" name="nuevoid_pedido" class="nuevoid_pedidop" style="display: none;">
          <input type="text" name="nuevosaldo_anterior" class="nsaldo_anterior" style="display: none;">
          <input type="text" name="nuevosaldo_actual" class="nsaldo_actual" style="display: none;">


            <div class="form-group   " bis_skin_checked="1">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" value="" class="calendario nuevofecha_pedido form-control input-lg" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY"  name="" fecha="nuevofecha_pedido" placeholder="Ingresar Fecha" required>
                  <input type="text" class="oficial_nuevofecha_pedido" name="nuevofecha" style="display: none;">
              </div>
            </div>

            <div class="form-group   " bis_skin_checked="1">
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=" fa fa-money"></i></span>
                <input type="number" class="form-control input-lg input_monto_pago" name="nuevoabono" placeholder="Ingresar Abono" value="" autocomplete="off" required="" step="0.01">
              </div>
            </div>
         


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary guardar">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladorpago();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarpago" class="modal fade" role="dialog">
  
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


            <input type="text" name="editarid" id="editarid">
          <input type="text" name="editarid_pedido" id="editarid_pedido"  style="display: none;">
          <input type="text" name="editarsaldo_anterior" id="editarsaldo_anterior" style="display: none;">
          <input type="text" name="editarsaldo_actual" id="editarsaldo_actual" class="esaldo_actual" style="display: none;">


            <div class="form-group   " bis_skin_checked="1">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" value="" class="calendario editarfecha_pedido form-control input-lg" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY"  name="" fecha="editarfecha_pedido" placeholder="Ingresar Fecha" required id="editarfecha2">
                  <input type="text" class="oficial_editarfecha_pedido" name="editarfecha" id="editarfecha" style="display: none;">
              </div>
            </div>

            <div class="form-group   " bis_skin_checked="1">
              <div class="input-group" bis_skin_checked="1">
                <span class="input-group-addon"><i class=" fa fa-money"></i></span>
                <input type="number" class="form-control input-lg einput_monto_pago" name="editarabono" placeholder="Ingresar Abono" value="" autocomplete="off" required="" step="0.01" id="editarabono">
              </div>
            </div>





          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary editar">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladorpago();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorpago();
  $borrar -> ctrBorrar();

?> 



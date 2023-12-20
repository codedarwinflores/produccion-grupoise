
<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="armas" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
           
                <div class="col-md-12">
                            <div class="col-md-12">
                                    <div class="form-group">
                                       <label for="exampleInputEmail1">Seleccionar Reporte a Imprimir</label>
                                        <select name="reportes" class="form-control mi-selector" id="reportes">
                                        <option value="*"> Seleccionar Reporte</option>
                                        <option value="reporteinventarioarma">Reporte Inventario Arma</option>
                                        <option value="reportevencimientoarma">Reporte Vencimiento Arma</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-12">
                              <br>
                                <a href="" class="btn btn-primary iraimprimir">Imprimir</a>
                            </div>
                                    
                </div>
                                
            </div>
                        
         </div>
       </div>
     </div>
   </div>
  </div>
 </section>
</div>

<script src="vistas/js/generarreporteinventario.js"></script>

<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);
</script>
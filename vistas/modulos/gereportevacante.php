
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
        <a href="todosreportes" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
           
                <div class="col-md-12">
    
                            <!-- ********************** -->
                            <div class="col-md-12 " >
                              <form action="reportevacante" method="post" target="_blank" >


                              <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Seleccionar Ubicacion</label>
                                                <select name="ubicacion" class="form-control mi-selector" >
                                                  <option value="*"> Todos las Ubicación</option>
                                                  <?php
                                                    function ubicacion() {
                                                      $query = "SELECT * from tbl_clientes_ubicaciones ORDER BY id ASC";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = ubicacion();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["codigo_ubicacion"].">".$value["nombre_ubicacion"]."</option>";
                                                      }
                                                  ?>
                                                </select>
                                            </div>
                                    </div>


                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Fecha Planilla Desde:</label>
                                  <input type="text" class="calendario form-control " name="fecha_desde" id=""    readonly placeholder="Fecha Desde">
                                </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha Planilla Hasta:</label>
                                    <input type="text" class="calendario form-control " name="fecha_hasta" id=""    readonly placeholder="Fecha Hasta">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Estado:</label>
                                    <select name="estado_vacante" class="form-control">
                                        <option value="*">Todas las Vacantes</option>
                                        <option value="Cubierta">Cubierta</option>
                                        <option value="Pendiente">Pendiente</option>
                                    </select>
                                  </div>
                              </div>


                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->


                           
                                    
                </div>
                                
            </div>
                        
         </div>
       </div>
     </div>
   </div>
  </div>
 </section>
</div>

<script src="vistas/js/cargarplanillas.js"></script>

<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);
</script>
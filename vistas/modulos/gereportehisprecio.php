
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
                              <form action="reportehisprecio" method="post" target="_blank" >

                              <div class="col-md-3">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Fecha  Desde:</label>
                                  <input type="text" class="calendario form-control" name="fecha_desde" id=""  value="00-00-0000"   readonly placeholder="Fecha Desde">
                                </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Fecha  Hasta:</label>
                                    <input type="text" class="calendario form-control" name="fecha_hasta" id=""  value="00-00-0000"  readonly placeholder="Fecha Hasta">
                                  </div>
                              </div>

                              <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Seleccionar cliente</label>
                                            <select name="cliente" id="cliente" class="form-control mi-selector cliente" >
                                              <option value="*">Todos los clientes</option>
                                              <?php
                                                
                                                function cliente() {
                                                  $query = "SELECT*FROM clientes";
                                                  $sql = Conexion::conectar()->prepare($query);
                                                  $sql->execute();			
                                                  return $sql->fetchAll();
                                                  };

                                                  $data = cliente();
                                                  foreach($data as $value) {
                                                  echo "<option value=".$value["codigo"].">".$value["nombre"]."</option>";
                                                  }
                                              ?>
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
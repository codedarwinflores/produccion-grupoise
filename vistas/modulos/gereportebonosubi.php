
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
                              <form action="reportebonosubi" method="post" target="_blank" >

                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Seleccionar Ubicación</label>
                                                <select name="ubicacion" class="form-control mi-selector" >
                                                  <option value="*"> Todas las Ubicaciones</option>
                                                  <?php
                                                    function ubicacion() {
                                                      $query = "SELECT * from tbl_clientes_ubicaciones ORDER BY id ASC";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = ubicacion();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["id"].">".$value["nombre_ubicacion"]."</option>";
                                                      }
                                                  ?>
                                                </select>
                                            </div>
                                    </div>

                                <br>
                                <input type="submit" value="Imprimir" class="btn btn-primary">
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
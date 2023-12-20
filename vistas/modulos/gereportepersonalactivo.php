
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
                              <form action="reportepersonalactivo" method="post" target="_blank" >

                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Seleccionar Cargo</label>
                                                <select name="cargo" class="form-control mi-selector" >
                                                  <option value="*"> Todos los cargos</option>
                                                  <?php
                                                    function ubicacion() {
                                                      $query = "SELECT * from cargos_desempenados ORDER BY id ASC";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = ubicacion();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["id"].">".$value["descripcion"]."</option>";
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
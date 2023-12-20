
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
                              <form action="reporteafp" method="post" target="_blank" >
                                
                                <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Planilla</label>
                                          <select name="numero" class="form-control mi-selector" >
                                            <option value="*"> Seleccionar</option>
                                            <?php
                                              function planilladevengo_admin() {
                                                $query = "SELECT * from planilladevengo_admin ORDER BY id ASC";
                                                $sql = Conexion::conectar()->prepare($query);
                                                $sql->execute();			
                                                return $sql->fetchAll();
                                                };
                                                $data = planilladevengo_admin();
                                                foreach($data as $value) {
                                                echo "<option value=".$value["numero_planilladevengo_admin"].">".$value["numero_planilladevengo_admin"].' Planilla desde '.$value["fecha_desde_planilladevengo_admin"].' al '.$value["fecha_hasta_planilladevengo_admin"]."</option>";
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


<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);
</script>
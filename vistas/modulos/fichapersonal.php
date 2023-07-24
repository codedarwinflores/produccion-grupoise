
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
        <a href="empleados" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
            <form action="vistas/modulos/pdffichapersonal.php" method="post" target="_blank" >
                <div class="col-md-12">
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Agente Desde</label>
                                    <select name="agentedesde" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar Agente</option>
                                        <?php
                                        function agente() {
                                            $query = "SELECT * from tbl_empleados order by id ASC";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            };
                                            $data = agente();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"]."</option>";
                                            }
                                        ?>
                                        </select>
                                        
                                    </div>
                            </div>

                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Agente Hasta</label>
                                    <select name="agentehasta" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar Agente</option>
                                        <?php
                                       
                                            $data = agente();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"]."</option>";
                                            }
                                        ?>
                                        </select>
                                        
                                    </div>
                            </div>

                  
                    
                                  
                                    <div class="col-md-12">
                                    <br>
                                        <input type="submit" class="btn btn-primary" value="Imprimir">
                                    </div>
                                    
                                </div>
                                
                            </div>
                        
                    </div>
                </div>
            
            </form>
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

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
        <a href="radio" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
            <form action="vistas/modulos/reportelistadoradio.php" method="post" target="_blank" >
                <div class="col-md-12">
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Radio desde:</label>
                                    <select name="radio_desde" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar radio</option>
                                        <?php
                                        function radio() {
                                            $query = "SELECT * from tbl_radios ORDER BY id ASC";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            };
                                            $data = radio();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["codigo_radio"].'-'.$value["descripcion_radio"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Radio Hasta:</label>
                                    <select name="radio_hasta" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar radio</option>
                                        <?php
                                            $data = radio();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["codigo_radio"].'-'.$value["descripcion_radio"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Fecha</label>
                                                <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha"  placeholder="Ingresar Fecha" id="mascarafecha" readonly>
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
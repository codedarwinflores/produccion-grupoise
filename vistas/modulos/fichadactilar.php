
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
            <form action="vistas/modulos/pdfdactilar.php" method="post" target="_blank" >
                <div class="col-md-12">
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Agente</label>
                                    <select name="agente" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar Agente</option>
                                        <?php
                                        function agente() {
                                            $query = "SELECT * from tbl_empleados";
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
                                        <label for="exampleInputEmail1">Fechas</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fechainicial"  placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" value="" class="calendario  form-control fechaultimo" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fechaultimo"  placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>

                    
                                    <?php
                                        function configuracion() {
                                            $query = "SELECT * from configuracion";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            };
                                            $data = configuracion();
                                            $entrega;
                                            $dui;
                                            $tomadapor;
                                            foreach($data as $value) {
                                                $entrega=$value["entrega"];
                                                $dui=$value["dui"];
                                                $tomadapor=$value["impresion"];
                                            }
                                        ?>
                             <div class="col-md-12">
                                <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">Entrega</label>
                                        <input type="text" value="<?php echo $entrega; ?>" class="form-control"   name="entrega"  placeholder="Ingresar Entrega" >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEmail1">DUI</label>
                                        <input type="text" value="<?php echo $dui; ?>" class="calendario  form-control" name="dui"  placeholder="Ingresar DUI">
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Impresión tomada por</label>
                                        <input type="text" value="<?php echo $tomadapor; ?>" class="calendario  form-control" name="tomadapor"  placeholder="">
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
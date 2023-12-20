
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
                              <form action="reportedepoagricoladevengo" method="post" target="_blank" >
                              <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Ubicación</label>
                                          <select name="ubicacion" class="form-control mi-selector" >
                                            <option value="*"> Seleccionar</option>
                                            <?php
                                              function ubicacion() {
                                                $query = "SELECT * from clientes ORDER BY id ASC";
                                                $sql = Conexion::conectar()->prepare($query);
                                                $sql->execute();			
                                                return $sql->fetchAll();
                                                };
                                                $data = ubicacion();
                                                foreach($data as $value) {
                                                echo "<option value=".$value["id"].">".$value["nombre"]."</option>";
                                                }
                                            ?>
                                          </select>
                                      </div>
                              </div>
                              <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Tipo Empleado</label>
                                          <select class="form-control " name="tipo_empleado"  >                  
                                            <option value="*" id="*">Seleccionar tipo</option>
                                            <option value="Administrativo">Administrativo</option>
                                            <option value="Operativo">Operativo</option>
                                          </select>
                                      </div>
                              </div>

                              <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Banco</label>
                                          <select name="banco" class="form-control mi-selector" >
                                            <?php
                                              function bancos() {
                                                $query = "SELECT * from bancos where nombre LIKE'%Agricola%' ORDER BY id ASC";
                                                $sql = Conexion::conectar()->prepare($query);
                                                $sql->execute();			
                                                return $sql->fetchAll();
                                                };
                                                $data = bancos();
                                                foreach($data as $value) {
                                                echo "<option value=".$value["id"].">".$value["codigo"].'-'.$value["nombre"]."</option>";
                                                }
                                            ?>
                                            
                                          </select>
                                      </div>
                              </div>


                              
                              <!-- ********************** -->
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Seleccione el tipo de planilla</label>
                                  <select class="form-control tipo_planilla" name="tipo_planilla">
                                      <option value="*">Seleccione tipo planilla</option>
                                      <option value="planilladevengo_anticipo" devengos=''>Planilla de Anticipo</option>
                                      <option value="planilladevengo_vacacion" devengos='_vacacion'>Planilla de Vacacion</option>
                                      <option value="planilladevengo_aguinaldo" devengos='_aguinaldo'>Planilla de Aguinaldo</option>
                                      <option value="planilladevengo_gratifivaca" devengos='_gratifivaca'>Planilla de Gratificación por Vacación</option>
                                      <option value="planilladevengo_admin" devengos='_admin'>Planilla de Administratica</option>
                                  </select>
                                </div>
                              </div>
                              <input type="hidden" name="devengos_table" class="devengos_table">
                              <!-- ********************** -->
                              <div class="col-md-12">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Seleccionar Planilla</label>
                                          <select name="numero" class="form-control mi-selector cargardataplanilla" >
                                            <option value="*"> Seleccionar</option>
                                           
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
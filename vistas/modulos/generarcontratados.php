
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
            <form action="reportecontratados" method="post" target="_blank" >
                <div class="col-md-12">
                            <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="">Departamento 1</label>
                                    <select name="departamento1" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar Departamentos</option>
                                        <?php
                                        function agente() {
                                            $query = "SELECT * FROM `departamentos_empresa`order by id ASC";
                                            $sql = Conexion::conectar()->prepare($query);
                                            $sql->execute();			
                                            return $sql->fetchAll();
                                            };
                                            $data = agente();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["codigo"].'-'.$value["nombre"]."</option>";
                                            }
                                        ?>
                                        </select>
                                        
                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="">Departamento 2</label>
                                    <select name="departamento2" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar Departamentos</option>
                                        <?php
                                            $data = agente();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["codigo"].'-'.$value["nombre"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                            </div>

                            
                            <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Empleados</label>
                                    <select name="empleados" class="form-control mi-selector" >
                                        <option value="*"> Seleccionar Empleados</option>
                                        <?php
                                            $data = agente();
                                            foreach($data as $value) {
                                            echo "<option value=".$value["id"].">".$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["primer_apellido"]."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                            </div>

                            <div class="col-md-2">
                                    <div class="form-group">
                                    <label for="">Fecha desde</label>
                                    <input type="text" class="form-control calendario" name="fechadesde" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" readonly>
                                    </div>
                            </div>

                            <div class="col-md-2">
                                    <div class="form-group">
                                    <label for="">Fecha hasta</label>
                                    <input type="text" class="form-control calendario" name="fechahasta" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY" readonly>
                                    </div>
                            </div>

                            <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Agentes Reporte</label>
                                    <select name="reportado_a_pnc" class="form-control" required >
                                        <option value=""> Seleccionar Opción</option>
                                        <option value="No"> Sin Reportar</option>
                                        <option value="Si">Reportar sin Número</option>
                                        <option value="Si">Reportados</option>
                                        <option value="todos">Todos</option>
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="">Tipo Agentes</label>
                                    <select name="tipoagente" class="form-control" required >
                                        <option value=""> Seleccionar Opción</option>
                                        <option value="2"> Contratados</option>
                                        <option value="3">Inactivos</option>
                                        <option value="todos">Todos</option>
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
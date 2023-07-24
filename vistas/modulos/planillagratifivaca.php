<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Planilla Gratificación por Vacación";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  $query = "SHOW COLUMNS FROM planillagratifivaca";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="nuevaplanillagratifivaca?id=0" class="btn btn-primary" >
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </a>

      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- ***************** -->
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>No. Planilla</th>
                      <th>Descripción</th>
                      <th>Acciones</th>
          
                    </tr> 
          
                  </thead>
          
                  <tbody>
          
                  <?php
          
                  function planillagratifivaca() {
                    $query = "SELECT*FROM planilladevengo_gratifivaca group by numero_planilladevengo_gratifivaca";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                  };
                  $data01 = planillagratifivaca();
                  foreach($data01 as $value) {
                    echo ' <tr>
                            <td>'.$value["fecha_planilladevengo_gratifivaca"].'</td>
                            <td>'.$value["numero_planilladevengo_gratifivaca"].'</td>
                            <td>'.$value["descripcion_planilladevengo_gratifivaca"].'</td>';
          
                            
          
                            echo '<td>
          
                              <div class="btn-group">
                                  
                                <a href="nuevaplanillagratifivaca?id='.$value["numero_planilladevengo_gratifivaca"].'" class="btn btn-warning btnEditarabase" idabase="'.$value["id"].'"><i class="fa fa-pencil"></i></a>
          
                                <button class="btn btn-danger eliminarallplantilla" numero_planilladevengo_gratifivaca="'.$value["numero_planilladevengo_gratifivaca"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
          
                              </div>  
          
                            </td>
          
                          </tr>';
                  }
          
          
                  ?> 
          
                  </tbody>
          
                </table>

              </div>

          <!-- ***************** -->
        </div>

      </div>
    </div>

  </section>

</div>


<script src="vistas/js/planillagratifivaca.js"></script>


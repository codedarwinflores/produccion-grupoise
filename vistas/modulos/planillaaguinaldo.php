<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Planilla Aguinaldo";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  $query = "SHOW COLUMNS FROM planilladevengo_aguinaldo";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="nuevaplanillaaguinaldo?id=0" class="btn btn-primary" >
          
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
          
                  function planillaaguinaldo() {
                    $query = "SELECT*FROM planilladevengo_aguinaldo group by numero_planilladevengo_aguinaldo";
                    $sql = Conexion::conectar()->prepare($query);
                    $sql->execute();			
                    return $sql->fetchAll();
                  };
                  $data01 = planillaaguinaldo();
                  foreach($data01 as $value) {
                    echo ' <tr>
                            <td>'.$value["fecha_planilladevengo_aguinaldo"].'</td>
                            <td>'.$value["numero_planilladevengo_aguinaldo"].'</td>
                            <td>'.$value["descripcion_planilladevengo_aguinaldo"].'</td>';
          
                            
          
                            echo '<td>
          
                              <div class="btn-group">
                                  
                                <a href="nuevaplanillaaguinaldo?id='.$value["numero_planilladevengo_aguinaldo"].'" class="btn btn-warning btnEditarabase" idabase="'.$value["id"].'"><i class="fa fa-pencil"></i></a>
          
                                <button class="btn btn-danger eliminarallplantilla" numero_planilladevengo_aguinaldo="'.$value["numero_planilladevengo_aguinaldo"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
          
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


<script src="vistas/js/planillaaguinaldo.js"></script>


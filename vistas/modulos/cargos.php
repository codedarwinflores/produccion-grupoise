<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Cargos";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_cargos;
  $query = "SHOW COLUMNS FROM $nombretabla_cargos";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCargos">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Descripción</th>
            <th>Nivel</th>
            <th>Código Contable</th>
            <th>Personal Asignado</th>
            <th>Pago Feriados</th>
            <th>Cálculo</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = ControladorCargos::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["descripcion"].'</td>
                   <td>'.$value["nivel"].'</td>
                   <td>'.$value["codigo_contable"].'</td>
                   <td>'.$value["personal_asignado"].'</td>
                   <td>'.$value["pago_feriados"].'</td>
                   <td>'.$value["calculo"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarCargos" idCargos="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCargos"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarCargos" idCargos="'.$value["id"].'"  Codigo="'.$value["descripcion"].'"><i class="fa fa-times"></i></button>
 
                     </div>  
 
                   </td>
 
                 </tr>';
         }
 
 
         ?> 
 
         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarCargos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar <?php echo $Nombre_del_Modulo;?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CAMPOS  -->

          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group <?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off">

              </div>

            </div>

          <?php
             }
          ?>
             
             
          <!-- ***PERSONAL ASIGNADO -->
          <div id="personal" class="dropdown-content myDropdown_personal drop_personal">
            <span class="select_personal" personal="Si"> Si</span>
            <span class="select_personal" personal="No"> No</span>    
          </div>   
          <!-- *** -->

          
             
          <!-- ***PAGO FERIADO -->
          <div id="pagoferiado" class="dropdown-content myDropdown_pagoferiado drop_pagoferiado">
            <span class="select_pagoferiado" pagoferiado="Si"> Si</span>
            <span class="select_pagoferiado" pagoferiado="No"> No</span>    
          </div>   
          <!-- *** -->

                    <!-- ***PAGO FERIADO -->
          <div id="sueldo" class="dropdown-content myDropdown_sueldo drop_sueldo">
            <span class="select_sueldo" sueldo="Sueldo"> Sueldo </span>
            <span class="select_sueldo" sueldo="Sueldo+Tfijo"> Sueldo+Tfijo</span>    
          </div>   
          <!-- *** -->



          


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cargos</button>

        </div>

        <?php

          $crear = new ControladorCargos();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarCargos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar <?php echo $Nombre_del_Modulo?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id -- -->

<!--           <input type="hidden" name="id" id="editarid">
 -->

 
            <!-- ENTRADA PARA CAMPOS  -->

            <?php 
             $data = getContent();
             foreach($data as $row) {
           ?>
            <div class="form-group <?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg input_<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" placeholder="" value="" autocomplete="off">
 
              </div>

            </div>

          <?php
             }
          ?>
             

                          
          <!-- ***PERSONAL ASIGNADO -->
          <div id="personal2" class="dropdown-content myDropdown_personal drop_personal">
            <span class="select_personal" personal="Si"> Si</span>
            <span class="select_personal" personal="No"> No</span>    
          </div>   
          <!-- *** -->

          
             
          <!-- ***PAGO FERIADO -->
          <div id="pagoferiado2" class="dropdown-content myDropdown_pagoferiado drop_pagoferiado">
            <span class="select_pagoferiado" pagoferiado="Si"> Si</span>
            <span class="select_pagoferiado" pagoferiado="No"> No</span>    
          </div>   
          <!-- *** -->

                    <!-- ***PAGO FERIADO -->
          <div id="sueldo2" class="dropdown-content myDropdown_sueldo drop_sueldo">
            <span class="select_sueldo" sueldo="Sueldo"> Sueldo </span>
            <span class="select_sueldo" sueldo="Sueldo+Tfijo"> Sueldo+Tfijo</span>    
          </div>   
          <!-- *** -->



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new ControladorCargos();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new ControladorCargos();
  $borrar -> ctrBorrar();

?> 



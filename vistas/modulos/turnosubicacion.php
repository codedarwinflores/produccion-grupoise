<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Turnos Ubicación";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_tbl_ubicaciones_turnos;
  $query = "SHOW COLUMNS FROM $nombretabla_tbl_ubicaciones_turnos";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$url = "http://" . $host . $url;
$components = parse_url($url);
parse_str($components['query'], $results);
$idubicacion = $results['id'];
?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
      <a href="ubicacionc" class="btn btn-danger">Volver</a>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregartbl_ubicaciones_turnos">
          Agregar <?php echo $Nombre_del_Modulo;?>
        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>24h/r</th>
            <th>12h/d5</th>
            <th>12h/d6</th>
            <th>12h/n6</th>
            <th>12h/d7</th>
            <th>12h/n7</th>
            <th>Extraordinario</th>
            <th>Séptimo</th>
            <th>Turnos de comodín</th>
            <th>Notas</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladortbl_ubicaciones_turnos::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["24hr"].'</td>
                   <td>'.$value["12hde"].'</td>
                   <td>'.$value["12hd6"].'</td>
                   <td>'.$value["12hn6"].'</td>
                   <td>'.$value["12hd7"].'</td>
                   <td>'.$value["12hn7"].'</td>
                   <td>'.$value["extraordinario"].'</td>
                   <td>'.$value["septimo"].'</td>
                   <td>'.$value["turnos_comodin"].'</td>
                   <td>'.$value["notas"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditartbl_ubicaciones_turnos" idtbl_ubicaciones_turnos="'.$value["id"].'" data-toggle="modal" data-target="#modalEditartbl_ubicaciones_turnos"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminartbl_ubicaciones_turnos" idtbl_ubicaciones_turnos="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregartbl_ubicaciones_turnos" class="modal fade" role="dialog">
  
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
            <div class="form-group">
              <label for="" class="">24h/r</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_1" name="nuevo24hr" placeholder="Ingresar 24h/r" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group">
              <label for="" class="">  12h/d5 </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_2" name="nuevo12hde" placeholder="Ingresar 12h/d5" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">  12h/d6  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_3" name="nuevo12hd6" placeholder="Ingresar 12h/d6" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">  12h/n6  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_4" name="nuevo12hn6" placeholder="Ingresar  12h/n6" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">  12h/d7  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_5" name="nuevo12hd7" placeholder="Ingresar 12h/d7" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group">
              <label for="" class="">  12h/n7  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_6" name="nuevo12hn7" placeholder="Ingresar 12h/n7 " value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class=""> Extraordinario  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_7" name="nuevoextraordinario" placeholder="Ingresar Extraordinario" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class=""> Séptimo  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_8" name="nuevoseptimo" placeholder="Ingresar Séptimo" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group">
              <label for="" class="">  Turnos de comodín   </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_9" name="nuevoturnos_comodin" placeholder="Ingresar Turnos de comodín" value="0" autocomplete="off" required maxlength="3" readonly>
              </div>
            </div>

              <!-- ENTRADA PARA CAMPOS  -->
              <div class="form-group">
              <label for="" class="">  Notas   </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_10" name="nuevonotas" placeholder="Ingresar Notas" value="" autocomplete="off" required >
              </div>
            </div>

            <input type="hidden" name="nuevoidubicacion" value="<?php echo $idubicacion?>">
            <input type="hidden" name="nuevoid" value="">


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar <?php echo $Nombre_del_Modulo?></button>

        </div>

        <?php

          $crear = new Controladortbl_ubicaciones_turnos();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartbl_ubicaciones_turnos" class="modal fade" role="dialog">
  
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
            <!-- ENTRADA PARA CAMPOS  -->

            


            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">24h/r</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_1" name="editar24hr" id="editar24hr" placeholder="Ingresar 24h/r" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group">
              <label for="" class="">  12h/d5 </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_2" name="editar12hde" id="editar12hde" placeholder="Ingresar 12h/d5" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">  12h/d6  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_3" name="editar12hd6" id="editar12hd6" placeholder="Ingresar 12h/d6" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">  12h/n6  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_4" name="editar12hn6" id="editar12hn6" placeholder="Ingresar  12h/n6" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class="">  12h/d7  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_5" name="editar12hd7" id="editar12hd7" placeholder="Ingresar 12h/d7" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group">
              <label for="" class="">  12h/n7  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_6" name="editar12hn7" id="editar12hn7" placeholder="Ingresar 12h/n7 " value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class=""> Extraordinario  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_7" name="editarextraordinario" id="editarextraordinario" placeholder="Ingresar Extraordinario" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

            <!-- ENTRADA PARA CAMPOS  -->
            <div class="form-group">
              <label for="" class=""> Séptimo  </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_8" name="editarseptimo" id="editarseptimo" placeholder="Ingresar Séptimo" value="0" autocomplete="off" required maxlength="3"  oninput="validateNumber(this);">
              </div>
            </div>

             <!-- ENTRADA PARA CAMPOS  -->
             <div class="form-group">
              <label for="" class="">  Turnos de comodín   </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_9" name="editarturnos_comodin" id="editarturnos_comodin" placeholder="Ingresar Turnos de comodín" value="0" autocomplete="off" required maxlength="3" readonly>
              </div>
            </div>

              <!-- ENTRADA PARA CAMPOS  -->
              <div class="form-group">
              <label for="" class="">  Notas   </label> 
              <div class="input-group">
                <span class="input-group-addon"><i class=""></i></span> 
                <input type="text" class="form-control input-lg t_10" name="editarnotas" id="editarnotas" placeholder="Ingresar Notas" value="" autocomplete="off" required >
              </div>
            </div>

            <input type="hidden" name="editaridubicacion" id="editaridubicacion" value="<?php echo $idubicacion?>">
            <input type="hidden" name="editarid" id="editarid" value="">

          
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar <?php echo $Nombre_del_Modulo?></button>

        </div>

     <?php

          $editar = new Controladortbl_ubicaciones_turnos();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladortbl_ubicaciones_turnos();
  $borrar -> ctrBorrar();

?> 



<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Jefe de Operaciones";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_jefeoperacion;
  $query = "SHOW COLUMNS FROM $nombretabla_jefeoperacion";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarjefeoperacion">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha Registro</th>
            <th>ID Empleado</th>
            <th>Código Cliente</th>
            <th>Persona Contacto</th>
            <th>ID Patrulla</th>
            <th>¿Conoce al Coordinador de zona?</th>
            <th>Frecuencia visitas por mes</th>
            <th>Capacidad Respuesta</th>
            <th>Solución de problemas</th>
            <th>¿Hay supervisor de Perímetro?</th>
            <th>Actitud del Supervisor</th>
            <th>Exigencia en el cumplimiento del PON</th>
            <th>Solución Problemas</th>
            <th>Informa oportunamente novedades</th>
            <th>Puntualidad horarios</th>
            <th>Actitud del HS</th>
            <th>Presentación Personal</th>
            <th>Cumplimiento del PON</th>
            <th>Acata Indicaciones</th>
            <th>Informa oportunamente las novedades</th>
            <th>Atento a su servicio</th>
            <th>Atención hacia cliente</th>
            <th>Observaciones</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorjefeoperacion::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["fecha_registro"].'</td>
                   <td>'.$value["id_empleado"].'</td>
                   <td>'.$value["codigo_cliente"].'</td>
                   <td>'.$value["persona_contacto"].'</td>
                   <td>'.$value["id_patrulla"].'</td>
                   <td>'.$value["conoce_coordinador_zona"].'</td>
                   <td>'.$value["frecuencia_visitas_por_mes"].'</td>
                   <td>'.$value["capacidad_respuesta"].'</td>
                   <td>'.$value["solucion_de_problemas"].'</td>
                   <td>'.$value["hay_supervisor_perimetro"].'</td>
                   <td>'.$value["actitud_del_superior"].'</td>
                   <td>'.$value["exigencia_cumplimiento_pom"].'</td>
                   <td>'.$value["solucion_problemas"].'</td>
                   <td>'.$value["informa_oportunamente_novedades"].'</td>
                   <td>'.$value["puntualidad_horarios"].'</td>
                   <td>'.$value["actitud_hs"].'</td>
                   <td>'.$value["presentacion_personal"].'</td>
                   <td>'.$value["cumplimiento_pon"].'</td>
                   <td>'.$value["acata_indicaciones"].'</td>
                   <td>'.$value["informa_oportuna_novedades"].'</td>
                   <td>'.$value["atento_a_su_servicio"].'</td>
                   <td>'.$value["atencion_hacia_cliente"].'</td>
                   <td>'.$value["observaciones"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarjefeoperacion" idjefeoperacion="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarjefeoperacion"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarjefeoperacion" idjefeoperacion="'.$value["id"].'"  Codigo="'.$value["codigo_cliente"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarjefeoperacion" class="modal fade" role="dialog">
  
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
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-calendar"></i></span> 
                <input type="text" class="form-control input-lg calendario input_fecharegistro " placeholder="Fecha Registro" value="" autocomplete="off" required data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY" fecha="fecharegistro" id="">
                <input type="text" name="nuevofecha_registro" class="fecharegistro" style="display: none;">
              </div>
            </div>

            <!-- **** -->

            <div class="form-group">
              <div class="input-group">

              <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg " placeholder="Jefe de operaciones" value="" autocomplete="off" name="nuevoid_empleado" required id="">
              </div>
            </div>

            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-qrcode"></i></span> 
                <select name="nuevocodigo_cliente" class="form-control input-lg " required  id="">
                  <option value="">Seleccione Código Cliente</option>
                <?php
                    $datos_mostrar = Controladorclientes::ctrMostrar($item, $valor);
                    foreach ($datos_mostrar as $key => $value){
                ?>
                    <option value="<?php echo $value['clienteid'] ?>" codigo="<?php echo $value['clientecodigo'] ?>"><?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?></option>  
                <?php
                    }
                  ?>
                </select>
              </div>
            </div>

            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
                <input type="text" class="form-control input-lg   " placeholder="Persona Contacto" value="" autocomplete="off" name="nuevopersona_contacto" required id="">
              </div>
            </div>

            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa  fa-address-card"></i></span> 
                <input type="text" class="form-control input-lg   " placeholder="ID Patrulla" value="" autocomplete="off" name="nuevoid_patrulla" required id="">
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa  fa-address-book"></i></span> 
                <select name="nuevoconoce_coordinador_zona"  class="form-control input-lg" required id="">
                  <option value="">¿Conoce coordinador de zona?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>
             

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-address-book-o"></i></span> 
                <select name="nuevofrecuencia_visitas_por_mes"  class="form-control input-lg" required id="">
                  <option value="">Frecuencia de visitas por mes</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>
             
          
            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-group "></i></span> 
                <select name="nuevocapacidad_respuesta"  class="form-control input-lg" required id="">
                  <option value="">Capacidad Respuesta</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-leaf"></i></span> 
                <select name="nuevosolucion_de_problemas"  class="form-control input-lg" required id="">
                  <option value="">Solución de problemas</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>


            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
                <select name="nuevohay_supervisor_perimetro"  class="form-control input-lg" required id="">
                  <option value="">¿Hay supervisor de Perímetro?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
                <select name="nuevoactitud_del_superior"  class="form-control input-lg" required id="">
                  <option value="">Actitud del Supervisor</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>


            
            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-line-chart"></i></span> 
                <select name="nuevoexigencia_cumplimiento_pom"  class="form-control input-lg" required id="">
                  <option value="">Exigencia cumplimiento POM</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-magnet"></i></span> 
                <select name="nuevosolucion_problemas"  class="form-control input-lg" required id="">
                  <option value="">Solución Problemas</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>


            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-newspaper-o"></i></span> 
                <select name="nuevoinforma_oportunamente_novedades"  class="form-control input-lg" required id="">
                  <option value="">Informa Oportunamente las Novedades</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-hourglass-2 "></i></span> 
                <select name="nuevopuntualidad_horarios"  class="form-control input-lg" required id="">
                  <option value="">Puntualidad en Horarios</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>


            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-id-card-o"></i></span> 
                <select name="nuevoactitud_hs"  class="form-control input-lg" required id="">
                  <option value="">Actitud HS</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>




            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
                <select name="nuevopresentacion_personal"  class="form-control input-lg" required id="">
                  <option value="">Presentacion Personal</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>


            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-bar-chart"></i></span> 
                <select name="nuevocumplimiento_pon"  class="form-control input-lg" required id="">
                  <option value="">Cumplimiento PON</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>


            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-cubes"></i></span> 
                <select name="nuevoacata_indicaciones"  class="form-control input-lg" required id="">
                  <option value="">Acata indicaciones</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-file-powerpoint-o"></i></span> 
                <select name="nuevoinforma_oportuna_novedades"  class="form-control input-lg" required id="">
                  <option value="">Informa oportunamente las novedades</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>

            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-flash "></i></span> 
                <select name="nuevoatento_a_su_servicio"  class="form-control input-lg" required id="">
                  <option value="">Atento a su servicio</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>



            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-hand-paper-o"></i></span> 
                <select name="nuevoatencion_hacia_cliente"  class="form-control input-lg" required id="">
                  <option value="">Atento hacia el cliente</option>
                  <option value="Excelente">Excelente</option>
                  <option value="Bueno">Bueno</option>
                  <option value="Malo">Malo</option>
                </select>
              </div>
            </div>



            
            <!-- **** -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ fa fa-eye"></i></span> 
                <input type="text" class="form-control input-lg   " placeholder="Observaciones" value="" autocomplete="off" name="nuevoobservaciones" required id="">
              </div>
            </div>

            



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

          $crear = new Controladorjefeoperacion();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarjefeoperacion" class="modal fade" role="dialog">
  
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





        <div class="box-body">

<!-- ENTRADA PARA CAMPOS  -->

<input type="text" name="editarid" id="editarid" style="display: none;">

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-calendar"></i></span> 
    <input type="text" class="form-control input-lg calendario einput_efecharegistro " placeholder="Fecha Registro" value="" autocomplete="off" required data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY" fecha="efecharegistro" id="editarfecha_registro2">
    <input type="text" name="editarfecha_registro" class="efecharegistro" id="editarfecha_registro" style="display: none;">
  </div>
</div>

<!-- **** -->

<div class="form-group">
  <div class="input-group">

  <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
    <input type="text" class="form-control input-lg " placeholder="Jefe de operaciones" value="" autocomplete="off" name="editarid_empleado" required id="editarid_empleado">
  </div>
</div>

<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-qrcode"></i></span> 
    <select name="editarcodigo_cliente" class="form-control input-lg " required  id="editarcodigo_cliente">
      <option value="">Seleccione Código Cliente</option>
    <?php
        $datos_mostrar = Controladorclientes::ctrMostrar($item, $valor);
        foreach ($datos_mostrar as $key => $value){
    ?>
        <option value="<?php echo $value['clienteid'] ?>" codigo="<?php echo $value['clientecodigo'] ?>"><?php echo $value['clienteid'] ?> - <?php echo $value["clientenombre"] ?></option>  
    <?php
        }
      ?>
    </select>
  </div>
</div>

<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
    <input type="text" class="form-control input-lg   " placeholder="Persona Contacto" value="" autocomplete="off" name="editarpersona_contacto" required id="editarpersona_contacto">
  </div>
</div>

<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa  fa-address-card"></i></span> 
    <input type="text" class="form-control input-lg   " placeholder="ID Patrulla" value="" autocomplete="off" name="editarid_patrulla" required id="editarid_patrulla">
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa  fa-address-book"></i></span> 
    <select name="editarconoce_coordinador_zona"  class="form-control input-lg" required id="editarconoce_coordinador_zona">
      <option value="">¿Conoce coordinador de zona?</option>
      <option value="Si">Si</option>
      <option value="No">No</option>
    </select>
  </div>
</div>
 


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-address-book-o"></i></span> 
    <select name="editarfrecuencia_visitas_por_mes"  class="form-control input-lg" required id="editarfrecuencia_visitas_por_mes">
      <option value="">Frecuencia de visitas por mes</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>
 


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-group "></i></span> 
    <select name="editarcapacidad_respuesta"  class="form-control input-lg" required id="editarcapacidad_respuesta">
      <option value="">Capacidad Respuesta</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-leaf"></i></span> 
    <select name="editarsolucion_de_problemas"  class="form-control input-lg" required id="editarsolucion_de_problemas">
      <option value="">Solución de problemas</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
    <select name="editarhay_supervisor_perimetro"  class="form-control input-lg" required id="editarhay_supervisor_perimetro">
      <option value="">¿Hay supervisor de Perímetro?</option>
      <option value="Si">Si</option>
      <option value="No">No</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
    <select name="editaractitud_del_superior"  class="form-control input-lg" required id="editaractitud_del_superior">
      <option value="">Actitud del Supervisor</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>




<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-line-chart"></i></span> 
    <select name="editarexigencia_cumplimiento_pom"  class="form-control input-lg" required id="editarexigencia_cumplimiento_pom">
      <option value="">Exigencia cumplimiento POM</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-magnet"></i></span> 
    <select name="editarsolucion_problemas"  class="form-control input-lg" required id="editarsolucion_problemas">
      <option value="">Solución Problemas</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>



<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-newspaper-o"></i></span> 
    <select name="editarinforma_oportunamente_novedades"  class="form-control input-lg" required id="editarinforma_oportunamente_novedades">
      <option value="">Informa Oportunamente Novedades</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-hourglass-2 "></i></span> 
    <select name="editarpuntualidad_horarios"  class="form-control input-lg" required id="editarpuntualidad_horarios">
      <option value="">Puntualidad en Horarios</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>



<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-id-card-o"></i></span> 
    <select name="editaractitud_hs"  class="form-control input-lg" required id="editaractitud_hs">
      <option value="">Actitud HS</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>





<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-user"></i></span> 
    <select name="editarpresentacion_personal"  class="form-control input-lg" required id="editarpresentacion_personal">
      <option value="">Presentacion Personal</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-bar-chart"></i></span> 
    <select name="editarcumplimiento_pon"  class="form-control input-lg" required id="editarcumplimiento_pon">
      <option value="">Cumplimiento PON</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>



<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-cubes"></i></span> 
    <select name="editaracata_indicaciones"  class="form-control input-lg" required id="editaracata_indicaciones">
      <option value="">Acata indicaciones</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-file-powerpoint-o"></i></span> 
    <select name="editarinforma_oportuna_novedades"  class="form-control input-lg" required id="editarinforma_oportuna_novedades">
      <option value="">Informa oportunamente novedades</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>


<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-flash "></i></span> 
    <select name="editaratento_a_su_servicio"  class="form-control input-lg" required id="editaratento_a_su_servicio">
      <option value="">Atento a su servicio</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>



<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-hand-paper-o"></i></span> 
    <select name="editaratencion_hacia_cliente"  class="form-control input-lg" required id="editaratencion_hacia_cliente">
      <option value="">Atento hacia el cliente</option>
      <option value="Excelente">Excelente</option>
      <option value="Bueno">Bueno</option>
      <option value="Malo">Malo</option>
    </select>
  </div>
</div>




<!-- **** -->

<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="icono_ fa fa-eye"></i></span> 
    <input type="text" class="form-control input-lg   " placeholder="Observaciones" value="" autocomplete="off" name="editarobservaciones" required id="editarobservaciones">
  </div>
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

          $editar = new Controladorjefeoperacion();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorjefeoperacion();
  $borrar -> ctrBorrar();

?> 



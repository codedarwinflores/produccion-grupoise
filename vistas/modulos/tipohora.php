<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Tipo Hora Extra";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_tipohora;
  $query = "SHOW COLUMNS FROM $nombretabla_tipohora";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregartipohora">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Codigo</th>
            <th>Motivo</th>
            <th>Requiere Agente a Cubrir?</th>
            <th>Descontar?</th>
            <th>Cobrar Cliente?</th>
            <th>Requiere ingreso Hora?</th>
            <th>Solicitado Por?</th>
            <th>Reporte?</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladortipohora::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$value["codigo_tipohora"].'</td>
                   <td>'.$value["motivo_tipohora"].'</td>
                   <td>'.$value["requiere_agente_tipohora"].'</td>
                   <td>'.$value["descontar_tipohora"].'</td>
                   <td>'.$value["cobrar_cliente_tipohora"].'</td>
                   <td>'.$value["ingreso_hora_tipohora"].'</td>
                   <td>'.$value["solicitado_tipohora"].'</td>
                   <td>'.$value["reporte_tipohora"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditartipohora" idtipohora="'.$value["id"].'" data-toggle="modal" data-target="#modalEditartipohora"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminartipohora" idtipohora="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregartipohora" class="modal fade" role="dialog">
  
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

                <input type="hidden" class="form-control input-lg input_id" name="nuevoid" id="nuevoid" placeholder="" value="" autocomplete="off">
         

            <div class="form-group   grupotipohora_codigo_tipohora mostrarmensajevalidar">
              <label for="" class="">Ingresar Código</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_codigo_tipohora"></i></span> 
                <input type="text" class="form-control input-lg input_codigo_tipohora validarcodigo" name="nuevocodigo_tipohora" id="nuevocodigo_tipohora" placeholder="Ingresar Código" value="" autocomplete="off" required="" maxlength="3" oninput="validateNumber(this);" tablaname="tipohora" columna="codigo_tipohora">
              </div>
            </div>

            <div class="form-group   grupotipohora_motivo_tipohora">
              <label for="" class="">Ingresar Motivo</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_motivo_tipohora"></i></span> 
                <input type="text" class="form-control input-lg input_motivo_tipohora" name="nuevomotivo_tipohora" id="nuevomotivo_tipohora" placeholder="Ingresar Motivo" value="" autocomplete="off" required="">
              </div>
            </div>

            <div class="form-group   grupotipohora_requiere_agente_tipohora col-md-6">
              <label for="" class="">Requiere Agente a Cubrir?</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_requiere_agente_tipohora"></i></span> 

                <select class="form-control input-lg input_requiere_agente_tipohora" name="nuevorequiere_agente_tipohora" id="nuevorequiere_agente_tipohora">
                  <option value="">Requiere Agente a Cubrir?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>


              </div>
            </div>

            <div class="form-group   grupotipohora_descontar_tipohora col-md-6">
              <label for="" class="">Descontar?</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_descontar_tipohora"></i></span> 
            
                <select class="form-control input-lg input_descontar_tipohora" name="nuevodescontar_tipohora" id="nuevodescontar_tipohora">
                  <option value="">Descontar?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>


              </div>
            </div>

            <div class="form-group   grupotipohora_cobrar_cliente_tipohora col-md-6">
              <label for="" class="">Cobrar a Cliente?</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_cobrar_cliente_tipohora"></i></span> 
     
                <select class="form-control input-lg input_cobrar_cliente_tipohora" name="nuevocobrar_cliente_tipohora" id="nuevocobrar_cliente_tipohora">
                  <option value="">Cobrar a Cliente?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>


              </div>
            </div>

            <div class="form-group   grupotipohora_solicitado_tipohora col-md-6">
              <label for="" class="">Solicitado por?</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_solicitado_tipohora"></i></span> 
      
                <select class="form-control input-lg input_solicitado_tipohora" name="nuevosolicitado_tipohora" id="nuevosolicitado_tipohora">
                  <option value="">Solicitado por?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>


              </div>
            </div>

            <div class="form-group   grupotipohora_ingreso_hora_tipohora col-md-6">
              <label for="" class="">Requiere Ingreso Hora?</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_ingreso_hora_tipohora"></i></span> 
                <select class="form-control input-lg input_ingreso_hora_tipohora" name="nuevoingreso_hora_tipohora" id="nuevoingreso_hora_tipohora">
                  <option value="">Requiere Ingreso Hora?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            

            <div class="form-group   grupotipohora_reporte_tipohora col-md-6">
              <label for="" class="">Reporte?</label> 
              <div class="input-group">
                <span class="input-group-addon"><i class="icono_reporte_tipohora"></i></span> 
                <select class="form-control input-lg input_reporte_tipohora" name="nuevoreporte_tipohora" id="nuevoreporte_tipohora">
                  <option value="">Reporte?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
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

          $crear = new Controladortipohora();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditartipohora" class="modal fade" role="dialog">
  
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

            

  <input type="hidden" class="form-control input-lg input_id" name="editarid" id="editarid" placeholder="" value="" autocomplete="off">
         

         <div class="form-group   grupotipohora_codigo_tipohora mostrarmensajevalidar">
           <label for="" class="">Ingresar Código</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_codigo_tipohora"></i></span> 
             <input type="text" class="form-control input-lg input_codigo_tipohora validarcodigo" name="editarcodigo_tipohora" id="editarcodigo_tipohora" placeholder="Ingresar Código" value="" autocomplete="off" required="" maxlength="3" oninput="validateNumber(this);" tablaname="tipohora" columna="codigo_tipohora">
           </div>
         </div>

         <div class="form-group   grupotipohora_motivo_tipohora">
           <label for="" class="">Ingresar Motivo</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_motivo_tipohora"></i></span> 
             <input type="text" class="form-control input-lg input_motivo_tipohora" name="editarmotivo_tipohora" id="editarmotivo_tipohora" placeholder="Ingresar Motivo" value="" autocomplete="off" required="">
           </div>
         </div>

         <div class="form-group   grupotipohora_requiere_agente_tipohora col-md-6">
           <label for="" class="">Requiere Agente a Cubrir?</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_requiere_agente_tipohora"></i></span> 

             <select class="form-control input-lg input_requiere_agente_tipohora" name="editarrequiere_agente_tipohora" id="editarrequiere_agente_tipohora">
               <option value="">Requiere Agente a Cubrir?</option>
               <option value="Si">Si</option>
               <option value="No">No</option>
             </select>


           </div>
         </div>

         <div class="form-group   grupotipohora_descontar_tipohora col-md-6">
           <label for="" class="">Descontar?</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_descontar_tipohora"></i></span> 
         
             <select class="form-control input-lg input_descontar_tipohora" name="editardescontar_tipohora" id="editardescontar_tipohora">
               <option value="">Descontar?</option>
               <option value="Si">Si</option>
               <option value="No">No</option>
             </select>


           </div>
         </div>

         <div class="form-group   grupotipohora_cobrar_cliente_tipohora col-md-6">
           <label for="" class="">Cobrar a Cliente?</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_cobrar_cliente_tipohora"></i></span> 
  
             <select class="form-control input-lg input_cobrar_cliente_tipohora" name="editarcobrar_cliente_tipohora" id="editarcobrar_cliente_tipohora">
               <option value="">Cobrar a Cliente?</option>
               <option value="Si">Si</option>
               <option value="No">No</option>
             </select>


           </div>
         </div>

         <div class="form-group   grupotipohora_solicitado_tipohora col-md-6">
           <label for="" class="">Solicitado por?</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_solicitado_tipohora"></i></span> 
   
             <select class="form-control input-lg input_solicitado_tipohora" name="editarsolicitado_tipohora" id="editarsolicitado_tipohora">
               <option value="">Solicitado por?</option>
               <option value="Si">Si</option>
               <option value="No">No</option>
             </select>


           </div>
         </div>

         <div class="form-group   grupotipohora_ingreso_hora_tipohora col-md-6">
           <label for="" class="">Requiere Ingreso Hora?</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_ingreso_hora_tipohora"></i></span> 
             <select class="form-control input-lg input_ingreso_hora_tipohora" name="editaringreso_hora_tipohora" id="editaringreso_hora_tipohora">
               <option value="">Requiere Ingreso Hora?</option>
               <option value="Si">Si</option>
               <option value="No">No</option>
             </select>
           </div>
         </div>

         

         <div class="form-group   grupotipohora_reporte_tipohora col-md-6">
           <label for="" class="">Reporte?</label> 
           <div class="input-group">
             <span class="input-group-addon"><i class="icono_reporte_tipohora"></i></span> 
             <select class="form-control input-lg input_reporte_tipohora" name="editarreporte_tipohora" id="editarreporte_tipohora">
               <option value="">Reporte?</option>
               <option value="Si">Si</option>
               <option value="No">No</option>
             </select>
           </div>
         </div>

            <!-- ****************** -->

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

          $editar = new Controladortipohora();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladortipohora();
  $borrar -> ctrBorrar();

?> 



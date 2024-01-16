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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPregunta">
          
          Agregar Pregunta

        </button><br>
		
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>           
           <th style="width:10px">#</th>
           <th>Tipo</th>
           <th>Pregunta</th>          
           

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $preguntas = ControladorPregunta::ctrMostrarPregunta($item, $valor);

       foreach ($preguntas as $key => $value){
         
			$itemx = "id";
			$valorx = $value["id_tipo"];
			$tipoPreguntas = ControladorTipoPregunta::ctrMostrarTipoPregunta($itemx, $valorx);
		 
			//print_r($tipoPreguntas);
		 
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$tipoPreguntas['descripcion'].'</td>
                  <td>'.$value["pregunta"].'</td>
				  
                 ';
                  

                 

                  echo '<td>

                    <div class="btn-group">
                        
                      
					   <button class="btn btn-warning btnEditarPregunta" idPregunta="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPregunta"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger btnEliminarPregunta" idPregunta="'.$value["id"].'"  ><i class="fa fa-times"></i></button>
					  
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

<div id="modalAgregarPregunta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar  Pregunta</h4>
			
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            

           

            <!-- ENTRADA  -->
			<div class="s_idtipoarma">
              <label for="">Seleccione Tipo pregunta</label>
                <div class="input-group ">
                    <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                    <select name="nuevoTipo"  class="form-control input-lg" required>
                      <option value="">Seleccione Tipo </option>
						<?php
                        $datos_mostrar = ControladorTipoPregunta::ctrMostrarTipoPregunta($item, $valor);
                        foreach ($datos_mostrar as $key => $value){
							?>
							<option value="<?php echo $value['id'] ?>" ><?php echo $value["descripcion"] ?></option>  
							<?php
                        }
						?>
                      
                    </select>
                </div>
            </div>
            <div class="form-group">             
              <label for="">Ingresar Pregunta</label>
				<div class="input-group" style="width:100%">					
					<input type="text"  class="form-control input-lg"  name="nuevoPregunta" style="width:100%" >
				</div>
            </div>

			
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar </button>

        </div>

        <?php

          $crear = new ControladorPregunta();
          $crear -> ctrCrearPregunta();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarPregunta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar  Pregunta</h4>
			
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id -- -->

          <input type="hidden" name="editarIdPregunta" id="editarIdPregunta">

             <!-- ENTRADA PARA EL Codigo  -->
			
			 <!-- ENTRADA PARA EL Codigo  -->
			<div class="input-group">				
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 
                <select class="form-control input-lg" name="editarTipo" required>                  
					<option value="" id="editarTipo"></option>
					<option value="">Seleccione Tipo </option>
						<?php
						$datos_mostrar = ControladorTipoPregunta::ctrMostrarTipoPregunta($item, $valor);
						foreach ($datos_mostrar as $key => $value){
							?>
							<option value="<?php echo $value['id'] ?>" ><?php echo $value["descripcion"] ?></option>  
							<?php
						}
						?>         
                </select>
            </div>
			<div class="form-group">             
              <label for="">Ingresar Pregunta</label>
				<div class="input-group" style="width:100%">					
					<input type="text"  class="form-control input-lg"  name="editarPregunta" id="editarPregunta" style="width:100%">
				</div>
            </div>
			
			
			
			
			
          </div>

            
 <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar </button>

        </div>

		<?php

          $editar = new ControladorPregunta();
          $editar -> ctrEditarPregunta();

        ?> 

      </form>
          




          </div>

		</div>
	</div>
</div>

       

    </div>

 </div>



<?php

  $borrar = new ControladorPregunta();
  $borrar -> ctrBorrarPregunta();

?> 



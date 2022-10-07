<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Clientes";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_clientes;
  $query = "SHOW COLUMNS FROM $nombretabla_clientes";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarclientes">
          
          Agregar <?php echo $Nombre_del_Modulo;?>

        </button>

      </div>

      <div class="box-body">
        
      <input type="text" value="" class="calendario" data-lang="es" data-years="2015-2035" data-format="DD-MM-YYYY" style="display: none;">


      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          
          <tr>
            
            <th style="width:10px">#</th>
            
            <th>Fecha Apertura</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>NIT</th>
            <th>NRC</th>
            <th>Nombre Registro</th>
            <th>Giro</th>
            <th>Contribuyente</th>
            <th>Clasificación</th>
            <th>Tipo Cliente</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Teléfono 1</th>
            <th>Teléfono 2</th>
            <th>Fax</th>
            <th>Contacto</th>
            <th>País</th>
            <th>Departamento</th>
            <th>Municipio</th>
            <th>Límite Crédito</th>
            <th>Plazo</th>
            <th>Observaciones</th>
            <th>Cuenta Contable</th>
            <th>Acciones</th>
 
          </tr> 
 
         </thead>
 
         <tbody>
 
         <?php
 
         $item = null;
         $valor = null;
 
         $bancos = Controladorclientes::ctrMostrar($item, $valor);
 
        foreach ($bancos as $key => $value){
          
          $originalDate = $value["fecha_apertura"];
          $newDate = date("d-m-Y", strtotime($originalDate));

           echo ' <tr>
                   <td>'.($key+1).'</td>
                   <td>'.$newDate.'</td>
                   <td>'.$value["clientecodigo"].'</td>
                   <td>'.$value["clientenombre"].'</td>
                   <td>'.$value["nit"].'</td>
                   <td>'.$value["nrc"].'</td>
                   <td>'.$value["nombre_registro"].'</td>
                   <td>'.$value["giro"].'</td>
                   <td>'.$value["contribuyente"].'</td>
                   <td>'.$value["clasificacion"].'</td>
                   <td>'.$value["tipo_cliente"].'</td>
                   <td>'.$value["correo_electronico"].'</td>
                   <td>'.$value["direccion"].'</td>
                   <td>'.$value["telefono_1"].'</td>
                   <td>'.$value["telefono_2"].'</td>
                   <td>'.$value["fax"].'</td>
                   <td>'.$value["contacto"].'</td>
                   <td>'.$value["paisnombre"].'</td>
                   <td>'.$value["departamentonombre"].'</td>
                   <td>'.$value["Nombre_m"].'</td>
                   <td>'.$value["limite_credito"].'</td>
                   <td>'.$value["plazo"].'</td>
                   <td>'.$value["observaciones"].'</td>
                   <td>'.$value["cuenta_contable"].'</td>';
 
                  
 
                   echo '<td>
 
                     <div class="btn-group">
                         
                       <button class="btn btn-warning btnEditarclientes" idclientes="'.$value["clienteid"].'" data-toggle="modal" data-target="#modalEditarclientes"><i class="fa fa-pencil"></i></button>
 
                       <button class="btn btn-danger btnEliminarclientes" idclientes="'.$value["clienteid"].'"  Codigo="'.$value["clientenombre"].'"><i class="fa fa-times"></i></button>
 
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

<div id="modalAgregarclientes" class="modal fade" role="dialog">
  
  <div class="modal-dialog" >

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

            <input type="text" name="nuevoid_pais" id="campo_pais" class="id_pais" style="display: none;">
            <input type="text" name="nuevoid_departamento" id="campo_departamento" class="id_departamento" style="display: none;">
            <input type="text" name="nuevoid_municipio" id="campo_municipio" class="id_municipio" style="display: none;">

            
            <input type="text" name="nuevofecha_apertura" id="fecha_apertura" class="fecha_apertura" style="display: none;">

            

          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group <?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg  input_<?php echo $row['Field'];?>" name="nuevo<?php echo $row['Field'];?>" placeholder="" value=""  autocomplete="off">

              </div>

            </div>

          <?php
             }
          ?>
             


             
          <!-- ***CONTRIBUYENTE -->
          <div id="contribuyente" class="dropdown-content myDropdown_clientes_contribuyente drop_contribuyente">
            <span class="select_contribuyente" contribuyente="Si"> Si</span>
            <span class="select_contribuyente" contribuyente="No"> No</span>    
          </div>   
          <!-- *** -->

          <!-- ***CLASIFICACION -->
          <div id="clasificacion" class="dropdown-content myDropdown_clientes_clasificacion drop_clasificacion">
            <span class="select_clasificacion" clasificacion="A"> A</span>
            <span class="select_clasificacion" clasificacion="B"> B</span>
            <span class="select_clasificacion" clasificacion="C"> C</span>
            <span class="select_clasificacion" clasificacion="D"> D</span>
            <span class="select_clasificacion" clasificacion="E"> E</span>

          </div>   
          <!-- *** -->

          <!-- ***TIPO CLIENTE -->
          <div id="tipo_cliente" class="dropdown-content myDropdown_tipo_cliente drop_tipo_cliente">
            <span class="select_tipo_cliente" tipo_cliente="Activo">Activo</span>
            <span class="select_tipo_cliente" tipo_cliente="Exjuridico">Exjuridico</span>
            <span class="select_tipo_cliente" tipo_cliente="Juridico">Juridico</span>
            <span class="select_tipo_cliente" tipo_cliente="Irrecuperable">Irrecuperable</span>
            <span class="select_tipo_cliente" tipo_cliente="Inactivo">Inactivo</span>
            <span class="select_tipo_cliente" tipo_cliente="Mora">Mora</span>
          </div>   
          <!-- *** -->

          <!-- ***PAIS -->
          <!-- *** -->
          <div id="pais" class="dropdown-content myDropdown_pais drop_pais">
          <?php
              $datos_mostrar_pais = ControladorPaises::ctrMostrarPaises($item, $valor);
              foreach ($datos_mostrar_pais as $key => $value){
                echo ' <span class="select_pais"  idpais="'.$value["id"].'" nombrepais="'.$value["nombre"].'">'.$value["nombre"].'</span>';
              }
          ?>
          </div>   
          <!-- *** -->
          <!-- *** -->

          <!-- ***DEPARTAMENTO -->
          <!-- *** -->
          <div id="departamento" class="dropdown-content myDropdown_departamento drop_departamento">
          <?php
              $datos_mostrar_departamento = Controladorcat_departamento::ctrMostrar($item, $valor);
              foreach ($datos_mostrar_departamento as $key => $value){
                echo ' <span class="select_departamento"  iddepartamento="'.$value["id"].'" nombredepartamento="'.$value["Nombre"].'">'.$value["Nombre"].'</span>';
              }
          ?>
          </div>   
          <!-- *** -->
          <!-- *** -->


          <!-- ***MUNICIPIO -->
          <!-- *** -->
          <div id="municipio" class="dropdown-content myDropdown_municipio drop_municipio">
          
          </div>   
          <!-- *** -->
          <!-- *** -->



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

          $crear = new Controladorclientes();
          $crear -> ctrCrear();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarclientes" class="modal fade" role="dialog">
  
  <div class="modal-dialog" >

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
   <!-- ENTRADA PARA CAMPOS  -->

            <input type="text" name="editarid_pais" id="idpais" class="id_pais" style="display: none;">
            <input type="text" name="editarid_departamento" id="iddepartamento" class="id_departamento" style="display: none;">
            <input type="text" name="editarid_municipio" id="idmunicipio" class="id_municipio" style="display: none;">

            
            <input type="text" name="editarfecha_apertura" id="fecha_apertura" class="editarfecha_apertura2" style="display: none;">



          <?php 
             $data = getContent();
             foreach($data as $row) {
     
              /*  $datos = array("".$row['Field']."" => $_POST["nuevo".$row['Field'].""]); */
           ?>
            <div class="form-group  <?php echo $row['Field'];?>">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="icono_<?php echo $row['Field'];?>"></i></span> 

                <input type="text" class="form-control input-lg  input_<?php echo $row['Field'];?>" id="editar<?php echo $row['Field'];?>" name="editar<?php echo $row['Field'];?>" placeholder="" value="" required autocomplete="off">

              </div>

            </div>

          <?php
             }
          ?>
             


             
          <!-- ***CONTRIBUYENTE -->
          <div id="contribuyente2" class="dropdown-content myDropdown_clientes_contribuyente drop_contribuyente">
            <span class="select_contribuyente" contribuyente="Si"> Si</span>
            <span class="select_contribuyente" contribuyente="No"> No</span>    
          </div>   
          <!-- *** -->

          <!-- ***CLASIFICACION -->
          <div id="clasificacion2" class="dropdown-content myDropdown_clientes_clasificacion drop_clasificacion">
            <span class="select_clasificacion" clasificacion="A"> A</span>
            <span class="select_clasificacion" clasificacion="B"> B</span>
            <span class="select_clasificacion" clasificacion="C"> C</span>
            <span class="select_clasificacion" clasificacion="D"> D</span>
            <span class="select_clasificacion" clasificacion="E"> E</span>

          </div>   
          <!-- *** -->

          <!-- ***TIPO CLIENTE -->
          <div id="tipo_cliente2" class="dropdown-content myDropdown_tipo_cliente drop_tipo_cliente">
            <span class="select_tipo_cliente" tipo_cliente="Activo">Activo</span>
            <span class="select_tipo_cliente" tipo_cliente="Exjuridico">Exjuridico</span>
            <span class="select_tipo_cliente" tipo_cliente="Juridico">Juridico</span>
            <span class="select_tipo_cliente" tipo_cliente="Irrecuperable">Irrecuperable</span>
            <span class="select_tipo_cliente" tipo_cliente="Inactivo">Inactivo</span>
            <span class="select_tipo_cliente" tipo_cliente="Mora">Mora</span>
          </div>   
          <!-- *** -->

          <!-- ***PAIS -->
          <!-- *** -->
          <div id="pais2" class="dropdown-content myDropdown_pais drop_pais">
          <?php
              $datos_mostrar_pais = ControladorPaises::ctrMostrarPaises($item, $valor);
              foreach ($datos_mostrar_pais as $key => $value){
                echo ' <span class="select_pais"  idpais="'.$value["id"].'" nombrepais="'.$value["nombre"].'">'.$value["nombre"].'</span>';
              }
          ?>
          </div>   
          <!-- *** -->
          <!-- *** -->

          <!-- ***DEPARTAMENTO -->
          <!-- *** -->
          <div id="departamento2" class="dropdown-content myDropdown_departamento drop_departamento">
          <?php
              $datos_mostrar_departamento = Controladorcat_departamento::ctrMostrar($item, $valor);
              foreach ($datos_mostrar_departamento as $key => $value){
                echo ' <span class="select_departamento"  iddepartamento="'.$value["id"].'" nombredepartamento="'.$value["Nombre"].'">'.$value["Nombre"].'</span>';
              }
          ?>
          </div>   
          <!-- *** -->
          <!-- *** -->


          <!-- ***MUNICIPIO -->
          <!-- *** -->
          <div id="municipio2" class="dropdown-content myDropdown_municipio drop_municipio">
          
          </div>   
          <!-- *** -->
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

          $editar = new Controladorclientes();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorclientes();
  $borrar -> ctrBorrar();

?> 



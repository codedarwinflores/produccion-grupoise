<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="Configuración";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_configuracion;
  $query = "SHOW COLUMNS FROM $nombretabla_configuracion";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">


    <div class="box-header">
      <h3><?php echo $Nombre_del_Modulo;?></h3>
    </div>

      <div class="box-body">
 

        <?php
        function gettabla() {
          global $nombretabla_configuracion;
          $query = "SELECT count(*) as numero FROM $nombretabla_configuracion";
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();			
          return $sql->fetchAll();
        };

        $data = gettabla();
        foreach($data as $row) {
          echo "<input type='hidden' class='datos_vacios' value='".$row["numero"]."'>";
        }
        ?>


      <!-- ****FORMULARIO NUEVO*** -->
<!-- 
        <div class="formulario_nuevo">
          <form role="form" method="post" enctype="multipart/form-data">
                  <input type="text" name="nuevoid">
                  <div class="form-group">
                      <label for="" class="">Empresa</label> 
                      <div class="">
                          <select name="nuevoconf_empresa" id="" class="form-control input-lg" required>
                              <option value="">Seleccione Empresa</option>
                            <?php
                                $datos_mostrar = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);
                                foreach ($datos_mostrar as $key => $value){
                            ?>
                                <option value="<?php echo $value['nombre'] ?>" codigo="<?php echo $value['codigo_empresa'] ?>"><?php echo $value["nombre"] ?></option>  
                              <?php
                                }
                              ?>
                            </select>
                      </div>
                  </div>

                  <button class="btn btn-primary" >
                      Guardar <?php echo $Nombre_del_Modulo;?>
                  </button>
                
                  <?php

                      $crear = new Controladorconfiguracion();
                      $crear -> ctrCrear();

                    ?>
          </form>
        </div> -->


      <!-- FORMULARIO EDITAR -->

      
      <div class="formulario_editar">
          <form role="form" method="post" enctype="multipart/form-data">

          <?php
        function getid() {
          global $nombretabla_configuracion;
          $query = "SELECT * FROM $nombretabla_configuracion";
          $sql = Conexion::conectar()->prepare($query);
          $sql->execute();			
          return $sql->fetchAll();
        };

        $data = getid();
        foreach($data as $row) {
          echo "<input type='hidden' class='id_conf' name='editarid' value='".$row["id"]."'>";
        }
        ?>

                  <div class="form-group">
                      <label for="" class="">Empresa</label> 
                      <div class="">
                          <select name="editarconf_empresa" id="editarconf_empresa" class="form-control input-lg" required>
                              <option value="">Seleccione Empresa</option>
                            <?php
                                $datos_mostrar = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);
                                foreach ($datos_mostrar as $key => $value){
                            ?>
                                <option value="<?php echo $value['nombre'] ?>" codigo="<?php echo $value['codigo_empresa'] ?>"><?php echo $value["nombre"] ?></option>  
                              <?php
                                }
                              ?>
                            </select>
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Extra Diurna</label> 
                      <div class="">
                        <input type="number" id="editarextra_diurna" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="editarextra_diurna"  step="0.01">
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Extra Nocturna</label> 
                      <div class="">
                        <input type="number" id="editarextra_nocturna" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="editarextra_nocturna"  step="0.01">
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Extra Dominical Diurna</label> 
                      <div class="">
                        <input type="number" id="editarextra_dominical_diurna" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="editarextra_dominical_diurna"  step="0.01">
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label for="" class="">Extra Dominical Nocturna</label> 
                      <div class="">
                        <input type="number" id="editarextra_dominical_nocturna" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="editarextra_dominical_nocturna"  step="0.01">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="" class="">Periodo de Pago</label> 
                      <div class="">
                        <select name="editarperiodo_de_pago" id="editarperiodo_de_pago" class="form-control">
                                <option value="">Seleccione Periodo de Pago</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="" class="">Porcentaje de ISSS</label> 
                      <div class="">
                        <input type="number" id="editarporcentaje_isss" onKeyPress="if(this.value.length==5) return false;" class="form-control" name="editarporcentaje_isss"  step="0.01">
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Tope de ISSS</label> 
                      <div class="">
                        <input type="number" id="editartope_isss" onKeyPress="if(this.value.length==6) return false;" class="form-control" name="editartope_isss"  step="0.01">
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Salario Minimo</label> 
                      <div class="">
                        <input type="number" id="editarsalario_minimo" onKeyPress="if(this.value.length==6) return false;" class="form-control" name="editarsalario_minimo"  step="0.01">
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Ultimo Empleado</label> 
                      <div class="">

                      <?php
                        function getempleado() {
                          $query = "SELECT * FROM tbl_empleados order by id desc limit 1";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();			
                          return $sql->fetchAll();
                        };

                        $data = getempleado();
                        foreach($data as $row) {
                          echo '<input type="number" value='.$row["id"].' id="editarultimo_empreado" onKeyPress="if(this.value.length==6) return false;" class="form-control" name="editarultimo_empreado"  step="0.01" >';
                        }
                        ?>

                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Ultimo Proveedor</label> 
                      <div class="">
                        
                      <?php
                        function getproveedor() {
                          $query = "SELECT * FROM proveedores order by id desc limit 1";
                          $sql = Conexion::conectar()->prepare($query);
                          $sql->execute();			
                          return $sql->fetchAll();
                        };

                        $data = getproveedor();
                        foreach($data as $row) {
                          echo '<input type="number" value="'.$row["codigo"].'" id="editarultimo_proveedor" onKeyPress="if(this.value.length==6) return false;" class="form-control" name="editarultimo_proveedor"  step="0.01">';
                        }
                        ?>
                        
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Numero Registro</label> 
                      <div class="">
                        <input type="number" id="editarnum_registro" onKeyPress="if(this.value.length==4) return false;" class="form-control" name="editarnum_registro"  step="0.01">
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">IVA</label> 
                      <div class="">
                        <input type="number" id="editariva" onKeyPress="if(this.value.length==5) return false;" class="form-control" name="editariva"  step="0.01">
                      </div>
                  </div>

                          
                    <div class="form-group">
                      <label for="">Subir Firma Representante</label>
                      <div class="panel">Subir Firma Representante</div>
                      <input type="file" class="editarfirma_representante" name="select_editarfirma_representante">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail previsualizar1" width="100px">
                      <input type="hidden" name="editarfirma_representante" class="editarfirma_representante1" id="editarfirma_representante1">
                    </div>


                    <div class="form-group">
                      <label for="">Subir Firma y Sello Notario</label>
                      <div class="panel">Subir Firma y Sello Notario</div>
                      <input type="file" class="editarfirma_sello_notario" name="select_editarfirma_sello_notario">
                      <p class="help-block">Peso máximo de la foto 2MB</p>
                      <img src="vistas/img/empresas/default/anonymous.png" class="img-thumbnail previsualizar2" width="100px">
                      <input type="hidden" name="editarfirma_sello_notario" class="editarfirma_sello_notario1" id="editarfirma_sello_notario1">

                    </div>


                    
                  <div class="form-group">
                      <label for="" class="">Representante Legal</label> 
                      <div class="">
                        <input type="text" id="editarrepresentante_legal" onKeyPress="if(this.value.length==40) return false;" class="form-control" name="editarrepresentante_legal" >
                      </div>
                  </div>

                  
                    
                  <div class="form-group">
                      <label for="" class="">Cargo</label> 
                      <div class="">
                        <input type="text" id="editarcargo"  class="form-control" name="editarcargo" >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Dirección</label> 
                      <div class="">
                        <input type="text" id="editardireccion"  class="form-control" name="editardireccion"    onKeyPress="if(this.value.length==100) return false;" >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Teléfono</label> 
                      <div class="">
                        <input type="text" id="editartelefono"  class="form-control telefono" name="editartelefono"     >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Actividad Economica</label> 
                      <div class="">
                        <input type="text" id="editaractividad_economica"  class="form-control" name="editaractividad_economica"   onKeyPress="if(this.value.length==100) return false;"  >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">NIT</label> 
                      <div class="">
                        <input type="text" id="editarnit"  class="form-control nit" name="editarnit"   onKeyPress="if(this.value.length==100) return false;"  >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Numero Patronal</label> 
                      <div class="">
                        <input type="text" id="editarnum_patronal"  class="form-control " name="editarnum_patronal"   onKeyPress="if(this.value.length==12) return false;"  >
                      </div>
                  </div>

                  
                  
                  <div class="form-group">
                      <label for="" class="">Registro NRC</label> 
                      <div class="">
                        <input type="text" id="editarregistro"  class="form-control " name="editarregistro"   onKeyPress="if(this.value.length==12) return false;"  >
                      </div>
                  </div>

                  
                  
                  <div class="form-group">
                      <label for="" class="">País</label> 
                      <div class="">
                        <input type="text" id="editarpais"  class="form-control" name="editarpais"   >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Horas Extras</label> 
                      <div class="">
                        <input type="number" id="editarh_extra"  class="form-control" name="editarh_extra"  onKeyPress="if(this.value.length==12) return false;"  step="0.01" >
                      </div>
                  </div>
                  
                  
                  <div class="form-group">
                      <label for="" class="">Limite</label> 
                      <div class="">
                        <input type="number" id="editarlimite"  class="form-control" name="editarlimite"  onKeyPress="if(this.value.length==7) return false;"  step="0.01" >
                      </div>
                  </div>


                  
                  <div class="form-group">
                      <label for="" class="">Clave</label> 
                      <div class="">
                        <input type="text" id="editarclave"  class="form-control" name="editarclave"  onKeyPress="if(this.value.length==12) return false;"   >
                      </div>
                  </div>

                  
                  <div class="form-group">
                      <label for="" class="">Anticipo</label> 
                      <div class="">
                        <input type="number" id="editaranticipo"  class="form-control" name="editaranticipo"  onKeyPress="if(this.value.length==6) return false;"  step="0.01" >
                      </div>
                  </div>

                  

                  
                  <div class="form-group">
                      <label for="" class="">Entrega</label> 
                      <div class="">
                        <input type="text" id="editarentrega"  class="form-control" name="editarentrega"  onKeyPress="if(this.value.length==80) return false;"   >
                      </div>
                  </div>

                   
                  <div class="form-group">
                      <label for="" class="">DUI</label> 
                      <div class="">
                        <input type="text" id="editardui"  class="form-control duis" name="editardui" >
                      </div>
                  </div>


                  <div class="form-group">
                      <label for="" class="">Impresión tomada por:</label> 
                      <div class="">
                        <input type="text" id="editarimpresion"  class="form-control" name="editarimpresion"  onKeyPress="if(this.value.length==80) return false;" >
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="" class="">Doctor:</label> 
                      <div class="">
                        <input type="text" id="editardoctor"  class="form-control" name="editardoctor"  onKeyPress="if(this.value.length==80) return false;" >
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="" class="">Psicólogo:</label> 
                      <div class="">
                        <input type="text" id="editarpsicologo"  class="form-control" name="editarpsicologo"  onKeyPress="if(this.value.length==80) return false;" >
                      </div>
                  </div>


                  <a class="btn btn-success" href="diasferiados">Agregar Dia Feriado</a>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Numero Dias Feriados</th>
                        <th>Fechas Feriados</th>
                      </tr>
                    </thead>
                    
                    <tbody>
                        
                        <?php

                        $item = null;
                        $valor = null;

                        $dias = Controladordias_feriados::ctrMostrar($item, $valor);

                        foreach ($dias as $key => $value){
                          
                          echo ' <tr>
                                  <td>'.$value["num_dias"].'</td>
                                  <td>'.$value["fecha_desde"].' - '.$value["fecha_hasta"].'</td>';
                                  echo '</tr>';
                        }


                        ?> 

                      </tbody>
                  </table>

                  <button class="btn btn-primary" >
                      Guardar <?php echo $Nombre_del_Modulo;?>
                  </button>
                
                  <?php

                      $crear = new Controladorconfiguracion();
                      $crear -> ctrEditar();

                    ?>
          </form>
        </div>

      </div>


    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR 
======================================-->

<div id="modalAgregarconfiguracion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Dias Feriados</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id -- -->

          <input type="hidden" name="id" id="nuevoid">
            <!-- ENTRADA PARA CAMPOS  -->

            <div class="form-group">
               <label for="">Numero de Dias</label> 
                <div class="input-group">
                  <input type="text" class="form-control input-lg " name="nuevonum_dias" id="" placeholder="" value="" autocomplete="off" required>
                </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>

     <?php

          $crear = new Controladordias_feriados();
          $crear -> ctrCrear();

        ?> 

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarconfiguracion" class="modal fade" role="dialog">
  
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

          <input type="hidden" name="id" id="editarid">


 
            <!-- ENTRADA PARA CAMPOS  -->

            
            <div class="form-group">
               <label for="">Numero de Dias</label> 
              <div class="input-group">
                <input type="text" class="form-control input-lg " name="nuevonum_dias" id="" placeholder="" value="" autocomplete="off" required>
              </div>

            </div>

           <!-- <div id="editaroperadordiv">
             <label for="" class="">Seleccione Operador</label> 
            
             <div class="input-group" id="">
              <span class="input-group-addon"><i class="fa fa-server"></i></span> 
              <select name="editaroperador" id="editaroperador" class="form-control input-lg" required>
                <option value="">Seleccione Operador</option>
                <option value="Tigo">Tigo</option>
                <option value="Digicel">Digicel</option>
                <option value="Claro">Claro</option>
                <option value="Movistar">Movistar</option>
              </select>
             </div>
           </div> -->

           <?php
                    function operadoreditar() {
                      $query = "select * from ajustes where name_table='tarjetas_configuracion' and accion='editar' and elemento='Seleccione Operador'
                      ";
                      $sql = Conexion::conectar()->prepare($query);
                      $sql->execute();			
                      return $sql->fetchAll();
                    };
                  $data0 = operadoreditar();
                  foreach($data0 as $row0) {
                    echo $row0['code'];
                  }
                ?>


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

          $editar = new Controladorconfiguracion();
          $editar -> ctrEditar();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrar = new Controladorconfiguracion();
  $borrar -> ctrBorrar();

?> 



<script src="vistas/js/configuracion.js"></script>
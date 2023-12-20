
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
        <a href="todosreportes" class="btn btn-danger">Volver</a>
      </div>

      <div class="box-body">
        <div class="row">
           
                <div class="col-md-12">

                <!-- ******************* -->
                              <div class="col-md-12">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Selecciones Equipo:</label>
                                    <select name="" class="form-control equipo">
                                        <option value="*">Seleccione el equipo</option>
                                        <option value="celular">Celular</option>
                                        <option value="arma">Arma</option>
                                        <option value="otrosequipos">Otros Equipos</option>
                                        <option value="radio">Radio</option>
                                    </select>
                                  </div>
                              </div>

                            <!-- ********************** -->
                            <div class="col-md-12 celular " style="display: none;">
                              <form action="reporteinvencelular" method="post" target="_blank" id="form">

                                   <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Seleccionar Operador</label>
                                                <select name="operador" class="form-control mi-selector" >
                                                  <option value="*"> Todos los operadores</option>
                                                  <?php
                                                    function celular() {
                                                      $query = "SELECT * from celular group by operador_celular";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = celular();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["operador_celular"].">".$value["operador_celular"]."</option>";
                                                      }
                                                  ?>
                                                </select>
                                            </div>
                                    </div>

                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->

                            
                            <!-- ********************** -->
                            <div class="col-md-12 arma " style="display: none;">
                              <form action="reporteinvenarma" method="post" target="_blank" id="form">

                                   <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Seleccionar tipo arma</label>
                                                <select name="arma" class="form-control mi-selector" >
                                                  <option value="*"> Todos las armas</option>
                                                  <?php
                                                    function armas() {
                                                      $query = "SELECT * from tbl_tipos_de_armas ";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = armas();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["id"].">".$value["nombre_tipo"]."</option>";
                                                      }
                                                  ?>
                                                </select>
                                            </div>
                                    </div>

                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->

                            <!-- ********************** -->
                            <div class="col-md-12 otrosequipos" style="display: none;">
                              <form action="reporteinvenotroquipo" method="post" target="_blank" id="form">

                                   <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Seleccionar tipo equipo</label>
                                                <select name="equipos" class="form-control mi-selector" >
                                                  <option value="*"> Todos los equipos</option>
                                                  <?php
                                                    function otrosequipos() {
                                                      $query = "SELECT * from tipo_otros_equipos ";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = otrosequipos();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["id"].">".$value["nombre"]."</option>";
                                                      }
                                                  ?>
                                                </select>
                                            </div>
                                    </div>

                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->

                            
                            <!-- ********************** -->
                            <div class="col-md-12 radio" style="display: none;">
                              <form action="reporteinvenradio" method="post" target="_blank" id="form">

                                   <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Seleccionar tipo equipo</label>
                                                <select name="radio" class="form-control mi-selector" >
                                                  <option value="*"> Todos los equipos</option>
                                                  <?php
                                                    function radiotipos() {
                                                      $query = "SELECT * from tbl_tipos_de_radios ";
                                                      $sql = Conexion::conectar()->prepare($query);
                                                      $sql->execute();			
                                                      return $sql->fetchAll();
                                                      };
                                                      $data = radiotipos();
                                                      foreach($data as $value) {
                                                      echo "<option value=".$value["id"].">".$value["nombre"]."</option>";
                                                      }
                                                  ?>
                                                </select>
                                            </div>
                                    </div>

                                <br>
                                <div class="col-md-12">
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </div>
                              </form>
                            </div>
                            <!-- ********************* -->


                           
                                    
                </div>
                                
            </div>
                        
         </div>
       </div>
     </div>
   </div>
  </div>
 </section>
</div>

<script src="vistas/js/cargarplanillas.js"></script>

<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);


    
    $( ".equipo" ).on( "change", function() {
		var valor = $(this).val();
      $(".celular").attr("style","display:none");
      $(".arma").attr("style","display:none");
      $(".otrosequipos").attr("style","display:none");
      $(".radio").attr("style","display:none");


    if(valor=="celular"){
      $(".celular").attr("style","");
    }
    else if(valor=="arma"){
      $(".arma").attr("style","");
    }
    else if(valor=="otrosequipos"){
      $(".otrosequipos").attr("style","");
    }
    else if(valor=="radio"){
      $(".radio").attr("style","");
    }
    else{
     
      $(".celular").attr("style","display:none");
      $(".arma").attr("style","display:none");
      $(".otrosequipos").attr("style","display:none");
      $(".radio").attr("style","display:none");

    }
		/* var atributo = $(this).find("option:selected").attr("devengos");
		$(".devengos_table").val(atributo); */
	  
		})




</script>
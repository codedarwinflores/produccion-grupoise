
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
                            <!-- ********************** -->
                              <div class="col-md-12 ">
                                <form action="reportessf" method="post" target="_blank" >
                                  <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha Desde</label>
                                            <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha_desde"  placeholder="Ingresar Fecha" readonly>
                                        </div>
                                  </div>
                                  <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha hasta</label>
                                            <input type="text" value="" class="calendario  form-control fechainicial" data-lang="es" data-years="2010-2060" data-format="DD-MM-YYYY"  name="fecha_hasta"  placeholder="Ingresar Fecha" id="mascarafecha" readonly>
                                        </div>
                                  </div>
                                  <br>
                                  <input type="submit" value="Imprimir" class="btn btn-primary">
                                </form>
                              </div>
                            <!-- ********************* -->


                           
               
                                
            </div>
                        
         </div>
       </div>
     </div>
   </div>
  </div>
 </section>
</div>


<script>
    var date = new Date();
    var primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
    var hr2 = moment(primerDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');

    var ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    var hr3 = moment(ultimoDia,'DD/MM/YYYY HH:mm:ss a').format('DD-MM-YYYY');



    $(".fechainicial").val(hr2);
    $(".fechaultimo").val(hr3);
</script>
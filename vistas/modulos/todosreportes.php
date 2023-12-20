<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$Nombre_del_Modulo="REPORTES";

/* CAPTURAR NOMBRE COLUMNAS*/

function getContent() {
  global $nombretabla_abase;
  $query = "SHOW COLUMNS FROM $nombretabla_abase";
  $sql = Conexion::conectar()->prepare($query);
  $sql->execute();			
  return $sql->fetchAll();
};

?>
<div class="content-wrapper">

 

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  

      </div>

      <div class="box-body">
        
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
         <thead>
          <tr>
            <th>Nombre Reporte</th>
            <th>Nombre Modulo</th>
            <th>Acciones</th>
          </tr> 
         </thead>
 
         <tbody>
          <!-- ************* -->
          <tr>
            <td>REPORTE DE BONOS UNIDADES ACTIVAS</td>
            <td>UBICACION CLIENTE</td>
            <td>
              <a href="gereportebonosubi" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          <tr>
            <td>REPORTE DE PERSONAL ACTIVO</td>
            <td>EMPLEADOS</td>
            <td>
              <a href="gereportepersonalactivo" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          <!-- ************* -->
          <tr>
            <td>REPORTE ROTACION DE PERSONAL</td>
            <td>EMPLEADOS</td>
            <td>
              <a href="gereporterotacionper" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          <!-- ************* -->
          <tr>
            <td>HISTORIAL DE PRECIOS</td>
            <td>UBICACION CLIENTE</td>
            <td>
              <a href="gereportehisprecio" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          <!-- ************* -->
          <tr>
            <td>REPORTE DE HORAS NO CUBIERTAS</td>
            <td>SITUACIONES</td>
            <td>
              <a href="gereportehoranocubiertas" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          <!-- ************* -->
          <tr>
            <td>INFORME DE VACANTES</td>
            <td>VACANTES</td>
            <td>
              <a href="gereportevacante" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          <!-- ************* -->
          <tr>
            <td>REPORTE DE CONTRATOS</td>
            <td>CLIENTES</td>
            <td>
              <a href="gereportecontratos" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          <!-- ************* -->
          <tr>
            <td>REPORTE DE INVENTARIO EQUIPO</td>
            <td>EQUIPOS</td>
            <td>
              <a href="gereporteinvenequipo" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
          <!-- ************* -->
          <tr>
            <td>CONSOLIDADO RETENCIONES</td>
            <td>PLANILLAS</td>
            <td>
              <a href="gereporteretencion" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
          <!-- ************* -->
          <tr>
            <td>
                <select name="" id="reportesimprimir" class="form-control">
                  <option value="">Seleccione Reporte</option>
                  <option value="gereportedeposito">REPORTE OPCION DEPOSITO BANCO</option>
                  <!-- <option value="gereporteisss">REPORTE OPCION ISSS</option>
                  <option value="gereporteafp">REPORTE OPCION AFP</option> -->
                  <!-- <option value="gereporteplanilla">REPORTE PLANILLA NORMAL</option> -->
                  <option value="gereporteplanillanocontable">REPORTE PLANILLA OPCION POR NOMBRE NO CONTABLE</option>
                  <option value="gereporteplanillacontable">REPORTE PLANILLA OPCION POR NOMBRE  CONTABLE</option>
                  <option value="gereporteplanillacuotapatro">REPORTE PLANILLA OPCION CUOTAS PATRONALES</option>
                  <option value="gereporteplanillaadmin">REPORTE PLANILLA OPCION  ADMINISTRATIVA</option>
                  <option value="gereporteplanilladevengos">REPORTE PLANILLA OPCION  DEVENGOS</option>
                  <option value="gereportedepoagricola">FORMATO BANCO AGRICOLA</option>
                  <option value="gereportedepoagricolaadmin">FORMATO BANCO AGRICOLA ADMINISTRATIVA</option>
                  <option value="gereportedepoagricoladevengo">FORMATO BANCO AGRICOLA DEVENGOS</option>
                  <option value="gereportedepocusca">FORMATO BANCO CUSCATLAN</option>
                  <option value="gereportedepocuscaadmin">FORMATO BANCO CUSCATLAN ADMINISTRATIVA</option>
                  <option value="gereportedepocuscadevengo">FORMATO BANCO CUSCATLAN DEVENGOS</option>
                  <!-- ************************** -->
                  <option value="gereportedepodavivienda">FORMATO BANCO DAVIVIENDA</option>
                  <option value="gereportedepodaviadmin">FORMATO BANCO DAVIVIENDA ADMINISTRATIVA</option>
                  <option value="gereportedepodavidevengo">FORMATO BANCO DAVIVIENDA DEVENGOS</option>

                  <!-- ************************** -->

                  <option value="gereporteboletaejecutar">BOLETAS</option>
                  <option value="geanexosplanillaadmin">ANEXOS PLANILLA</option>
                  <!-- <option value="gereportehoraextra">REPORTE HORAS EXTRAS</option> ESTE REPORTE QUEDO INCOMPLETO PORQUE YA ESTA EN SITUACIONES -->
                  <option value="gereportessf">REPORTE SSF</option>
              </select>
              <br>
              <span>(Aqui se encuentran todos los reportes de las diferentes tipos de planillas)</span>
            </td>
            <td>PLANILLAS</td>
            <td>
              <a href="*" class="btn btn-success btnplanillas">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          
          <!-- ************* -->
          <tr>
            <td>PARTES DE SITUACION SERVICIO EVENTUAL, POR USUARIOS, POR FECHA INGRESO</td>
            <td>SITUACIONES</td>
            <td>
              <a href="gereporteservicioeventual" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
          <!-- ************* -->
          <tr>
            <td>REPORTES DE UBICACIONES</td>
            <td>UBICACIONES CLIENTES</td>
            <td>
              <a href="gereporteubicaciones" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
          <!-- ************* -->
          <tr>
            <td>REPORTES DE PERSONAL</td>
            <td>COLABORADORES</td>
            <td>
              <a href="gereportepersonal" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
          <!-- ************* -->
          <tr>
            <td>REPORTE DE FACTURACION X CLIENTE</td>
            <td>CLIENTE</td>
            <td>
              <a href="gereporteclientes" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

           <!-- ************* -->
           <tr>
            <td>REPORTE DE INCAPACIDAD</td>
            <td>MOVIMIENTO AGENTE</td>
            <td>
              <a href="gereporteincamovimiento" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>REPORTE FACTURACION</td>
            <td>FACTURACION</td>
            <td>
              <a href="gereportefactura" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

           <!-- ************* -->
           <tr>
            <td>LICENCIA DE PORTACION DE ARMA</td>
            <td>EMPLEADO</td>
            <td>
              <a href="gerelicenciaporarmacarnet" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>REPORTES A PNC</td>
            <td>PNC</td>
            <td>
              <a href="gereinvepncpersonal" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>REPORTE INICIO FINALIZACION DE SERVICIOS</td>
            <td>Ubicaciones Clientes</td>
            <td>
              <a href="gerefinservicios" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>REPORTE CAPACITACIONES</td>
            <td>EMPLEADOS</td>
            <td>
              <a href="gerecapacitacion" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
          
           <!-- ************* -->
           <tr>
            <td>KARDEX EQUIPO</td>
            <td>KARDEX</td>
            <td>
              <a href="gerekardex" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>FORMATO CONSTANCIA DE SUELDO</td>
            <td>EMPLEADO</td>
            <td>
              <a href="gerconstanciasueldo" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>TURNOS (TUNOS - SEPTIMOS)</td>
            <td>UBICACION DE CLIENTE</td>
            <td>
              <a href="gerturnos" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>LISTADO EQUIPOS CON UBICACION</td>
            <td>EQUIPOS</td>
            <td>
              <a href="grelistadoequipo" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>REPORTE MANTENIMIENTOS</td>
            <td>MANTENIMIENTO</td>
            <td>
              <a href="gremantenimiento" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>PERSONAL SIN/CON LICENCIA DE ARMA</td>
            <td>EMPLEADOS</td>
            <td>
              <a href="greemplelic" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>REPORTE DE INDEMNIZACION E AGUINALDO</td>
            <td>EMPLEADOS</td>
            <td>
              <a href="greindeaguinalemple" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->

          
           <!-- ************* -->
           <tr>
            <td>VENTAS</td>
            <td>VENTAS</td>
            <td>
              <a href="greventas" class="btn btn-success">Generar</a>
            </td>
          </tr>
          <!-- ************* -->
          
          



         </tbody>
 
        </table>

      </div>

    </div>

  </section>

</div>



<script>
   $( "#reportesimprimir" ).on( "change", function() {
   
   /* var descontar_tipohora = $('option:selected', this).attr("descontar_tipohora"); */
   var valor= $(this).val();
   $(".btnplanillas").attr("href",valor);

})
</script>
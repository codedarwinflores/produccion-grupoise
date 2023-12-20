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
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPermiso">
          
          Agregar Permiso

        </button><br>
		<label>Ma = Maestro ;  Mo = Movimientos; C = Consultas; e = Eliminaciones; R =Reportes; u = Utiler&iacute;as</label> 
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre control</th>
           <th>Nombre Perfil</th>          
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $permisos = ControladorPermiso::ctrMostrarPermiso($item, $valor);

       foreach ($permisos as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["nombre_control"].'</td>
                  <td>'.$value["nombre_perfil"].'</td>
                 ';
                  

                 

                  echo '<td>

                    <div class="btn-group">
                        
                      

                      <button class="btn btn-danger btnEliminarPermiso" idPermiso="'.$value["id"].'"  ><i class="fa fa-times"></i></button>

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

<div id="modalAgregarPermiso" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Permiso</h4>
			<label>Ma = Maestro ;  Mo = Movimientos; C = Consultas; e = Eliminaciones; R =Reportes; u = Utiler&iacute;as</label> 
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            

           

            <!-- ENTRADA PARA SELECCIONAR SU CONTROL -->

            <div class="form-group">
              <label for="">Seleccionar control</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoControl" required>
                  
                  <option value="">Seleccionar control</option>

                  <option value="ma_Configuraciones">Ma-Configuraciones</option>
                  <option value="ma_AFP">Ma-AFP</option>
                  <option value="ma_Departamentos">Ma-Departamentos</option>
                  <option value="ma_Tabla ISR">Ma-Tabla ISR </option>
                  <option value="ma_Cargos desempenados">Ma-Cargos desempe&ntilde;ados</option>
                  <option value="ma_Tipos devengo/descuento">Ma-Tipos devengo/descuento</option>
                  <option value="ma_Tipos de planilla">Ma-Tipos de planilla</option>
                  <option value="ma_Solicitudes de empleo">Ma-Solicitudes de empleo</option>
                  <option value="ma_Equipos">Ma-Equipos</option>
                  <option value="ma_Clientes">Ma-Clientes</option>
                  <option value="ma_Transacciones">Ma-Transacciones</option>
                  <option value="ma_Proveedores">Ma-Proveedores</option>
                  <option value="ma_Bancos">Ma-Bancos</option>
                  <option value="ma_Pa&iacute;ses">Ma-Pa&iacute;ses</option>
                  <option value="ma_Seminarios">Ma-Seminarios</option>
                  <option value="ma_Servicios">Ma-Servicios</option>
                  <option value="ma_Vendedores">Ma-Vendedores</option>
                  <option value="ma_Tipos de portaci&oacute;n de arma">Ma-Tipos de portaci&oacute;n de arma</option>
                  <option value="ma_Preguntas generales">Ma-Preguntas generales</option>
                  <option value="ma_Formato examenes">Ma-Formato ex&aacute;menes</option>
                  <option value="ma_Areas investigadas">Ma-&Aacute;reas investigadas </option>
				  <option value="ma_Tipos de servicios">Ma-Tipos de servicios </option>
				  <option value="ma_Patrullas">Ma-Patrullas </option>
				  
				  <option value="mo_Inventario SIM card">Mo-Inventario SIM card </option>				  
				  <option value="mo_Transacciones">Mo-Transacciones </option>
				  <option value="mo_Anticipos">Mo-Anticipos </option>
				  <option value="mo_Notas de descuento">Mo-Notas de descuento </option>
				  <option value="mo_Ingreso de planillas">Mo-Ingreso de planillas </option>
				  <option value="mo_Modificar Planillas">Mo-Modificar Planillas </option>
				  <option value="mo_Memorandum">Mo-Memorandum </option>
				  <option value="mo_Planilla superintendencia">Mo-Planilla superintendencia </option>
				  <option value="mo_Memorandum clientes">Mo-Memorandum clientes </option>
				  <option value="mo_Memorandum empleados">Mo-Memorandum empleados </option>
				  <option value="mo_Ingreso quedan">Mo-Ingreso quedan </option>
				  <option value="mo_Inventario">Mo-Inventario </option>
				  <option value="mo_Vales de gasolina">Mo-Vales de gasolina </option>
				  <option value="mo_Entrega vales">Mo-Entrega vales </option>
				  <option value="mo_Mantenimiento vehiculos">Mo-Mantenimiento veh&iacute;culos </option>
				  <option value="mo_Informes clientes">Mo-Informes clientes </option>
				  <option value="mo_Gestion de ventas">Mo-Gesti&oacute;n de ventas </option>
				  <option value="mo_Movimientos agentes">Mo-Movimientos agentes </option>
				  <option value="mo_Partes de situacion ">Mo-Partes de situaci&oacute;n </option>
				  <option value="mo_Transacciones supervisores">Mo-Transacciones supervisores </option>
				  <option value="mo_Roles de comodin">Mo-Roles de comod&iacute;n </option>
				  <option value="mo_Turnos ubicaciones">Mo-Turnos ubicaciones </option>
				  <option value="mo_Programacion examenes">Mo-Programaci&oacute;n ex&aacute;menes </option>
				  <option value="mo_Examenes especiales">Mo-Ex&aacute;menes especiales </option>
				  <option value="mo_Visitas">Mo-Visitas </option>
				  <option value="mo_Mantenimiento armas">Mo-Mantenimiento armas </option>
				  <option value="mo_Reparacion radios">Mo-Reparaci&oacute;n radios </option>
				  <option value="mo_Transacciones SIM card">Mo-Transacciones SIM card </option>
				  <option value="mo_Cotizaciones">Mo-Cotizaciones </option>
				  <option value="mo_Reacciones">Mo-Reacciones </option>
				  <option value="mo_Ordenes de trabajo">Mo-&Oacute;rdenes de trabajo </option>
				  <option value="mo_Objetivos Fact/cobro">Mo-Objetivos Fact/cobro </option>
				  <option value="mo_Programacion tecnicos">Mo-Programaci&oacute;n t&eacute;cnicos </option>
				  <option value="mo_Boleta visita tecnica">Mo-Boleta visita t&eacute;cnica </option>				 
				  <option value="mo_Reporte supervision">Mo-Reporte supervisi&oacute;n </option>
				  <option value="mo_Mantenimiento bicicletas">Mo-Mantenimiento bicicletas </option>
				  
				  <option value="c_Solicitudes iniciativas">c-Solicitudes iniciativas </option>
				  <option value="c_Asignacion de equipo">c-Asignaci&oacute;n de equipo </option>
				  <option value="c_Equipos">c-Equipos </option>
				  <option value="c_Ubicaciones clientes">c-Ubicaciones clientes </option>
				  <option value="c_Pruebas poligraficas">c-Pruebas poligr&aacute;ficas </option>
				  <option value="c_Kardex equipo">c-Kardex equipo </option>
				  <option value="c_Empleados">c-Empleados </option>
				  <option value="c_Novedades">c-Novedades </option>
				  <option value="c_Actualizacion personal">c-Actualizaci&oacute;n personal </option>
				  <option value="c_Historial armas">c-Historial armas </option>
				  <option value="c_Historial equipos">c-Historial equipos </option>
				  <option value="c_Agentes por ubicacion">c-Agentes por ubicaci&oacute;n </option>
				 
				  <option value="e_Transacciones">e-Transacciones </option>
				  <option value="e_Anticipos">e-Anticipos </option>
				  <option value="e_Eliminar devengos/descuentos">e-Eliminar devengos/descuentos </option>
				  <option value="e_Eliminar quedan">e-Eliminar quedan </option>
				  
				  <option value="r_Ficha personal">R-Ficha personal </option>
				  <option value="r_Ingresos, egresos y seguros">R-Ingresos, egresos y seguros </option>
				  <option value="r_Listado empleados">R-Listado empleados </option>
				  <option value="r_Constancia de sueldo">R-Constancia de sueldo </option>
				  <option value="r_Veh&iacute;culos">R-Veh&iacute;culos </option>
				  <option value="r_Servicio al cliente">R-Servicio al cliente </option>
				  <option value="r_Facturaci&oacute;n">R-Facturaci&oacute;n </option>
				  <option value="r_Kardex">R-Kardex </option>
				  <option value="r_Carnet">R-Carnet </option>
				  <option value="r_Licencia portaci&oacute;n arma">R-Licencia portaci&oacute;n arma </option>
				  <option value="r_Ficha dactilosc&oacute;pica">R-Ficha dactilosc&oacute;pica </option>
				  <option value="r_Movimientos de personal">R-Movimientos de personal </option>
				  <option value="r_Docum., seguros x ubicaci&oacute;n">R-Docum., seguros x ubicaci&oacute;n </option>
				  <option value="r_Ubicaciones">R-Ubicaciones </option>
				  <option value="r_Personal">R-Personal </option>
				  <option value="r_Turnos, s&eacute;ptimos">R-Turnos, s&eacute;ptimos </option>
				  <option value="r_Facturaci&oacute;n ">R-Facturaci&oacute;n </option>
				  <option value="r_Partes de situaci&oacute;n">Partes de situaci&oacute;n </option>
				  <option value="r_Horas extra, permisos">R-Horas extra, permisos </option>
				  <option value="r_Movimientos supervisor">R-Movimientos supervisor </option>
				  <option value="r_Roles de comod&iacute;n">R-Roles de comod&iacute;n </option>
				  <option value="r_Movimientos, ausencias">R-Movimientos, ausencias </option>
				  <option value="r_Listado de armas">R-Listado de armas </option>
				  <option value="r_Inventario de armas">R-Inventario de armas </option>
				  <option value="r_Inventario de radios">R-Inventario de radios  </option>
				  <option value="r_Inventario de veh&iacute;culos">R-Inventario de veh&iacute;culos </option>
				  <option value="r_Inventario de equipo">R-Inventario de equipo </option>
				  <option value="r_Solicitud PNC">R-Solicitud PNC </option>
				  <option value="r_Informes PNC">R-Informes PNC </option>
				  <option value="r_Inicio-Finalizaci&oacute;n servicios">R-Inicio-Finalizaci&oacute;n servicios </option>
				  <option value="r_Capacitaciones">R-Capacitaciones </option>
				  <option value="r_Ausencias">R-Ausencias </option>
				  <option value="r_Imprimir planilla">R-Imprimir planilla </option>
				  <option value="r_Impresi&oacute;n boletas">R-Impresi&oacute;n boletas </option>
				  <option value="r_Anexo planillas">R-Anexo planillas </option>
				  <option value="r_Estados de cuenta">R-Estados de cuenta </option>
				  <option value="r_Vacaci&oacute;n/Indemnizaci&oacute;n">R-Vacaci&oacute;n/Indemnizaci&oacute;n </option>
				  <option value="r_Listado descuentos diarios">R-Listado descuentos diarios </option>
				  
				  <option value="u_Verificar integridad solicitud">u-Verificar integridad solicitud </option>
				  <option value="u_Exportar ventas">u-Exportar ventas </option>
				  <option value="u_Exportar clientes">u-Exportar clientes </option>
				  <option value="u_Cerrar planillas">u-Cerrar planillas </option>
				  <option value="u_Cierres diarios">u-Cierres diarios </option>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              <label for="">Seleccionar perfil</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil" required>
                  
                  <option value="">Seleccionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>
                  <option value="Gerencia General">Gerencia General </option>
                  <option value="Sub-gerente">Sub-gerente</option>
                  <option value="Contador">Contador</option>
                  <option value="Asistente Contable">Asistente Contable</option>
                  <option value="Facturacion y Cobros">Facturacion y Cobros</option>
                  <option value="Departamento IT">Departamento IT</option>
                  <option value="Gerencia RHH">Gerencia RHH</option>
                  <option value="Asistente RHH">Asistente RHH</option>
                  <option value="Auxiliar RRHH">Auxiliar RRHH</option>
                  <option value="Pasante RRHH">Pasante RRHH</option>
                  <option value="Gerencia Operaciones">Gerencia Operaciones</option>
                  <option value="Logistico">Logistico</option>
                  <option value="Jefe Operaciones">Jefe Operaciones</option>
                  <option value="Asistente Operaciones">Asistente Operaciones</option>
                  <option value="Recepcionista">Recepcionista</option>
                  <option value="Poligrafia">Poligrafia</option>
                  <option value="Atencion Al cliente">Atencion Al cliente</option>
                  <option value="Gerente de Ventas">Gerente de Ventas </option>


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

          <button type="submit" class="btn btn-primary">Guardar Permiso</button>

        </div>

        <?php

          $crear = new ControladorPermiso();
          $crear -> ctrCrearPermiso();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR 
======================================-->

<div id="modalEditarPermiso" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Permiso</h4>
			<label>Ma = Maestro ;  Mo = Movimientos; C = Consultas; e = Eliminaciones; R =Reportes; u = Utiler&iacute;as</label> 
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- -- entrada id -- -->

          <input type="hidden" name="editaridpermiso" id="editaridpermiso">

             <!-- ENTRADA PARA EL Codigo  -->
			<div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarControl" required>
                  
                  <option value="" id="editarControl"></option>

                   <option value="ma_Configuraciones">Ma-Configuraciones</option>
                  <option value="ma_AFP">Ma-AFP</option>
                  <option value="ma_Departamentos">Ma-Departamentos</option>
                  <option value="ma_Tabla ISR">Ma-Tabla ISR </option>
                  <option value="ma_Cargos desempenados">Ma-Cargos desempe&ntilde;ados</option>
                  <option value="ma_Tipos devengo/descuento">Ma-Tipos devengo/descuento</option>
                  <option value="ma_Tipos de planilla">Ma-Tipos de planilla</option>
                  <option value="ma_Solicitudes de empleo">Ma-Solicitudes de empleo</option>
                  <option value="ma_Equipos">Ma-Equipos</option>
                  <option value="ma_Clientes">Ma-Clientes</option>
                  <option value="ma_Transacciones">Ma-Transacciones</option>
                  <option value="ma_Proveedores">Ma-Proveedores</option>
                  <option value="ma_Bancos">Ma-Bancos</option>
                  <option value="ma_Pa&iacute;ses">Ma-Pa&iacute;ses</option>
                  <option value="ma_Seminarios">Ma-Seminarios</option>
                  <option value="ma_Servicios">Ma-Servicios</option>
                  <option value="ma_Vendedores">Ma-Vendedores</option>
                  <option value="ma_Tipos de portaci&oacute;n de arma">Ma-Tipos de portaci&oacute;n de arma</option>
                  <option value="ma_Preguntas generales">Ma-Preguntas generales</option>
                  <option value="ma_Formato examenes">Ma-Formato ex&aacute;menes</option>
                  <option value="ma_Areas investigadas">Ma-&Aacute;reas investigadas </option>
				  <option value="ma_Tipos de servicios">Ma-Tipos de servicios </option>
				  <option value="ma_Patrullas">Ma-Patrullas </option>
				  
				  <option value="mo_Inventario SIM card">Mo-Inventario SIM card </option>				  
				  <option value="mo_Transacciones">Mo-Transacciones </option>
				  <option value="mo_Anticipos">Mo-Anticipos </option>
				  <option value="mo_Notas de descuento">Mo-Notas de descuento </option>
				  <option value="mo_Ingreso de planillas">Mo-Ingreso de planillas </option>
				  <option value="mo_Modificar Planillas">Mo-Modificar Planillas </option>
				  <option value="mo_Memorandum">Mo-Memorandum </option>
				  <option value="mo_Planilla superintendencia">Mo-Planilla superintendencia </option>
				  <option value="mo_Memorandum clientes">Mo-Memorandum clientes </option>
				  <option value="mo_Memorandum empleados">Mo-Memorandum empleados </option>
				  <option value="mo_Ingreso quedan">Mo-Ingreso quedan </option>
				  <option value="mo_Inventario">Mo-Inventario </option>
				  <option value="mo_Vales de gasolina">Mo-Vales de gasolina </option>
				  <option value="mo_Entrega vales">Mo-Entrega vales </option>
				  <option value="mo_Mantenimiento vehiculos">Mo-Mantenimiento veh&iacute;culos </option>
				  <option value="mo_Informes clientes">Mo-Informes clientes </option>
				  <option value="mo_Gestion de ventas">Mo-Gesti&oacute;n de ventas </option>
				  <option value="mo_Movimientos agentes">Mo-Movimientos agentes </option>
				  <option value="mo_Partes de situacion ">Mo-Partes de situaci&oacute;n </option>
				  <option value="mo_Transacciones supervisores">Mo-Transacciones supervisores </option>
				  <option value="mo_Roles de comodin">Mo-Roles de comod&iacute;n </option>
				  <option value="mo_Turnos ubicaciones">Mo-Turnos ubicaciones </option>
				  <option value="mo_Programacion examenes">Mo-Programaci&oacute;n ex&aacute;menes </option>
				  <option value="mo_Examenes especiales">Mo-Ex&aacute;menes especiales </option>
				  <option value="mo_Visitas">Mo-Visitas </option>
				  <option value="mo_Mantenimiento armas">Mo-Mantenimiento armas </option>
				  <option value="mo_Reparacion radios">Mo-Reparaci&oacute;n radios </option>
				  <option value="mo_Transacciones SIM card">Mo-Transacciones SIM card </option>
				  <option value="mo_Cotizaciones">Mo-Cotizaciones </option>
				  <option value="mo_Reacciones">Mo-Reacciones </option>
				  <option value="mo_Ordenes de trabajo">Mo-&Oacute;rdenes de trabajo </option>
				  <option value="mo_Objetivos Fact/cobro">Mo-Objetivos Fact/cobro </option>
				  <option value="mo_Programacion tecnicos">Mo-Programaci&oacute;n t&eacute;cnicos </option>
				  <option value="mo_Boleta visita tecnica">Mo-Boleta visita t&eacute;cnica </option>				 
				  <option value="mo_Reporte supervision">Mo-Reporte supervisi&oacute;n </option>
				  <option value="mo_Mantenimiento bicicletas">Mo-Mantenimiento bicicletas </option>
				  
				  <option value="c_Solicitudes iniciativas">c-Solicitudes iniciativas </option>
				  <option value="c_Asignacion de equipo">c-Asignaci&oacute;n de equipo </option>
				  <option value="c_Equipos">c-Equipos </option>
				  <option value="c_Ubicaciones clientes">c-Ubicaciones clientes </option>
				  <option value="c_Pruebas poligraficas">c-Pruebas poligr&aacute;ficas </option>
				  <option value="c_Kardex equipo">c-Kardex equipo </option>
				  <option value="c_Empleados">c-Empleados </option>
				  <option value="c_Novedades">c-Novedades </option>
				  <option value="c_Actualizacion personal">c-Actualizaci&oacute;n personal </option>
				  <option value="c_Historial armas">c-Historial armas </option>
				  <option value="c_Historial equipos">c-Historial equipos </option>
				  <option value="c_Agentes por ubicacion">c-Agentes por ubicaci&oacute;n </option>
				 
				  <option value="e_Transacciones">e-Transacciones </option>
				  <option value="e_Anticipos">e-Anticipos </option>
				  <option value="e_Eliminar devengos/descuentos">e-Eliminar devengos/descuentos </option>
				  <option value="e_Eliminar quedan">e-Eliminar quedan </option>
				  
				  <option value="r_Ficha personal">R-Ficha personal </option>
				  <option value="r_Ingresos, egresos y seguros">R-Ingresos, egresos y seguros </option>
				  <option value="r_Listado empleados">R-Listado empleados </option>
				  <option value="r_Constancia de sueldo">R-Constancia de sueldo </option>
				  <option value="r_Veh&iacute;culos">R-Veh&iacute;culos </option>
				  <option value="r_Servicio al cliente">R-Servicio al cliente </option>
				  <option value="r_Facturaci&oacute;n">R-Facturaci&oacute;n </option>
				  <option value="r_Kardex">R-Kardex </option>
				  <option value="r_Carnet">R-Carnet </option>
				  <option value="r_Licencia portaci&oacute;n arma">R-Licencia portaci&oacute;n arma </option>
				  <option value="r_Ficha dactilosc&oacute;pica">R-Ficha dactilosc&oacute;pica </option>
				  <option value="r_Movimientos de personal">R-Movimientos de personal </option>
				  <option value="r_Docum., seguros x ubicaci&oacute;n">R-Docum., seguros x ubicaci&oacute;n </option>
				  <option value="r_Ubicaciones">R-Ubicaciones </option>
				  <option value="r_Personal">R-Personal </option>
				  <option value="r_Turnos, s&eacute;ptimos">R-Turnos, s&eacute;ptimos </option>
				  <option value="r_Facturaci&oacute;n ">R-Facturaci&oacute;n </option>
				  <option value="r_Partes de situaci&oacute;n">Partes de situaci&oacute;n </option>
				  <option value="r_Horas extra, permisos">R-Horas extra, permisos </option>
				  <option value="r_Movimientos supervisor">R-Movimientos supervisor </option>
				  <option value="r_Roles de comod&iacute;n">R-Roles de comod&iacute;n </option>
				  <option value="r_Movimientos, ausencias">R-Movimientos, ausencias </option>
				  <option value="r_Listado de armas">R-Listado de armas </option>
				  <option value="r_Inventario de armas">R-Inventario de armas </option>
				  <option value="r_Inventario de radios">R-Inventario de radios  </option>
				  <option value="r_Inventario de veh&iacute;culos">R-Inventario de veh&iacute;culos </option>
				  <option value="r_Inventario de equipo">R-Inventario de equipo </option>
				  <option value="r_Solicitud PNC">R-Solicitud PNC </option>
				  <option value="r_Informes PNC">R-Informes PNC </option>
				  <option value="r_Inicio-Finalizaci&oacute;n servicios">R-Inicio-Finalizaci&oacute;n servicios </option>
				  <option value="r_Capacitaciones">R-Capacitaciones </option>
				  <option value="r_Ausencias">R-Ausencias </option>
				  <option value="r_Imprimir planilla">R-Imprimir planilla </option>
				  <option value="r_Impresi&oacute;n boletas">R-Impresi&oacute;n boletas </option>
				  <option value="r_Anexo planillas">R-Anexo planillas </option>
				  <option value="r_Estados de cuenta">R-Estados de cuenta </option>
				  <option value="r_Vacaci&oacute;n/Indemnizaci&oacute;n">R-Vacaci&oacute;n/Indemnizaci&oacute;n </option>
				  <option value="r_Listado descuentos diarios">R-Listado descuentos diarios </option>
				  
				  <option value="u_Verificar integridad solicitud">u-Verificar integridad solicitud </option>
				  <option value="u_Exportar ventas">u-Exportar ventas </option>
				  <option value="u_Exportar clientes">u-Exportar clientes </option>
				  <option value="u_Cerrar planillas">u-Cerrar planillas </option>
				  <option value="u_Cierres diarios">u-Cierres diarios </option>

                </select>

              </div>	
				 <!-- ENTRADA PARA EL Codigo  -->
			<div class="input-group">
				
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil" required>
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                  
                  <option value="Gerencia General">Gerencia General </option>
                  <option value="Sub-gerente">Sub-gerente</option>
                  <option value="Contador">Contador</option>
                  <option value="Asistente Contable">Asistente Contable</option>
                  <option value="Facturacion y Cobros">Facturacion y Cobros</option>
                  <option value="Departamento IT">Departamento IT</option>
                  <option value="Gerencia RHH">Gerencia RHH</option>
                  <option value="Asistente RHH">Asistente RHH</option>
                  <option value="Auxiliar RRHH">Auxiliar RRHH</option>
                  <option value="Pasante RRHH">Pasante RRHH</option>
                  <option value="Gerencia Operaciones">Gerencia Operaciones</option>
                  <option value="Logistico">Logistico</option>
                  <option value="Jefe Operaciones">Jefe Operaciones</option>
                  <option value="Asistente Operaciones">Asistente Operaciones</option>
                  <option value="Recepcionista">Recepcionista</option>
                  <option value="Poligrafia">Poligrafia</option>
                  <option value="Atencion Al cliente">Atencion Al cliente</option>
                  <option value="Gerente de Ventas">Gerente de Ventas </option>

                </select>

              </div>

          </div>

            
 <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar permiso</button>

        </div>

		<?php

          $editar = new ControladorPermiso();
          $editar -> ctrEditarPermiso();

        ?> 

      </form>
          




          </div>

		</div>
	</div>
</div>

       

    </div>

 </div>



<?php

  $borrar = new ControladorPermiso();
  $borrar -> ctrBorrarPermiso();

?> 



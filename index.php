<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "modelos/usuarios.modelo.php";

/* **empresas*** */
require_once "controladores/empresas.controlador.php";
require_once "modelos/empresas.modelo.php";


/* **proveedores*** */
require_once "controladores/proveedores.controlador.php";
require_once "modelos/proveedores.modelo.php";


/* **bancos*** */
require_once "controladores/bancos.controlador.php";
require_once "modelos/bancos.modelo.php";


/* **paises*** */
require_once "controladores/paises.controlador.php";
require_once "modelos/paises.modelo.php";


/* **AFP*** */
require_once "controladores/afp.controlador.php";
require_once "modelos/afp.modelo.php";

/* **AFP*** */
require_once "controladores/departamentos.controlador.php";
require_once "modelos/departamentos.modelo.php";


/* **SERVICIOS*** */
require_once "controladores/servicios.controlador.php";
require_once "modelos/servicios.modelo.php";



/* **CARGOS*** */
require_once "controladores/cargos.controlador.php";
require_once "modelos/cargos.modelo.php";



/* **PERIODOS*** */
require_once "controladores/periodos_pagos.controlador.php";
require_once "modelos/periodos_pagos.modelo.php";


/* **ISR*** */
require_once "controladores/isr.controlador.php";
require_once "modelos/isr.modelo.php";


/* **DEPARTAMENTO*** */
require_once "controladores/departamento.controlador.php";
require_once "modelos/departamento.modelo.php";


/* **ISR*** */
require_once "controladores/municipio.controlador.php";
require_once "modelos/municipio.modelo.php";

/* **CLIENTES*** */
require_once "controladores/clientes.controlador.php";
require_once "modelos/clientes.modelo.php";


/* **SEMINARIOS*** */
require_once "controladores/seminarios.controlador.php";
require_once "modelos/seminarios.modelo.php";


/* **PLANTILLAS*** */
require_once "controladores/plantillas.controlador.php";
require_once "modelos/plantillas.modelo.php";


/* **SIM*** */
require_once "controladores/sim.controlador.php";
require_once "modelos/sim.modelo.php";


/* **EQUIPOS*** */
require_once "controladores/equipos.controlador.php";
require_once "modelos/equipos.modelo.php";

/* **FAMILIA*** */
require_once "controladores/familia.controlador.php";
require_once "modelos/familia.modelo.php";


/* **TIPO DE ARMA*** */
require_once "controladores/tipoarmas.controlador.php";
require_once "modelos/tipoarmas.modelo.php";


/* **ARMA*** */
require_once "controladores/armas.controlador.php";
require_once "modelos/armas.modelo.php";

/* **TIPO VEHICULO*** */
require_once "controladores/tipovehiculo.controlador.php";
require_once "modelos/tipovehiculo.modelo.php";


/* **TIPO BICICLETA*** */
require_once "controladores/tipobicicleta.controlador.php";
require_once "modelos/tipobicicleta.modelo.php";



/* ** BICICLETA*** */
require_once "controladores/bicicleta.controlador.php";
require_once "modelos/bicicleta.modelo.php";

/* ** TIPO RADIO*** */
require_once "controladores/tiporadio.controlador.php";
require_once "modelos/tiporadio.modelo.php";


/* **  RADIO*** */
require_once "controladores/radio.controlador.php";
require_once "modelos/radio.modelo.php";



/* **  transaccionesequipo *** */
require_once "controladores/transaccionesequipo.controlador.php";
require_once "modelos/transaccionesequipo.modelo.php";


/* **  uniforme *** */
require_once "controladores/uniforme.controlador.php";
require_once "modelos/uniforme.modelo.php";

/* **  transaccionespersonal *** */
require_once "controladores/transaccionespersonal.controlador.php";
require_once "modelos/transaccionespersonal.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
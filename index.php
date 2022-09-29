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

$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();
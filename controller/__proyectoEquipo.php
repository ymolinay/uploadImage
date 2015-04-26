<?php

session_start();

require_once __DIR__.'/../model/dao/proyectoEquipoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objEquipoDAO = new EquipoDAO();
$objEquipoTempDAO = new EquipoTempDAO();
$objProyectoEquipoDAO = new ProyectoEquipoDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];
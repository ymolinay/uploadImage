<?php

session_start();
require_once __DIR__.'/../model/dao/accesosDAO.php';

$objAccesosDAO = new AccesosDAO();

$action = $_GET["action"];

if ($action == "login") {
    $idUser = $_SESSION["sessionIdUsuario"];
    //Hora/Fecha ingreso cliente
    $horaCliente = base64_decode($_GET["time"]);
    $fechaCliente = base64_decode($_GET["date"]);
    //Hora/Fecha ingreso server
    date_default_timezone_set('America/Lima');
    $horaServer = date("H:i:s");
    $fechaServer = date('Y-m-d');
    $hora = '00:00:00';
    $fecha = '0001-01-01';
    $indicador = '1';

    $objAccesosDAO->objAcceso->setHICliente($horaCliente);
    $objAccesosDAO->objAcceso->setFICliente($fechaCliente);
    $objAccesosDAO->objAcceso->setHSCliente($hora);
    $objAccesosDAO->objAcceso->setFSCliente($fecha);
    $objAccesosDAO->objAcceso->setHIServer($horaServer);
    $objAccesosDAO->objAcceso->setFIServer($fechaServer);
    $objAccesosDAO->objAcceso->setHSServer($hora);
    $objAccesosDAO->objAcceso->setFSServer($fecha);
    $objAccesosDAO->objAcceso->setIdUsuario($idUser);
    $objAccesosDAO->objAcceso->setIndicador($indicador);
    
    $acceso = $objAccesosDAO->ExecuteLogin($objAccesosDAO->objAcceso);

    if (!$acceso[0]) {
        echo 'fail';
    } else {
        $_SESSION["sessionIdAcceso"] = $acceso[1];
        echo "success";
    }
}

if ($action == 'logout') {
    $idAcceso = $_SESSION["sessionIdAcceso"];
    //Hora/Fecha ingreso cliente
    $horaCliente = base64_decode($_GET["time"]);
    $fechaCliente = base64_decode($_GET["date"]);
    //Hora/Fecha ingreso server
    date_default_timezone_set('America/Lima');
    $horaServer = date("H:i:s");
    $fechaServer = date('Y-m-d');

    $objAccesosDAO->objAcceso->setIdAcceso($idAcceso);
    $objAccesosDAO->objAcceso->setHSCliente($horaCliente);
    $objAccesosDAO->objAcceso->setFSCliente($fechaCliente);
    $objAccesosDAO->objAcceso->setHSServer($horaServer);
    $objAccesosDAO->objAcceso->setFSServer($fechaServer);
    $objAccesosDAO->objAcceso->setIdUsuario($idUser);

    $acceso = $objAccesosDAO->ExecuteLogout($objAccesosDAO->objAcceso);

    if (!$acceso) {
        echo 'fail';
    } else {
        session_destroy();
        session_unset();
        echo "success";
    }
}
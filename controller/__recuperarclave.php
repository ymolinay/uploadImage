<?php

session_start();
require_once __DIR__.'/../model/dao/recuperarClaveDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objRecuperarClaveDAO = new RecuperarClaveDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == 'reset') {
    $code1 = $_GET['c1'];
    $code2 = $_GET['c2'];
    $idPersonal = $_GET['idp'];
    $user = $_GET['us'];
    $idUser = $_GET['idu'];

    $objRecuperarClaveDAO->objRecuperarClave->setCode1($code1);
    $objRecuperarClaveDAO->objRecuperarClave->setCode2($code2);
    $objRecuperarClaveDAO->objRecuperarClave->setIdPersonal($idPersonal);

    $verify = $objRecuperarClaveDAO->verifyRequest($objRecuperarClaveDAO->objRecuperarClave);
    
    if ($verify > 0) {
        echo json_encode(array("user"=>$user, "idUser"=>$idUser));
    }
}
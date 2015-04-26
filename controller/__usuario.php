<?php

session_start();
require_once __DIR__.'/../model/dao/usuarioDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objUsuarioDAO = new UsuarioDAO();
$objGridDAO = new GridDAO();

$action = $_GET["action"];

if ($action == "login") {
    $username = base64_decode($_GET["txtuser"]);
    $password = md5(base64_decode($_GET["txtpassword"]));
    $indicador = '1';
//echo $password;
    $objUsuarioDAO->objUsuario->setNombre($username);
    $objUsuarioDAO->objUsuario->setClave($password);
    $objUsuarioDAO->objUsuario->setIndicador($indicador);

    $user = $objUsuarioDAO->ExecuteLogin($objUsuarioDAO->objUsuario);

    //Un sólo registro
    $user = $user[0];

    if ($user->idUsuario < 1) {
        echo 'fail';
    } else {
        $_SESSION["sessionIdUsuario"] = $user->idUsuario;
        $_SESSION["sessionUsuario"] = $user->usrNombre;
        $_SESSION["sessionIdPerfil"] = $user->idPerfil;
        $_SESSION["sessionPerfil"] = $user->prfDescripcion;
        $_SESSION["sessionIdPersonal"] = $user->idPersonal;
        $_SESSION["sessionPersonal"] = $user->prsApellidoPaterno . ' ' . $user->prsApellidoMaterno . ', ' . $user->prsNombre;
        $_SESSION["sessionEmail"] = $user->prsCorreo;

        echo 'success';
    }
}

if ($action == 'changePassword') {
    $idUser = $_GET['txtRidUser'];
    $username = $_GET['txtRUser'];
    $password = md5($_GET['txtRContrasena']);

    $objUsuarioDAO->objUsuario->setIdUsuario($idUser);
    $objUsuarioDAO->objUsuario->setNombre($username);
    $objUsuarioDAO->objUsuario->setClave($password);

    $user = $objUsuarioDAO->ChangePassword($objUsuarioDAO->objUsuario);
    if (!$user) {
        echo 'fail';
    } else {
        echo 'success';
    }
}
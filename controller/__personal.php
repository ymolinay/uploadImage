<?php

session_start();
require_once __DIR__.'/../model/dao/personalDAO.php';
require_once __DIR__.'/../model/dao/usuarioDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';
require_once __DIR__.'/../model/config/mail.class.php';
$objPersonalDAO = new PersonalDAO();
$objUsuarioDAO = new UsuarioDAO();
$objGridDAO = new GridDAO();
$action = $_GET['action'];
$type = base64_decode($_GET['userType']);
if ($action == "save" && $type == "alumno") {
    $error = TRUE;
    $idPersonal = $_GET['idPersonal'];
    $nombres = $_GET['inputName'];
    $apellidoPaterno = $_GET['inputFName'];
    $apellidoMaterno = $_GET['inputMName'];
    $dni = $_GET['inputDNI'];
    $telefono = $_GET['inputTelefono'];
    $email = $_GET['inputEmail'];

    $direccion = $_GET['inputDireccion'];
    $sexo = $_GET['inputSexo'];
    $estadoCivil = $_GET['inputEstadoCivil'];
    $fNacimiento = $_GET['inputFNacimiento'];
    $fNacimiento = explode('-', $fNacimiento);
    $fNacimiento = $fNacimiento[2] . '-' . $fNacimiento[1] . '-' . $fNacimiento[0];
    $nacionalidad = $_GET['inputNacionalidad'];

    $idUbigeo = $_GET['idUbigeo'];
    $indicador = '1';
    $idUsuario = $_GET['idUsuario'];
    $nombre = $_GET['inputUsuario'];
    if ($_GET['inputPassword'] != 'C0ntrasen4') {
        $clave = md5($_GET['inputPassword']);
    } else {
        $clave = md5('C0ntrasen4');
    }
    //tipo de perfil 2 = alumno
    $idPerfil = '2';
    $indicador = '1';
    $objPersonalDAO->objPersonal->setIdPersonal($idPersonal);
    $objPersonalDAO->objPersonal->setNombres($nombres);
    $objPersonalDAO->objPersonal->setApellidoPaterno($apellidoPaterno);
    $objPersonalDAO->objPersonal->setApellidoMaterno($apellidoMaterno);
    $objPersonalDAO->objPersonal->setDNI($dni);
    $objPersonalDAO->objPersonal->setTelefono($telefono);
    $objPersonalDAO->objPersonal->setEmail($email);
    $objPersonalDAO->objPersonal->setIdUbigeo($idUbigeo);
    $objPersonalDAO->objPersonal->setDireccion($direccion);
    $objPersonalDAO->objPersonal->setSexo($sexo);
    $objPersonalDAO->objPersonal->setEstadoCivil($estadoCivil);
    $objPersonalDAO->objPersonal->setFNacimiento($fNacimiento);
    $objPersonalDAO->objPersonal->setNacionalidad($nacionalidad);
    $objPersonalDAO->objPersonal->setIndicador($indicador);
    $objUsuarioDAO->objUsuario->setIdUsuario($idUsuario);
    $objUsuarioDAO->objUsuario->setNombre($nombre);
    $objUsuarioDAO->objUsuario->setClave($clave);
    $objUsuarioDAO->objUsuario->setIdPerfil($idPerfil);
    $objUsuarioDAO->objUsuario->setIdPersonal($idPersonal);
    $objUsuarioDAO->objUsuario->setIndicador($indicador);
    if ($idPersonal != '') {
        $personal = $objPersonalDAO->ExecuteUpdate($objPersonalDAO->objPersonal);
    } else {
        $personal = $objPersonalDAO->ExecuteSave($objPersonalDAO->objPersonal);
    }
    if ($personal[0] !== true) {
        $error = TRUE;
    } else {
        $idPersonal = $personal[1];
        $objUsuarioDAO->objUsuario->setIdPersonal($idPersonal);
        if ($idUsuario != '') {
            $usuario = $objUsuarioDAO->ExecuteUpdate($objUsuarioDAO->objUsuario);
        } else {
            $usuario = $objUsuarioDAO->ExecuteSave($objUsuarioDAO->objUsuario);
        }
        //validando resultado
        if ($usuario !== true) {
            $error = TRUE;
        } else {
            $error = FALSE;
        }
    }
    echo ($error) ? 'fail' : 'success';
}

if ($action == "save" && $type == "usuario") {
    $error = TRUE;
    $idPersonal = $_GET['idPersonal'];
    $nombres = $_GET['inputName'];
    $apellidoPaterno = $_GET['inputFName'];
    $apellidoMaterno = $_GET['inputMName'];
    $dni = $_GET['inputDNI'];
    $telefono = $_GET['inputTelefono'];
    $email = $_GET['inputEmail'];
    $idUbigeo = $_GET['idUbigeo'];
    $indicador = '1';
    $idUsuario = $_GET['idUsuario'];
    $nombre = $_GET['inputUsuario'];
    
    /*Datos necesarios y faltantes*/
    $direccion='';
    $sexo='M';
    $estadoCivil = '1';
    $fNacimiento = '1993-02-02';
    $nacionalidad = '1';
    /*Datos necesarios y faltantes fin*/
    
    
    if ($_GET['inputPassword'] != '') {
        $clave = md5($_GET['inputPassword']);
    }
    $idPerfil = $_GET['idPerfil'];
    if ($_GET['idAcceso'] == '') {
        $indicador = '1';
    } else {
        $indicador = $_GET['idAcceso'];
    }

    $objPersonalDAO->objPersonal->setIdPersonal($idPersonal);
    $objPersonalDAO->objPersonal->setNombres($nombres);
    $objPersonalDAO->objPersonal->setApellidoPaterno($apellidoPaterno);
    $objPersonalDAO->objPersonal->setApellidoMaterno($apellidoMaterno);
    $objPersonalDAO->objPersonal->setDNI($dni);
    $objPersonalDAO->objPersonal->setTelefono($telefono);
    $objPersonalDAO->objPersonal->setEmail($email);
    $objPersonalDAO->objPersonal->setIdUbigeo($idUbigeo);
    /*Datos necesarios y faltantes*/
    $objPersonalDAO->objPersonal->setDireccion($direccion);
    $objPersonalDAO->objPersonal->setSexo($sexo);
    $objPersonalDAO->objPersonal->setEstadoCivil($estadoCivil);
    $objPersonalDAO->objPersonal->setFNacimiento($fNacimiento);
    $objPersonalDAO->objPersonal->setNacionalidad($nacionalidad);
    /*Datos necesarios y faltantes fin*/
    $objPersonalDAO->objPersonal->setIndicador($indicador);
    $objUsuarioDAO->objUsuario->setIdUsuario($idUsuario);
    $objUsuarioDAO->objUsuario->setNombre($nombre);
    $objUsuarioDAO->objUsuario->setClave($clave);
    $objUsuarioDAO->objUsuario->setIdPerfil($idPerfil);
    $objUsuarioDAO->objUsuario->setIdPersonal($idPersonal);
    $objUsuarioDAO->objUsuario->setIndicador($indicador);
    if ($idPersonal != '') {
        $personal = $objPersonalDAO->ExecuteUpdate($objPersonalDAO->objPersonal);
    } else {
        $personal = $objPersonalDAO->ExecuteSave($objPersonalDAO->objPersonal);
    }
    if ($personal[0] !== true) {
        $error = TRUE;
    } else {
        $idPersonal = $personal[1];
        $objUsuarioDAO->objUsuario->setIdPersonal($idPersonal);
        if ($idUsuario != '') {
            $usuario = $objUsuarioDAO->ExecuteUpdate($objUsuarioDAO->objUsuario);
        } else {
            $usuario = $objUsuarioDAO->ExecuteSave($objUsuarioDAO->objUsuario);
        }
        //validando resultado
        if ($usuario !== true) {
            $error = TRUE;
        } else {
            $error = FALSE;
        }
    }
    echo ($error) ? 'fail' : 'success';
}

if ($action == "save" && $type == "myuser") {
    $error = TRUE;
    $idUsuario = $_GET['idUsuario'];
    $nombre = $_GET['inputNombre'];
    if ($_GET['inputPassword'] != '') {
        $clave = md5($_GET['inputPassword']);
        $objUsuarioDAO->objUsuario->setClave($clave);
    }
    $objUsuarioDAO->objUsuario->setIdUsuario($idUsuario);
    $objUsuarioDAO->objUsuario->setNombre($nombre);
    $usuario = $objUsuarioDAO->ChangePassword($objUsuarioDAO->objUsuario);
    if ($usuario !== true) {
        $error = TRUE;
    } else {
        $error = FALSE;
    }
    echo ($error) ? 'fail' : 'success';
}

if ($action == 'recover') {
    $mail = $_GET['mail'];
    $objPersonalDAO->objPersonal->setEmail($mail);
    $personal = $objPersonalDAO->ExecuteSearchMail($objPersonalDAO->objPersonal);

    if ($personal > 0) {
        echo 'success';
    } else {
        echo 'fail';
    }
}

if ($action == 'sendRecover') {

    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $code = array();
    $code[0] = $code[1] = '';
    $long = 25;
    for ($i = 0; $i < $long; $i++) {
        $code[0].=substr($characters, rand(1, strlen($characters)), 1);
    }
    for ($i = 0; $i < $long; $i++) {
        $code[1].=substr($characters, rand(1, strlen($characters)), 1);
    }

    $mail = $_GET['mail'];
    $objPersonalDAO->objPersonal->setEmail($mail);
    $resultEquipo = $objPersonalDAO->ExecuteSendMail($objPersonalDAO->objPersonal, $code);

    if (is_array($resultEquipo)) {
        $objPersonal = $resultEquipo[0];

        $to = $objPersonal->prsCorreo;
        $toName = $objPersonal->prsApellidoPaterno . ' ' . $objPersonal->prsApellidoMaterno . ', ' . $objPersonal->prsNombre;

        $url = 'http://localhost/catolica.intranet/view/login.php?action=reset&c1=' . $resultEquipo[1] . '&c2=' . $resultEquipo[2] . '&idp=' . $objPersonal->idPersonal . '&us=' . $objPersonal->usrNombre . '&idu=' . $objPersonal->idUsuario;

        $body = '<h2>Restablecer Contraseña</h2>'
                . '<p>Estimado ' . $objPersonal->prsApellidoPaterno . ' ' . $objPersonal->prsApellidoMaterno . ', ' . $objPersonal->prsNombre . '.</p>'
                . '<p>Solicitaste restablecer la contraseña de acceso a tu cuenta <b>' . $objPersonal->usrNombre . '</b>, ingresa al siguiente link para realizar esta acción:</p>'
                . '<a href="' . $url . '" style=";color: #ffffff;border: 3px #999999 solid;padding: 5px 10px 5px 13px;background-color: #cccccc;font-family: Arial, Helvetica, sans-serif;font-size: 16px;font-weight: bold;text-decoration: none;border-radius: 15px;" >Restablecer Contraseña</a>'
                . '<p></p>'
                . '<p>Si no puedes acceder al link, copia el siguiente enlace (url) en la barra de tu navegador:</p>'
                . '<p>' . $url . '</p>'
                . '<br>'
                . '<p style="text-align: right;">Equipo de desarrollo 911ITG</p>';

        $altBody = 'Restablecer Contraseña \n'
                . 'Estimado ' . $objPersonal->prsApellidoPaterno . ' ' . $objPersonal->prsApellidoMaterno . ', ' . $objPersonal->prsNombre . '.\n'
                . 'Solicitaste restablecer la contraseña de acceso a tu cuenta ' . $objPersonal->usrNombre . ', ingresa al siguiente link para realizar esta acción:\n'
                . $url . '\n'
                . 'Equipo de desarrollo Catolica.';
        $objMail = new Mail('Recuperar contraseña', $body, $altBody, $to, $toName);

        if ($objMail->SendMail($objMail)) {
            echo 'send';
        } else {
            echo 'senderror';
        }
    } else {
        echo $resultEquipo;
    }
}

if ($action == 'delete') {
    $id = base64_decode($_GET['id']);

    $objPersonalDAO->objPersonal->setIdPersonal($id);
    $personal = $objPersonalDAO->ExecuteFind($objPersonalDAO->objPersonal);
    $personal = $personal[0];

    $idPersonal = $personal->idPersonal;
    $idUsuario = $personal->idUsuario;

    $objPersonalDAO2 = new PersonalDAO();
    $objUsuarioDAO2 = new UsuarioDAO();

    if (!empty($idUsuario)) {
        $objUsuarioDAO2->objUsuario->setIdUsuario($idUsuario);
        $deleteUser = $objUsuarioDAO2->ExecuteDelete($objUsuarioDAO2->objUsuario);

        if (!$deleteUser) {
            echo 'fail';
        } else {
            $objPersonalDAO2->objPersonal->setIdPersonal($idPersonal);
            $deletePersonal = $objPersonalDAO2->ExecuteDelete($objPersonalDAO2->objPersonal);

            if (!$deletePersonal) {
                echo 'fail';
            } else {
                echo 'success';
            }
        }
    } else {
        $objPersonalDAO2->objPersonal->setIdPersonal($idPersonal);
        $deletePersonal = $objPersonalDAO2->ExecuteDelete($objPersonalDAO2->objPersonal);

        if (!$deletePersonal) {
            echo 'fail';
        } else {
            echo 'success';
        }
    }
}

if ($action == 'find') {
    $id = base64_decode($_GET['idPersonal']);

    $objPersonalDAO->objPersonal->setIdPersonal($id);
    $personal = $objPersonalDAO->ExecuteFind($objPersonalDAO->objPersonal);
    $personal = $personal[0];

    echo json_encode($personal);
}
//combo por perfiles
if ($action == "combobox2") {
    $idPerfil = $_GET['perfil'];
    $objUsuarioDAO->objUsuario->setIdPerfil($idPerfil);
    $cbx = array();
    $combo = $objPersonalDAO->ExecuteCompleteCombobox2($objUsuarioDAO->objUsuario);
    foreach ($combo as $key => $val) {
        //$cbx[$key] = array("idUsuario" => $val->idUsuario, "nombres" => $val->nombres, "apellidos" => $val->apellidos);
        $cbx[$key] = array("idUsuario" => $val->idUsuario, "prsNombre" => $val->prsNombre, "prsApellidoPaterno" => $val->prsApellidoPaterno, "prsApellidoMaterno" => $val->prsApellidoMaterno, "prsDNI" => $val->prsDNI);
    }
    echo json_encode($cbx);
}

if ($action == 'combobox') {
    $cbx = array();
    $combo = $objPersonalDAO->ExecuteCompleteCombobox();
    foreach ($combo as $key => $val) {
        $cbx[$key] = array("idUsuario" => $val->idUsuario, "prsNombre" => $val->prsNombre, "prsApellidoPaterno" => $val->prsApellidoPaterno, "prsApellidoMaterno" => $val->prsApellidoMaterno, "prsDNI" => $val->prsDNI);
    }
    echo json_encode($cbx);
}
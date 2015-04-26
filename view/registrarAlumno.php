<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Alumnos');
$html->assign('headerContent', 'Registro de Alumnos');
$html->assign('headerIconContent', 'fa fa-user');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'registrarAlumno.php', 'title' => 'Alumnos', 'header' => 'Registro'));
$html->assign('optionActive', '4');
$html->assign('jsFile', $baseHTTP . 'files/js/registrarAlumno.js');
//mostrar submenu
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('registrarAlumno.html');

<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Registrar Inscripción');
$html->assign('headerContent', 'Inscripción');
$html->assign('headerIconContent', 'fa fa-user');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'generarInscripcionCarrera.php', 'title' => 'ALumno', 'header' => 'Inscripción Carrera'));
$html->assign('optionActive','5');
$html->assign('jsFile',$baseHTTP.'files/js/generarInscripcionCarrera.js');
//mostrar submenu
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('generarInscripcionCarrera.html');

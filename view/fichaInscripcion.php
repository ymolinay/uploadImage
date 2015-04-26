<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Ficha Inscripción');
$html->assign('headerContent', 'Inscripción');
$html->assign('headerIconContent', 'fa fa-file');
$html->assign('showSubHeader', 'si');
$html->assign('optionActive', '3');
$html->assign('jsFile', $baseHTTP . 'files/js/fichaInscripcion.js');
$html->assign('subHeader', array('link' => 'fichaInscripcion.php', 'title' => 'Inscripción', 'header' => 'Ficha Inscripción'));
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('fichaInscripcion.html');

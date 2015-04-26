<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Carreras');
$html->assign('headerContent', 'Configuración de Carreras');
$html->assign('headerIconContent', 'fa fa-tasks');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'carreras.php', 'title' => 'Configuración', 'header' => 'Carreras'));
$html->assign('optionActive', '1');
$html->assign('jsFile', $baseHTTP . 'files/js/planEstudio.js');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('planEstudio.html');

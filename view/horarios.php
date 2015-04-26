<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Horarios');
$html->assign('headerContent', 'Configuración Horarios');
$html->assign('headerIconContent', 'fa fa-tasks');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'horarios.php', 'title' => 'Configuración', 'header' => 'Horarios'));
$html->assign('optionActive', '1');
$html->assign('jsFile', $baseHTTP . 'files/js/horarios.js');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('horarios.html');

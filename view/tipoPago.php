<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Tipos de Pago');
$html->assign('headerContent', 'Tipos de Pago');
$html->assign('headerIconContent', 'fa fa-file');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'tipoPago.php', 'title' => 'Configuración', 'header' => 'Tipos de Pago'));
$html->assign('optionActive', '1');
$html->assign('jsFile', $baseHTTP . 'files/js/tipoPago.js');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('tipoPago.html');

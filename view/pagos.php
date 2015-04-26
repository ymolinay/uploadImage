<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Pagos');
$html->assign('headerContent', 'Pagos');
$html->assign('headerIconContent', 'fa fa-file');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'pagos.php', 'title' => 'Matriculas', 'header' => 'Pagos'));
$html->assign('optionActive', '5');
$html->assign('jsFile', $baseHTTP . 'files/js/pagos.js');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('pagos.html');

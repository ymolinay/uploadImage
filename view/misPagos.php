<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 2 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Mis Pagos');
$html->assign('headerContent', 'Mantenimiento de Alumnos');
$html->assign('headerIconContent', 'fa fa-user');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'misPagos.php', 'title' => 'Alumnos', 'header' => 'Mis Pagos'));
$html->assign('optionActive', '4');
$html->assign('jsFile', $baseHTTP . 'files/js/misPagos.js');
//mostrar submenu
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('misPagos.html');

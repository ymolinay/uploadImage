<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Generar Matrícula');
$html->assign('headerContent', 'Matrícula');
$html->assign('headerIconContent', 'fa fa-user');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'generarMatricula.php', 'title' => 'ALumno', 'header' => 'Matrícula'));
$html->assign('optionActive','5');
$html->assign('jsFile',$baseHTTP.'files/js/generarMatricula.js');
//mostrar submenu
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('generarMatricula.html');

<?php

include('../files/dll/includes.php');
$html->assign('titlePage', 'Mi Perfil');
$html->assign('headerContent', 'Modificar Información');
$html->assign('headerIconContent', 'fa fa-user');
$html->assign('showSubHeader', 'no');
$html->assign('optionActive', '2');
$html->assign('jsFile', $baseHTTP . 'files/js/miperfil.js');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('miperfil.html');

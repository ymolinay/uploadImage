<?php

include('../files/dll/includes.php');
$html->assign('titlePage', 'Principal');
$html->assign('headerContent', 'Principal');
$html->assign('headerIconContent', 'fa fa-home');
$html->assign('showSubHeader', 'no');
$html->assign('optionActive', '0');
$html->assign('jsFile', $baseHTTP . 'files/js/principal.js');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('principal.html');

<?php

include('../files/dll/includes.php');
$html->assign('titlePage', 'Docentes');
$html->assign('headerContent', 'Configuración Docente');
$html->assign('headerIconContent', 'fa fa-tasks');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'docentes.php', 'title' => 'Configuración', 'header' => 'Docentes'));
$html->assign('optionActive', '1');
//
//mostrar sub header
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('docentes.html');

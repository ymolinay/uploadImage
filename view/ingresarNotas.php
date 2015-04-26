<?php

include('../files/dll/includes.php');
($sessionIdPerfil == 1 || $sessionIdPerfil == 3 || $sessionIdPerfil == 4) ? '' : header('location:error404.php');
$html->assign('titlePage', 'Asignar Cursos');
$html->assign('headerContent', 'Docentes');
$html->assign('headerIconContent', 'fa fa-briefcase');
$html->assign('showSubHeader', 'si');
$html->assign('subHeader', array('link' => 'asignarCursos.php', 'title' => 'Docentes', 'header' => 'Asignar Cursos'));
$html->assign('optionActive','6');
$html->assign('jsFile',$baseHTTP.'files/js/ingresarNotas.js');
//mostrar submenu
//$html->assign('subHeader',array('link'=>'configuracion.php','header'=>'Configuración'));
$html->display('ingresarNotas.html');

<?php
require_once('../files/dll/includes.php');
$html->assign('titlePage','Login');
$html->assign('jsFile',$baseHTTP.'files/js/login.js');
//$html->display('global/view/templates/login.html');
$html->display('login.html');
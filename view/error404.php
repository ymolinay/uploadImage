<?php
require_once('../files/dll/includes.php');
$html->assign('titlePage','Error');
$html->assign('jsFile',$baseHTTP.'files/js/error404.js');
$html->assign('urlReferer',$_SERVER["HTTP_REFERER"]);
//$html->display('global/view/templates/login.html');
$html->display('error404.html');
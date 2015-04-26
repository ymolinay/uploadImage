<?php

session_start();

require_once __DIR__.'/../model/dao/equipoDAO.php';
require_once __DIR__.'/../model/dao/equipoTempDAO.php';
require_once __DIR__.'/../model/dao/proyectoEquipoDAO.php';
require_once __DIR__.'/../model/dao/gridDAO.php';

$objEquipoDAO = new EquipoDAO();
$objEquipoTempDAO = new EquipoTempDAO();
$objProyectoEquipoDAO = new ProyectoEquipoDAO();
$objGridDAO = new GridDAO();

$action = $_GET['action'];

if ($action == "save") {

    $error = true;
    $idProyecto = $_GET['txtIdProyecto'];
    $idAcceso = $_SESSION['sessionIdAcceso'];

    $objEquipoTempDAO->objEquipoTemp->setIdProyecto($idProyecto);
    $objEquipoTempDAO->objEquipoTemp->setIdAcceso($idAcceso);

    $resultEquipoTemp = $objEquipoTempDAO->ExecuteSelect($objEquipoTempDAO->objEquipoTemp);
    $countEquipoTemp = count($resultEquipoTemp);

    if ($countEquipoTemp > 0) {
        foreach ($resultEquipoTemp as $key => $val) {
            
            if($val->idEquipo){
                //si idEquipo es diferente de 0, se actualiza o elimina
                if(!($val->indicador)){
                    
                    $objProyectoEquipoDeleteDAO = new ProyectoEquipoDAO();
                    $objProyectoEquipoDeleteDAO->objProyectoEquipo->setIdEquipo($val->idEquipo);
                    $objProyectoEquipoDelete = $objProyectoEquipoDeleteDAO->ExecuteDelete($objProyectoEquipoDeleteDAO->objProyectoEquipo);
                    
                    if($objProyectoEquipoDelete === true){
                        $objEquipoDeleteDAO = new EquipoDAO();
                        $objEquipoDeleteDAO->objEquipo->setIdEquipo($val->idEquipo);
                        $objEquipoDelete = $objEquipoDeleteDAO->ExecuteDelete($objEquipoDeleteDAO->objEquipo);
                    }
                    
                }
            } else {
                //si no, se guarda el nuevo equipo
                $objEquipoDAO->objEquipo->setSerie($val->serieEquipo);
                $objEquipoDAO->objEquipo->setCosto($val->costo);
                $objEquipoDAO->objEquipo->setIdTipoEquipo($val->idTipoEquipo);
                $objEquipoDAO->objEquipo->setIdModelo($val->idModelo);
                $objEquipoDAO->objEquipo->setIndicador('1');

                $resultEquipo = $objEquipoDAO->ExecuteSave($objEquipoDAO->objEquipo);

                if ($resultEquipo[0] === true) {
                    $objProyectoEquipoDAO->objProyectoEquipo->setIdProyecto($val->idProyecto);
                    $objProyectoEquipoDAO->objProyectoEquipo->setIdEquipo($resultEquipo[1]);

                    $resultProyectoEquipo = $objProyectoEquipoDAO->ExecuteSave($objProyectoEquipoDAO->objProyectoEquipo);

                    if ($resultProyectoEquipo === true) {

                        $objEquipoTemp2 = new EquipoTempDAO();
                        $objEquipoTemp2->objEquipoTemp->setIdAcceso($val->idAcceso);
                        $objEquipoTemp2->objEquipoTemp->setIdEquipoTemp($val->idEquipoTemp);

                        $resultEquipoTemp = $objEquipoTemp2->ExecuteDeleteId($objEquipoTemp2->objEquipoTemp);

                        $error = ($resultEquipoTemp !== true) ? true : false;
                    }
                }
            }
        }

        echo ($error) ? 'fail' : 'success';
    }
}
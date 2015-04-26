<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/usuarioCarrera.php';

class UsuarioCarreraDAO {

    public $objUsuarioCarrera;
    private $task;

    const TABLE = "usuariocarrera";

    public function __construct() {
        $this->objUsuarioCarrera = new UsuarioCarrera();
        $this->task = new Task();
    }

    public function ExecuteSave($objUsuarioCarrera) {
        $idUsuarioCarrera = $this->task->getId(self::TABLE, 'idUsuarioCarrera');
        $idCarrera = $objUsuarioCarrera->getIdCarrera();
        $idUsuario = $objUsuarioCarrera->getIdUsuario();
        //$idTipoBeneficio = $objUsuarioCarrera->getIdTipoBeneficio();
        $fecha = $objUsuarioCarrera->getFecha();
        $hora = $objUsuarioCarrera->getHora();
        $indicador = $objUsuarioCarrera->getIndicador();
        $this->task->setTables(self::TABLE);
        $this->task->setFields('idUsuarioCarrera;idCarrera;idUsuario;uocFecha;uocHora;uocIndicador');
        $this->task->setValues($idCarrera . ';' . $idUsuario . ';' . $fecha . ';' . $hora . ';' . $indicador);
        $usuarioCarrera[0] = $this->task->executeInsert('idUsuarioCarrera');
        $usuarioCarrera[1] = $idUsuarioCarrera;
        return $usuarioCarrera;
    }

    public function GeneratePlanEstudioUsuario($objUsuarioCarrera) {
        $idUsuarioCarrera = $objUsuarioCarrera->getIdUsuarioCarrera();
        $idUsuario = $objUsuarioCarrera->getIdUsuario();
        $idCarrera = $objUsuarioCarrera->getIdCarrera();
        $this->task->setTables(self::TABLE . ';usuario;personal;tipobeneficio;carrera;planestudio;curso;ciclo');
        //$this->task->setFields('idUsuarioCarrera;idUsuario;idCarrera;carDescripcion;carPeriodos;idCurso;crsNombre;idCiclo;cloDescripcion;idUsuario;usrNombre;usrClave;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo');
        $this->task->setFields('idUsuarioCarrera;idCarrera;carDescripcion;carPeriodos;idUsuario;usrNombre;usrClave;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo;idTipoBeneficio;tboDescripcion;tboPagoMatricula;tboPagoMensual;tboDescuentoPorcentaje;tboPaMatriculaDesc;tboPaMensualDesc;uocFecha;uocHora;idPlanEstudio;idCurso;crsNombre;idCiclo;cloDescripcion');
        $this->task->setIndex('0;0;4;4;0;1;1;2;2;2;2;2;2;3;3;3;3;3;3;3;0;0;5;5;6;5;7');
        $this->task->setTypeJoin('inner;inner;inner;inner;inner;inner;inner');
        //$this->task->setOnJoin('p0.idCarrera=c1.idCarrera;p0.idCurso=c2.idCurso;p0.idCiclo=c3.idCiclo');
        $this->task->setOnJoin('u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idTipoBeneficio=t3.idTipoBeneficio;u0.idCarrera=c4.idCarrera;c4.idCarrera=p5.idCarrera;p5.idCurso=c6.idCurso;p5.idCiclo=c7.idCiclo');
        $this->task->setWhereFields('u0.idUsuarioCarrera;u0.idCarrera;u0.idUsuario');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues($idUsuarioCarrera . ';' . $idCarrera . ';' . $idUsuario);
        $this->task->setOrder('c7.idCiclo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function GeneratePlanEstudioUsuarioMatriculaCiclo($objUsuarioCarrera, $_idCiclo = '') {
        $idUsuarioCarrera = $objUsuarioCarrera->getIdUsuarioCarrera();
        $idCiclo = $_idCiclo;
        $this->task->setTables(self::TABLE . ';usuario;personal;tipobeneficio;carrera;planestudio;curso;ciclo');
        //$this->task->setFields('idUsuarioCarrera;idUsuario;idCarrera;carDescripcion;carPeriodos;idCurso;crsNombre;idCiclo;cloDescripcion;idUsuario;usrNombre;usrClave;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo');
        $this->task->setFields('idUsuarioCarrera;idCarrera;carDescripcion;carPeriodos;idUsuario;usrNombre;usrClave;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo;idTipoBeneficio;tboDescripcion;tboPagoMatricula;tboPagoMensual;tboDescuentoPorcentaje;tboPaMatriculaDesc;tboPaMensualDesc;uocFecha;uocHora;idPlanEstudio;idCurso;crsNombre;idCiclo;cloDescripcion');
        $this->task->setIndex('0;0;4;4;0;1;1;2;2;2;2;2;2;3;3;3;3;3;3;3;0;0;5;5;6;5;7');
        $this->task->setTypeJoin('inner;inner;inner;inner;inner;inner;inner');
        //$this->task->setOnJoin('p0.idCarrera=c1.idCarrera;p0.idCurso=c2.idCurso;p0.idCiclo=c3.idCiclo');
        $this->task->setOnJoin('u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idTipoBeneficio=t3.idTipoBeneficio;u0.idCarrera=c4.idCarrera;c4.idCarrera=p5.idCarrera;p5.idCurso=c6.idCurso;p5.idCiclo=c7.idCiclo');

        if ($idCiclo != '') {
            $this->task->setWhereFields('u0.idUsuarioCarrera;c7.idCiclo');
            $this->task->setWhereLogical('=;=');
            $this->task->setWhereValues($idUsuarioCarrera . ';' . $idCiclo);
        } else {
            $this->task->setWhereFields('u0.idUsuarioCarrera');
            $this->task->setWhereLogical('=');
            $this->task->setWhereValues($idUsuarioCarrera);
        }
        $this->task->setOrder('c7.idCiclo');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteCompleteCombobox($objUsuarioCarrera) {
        $idCarrera = $objUsuarioCarrera->getIdCarrera();
        $this->task->setTables(self::TABLE . ';usuario;personal;carrera');
        $this->task->setFields('idUsuarioCarrera;idUsuario;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;idCarrera;carDescripcion');
        $this->task->setIndex('0;1;2;2;2;2;0;3');
        $this->task->setTypeJoin('inner;inner;inner');
        $this->task->setOnJoin('u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idCarrera=c3.idCarrera');
        $this->task->setWhereFields('u0.idCarrera;u0.uocIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idCarrera.';1');
        $this->task->setOrder('p2.prsApellidoPaterno');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }
    
    public function SearchUsuarioCarrera($objUsuarioCarrera){
        $idUsuarioCarrera = $objUsuarioCarrera->getIdUsuarioCarrera();
        $this->task->setTables(self::TABLE.';carrera;usuario;tipobeneficio');
        $this->task->setFields('idUsuarioCarrera;idCarrera;carDescripcion;idUsuario;usrNombre;idTipoBeneficio;tboDescripcion;uocFecha;uocHora');
        $this->task->setIndex('0;0;1;0;2;0;3;0;0');
        $this->task->setTypeJoin('inner;inner;inner');
        $this->task->setOnJoin('u0.idCarrera=c1.idCarrera;u0.idUsuario=u2.idUsuario;u0.idTipoBeneficio=t3.idTipoBeneficio');
        $this->task->setWhereFields('u0.idUsuarioCarrera;u0.uocIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idUsuarioCarrera.';1');
        return $this->task->executeMultiSelect();
    }
    
    public function ExecuteFind($objUsuarioCarrera) {
        $idUsuarioCarrera = $objUsuarioCarrera->getIdUsuarioCarrera();
        $this->task->setTables(self::TABLE.';usuario;personal;carrera');
        $this->task->setFields('idUsuarioCarrera;idCarrera;carDescripcion;idUsuario;usrNombre;uocFecha;uocHora;idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI');
        $this->task->setIndex('0;0;3;0;1;0;0;1;2;2;2;2');
        $this->task->setTypeJoin('inner;inner;inner');
        $this->task->setOnJoin('u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idCarrera=c3.idCarrera');
        $this->task->setWhereFields('u0.idUsuarioCarrera;u0.uocIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues($idUsuarioCarrera.';1');
        return $this->task->executeMultiSelect();
    }
}

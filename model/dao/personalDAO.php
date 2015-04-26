<?php

require_once __DIR__.'/../config/mysqli.data.php';
require_once __DIR__.'/../entity/personal.php';

class PersonalDAO {

    public $objPersonal;
    private $task;

    const TABLE = "personal";

    public function __construct() {
        $this->objPersonal = new Personal();
        $this->task = new Task();
    }

    public function ExecuteSave($objPersonal) {
        $idPersonal = $this->task->getId(self::TABLE, 'idPersonal');
        $nombres = $objPersonal->getNombres();
        $apellidoPaterno = $objPersonal->getApellidoPaterno();
        $apellidoMaterno = $objPersonal->getApellidoMaterno();
        $dni = $objPersonal->getDNI();
        $telefono = $objPersonal->getTelefono();
        $email = $objPersonal->getEmail();
        $idUbigeo = $objPersonal->getIdUbigeo();
        $direccion = $objPersonal->getDireccion();
        $sexo = $objPersonal->getSexo();
        $estadoCivil = $objPersonal->getEstadoCivil();
        $fNacimiento = $objPersonal->getFNacimiento();
        $nacionalidad = $objPersonal->getNacionalidad();
        $indicador = $objPersonal->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo;prsTelefono;idUbigeo;prsDireccion;prsSexo;prsEstadoCivil;prsFNacimiento;prsNacionalidad;prsIndicador');
        $this->task->setValues($nombres . ';' . $apellidoPaterno . ';' . $apellidoMaterno . ';' . $dni . ';' . $email . ';' . $telefono . ';' . $idUbigeo . ';' . $direccion . ';' . $sexo . ';' . $estadoCivil . ';' . $fNacimiento . ';' . $nacionalidad . ';' . $indicador);
        $result[0] = $this->task->executeInsert('idPersonal');
        $result[1] = $idPersonal;
        return $result;
    }

    public function ExecuteDelete($objPersonal) {
        $idPersonal = $objPersonal->getIdPersonal();
        $this->task->setTables(self::TABLE);
        $this->task->setWhereFields('idPersonal');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPersonal);

        return $this->task->executeDelete();
    }

    public function ExecuteUpdate($objPersonal) {
        $idPersonal = $objPersonal->getIdPersonal();
        $nombres = $objPersonal->getNombres();
        $apellidoPaterno = $objPersonal->getApellidoPaterno();
        $apellidoMaterno = $objPersonal->getApellidoMaterno();
        $dni = $objPersonal->getDNI();
        $telefono = $objPersonal->getTelefono();
        $email = $objPersonal->getEmail();
        $idUbigeo = $objPersonal->getIdUbigeo();
        $direccion = $objPersonal->getDireccion();
        $sexo = $objPersonal->getSexo();
        $estadoCivil = $objPersonal->getEstadoCivil();
        $fNacimiento = $objPersonal->getFNacimiento();
        $nacionalidad = $objPersonal->getNacionalidad();
        $indicador = $objPersonal->getIndicador();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo;prsTelefono;idUbigeo;prsDireccion;prsSexo;prsEstadoCivil;prsFNacimiento;prsNacionalidad;prsIndicador');
        $this->task->setValues($nombres . ';' . $apellidoPaterno . ';' . $apellidoMaterno . ';' . $dni . ';' . $email . ';' . $telefono . ';' . $idUbigeo . ';' . $direccion . ';' . $sexo . ';' . $estadoCivil . ';' . $fNacimiento . ';' . $nacionalidad . ';' . $indicador);
        $this->task->setWhereFields('idPersonal');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($idPersonal);
        $result[0] = $this->task->executeUpdate();
        $result[1] = $idPersonal;
        return $result;
    }

    public function ExecuteSearchMail($objPersonal) {

        $mail = $objPersonal->getEmail();

        $this->task->setTables(self::TABLE);
        $this->task->setFields('prsCorreo');
        $this->task->setWhereFields('prsCorreo');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($mail);

        $count = array();
        $count = $this->task->executeSelect();

        return count($count);
    }

    public function ExecuteSendMail($objPersonal, $code) {


        $mail = $objPersonal->getEmail();

        $this->task->setTables(self::TABLE . ';usuario');
        $this->task->setFields('idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsCorreo;idUsuario;usrNombre');
        $this->task->setIndex('0;0;0;0;0;1;1');
        $this->task->setTypeJoin('inner;inner');
        $this->task->setOnJoin('p0.idPersonal=u1.idPersonal');
        $this->task->setWhereFields('p0.prsCorreo');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($mail);

        $personal = array();
        $personal = $this->task->executeMultiSelect();

        if (count($personal) > 0) {
            $personal = $personal[0];
            $this->task = new Task();
            $this->task->setTables('recuperarclave');
            $this->task->setFields('idRecuperarClave;rceCode1;rceCode2;idPersonal;rceIndicador');
            $this->task->setValues($code[0] . ';' . $code[1] . ';' . $personal->idPersonal . ';' . '1');
            $recover = $this->task->executeInsert('idRecuperarClave');
            if ($recover) {
                $result = array($personal, $code[0], $code[1]);
            } else {
                $result = 'fail';
            }
        } else {
            $result = 'notFound';
        }

        return $result;
    }

    public function ExecuteFind($objPersonal) {
        $id = $objPersonal->getIdPersonal();

        $this->task->setTables(self::TABLE . ';usuario');
        $this->task->setFields('idPersonal;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI;prsCorreo;prsTelefono;idUbigeo;prsDireccion;prsSexo;prsEstadoCivil;prsFNacimiento;prsNacionalidad;prsIndicador;idUsuario;usrNombre;usrClave;idPerfil;usrIndicador');
        $this->task->setIndex('0;0;0;0;0;0;0;0;0;0;0;0;0;0;1;1;1;1;1');
        $this->task->setTypeJoin('left');
        $this->task->setOnJoin('p0.idPersonal=u1.idPersonal');
        $this->task->setWhereFields('p0.idPersonal');
        $this->task->setWhereLogical('=');
        $this->task->setWhereValues($id);

        return $this->task->executeMultiSelect();
    }

    //combo según perfil
    public function ExecuteCompleteCombobox2($objUsuario) {

        $idPerfil = $objUsuario->getIdPerfil();

        $this->task->setTables(self::TABLE . ';usuario');
        $this->task->setFields('idUsuario;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI');
        $this->task->setIndex('1;0;0;0;0');
        $this->task->setTypeJoin('inner');
        $this->task->setOnJoin('p0.idPersonal=u1.idPersonal');
        $this->task->setWhereFields('p0.prsIndicador;u1.usrIndicador;u1.idPerfil');
        $this->task->setWhereLogical('=;=;=');
        $this->task->setWhereValues('1;1;' . $idPerfil);
        $this->task->setOrder('p0.prsApellidoPaterno');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

    public function ExecuteCompleteCombobox() {
        $this->task->setTables(self::TABLE . ';usuario');
        $this->task->setFields('idUsuario;prsNombre;prsApellidoPaterno;prsApellidoMaterno;prsDNI');
        $this->task->setIndex('1;0;0;0;0');
        $this->task->setTypeJoin('inner');
        $this->task->setOnJoin('p0.idPersonal=u1.idPersonal');
        $this->task->setWhereFields('p0.prsIndicador;u1.usrIndicador');
        $this->task->setWhereLogical('=;=');
        $this->task->setWhereValues('1;1');
        $this->task->setOrder('p0.prsApellidoPaterno');
        $this->task->setValuesOrder('asc');
        return $this->task->executeMultiSelect();
    }

}

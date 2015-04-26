$(document).ready(function () {
    gridAlumnos();
    searchDataInscripcion();
});

function gridAlumnos() {
    var Name = $('#inputName').val();
    var FName = $('#inputFName').val();
    var MName = $('#inputMName').val();
    var DNI = $('#inputDNI').val();
    var objGrid = {
        div: 'tableAlumnos',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'personal;usuario',
        colNames: ['', 'NOMBRES', 'APE. PATERNO', 'APE. MATERNO', 'DNI', 'NÚMERO', 'CORREO', 'USUARIO'],
        colModel: [
            {name: 'idPersonal', index: '0', align: 'center'},
            {name: 'prsNombre', index: '0'},
            {name: 'prsApellidoPaterno', index: '0'},
            {name: 'prsApellidoMaterno', index: '0'},
            {name: 'prsDNI', index: '0'},
            {name: 'prsTelefono', index: '0'},
            {name: 'prsCorreo', index: '0'},
            {name: 'usrNombre', index: '1'}
        ],
        join: {
            type: 'inner',
            on: 'p0.idpersonal=u1.idpersonal'
        },
        where: {
            fields: 'p0.prsNombre;p0.prsApellidoPaterno;p0.prsApellidoMaterno;p0.prsDNI;u1.idPerfil',
            logical: 'like;like;like;like;=',
            values: '%' + Name + '%;%' + FName + '%;%' + MName + '%;%' + DNI + '%;2'
        },
        page: 1,
        rowNum: 10,
        sortName: 'idPersonal',
        sortOrder: 'asc',
        title: 'ALUMNOS',
        edit: "editStudent(this.id);"
    };
    loadGrid(objGrid);
    var _btn = '';
    $('.tableAlumnos div.widget-head div.widget-icons.pull-right').html(_btn);
}

function editStudent(_id) {
    var url = baseHTTP + 'controller/__personal.php?action=find&idPersonal=' + _id;
    var personal = jqueryAjax(url, false, '');
    var objPersonal = jQuery.parseJSON(personal);

    objPersonal.usrClave = 'C0ntrasen4';

    formAlumno(objPersonal);
}

function searchDataInscripcion() {
    var id = $_GET('id');
    if (id !== undefined) {
        var url = baseHTTP + 'controller/__inscripcion.php?action=searchData&id=' + id;
        var dataInscripcion = jqueryAjax(url, false, '');
        var jsonInscripcion = $.parseJSON(dataInscripcion);
        var objForm = {
            insIdPersonal: '',
            insNombres: jsonInscripcion.insNombres,
            insApellidoPaterno: jsonInscripcion.insApellidoPaterno,
            insApellidoMaterno: jsonInscripcion.insApellidoMaterno,
            insDNI: jsonInscripcion.insDNI,
            insCorreo: jsonInscripcion.insCorreo,
            insTelefono: jsonInscripcion.insTelefono,
            idUbigeo: jsonInscripcion.idUbigeo,
            insDireccion: jsonInscripcion.insDireccion,
            insSexo: jsonInscripcion.insSexo,
            insEstadoCivil: jsonInscripcion.insEstadoCivil,
            insFNacimiento: jsonInscripcion.insFNacimiento,
            insNacionalidad: jsonInscripcion.insNacionalidad,
            insIdUsuario: '',
            insUsuario: '',
            insPassword: ''
        };
        formAlumno(objForm);
    }
}

function newForm() {
    var objForm = {
        insIdPersonal: '', insNombres: '', insApellidoPaterno: '', insApellidoMaterno: '', insDNI: '', insCorreo: '', insTelefono: '', idUbigeo: '', insDireccion: '', insSexo: '', insEstadoCivil: '', insFNacimiento: '', insNacionalidad: '', insIdUsuario: '', insUsuario: '', insPassword: ''
    };
    formAlumno(objForm);
}

function formAlumno(objForm) {
    $(".tableAlumnos").remove();

    var form = '<form id="formPersonal" name="formPersonal" class="form-horizontal" role="form" >';
    form += getBeginWinget(8) + 'DATOS PERSONALES' + getContentWinget();

    form += '<input id="userType" name="userType" type="text" class="notVisible" value="YWx1bW5v">';
    form += '<input id="idPersonal" name="idPersonal" type="text" class="notVisible">';

    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Nombres</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="inputName" name="inputName" type="text" class="form-control" placeholder="Nombres" onkeyup="completeUser();" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Apellido Paterno</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="inputFName" name="inputFName" type="text" class="form-control" placeholder="Apellido Paterno" onkeyup="completeUser();" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Apellido Materno</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="inputMName" name="inputMName" type="text" class="form-control" placeholder="Apellido Materno" onkeyup="completeUser();" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">DNI</label>';
    form += '<div class="col-lg-4">';
    form += '<input id="inputDNI" name="inputDNI" type="text" class="form-control" placeholder="DNI" maxlength="8" onkeyup="completePassword();" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Sexo</label>';
    form += '<div class="col-lg-6">';
    form += '<div class="radio">';
    form += '<label>';
    form += '<input type="radio" name="inputSexo" id="inputSexo" value="M" checked="checked"> Masculino';
    form += '</label>';
    form += '</div>';
    form += '<div class="radio">';
    form += '<label>';
    form += '<input type="radio" name="inputSexo" id="inputSexo" value="F" >Femenino';
    form += '</label>';
    form += '</div>	';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Estado Civil</label>';
    form += '<div class="col-lg-4">';
    form += '<select id="inputEstadoCivil" name="inputEstadoCivil" class="form-control">';
    form += '<option value="">-- ESTADO CIVIL --</option>';
    form += '<option value="1">SOLTERO</option>';
    form += '<option value="2">CASADO</option>';
    form += '<option value="3">VIUDO</option>';
    form += '<option value="4">DIVORCIADO</option>';
    form += '</select>';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Fecha de Nacimiento</label>';
    form += '<div class="col-lg-4">';
    form += '<div id="insFNacimiento" name="insFNacimiento" class="input-append input-group dtpicker">';
    form += '<input id="inputFNacimiento" name="inputFNacimiento" data-format="dd-MM-yyyy" type="text" class="form-control">';
    form += '<span class="input-group-addon add-on">';
    form += '<i data-time-icon="fa fa-times" data-date-icon="fa fa-calendar" class="fa fa-calendar"></i>';
    form += '</span>';
    form += '</div>';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Nacionalidad</label>';
    form += '<div class="col-lg-6">';
    form += '<div class="radio">';
    form += '<label>';
    form += '<input type="radio" name="inputNacionalidad" id="inputNacionalidad" value="1" checked="checked">Peruana';
    form += '</label>';
    form += '</div>';
    form += '<div class="radio">';
    form += '<label>';
    form += '<input type="radio" name="inputNacionalidad" id="inputNacionalidad" value="2" >Extranjera';
    form += '</label>';
    form += '</div>	';
    form += '</div>';
    form += '</div>';
    form += '<div class="col-lg-4 col-lg-offset-6">';
    form += '<button type="button" class="btn btn-info btn-sm" onclick="javascript:confirmSave(\'cGVyc29uYWw=\', \'Zm9ybVBlcnNvbmFs\', \'\', \'\');" >Registrar</button>';
    form += '<button type="reset" class="btn btn-default btn-sm" >Limpiar</button>';
    form += '</div><br />';
    form += getEndWinget();
    form += getBeginWinget(8) + 'LOCALIZACIÓN' + getContentWinget();
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Dirección</label>';
    form += '<div class="col-lg-6">';
    form += '<textarea id="inputDireccion" name="inputDireccion" class="form-control" rows="5" placeholder="Dirección"></textarea>';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Ubigeo</label>';
    form += '<div class="col-lg-6">';
    form += '<select id="idUbigeo" name="idUbigeo" class="form-control">';
    form += '<option value="">-- UBIGEO --</option>';
    form += '</select>';
    form += '</div>    ';
    form += '</div>';
    form += '<div class="col-lg-4 col-lg-offset-6">';
    form += '<button type="button" class="btn btn-info btn-sm" onclick="javascript:confirmSave(\'cGVyc29uYWw=\', \'Zm9ybVBlcnNvbmFs\', \'\', \'\');" >Registrar</button>';
    form += '<button type="reset" class="btn btn-default btn-sm" >Limpiar</button>';
    form += '</div><br />';
    form += getEndWinget();
    form += getBeginWinget(8) + 'DATOS COMPLEMENTARIOS' + getContentWinget();
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Email</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="inputEmail" name="inputEmail" type="text" class="form-control" placeholder="usuario@dominio" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Teléfono</label>';
    form += '<div class="col-lg-5">';
    form += '<input id="inputTelefono" name="inputTelefono" type="text" class="form-control" placeholder="Fijo/Movil" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="col-lg-4 col-lg-offset-6">';
    form += '<button type="button" class="btn btn-info btn-sm" onclick="javascript:confirmSave(\'cGVyc29uYWw=\', \'Zm9ybVBlcnNvbmFs\', \'\', \'\');" >Registrar</button>';
    form += '<button type="reset" class="btn btn-default btn-sm" >Limpiar</button>';
    form += '</div><br />';
    form += getEndWinget();
    form += getBeginWinget(8) + 'USUARIO' + getContentWinget();
    form += '<div class="form-group">';
    form += '<input id="idUsuario" name="idUsuario" type="text" class="notVisible">';
    form += '<label class="col-lg-3 control-label">Usuario</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="inputUsuario" name="inputUsuario" type="text" class="form-control" placeholder="Usuario" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Password</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="inputPassword" name="inputPassword" type="text" class="form-control" placeholder="Password" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="col-lg-4 col-lg-offset-6">';
    form += '<button type="button" class="btn btn-info btn-sm" onclick="javascript:confirmSave(\'cGVyc29uYWw=\', \'Zm9ybVBlcnNvbmFs\', \'\', \'\');" >Registrar</button>';
    form += '<button type="reset" class="btn btn-default btn-sm" >Limpiar</button>';
    form += '</div><br />';
    form += getEndWinget();
    form += getBeginWinget(8) + 'APODERADO' + getContentWinget();
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Nombres</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="insEmail" name="insEmail" type="text" class="form-control" placeholder="Nombres" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Apellido Paterno</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="insEmail" name="insEmail" type="text" class="form-control" placeholder="Apellido Paterno" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Apellido Materno</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="insEmail" name="insEmail" type="text" class="form-control" placeholder="Apellido Materno" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">DNI</label>';
    form += '<div class="col-lg-4">';
    form += '<input id="insEmail" name="insEmail" type="text" class="form-control" placeholder="DNI" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Teléfono</label>';
    form += '<div class="col-lg-5">';
    form += '<input id="insEmail" name="insEmail" type="text" class="form-control" placeholder="Teléfono" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Correo</label>';
    form += '<div class="col-lg-6">';
    form += '<input id="insTelefono" name="insTelefono" type="text" class="form-control" placeholder="Correo" >';
    form += '</div>';
    form += '</div>';
    form += getEndWinget();
    form += '</form>';

    $(".matter .container").html(form);

    var insIdPersonal = objForm.idPersonal;
    var insNombres = objForm.prsNombre;
    var insApellidoPaterno = objForm.prsApellidoPaterno;
    var insApellidoMaterno = objForm.prsApellidoMaterno;
    var insDNI = objForm.prsDNI;
    var insCorreo = objForm.prsCorreo;
    var insTelefono = objForm.prsTelefono;
    var idUbigeo = objForm.idUbigeo;
    var insDireccion = objForm.prsDireccion;
    var insSexo = objForm.prsSexo;
    var insEstadoCivil = objForm.prsEstadoCivil;
    var insFNacimiento = objForm.prsFNacimiento;
    var insNacionalidad = objForm.prsNacionalidad;
    var insIdUsuario = objForm.idUsuario;
    var insUsuario = objForm.usrNombre;
    var insPassword = objForm.usrClave;

    /////////////////////////////////////////////////////////////////
    $('#insFNacimiento').datetimepicker({pickTime: false});
    comboboxUbigeo();
    /////////////////////////////////////////////////////////////////
    $('#idPersonal').val(insIdPersonal);
    $('#inputName').val(insNombres);
    $('#inputFName').val(insApellidoPaterno);
    $('#inputMName').val(insApellidoMaterno);
    $('#inputDNI').val(insDNI);
    if (insSexo === 'M') {
        $('#inputDNI[value="M"]').attr('checked', true);
    } else if (insSexo === 'F') {
        $('#inputDNI[value="F"]').attr('checked', true);
    }
    $('#inputEstadoCivil').val(insEstadoCivil);
    var FInsFNacimiento = insFNacimiento.split('-');
    $('#insFNacimiento').data('datetimepicker').setLocalDate(new Date(FInsFNacimiento[0], FInsFNacimiento[1] - 1, FInsFNacimiento[2]));
    if (insNacionalidad === '1') {
        $('#inputNacionalidad[value="1"]').attr('checked', true);
    } else if (insNacionalidad === '2') {
        $('#inputNacionalidad[value="2"]').attr('checked', true);
    }
    $('#inputDireccion').val(insDireccion);
    $('#idUbigeo').val(idUbigeo);
    $('#inputEmail').val(insCorreo);
    $('#inputTelefono').val(insTelefono);

    if (insIdUsuario !== '') {
        $('#idUsuario').val(insIdUsuario);
        $('#inputUsuario').val(insUsuario);
        $('#inputPassword').val(insPassword);
    } else {
        completeUser();
        completePassword();
    }
}

function comboboxUbigeo() {
    //$('#idUbigeo option[value!=""]').remove();
    var url = baseHTTP + 'controller/__ubigeo.php?action=combobox';
    var res = jqueryAjax(url, false, '');
    res = jQuery.parseJSON(res);
    for (i = 0; i < res.length; i++) {
        var data = res[i];
        $('#idUbigeo').append(new Option(data.descripcion, data.idUbigeo));
    }
}

function completeUser() {
    var first = $.trim($('#inputName').val()).slice(0, 1);
    var middle = $.trim($('#inputFName').val());
    var last = $.trim($('#inputMName').val()).slice(0, 1);
    var user = first + middle + last;
    user = skipAccent(user);
    $('#inputUsuario').val(user.toLowerCase());
}

function completePassword() {
    var first = $.trim($('#inputName').val()).slice(0, 1);
    var middle = $.trim($('#inputFName').val()).slice(0, 1);
    var last = $.trim($('#inputMName').val()).slice(0, 1);
    var dni = $.trim($('#inputDNI').val()).slice(4, 8);
    var password = first.toUpperCase() + middle.toLowerCase() + last.toLowerCase() + dni;
    password = skipAccent(password);
    $('#inputPassword').val(password);
}

function validatePersonal() {
    if (validNumberId()) {
        if (validateFormControl('inputName', 'text', true, true, 'Nombres no válidos.')) {
            if (validateFormControl('inputFName', 'text', true, true, 'Apellidos no válidos.')) {
                if (validateFormControl('inputMName', 'text', true, true, 'Apellidos no válidos.')) {
                    if (validateFormControl('inputDNI', 'dni', true, true, 'DNI no válido.')) {
                        if (validateDuplicate('inputDNI', 'personal', 'prsDNI', 'idPersonal', 'idPersonal')) {
                            if (validateFormControl('inputTelefono', 'telephone', true, true, 'Teléfono no válido.')) {
                                if (validateDuplicate('inputTelefono', 'personal', 'prsTelefono', 'idPersonal', 'idPersonal')) {
                                    if (validateFormControl('inputEmail', 'mail', true, true, 'Correo no válido.')) {
                                        if (validateDuplicate('inputEmail', 'personal', 'prsCorreo', 'idPersonal', 'idPersonal')) {
                                            if (validateFormControl('idUbigeo', 'number', false, false, 'Ubigeo no válido.')) {
                                                if (validateFormControl('inputDireccion', 'address', true, true, 'Dirección no válida')) {
                                                    if (validateFormControl('inputSexo', 'char', true, true, 'Sexo no válido')) {
                                                        if (validateFormControl('inputEstadoCivil', 'number', true, true, 'Estado civil no válido')) {
                                                            if (validateFormControl('inputFNacimiento', 'date', true, true, 'Fecha no válida')) {
                                                                if (validateFormControl('inputNacionalidad', 'number', true, true, 'Nacionalidad no válida')) {
                                                                    if (validateFormControl('inputUsuario', 'user', true, true, 'Usuario no válido')) {
                                                                        if (validateDuplicate('inputUsuario', 'usuario', 'usrNombre', 'idUsuario', 'idUsuario')) {
                                                                            if (validateFormControl('inputPassword', 'password', true, true, 'Contraseña no válida.')) {
                                                                                return true;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function validNumberId() {
    $('#idPersonal').val();
    if (validateFormControl('idPersonal', 'number', false, false, '')) {
        return true;
    } else {
        openPopUp('Error de Registro', 'La información del alumno que intenta modificar, no existe. ¿Desea ir al formulario de Registro?', 'href("registrarAlumno.php")', '', '');
        return false;
    }

}
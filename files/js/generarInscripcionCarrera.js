$(document).ready(function () {
    comboboxCarrera();
    comboboxAlumno();
    currentDateTime();
});

function comboboxCarrera() {
    $('#idCarrera option[value!=""]').remove();
    var url = baseHTTP + 'controller/__carrera.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonCarrera = jQuery.parseJSON(result);
    for (i = 0; i < jsonCarrera.length; i++) {
        $('#idCarrera').append(new Option(jsonCarrera[i].carDescripcion, jsonCarrera[i].idCarrera));
    }
}

function comboboxAlumno() {
    $('#idUsuario option[value!=""]').remove();
    var url = baseHTTP + 'controller/__personal.php?action=combobox2&perfil=2';
    var result = jqueryAjax(url, false, '');
    var personal = jQuery.parseJSON(result);
    for (i = 0; i < personal.length; i++) {
        $('#idUsuario').append(new Option(personal[i].prsNombre + ' ' + personal[i].prsApellidoPaterno + ' ' + personal[i].prsApellidoMaterno + ' - ' + personal[i].prsDNI, personal[i].idUsuario));
    }
}

function validateUsuarioCarrera() {
    if (validateFormControl('idCarrera', 'number', true, true, 'Carrera no válida.')) {
        if (validateDuplicate('idUsuario', 'usuariocarrera', 'idUsuario', 'idUsuarioCarrera', 'UserProfession')) {
            if (validateFormControl('idUsuario', 'number', true, true, 'Estudiante no válido.')) {
                //if (validateFormControl('idTipoBeneficio', 'number', true, true, 'Beneficio no válido.')) {
                return true;
                //}
            }
        }
    }
}

function validateCarrera() {
    if (validateFormControl('idCarrera', 'number', false, false, 'Carrera no válida.')) {
        return true;
    }
}

function confirmSave2(_table, _form, _extraJS, _type) {
    _type || (_type = 'bWVzc2FnZQ==');
    var validate = false;
    var table = base64_decoding(_table);
    var type = base64_decoding(_type);
    if (table === 'usuarioCarrera') {
        validate = validateUsuarioCarrera();
    }
    if (validate === true) {
        var title = 'Confirmar guardar registro';
        var body = '<div class="quest">¿Desea guardar el registro actual?</div>';
        var actionSave = "executeSave2('" + _table + "','" + _form + "','" + _extraJS + "');";
        openPopUp(title, body, '', actionSave);
    }
}
/*===========================================================*/
function executeSave2(_table, _form, _extraJS) {
    var table = base64_decoding(_table);
    var form = base64_decoding(_form);
    var data = getForm(_form);
    var url = baseHTTP + "controller/__" + table + ".php?action=save&" + data;
    var result = jqueryAjax(url, true, 'quest');
    $('#repJsonData').val(result);
    var jsonData = jQuery.parseJSON(result);
    if (jsonData.result === 'success') {
        $('.modal-body').html('Registro actualizado con éxito.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();viewReport();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    } else {
        $('.modal-body').html('Error al actualizar el registro.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    }
}

function viewReport(jsonData) {
    var jsonData = $('#repJsonData').val();
    clearForm('Zm9ybUNhcnJlcmFVc3Vhcmlv');
    jsonData = jQuery.parseJSON(jsonData);

    var planEstudio = '<div class="widget">';
    planEstudio += '<div class="widget-head">';
    planEstudio += '<div class="pull-left">Detalle de Inscripción</div>';
    planEstudio += '<div class="widget-icons pull-right">';
    planEstudio += '<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>';
    planEstudio += '<a href="#" class="wclose"><i class="fa fa-times"></i></a>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '</div>';
    planEstudio += '<div class="widget-content">';

    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Estudiante</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputEstudiante" name="inputEstudiante" type="text" readonly="" class="form-control" value="' + jsonData.prsNombre + ' ' + jsonData.prsApellidoPaterno + ' ' + jsonData.prsApellidoMaterno + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">DNI</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputDNI" name="inputDNI" type="text" readonly="" class="form-control" value="' + jsonData.prsDNI + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Correo</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputCorreo" name="inputCorreo" type="text" readonly="" class="form-control" value="' + jsonData.prsCorreo + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Usuario</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inoutUsuario" name="inoutUsuario" type="text" readonly="" class="form-control" value="' + jsonData.usrNombre + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Carrera</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputCarrera" name="inputCarrera" type="text" readonly="" class="form-control" value="' + jsonData.carDescripcion + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Periodos</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inoutPeriodos" name="inoutPeriodos" type="text" readonly="" class="form-control" value="' + jsonData.carPeriodos + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Beneficio</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputBeneficio" name="inputBeneficio" type="text" readonly="" class="form-control" value="' + jsonData.tboDescripcion + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Pago Matrícula</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputPMatricula" name="inputPMatricula" type="text" readonly="" class="form-control" value="' + jsonData.tboPagoMatricula + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Pago Mensual</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputPMensual" name="inputPMensual" type="text" readonly="" class="form-control" value="' + jsonData.tboPagoMensual + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Descuento</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputDescuento" name="inputDescuento" type="text" readonly="" class="form-control" value="' + jsonData.tboDescuentoPorcentaje + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Matricula Final</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputPFMatricula" name="inputPFMatricula" type="text" readonly="" class="form-control" value="' + jsonData.tboPaMensualDesc + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Pensión Final</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputPFMensual" name="inputPFMensual" type="text" readonly="" class="form-control" value="' + jsonData.tboPaMensualDesc + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Fecha</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputFecha" name="inputFecha" type="text" readonly="" class="form-control" value="' + jsonData.uocFecha + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="form-group">';
    planEstudio += '<label class="col-lg-2 control-label">Hora</label>';
    planEstudio += '<div class="col-lg-5">';
    planEstudio += '<input id="inputHora" name="inputHora" type="text" readonly="" class="form-control" value="' + jsonData.uocHora + '">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '<div class="clearfix"></div>';
    planEstudio += '<div class="spacing3"></div>';
    planEstudio += '<table class="table table-striped table-bordered table-hover">';
    planEstudio += '<thead>';
    planEstudio += '<tr>';
    planEstudio += '<th>#</th>';
    planEstudio += '<th>Semestre</th>';
    planEstudio += '<th>Curso</th>';
    planEstudio += '</tr>';
    planEstudio += '</thead>';
    planEstudio += '<tbody>';
    for (i = 0; i < jsonData.cursos.length; i++) {
        planEstudio += '<tr>';
        planEstudio += '<td align="center">' + (i + 1) + '</td>';
        planEstudio += '<td>' + jsonData.cursos[i].cloDescripcion + '</td>';
        planEstudio += '<td>' + jsonData.cursos[i].crsNombre + '</td>';
        planEstudio += '<tr>';
    }
    planEstudio += '</tbody>';
    planEstudio += '</table>';
    planEstudio += '<div class="widget-foot">';
    planEstudio += '</div>';
    planEstudio += '</div>';
    planEstudio += '</div>';
    $("#contentInscripcion").append(planEstudio);
}

function generateReporteInscripcion() {
    var validate = false;
    validate = validateCarrera();
    if (validate === true) {
        var url = baseHTTP + 'controller/__planEstudio.php?action=searchAll&idCarrera=' + $('#idCarrera').val();
        var jsonPlanEstudio = jqueryAjax(url, false, '');
        jsonPlanEstudio = jQuery.parseJSON(jsonPlanEstudio);

        var planEstudio = '<div class="widget">';
        planEstudio += '<div class="widget-head">';
        planEstudio += '<div class="pull-left">Detalle de Inscripción</div>';
        planEstudio += '<div class="widget-icons pull-right">';
        planEstudio += '<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>';
        planEstudio += '<a href="#" class="wclose"><i class="fa fa-times"></i></a>';
        planEstudio += '</div>';
        planEstudio += '<div class="clearfix"></div>';
        planEstudio += '</div>';
        planEstudio += '<div class="widget-content">';

        planEstudio += '<div class="form-group">';
        planEstudio += '<label class="col-lg-2 control-label">Estudiante</label>';
        planEstudio += '<div class="col-lg-5">';
        planEstudio += '<input id="inputEstudiante" name="inputEstudiante" type="text" readonly="" class="form-control" value="' + jsonPlanEstudio.carDescripcion + '">';
        planEstudio += '</div>';
        planEstudio += '</div>';

        planEstudio += '<div class="form-group">';
        planEstudio += '<label class="col-lg-2 control-label">Carrera</label>';
        planEstudio += '<div class="col-lg-5">';
        planEstudio += '<input id="inputCarrera" name="inputCarrera" type="text" readonly="" class="form-control" value="' + jsonPlanEstudio.carDescripcion + '">';
        planEstudio += '</div>';
        planEstudio += '</div>';

        planEstudio += '<div class="form-group">';
        planEstudio += '<label class="col-lg-2 control-label">Periodos</label>';
        planEstudio += '<div class="col-lg-5">';
        planEstudio += '<input id="inputPeriodos" name="inputPeriodos" type="text" readonly="" class="form-control" value="' + jsonPlanEstudio.carPeriodos + '">>';
        planEstudio += '</div>';
        planEstudio += '</div>';

        planEstudio += '<div class="clearfix"></div>';
        planEstudio += '<table class="table table-striped table-bordered table-hover">';
        planEstudio += '<thead>';
        planEstudio += '<tr>';
        planEstudio += '<th>#</th>';
        planEstudio += '<th>Semestre</th>';
        planEstudio += '<th>Curso</th>';
        planEstudio += '</tr>';
        planEstudio += '</thead>';
        planEstudio += '<tbody>';
        for (i = 0; i < jsonPlanEstudio.cursos.length; i++) {
            planEstudio += '<tr>';
            planEstudio += '<td align="center">' + i + '</td>';
            planEstudio += '<td>' + jsonPlanEstudio.cursos[i].cloDescripcion + '</td>';
            planEstudio += '<td>' + jsonPlanEstudio.cursos[i].crsNombre + '</td>';
            planEstudio += '<tr>';
        }
        planEstudio += '</tbody>';
        planEstudio += '</table>';
        planEstudio += '<div class="widget-foot">';
        planEstudio += '</div>';
        planEstudio += '</div>';
        planEstudio += '</div>';
        $("#contentInscripcion").append(planEstudio);
    }
}

function gridFichaInscripcionCarrera() {
    var UserProfession = $('#inputUserProfession').val();
    UserProfession = (UserProfession === undefined) ? '' : UserProfession;
    var User = $('#idUsuario').val();
    User = (User === undefined) ? '' : User;
    var Profession = $('#idCarrera').val();
    Profession = (Profession === undefined) ? '' : Profession;
    if (!empty(Profession)) {
        var objGrid = {
            div: 'tablePlanEstudios',
            url: baseHTTP + 'controller/__grid.php?action=loadGrid',
            table: 'usuariocarrera;usuario;personal;carrera;planestudio;curso;ciclo',
            colNames: ['', 'CICLO', 'CURSO'],
            colModel: [
                {name: 'idUsuarioCarrera', index: '0', align: 'left'},
                {name: 'cloDescripcion', index: '6'},
                {name: 'crsNombre', index: '5'}
            ],
            join: {
                type: 'inner;inner;inner;inner;inner;inner',
                on: 'u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idCarrera=c3.idCarrera;c3.idCarrera=p4.idCarrera;p4.idCurso=c5.idCurso;p4.idCiclo=c6.idCiclo'
            },
            where: {
                fields: 'u0.idUsuarioCarrera;u0.idCarrera;u0.idUsuario',
                logical: 'like;=;=',
                values: '%' + UserProfession + '%;' + Profession + ';' + User
            },
            page: 1,
            rowNum: 100,
            sortName: 'c6.idCiclo',
            sortOrder: 'asc',
            title: 'PLAN ESTUDIO',
            check: ''
        };
        loadGrid(objGrid);
        $('.tablePlanEstudios div.widget-head div.widget-icons.pull-right button.btn.btn-sm.btn-info').remove();
    } else {
        openPopUp('Seleccionar Carrera','Debe seleccionar un carrera antes de listar el plan de estudio.','','','');
    }
}

function currentDateTime(){
    var _time = myTime();
    var _date = myDate();
    $('#inputHora').val(_time);
    $('#inputFecha').val(_date);
    setTimeout('currentDateTime()',1000);
}
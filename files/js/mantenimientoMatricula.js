$(document).ready(function () {
    comboboxUsuarioCarrera();
    comboboxCiclos();
    comboboxSeccion();
    comboboxSede();
    comboboxTurno();
    comboboxCarrera();
    comboboxEstado();
    comboboxBeneficio();
    gridMatricula();
});

function validateMatricula() {
    if (validateFormControl('idUsuarioCarrera', 'number', true, true, 'Estudiante / Inscripción no válido.')) {
        if (validateFormControl('idCiclo', 'number', true, true, 'Seleccionar ciclo.')) {
            if (validateFormControl('idSede', 'number', true, true, 'Seleccionar sede.')) {
                if (validateFormControl('idSeccion', 'number', true, true, 'Seleccionar Seccion.')) {
                    if (numberCheckCursos() > 0) {
                        if (validateDuplicateMatricula() === 1) {
                            return true;
                        }
                    }
                }
            }
        }
    }
}

function validateShowCursos() {
    if (validateFormControl('idUsuarioCarrera', 'number', true, true, 'Estudiante / Inscripción no válido.')) {
        if (validateFormControl('idSede', 'number', true, true, 'Seleccionar sede.')) {
            if (validateFormControl('idCiclo', 'number', true, true, 'Seleccionar ciclo.')) {
                if (validateFormControl('idTurno', 'number', true, true, 'Seleccionar Turno.')) {
                    if (validateFormControl('idSeccion', 'number', true, true, 'Seleccionar Seccion.')) {
                        if (validateFormControl('idTipoBeneficio', 'number', true, true, 'Seleccionar Beneficio.')) {
                            return true;
                        }
                    }
                }
            }
        }
    }
}

function numberCheckCursos() {
    var _count = 0;
    //$("input[type=checkbox][name='_gridCheckBox[]']:checked").each(function () {
    $('.tablePlanEstudiosMatricula tbody tr td input[type=checkbox][name="_gridCheckBox[]"]:checked').each(function () {
        _count++;
    });
    openPopUp('Seleccionar cursos', 'Seleccionar al menos un curso.', '', '', '');
    return _count;
}

function comboboxSeccion_DELETE() {
    var idCarrera = $('#idCarrera').val();
    var idTurno = $('#idTurno').val();

    $('#idSeccion option[value!=""]').remove();
    var url = baseHTTP + 'controller/__seccion.php?action=combobox&idCarrera=' + idCarrera + '&idTurno=' + idTurno;
    var result = jqueryAjax(url, false, '');
    var seccion = jQuery.parseJSON(result);
    for (i = 0; i < seccion.length; i++) {
        var opt = new Option(seccion[i].scnDescripcion, seccion[i].idSeccion);
        opt.setAttribute("data-max", seccion[i].scnCantMaxima);
        opt.setAttribute("data-ini", seccion[i].scnInicio);
        opt.setAttribute("data-fin", seccion[i].scnFin);
        $('#idSeccion').append(opt);
    }
}

function comboboxSeccion() {
    var idCarrera = $('#idCarrera').val();
    var idCiclo = $('#idCiclo').val();
    var idTurno = $('#idTurno').val();

    $('#idSeccion option[value!=""]').remove();
    var url = baseHTTP + 'controller/__seccion.php?action=combobox&idCarrera=' + idCarrera + '&idTurno=' + idTurno + '&idCiclo=' + idCiclo;
    var result = jqueryAjax(url, false, '');
    var seccion = jQuery.parseJSON(result);
    if(seccion == false){
        $('#seccionFound').removeClass('label-success');
        $('#seccionFound').addClass('label-default');
        $('#seccionFound').html('No hay secciones.');
    } else {
        $('#seccionFound').addClass('label-success');
        $('#seccionFound').removeClass('label-default');
        $('#seccionFound').html('Secciones encontradas.');
    }
    for (i = 0; i < seccion.length; i++) {
        var opt = new Option(seccion[i].scnDescripcion, seccion[i].idSeccion);
        opt.setAttribute("data-max", seccion[i].scnCantMaxima);
        opt.setAttribute("data-ini", seccion[i].scnInicio);
        opt.setAttribute("data-fin", seccion[i].scnFin);
        $('#idSeccion').append(opt);
    }
}

function comboboxUsuarioCarrera() {
    var idCarrera = $('#idCarrera').val();
    $('#idUsuarioCarrera option[value!=""]').remove();
    var url = baseHTTP + 'controller/__usuarioCarrera.php?action=combobox&idCarrera=' + idCarrera;
    var result = jqueryAjax(url, false, '');
    var usurioCarrera = jQuery.parseJSON(result);

    for (i = 0; i < usurioCarrera.length; i++) {
        var opt = new Option(usurioCarrera[i].prsNombre + ' ' + usurioCarrera[i].prsApellidoPaterno + ' ' + usurioCarrera[i].prsApellidoMaterno, usurioCarrera[i].idUsuarioCarrera);
        opt.setAttribute("data-dni", usurioCarrera[i].prsDNI);
        opt.setAttribute("data-carrera", usurioCarrera[i].carDescripcion);
        $('#idUsuarioCarrera').append(opt);
    }
}

function comboboxCiclos_DELETE() {
    $('#idCiclo option[value!=""]').remove();
    var url = baseHTTP + 'controller/__ciclo.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var ciclo = jQuery.parseJSON(result);
    for (i = 0; i < ciclo.length; i++) {
        $('#idCiclo').append(new Option(ciclo[i].cloDescripcion, ciclo[i].idCiclo));
    }
}

function comboboxCiclos() {
    var carrera = $('#idCarrera');
    if (carrera.val() == '') {
        $('#idCiclo option[value!=""]').remove();
    } else {
        $('#idCiclo option[value!=""]').remove();
        var _max = carrera.find(':selected').data('maxciclo');
        var url = baseHTTP + 'controller/__ciclo.php?action=comboboxMax&maxCiclo=' + _max;
        var result = jqueryAjax(url, false, '');
        var ciclo = jQuery.parseJSON(result);
        for (i = 0; i < ciclo.length; i++) {
            $('#idCiclo').append(new Option(ciclo[i].cloDescripcion, ciclo[i].idCiclo));
        }
    }
}

function comboboxSede() {
    $('#idSede option[value!=""]').remove();
    var url = baseHTTP + 'controller/__sede.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var sede = jQuery.parseJSON(result);
    for (i = 0; i < sede.length; i++) {
        $('#idSede').append(new Option(sede[i].sdeNombre, sede[i].idSede));
    }
}

function comboboxTurno() {
    $('#idTurno option[value!=""]').remove();
    var url = baseHTTP + 'controller/__turno.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonTurno = jQuery.parseJSON(result);
    for (i = 0; i < jsonTurno.length; i++) {
        $('#idTurno').append(new Option(jsonTurno[i].troDescripcion, jsonTurno[i].idTurno));
    }
}

function showExtraData() {
    var seccion = $('#idSeccion');
    var student = $('#idUsuarioCarrera');

    if (seccion.val() == '') {
        $("#mensajeMax").removeClass("label-danger");
        $("#mensajeMax").removeClass("label-success");
        $("#mensajeMax").addClass("label-info");
        $("#mensajeMax").html("No se seleccionó sección.");
        $("#mensajeIni").removeClass("label-danger");
        $("#mensajeIni").removeClass("label-success");
        $("#mensajeIni").addClass("label-info");
        $("#mensajeIni").html("No se seleccionó sección.");
    } else {
        var url = baseHTTP + 'controller/__matricula.php?action=currentStudents&idSeccion=' + seccion.val();
        var result = jqueryAjax(url, false, '');
        var result = jQuery.parseJSON(result);
        var _max = seccion.find(':selected').data('max');
        var _ini = seccion.find(':selected').data('ini').split('-');
        _ini = _ini[2] + '-' + _ini[1] + '-' + _ini[0];

        if (result.current >= _max) {
            $("#mensajeMax").removeClass("label-info");
            $("#mensajeMax").removeClass("label-success");
            $("#mensajeMax").addClass("label-danger");
            $("#mensajeMax").html("No se pueden registrar alumnos.( " + result.current + " de " + _max + " )");
            $("#mensajeIni").removeClass("label-info");
            $("#mensajeIni").removeClass("label-success");
            $("#mensajeIni").addClass("label-danger");
            $("#mensajeIni").html("Sección no válida.");
        }
        else {
            $("#mensajeMax").removeClass("label-info");
            $("#mensajeMax").addClass("label-success");
            $("#mensajeMax").removeClass("label-danger");
            $("#mensajeMax").html("Registro Válido.( " + result.current + " de " + _max + " )");
            $("#mensajeIni").removeClass("label-info");
            $("#mensajeIni").addClass("label-success");
            $("#mensajeIni").removeClass("label-danger");
            $("#mensajeIni").html("Inicio de clases: " + _ini);
        }
    }

    if (student.val() == '') {
        $("#mensajeDNI").removeClass("label-danger");
        $("#mensajeDNI").removeClass("label-success");
        $("#mensajeDNI").addClass("label-info");
        $("#mensajeDNI").html("No se seleccionó estudiante.");
    } else {
        var _dni = student.find(':selected').data('dni');
        $("#mensajeDNI").addClass("label-info");
        $("#mensajeDNI").removeClass("label-success");
        $("#mensajeDNI").removeClass("label-danger");
        $("#mensajeDNI").html("DNI: " + _dni);
    }
}

//function generateMatricula() {
//    var idPlanEstudio = new Array();//recorro los cursos seleccionados
//    $('#tableCursos tbody tr td input[type=checkbox]:checked').each(function () {
//        idPlanEstudio.push($(this).val());
//    });
//    var data = 'idUsuarioCarrera=' + $('#_idUsuarioCarrera').val() + '&idCiclo=' + $('#_idCiclo').val() + '&idSeccion=' + $('#_idSeccion').val() + '&planEstudioInscripcion=' + idPlanEstudio.join(';');
//    var url = baseHTTP + 'controller/__matricula.php?action=save&' + data;
//    var result = jqueryAjax(url, true, 'quest');
//    if (result === 'success') {
//        $('.modal-body').html('Registro actualizado con éxito. El estudiante debe cancelar el primer pago para activar esta matrícula.');
//        $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();clearForm(\'Zm9ybU1hdHJpY3VsYQ==\');" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
//    } else {
//        $('.modal-body').html('Error al actualizar el registro.');
//        $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
//    }
//}

function confirmGenerateMatricula() {
    var title = 'Confirmar guardar registro';
    var body = '<div class="quest">¿Desea guardar el registro actual?</div>';
    var actionSave = "generateMatricula();";
    openPopUp(title, body, '', actionSave);
}

function gridGeneratePlanEstudio() {
    if (validateShowCursos() === true) {
        var UserProfession = $('#idUsuarioCarrera').val();
        UserProfession = (UserProfession === undefined) ? '' : UserProfession;
        var Ciclo = $('#idCiclo').val();
        Ciclo = (Ciclo === undefined) ? '' : Ciclo;

        var objGrid = {
            div: 'tablePlanEstudiosMatricula',
            url: baseHTTP + 'controller/__grid.php?action=loadGrid',
            table: 'usuariocarrera;usuario;personal;carrera;planestudio;curso;ciclo',
            colNames: ['', 'CICLO', 'CURSO'],
            colModel: [
                {name: 'idPlanEstudio', index: '4', align: 'left'},
                {name: 'cloDescripcion', index: '6'},
                {name: 'crsNombre', index: '5'}
            ],
            join: {
                type: 'inner;inner;inner;inner;inner;inner',
                on: 'u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idCarrera=c3.idCarrera;c3.idCarrera=p4.idCarrera;p4.idCurso=c5.idCurso;p4.idCiclo=c6.idCiclo'
            },
            where: {
                fields: 'u0.idUsuarioCarrera;c6.idCiclo',
                logical: '=;=',
                values: UserProfession + ';' + Ciclo
            },
            page: 1,
            rowNum: 100,
            sortName: 'c6.idCiclo,p4.idPlanEstudio',
            sortOrder: 'asc',
            title: 'CURSOS PENDIENTES',
            checkbox: {
                prefix: 'crs',
                //accion: 'alert(this.id);'
                accion: ''
            }
        };
        loadGrid(objGrid);
        var _btn = '<button class="btn btn-sm btn-info" type="button" onclick="confirmSave(\'bWF0cmljdWxh\',\'Zm9ybU1hdHJpY3VsYU0=\',\'disbledShowButton();reloadPage();\',\'\')">Modificar Matrícula</button>';
        $('.tablePlanEstudiosMatricula div.widget-head div.widget-icons.pull-right').html(_btn);
    }
}

function printMatricula() {
    var pdfURL = baseHTTP + 'files/PDF/fichaMatricula.pdf';
    window.open(pdfURL);
}

function comboboxCarrera_DELETE() {
    $('#idCarrera option[value!=""]').remove();
    var url = baseHTTP + 'controller/__carrera.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonCarrera = jQuery.parseJSON(result);
    for (i = 0; i < jsonCarrera.length; i++) {
        $('#idCarrera').append(new Option(jsonCarrera[i].carDescripcion, jsonCarrera[i].idCarrera));
    }
}

function comboboxCarrera() {
    $('#idCarrera option[value!=""]').remove();
    var url = baseHTTP + 'controller/__carrera.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonCarrera = jQuery.parseJSON(result);
    for (i = 0; i < jsonCarrera.length; i++) {
        var opt = new Option(jsonCarrera[i].carDescripcion, jsonCarrera[i].idCarrera);
        opt.setAttribute("data-maxCiclo", jsonCarrera[i].carPeriodos);
        $('#idCarrera').append(opt);
    }
}

function comboboxEstado() {
    $('#idEstadoMatricula option[value!=""]').remove();
    var url = baseHTTP + 'controller/__estadoMatricula.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonEstadoMatricula = jQuery.parseJSON(result);
    for (i = 0; i < jsonEstadoMatricula.length; i++) {
        $('#idEstadoMatricula').append(new Option(jsonEstadoMatricula[i].descripcion, jsonEstadoMatricula[i].idEstado));
    }
}

function disbledShowButton() {
    showExtraData();
}

function validateDuplicateMatricula() {
    var _idUsuarioCarrera = $('#idUsuarioCarrera').val();
    var _idCiclo = $('#idCiclo').val();
    var url = baseHTTP + 'controller/__matricula.php?action=searchDuplicate&_idCiclo=' + _idCiclo + '&_idUsuarioCarrera=' + _idUsuarioCarrera;
    var duplicate = jqueryAjax(url, false, '');
    duplicate = jQuery.parseJSON(duplicate);
    openPopUp('Registro Erróneo', 'La Matrícula que desea modificar no existe en la base de datos.', '', '', '');
    return duplicate.count;
}

function comboboxBeneficio() {
    $('#idTipoBeneficio option[value!=""]').remove();
    var url = baseHTTP + 'controller/__tipoBeneficio.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonTipoBeneicio = jQuery.parseJSON(result);
    for (i = 0; i < jsonTipoBeneicio.length; i++) {
        $('#idTipoBeneficio').append(new Option(jsonTipoBeneicio[i].tboDescripcion + ' - (' + jsonTipoBeneicio[i].tboDescuentoPorcentaje + '%)', jsonTipoBeneicio[i].idTipoBeneficio));
    }
}

function gridMatricula() {
    //if (validateShowCursos() === true) {

    var UserProfession = $('#idUsuarioCarrera').val();
    var Ciclo = $('#idCiclo').val();
    var Seccion = $('#idSeccion').val();
    var Sede = $('#idSede').val();
    var EstadoMatricula = $('#idEstadoMatricula ').val();
    var indicador = '0';
    UserProfession = (UserProfession === undefined) ? '' : UserProfession;
    Ciclo = (Ciclo === undefined) ? '' : Ciclo;
    Seccion = (Seccion === undefined) ? '' : Seccion;
    Sede = (Sede === undefined) ? '' : Sede;
    EstadoMatricula = (EstadoMatricula === undefined) ? '' : EstadoMatricula;
    var objGrid = {
        div: 'tableMatriculas',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'matricula;usuariocarrera;ciclo;seccion;sede;estadomatricula;carrera;usuario;personal;tipobeneficio',
        colNames: ['', 'NOMBRES', 'APE. PATERNO', 'APE. MATERNO', 'DNI', 'CARRERA', 'CICLO', 'SECCIÓN', 'SEDE', 'BENEFICIO', 'FECHA', 'ESTADO'],
        colModel: [
            {name: 'idMatricula', index: '0', align: 'left'},
            {name: 'prsNombre', index: '8'},
            {name: 'prsApellidoPaterno', index: '8'},
            {name: 'prsApellidoMaterno', index: '8'},
            {name: 'prsDNI', index: '8'},
            {name: 'carDescripcion', index: '6'},
            {name: 'cloDescripcion', index: '2'},
            {name: 'scnDescripcion', index: '3'},
            {name: 'sdeNombre', index: '4'},
            {name: 'tboDescripcion', index: '9'},
            {name: 'mtcFecha', index: '0'},
            {name: 'etmDescripcion', index: '5'}
        ],
        join: {
            type: 'inner;inner;inner;inner;inner;inner;inner;inner;inner',
            on: 'm0.idUsuarioCarrera=u1.idUsuarioCarrera;m0.idCiclo=c2.idCiclo;m0.idSeccion=s3.idSeccion;m0.idSede=s4.idSede;m0.idEstadoMatricula=e5.idEstadoMatricula;u1.idCarrera=c6.idCarrera;u1.idUsuario=u7.idUsuario;u7.idPersonal=p8.idPersonal;m0.idTipoBeneficio=t9.idTipoBeneficio'
        },
        where: {
            fields: 'm0.idUsuarioCarrera;m0.idCiclo;m0.idSeccion;m0.idSede;m0.idEstadoMatricula;m0.mtcIndicador',
            logical: 'like;like;like;like;like;<>',
            values: UserProfession + '%;' + Ciclo + '%;' + Seccion + '%;' + Sede + '%;' + EstadoMatricula + '%;' + indicador
        },
        page: 1,
        rowNum: 100,
        sortName: 'm0.idMatricula',
        sortOrder: 'desc',
        title: 'MATRÍCULAS',
        edit: 'editMatricula(this.id)',
        delete: 'confirmDeleteMatricula(this.id)'
    };
    loadGrid(objGrid);
    var _btn = '';
    $('.tableMatriculas div.widget-head div.widget-icons.pull-right').html(_btn);

}

function editMatricula(_id) {
    var url = baseHTTP + 'controller/__matricula.php?action=findMatricula&_id=' + _id;
    var jsonMatricula = jqueryAjax(url, false, '');
    jsonMatricula = jQuery.parseJSON(jsonMatricula);
    $('#idMatricula').val(jsonMatricula.idMatricula);
    $('#idCarrera').val(jsonMatricula.idCarrera);
    comboboxUsuarioCarrera();
    comboboxCiclos();
    comboboxSeccion();
    $('#idUsuarioCarrera').val(jsonMatricula.idUsuarioCarrera);
    showExtraData();
    $('#idSede').val(jsonMatricula.idSede);
    $('#idCiclo').val(jsonMatricula.idCiclo);
    $('#idTurno').val(jsonMatricula.idTurno);
    comboboxSeccion();
    $('#idSeccion').val(jsonMatricula.idSeccion);
    showExtraData();
    $('#idEstadoMatricula').val(jsonMatricula.idEstadoMatricula);
    $('#idTipoBeneficio').val(jsonMatricula.idTipoBeneficio);
    gridGeneratePlanEstudio();

    $('#idCarrera').prop('disabled', true);
    $('#idUsuarioCarrera').prop('disabled', true);
    $('#idSede').prop('disabled', false);
    $('#idCiclo').prop('disabled', true);
    $('#idTurno').prop('disabled', true);
    $('#idSeccion').prop('disabled', true);
    $('#idTipoBeneficio').prop('disabled', false);
    $('#idEstadoMatricula').prop('disabled', true);

    $('#buttonShowCourses').prop('disabled', true);
    $('#buttomClearFil').prop('disabled', true);
    $('#buttomBackMant').prop('disabled', false);

    $('.tableMatriculas').fadeOut();

    url = baseHTTP + 'controller/__matriculaDetalle.php?action=searchDetalleMatricula&idMatricula=' + jsonMatricula.idMatricula;
    var jsonMatriculaDetalle = jqueryAjax(url, false, '');
    var jsonMatriculaDetalle = jQuery.parseJSON(jsonMatriculaDetalle);
    $('.tablePlanEstudiosMatricula tbody tr td input[type=checkbox][name="_gridCheckBox[]"]').each(function () {
        for (var t = 0; t < jsonMatriculaDetalle.length; t++) {
            var _inputCheck = $(this);
            if (_inputCheck.val() == base64_encoding(jsonMatriculaDetalle[t].idPlanEstudio)) {
                _inputCheck.prop('checked', true);
            }
        }
    });
}

function confirmDeleteMatricula(_id) {
    var bodyPopUp = '<div class="form-group">'
            + '' + '<label class="col-lg-2 control-label">Código</label>'
            + '<div class="col-lg-10">'
            + '<input type="text" class="notVisible" id="_inputId" name="_inputId" value="' + _id + '" >'
            + '<input type="text" class="form-control" id="_inputSecretCode" name="_inputSecretCode" placeholder="Código de Seguridad" >'
            + '</div>'
            + '</div>';
    openPopUp('Código de Seguridad', bodyPopUp, 'deleteMatricula();gridMatricula();', '', '');
}

function deleteMatricula() {
    var _id = $('#_inputId').val();
    var _code = $('#_inputSecretCode').val();
    var url = baseHTTP + 'controller/__matricula.php?action=delete&idMatricula=' + _id + '&code=' + _code;
    var result = jqueryAjax(url, true, 'modal-body');
    if (result == 'errorCode') {
        $('.modal-body').html('<div class="quest">¡El código que ingresó no es correcto!</div>');
    } else if (result == 'success') {
        $('.modal-body').html('<div class="quest">Matrícula eliminada con éxito.</div>');
    } else {
        $('.modal-body').html('<div class="quest">Ocurrió un error inesperado, inténtelo nuevamente por favor.</div>');
    }
    $('.modal-footer #cancel').remove();
    $('.modal-footer #confirm').removeClass('btn-info');
    $('.modal-footer #confirm').addClass('btn-default');
    $('.modal-footer #confirm').prop('disabled', false);
    $('.modal-footer #confirm').attr('onclick', 'closePopUp();');
}
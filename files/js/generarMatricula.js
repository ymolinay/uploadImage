$(document).ready(function () {
    comboboxUsuarioCarrera();
    comboboxCiclos();
    comboboxSeccion();
    comboboxSede();
    comboboxTurno();
    comboboxCarrera();
    comboboxBeneficio();
    showExtraData();
});

function validateMatricula() {
    if (validateFormControl('idUsuarioCarrera', 'number', true, true, 'Estudiante / Inscripción no válido.')) {
        if (validateFormControl('idCiclo', 'number', true, true, 'Seleccionar ciclo.')) {
            if (validateFormControl('idSede', 'number', true, true, 'Seleccionar sede.')) {
                if (validateFormControl('idSeccion', 'number', true, true, 'Seleccionar Seccion.')) {
                    if (numberCheckCursos() > 0) {
                        if (validateDuplicateMatricula() === 0) {
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

function comboboxBeneficio() {
    $('#idTipoBeneficio option[value!=""]').remove();
    var url = baseHTTP + 'controller/__tipoBeneficio.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonTipoBeneicio = jQuery.parseJSON(result);
    for (i = 0; i < jsonTipoBeneicio.length; i++) {
        $('#idTipoBeneficio').append(new Option(jsonTipoBeneicio[i].tboDescripcion + ' - (' + jsonTipoBeneicio[i].tboDescuentoPorcentaje + '%)', jsonTipoBeneicio[i].idTipoBeneficio));
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
    if (seccion == false) {
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

function comboboxCiclos_delete() {
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
        $("#buttonShowCourses").addClass("disabled");
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
            $("#buttonShowCourses").addClass("disabled");
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
            $("#buttonShowCourses").removeClass("disabled");
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


/*function gridGeneratePlanEstudio() {
 if (validateShowCursos() === true) {
 var UserProfession = $('#idUsuarioCarrera').val();
 UserProfession = (UserProfession === undefined) ? '' : UserProfession;
 var Ciclo = $('#idCiclo').val();
 Ciclo = (Ciclo === undefined) ? '' : Ciclo;
 
 var objGrid = {
 div: 'tablePlanEstudiosMatricula',
 url: baseHTTP + 'controller/__grid.php?action=loadGrid',
 table: 'usuariocarrera;usuario;personal;tipobeneficio;carrera;planestudio;curso;ciclo',
 colNames: ['', 'CICLO', 'CURSO'],
 colModel: [
 {name: 'idPlanEstudio', index: '5', align: 'left'},
 {name: 'cloDescripcion', index: '7'},
 {name: 'crsNombre', index: '6'}
 ],
 join: {
 type: 'inner;inner;inner;inner;inner;inner;inner',
 on: 'u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idTipoBeneficio=t3.idTipoBeneficio;u0.idCarrera=c4.idCarrera;c4.idCarrera=p5.idCarrera;p5.idCurso=c6.idCurso;p5.idCiclo=c7.idCiclo'
 },
 where: {
 fields: 'u0.idUsuarioCarrera;c7.idCiclo',
 logical: '=;=',
 values: UserProfession + ';' + Ciclo
 },
 page: 1,
 rowNum: 100,
 sortName: 'c7.idCiclo,p5.idPlanEstudio',
 sortOrder: 'asc',
 title: 'CURSOS PENDIENTES',
 checkbox: {
 prefix: 'crs',
 //accion: 'alert(this.id);'
 accion: ''
 }
 };
 loadGrid(objGrid);
 var _btn = '<button class="btn btn-sm btn-info" type="button" onclick="confirmSave(\'bWF0cmljdWxh\',\'Zm9ybU1hdHJpY3VsYQ==\',\'disbledShowButton();\',\'\')">Generar Matrícula</button>';
 $('.tablePlanEstudiosMatricula div.widget-head div.widget-icons.pull-right').html(_btn);
 }º
 }*/

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
            colNames: ['<center><input type="checkbox" onclick="selectAllCourses();" id="selectAll"></center>', 'CICLO', 'CURSO'],
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
        var _btn = '<button class="btn btn-sm btn-info" type="button" onclick="confirmSave(\'bWF0cmljdWxh\',\'Zm9ybU1hdHJpY3VsYQ==\',\'disbledShowButton();\',\'\')">Generar Matrícula</button>';
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

function disbledShowButton() {
    $('#buttonShowCourses').addClass('disabled');
    $('.tablePlanEstudiosMatricula').empty();
    showExtraData();
}

function validateDuplicateMatricula() {
    var _idCiclo = $('#idCiclo').val();
    var _idUsuarioCarrera = $('#idUsuarioCarrera').val();
    var url = baseHTTP + 'controller/__matricula.php?action=searchDuplicate&_idCiclo=' + _idCiclo + '&_idUsuarioCarrera=' + _idUsuarioCarrera;
    var duplicate = jqueryAjax(url, false, '');
    duplicate = jQuery.parseJSON(duplicate);
    openPopUp('Registro duplicado', 'Este alumno ya tiene una matrícula activa para el ciclo seleccionado.', '', '', '');
    return duplicate.count;
}

function selectAllCourses() {
    var chk = $('#selectAll').prop('checked');
    var _chkAll = false;
    if (chk) {
        _chkAll = true;
    }
    $('.tablePlanEstudiosMatricula tbody tr td input[type=checkbox][name="_gridCheckBox[]"]').each(function () {
        $(this).prop('checked', _chkAll);
    });
}
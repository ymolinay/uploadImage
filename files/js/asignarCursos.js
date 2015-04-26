$(document).ready(function () {
    comboboxCarrera();
    comboboxCiclos();
    comboboxTurno();
    comboboxSeccion();
    comboboxDocente();
    comboboxCursosPlanEstudio();
    gridDocentesCursos();
});

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

function comboboxTurno() {
    $('#idTurno option[value!=""]').remove();
    var url = baseHTTP + 'controller/__turno.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonTurno = jQuery.parseJSON(result);
    for (i = 0; i < jsonTurno.length; i++) {
        $('#idTurno').append(new Option(jsonTurno[i].troDescripcion, jsonTurno[i].idTurno));
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

function comboboxDocente() {
    $('#idDocente option[value!=""]').remove();
    var url = baseHTTP + 'controller/__personal.php?action=combobox2&perfil=4';
    var result = jqueryAjax(url, false, '');
    var personal = jQuery.parseJSON(result);
    for (i = 0; i < personal.length; i++) {
        $('#idDocente').append(new Option(personal[i].prsNombre + ' ' + personal[i].prsApellidoPaterno + ' ' + personal[i].prsApellidoMaterno + ' - ' + personal[i].prsDNI, personal[i].idUsuario));
    }
}

function comboboxCursosPlanEstudio() {
    var idCarrera = $('#idCarrera').val();
    var idCiclo = $('#idCiclo').val();
    $('#idPlanEstudioCursos option[value!=""]').remove();
    var url = baseHTTP + 'controller/__planEstudio.php?action=comboboxAsignarCursos&_idCarrera=' + idCarrera + '&_idCiclo=' + idCiclo;
    var result = jqueryAjax(url, false, '');
    var planEstudioCursos = jQuery.parseJSON(result);
    for (i = 0; i < planEstudioCursos.length; i++) {
        $('#idPlanEstudioCursos').append(new Option(planEstudioCursos[i].crsNombre, planEstudioCursos[i].idPlanEstudio));
    }
}

function gridDocentesCursos() {
    //if (validateShowCursos() === true) {

    var idSeccion = $('#idSeccion').val();
    var idDocente = $('#idDocente').val();
    var idPlanEstudioCursos = $('#idPlanEstudioCursos').val();
    var idCarrera = $('#idCarrera').val();
    var idCiclo = $('#idCiclo').val();
    var idTurno = $('#idTurno').val();
    var indicador = '0';
    idSeccion = (idSeccion === undefined) ? '' : idSeccion;
    idDocente = (idDocente === undefined) ? '' : idDocente;
    idPlanEstudioCursos = (idPlanEstudioCursos === undefined) ? '' : idPlanEstudioCursos;
    idCarrera = (idCarrera === undefined) ? '' : idCarrera;
    idCiclo = (idCiclo === undefined) ? '' : idCiclo;
    idTurno = (idTurno === undefined) ? '' : idTurno;
    var objGrid = {
        div: 'tableDocentesCursos',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'docenteseccioncurso;usuario;personal;seccion;carrera;ciclo;turno;planestudio;curso;carrera',
        colNames: ['', 'NOMBRES', 'APE. PATERNO', 'APE. MATERNO', 'CARRERA', 'CURSO', 'SECCIÓN', 'CICLO', 'TURNO'],
        colModel: [
            {name: 'idDocenteSeccionCurso', index: '0', align: 'left'},
            {name: 'prsNombre', index: '2'},
            {name: 'prsApellidoPaterno', index: '2'},
            {name: 'prsApellidoMaterno', index: '2'},
            {name: 'carDescripcion', index: '4'},
            {name: 'crsNombre', index: '8'},
            {name: 'scnDescripcion', index: '3'},
            {name: 'cloDescripcion', index: '5'},
            {name: 'troDescripcion', index: '6'}
        ],
        join: {
            type: 'inner;inner;inner;inner;inner;inner;inner;inner;inner',
            on: 'd0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;d0.idSeccion=s3.idSeccion;s3.idCarrera=c4.idCarrera;s3.idCiclo=c5.idCiclo;s3.idTurno=t6.idTurno;d0.idPlanEstudio=p7.idPlanEstudio;p7.idCurso=c8.idCurso;p7.idCarrera=c9.idCarrera'
        },
        where: {
            fields: 'd0.idSeccion;d0.idUsuario;d0.idPlanEstudio;s3.idCarrera;s3.idCiclo;s3.idTurno;d0.dscIndicador',
            logical: 'like;like;like;like;like;like;<>',
            values: idSeccion + '%;' + idDocente + '%;' + idPlanEstudioCursos + '%;' + idCarrera + '%;' + idCiclo + '%;' + idTurno + '%;' + indicador
        },
        page: 1,
        rowNum: 10,
        sortName: 'CONCAT(p2.prsApellidoPaterno,p2.prsApellidoMaterno,p2.prsNombre),c4.carDescripcion,c8.crsNombre,s3.scnDescripcion,c5.cloDescripcion',
        sortOrder: 'asc',
        title: 'CURSOS ASIGNADOS',
        edit: ''
    };
    loadGrid(objGrid);
    var _btn = '';
    $('.tableDocentesCursos div.widget-head div.widget-icons.pull-right').html(_btn);
}

function validateDocenteSeccionCurso() {
    if (validateFormControl('idSeccion', 'number', true, true, 'Seleccionar Sección.')) {
        if (validateFormControl('idDocente', 'number', true, true, 'Seleccionar Docente.')) {
            if (validateFormControl('idPlanEstudioCursos', 'number', true, true, 'Seleccionar Curso.')) {
                return true;
            }
        }
    }
}

function clearFormAsignarCursos(){
    clearForm('Zm9ybUFzaWduYXJDdXJzb3M=');
}
$(document).ready(function () {
    comboboxCarrera();
    comboboxUsuarioCarrera();
    comboboxMatricula();
//    comboboxCiclos();
//    comboboxSeccion();

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

function comboboxMatricula() {
    var idUsuarioCarrera = $('#idUsuarioCarrera').val();
    $('#idMatricula option[value!=""]').remove();
    var url = baseHTTP + 'controller/__matricula.php?action=combobox&idUsuarioCarrera=' + idUsuarioCarrera;
    var result = jqueryAjax(url, false, '');
    var jsonMatricula = jQuery.parseJSON(result);
    for (i = 0; i < jsonMatricula.length; i++) {
        var opt = new Option(jsonMatricula[i].mtcFecha, jsonMatricula[i].idMatricula);
        opt.setAttribute("data-ciclo", jsonMatricula[i].cloDescripcion);
        opt.setAttribute("data-seccion", jsonMatricula[i].scnDescripcion);
        opt.setAttribute("data-turno", jsonMatricula[i].troDescripcion);
        opt.setAttribute("data-sede", jsonMatricula[i].sdeNombre);
        opt.setAttribute("data-estado", jsonMatricula[i].etmDescripcion);
        $('#idMatricula').append(opt);
    }
}

function showExtraData() {
    var student = $('#idUsuarioCarrera');
    var matricula = $('#idMatricula');
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
    if (matricula.val() == '') {
        $(".matriculaNFO").removeClass("label-danger");
        $(".matriculaNFO").removeClass("label-success");
        $(".matriculaNFO").addClass("label-info");
        $(".matriculaNFO").html("No se seleccionó Matrícula.");
    } else {
        var _ciclo = matricula.find(':selected').data('ciclo');
        var _seccion = matricula.find(':selected').data('seccion');
        var _turno = matricula.find(':selected').data('turno');
        var _sede = matricula.find(':selected').data('sede');
        var _estado = matricula.find(':selected').data('estado');
        /***************/
        $("#mensajeCiclo").addClass("label-info");
        $("#mensajeCiclo").removeClass("label-success");
        $("#mensajeCiclo").removeClass("label-danger");
        $("#mensajeCiclo").html("Ciclo: " + _ciclo);
        /***************/
        $("#mensajeSeccion").addClass("label-info");
        $("#mensajeSeccion").removeClass("label-success");
        $("#mensajeSeccion").removeClass("label-danger");
        $("#mensajeSeccion").html("Sección: " + _seccion);
        /***************/
        $("#mensajeTurno").addClass("label-info");
        $("#mensajeTurno").removeClass("label-success");
        $("#mensajeTurno").removeClass("label-danger");
        $("#mensajeTurno").html("Turno: " + _turno);
        /***************/
        $("#mensajeSede").addClass("label-info");
        $("#mensajeSede").removeClass("label-success");
        $("#mensajeSede").removeClass("label-danger");
        $("#mensajeSede").html("Sede: " + _sede);
        /***************/
        $("#mensajeEstado").addClass("label-info");
        $("#mensajeEstado").removeClass("label-success");
        $("#mensajeEstado").removeClass("label-danger");
        $("#mensajeEstado").html("Estado: " + _estado);
    }
}

function gridRatings() {
    var idCarrera = $('#idCarrera').val();
    var idUsuaarioCarrera = $('#idUsuarioCarrera').val();
    var idMatricula = $('#idMatricula').val();
    if (validateShowRatings()) {
        var objGrid = {
            div: 'tableMyRatings',
            url: baseHTTP + 'controller/__grid.php?action=loadGrid',
            table: 'matricula;matriculadetalle;planestudio;curso;matriculanotas',
            colNames: ['', 'CURSO', 'Ev1', 'Ev2', 'Ev3', 'Ev4', 'PromPract', 'ExParcial', 'Promedio', 'Ev1', 'Ev2', 'Ev3', 'Ev4', 'PromPract', 'Trabajo', 'ExFinal', 'Promedio', 'Susti', 'PromedioFinal'],
            colNamesStyles: ['', 'CURSO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            colModel: [
                {name: 'idMatriculaNotas', index: '4', align: 'center'},
                {name: 'crsNombre', index: '3', align: 'left', class: 'cursoRatingName'},
                {name: 'mntU1Ev1', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU1Ev2', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU1Ev3', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU1Ev4', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU1PromPract', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU1ExParcial', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU1Promedio', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2Ev1', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2Ev2', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2Ev3', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2Ev4', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2PromPract', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2Trabajo', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2ExFinal', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntU2Promedio', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntSusti', index: '4', align: 'center', class: 'inputRatingStudent'},
                {name: 'mntPromedioFinal', index: '4', align: 'center', class: 'inputRatingStudent'},
            ],
            join: {
                type: 'inner;inner;inner;inner',
                on: 'm0.idMatricula=m1.idMatricula;m1.idPlanEstudio=p2.idPlanEstudio;p2.idCurso=c3.idCurso;m1.idMatriculaDetalle=m4.idMatriculaDetalle'
            },
            where: {
                fields: 'm0.idMatricula;m0.idUsuarioCarrera',
                logical: 'like;like',
                values: '%' + idMatricula + '%;%' + idUsuaarioCarrera
            },
            page: 1,
            rowNum: 10,
            sortName: 'c3.crsNombre',
            sortOrder: 'asc',
            title: 'NOTAS'
        };
        loadGrid(objGrid);
        var _btn = '';
        $('.tableMyRatings div.widget-head div.widget-icons.pull-right').html(_btn);
        validaRatings();
    }
}

function validateShowRatings() {
    if (validateFormControl('idCarrera', 'number', true, true, 'Seleccionar una Carrera')) {
        if (validateFormControl('idUsuarioCarrera', 'number', true, true, 'Seleccionar una Carrera')) {
            if (validateFormControl('idMatricula', 'number', true, true, 'Seleccionar una Carrera')) {
                return true;
            }
        }
    }
}

function validaRatings() {
    $.each($('.tableMyRatings .table-responsive .inputRatingStudent'), function () {
        var _ths = $(this);
        var rating = $.trim(_ths.html());
        if (rating<=10){
            _ths.css({'color':'rgb(255,0,0)'});
        } else {
            _ths.css({'color':'rgb(0,0,0)'});
        }
    });
}
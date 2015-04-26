$(document).ready(function () {
    $('#insInicio').datetimepicker({pickTime: false});
    $('#insFin').datetimepicker({pickTime: false});
    comboboxTurno();
    comboboxCarrera();
    comboboxCiclos();
    gridSeccion();
});

function comboboxCarrera() {
    $('#inputCarrera option[value!=""]').remove();
    var url = baseHTTP + 'controller/__carrera.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonCarrera = jQuery.parseJSON(result);
    for (i = 0; i < jsonCarrera.length; i++) {
        var opt = new Option(jsonCarrera[i].carDescripcion, jsonCarrera[i].idCarrera);
        opt.setAttribute("data-maxCiclo", jsonCarrera[i].carPeriodos);
        $('#inputCarrera').append(opt);
    }
}

function comboboxTurno() {
    $('#inputTurno option[value!=""]').remove();
    var url = baseHTTP + 'controller/__turno.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonTurno = jQuery.parseJSON(result);
    for (i = 0; i < jsonTurno.length; i++) {
        $('#inputTurno').append(new Option(jsonTurno[i].troDescripcion, jsonTurno[i].idTurno));
    }
}

function comboboxCiclos() {
    var carrera = $('#inputCarrera');
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

function gridSeccion() {
    var descripcion = $('#inputDescripcion').val();
    descripcion = (descripcion === undefined) ? '' : descripcion;
    var turno = $('#inputTurno').val();
    turno = (turno === undefined) ? '' : turno;
    var carrera = $('#inputCarrera').val();
    carrera = (carrera === undefined) ? '' : carrera;
    var ciclo = $('#idCiclo').val();
    ciclo = (ciclo === undefined) ? '' : ciclo;

    var objGrid = {
        div: 'tableSeccion',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'seccion;carrera;turno;ciclo',
        colNames: ['', 'SECCIÓN', 'CANT. MÁXIMA', 'INICIO', 'FIN', 'CICLO', 'TURNO', 'CARRERA'],
        colModel: [
            {name: 'idSeccion', index: '0'},
            {name: 'scnDescripcion', index: '0'},
            {name: 'scnCantMaxima', index: '0'},
            {name: 'scnInicio', index: '0'},
            {name: 'scnFin', index: '0'},
            {name: 'cloDescripcion', index: '3'},
            {name: 'troDescripcion', index: '2'},
            {name: 'carDescripcion', index: '1'}
        ],
        join: {
            type: 'inner;inner;inner',
            on: 's0.idCarrera=c1.idCarrera;s0.idTurno=t2.idTurno;s0.idCiclo=c3.idCiclo'
        },
        where: {
            fields: 's0.scnDescripcion;s0.idTurno;s0.idCarrera;s0.idCiclo;s0.scnIndicador',
            logical: 'like;like;like;like;=',
            values: descripcion + '%;' + turno + '%;' + carrera + '%;' + ciclo + '%;1'
        },
        page: 1,
        rowNum: 10,
        sortName: 's0.idSeccion',
        sortOrder: 'asc',
        title: 'SECCIONES',
        edit: 'editSeccion(this.id)'
    };
    loadGrid(objGrid);
    var _btn = '';
    $('.tableSeccion div.widget-head div.widget-icons.pull-right').html(_btn);
}

function gridGeneratePlanEstudio() {
    if (validateMatricula() === true) {
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
            sortName: 'c7.idCiclo',
            sortOrder: 'asc',
            title: 'CURSOS PENDIENTES',
            checkbox: {
                prefix: 'crs',
                //accion: 'alert(this.id);'
                accion: ''
            }
        };
        loadGrid(objGrid);
        var _btn = '<button class="btn btn-sm btn-info" type="button" onclick="confirmSave(\'bWF0cmljdWxh\',\'Zm9ybU1hdHJpY3VsYQ==\',\'printMatricula();\',\'\')">Generar Matrícula</button>';
        $('.tablePlanEstudiosMatricula div.widget-head div.widget-icons.pull-right').html(_btn);
    }
}

function validateSeccion() {
    if (validateFormControl('inputDescripcion', 'alphanumeric', true, true, 'Sección no válida. Sólo número y letras, mínimo 4 caracteres')) {
        if (validateFormControl('inputCantMaxima', 'number', true, true, 'Cantidad no válida. Sólo números')) {
            if (validateFormControl('inputInicio', 'date', true, true, 'Fecha no válida. Usar formato DD-MM-AAAA')) {
                if (validateFormControl('inputFin', 'date', true, true, 'Fecha no válida. Usar formato DD-MM-AAAA')) {
                    if (validateFormControl('inputTurno', 'number', true, true, 'Turno no válido')) {
                        if (validateFormControl('inputCarrera', 'number', true, true, 'Carrera no válida')) {
                            return true;
                        }
                    }
                }
            }
        }
    }
}

function editSeccion(_id) {
    var url = baseHTTP + 'controller/__seccion.php?action=searchSeccion&_id=' + _id;
    var jsonSeccion = jqueryAjax(url, false, '');
    jsonSeccion = jQuery.parseJSON(jsonSeccion);
    $('#inputIdSeccion').val(jsonSeccion.idSeccion);
    $('#inputDescripcion').val(jsonSeccion.scnDescripcion);
    $('#inputCantMaxima').val(jsonSeccion.scnCantMaxima);
    var fInicio = jsonSeccion.scnInicio.split('-');
    $('#insInicio').data('datetimepicker').setLocalDate(new Date(fInicio[0], fInicio[1] - 1, fInicio[2]));

    var fFin = jsonSeccion.scnFin.split('-');
    $('#insFin').data('datetimepicker').setLocalDate(new Date(fFin[0], fFin[1] - 1, fFin[2]));

    $('#inputTurno').val(jsonSeccion.idTurno);
    $('#inputCarrera').val(jsonSeccion.idCarrera);
    comboboxCiclos();
    $('#idCiclo').val(jsonSeccion.idCiclo);
}
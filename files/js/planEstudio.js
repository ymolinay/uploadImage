$(document).ready(function () {
    comboboxCarrera();
    comboboxCiclo();
    comboboxCurso();
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

function comboboxCiclo() {
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

function comboboxCurso() {
    $('#idCurso option[value!=""]').remove();
    var url = baseHTTP + 'controller/__curso.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonCurso = jQuery.parseJSON(result);
    for (i = 0; i < jsonCurso.length; i++) {
        $('#idCurso').append(new Option(jsonCurso[i].crsNombre, jsonCurso[i].idCurso));
    }
}

function validatePlanEstudio() {
    if (validateFormControl('idCarrera', 'number', true, true, 'Seleccionar una carrera')) {
        if (validateFormControl('idCiclo', 'number', true, true, 'Seleccionar una ciclo')) {
            if (validateFormControl('idCurso', 'number', true, true, 'Seleccionar una curso')) {
                if (validateFormControl('inputMinRating', 'decimal', true, true, 'Ingrese una nota mínima de aprobación')) {
                    return true;
                }
            }
        }
    }
}

function gridPlanEstudio() {
    var Carrera = $('#idCarrera').val();
    var Ciclo = $('#idCiclo').val();
    Ciclo = (Ciclo === undefined) ? '' : Ciclo;
    var Curso = $('#idCurso').val();
    Curso = (Curso === undefined) ? '' : Curso;
    
    if (!empty(Carrera)) {
        var objGrid = {
            div: 'tablePlanEstudios',
            url: baseHTTP + 'controller/__grid.php?action=loadGrid',
            table: 'planestudio;carrera;ciclo;curso',
            colNames: ['', 'CARRERA', 'CICLO', 'CURSO', 'NOTA MÍNIMA'],
            colModel: [
                {name: 'idPlanEstudio', index: '0', align: 'left'},
                {name: 'carDescripcion', index: '1'},
                {name: 'cloDescripcion', index: '2'},
                {name: 'crsNombre', index: '3'},
                {name: 'pldNotaMinima', index: '0'}
            ],
            join: {
                type: 'inner;inner;inner',
                on: 'p0.idCarrera=c1.idCarrera;p0.idCiclo=c2.idCiclo;p0.idCurso=c3.idCurso'
            },
            where: {
                fields: 'p0.idCarrera;p0.idCiclo;p0.idCurso;p0.pldIndicador',
                logical: '=;like;like;=',
                values: Carrera + ';' + Ciclo + '%;' + Curso + '%;1'
            },
            page: 1,
            rowNum: 150,
            sortName: 'c2.idCiclo,c3.crsNombre',
            sortOrder: 'asc',
            title: 'PLAN ESTUDIO',
            edit: 'editPlanEstudio(this.id)'
        };
        loadGrid(objGrid);
        $('.tablePlanEstudios div.widget-head div.widget-icons.pull-right button.btn.btn-sm.btn-info').remove();
    } else {
        openPopUp('Seleccionar Carrera', 'Debe seleccionar un carrera antes de listar el plan de estudio.', '', '', '');
    }
}

function editPlanEstudio(_id) {
    var url = baseHTTP + 'controller/__planEstudio.php?action=find&idPlan=' + _id;
    var result = jqueryAjax(url, false, '');
    var plan = jQuery.parseJSON(result);
    $('#inputIdPlan').val(plan.idPlanEstudio);
    $('#idCarrera').val(plan.idCarrera);
    $('#idCiclo').val(plan.idCiclo);
    $('#idCurso').val(plan.idCurso);
    $('#inputMinRating').val(plan.pldNotaMinima);
}

function cleanDivPlanEstudio(){
    $('.tablePlanEstudios').empty();
}
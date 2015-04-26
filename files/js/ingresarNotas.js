$(document).ready(function () {
    clearFormNotas();
    comboboxTurno();
});

function comboboxDocente() {
    $('#idDocente option[value!=""]').remove();
    var url = baseHTTP + 'controller/__docenteSeccionCurso.php?action=comboboxDocente';
    var result = jqueryAjax(url, false, '');
    var docente = jQuery.parseJSON(result);
    for (i = 0; i < docente.length; i++) {
        var opt = new Option(docente[i].prsNombre + ' ' + docente[i].prsApellidoPaterno + ' ' + docente[i].prsApellidoMaterno + ' - ' + docente[i].prsDNI, docente[i].idDocenteSeccionCurso);
        opt.setAttribute("data-usuario", docente[i].idUsuario);
        $('#idDocente').append(opt);
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

function comboboxCarreraNt() {
    var docente = $('#idDocente');
    $('#idCarrera option[value!=""]').remove();
    if (docente.val() != '') {
        var _idDocente = docente.val();
        var _idUsuario = docente.find(':selected').data('usuario');
        var url = baseHTTP + 'controller/__docenteSeccionCurso.php?action=comboboxCarrera&_idDoc=' + _idDocente + '&_idUsu=' + _idUsuario;
        var result = jqueryAjax(url, false, '');
        var docente = jQuery.parseJSON(result);
        for (i = 0; i < docente.length; i++) {
            $('#idCarrera').append(new Option(docente[i].carDescripcion, docente[i].idCarrera));
        }
    }
}

function comboboxCarreraCicloNt() {
    var docente = $('#idDocente');
    var carrera = $('#idCarrera');
    $('#idCiclo option[value!=""]').remove();
    if (docente.val() != '' && carrera.val() != '') {
        var _idDocente = docente.val();
        var _idCarrera = carrera.val();
        var _idUsuario = docente.find(':selected').data('usuario');
        var url = baseHTTP + 'controller/__docenteSeccionCurso.php?action=comboboxCiclo&_idDoc=' + _idDocente + '&_idCar=' + _idCarrera + '&_idUsu=' + _idUsuario;
        var result = jqueryAjax(url, false, '');
        var ciclo = jQuery.parseJSON(result);
        for (i = 0; i < ciclo.length; i++) {
            $('#idCiclo').append(new Option(ciclo[i].cloDescripcion, ciclo[i].idCiclo));
        }
    }
}

function comboboxCarreraCicloCursoNt() {
    var docente = $('#idDocente');
    var carrera = $('#idCarrera');
    var ciclo = $('#idCiclo');
    $('#idPlanEstudioCursos option[value!=""]').remove();
    if (docente.val() != '' && carrera.val() != '' && ciclo.val() != '') {
        var _idDocente = docente.val();
        var _idCarrera = carrera.val();
        var _idCiclo = ciclo.val();
        var _idUsuario = docente.find(':selected').data('usuario');
        var url = baseHTTP + 'controller/__docenteSeccionCurso.php?action=comboboxCursos&_idDoc=' + _idDocente + '&_idCar=' + _idCarrera + '&_idUsu=' + _idUsuario + '&_idCil=' + _idCiclo;
        var result = jqueryAjax(url, false, '');
        var planEstudio = jQuery.parseJSON(result);
        for (i = 0; i < planEstudio.length; i++) {
            $('#idPlanEstudioCursos').append(new Option(planEstudio[i].crsNombre, planEstudio[i].idPlanEstudio));
        }
    }
}

function comboboxCarreraCicloCursoSeccionNt() {
    var docente = $('#idDocente');
    var carrera = $('#idCarrera');
    var ciclo = $('#idCiclo');
    var planEstudioCurso = $('#idPlanEstudioCursos');
    var turno = $('#idTurno');
    $('#idSeccion option[value!=""]').remove();
    $('#seccionFound').removeClass('label-success');
    $('#seccionFound').addClass('label-default');
    $('#seccionFound').html('No hay secciones.');
    if (docente.val() != '' && carrera.val() != '' && ciclo.val() != '' && planEstudioCurso.val() != '' && turno.val() != '') {
        var _idDocente = docente.val();
        var _idCarrera = carrera.val();
        var _idCiclo = ciclo.val();
        var _idPlanEstudio = planEstudioCurso.val();
        var _idTurno = turno.val();
        var _idUsuario = docente.find(':selected').data('usuario');
        var url = baseHTTP + 'controller/__docenteSeccionCurso.php?action=comboboxSecciones&_idDoc=' + _idDocente + '&_idCar=' + _idCarrera + '&_idUsu=' + _idUsuario + '&_idCil=' + _idCiclo + '&_idTur=' + _idTurno + '&_idPla=' + _idPlanEstudio;
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
}

function clearFormNotas() {
    comboboxDocente();
    comboboxCarreraNt();
    comboboxCarreraCicloNt();
    comboboxCarreraCicloCursoNt();
    comboboxCarreraCicloCursoSeccionNt();
}

function SearchRatingsStudentsOfSeccionPlanEstudio() {
    var idCarrera = $('#idCarrera').val();
    var idCiclo = $('#idCiclo').val();
    var idPlanEstudio = $('#idPlanEstudioCursos').val();
    var idTurno = $('#idTurno').val();
    var idSeccion = $('#idSeccion').val();
    var url = baseHTTP + 'controller/__matriculaNotas.php?action=SearchRatingsStudentsOfSeccionPlanEstudio&_idCar=' + idCarrera + '&_idCic=' + idCiclo + '&_idPla=' + idPlanEstudio + '&_idTur=' + idTurno + '&_idSec=' + idSeccion;
    var ratings = jqueryAjax(url, false, '');
    if (ratings != 'false') {
        var jsonRatings = jQuery.parseJSON(ratings);

        /*Validar Fecha con la fecha de sección*/
        var strDate = myDate();
        var dateParts = strDate.split("-");
        var dateValidCurrent = new Date(dateParts[0], (dateParts[1] - 1), dateParts[2]);
        var strDateStart = jsonRatings.scnInicio;
        var datePartsStart = strDateStart.split("-");
        var dateValidStart = new Date(datePartsStart[0], (datePartsStart[1] - 1), datePartsStart[2]);
        var strDateEnd = jsonRatings.scnFin;
        var datePartsEnd = strDateEnd.split("-");
        var dateValidEnd = new Date(datePartsEnd[0], (datePartsEnd[1] - 1), datePartsEnd[2]);

        var editRatings = '';
        var messageAlertRating = '';
        var rangeSeccion = true;

        if (!(dateValidCurrent >= dateValidStart && dateValidCurrent <= dateValidEnd)) {
            var messaggeShowRating = '';
            if(dateValidCurrent <= dateValidStart){
                messaggeShowRating = '<strong>Fuera de Fecha!</strong> las notas no pueden ser editadas mientras las clases no hayan iniciado.';
            } else if(dateValidCurrent >= dateValidEnd){
                messaggeShowRating = '<strong>Fuera de Fecha!</strong> las notas no pueden ser editadas luego de que las clases hayan terminado.';
            }
            
            editRatings = ' disabled="disabled" ';
            messageAlertRating = '<div class="col-xs-12">'
                    + '<div role="alert" class="alert alert-danger" style="margin-bottom: 10px;padding: 5px 15px;">'
                    + messaggeShowRating
                    + '</div>'
                    + '</div>';
            rangeSeccion = false;
        }
        /*Validar Fecha con la fecha de sección - Fin*/


        var tableRatings = '<div class="widget-head">'
                + '<div class="pull-left">REGISTRO DE NOTAS</div>'
                + '<div class="widget-icons pull-right">'
                + '<button id="cleanAllRating" name="cleanAllRating" type="button" class="btn btn-sm btn-info">Limpiar Todo</button>'
                + '&nbsp;&nbsp;&nbsp;<button id="sendRating" name="sendRating" type="button" class="btn btn-sm btn-info">Guardar Notas</button>'
                + '</div>'
                + '<div class="clearfix"></div>'
                + '</div>'

                + '<div class="widget-content" style="display: block;">'
                + '<div class="padd">'
                /*Datos de la Seccion*/
                + '<div class="col-sm-6">'
                + '<div class="form-group INFormControl">'
                + '<label class="col-lg-1 control-label">Docente</label>'
                + '<div class="col-lg-7">'
                + '<input type="text" class="notVisible" name="idINDocente" id="idINDocente" value="' + jsonRatings.idPDocente + '">'
                + '<input type="text" class="form-control" value="' + jsonRatings.DocenteApellidoPaterno + ' ' + jsonRatings.DocenteApellidoMaterno + ', ' + jsonRatings.DocenteNombre + '" readonly="readonly">'
                + '</div>'
                + '</div>'

                + '<div class="form-group INFormControl">'
                + '<label class="col-lg-1 control-label">Carrea</label>'
                + '<div class="col-lg-7">'
                + '<input type="text" class="notVisible" name="idINCarrera" id="idINCarrera" value="' + jsonRatings.idCarrera + '">'
                + '<input type="text" class="form-control" value="' + jsonRatings.Carrera + '" readonly="readonly">'
                + '</div>'
                + '</div>'

                + '<div class="form-group INFormControl">'
                + '<label class="col-lg-1 control-label">Cursos</label>'
                + '<div class="col-lg-7">'
                + '<input type="text" class="notVisible" name="idINPlanEstudio" id="idINPlanEstudio" value="' + jsonRatings.idPlanEstudio + '">'
                + '<input type="text" class="form-control" value="' + jsonRatings.Curso + '" readonly="readonly">'
                + '</div>'
                + '</div>'
                + '</div>'

                + '<div class="col-sm-6">'
                + '<div class="form-group INFormControl">'
                + '<label class="col-lg-1 control-label">Ciclo</label>'
                + '<div class="col-lg-7">'
                + '<input type="text" class="notVisible" name="idINCiclo" id="idINCiclo" value="' + jsonRatings.idCiclo + '">'
                + '<input type="text" class="form-control" value="' + jsonRatings.Ciclo + '" readonly="readonly">'
                + '</div>'
                + '</div>'

                + '<div class="form-group INFormControl">'
                + '<label class="col-lg-1 control-label">Turno</label>'
                + '<div class="col-lg-7">'
                + '<input type="text" class="notVisible" name="idINTurno" id="idINTurno" value="' + jsonRatings.idTurno + '">'
                + '<input type="text" class="form-control" value="' + jsonRatings.Turno + '" readonly="readonly">'
                + '</div>'
                + '</div>'

                + '<div class="form-group INFormControl">'
                + '<label class="col-lg-1 control-label">Sección</label>'
                + '<div class="col-lg-7">'
                + '<input type="text" class="notVisible" name="idINSeccion" id="idINSeccion" value="' + jsonRatings.idSeccion + '">'
                + '<input type="text" class="form-control" value="' + jsonRatings.Seccion + '" readonly="readonly">'
                + '</div>'
                + '</div>'
                + '</div>'

                + messageAlertRating

                + '<div class="clearfix"></div>'
                /*Datos de la Seccion - Fin*/
                + '<div class="page-tables">'
                + '<div class="table-responsive" style="overflow-x: auto;">'
                + '';

        var tableHead = ['Estudiante', 'Ev1', 'Ev2', 'Ev3', 'Ev4', 'PromPract', 'ExParcial', 'Promedio', 'Ev1', 'Ev2', 'Ev3', 'Ev4', 'PromPract', 'Trabajo', 'ExFinal', 'Promedio', 'Susti', 'PromedioFinal'];
        tableRatings += '<table width="100%" cellspacing="0" cellpadding="0" border="0" style="width: 100%;" aria-describedby="data-table_info" class="dataTable" id="data-table">'
                + '<thead>'
                + '<tr role="row">';
        /*Cabecera de Notas*/
        tableRatings += '<th style="width: auto; background-color:#f5f5f5; padding: 0 95px;" aria-sort="ascending" colspan="1" rowspan="1" aria-controls="data-table" tabindex="0" role="columnheader" class="none"><strong>' + tableHead[0] + '</strong></th>';
        for (var i = 1; i < tableHead.length; i++) {
            tableRatings += '<th style="width: auto; background-color:#f5f5f5" aria-sort="ascending" colspan="1" rowspan="1" aria-controls="data-table" tabindex="0" role="columnheader" class="none"><strong>' + tableHead[i] + '</strong></th>';
        }
        tableRatings += '</tr>'
                + '</thead>';
        /*Cabecera de Notas - Fin*/

        /*Notas de Estudiante*/
        tableRatings += '<tbody aria-relevant="all" aria-live="polite" role="alert">';
        for (var j = 0; j < jsonRatings.rows.length; j++) {
            tableRatings += '<tr onclick="colorSelectRow(this)" onblur="colorSelectRow(this)">'
                    + '<td>'
                    + '<input name="_idMatriculaNotas[]" id="_idMatriculaNotas[]" type="text" value="' + jsonRatings.rows[j].idMatriculaNotas + '" class="notVisible" />'
                    + '<input name="_idMatriculaDetalle[]" id="_idMatriculaDetalle[]" type="text" value="' + jsonRatings.rows[j].idMatriculaDetalle + '" class="notVisible" />'
                    + jsonRatings.rows[j].prsApellidoPaterno + ' ' + jsonRatings.rows[j].prsApellidoMaterno + ', ' + jsonRatings.rows[j].prsNombre + ' <span style="float: right;">[' + jsonRatings.rows[j].prsDNI + ']</span>'
                    + '</td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1Ev1[]" id="_mntU1Ev1-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1Ev1 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1Ev2[]" id="_mntU1Ev2-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1Ev2 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1Ev3[]" id="_mntU1Ev3-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1Ev3 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1Ev4[]" id="_mntU1Ev4-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1Ev4 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1PromPract[]" id="_mntU1PromPract-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1PromPract + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" readonly="readonly" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1ExParcial[]" id="_mntU1ExParcial-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1ExParcial + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU1Promedio[]" id="_mntU1Promedio-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU1Promedio + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" readonly="readonly" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2Ev1[]" id="_mntU2Ev1-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2Ev1 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2Ev2[]" id="_mntU2Ev2-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2Ev2 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2Ev3[]" id="_mntU2Ev3-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2Ev3 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2Ev4[]" id="_mntU2Ev4-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2Ev4 + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2PromPract[]" id="_mntU2PromPract-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2PromPract + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" readonly="readonly" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2Trabajo[]" id="_mntU2Trabajo-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2Trabajo + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2ExFinal[]" id="_mntU2ExFinal-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2ExFinal + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntU2Promedio[]" id="_mntU2Promedio-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntU2Promedio + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" readonly="readonly" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntSusti[]" id="_mntSusti-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntSusti + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" /></td>'
                    + '<td class="contentRatingStudent"><input name="_mntPromedioFinal[]" id="_mntPromedioFinal-' + jsonRatings.rows[j].idMatriculaNotas + '" type="text" value="' + jsonRatings.rows[j].mntPromedioFinal + '" class="inputRatingStudent"' + editRatings + ' onchange="calculeAllRatings(this.id);" onblur="validate20(this);" onkeydown="return onlyNumber(event);" readonly="readonly" /></td>'
                    + '</tr>';
        }
        /*Notas de Estudiante - Fin*/

        tableRatings += '</tbody></table>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '<div class="widget-foot">'
                + ''
                + '</div>'
                + '</div>';

        $('.tableDocentesCursos').html(tableRatings);
        $('#sendRating').prop('disabled', true);
        if (rangeSeccion) {
            $('#sendRating').click(function () {
                sendRatingsStudents();
            });
            $('#sendRating').prop('disabled', false);
        }
        $('#cleanAllRating').click(function () {
            clearFormNotas();
            clearTableRatingsStudents();
        });
        $('#data-table input[type="text"]').click(function () {
            this.select();
        });
    }
}

function colorSelectRow(_tr) {
    $(_tr).toggleClass("active");
}

function sendRatingsStudents() {
    openPopUp('Confirmar guardar notas', '<div class="quest">¿Desea guardar el registro actual?</div>', '', 'jqueryAjaxRatings();', '');
}

function jqueryAjaxRatings() {
    var url = baseHTTP + 'controller/__matriculaNotas.php?action=saveRatingsStudents&';
    var dataRatings = getForm('Zm9ybVJhdGluZ3NOb3Rhc1N0dWRlbnRz');
    var showLoad = true;
    var div = 'quest';
    var result;
    var loading;
    $.ajax({
        url: url,
        data: dataRatings,
        async: false,
        type: "POST",
        beforeSend: function ()
        {
            if (showLoad === true)
            {
                loading = "<center>";
                loading += "<div><img src='" + baseHTTP + "files/img/ico/loading.gif' width='20' height='20' /></div>";
                loading += "<div>Loading...</div>";
                loading += "</center>";
                $("." + div).html(loading);
            }
        },
        success: function (data)
        {
            if (showLoad === true) {
                $("." + div).html("");
            }
            result = data;
        }
    });

    var _extraJS = '';
    if (result === 'success') {
        $('.modal-body').html('Registro de notas actualizado con éxito.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();' + _extraJS + ';" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    } else if (result === 'outOfRange') {
        $('.modal-body').html('Error al actualizar el registro de notas. El sistema detectó que se intentaron alterar las fechas.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="clearTableRatingsStudents();clearFormNotas();closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    } else {
        $('.modal-body').html('Error al actualizar el registro de notas.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    }
}

function clearTableRatingsStudents() {
    $('.tableDocentesCursos').html('');
}

function validate20(_ths) {
    var number = parseFloat($(_ths).val());
    if (number > 20) {
        $(_ths).val(0);
        $(_ths).css({'color': 'rgb(255,0,0)'});
    } else {
        var ratingRound = Math.round(number);
        $(_ths).val(ratingRound);
        if (ratingRound <= 10) {
            $(_ths).css({'color': 'rgb(255,0,0)'});
        } else {
            $(_ths).css({'color': 'rgb(0,0,0)'});
        }
    }
}

function calculePromPract1(_ths) {
    var index = _ths.substr(_ths.indexOf('-') + 1);
    var u1ev1 = parseFloat($('#_mntU1Ev1-' + index).val());
    var u1ev2 = parseFloat($('#_mntU1Ev2-' + index).val());
    var u1ev3 = parseFloat($('#_mntU1Ev3-' + index).val());
    var u1ev4 = parseFloat($('#_mntU1Ev4-' + index).val());
    var u1promPract = Math.round((u1ev1 + u1ev2 + u1ev3 + u1ev4) / 4);
    $('#_mntU1PromPract-' + index).val(u1promPract);

    if (u1promPract <= 10) {
        $('#_mntU1PromPract-' + index).css({'color': 'rgb(255,0,0)'});
    } else {
        $('#_mntU1PromPract-' + index).css({'color': 'rgb(0,0,0)'});
    }
}

function calculePromPract2(_ths) {
    var index = _ths.substr(_ths.indexOf('-') + 1);
    var u2ev1 = parseFloat($('#_mntU2Ev1-' + index).val());
    var u2ev2 = parseFloat($('#_mntU2Ev2-' + index).val());
    var u2ev3 = parseFloat($('#_mntU2Ev3-' + index).val());
    var u2ev4 = parseFloat($('#_mntU2Ev4-' + index).val());
    var u2promPract = Math.round((u2ev1 + u2ev2 + u2ev3 + u2ev4) / 4);
    $('#_mntU2PromPract-' + index).val(u2promPract);

    if (u2promPract <= 10) {
        $('#_mntU2PromPract-' + index).css({'color': 'rgb(255,0,0)'});
    } else {
        $('#_mntU2PromPract-' + index).css({'color': 'rgb(0,0,0)'});
    }
}

function calculePromedio1(_ths) {
    var index = _ths.substr(_ths.indexOf('-') + 1);
    var u1promPract = parseFloat($('#_mntU1PromPract-' + index).val());
    var u1exParcial = parseFloat($('#_mntU1ExParcial-' + index).val());
    var u1promedio = Math.round((u1promPract + u1exParcial) / 2);
    $('#_mntU1Promedio-' + index).val(u1promedio);

    if (u1promedio <= 10) {
        $('#_mntU1Promedio-' + index).css({'color': 'rgb(255,0,0)'});
    } else {
        $('#_mntU1Promedio-' + index).css({'color': 'rgb(0,0,0)'});
    }
}

function calculePromedio2(_ths) {
    var index = _ths.substr(_ths.indexOf('-') + 1);
    var u2promPract = parseFloat($('#_mntU2PromPract-' + index).val());
    var u2trabajo = parseFloat($('#_mntU2Trabajo-' + index).val());
    var u2exFinal = parseFloat($('#_mntU2ExFinal-' + index).val());
    var u2Promedio = Math.round((u2promPract + u2trabajo + u2exFinal) / 3);
    $('#_mntU2Promedio-' + index).val(u2Promedio);

    if (u2Promedio <= 10) {
        $('#_mntU2Promedio-' + index).css({'color': 'rgb(255,0,0)'});
    } else {
        $('#_mntU2Promedio-' + index).css({'color': 'rgb(0,0,0)'});
    }
}

function calculePromedioFinal(_ths) {
    var index = _ths.substr(_ths.indexOf('-') + 1);
    var u1exParcial = parseFloat($('#_mntU1ExParcial-' + index).val());
    var u2exFinal = parseFloat($('#_mntU2ExFinal-' + index).val());
    var susti = parseFloat($('#_mntSusti-' + index).val());
    var u1promedio = parseFloat($('#_mntU1Promedio-' + index).val());
    var u2promedio = parseFloat($('#_mntU2Promedio-' + index).val());
    if (u1exParcial <= u2exFinal) {
        if (u1exParcial < susti) {
            var u1promPract = parseFloat($('#_mntU1PromPract-' + index).val());
            var u1exParcial = susti;
            u1promedio = Math.round((u1promPract + u1exParcial) / 2);
        }
    } else if (u2exFinal < u1exParcial) {
        if (u2exFinal < susti) {
            var u2promPract = parseFloat($('#_mntU2PromPract-' + index).val());
            var u2trabajo = parseFloat($('#_mntU2Trabajo-' + index).val());
            var u2exFinal = susti;
            u2promedio = Math.round((u2promPract + u2trabajo + u2exFinal) / 3);
        }
    }

    var promedioFinal = Math.round((u1promedio + u2promedio) / 2);
    $('#_mntPromedioFinal-' + index).val(promedioFinal);

    if (promedioFinal <= 10) {
        $('#_mntPromedioFinal-' + index).css({'color': 'rgb(255,0,0)'});
    } else {
        $('#_mntPromedioFinal-' + index).css({'color': 'rgb(0,0,0)'});
    }
}

function calculeAllRatings(_ths) {
    calculePromPract1(_ths);
    calculePromPract2(_ths);
    calculePromedio1(_ths);
    calculePromedio2(_ths);
    calculePromedioFinal(_ths);
}
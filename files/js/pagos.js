$(document).ready(function () {
    comboboxCarrera();
    comboboxUsuarioCarrera();
    comboboxMatricula();
    comboboxTipoPago();
    comboboxModoPago();
    showExtraData();
});

function gridPagos() {
    var idMatricula = $('#idMatricula').val();

    if (idMatricula > 0) {
        var objGrid = {
            div: 'tablePagos',
            url: baseHTTP + 'controller/__grid.php?action=loadGrid',
            table: 'pagos;tipopago;modopago',
            colNames: ['', 'TIPO PAGO', 'MODO PAGO', 'TIPO COMPROBANTE', 'NÚMERO COMPROBANTE', 'MONTO', 'BENEFICIO', 'MONTO C/DESCUENTO', 'FECHA'],
            colModel: [
                {name: 'idPagos', index: '0', align: 'center'},
                {name: 'tppDescripcion', index: '1'},
                {name: 'mdpDescripcion', index: '2'},
                {name: 'pgsTipoComprobante', index: '0'},
                {name: 'pgsNumComprobante', index: '0'},
                {name: 'pgsPago', index: '0'},
                {name: 'pgsBeneficio', index: '0'},
                {name: 'pgsPagoDesc', index: '0'},
                {name: 'pgsFecha', index: '0'}
            ],
			join: {
				type: 'inner;inner',
				on: 'p0.idTipoPago=t1.idTipoPago;p0.idModoPago=m2.idModoPago'
			},
            where: {
                fields: 'idMatricula',
                logical: '=',
                values: idMatricula
            },
            page: 1,
            rowNum: 20,
            sortName: 'idPagos',
            sortOrder: 'asc',
            title: 'PAGOS',
            check: ""
        };
        loadGrid(objGrid);
        var _btn = '';
        $('.tablePagos div.widget-head div.widget-icons.pull-right').html(_btn);
    }
}

function validatePagos() {
    if (validateFormControl('idCarrera', 'number', true, true, 'Seleccionar Carrera.')) {
        if (validateFormControl('idUsuarioCarrera', 'number', true, true, 'Seleccionar Estudiante.')) {
            if (validateFormControl('idMatricula', 'number', true, true, 'Seleccionar Matricula.')) {
                if (validateFormControl('TipoPago', 'text', true, true, 'Indicar el Tipo de Pago.')) {
                    if (validateFormControl('ModoPago', 'text', true, true, 'Seleccionar Modo de Pago.')) {
                        if (validateFormControl('TipoComprobante', 'text', true, true, 'Seleccionar Tipo de Comprobante.')) {
                            if (validateFormControl('Pago', 'decimal', true, true, 'Ingresar Monto numérico.')) {
                                if (validateFormControl('Beneficio', 'text', true, true, 'Seleccionar Seccion.')) {
                                    if (validateFormControl('PagoDesc', 'decimal', true, true, 'Ingresar Monto numérico.')) {
                                        if (validateFormControl('FPago', 'date', true, true, 'Seleccionar una fecha correcta.')) {
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

function comboboxCarrera() {
    $('#idCarrera option[value!=""]').remove();
    $('div.tablePagos').html('');
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
    $('div.tablePagos').html('');
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
    $('div.tablePagos').html('');
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
        opt.setAttribute("data-beneficio", jsonMatricula[i].tboDescripcion);
        opt.setAttribute("data-pago-matricula", jsonMatricula[i].tboPagoMatricula);
        opt.setAttribute("data-pago-mensual", jsonMatricula[i].tboPagoMensual);
        opt.setAttribute("data-pa-matricula-desc", jsonMatricula[i].tboPaMatriculaDesc);
        opt.setAttribute("data-pa-mensual-desc", jsonMatricula[i].tboPaMensualDesc);
        $('#idMatricula').append(opt);
    }
}

function comboboxTipoPago() {
    $('#idTipoPago option[value!=""]').remove();
    var url = baseHTTP + 'controller/__tipoPago.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonTipoPago = jQuery.parseJSON(result);
    for (i = 0; i < jsonTipoPago.length; i++) {
        var opt = new Option(jsonTipoPago[i].tppDescripcion, jsonTipoPago[i].idTipoPago);
        opt.setAttribute("data-monto", jsonTipoPago[i].tppMonto);
        $('#idTipoPago').append(opt);
    }
}

function comboboxModoPago() {
    $('#idModoPago option[value!=""]').remove();
    var url = baseHTTP + 'controller/__modoPago.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonModoPago = jQuery.parseJSON(result);
    for (i = 0; i < jsonModoPago.length; i++) {
        var opt = new Option(jsonModoPago[i].mdpDescripcion, jsonModoPago[i].idModoPago);
        $('#idModoPago').append(opt);
    }
}

function cantidadMeses() {
    var idMatricula = $('#idMatricula').val();
    var url = baseHTTP + 'controller/__pagos.php?action=countPago&idMatricula=' + idMatricula;
    var result = jqueryAjax(url, false, '');
    var jsonPago = jQuery.parseJSON(result);
    if (jsonPago[0].carMeses == jsonPago[0].pagos - 1) {
        $('#pagoPendiente').removeClass('label-danger');
        $('#pagoPendiente').addClass('label-default');
        $('#pagoPendiente').html('No hay pagos pendientes.');
        $('#buttonRegister').prop('disabled', true);
    } else {
        $('#pagoPendiente').addClass('label-danger');
        $('#pagoPendiente').removeClass('label-default');
        $('#pagoPendiente').html('Pagos Pendientes encontrados.');
        $('#buttonRegister').prop('disabled', false);
    }
    return jsonPago[0];
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
        //$(".beneficioNFO").html("No se seleccionó Matrícula.");
        $('input[type="text"]').each(function () {
            $(this).val("");
        });
        $('#pagoPendiente').removeClass('label-success');
        $('#pagoPendiente').addClass('label-default');
        $('#pagoPendiente').html('No hay pagos pendientes.');
        $('#buttonRegister').prop('disabled', true);
        $('div.tablePagos').html('');
    } else {
        var arrayCantidad = cantidadMeses();
        var _ciclo = matricula.find(':selected').data('ciclo');
        var _seccion = matricula.find(':selected').data('seccion');
        var _turno = matricula.find(':selected').data('turno');
        var _sede = matricula.find(':selected').data('sede');
        var _estado = matricula.find(':selected').data('estado');
        var _beneficio = matricula.find(':selected').data('beneficio');
        var _pagoMatricula = matricula.find(':selected').data('pagoMatricula');
        var _pagoMensual = matricula.find(':selected').data('pagoMensual');
        var _paMatriculaDesc = matricula.find(':selected').data('paMatriculaDesc');
        var _paMensualDesc = matricula.find(':selected').data('paMensualDesc');
        var date = new Date();
        var month = date.getMonth() + 1;
        var day = date.getDate();
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
        /***************/
        $("#Beneficio").val(_beneficio);
        $("#FPago").val((day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + date.getFullYear());
        /***************/
        if (arrayCantidad.pagos == 0)
        {
            $("#TipoPago").val("Matricula");
            $("#Pago").val(_pagoMatricula);
            $("#PagoDesc").val(_paMatriculaDesc);
        }
        else if (arrayCantidad.carMeses >= (arrayCantidad.pagos - 1) && arrayCantidad.pagos > 0)
        {
            $("#TipoPago").val("Mensualidad");
            $("#Pago").val(_pagoMensual);
            $("#PagoDesc").val(_paMensualDesc);
        }
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
 }
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

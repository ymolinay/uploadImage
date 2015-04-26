$(document).ready(function () {
    comboboxCarrera();
    comboboxUsuarioCarrera();
    comboboxMatricula();
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

function validatePagoMatricula() {
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
        opt.setAttribute("data-beneficio", jsonMatricula[i].tboDescripcion);
        opt.setAttribute("data-pago-matricula", jsonMatricula[i].tboPagoMatricula);
        opt.setAttribute("data-pago-mensual", jsonMatricula[i].tboPagoMensual);
        opt.setAttribute("data-pa-matricula-desc", jsonMatricula[i].tboPaMatriculaDesc);
        opt.setAttribute("data-pa-mensual-desc", jsonMatricula[i].tboPaMensualDesc);
        $('#idMatricula').append(opt);
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
    } else {
        $('#pagoPendiente').addClass('label-danger');
        $('#pagoPendiente').removeClass('label-default');
        $('#pagoPendiente').html('Pagos Pendientes encontrados.');
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


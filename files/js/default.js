var baseHTTP = "http://localhost/catolica.intranet/";
//var baseHTTP = "http://www.perucatolica.com/intranet/";

$.fn.datetimepicker.dates['en'] = {
    days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
    daysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab", "Dom"],
    daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
    months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
    today: "Hoy"
};
/*===========================================================*/
//location
function href(url) {
    $(location).attr("href", url);
}
/*===========================================================*/
//ReloadPage
function reloadPage() {
    location.reload();
}
/*===========================================================*/
//Obtener datos de un formulario
function getForm(form) {
    form = "#" + base64_decoding(form);
    var data = $(form).serialize();
    return data;
}
/*===========================================================*/
// hh:mm:ss
function myTime() {
    var time = new Date();
    var hours = time.getHours();
    var minutes = time.getMinutes();
    var seconds = time.getSeconds();
    return ((hours < 10 ? "0" : "") + hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds);
}
/*===========================================================*/
// aaaa:mm:dd
function myDate() {
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    return (year + "-" + (month < 10 ? "0" : "") + month + "-" + (day < 10 ? "0" : "") + day);
}
/*===========================================================*/
// jquery ajax
function jqueryAjax(url, showLoad, div) {
    var result;
    var loading;
    $.ajax({
        url: url,
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
    return result;
}
/*===========================================================*/
// decodificación en utf8
function utf8_decode(utftext) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;
    while (i < utftext.length) {
        c = utftext.charCodeAt(i);
        if (c < 128) {
            string += String.fromCharCode(c);
            i++;
        } else if ((c > 191) && (c < 224)) {
            c2 = utftext.charCodeAt(i + 1);
            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = utftext.charCodeAt(i + 1);
            c3 = utftext.charCodeAt(i + 2);
            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    }
    return string;
}
/*===========================================================*/
// codificación en base64
function base64_encoding(input) {
    var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var output = "";
    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
    var i = 0;
    while (i < input.length) {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);
        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;
        if (isNaN(chr2)) {
            enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
            enc4 = 64;
        }
        output = output +
                keyStr.charAt(enc1) + keyStr.charAt(enc2) +
                keyStr.charAt(enc3) + keyStr.charAt(enc4);
    }
    return output;
}
/*===========================================================*/
// decoficación en base64
function base64_decoding(input) {
    var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var output = "";
    var chr1, chr2, chr3;
    var enc1, enc2, enc3, enc4;
    var i = 0;
    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
    while (i < input.length) {
        enc1 = keyStr.indexOf(input.charAt(i++));
        enc2 = keyStr.indexOf(input.charAt(i++));
        enc3 = keyStr.indexOf(input.charAt(i++));
        enc4 = keyStr.indexOf(input.charAt(i++));
        chr1 = (enc1 << 2) | (enc2 >> 4);
        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
        chr3 = ((enc3 & 3) << 6) | enc4;
        output = output + String.fromCharCode(chr1);
        if (enc3 != 64) {
            output = output + String.fromCharCode(chr2);
        }
        if (enc4 != 64) {
            output = output + String.fromCharCode(chr3);
        }
    }
    output = utf8_decode(output);
    return output;
}
/*===========================================================*/
// validar campos
function validateFormControl(_controlId, _expression, _setFocus, _icon, _msg) {
    var control = $('#' + _controlId);
    if (_expression === 'user') {
        expr = /^([\w]{4,15})$/;
    }
    //minúscula,mayúscula,número/signo,6 dígitos min
    if (_expression === 'password') {
        expr = /(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
    }
    if (_expression === 'alphanumeric') {
        expr = /^([\w]{4,})$/;
    }
    if (_expression === 'text') {
        expr = /^([\.\s\áéíóúñÁÉÍÓÚÑa-zA-Z]{3,})$/;
    }
    if (_expression === 'text50') {
        expr = /^([\.\w\s\áéíóúñÁÉÍÓÚÑ]{1,50})$/;
    }
    if (_expression === 'text100') {
        expr = /^([\.\w\s\áéíóúñÁÉÍÓÚÑ]{1,100})$/;
    }
    if (_expression === 'text150') {
        expr = /^([\.\w\s\áéíóúñÁÉÍÓÚÑ]{1,150})$/;
    }
    if (_expression === 'text200') {
        expr = /^([\.\w\s\áéíóúñÁÉÍÓÚÑ]{1,200})$/;
    }
    if (_expression === 'number') {
        expr = /^([0-9]{1,})$/;
    }
    if (_expression === 'char') {
        expr = /^([\w0-9]{1,})$/;
    }
    if (_expression === 'decimal') {
        expr = /^[0-9]+(\.[0-9]{1,2})?$/;
    }
    if (_expression === 'address') {
        expr = /^([\w0-9\s\.\&\#\-\/\áéíóúÁÉÍÓÚÑ\´]{1,250})$/;
    }
    if (_expression === 'ruc') {
        expr = /^([1-2]{1})*0([0-9]{9})$/;
    }
    if (_expression === 'telephone') {
        expr = /^([0-9\s\#\-\*\/]{5,})$/;
    }
    if (_expression === 'dni') {
        expr = /^([0-9]{8})$/;
    }
    if (_expression === 'mail') {
        expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    }
    if (_expression === 'date') {
        expr = /^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/;
    }
    if (_expression === 'file') {
        expr = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
    }
    if (_expression === 'empty') {
        expr = /([^\s])/;
    }
    if (!expr.test(control.val().trim())) {
        control.parent().parent().addClass('has-error');
        if (_icon === true) {
            control.after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            control.tooltip({title: _msg});
            control.tooltip('show');
        } else {
            $(control.select2("container")).addClass("select2error");
        }
        if (_setFocus === true) {
            control.focus();
        }
        return false;
    }
    else {
        control.parent().parent().removeClass('has-error');
        //ARREGLAR
        //$(control.select2("container")).removeClass("select2error");
        //$('#iconRemove').remove();
        $("span[id='iconRemove']").remove();
        control.tooltip('destroy');
        return true;
    }
}
/*===========================================================*/
// Open PopUp
function openPopUp(_title, _body, _actionYes, _actionSave, _actionNo) {
    //valor por defecto
    _actionNo || (_actionNo = '');
    var mTitle = _title;
    var mBody = _body;
    var mActionSave = _actionSave;
    var mActionYes = _actionYes;
    var mActionNo = _actionNo;
    var modalContent = '<div class="modal-dialog">';
    modalContent += '<div class="modal-content" style="border-radius: 0px">';
    modalContent += '<div class="modal-header">';
    modalContent += '<button class="close" type="button" onclick="closePopUp();"><span aria-hidden="true">&times;</span></button>';
    modalContent += '<h4 id="myModalLabel" class="modal-title">' + mTitle + '</h4>';
    modalContent += '</div>';
    modalContent += '<div class="modal-body">';
    modalContent += mBody;
    modalContent += '</div>';
    modalContent += '<div class="modal-footer">';
    modalContent += '<button id="cancel" class="btn btn-default btn-sm" type="button" onclick="closePopUp();' + mActionNo + ';"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>';
    if (mActionYes !== '') {
        modalContent += '<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="disabledButton(\'#confirm\');' + mActionYes + '"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>';
    } else if (mActionSave !== '') {
        modalContent += '<button id="save" class="btn btn-info btn-sm" type="button" onclick="disabledButton(\'#save\');' + mActionSave + '"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>';
    }
    modalContent += '</div>';
    modalContent += '</div>';
    modalContent += '</div>';
    $("#backgroundLock").fadeIn(200);
    //$("#backgroundLock").css('display','block');
    $("#modalPopUp").html(modalContent);
    $("#modalPopUp").show();
}
/*===========================================================*/
// Close PopUp
function closePopUp() {
    $("#modalPopUp").hide();
    $("#modalPopUp").html("");
    //$("#backgroundLock").css('display','none');
    $("#backgroundLock").fadeOut(200);
}
/*===========================================================*/
// agregar slashes a apóstrofes
function addslashes(str) {
    return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0');
}
/*===========================================================*/
// Confirmar cerrar sesión
function logOut() {
    body = '<p>¿Desea salir del sistema?</p>';
    openPopUp('Cerrar sesión', body, 'executeLogOut()', '');
}
/*===========================================================*/
// Cerrar sesión
function executeLogOut() {
    var time = base64_encoding(myTime());
    var date = base64_encoding(myDate());
    url = baseHTTP + "controller/__accesos.php?action=logout&time=" + time + "&date=" + date;
    result = jqueryAjax(url, false, "   ");
    if (result === "success") {
        href("login.php");
    }
    else {
        $("." + div).html("<div class='error'>Error al ingresar al sistema, <a href='mailto:soporte@soporte@intranet.perucatolica.com'>Contáctenos</a>.</div>");
        $("#txtuser").select();
        $("#txtuser").focus();
    }
}
/*===========================================================*/
function confirmSave(_table, _form, _extraJS, _type) {
    _type || (_type = 'bWVzc2FnZQ==');
    var validate = false;
    var table = base64_decoding(_table);
    var type = base64_decoding(_type);
    if (table === 'personal') {
        validate = validatePersonal();
    }
    if (table === 'usuarioCarrera') {
        validate = validateUsuarioCarrera();
    }
    if (table === 'carrera') {
        validate = validateCarrera();
    }
    if (table === 'curso') {
        validate = validateCurso();
    }
    if (table === 'matricula') {
        validate = validateMatricula();
    }
    if (table === 'inscripcion') {
        validate = validateInscripcion();
    }
    if (table === 'seccion') {
        validate = validateSeccion();
    }
    if (table === 'docenteSeccionCurso') {
        validate = validateDocenteSeccionCurso();
    }
    if (table === 'pagos') {
        validate = validatePagos();
    }
    if (table === 'planEstudio') {
        validate = validatePlanEstudio();
    }
    if (table === 'tipoPago') {
        validate = validateTipoPago();
    }
    if (table === 'modoPago') {
        validate = validateModoPago();
    }
    //if (table === 'cuenta') {validate = validateCustomer();}
    //if (table === 'sedetemp') {validate = validateSede();}
    //if (table === 'areatemp') {validate = validateArea();}
    //if (table === 'proyecto') {validate = validateProject();}
    //if (table === 'equipoTemp') {validate = validateRecepcion(); }
    //if (table === 'equipo') {validate = validateRecepcionSave();}
    if (validate === true) {
        //if (type !== 'message') {
        //if (type === 'message') {
        var title = 'Confirmar guardar registro';
        var body = '<div class="quest">¿Desea guardar el registro actual?</div>';
        //if (table != 'inscripcion') {
        var actionSave = "executeSave('" + _table + "','" + _form + "','" + _extraJS + "');";
        openPopUp(title, body, '', actionSave);
        //}
        //else{openPopUp(title, body, '', _extraJS);}
        //} else if (type === 'form') {
        //     executeSave(_table, _form);
        //}
    }
}
/*===========================================================*/
function executeSave(_table, _form, _extraJS) {
    var table = base64_decoding(_table);
    var form = base64_decoding(_form);
    var data = getForm(_form);
    var url = baseHTTP + "controller/__" + table + ".php?action=save&" + data;
    var result = jqueryAjax(url, true, 'quest');
    if (result === 'success') {
        $('.modal-body').html('Registro actualizado con éxito.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();' + _extraJS + ';clearForm(\'' + _form + '\');" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    } else {
        $('.modal-body').html('Error al actualizar el registro.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> Aceptar</button>');
    }
}
/*===========================================================*/
//confirmar y eliminar item
function confirmDelete(_table, _id, _functions) {
    _functions || (_functions = '');
    var title = 'Confirmar eliminar registro';
    var body = '<div class="quest">¿Desea eliminar el registro actual?</div>';
    var action = "executeDelete('" + _table + "','" + _id + "','" + _functions + "');";
    openPopUp(title, body, action, '');
}
/*===========================================================*/
function executeDelete(_table, _id, _functions) {
    $("#save").attr("disabled", "disabled");
    var table = base64_decoding(_table);
    var url = baseHTTP + "controller/__" + table + ".php?action=delete&id=" + _id;
    var result = jqueryAjax(url, true, 'quest');
    if (result === 'success') {
        $('.modal-body').html('Registro eliminado con éxito.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();' + _functions + ';" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
//        if (table === 'sedetemp') {
//            $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();gridSede();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
//        } else if (table === 'areatemp') {
//            $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();gridArea();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
//        } else {
//            $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
//        }
    } else {
        $('.modal-body').html('Error al eliminado el registro.');
        $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
    }
}
/*===========================================================*/
function clearForm(form) {
    form = "#" + base64_decoding(form);
    $(form).trigger("reset");
}
/*===========================================================*/
function validateDuplicate(_controlId, _table, _field, _fieldId, _id) {
    //_controlId -> control que contiene el valor a validar
    //_table -> tabla donde se va a consultar
    //_field -> campo de la tabla
    //_fieldId -> campo id de la tabla
    //_id -> control que contiene el valor del id donde se está consultando
    _fieldId || (_fieldId = '');
    _id || (_id = '');
    var control = $('#' + _controlId);
    var search = control.val();
    var id = (_id !== '') ? $('#' + _id).val() : '';
    //var id = $('#' + _id).val();
    var url = baseHTTP + 'controller/__mantenimiento.php?action=duplicate&table=' + _table + '&field=' + _field + '&search=' + search + '&fieldId=' + _fieldId + '&id=' + id;
    var result = jqueryAjax(url, false, '');
    if (result === 'fail') {
        control.parent().parent().addClass('has-error');
        control.after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        control.tooltip({title: 'Registro duplicado en el sistema.'});
        control.tooltip('show');
        control.focus();
        return false;
    }
    else {
        control.parent().parent().removeClass('has-error');
        $("span[id='iconRemove']").remove();
        control.tooltip('destroy');
        return true;
    }
}
/*===========================================================*/
function disabledButton(_button) {
    $(_button).attr("disabled", true);
}
/*===========================================================*/
function $_GET(param) {
    /* Obtener la url completa */
    url = document.URL;
    /* Buscar a partir del signo de interrogación ? */
    url = String(url.match(/\?+.+/));
    /* limpiar la cadena quitándole el signo ? */
    url = url.replace("?", "");
    /* Crear un array con parametro=valor */
    url = url.split("&");
    /* 
     Recorrer el array url
     obtener el valor y dividirlo en dos partes a través del signo = 
     0 = parametro
     1 = valor
     Si el parámetro existe devolver su valor
     */
    x = 0;
    while (x < url.length) {
        p = url[x].split("=");
        if (p[0] === param) {
            return decodeURIComponent(p[1]);
        }
        x++;
    }
}
/*===========================================================*/
function loadGrid(objGrid) {
    var url = objGrid.url;
    var dbTable = objGrid.table;
    var fields = '';
    var index = '';
    var sep = '';
    for (i = 0; i < objGrid.colModel.length; i++) {
        fields += sep + objGrid.colModel[i].name;
        index += sep + objGrid.colModel[i].index;
        sep = ';';
    }
    var limit = objGrid.rowNum;
    var orderName = objGrid.sortName;
    var orderMode = objGrid.sortOrder;
    var page = objGrid.page;
    var joinType = (objGrid.hasOwnProperty('join')) ? objGrid.join.type : '';
    var joinOn = (objGrid.hasOwnProperty('join')) ? objGrid.join.on : '';
    var whereFields = (objGrid.hasOwnProperty('where')) ? objGrid.where.fields : '';
    var whereLogical = (objGrid.hasOwnProperty('where')) ? objGrid.where.logical : '';
    var whereValues = (objGrid.hasOwnProperty('where')) ? objGrid.where.values : '';
    url = url + '&dbTable=' + dbTable + '&fields=' + fields + '&limit=' + limit + '&orderName=' + orderName + '&orderMode=' + orderMode
            + '&page=' + page + '&whereFields=' + whereFields + '&whereLogical=' + whereLogical + '&whereValues=' + whereValues
            + '&index=' + index + '&joinType=' + joinType + '&joinOn=' + base64_encoding(joinOn);
    var result = jqueryAjax(url, true, objGrid.div);
    var data = jQuery.parseJSON(result);
    if (data.records > 0) {
        /////////////////////////////////////////
        var ObjNextGrid = $.extend({}, objGrid);
        ObjNextGrid.page = parseInt(data.page) + 1;
        //ObjNextGrid = recorrer(ObjNextGrid);
        var ObjPrevGrid = $.extend({}, objGrid);
        ObjPrevGrid.page = parseInt(data.page) - 1;
        //ObjPrevGrid = recorrer(ObjPrevGrid);
        var ObjEndGrid = $.extend({}, objGrid);
        ObjEndGrid.page = parseInt(data.total);
        //ObjEndGrid = recorrer(ObjEndGrid);
        var ObjStartGrid = $.extend({}, objGrid);
        ObjStartGrid.page = 1;
        //ObjStartGrid = recorrer(ObjStartGrid);
        var title = objGrid.title.toUpperCase();
        var colums = objGrid.colNames;
        var numColums = colums.length;
        var select = objGrid.rowList;
        var table = '<div class="widget-head">'
                + '<div class="pull-left">'
                + title
                + '</div>'
                + ' <div class="widget-icons pull-right">'
                + '<button onclick="newForm()" type="button" class="btn btn-sm btn-info">Nuevo Registro</button>'
                //+ '<a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a> '
                //+ '<a href="#" class="wclose"><i class="fa fa-times"></i></a>'
                + ' </div>'
                + '<div class="clearfix"></div>'
                + '</div>'
                + '<div class="widget-content" style="display: block;">'
                + '<div class="padd">'

                + '<div class="page-tables">'
                + '<div class="table-responsive">'
                + '<table cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%" class="dataTable" aria-describedby="data-table_info" style="width: 100%;">';
        table += '<thead><tr role="row">';
        for (var i = 0; i < numColums; i++) {
            table += '<th class="none" role="columnheader" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" aria-sort="ascending" style="width: auto; background-color:#f5f5f5"><strong>'
                    + colums[i]
                    + '</strong></th>';
        }
        table += '</tr></thead>';
        table += '<tbody role="alert" aria-live="polite" aria-relevant="all">';
        for (var i = 0; i < data.rows.length; i++) {
            table += '<tr>'
                    + '<td align="center">';
            if (objGrid.hasOwnProperty('edit')) {
                //table += '&nbsp;<span class="glyphicon glyphicon-pencil" onClick="editRecord('+data.rows[i].id+');' + objGrid.edit + '" style="cursor: pointer;"></span>';
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-pencil" onClick="' + objGrid.edit + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('delete')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-times" onClick="' + objGrid.delete + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('qrCode')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-qrcode" onClick="' + objGrid.qrCode + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('print')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-print" onClick="' + objGrid.print + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('check')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-check" onClick="' + objGrid.check + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('lock')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-lock" onClick="' + objGrid.lock + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('reset')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-repeat" onClick="' + objGrid.reset + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('alert')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-exclamation-circle" onClick="' + objGrid.alert + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('tag')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-tag" onClick="' + objGrid.tag + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('rebuild')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-wrench" onClick="' + objGrid.rebuild + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('file')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-paperclip" onClick="' + objGrid.file + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('view')) {
                table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="fa fa-search" onClick="' + objGrid.view + '" style="cursor: pointer;"></span>';
            }
            if (objGrid.hasOwnProperty('checkbox')) {
                //table += '&nbsp;<span id="' + base64_encoding(data.rows[i].id) + '" class="glyphicon glyphicon-search" onClick="' + objGrid.checkbox + '" style="cursor: pointer;">' + base64_encoding(data.rows[i].id) + '</span>';
                //table += '&nbsp;<input id="' + objGrid.checkbox.prefix + '_' + base64_encoding(data.rows[i].id) + '" name="' + objGrid.checkbox.prefix + '_' + base64_encoding(data.rows[i].id) + '" type="checkbox" value="' + base64_encoding(data.rows[i].id) + '" onclick="'+objGrid.checkbox.accion+'">';
                table += '&nbsp;<input id="' + objGrid.checkbox.prefix + '_' + base64_encoding(data.rows[i].id) + '" name="_gridCheckBox[]" type="checkbox" value="' + base64_encoding(data.rows[i].id) + '" onclick="' + objGrid.checkbox.accion + '">';
            }
            table += '</td>';
            for (var j = 1; j <= data.rows[i].cell.length - 1; j++) {
                //if(objGrid.colModel[j].hasOwnProperty('align')){}
                var align = (objGrid.colModel[j].hasOwnProperty('align')) ? 'align = "' + objGrid.colModel[j].align + '"' : '';
                var _class = (objGrid.colModel[j].hasOwnProperty('class')) ? ' class = "' + objGrid.colModel[j].class + '"' : '';
                table += '<td ' + align + _class + '>' + data.rows[i].cell[j] + '</td>';
            }
            table + '</tr>';
        }
        table += '</tbody>';
        table += '</table></div></div></div>';
        table += '<div class="widget-foot">';
        table += '<span style="float: left;">Mostrando <strong>' + (data.star + 1) + '</strong> - <strong>' + data.end + '</strong> de <strong>' + data.records + '</strong></span>&nbsp;registros.';
        table += '<p style="float: right;"><span id="startGrid" class="fa fa-fast-backward"></span>'
        table += '<span id="prevGrid" class="fa fa-backward"></span>&nbsp;&nbsp;<font color="#cecdcd">Pagínas</font>&nbsp;&nbsp;'
        table += '<span id="nextGrid" class="fa fa-forward"></span>'
        table += '<span id="endGrid" class="fa fa-fast-forward"></span></p>'
        table + '</div>'
        table + '</div>'
        $('.' + objGrid.div).html(table);
        if (objGrid.page !== 1) {
            $('#startGrid').on('click', function () {
                loadGrid(ObjStartGrid);
            });
            $('#startGrid').css("cursor", "pointer");
        } else {
            $('#startGrid').css("opacity", "0.2");
        }
        if (ObjPrevGrid.page !== 0) {
            $('#prevGrid').on('click', function () {
                loadGrid(ObjPrevGrid);
            });
            $('#prevGrid').css("cursor", "pointer");
        } else {
            $('#prevGrid').css("opacity", "0.2");
        }
        if (ObjNextGrid.page !== parseInt(data.total) + 1) {
            $('#nextGrid').on('click', function () {
                loadGrid(ObjNextGrid);
            });
            $('#nextGrid').css("cursor", "pointer");
        } else {
            $('#nextGrid').css("opacity", "0.2");
        }
        if (objGrid.page !== data.total) {
            $('#endGrid').on('click', function () {
                loadGrid(ObjEndGrid);
            });
            $('#endGrid').css("cursor", "pointer");
        } else {
            $('#endGrid').css("opacity", "0.2");
        }
    } else {
        var title = objGrid.title.toUpperCase();
        var table = '<div class="widget-head">'
                + '<div class="pull-left">'
                + title
                + '</div>'
                + '<div class="clearfix"></div>'
                + '</div>'
                + '<div class="widget-content" style="display: block;">'
                + '<div class="padd"><center>No se encontraron registros.</center>'
                + '</div>'
                + '</div>'
                + '</div>'
        $('.' + objGrid.div).html(table);
    }
}
/*===========================================================*/
function showTab(number) {
    $('#tabs li:eq(' + number + ') a').tab('show');
}
/*===========================================================*/
//convierte un String(dd-mm-yyyy) a Date
function convertToDate(date) {
    return new Date(date.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
}
/*===========================================================*/
//Compara dos fechas y retorna true si _endDate es mayor que _starDate
function compareDates(_starDate, _endDate) {
    var starDate = convertToDate($('#' + _starDate).val());
    var endDate = convertToDate($('#' + _endDate).val());
    var validate = (endDate > starDate) ? true : false;
    if (validate) {
        $('#' + _starDate).parent().parent().removeClass('has-error');
        $('#' + _starDate).tooltip('destroy');
        $('#' + _endDate).parent().parent().removeClass('has-error');
        $('#' + _endDate).tooltip('destroy');
        $("span[id='iconRemove']").remove();
        return true;
    } else {
        $('#' + _starDate).parent().parent().addClass('has-error');
        $('#' + _starDate).after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        $('#' + _starDate).tooltip({title: 'Rango de fechas incorrecto. La fecha inicio debe ser menor que la de fin.'});
        $('#' + _starDate).tooltip('show');
        $('#' + _endDate).parent().parent().addClass('has-error');
        $('#' + _endDate).after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
        $('#' + _endDate).tooltip({title: 'Rango de fechas incorrecto. La fecha fin debe ser mayor que la de inicio.', placement: 'bottom'});
        $('#' + _endDate).tooltip('show');
        return false;
    }
}
/*===========================================================*/
function onlyType(e, _type) {
    if (_type === 'number') {
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    } else if (_type === 'decimal') {
        if (e.which !== 8 && e.which !== 0 && e.which !== 46 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    }
}
/*===========================================================*/
function dotDecimal(_id) {
    var _value = '';
    var text = $('#' + _id).val();
    var index = text.indexOf('.');
    if (index < 0) {
        _value = text + '.00';
    }
    else {
        var _integer = parseInt(text.substring(0, index));
        var _decimal = parseFloat('0.' + text.substring(index + 1).replace(/\./g, ''));
        _decimal = Math.round(_decimal * 100) / 100;
        _value = _integer + _decimal;
    }
    $('#' + _id).val(_value);
}

function skipAccent(text) {
    var acentos = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç";
    var original = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc";
    for (var i = 0; i < acentos.length; i++) {
        text = text.replace(acentos.charAt(i), original.charAt(i));
    }
    return text;
}

function getBeginWinget(col) {
    var beginWinget = '<div class="row"><div class="col-md-' + col + '"><div class="widget wgreen"><div class="widget-head"><div class="pull-left">';
    return beginWinget;
}

function getContentWinget() {
    var contentWinget = '</div><div class="widget-icons pull-right"><a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a><a href="#" class="wclose"><i class="fa fa-times"></i></a></div><div class="clearfix"></div></div><div class="widget-content"><div class="padd">';
    return contentWinget;
}

function getEndWinget() {
    var endWinget = '</div></div></div></div></div>';
    return endWinget;
}

function empty(mixed_var) {
    //  discuss at: http://phpjs.org/functions/empty/
    // original by: Philippe Baumann
    //    input by: Onno Marsman
    //    input by: LH
    //    input by: Stoyan Kyosev (http://www.svest.org/)
    // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: Onno Marsman
    // improved by: Francesco
    // improved by: Marc Jansen
    // improved by: Rafal Kukawski
    //   example 1: empty(null);
    //   returns 1: true
    //   example 2: empty(undefined);
    //   returns 2: true
    //   example 3: empty([]);
    //   returns 3: true
    //   example 4: empty({});
    //   returns 4: true
    //   example 5: empty({'aFunc' : function () { alert('humpty'); } });
    //   returns 5: false

    var undef, key, i, len;
    var emptyValues = [undef, null, false, 0, '', '0'];

    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixed_var === emptyValues[i]) {
            return true;
        }
    }

    if (typeof mixed_var === 'object') {
        for (key in mixed_var) {
            // TODO: should we check for own properties only?
            //if (mixed_var.hasOwnProperty(key)) {
            return false;
            //}
        }
        return true;
    }

    return false;
}
/*===========================================================*/
function onlyNumber(e) {
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) {
        return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
}
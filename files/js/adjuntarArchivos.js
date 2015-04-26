$(document).ready(function () {
    comboboxCarrera();
    comboboxAlumno();
    gridStudentProfession();
    beginFileUploadComponent();
    $('#filesProfession').fadeOut();

});

function comboboxCarrera() {
    $('#idCarrera option[value!=""]').remove();
    var url = baseHTTP + 'controller/__carrera.php?action=combobox';
    var result = jqueryAjax(url, false, '');
    var jsonCarrera = jQuery.parseJSON(result);
    for (i = 0; i < jsonCarrera.length; i++) {
        $('#idCarrera').append(new Option(jsonCarrera[i].carDescripcion, jsonCarrera[i].idCarrera));
    }
}

function comboboxAlumno() {
    $('#idUsuario option[value!=""]').remove();
    var url = baseHTTP + 'controller/__personal.php?action=combobox2&perfil=2';
    var result = jqueryAjax(url, false, '');
    var personal = jQuery.parseJSON(result);
    for (i = 0; i < personal.length; i++) {
        $('#idUsuario').append(new Option(personal[i].prsNombre + ' ' + personal[i].prsApellidoPaterno + ' ' + personal[i].prsApellidoMaterno + ' - ' + personal[i].prsDNI, personal[i].idUsuario));
    }
}

function gridStudentProfession() {
    var User = $('#idUsuario').val();
    User = (User === undefined) ? '' : User;
    var Profession = $('#idCarrera').val();
    Profession = (Profession === undefined) ? '' : Profession;
    var Nombres = $('#inputNombres').val();
    Nombres = (Nombres === undefined) ? '' : Nombres;
    var APaterno = $('#inputAPaterno').val();
    APaterno = (APaterno === undefined) ? '' : APaterno;
    var AMaterno = $('#inputAMaterno').val();
    AMaterno = (AMaterno === undefined) ? '' : AMaterno;
    var Dni = $('#inputDNI').val();
    Dni = (Dni === undefined) ? '' : Dni;
    var objGrid = {
        div: 'tableStudentProfession',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'usuariocarrera;usuario;personal;carrera',
        colNames: ['', 'CARRERA', 'NOMBRES', 'A.PATERNO', 'A.MATERNO', 'DNI'],
        colModel: [
            {name: 'idUsuarioCarrera', index: '0', align: 'left'},
            {name: 'carDescripcion', index: '3'},
            {name: 'prsNombre', index: '2'},
            {name: 'prsApellidoPaterno', index: '2'},
            {name: 'prsApellidoMaterno', index: '2'},
            {name: 'prsDNI', index: '2'}
        ],
        join: {
            type: 'inner;inner;inner',
            on: 'u0.idUsuario=u1.idUsuario;u1.idPersonal=p2.idPersonal;u0.idCarrera=c3.idCarrera'
        },
        where: {
            fields: 'u0.idCarrera;u0.idUsuario;p2.prsNombre;p2.prsApellidoPaterno;p2.prsApellidoMaterno;p2.prsDNI;u1.idPerfil',
            logical: '=;=;like;like;like;like;=',
            values: Profession + ';' + User + ';' + Nombres + '%;' + APaterno + '%;' + AMaterno + '%;' + Dni + '%;2'
        },
        page: 1,
        rowNum: 100,
        sortName: 'u0.idUsuarioCarrera',
        sortOrder: 'desc',
        title: 'ESTUDIANTES',
        file: 'attachFile(this.id)'
    };
    loadGrid(objGrid);
    $('.tableStudentProfession div.widget-head div.widget-icons.pull-right button.btn.btn-sm.btn-info').remove();
}

function attachFile(_id) {
    var url = baseHTTP + 'controller/__usuarioCarrera.php?action=attachFileSerach&idUsuarioCarrera=' + _id;
    var personalFile = jqueryAjax(url, false, '');
    var objPersonalFile = jQuery.parseJSON(personalFile);
    $('#idUsuarioCarreraFile').val(objPersonalFile.idUsuarioCarrera);
    $('#inputNombresFile').val(objPersonalFile.prsApellidoPaterno + ' ' + objPersonalFile.prsApellidoMaterno + ', ' + objPersonalFile.prsNombre);
    $('#inputCarreraFile').val(objPersonalFile.carDescripcion);
    $('#inputDNIFile').val(objPersonalFile.prsDNI);

    $('#filterStudentProfession').fadeOut();
    $('.tableStudentProfession').fadeOut();
    $('#filesProfession').fadeIn();
    gridStundentFiles();
}

function saveFileStudent(_form) {
    validateFileStudent();
}

function validateFileStudent() {
    if ($('#idUsuarioCarreraFile').val() != '') {
        if (validateFormControl('uploadFile', 'file', false, false, 'Seleccione un archivo y/o asegúrese que el nombre del archivo no posea caracteres extraños.')) {
            $('#errorFile').remove();
            if (validateFormControl('inputTypeFile', 'empty', false, false, 'Seleccione una opción')) {
                return true;
            }
        } else {
            $('#errorFile').remove();
            var divUploadFile = $('#uploadFile').parent().parent();
            divUploadFile.append('<span id="errorFile" style="padding:10px;" class="label label-info">Seleccione un archivo y/o asegúrese que el nombre del archivo no posea caracteres extraños.</span>');
            return false;
        }
    } else {
        openPopUp('Advertencia', 'Error, no se encontró estudiante seleccionado.', '', '', '');
        return false;
    }
}

function beginFileUploadComponent() {
    $('#uploadFile').val('');
    $('#fileuploadPersonal').change(function () {
        $('#uploadFile').val(this.value);
    });
    $('#fileuploadPersonal').fileupload({
        dataType: 'json',
        add: function (e, data) {
            $('#inputFileUpload').addClass('disabled');
            $('#inputClearFileUpload').removeClass('disabled');
            $("#saveFilePersonal").on('click', function () {
                if (validateFileStudent()) {
                    var s = data.submit();
                }
            });
        },
        beforeSend: function () {
            $('#saveFilePersonal').html('<span class="fa fa-refresh fa-spin"></span> Guardar');
            $('#backgroundLock').fadeIn();
        },
        done: function (e, data) {
            var f = data.result;
            f = f.files[0];
            var idUsuarioCarrera = $('#idUsuarioCarreraFile').val();
            var tipo = $('#inputTypeFile').val();
            var _fName = f.name;
            var _fSize = f.size;
            var _fType = f.type;
            var _fUrl = f.url;
            var _fDeleteUrl = f.deleteUrl;
            var urlData = baseHTTP + 'controller/__archivo.php?action=save&_fName=' + _fName + '&_fSize=' + _fSize + '&_fType=' + _fType + '&_fUrl=' + _fUrl + '&_fDeleteUrl=' + _fDeleteUrl + '&_id=' + idUsuarioCarrera + '&_tipo=' + tipo;
            var resultUpload = jqueryAjax(urlData, false, '');
            if (resultUpload == 'success') {
                openPopUp('Archivo guardado', 'El archivo se cargó con éxito.', 'resultUpload(true);', '', '');
            } else {
                openPopUp('Archivo no guardado', 'El archivo no pudo guardarse, vuelva a intentarlo. Si el problema persiste, comuníquese con el área de sistemas.', 'resultUpload(false);', '', '');
            }
        }
    });
}

function resultUpload(_result) {
    gridStundentFiles();
    if (_result == true) {
        var emptyFileInpu = '<button id="saveFilePersonal" name="saveFilePersonal" type="button" class="btn btn-sm btn-info" onclick="saveFileStudent(\'Zm9ybUF0dGFjaEZpbGVQZXJzb24=\')">Guardar</button>';
        $('.clearFileInput').html(emptyFileInpu);
        beginFileUploadComponent();
        $('#inputTypeFile').val($('#inputTypeFile').prop('defaultSelected'));
    }
    $('#inputFileUpload').removeClass('disabled');
    $('#inputClearFileUpload').addClass('disabled');
    $('#backgroundLock').fadeOut();
    $('#saveFilePersonal').html('Guardar');
    closePopUp();
}

function gridStundentFiles() {
    var Student = $('#idUsuarioCarreraFile').val();
    Student = (Student === '') ? 'undefined' : Student;
    var objGrid = {
        div: 'tableStundentFiles',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'archivo',
        colNames: ['', 'DOCUMENTO', 'NOMBRE', 'DESCARGAR', 'TAMAÑO', 'TIPO'],
        colModel: [
            {name: 'idArchivo', align: 'left'},
            {name: 'rchTipoDesc'},
            {name: 'rchFileName'},
            {name: 'rchFileUrl'},
            {name: 'rchFileSize'},
            {name: 'rchFileType'}
        ],
        where: {
            fields: 'idUsuarioCarrera;rchIndicador',
            logical: '=;<>',
            values: Student + ';0'
        },
        page: 1,
        rowNum: 10,
        sortName: 'idArchivo',
        sortOrder: 'desc',
        title: 'ARCHIVOS',
        file: ''
    };
    loadGrid(objGrid);
    $('.tableStundentFiles div.widget-head div.widget-icons.pull-right button.btn.btn-sm.btn-info').remove();
}

function backToSearch(){
    clearForm('Zm9ybUF0dGFjaEZpbGVQZXJzb24=');
    $('#filterStudentProfession').fadeIn();
    $('.tableStudentProfession').fadeIn();
    gridStundentFiles();
    $('#filesProfession').fadeOut();
}
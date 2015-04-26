$(document).ready(function () {
    comboboxUbigeo();
    gridStudent();
    searchDataInscripcion();
});

function validatePersonal() {
    if (validateFormControl('inputName', 'text', true, true, 'Nombres no válidos.')) {
        if (validateFormControl('inputFName', 'text', true, true, 'Apellidos no válidos.')) {
            if (validateFormControl('inputMName', 'text', true, true, 'Apellidos no válidos.')) {
                if (validateFormControl('inputDNI', 'dni', true, true, 'DNI no válido.')) {
                    if (validateDuplicate('inputDNI', 'personal', 'prsDNI', 'idPersonal', 'idPersonal')) {
                        if (validateFormControl('inputTelefono', 'telephone', true, true, 'Teléfono no válido.')) {
                            if (validateDuplicate('inputTelefono', 'personal', 'prsTelefono', 'idPersonal', 'idPersonal')) {
                                if (validateFormControl('inputEmail', 'mail', true, true, 'Correo no válido.')) {
                                    if (validateDuplicate('inputEmail', 'personal', 'prsCorreo', 'idPersonal', 'idPersonal')) {
                                        if (validateFormControl('idUbigeo', 'number', false, false, 'Ubigeo no válido.')) {
                                            if (validateFormControl('inputDireccion', 'address', true, true, 'Dirección no válida')) {
                                                if (validateFormControl('inputSexo', 'char', true, true, 'Sexo no válido')) {
                                                    if (validateFormControl('inputEstadoCivil', 'number', true, true, 'Estado civil no válido')) {
                                                        if (validateFormControl('inputFNacimiento', 'date', true, true, 'Fecha no válida')) {
                                                            if (validateFormControl('inputNacionalidad', 'number', true, true, 'Nacionalidad no válida')) {
                                                                if (validateFormControl('inputUsuario', 'user', true, true, 'Usuario no válido')) {
                                                                    if (validateDuplicate('inputUsuario', 'usuario', 'usrNombre', 'idUsuario', 'idUsuario')) {
                                                                        if (validateFormControl('inputPassword', 'password', true, true, 'Contraseña no válida.')) {
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
                            }
                        }
                    }
                }
            }
        }
    }
}

function completeUser() {
    var first = $.trim($('#inputName').val()).slice(0, 1);
    var middle = $.trim($('#inputFName').val());
    var last = $.trim($('#inputMName').val()).slice(0, 1);
    var user = first + middle + last;
    user = skipAccent(user);
    $('#inputUsuario').val(user.toLowerCase());
}

function completePassword() {
    var first = $.trim($('#inputName').val()).slice(0, 1);
    var middle = $.trim($('#inputFName').val()).slice(0, 1);
    var last = $.trim($('#inputMName').val()).slice(0, 1);
    var dni = $.trim($('#inputDNI').val()).slice(4, 8);
    var password = first.toUpperCase() + middle.toLowerCase() + last.toLowerCase() + dni;
    password = skipAccent(password);
    $('#inputPassword').val(password);
}

function comboboxUbigeo() {
    $('#idUbigeo option[value!=""]').remove();
    var url = baseHTTP + 'controller/__ubigeo.php?action=combobox';
    var res = jqueryAjax(url, false, '');
    res = jQuery.parseJSON(res);
    for (i = 0; i < res.length; i++) {
        $('#idUbigeo').append(new Option(res[i].descripcion, res[i].idUbigeo));
    }
    $('#idUbigeo').select2({width: '100%'});
}

function gridStudent() {
    var objGrid = {
        div: 'tableStudent',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'personal',
        colNames: ['#', 'NOMBRES', 'APE. PATERNO', 'APE. MATERNO', 'DNI', 'NÚMERO', 'CORREO'],
        colModel: [
            {name: 'idPersonal', align: 'center'},
            {name: 'prsNombre'},
            {name: 'prsApellidoPaterno'},
            {name: 'prsApellidoMaterno'},
            {name: 'prsDNI'},
            {name: 'prsTelefono'},
            {name: 'prsCorreo'}
        ],
        page: 1,
        rowNum: 10,
        sortName: 'idPersonal',
        sortOrder: 'asc',
        title: 'Alumnos',
        edit: 'editStudent(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);
}

//function editStudent(id) {
//    var url = baseHTTP + 'controller/__personal.php?action=find&idPersonal=' + id;
//    var result = jqueryAjax(url, false, '');
//    var personal = jQuery.parseJSON(result);
//
//    $('#idPersonal').val(personal.idPersonal);
//    $('#prsNombre').val(personal.prsNombre);
//    $('#prsApellidoPaterno').val(personal.prsApellidoPaterno);
//    $('#prsApellidoMaterno').val(personal.prsApellidoMaterno);
//    $('#prsDNI').val(personal.prsDNI);
//    $('#prsCorreo').val(personal.prsCorreo);
//    $('#prsTelefono').val(personal.prsTelefono);
//    $('#idUbigeo').select2('val', personal.idUbigeo);
//    $('#idUsuario').val(personal.idUsuario);
//    $('#usrNombre').val(personal.usrNombre);
//    $('#usrClave').val('C0ntrasen4');
//    $('#usrClave2').val('C0ntrasen4');
//}

function searchDataInscripcion() {
    var id = $_GET('id');
    var url = baseHTTP + 'controller/__inscripcion.php?action=searchData&id=' + id;
    var dataInscripcion = jqueryAjax(url, false, '');
    var jsonInscripcion = $.parseJSON(dataInscripcion);
    //var jsonInscripcion = jQuery.parseJSON();    
    $('#inputName').val(jsonInscripcion.insNombres);
    $('#inputFName').val(jsonInscripcion.insApellidoPaterno);
    $('#inputMName').val(jsonInscripcion.insApellidoMaterno);
    $('#inputDNI').val(jsonInscripcion.insDNI);
    $('#inputEmail').val(jsonInscripcion.insCorreo);
    $('#inputTelefono').val(jsonInscripcion.insTelefono);
    $('#idUbigeo').select2('val', jsonInscripcion.idUbigeo);
    $('#inputDireccion').val(jsonInscripcion.insDireccion);
    $('#inputSexo').val(jsonInscripcion.insSexo);
    $('#inputEstadoCivil').val(jsonInscripcion.insEstadoCivil);
    var FNacimiento = jsonInscripcion.insFNacimiento.split('-');
    jsonInscripcion.insFNacimiento = FNacimiento[2] + '-' + FNacimiento[1] + '-' + FNacimiento[0];
    $('#inputFNacimiento').val(jsonInscripcion.insFNacimiento);
    $('#inputNacionalidad').val(jsonInscripcion.insNacionalidad);
    completeUser();
    completePassword();
}
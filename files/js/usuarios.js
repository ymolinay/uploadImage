$(document).ready(function () {
    gridUsuarios();
});
function editUsuario(id) {
    var url = baseHTTP + 'controller/__personal.php?action=find&idPersonal=' + id;
    var result = jqueryAjax(url, false, '');
    var personal = jQuery.parseJSON(result);
    var objForm = {
        title: 'EDITAR USUARIO',
        userId: personal.idPersonal,
        userName: personal.prsNombre,
        userFName: personal.prsApellidoPaterno,
        userMName: personal.prsApellidoMaterno,
        userDNI: personal.prsDNI,
        userEmail: personal.prsCorreo,
        userTelefono: personal.prsTelefono,
        user: personal.usrNombre,
        userPassword: 'C0ntrasen4',
        userIdUser: personal.idUsuario
    };
    formUsuarios(objForm);
    comboboxUbigeo();
    $("#idUbigeo option[value=" + personal.idUbigeo + "]").attr("selected", true);
    $("#idPerfil option[value=" + personal.idPerfil + "]").attr("selected", true);
    $("#idAcceso option[value=" + personal.usrIndicador + "]").attr("selected", true);
    $('#inputPassword').attr('type', 'Password');
    $("#inputPassword").attr('disabled', 'disabled');
}

function activatePassword() {
    if ($("#chkPassword").is(':checked')) {
        $('#inputPassword').attr('type', 'text');
        $("#inputPassword").removeAttr('disabled');
        $("#inputPassword").val('');
    } else {
        $('#inputPassword').attr('type', 'Password');
        $("#inputPassword").attr('disabled', 'disabled');
        $("#inputPassword").val('C0ntrasen4');
    }
}


function newForm() {
    var objForm = {
        title: 'NUEVO USUARIO', userId: '', userName: '', userFName: '', userMName: '', userDNI: '', userEmail: '', userTelefono: '', user: '', userPassword: '', userIdUser: ''
    };
    formUsuarios(objForm);
    comboboxUbigeo();
}

function comboboxUbigeo() {
    //$('#idUbigeo option[value!=""]').remove();
    var url = baseHTTP + 'controller/__ubigeo.php?action=combobox';
    var res = jqueryAjax(url, false, '');
    res = jQuery.parseJSON(res);
    for (i = 0; i < res.length; i++) {
        var data = res[i];
        $('#idUbigeo').append(new Option(data.descripcion, data.idUbigeo));
    }
}

function cerrarForm() {
    /*$(".matter .container .row").remove();
     $(".matter .container").append('<div class="tableUsuarios widget"></div>');
     gridUsuarios();*/
    location.reload();
    //<a href="usuarios.php" class="bread-current">Usuarios</a>
}

function completeUser() {
    var first = $.trim($('#inputName').val()).slice(0, 1);
    var middle = $.trim($('#inputFName').val());
    var last = $.trim($('#inputMName').val()).slice(0, 1);
    var user = first + middle + last;
    $('#inputUsuario').val(user.toLowerCase());
}

function completePassword() {
    var first = $.trim($('#inputName').val()).slice(0, 1);
    var middle = $.trim($('#inputFName').val()).slice(0, 1);
    var last = $.trim($('#inputMName').val()).slice(0, 1);
    var user = first + middle + last;
    var dni = $.trim($('#inputDNI').val()).slice(4, 8);
    user = user.toLowerCase();
    var long = user.length;
    var password = user.slice(0, 1).toUpperCase() + user.slice(1, long).toLowerCase() + dni;
    $('#inputPassword').val(password);
}

function formUsuarios(objForm) {
    $(".tableUsuarios").remove();
    var title = objForm.title;
    userId = objForm.userId;
    userName = objForm.userName;
    userFName = objForm.userFName;
    userMName = objForm.userMName;
    userDNI = objForm.userDNI;
    userEmail = objForm.userEmail;
    userTelefono = objForm.userTelefono;
    user = objForm.user;
    userPassword = objForm.userPassword;
    userIdUser = objForm.userIdUser;
    var form = '<div class="row"><div class="col-md-8"><div class="widget wgreen"><div class="widget-head"><div class="pull-left">' + title + '</div><div class="widget-icons pull-right"><button onclick="cerrarForm()" type="button" class="btn btn-sm btn-info">Cerrar</button></div><div class="clearfix"></div></div><div class="widget-content"><div class="padd">';
    form += '<form id="formPersonal" name="formPersonal" class="form-horizontal" role="form" >';
    form += '<input id="idPersonal" name="idPersonal" type="text" class="notVisible" value="' + userId + '" >';
    form += '<input id="userType" name="userType" type="text" class="notVisible" value="dXN1YXJpbw==">';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Nombres</label>';
    form += '<div class="col-lg-7">';
    form += '<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombres" value="' + userName + '"  onkeyup="completeUser();">';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Apellido Paterno</label>';
    form += '<div class="col-lg-7">';
    form += '<input type="text" class="form-control" id="inputFName" name="inputFName" placeholder="Apellido Paterno" value="' + userFName + '"  onkeyup="completeUser();">';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Apellido Materno</label>';
    form += '<div class="col-lg-7">';
    form += '<input type="text" class="form-control" id="inputMName" name="inputMName" placeholder="Apellido Materno" value="' + userMName + '"  onkeyup="completeUser();">';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">D.N.I</label>';
    form += '<div class="col-lg-4">';
    form += '<input type="text" class="form-control" id="inputDNI" name="inputDNI" placeholder="DNI" value="' + userDNI + '"  maxlength="8" onkeyup="completePassword();">';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Email</label>';
    form += '<div class="col-lg-7">';
    form += '<input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="usuario@dominio" value="' + userEmail + '">';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Teléfono</label>';
    form += '<div class="col-lg-5">';
    form += '<input type="text" class="form-control" id="inputTelefono" name="inputTelefono" placeholder="Fijo/Movil" value="' + userTelefono + '">';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Ubigeo</label>';
    form += '<div class="col-lg-7">';
    form += '<select id="idUbigeo" name="idUbigeo" class="form-control">';
    form += '<option>-- SELECCIONAR --</option>';
    form += '</select>';
    form += '</div>';
    form += '</div>';
    form += '<input id="idUsuario" name="idUsuario" type="text" class="notVisible" value="' + userIdUser + '" >';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Usuario</label>';
    form += '<div class="col-lg-5">';
    form += '<input type="text" class="form-control" id="inputUsuario" name="inputUsuario" placeholder="Usuario" value="' + user + '" >';
    form += '</div>';
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Contraseña</label>';
    form += '<div class="col-lg-5">';
    form += '<input type="text" class="form-control" id="inputPassword" name="inputPassword" placeholder="Contraseña" value="' + userPassword + '" >';
    form += '</div>';
    if (userIdUser != '') {
        form += '<div class="col-lg-9 col-lg-offset-3">';
        form += '<div class="checkbox">';
        form += '<label>';
        form += '<input id="chkPassword" type="checkbox" onclick="activatePassword()"> Cambiar';
        form += '</label>';
        form += '</div>';
        form += '</div>';
    }
    form += '</div>';
    form += '<div class="form-group">';
    form += '<label class="col-lg-3 control-label">Perfil</label>';
    form += '<div class="col-lg-5">';
    form += '<select id="idPerfil" name="idPerfil" class="form-control">';
    form += '<option value="1">ADMINISTRADOR</option>';
    form += '<option value="2">ALUMNO</option>';
    form += '<option value="3">ADMINISTRATIVO</option>';
    form += '<option value="4">DOCENTE</option>';
    form += '</select>';
    form += '</div>';
    form += '</div>';
    if (userIdUser != '') {
        form += '<div class="form-group">';
        form += '<label class="col-lg-3 control-label">Bloquear Acceso</label>';
        form += '<div class="col-lg-2">';
        form += '<select id="idAcceso" name="idAcceso" class="form-control">';
        form += '<option value="1">NO</option>';
        form += '<option value="2">SI</option>';
        form += '</select>';
        form += '</div>';
        form += '</div>';
    }
    form += '<div class="col-lg-8 col-lg-offset-3">';
    form += '<button type="button" class="btn btn-info btn-sm" onclick=javascript:confirmSave("cGVyc29uYWw=","Zm9ybVBlcnNvbmFs","location.reload();","") >Registrar</button>&nbsp;';
    form += '<button type="reset" class="btn btn-default btn-sm" >Limpiar</button>';
    form += '</div><br />';
    form += '</form>';
    form += '</div></div></div></div></div>';
    $(".matter .container").html(form);
}

function gridUsuarios() {
    var objGrid = {
        div: 'tableUsuarios',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'personal',
        colNames: ['', 'NOMBRES', 'APE. PATERNO', 'APE. MATERNO', 'DNI', 'NÚMERO', 'CORREO'],
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
        title: 'USUARIOS',
        edit: 'editUsuario(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);
}

function validatePersonal() {
    if (validateFormControl('inputName', 'text', true, true, 'Nombres no válidos.')) {
        if (validateFormControl('inputFName', 'text', true, true, 'Apellidos no válidos.')) {
            if (validateFormControl('inputMName', 'text', true, true, 'Apellidos no válidos.')) {
                if (validateFormControl('inputDNI', 'dni', true, true, 'DNI no válido.')) {
                    if (validateDuplicate('inputDNI', 'personal', 'prsDNI', 'idPersonal', 'idPersonal')) {

                        if (validateFormControl('inputEmail', 'mail', true, true, 'Correo no válido.')) {
                            if (validateDuplicate('inputEmail', 'personal', 'prsCorreo', 'idPersonal', 'idPersonal')) {
                                if (validateFormControl('inputTelefono', 'telephone', true, true, 'Teléfono no válido.')) {
                                    if (validateDuplicate('inputTelefono', 'personal', 'prsTelefono', 'idPersonal', 'idPersonal')) {

                                        if (validateFormControl('idUbigeo', 'number', false, false, 'Ubigeo no válido.')) {

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

function searchUsuarios() {
    var Name = $("#inputName").val();
    var FName = $("#inputFName").val();
    var MName = $("#inputFName").val();
    var idPerfil = $("#idPerfil").val();
    var objGrid = {
        div: 'tableUsuarios',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'personal;usuario',
        colNames: ['', 'NOMBRES', 'APE. PATERNO', 'APE. MATERNO', 'DNI', 'NÚMERO', 'CORREO'],
        colModel: [
            {name: 'idPersonal', index: '0', align: 'center'},
            {name: 'prsNombre', index: '0'},
            {name: 'prsApellidoPaterno', index: '0'},
            {name: 'prsApellidoMaterno', index: '0'},
            {name: 'prsDNI', index: '0'},
            {name: 'prsTelefono', index: '0'},
            {name: 'prsCorreo', index: '0'}
        ],
        join: {
            type: 'inner',
            on: 'p0.idpersonal=u1.idpersonal'
        },
        where: {
            fields: 'prsNombre;prsApellidoPaterno;prsApellidoMaterno;u1.idperfil',
            logical: 'like;like;like;=',
            values: '%' + Name + '%;%' + FName + '%;%' + MName + '%;' + idPerfil
        },
        page: 1,
        rowNum: 5,
        sortName: 'idPersonal',
        sortOrder: 'asc',
        title: 'USUARIOS',
        edit: 'editStudent(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);

}
$(document).ready(function() {
    $("#btnlogin").click(function() { logIn();});
    $("#inputUser").keyup(function(event) {
        if (event.which == 13) { logIn();}
    });
    $("#inputPassword").keyup(function(event) {
        if (event.which == 13) { logIn();}
    });
    verifyRequest();
});

function validateLogin(){
    if (validateFormControl('inputUser', 'user', true, true, 'Usuario inválido.')) {
        if (validateFormControl('inputPassword', 'password', true, true, 'Contraseña inválida.')) {
            return true;
        }
    }
}

function logIn() {
    if (validateLogin()) {
        var div = 'message';
        var user = base64_encoding($('#inputUser').val());
        var pass = base64_encoding($('#inputPassword').val());
        var url = baseHTTP + "controller/__usuario.php?action=login&txtuser=" + user + "&txtpassword=" + pass;
        $("." + div).html("");
        result = jqueryAjax(url, true, div);
        if (result === "success") {
            var time = base64_encoding(myTime());
            var date = base64_encoding(myDate());
            url = baseHTTP + "controller/__accesos.php?action=login&time=" + time + "&date=" + date;
            result2 = jqueryAjax(url, false, div);
            if (result2 === "success") {
                href("principal.php");
            } else {
                $("." + div).html("<div class='error'>Error al ingresar al sistema, <a href='mailto:soporte@intranet.perucatolica.com'>Contáctenos</a>.</div>");
                $("#txtuser").select();
                $("#txtuser").focus();
            }
        } else {
            $("." + div).html("<div class='error'>Usuario o contraseña incorrecta.</div>");
            $("#txtuser").select();
            $("#txtuser").focus();
        }
    }
}

function logOut() {
    var time = base64_encoding(myTime());
    var date = base64_encoding(myDate());
    var url = "../controller/__accesos.php?action=logout&time=" + time + "&date=" + date;
    var result = jqueryAjax(url, false, "");
    if (result === "success") { $(location).attr("href", "login.php");}
    else {
		var body = '';
    	openPopUp('Error en el servidor, presione F5', body, '');
	}
}

function recoverPassword() {
    var body = '<div class="recover"><input type="text" class="form-control" id="txtCorreo" name="txtCorreo" value="" placeholder="Ingrese correo"/></div>';
    openPopUp('Solicitar contraseña', body, 'sendRecoverPassword();');
}

function sendRecoverPassword() {
    if (validateFormControl('txtCorreo', 'mail', true, true, 'Correo no válido')) {
        var mail = $('#txtCorreo').val();
        var url = baseHTTP + 'controller/' + base64_decoding('X19wZXJzb25hbA==') + '.php?action=recover&mail=' + mail;
        var result = jqueryAjax(url, true, 'recover');
        if (result === 'success') {
            var url = baseHTTP + 'controller/' + base64_decoding('X19wZXJzb25hbA==') + '.php?action=sendRecover&mail=' + mail;
            var result2 = jqueryAjax(url, true, 'recover');

            var message = '';

            switch (result2) {
                case 'notFound':
                    //datos no encontrados
                    message = 'Error al buscar los datos, inténtelo de nuevo.';
                    break;
                case 'fail':
                    //error al insertar la solicitud
                    message = 'Error al ejecutar la solicitud, inténtelo de nuevo.';
                    break;
                case 'senderror':
                    //error al enviar correo
                    message = 'Error al enviar la solicitud por correo, inténtelo de nuevo.';
                    break;
                case 'send':
                    //ningún error
                    message = 'Mensaje enviado con éxito, revise su correo.';
                    break;
                default :
                    message = 'Error al procesar la solicitud.';
                    break;
            }
            $('.recover').html(message);
            $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();">Salir</button>');
        } else {
            $('.recover').html('<strong>Correo no registrado</strong> en el sistema, Comuniquese con el administrador.');
            $('.modal-footer').html('<button id="confirm" class="btn btn-info btn-sm" type="button" onclick="closePopUp();">Salir</button>');
        }
    } else {
        $('#confirm').attr("disabled", false);
    }
}

function verifyRequest() {
    var action = $_GET('action');
    var c1 = $_GET('c1');
    var c2 = $_GET('c2');
    var idp = $_GET('idp');
    var us = $_GET('us');
    var idu = $_GET('idu');
    if (action === 'reset') {
        var url = baseHTTP + 'controller/__recuperarclave.php?action=' + action + '&c1=' + c1 + '&c2=' + c2 + '&idp=' + idp + '&us=' + us + '&idu=' + idu;
        var User = jqueryAjax(url, false, '');
        //result = $.getJSON(url);
        //result=JSON.parse(result);
        User = jQuery.parseJSON(User);

        var body = "<div class='recoverMessage'>";
        body += "<form id='formRecover' name='formRecover' class='form-horizontal' role='form'>";
        body += "<div class='form-group has-feedback'>";
        body += "<label for='txtRUser' class='hidden-xs col-sm-3'>Usuario</label>";
        body += "<div class='col-xs-12 col-sm-9'>";
        body += "<input type='hidden' class='form-control' id='txtRidUser' name='txtRidUser' value='" + User.idUser + "' readonly='readonly' />";
        body += "<input type='text' class='form-control' id='txtRUser' name='txtRUser' value='" + User.user + "' placeholder='Usuario' data-toggle='tooltip' readonly='readonly' />";
        body += "</div>";
        body += "</div>";
        body += "<div class='form-group has-feedback'>";
        body += "<label for='txtRContrasena' class='hidden-xs col-sm-3'>Contraseña</label>";
        body += "<div class='col-xs-12 col-sm-9'>";
        body += "<input type='password' class='form-control' id='txtRContrasena' name='txtRContrasena' value='' placeholder='Contraseña' data-toggle='tooltip' />";
        body += "</div>";
        body += "</div>";
        body += "<div class='form-group has-feedback'>";
        body += "<label for='txtRContrasena2' class='hidden-xs col-sm-3'>Ubigeo</label>";
        body += "<div class='col-xs-12 col-sm-9'>";
        body += "<input type='password' class='form-control' id='txtRContrasena2' name='txtRContrasena2' value='' placeholder='Repetir contraseña' data-toggle='tooltip' />";
        body += "</div>";
        body += "</div>";
        body += "</form>";
        body += "</div>";
        openPopUp('Cambiar contraseña', body, '','changePassword();');
    }
}

function validateChangePassword() {
    if (validateFormControl('txtRContrasena', 'password', true, true, 'Contraseña no válida.')) {
        if (validateFormControl('txtRContrasena2', 'password', true, true, 'Contraseñas no válida.')) {
            if ($('#txtRContrasena').val() === $('#txtRContrasena2').val()) {
                $('#txtRContrasena').parent().parent().removeClass('has-error');
                $('#txtRContrasena').tooltip('destroy');
                $('#txtRContrasena2').parent().parent().removeClass('has-error');
                $('#txtRContrasena2').tooltip('destroy');
                $("span[id='iconRemove']").remove();
                return true;
            } else {
                $('#txtRContrasena').parent().parent().addClass('has-error');
                $('#txtRContrasena').after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
                $('#txtRContrasena').tooltip({title: 'Contraseñas no coinciden.'});
                $('#txtRContrasena').tooltip('show');
                $('#txtRContrasena2').parent().parent().addClass('has-error');
                $('#txtRContrasena2').after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
                $('#txtRContrasena2').tooltip({title: 'Contraseñas no coinciden.'});
                $('#txtRContrasena2').tooltip('show');
            }
        }
    }
}

function changePassword() {
    if(validateChangePassword()){
        var data = getForm(base64_encoding('formRecover'));
        var url = baseHTTP + "controller/__usuario.php?action=changePassword&" + data;
        var result = jqueryAjax(url, true, 'recoverMessage');
        if (result === 'success') {
            message = 'Éxito al cambiar la contraseña ';
        } else {
            message = 'Error al cambiar la contraseña';
        }
        $('.recoverMessage').html(message);
        $('.modal-footer').html('<button id="confirm" class="btn btn-primary" type="button" onclick="closePopUp();" style="border-radius: 0px"><span class="glyphicon glyphicon-ok"></span> OK</button>');
    }else{
        $('#save').attr("disabled", false);
    }
}
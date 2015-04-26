$(document).ready(function () {
	findUsuario();
});

function findUsuario(){
	var id = $("#idPersonal").val();
	var url = baseHTTP + 'controller/__personal.php?action=find&idPersonal='+base64_encoding(id);
	var result = jqueryAjax(url, false, '');
    var personal = jQuery.parseJSON(result)
	$("#userName").html(personal.prsApellidoPaterno +' '+ personal.prsApellidoMaterno +', '+ personal.prsNombre);
	$("#userDNI").html(personal.prsDNI);
	$("#userEmail").html(personal.prsCorreo);
	$("#userTelefono").html(personal.prsTelefono);
	comboboxUbigeo();
	$("#idUbigeo option[value="+ personal.idUbigeo +"]").attr("selected",true);
	$("#userUbigeo").html($("#idUbigeo option:selected").text());
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

function validatePersonal(){
 	if (validateFormControl('inputPassword', 'password', true, true, 'Contraseña no válida.')) {
    	if (validateFormControl('inputRPassword', 'password', true, true, 'Contraseña no válida.')) {
			if ($('#inputPassword').val() === $('#inputRPassword').val()) {
				$('#inputPassword').parent().parent().removeClass('has-error');
				$('#inputPassword').tooltip('destroy');
				$('#inputRPassword').parent().parent().removeClass('has-error');
				$('#inputRPassword').tooltip('destroy');
				$("span[id='iconRemove']").remove();
			return true;
			} else {
			$('#inputPassword').parent().parent().addClass('has-error');
			$('#inputPassword').after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			$('#inputPassword').tooltip({title: 'Contraseñas no coinciden.'});
			$('#inputPassword').tooltip('show');
			$('#inputRPassword').parent().parent().addClass('has-error');
			$('#inputRPassword').after('<span id="iconRemove" class="glyphicon glyphicon-remove form-control-feedback"></span>');
			$('#inputRPassword').tooltip({title: 'Contraseñas no coinciden.', placement: 'bottom'});
			$('#inputRPassword').tooltip('show');
			}
        }
	}
}

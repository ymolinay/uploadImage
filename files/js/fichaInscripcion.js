$(function() {
    $('#insFNacimiento').datetimepicker({
      pickTime: false
    });
	
	comboboxUbigeo();
	//comboboxCarrera();
});

function validateOtros()
{
	if($("#marRespuesta6").is(':checked')) { 
		$("#insObservacion").removeAttr('disabled');
	} 
	else{
		$("#insObservacion").attr('disabled','disabled');
		
		}	
	$("#insObservacion").val('');
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

function comboboxCarrera() {
    //$('#idUbigeo option[value!=""]').remove();
    var url = baseHTTP + 'controller/__carrera.php?action=combobox';
    var res = jqueryAjax(url, false, '');
    res = jQuery.parseJSON(res);
    for (i = 0; i < res.length; i++) {
        var data = res[i];
        $('#idCarrera').append(new Option(data.descripcion, data.idcarrera));
    }
}

function validateInscripcion(){
	if (validateFormControl('insNombre', 'text', true, true, 'Nombres no válidos.')) {
        if (validateFormControl('insApellidoPaterno', 'text', true, true, 'Apellidos no válidos.')) {
            if (validateFormControl('insApellidoMaterno', 'text', true, true, 'Apellidos no válidos.')) {
                if (validateFormControl('insDNI', 'dni', true, true, 'DNI no válido.')) {
                    if (validateDuplicate('insDNI', 'personal', 'prsDNI', 'idPersonal', 'idPersonal')) {
						if (validateFormControl('FNacimiento', 'date', true, true, 'Seleccione una fecha.')) {
						 if (validateFormControl('insDireccion', 'address', true, true, 'Dirección no valida.')) {
						 	if (validateFormControl('idUbigeo', 'number', false, false, 'Ubigeo no válido.')) {
								if (validateFormControl('insEmail', 'mail', true, true, 'Correo no válido.')) {
									if (validateDuplicate('insEmail', 'personal', 'prsCorreo', 'idPersonal', 'idPersonal')) 								{
										if (validateFormControl('insTelefono', 'telephone', true, true, 'Teléfono no válido.')) {
											if (validateFormControl('idUbigeo', 'number', false, false, 'Ubigeo no válido.')) {
												if (validateFormControl('idCarrera', 'number', false, false, 'Ubigeo no válido.')) {
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

function finalizarInscripcion(){
	var title = 'Finalizar Inscripción';
	var _body = '<div class="quest">¿Desea imprimir la Inscripción?</div>';
	var actionYes = "printInscripcion();";
	openPopUp(title, _body, actionYes);
}
function finalizarPago()
{
	var title = 'Procesar Pago';
	var _body = '<div class="quest">¿Desea imprimir comprobante?</div>';
	var actionYes = "printComprobante();";
	openPopUp(title, _body, actionYes);
}

function printComprobante(){
var t = $('#tdocumento').val();
	if(t==1){comprobante='comprobante.pdf';}
	if(t==2){comprobante='boleta.pdf';}
	if(t==3){comprobante='factura.pdf';}
	 var pdfURL = baseHTTP + 'files/PDF/'+comprobante; 
	window.open(pdfURL);
}
function printInscripcion(){
	 /*var url = baseHTTP + "controller/__inscripcion.php?action=print";
	 /*var idInscripcion = jqueryAjax(url, true, 'quest');
	 var detailHead = 'Fecha;Nombres;Apellido Paterno;Apellido Materno;DNI;Correo;Télefono;Dirección;Sexo;Estado Civil;Fecha de Nacimiento;Nacionalidad;Carrera';
	 var query ='select insFecha,insNombres,insApellidoPaterno,insApellidoMaterno,insDNI,insCorreo,insTelefono,insDireccion,insSexo,insEstadoCivil,insFNacimiento,insNacionalidad,idCarrera from inscripcion where idinscripcion='+idInscripcion;
	 var pdfURL = baseHTTP + "model/config/fpdf.class.php?position="+base64_encoding('P')+"&file="+base64_encoding('fichaInscripcion')+"&typeDocument="+base64_encoding('docOficial')+"&documentModel="+base64_encoding('FICHA INSCRIPCIÓN')+"&documentNumber="+base64_encoding(idInscripcion)+"&detailHead="+base64_encoding(detailHead)+"&query="+base64_encoding(query);//+"&query="+base64_encoding(query);  */ 
	 var pdfURL = baseHTTP + 'files/PDF/fichaInscripcion.pdf' 
	window.open(pdfURL);
	 //
	 /*
$_GET['query']title
$objPDF->set_detailHead(base64_decode($_GET['detailHead']));
$objPDF->set_detailCellSize(base64_decode($_GET['detailCellSize']));
$objPDF->set_detailAlign(base64_decode($_GET['detailAlign']));
$objPDF->set_detailTotal(base64_decode($_GET['total']));
*/
	 var title = 'Generar Matricula';
	var _body = '<div class="quest">¿Desea procesar la matricula?</div>';
	var actionYes = "javascript:window.location.assign('"+ baseHTTP + 'view/RegistrarAlumno.php?id=?' +"');";
	openPopUp(title, _body, actionYes);
}

	
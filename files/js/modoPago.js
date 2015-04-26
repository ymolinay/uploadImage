$(document).ready(function () {
    gridModoPago();
});

function gridModoPago() {
	var objGrid = {
		div: 'tableModoPago',
		url: baseHTTP + 'controller/__grid.php?action=loadGrid',
		table: 'modopago',
		colNames: ['', 'TIPO PAGO'],
		colModel: [
			{name: 'idModoPago', index: '0', align: 'center'},
			{name: 'mdpDescripcion', index: '0'}
		],
		page: 1,
		rowNum: 20,
		sortName: 'idModoPago',
		sortOrder: 'asc',
		title: 'MODOS DE PAGO',
		check: ""
	};
	loadGrid(objGrid);
	var _btn = '';
	$('.tableModoPago div.widget-head div.widget-icons.pull-right').html(_btn);
}

function validateModoPago() {
    if (validateFormControl('Descripcion', 'text', true, true, 'Ingresar una descripción.')) {
        return true;
    }
}
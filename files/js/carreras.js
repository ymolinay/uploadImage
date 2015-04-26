$(document).ready(function () {
    gridCarreras();
});

function gridCarreras() {
    var objGrid = {
        div: 'tableCarreras',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'carrera',
        colNames: ['', 'NOMBRE', 'CICLOS', 'MESES POR CICLO'],
        colModel: [
            {name: 'idCarrera', align: 'center'},
            {name: 'carDescripcion'},
            {name: 'carPeriodos'},
            {name: 'carMeses'}
        ],
        page: 1,
        rowNum: 5,
        sortName: 'idCarrera',
        sortOrder: 'desc',
        title: 'CARRERAS',
        edit: 'editCarrera(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);
}

function editCarrera(id) {
    var url = baseHTTP + 'controller/__carrera.php?action=find&idCarrera=' + id;
    var result = jqueryAjax(url, false, '');
    var carrera = jQuery.parseJSON(result);
    $('#inputIdCarrera').val(carrera.idCarrera);
    $('#inputDescripcion').val(carrera.descripcion);
    $('#inputPeriodos').val(carrera.periodos);
    $('#inputMeses').val(carrera.meses);
}

function newForm() {
    $('#inputIdCarrera').val('');
    $('#inputDescripcion').val('');
    $('#inputPeriodos').val('');
    $('#inputMeses').val('');
    $('#inputDescripcion').focus();
}

function validateCarrera() {
    if (validateFormControl('inputDescripcion', 'text', true, true, 'Nombre de Carrera no válido')) {
        if (validateFormControl('inputPeriodos', 'number', true, true, 'Periodo no válido')) {
            if (validateFormControl('inputMeses', 'number', true, true, 'Mes no válido')) {
                return true;
            }
        }
    }
}

function searchCarrera() {
    var descripcion = $("#inputDescripcion").val();
    var periodos = $("#inputPeriodos").val();
    var meses = $("#inputMeses").val();
    var objGrid = {
        div: 'tableCarreras',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'carrera',
        colNames: ['', 'NOMBRE', 'PERIODOS', 'MESES POR CICLO'],
        colModel: [
            {name: 'idCarrera', align: 'center'},
            {name: 'carDescripcion'},
            {name: 'carPeriodos'},
            {name: 'carMeses'}
        ],
        where: {
            fields: 'carDescripcion;carPeriodos,carMeses',
            logical: 'like;like;like',
            values: '%' + descripcion + '%;%' + periodos + '%'+ '%;%' + meses + '%'
        },
        page: 1,
        rowNum: 5,
        sortName: 'idCarrera',
        sortOrder: 'desc',
        title: 'CARRERAS',
        edit: 'editCarrera(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);

}
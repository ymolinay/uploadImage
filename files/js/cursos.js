$(document).ready(function () {
    gridCursos();
});

function gridCursos() {
    var objGrid = {
        div: 'tableCursos',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'curso',
        colNames: ['', 'NOMBRE'],
        colModel: [
            {name: 'idCurso', align: 'center'},
            {name: 'crsNombre'}
        ],
        page: 1,
        rowNum: 15,
        sortName: 'idCurso',
        sortOrder: 'desc',
        title: 'CURSOS',
        edit: 'editCursos(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);
}

function editCursos(id) {
    var url = baseHTTP + 'controller/__curso.php?action=find&idCurso=' + id;
    var result = jqueryAjax(url, false, '');
    var curso = jQuery.parseJSON(result);
    $('#inputIdCurso').val(curso.idCurso);
    $('#inputNombre').val(curso.nombre);
}

function newForm() {
    $('#inputIdCurso').val('');
    $('#inputNombre').val('');
    $('#inputNombre').focus();
}

function validateCurso() {
    if (validateFormControl('inputNombre', 'text', true, true, 'Nombre de Curso no válido')) {
        return true;
    }
}

function searchCurso() {
    var nombre = $("#inputNombre").val();
    var objGrid = {
        div: 'tableCursos',
        url: baseHTTP + 'controller/__grid.php?action=loadGrid',
        table: 'curso',
        colNames: ['', 'NOMBRE'],
        colModel: [
            {name: 'idCurso', align: 'center'},
            {name: 'crsNombre'}
        ],
        where: {
            fields: 'crsNombre',
            logical: 'like',
            values: '%' + nombre + '%'
        },
        page: 1,
        rowNum: 15,
        sortName: 'idCurso',
        sortOrder: 'desc',
        title: 'CURSOS',
        edit: 'editCursos(this.id);',
        delete: "openPopUp('Alerta','<p>Usted no posee permisos para realizar esta acción</p>','','');"
    };
    loadGrid(objGrid);
}
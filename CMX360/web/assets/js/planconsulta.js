oTable = $('#table-sm').DataTable({
    "sDom": '<l<t>ip>',
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

$('#plan_type_nombre').keyup(function(){
    oTable.search($(this).val()).draw()
});

$('#fechas').on('change',function () {
    var fecha = $(this).val();
    var date = formato(fecha);
    oTable.search(date).draw();
});

// $('#fecha').keyup(function(){
//     oTable.search($(this).val()).draw()
// });


aTable = $('#table-sm1').DataTable({
    "sDom": '<l<t>ip>',
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

$('#plan_type_revision').keyup(function(){
    aTable.search($(this).val()).draw()
});

$('#datepicker_from1').on('change',function () {
    var fecha = $(this).val();
    var date = formato(fecha);
    aTable.search(date).draw();
});

rTable = $('#table-sm2').DataTable({
    "sDom": '<l<t>ip>',
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

$('#plan_type_autorizado').keyup(function(){
    rTable.search($(this).val()).draw()
});

$('#datepicker_from2').on('change',function () {
    var fecha = $(this).val();
    var date = formato(fecha);
    rTable.search(date).draw();
});

acTable = $('#table-sm3').DataTable({
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

mTable = $('#table-sm4').DataTable({
    "sDom": '<l<t>ip>',
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

$('#plan_type_modificado').keyup(function(){
    mTable.search($(this).val()).draw()
});

$('#datepicker_from3').on('change',function () {
    var fecha = $(this).val();
    var date = formato(fecha);
    mTable.search(date).draw();
});

eTable = $('#table-sm5').DataTable({
    "sDom": '<l<t>ip>',
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

$('#plan_type_asignado').keyup(function(){
    eTable.search($(this).val()).draw()
});

$('#fechas1').on('change',function () {
    var fecha = $(this).val();
    var date = formato(fecha);
    eTable.search(date).draw();
});

vTable = $('#table-sm6').DataTable({
    "sDom": '<l<t>ip>',
    "paging": true,
    "bLengthChange": true,
    "language":{
        "decimal":        ".",
        "emptyTable":     "No hay Resultados que Coincidan con la Búsqueda",
        "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
        "infoFiltered":   "(Filtrado de _MAX_ registros)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrando _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "searchPlaceholder": "Ingresa el nombre del Plan",
        "zeroRecords":    "Sin Resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
        }
    }
});

$('#plan_type_ventas').keyup(function(){
    vTable.search($(this).val()).draw()
});

$('#fechasv').on('change',function () {
    var fecha = $(this).val();
    var date = formato(fecha);
    vTable.search(date).draw();
});

function formato(texto){
    return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}


// Date range filter
minDateFilter = "";
maxDateFilter = "";

$.fn.dataTableExt.afnFiltering.push(
    function(oSettings, aData, iDataIndex) {
        if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[0]).getTime();
        }

        if (minDateFilter && !isNaN(minDateFilter)) {
            if (aData._date < minDateFilter) {
                return false;
            }
        }



        return true;
    }
);



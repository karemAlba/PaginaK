$(document).ready(function() {
    oTable = $('#table').DataTable({
        "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false
            }
        ],
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

    $('#nombre').keyup(function(){
        oTable.search($(this).val()).draw()
    });

    $('#datepicker').on('change',function () {
        var fecha = $(this).val();
        var date = formato(fecha);
        oTable.search(date).draw();
    });

    oTable2 = $('#table2').DataTable({
        "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false
            }
        ],
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

    $('#nombre2').keyup(function(){
        oTable2.search($(this).val()).draw()
    });

    $('#datepicker2').on('change',function () {
        var fecha = $(this).val();
        var date = formato(fecha);
        oTable2.search(date).draw();
    });

    oTable3 = $('#table3').DataTable({
        "columnDefs": [
            {
                "targets": [ 5 ],
                "visible": false
            }
        ],
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

    $('#nombre3').keyup(function(){
        oTable3.search($(this).val()).draw()
    });

    $('#datepicker3').on('change',function () {
        var fecha = $(this).val();
        var date = formato(fecha);
        oTable3.search(date).draw();
    });
    function formato(texto){
        return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
    }
});
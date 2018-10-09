$(document).ready(function () {
    $('#table-sm').dataTable({
        "searching": false,
        "bLengthChange": false,
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
            "searchPlaceholder": "Buscar Persona",
            "zeroRecords":    "Sin Resultados",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        }
    });
    $('#campanaType_tipoCampana').append(new Option("Seleccione el Tipo", "null",true,true));
    $("#campanaType_tipoCampana option:selected").attr('disabled','disabled');
});
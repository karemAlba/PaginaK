$('#busqueda_type_marcas').append(new Option("Selecciona una marca", "null",true,true));
$("#busqueda_type_marcas option:selected").attr('disabled','disabled');

$('#busqueda_type_grupo').append(new Option("Selecciona un grupo", "null",true,true));
$("#busqueda_type_grupo option:selected").attr('disabled','disabled');

$('#busqueda_type_tipoCliente').append(new Option("Selecciona un cliente", "null",true,true));
$("#busqueda_type_tipoCliente option:selected").attr('disabled','disabled');

$('#busqueda_type_asociacion').append(new Option("Selecciona una asociación", "null",true,true));
$("#busqueda_type_asociacion option:selected").attr('disabled','disabled');

$('#busqueda_type_categorias').append(new Option("Selecciona una categoria", "null",true,true));
$("#busqueda_type_categorias option:selected").attr('disabled','disabled');

$('#busqueda_type_macrogrupos').append(new Option("Selecciona una unión", "null",true,true));
$("#busqueda_type_macrogrupos option:selected").attr('disabled','disabled');

$('#busqueda_type_estado').append(new Option("Selecciona un Estado", "null",true,true));
$("#busqueda_type_estado option:selected").attr('disabled','disabled');

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
});
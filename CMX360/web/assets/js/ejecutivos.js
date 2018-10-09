function clearFields() {
    $('#core_bundle_ejecutivos_type_nombre').attr("value",'');
    $('#core_bundle_ejecutivos_type_contrasena').attr("value",'');
    $("#ejecutivo option[value='null']").prop('selected', true);
}
$('a[href="#tabs-2-tab-1"]').click(function () {
    document.getElementById("breadcrumb1").innerHTML = "Registro";
});

$('a[href="#tabs-2-tab-2"]').click(function () {
    document.getElementById("breadcrumb1").innerHTML = "Actualización";
    clearFields();

});
var normalize = (function() {
    var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
        to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
        mapping = {};
    for(var i = 0, j = from.length; i < j; i++ )
        mapping[ from.charAt( i ) ] = to.charAt( i );
    return function( str ) {
        var ret = [];
        for( var i = 0, j = str.length; i < j; i++ ) {
            var c = str.charAt( i );
            if( mapping.hasOwnProperty( str.charAt( i ) ) )
                ret.push( mapping[ c ] );
            else
                ret.push( c );
        }
        return ret.join( '' );
    }
})();
$('#ejecutivo').on('change',function(){
    /*var eje = $( "#ejecutivo option:selected" ).attr("data-nombre")+" "+$( "#ejecutivo option:selected" ).attr("data-apellido");
    var res = eje.replace(" ", ".");
    res = res.toLowerCase();
    $("#core_bundle_ejecutivos_type_nombre").attr('value',res+$(this).val());*/

    var nombre = $( "#ejecutivo option:selected" ).attr("data-nombre");
    var ape = $( "#ejecutivo option:selected" ).attr("data-apellido");
    nombre = nombre.split(" ");
    ape = ape.split(" ");
    var res = nombre[0]+"."+ape[0];
    res = normalize(res);
    res = res.replace(" ", ".");
    res = res.toLowerCase();
    console.log(res);
    $("#core_bundle_ejecutivos_type_nombre").attr('value',res+$(this).val());

});

$(document).ready(function() {
    $('#tabla').DataTable({
        "language": {
            "decimal": ".",
            "emptyTable": "No hay Registros",
            "info":     "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 de 0 de un total de 0 registros",
            "infoFiltered": "(Filtrado de _MAX_ registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrando _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "searchPlaceholder": "Buscar Persona",
            "zeroRecords": "Sin coincidencias",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});
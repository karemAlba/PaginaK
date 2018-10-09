$(document).ready(function () {
    var i = $('.buttons').find('button');
    i.each(function() {
        if($(this).hasClass('btn-success')){
            $('.buttons').addClass('text-center');
        }
    });
    var p = 100/$('.steps-icon-progress ol li').length;
    $('.steps-icon-progress ol li').css('width',parseInt(p)+'%');
    $('#planType_tipoClientes').append(new Option("Seleccione Tipo de Cliente", "null",true,true));
    $("#planType_tipoClientes option:selected").attr('disabled','disabled');
    $('#planType_estados').append(new Option("Seleccione Estado", "null",true,true));
    $("#planType_estados option:selected").attr('disabled','disabled');
    $('#planType_municipios').append(new Option("Seleccione Municipio", "null",true,true));
    $("#planType_municipios option:selected").attr('disabled','disabled');
    $('#planType_campana').append(new Option("Seleccione Campaña", "null",true,true));
    $("#planType_campana option:selected").attr('disabled','disabled');
    $('#planType_marcas').append(new Option("Seleccione Marca", "null",true,true));
    $("#planType_marcas option:selected").attr('disabled','disabled');
    $('#planType_estatusSeguimiento').append(new Option("Seleccione Estatus Seguimiento", "null",true,true));
    $("#planType_estatusSeguimiento option:selected").attr('disabled','disabled');
    $('#planType_convenios').append(new Option("Seleccione Convenio", "null",true,true));
    $("#planType_convenios option:selected").attr('disabled','disabled');
    $( "input[name='planType[checkConvenio]']" ).click(function() {
        if($(this).val()==1){
            $('#convenio').removeClass('hidden');
        }else{
            $('#convenio').addClass('hidden');
            $('#tabla').DataTable().destroy();
            $('#table-content').html('');
            $('#search').removeClass('disabled');
            $('#convenio').val(null);
        }
    });
    /*Icons Step*/
    $(".craue_formflow_steplist li:nth-child(1)").html('<div class="icon"><i class="font-icon font-icon-case-2"></i></div><div class="caption">Datos Generales</div>');
    $(".craue_formflow_steplist li:nth-child(2)").html('<div class="icon"><i class="glyphicon glyphicon-search"></i></div><div class="caption">Datos Específicos</div>');
    $(".craue_formflow_steplist li:nth-child(3)").html('<div class="icon"><i class="font-icon font-icon-ok"></i></div><div class="caption">Confirmación</div>');

    $('#planType_municipios').on('change',function(){
        $('#error-cp').addClass('hidden');
        $('#planType_codigoPostal').val('');
    });
    $('#planType_zonas').find('option').remove();
    $('#tabla').DataTable( {
        "searching": false,
        "bLengthChange":false,
        "language":{
            "decimal":        ".",
            "emptyTable":     "No hay Registros",
            "info":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 de 0 de un total de 0 registros",
            "infoFiltered":   "(Filtrado de _MAX_ registros)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrando _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Buscar:",
            "searchPlaceholder": "Buscar Plan de Prospección",
            "zeroRecords":    "Sin coincidencias",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        }
    });
    var x;
    $('.sel-todos').click(function () {
        x='';
        if($(this).is(':checked')){
            /*$('#lista-sel').attr('value','');
            $('input.check-sel').each(function () {
                x+= $(this).attr('value')+'+';
                $(this).prop('checked', true);
            });
            $('#lista-sel').attr('value',x);*/
            $('#lista-sel').attr('value','');
            var cells = datatabla.column(7).nodes(); // Cells from 1st column
            $(cells).find('input[type="checkbox"]').each(function () {
                $(this).prop('checked',true);
                x+= $(this).attr('value')+'+';
            });
            $('#lista-sel').attr('value',x);
        }else{
            $('#lista-sel').attr('value','');
            var cells = datatabla.column(7).nodes(); // Cells from 1st column
            $(cells).find('input[type="checkbox"]').each(function () {
                $(this).prop('checked',false);
            });
        }
    });
    $('#tabla').on("click", "input.check-sel", function(){
        x = $('#lista-sel').attr('value');
        ban = 0;
        if($(this).is(':checked')){
            x+= $(this).attr('value');
            $('#lista-sel').attr('value',x+'+');
            $('input.check-sel').each(function () {
                if($(this).is(':checked')){

                }else{
                    ban = 1;
                }
            });
            if(ban==0){
                $('.sel-todos').prop('checked',true);
            }
        }else{
            $('.sel-todos').prop('checked',false);
            var ex = x.split('+');
            if(jQuery.inArray($(this).attr('value'), ex) !== -1){
                var removeItem = $(this).attr('value');
                ex = jQuery.grep(ex, function(value) {
                    return value != removeItem;
                });
                x='';
                $.each(ex, function(index, val) {
                    x += val+'+';
                });
                var check = x.split('+');
                var ban = false;
                $.each(check, function(index, val) {
                    if(val!=''){
                        ban=true;
                    }
                });
                if(ban==true){
                    $('#lista-sel').attr('value',x);
                }else{
                    $('#lista-sel').attr('value','');
                }
            }
        }
    });
    $('#planType_tipoServicio').append(new Option("Seleccione Tipo de Servicio", "null",true,true));
    $("#planType_tipoServicio option:selected").attr('disabled','disabled');
    $('#planType_empresa').append(new Option("Seleccione Empresa", "null",true,true));
    $("#planType_empresa option:selected").attr('disabled','disabled');
    $('#planType_departamento').append(new Option("Seleccione Departamento", "null",true,true));
    $("#planType_departamento option:selected").attr('disabled','disabled');
    $('#planType_servicio').append(new Option("Seleccione Servicio", "null",true,true));
    $("#planType_servicio option:selected").attr('disabled','disabled');
    $('#planType_subservicio').append(new Option("Seleccione Subservicio", "null",true,true));
    $("#planType_subservicio option:selected").attr('disabled','disabled');
    $('#integral-fields').on('change','[name="add-subservicio[]"]',function() {
        var data = $(this).data('id');
        $('[name="add-costo"][data-id="'+data+'"]').val(parseFloat($(this).find(':selected').attr('data-costo')).toFixed(2));
        calcularCosto();
    });
    $('#planType_tipoServicio').on('change',function(){
        if($(this).val()!=null){
            $('#error-tiposervicio').addClass('hidden');
            if($(this).val()==0){
                $('#add-service').addClass('hidden');
                $('#isIndividual').removeClass('hidden');
                $('#costoservicio').addClass('hidden');
                $('#integral-fields').html('');
                calcularCosto();
                console.log('150js');
            }else if($(this).val()==1){
                $('#add-service').removeClass('hidden');
                $('#isIndividual').addClass('hidden');
                var check = $('#planType_checkDescuento_0:checked').val();
                if(check==1){
                    addElement(1);
                    addElement(1);
                }else{
                    addElement(0);
                    addElement(0);
                }
            }
        }
    });

    $('#add-service').click(function() {
        var check = $('#planType_checkDescuento_0:checked').val();
        if(check==1){
            addElement(1);
        }else{
            addElement(0);
        }
    });
    $('#planType_costoTotalPropuesto').click(function() {
        $(this).select();
    });
    $('#planType_fechaInicio').on('change',function(){
        if($('#planType_fechaFin').val()!=''){
            var start = new Date($('#planType_fechaInicio').val());
            var end = new Date($('#planType_fechaFin').val());
            var dif = moment.preciseDiff(start, end);
            if(start>end){
                $('#planType_tiempo').val('');
                $('#error-tiempo').removeClass('hidden');
                $('#error-tiempo').html('La fecha Inicio es mayor a la Fecha Fin');
                console.log('line 835');
            }else{
                $('#planType_tiempo').val(dif);
                $('#error-tiempo').addClass('hidden');
            }
        }
    });
    $('#planType_fechaFin').on('change',function(){
        if($('#planType_fechaInicio').val()!=''){
            var start = new Date($('#planType_fechaInicio').val());
            var end = new Date($('#planType_fechaFin').val());
            var dif = moment.preciseDiff(start, end);
            if(start>end){
                $('#planType_tiempo').val('');
                $('#error-tiempo').removeClass('hidden');
                $('#error-tiempo').html('La fecha Inicio es mayor a la Fecha Fin');
                console.log('line 202js');
            }else{
                $('#planType_tiempo').val(dif);
                $('#error-tiempo').addClass('hidden');
            }
        }
    });
    $("#planType_numeroAsesores").on("click", function () {
        $(this).select();
    });
    $("#planType_numeroAsesores").on("change", function () {
         noC = $("#noClientes").val();
         if(noC<$(this).val()){
             $('#error-asesores').removeClass('hidden');
             $('#error-asesores').html('El número de Asesores es mayor al número de Clientes');
         }else{
             $('#error-asesores').addClass('hidden');
         }
    });
    $('#planType_costoTotalPropuesto').on('change',function() {
        total = $('#noClientes').val() * t;
        $('#planType_costodeProspeccion').val(total.toFixed(2));
        //$('#planType_costodeProspeccion').val(parseFloat($(this).val()).toFixed(2));
        $('#planType_costoTotalPropuesto').val(parseFloat($(this).val()).toFixed(2));
        console.log('215js');
    });
});

function calcularCosto() {
    console.log('220js');
    var total = 0;
    var check = $('#planType_checkDescuento_0:checked').val();
    $('[name="add-costo"]').each(function() {
        var element = $(this);
        var costo = parseFloat(element.val());
        total = total + costo;
    });
    $('#planType_costoTotal').val('');
    if(isNaN(total)){
        $('#planType_costoTotal').val(parseFloat(0).toFixed(2));
        $('#planType_costoTotalPropuesto').val(parseFloat(0).toFixed(2));
        console.log('232js');
        $('#planType_costodeProspeccion').val(parseFloat(0).toFixed(2));
    }else{
        $('#planType_costoTotalPropuesto').val(parseFloat(total).toFixed(2));
        console.log('236js');
        $('#planType_costoTotal').val(parseFloat(total).toFixed(2));
        var g = $('#noClientes').val() * total;
        $('#planType_costodeProspeccion').val(g.toFixed(2));
        //$('#planType_costodeProspeccion').val(parseFloat(total).toFixed(2));
        if(check==1){
            $('#descuentoN').removeClass('hidden');
            $('#costototalD').removeClass('hidden');
            var desc = $('#planType_descuentoN').val();
            var x = $('#planType_costoTotal').val();
            var t = x*(1-(desc/100));
            $('#planType_costoTotalDesc').val(t.toFixed(2));
            total = $('#noClientes').val() * t;
            $('#planType_costodeProspeccion').val(total.toFixed(2));
            //$('#planType_costodeProspeccion').val(t.toFixed(2));
            $('#planType_costoTotalPropuesto').val(t.toFixed(2));
            $('[name="add-fdescuento"]').each(function() {
                $(this).removeClass('hidden');
            });
        }else{
            $('#descuentoN').addClass('hidden');
            $('#planType_costoTotalDesc').val(0);
            $('#costototalD').addClass('hidden');
            $('[name="add-fdescuento"]').each(function() {
                $(this).addClass('hidden');
            });
        }
    }
}
function addElement(check){
    var last = 0;
    $('[name="add-costo"]').each(function() {
        last = $(this).data('id');
    });
    var id = last + 1;
    if(check==0){
        $('#integral-fields').append('<div class="col-md-12" data-id="'+id+'"><h6>'+id+'</h6>' +
            '<div class="col-md-5">'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Empresa</label>'+
            '<div class="col-sm-12">' +
            '<select class="form-control" name="add-empresa" data-id="'+id+'">' +
            '<option selected disabled value="null">Seleccione Empresa</option>' +
            '<option value="1">KREATSOLUTIONS</option>' +
            '<option value="2">SIGEM</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addEmpresa" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>' +
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Servicio</label>'+
            '<div class="col-sm-12">'+
            '<select class="form-control" name="add-servicio" data-id="'+id+'">' +
            '<option disabled selected value="null">Seleccione Servicio</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addServicio" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>'+
            '</div>' +
            '<div class="col-md-4">'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Departamento</label>'+
            '<div class="col-sm-12">'+
            '<select class="form-control" name="add-departamento" data-id="'+id+'">' +
            '<option selected disabled value="null">Seleccione Departamento</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addDepartamento" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Subservicio</label>'+
            '<div class="col-sm-12">'+
            '<select class="form-control" name="add-subservicio[]" data-id="'+id+'">' +
            '<option selected disabled value="null">Seleccione Subservicio</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addSubservicio" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>'+
            '</div>'+
            '<div class="col-md-3">'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Costo</label>'+
            '<div class="col-sm-12">' +
            '<div class="input-icon">'+
            '<input name="add-costo" data-id="'+id+'" class="form-control" readonly="readonly">'+
            '<i>$</i>'+
            '</div>'+
            '</div>'+
            '</fieldset>'+
            '<fieldset class="form-group hidden" name="add-fdescuento">'+
            '<label class="form-label semibold" for="exampleInput">% descuento</label>'+
            '<div class="col-sm-12">' +
            '<input name="add-descuento[]" data-id="'+id+'" class="form-control" min="0" max="10">'+
            '</div>'+
            '</fieldset>'+
            '</div>' +
            '</div>');
    }else if (check==1){
        $('#integral-fields').append('<div class="col-md-12" data-id="'+id+'"><h6>'+id+'</h6>' +
            '<div class="col-md-5">'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Empresa</label>'+
            '<div class="col-sm-12">' +
            '<select class="form-control" name="add-empresa" data-id="'+id+'">' +
            '<option selected disabled value="null">Seleccione Empresa</option>' +
            '<option value="1">KREATSOLUTIONS</option>' +
            '<option value="2">SIGEM</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addEmpresa" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>' +
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Servicio</label>'+
            '<div class="col-sm-12">'+
            '<select class="form-control" name="add-servicio" data-id="'+id+'">' +
            '<option disabled selected value="null">Seleccione Servicio</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addServicio" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>'+
            '</div>' +
            '<div class="col-md-4">'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Departamento</label>'+
            '<div class="col-sm-12">'+
            '<select class="form-control" name="add-departamento" data-id="'+id+'">' +
            '<option selected disabled value="null">Seleccione Departamento</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addDepartamento" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Subservicio</label>'+
            '<div class="col-sm-12">'+
            '<select class="form-control" name="add-subservicio[]" data-id="'+id+'">' +
            '<option selected disabled value="null">Seleccione Subservicio</option>' +
            '</select>' +
            '<p class="help-block hidden" name="error-addSubservicio" data-id="'+id+'"></p>' +
            '</div>'+
            '</fieldset>'+
            '</div>'+
            '<div class="col-md-3">'+
            '<fieldset class="form-group">'+
            '<label class="form-label semibold" for="exampleInput">Costo</label>'+
            '<div class="col-sm-12">' +
            '<div class="input-icon">'+
            '<input name="add-costo" data-id="'+id+'" class="form-control" readonly="readonly">'+
            '<i>$</i>'+
            '</div>'+
            '</div>'+
            '</fieldset>'+
            '<fieldset class="form-group" name="add-fdescuento">'+
            '<label class="form-label semibold" for="exampleInput">% descuento</label>'+
            '<div class="col-sm-12">' +
            '<input name="add-descuento[]" value="'+$('#planType_descuentoN').val()+'" data-id="'+id+'" class="form-control" min="0" max="10">'+
            '</div>'+
            '</fieldset>'+
            '</div>' +
            '</div>');
    }
}
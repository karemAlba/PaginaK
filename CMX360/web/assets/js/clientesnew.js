$(document).ready(function () {
    /*Icons Step*/
    $(".craue_formflow_steplist li:nth-child(1)").html('<div class="icon"><i class="font-icon font-icon-case-2"></i></div><div class="caption">Datos Generales</div>');
    $(".craue_formflow_steplist li:nth-child(2)").html('<div class="icon"><i class="font-icon font-icon-map"></i></div><div class="caption">Domicilio</div>');
    $(".craue_formflow_steplist li:nth-child(3)").html('<div class="icon"><i class="font-icon font-icon-user"></i></div><div class="caption">Datos Específicos</div>');
    $(".craue_formflow_steplist li:nth-child(4)").html('<div class="icon"><i class="font-icon font-icon-ok"></i></div><div class="caption">Confirmación</div>');
    /*Validations*/
    $('.btn.btn-primary.float-right').click(function (e) {
        if ($('#clientesType_razonSocial').val() == '') {
            e.preventDefault();
            $('#error-razon').removeClass('hidden');
            $('#error-razon').html('Ingresa Razón Social');
        } else {
            $('#error-razon').addClass('hidden');
        }
        if ($('#clientesType_numeroPermiso').val() == '') {
            e.preventDefault();
            $('#error-permiso').removeClass('hidden');
            $('#error-permiso').html('Ingresa Número de Permiso');
        } else {
            if($('#error-permiso').html()=='El Número de Permiso EXISTE'){
                e.preventDefault();
            }else{
                $('#error-permiso').addClass('hidden');
            }
        }
        if ($('#clientesType_rfc').val() == '') {
            e.preventDefault();
            $('#error-rfc').removeClass('hidden');
            $('#error-rfc').html('Ingresa RFC');
        } else {
            $('#error-rfc').addClass('hidden');
        }
        if ($('#clientesType_estacionServicio').val() == '') {
            e.preventDefault();
            $('#error-estacion').removeClass('hidden');
            $('#error-estacion').html('Ingresa Estación de Servicio');
        } else {
            $('#error-estacion').addClass('hidden');
        }
        if ($('#clientesType_telefonoEmpresa').val() == '') {
            e.preventDefault();
            $('#error-telefono').removeClass('hidden');
            $('#error-telefono').html('Ingresa Teléfono de la Empresa');
        } else {
            $('#error-telefono').addClass('hidden');
        }
        if ($('#clientesType_correoEmpresa').val() == '') {
            e.preventDefault();
            $('#error-correo').removeClass('hidden');
            $('#error-correo').html('Ingresa Correo Electrónico de la Empresa');
        } else {
            $('#error-correo').addClass('hidden');
        }
        //second
        if ($('#clientesType_calle').val() == '') {
            e.preventDefault();
            $('#error-calle').removeClass('hidden');
            $('#error-calle').html('Ingresa Calle');
        } else {
            $('#error-calle').addClass('hidden');
        }
        if ($('#clientesType_estado option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-estado').removeClass('hidden');
            $('#error-estado').html('Selecciona un Estado');
        } else {
            $('#error-estado').addClass('hidden');
        }
        if ($('#clientesType_municipio option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-municipio').removeClass('hidden');
            $('#error-municipio').html('Selecciona un Municipio');
        } else {
            $('#error-municipio').addClass('hidden');
        }
        if ($('#clientesType_colonia option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-colonia').removeClass('hidden');
            $('#error-colonia').html('Selecciona una Colonia');
        } else {
            $('#error-colonia').addClass('hidden');
        }
        if ($('#clientesType_tipoClientes option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-tipoCliente').removeClass('hidden');
            $('#error-tipoCliente').html('Selecciona un Tipo de Cliente');
        } else {
            $('#error-tipoCliente').addClass('hidden');
        }
        if ($('#clientesType_sector option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-sector').removeClass('hidden');
            $('#error-sector').html('Selecciona un Sector');
        } else {
            $('#error-sector').addClass('hidden');
        }
        if ($('#clientesType_segmento option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-segmento').removeClass('hidden');
            $('#error-segmento').html('Selecciona un Segmento');
        } else {
            $('#error-segmento').addClass('hidden');
        }
        if ($('#clientesType_categoria option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-categoria').removeClass('hidden');
            $('#error-categoria').html('Selecciona una Categoría');
        } else {
            $('#error-categoria').addClass('hidden');
        }
        if ($('#clientesType_marca option:selected').prop('disabled') == true) {
            e.preventDefault();
            $('#error-marca').removeClass('hidden');
            $('#error-marca').html('Selecciona una Marca');
        } else {
            $('#error-marca').addClass('hidden');
        }
        if ($('#clientesType_marca option:selected').val() === 'new') {
            if ($('#clientesType_nuevamarca').val() == '') {
                $('#error-nuevamarca').removeClass('hidden');
                $('#error-nuevamarca').html('Ingresa Nueva Marca');
            } else {
                $('#error-nuevamarca').addClass('hidden');
            }
        } else {
            $('#error-nuevamarca').addClass('hidden');
        }
        if ($('#clientesType_asociacion option:selected').val() === 'new') {
            if ($('#clientesType_nuevaasociacion').val() == '') {
                $('#error-nuevaasociacion').removeClass('hidden');
                $('#error-nuevaasociacion').html('Ingresa Nueva Asociación');
                e.preventDefault();
            } else {
                $('#error-nuevaasociacion').addClass('hidden');
            }
        } else {
            $('#error-nuevaasociacion').addClass('hidden');
        }
        if ($('#clientesType_macrogrupo option:selected').val() === 'new') {
            if ($('#clientesType_nuevomacrogrupo').val() == '') {
                $('#error-nuevaunion').removeClass('hidden');
                $('#error-nuevaunion').html('Ingresa Nueva Unión');
                e.preventDefault();
            } else {
                if($('#clientesType_asociacion option:selected').prop('disabled') == true){
                    e.preventDefault();
                    $('#error-nuevaunion').removeClass('hidden');
                    $('#error-nuevaunion').html('Selecciona una Asociación');
                }else{
                    $('#error-nuevaunion').addClass('hidden');
                }
            }
        } else {
            $('#error-nuevaunion').addClass('hidden');
        }
        if ($('#clientesType_grupo option:selected').val() === 'new') {
            if ($('#clientesType_nuevogrupo').val() == '') {
                $('#error-nuevogrupo').removeClass('hidden');
                $('#error-nuevogrupo').html('Ingresa Nuevo Grupo');
                e.preventDefault();
            } else {
                if($('#clientesType_macrogrupo option:selected').prop('disabled') == true){
                    $('#error-nuevogrupo').removeClass('hidden');
                    $('#error-nuevogrupo').html('Selecciona una Unión');
                    e.preventDefault();
                }else{
                    $('#error-nuevogrupo').addClass('hidden');
                }
            }
        } else {
            $('#error-nuevogrupo').addClass('hidden');
        }
        if ($('#clientesType_independiente_0:checked').val() != 1 && $('#clientesType_asociacion option:selected').prop('disabled') == true && $('#clientesType_macrogrupo option:selected').prop('disabled') == true && $('#clientesType_grupo option:selected').prop('disabled') == true) {
            $('#error-grupos').removeClass('hidden');
            $('#error-grupos').html('Selecciona al menos una Asociación o una Unión o un Grupo');
            e.preventDefault();
        } else {
            $('#error-grupos').addClass('hidden');
        }
        var x = "";
        $.each($('#clientesType_productos').select2('data'), function (i, val) {
            x = x + val.id + ".";
        });
        $("#clientesType_lista").attr('value', x);
        if ($("#clientesType_lista").val() == '') {
            e.preventDefault();
            $('#error-producto').removeClass('hidden');
            $('#error-producto').html('Selecciona al menos un Producto');
        } else {
            $('#error-producto').addClass('hidden');
        }
    });
});
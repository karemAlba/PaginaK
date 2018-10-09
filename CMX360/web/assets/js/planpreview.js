$(document).ready(function () {
    /*$(".fancy").fancybox({
        'width': 600, // or whatever
        'height': 320,
        'type': 'iframe'
    });*/
    $('#enviar').click(function () {
        $('#formulario').submit();
        /*$.ajax({
            type: 'POST',
            url: $("#formulario").attr("action"),
            data: $("#formulario").serialize(),
            success: function(html) {
                var uri = 'https://docs.google.com/gview?url='+html.ruta+'&embedded=true';
                $('#documento').attr('href',uri);
                $("#documento").click();
            },
        });*/
    });
    $('input[type="checkbox"]').click(function () {
        x = $('#lista-sel').attr('value');
        if($(this).is(':checked')){
            x+= $(this).attr('value');
            $('#lista-sel').attr('value',x+'k');
        }else{
            var ex = x.split('k');
            if(jQuery.inArray($(this).attr('value'), ex) !== -1){
                var removeItem = $(this).attr('value');
                ex = jQuery.grep(ex, function(value) {
                    return value != removeItem;
                });
                x='';
                $.each(ex, function(index, val) {
                    x += val+'k';
                });
                var check = x.split('k');
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
});
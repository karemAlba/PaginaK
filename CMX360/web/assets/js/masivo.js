function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#carga-form').submit();
        };

        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function () {
    $("label[for='app_bundle_carga_type_xml']").click(function (e) {
        if($('#sector option:selected').prop('disabled') == true){
            e.preventDefault();
            $('#sector-error').removeClass('hidden');
        }else{
            $('#sector-error').addClass('hidden');
        }
        if($('#segmento option:selected').prop('disabled') == true){
            e.preventDefault();
            $('#segmento-error').removeClass('hidden');
        }else{
            $('#segmento-error').addClass('hidden');
        }
        if($('#categoria option:selected').prop('disabled') == true){
            e.preventDefault();
            $('#categoria-error').removeClass('hidden');
        }else{
            $('#categoria-error').addClass('hidden');
        }
    });
});
$(document).ready(function () {
    $('#value').blur(function () {
        $.post(
            myBaseUrl + "settings/validate_form",
            { name: $('#value').attr('id'), value:$('#value').val()},
            handleLimitValidation
        );
    })

    function handleLimitValidation(error){
        if(error.length > 0){
            if($('#value-nonEmpty').length == 0){
                $('#value').after('<div id="value-nonEmpty" class="error-message">' +  error +"</div>");
            }
        }
        else{
            $('#value-nonEmpty').remove();
        }
    }
})
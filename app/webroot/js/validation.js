$(document).ready(function () {
    $('#value').keyup(function () {
        $.post(
            myBaseUrl + "settings/validate_form",
            { name: $('#value').attr('id'), value: $('#value').val()},
            handleLimitValidation
        );
    })

    function handleLimitValidation(error) {
        if (error.length > 0) {
            if ($('#value-nonEmpty').length == 0) {
                $('#value').after('<div id="value-nonEmpty" class="error-message">' + error + "</div>");
            }
            else if ($("#value-nonEmpty").text() != error) {
                $("#value-nonEmpty").text(error);
            }
        }
        else {
            $('#value-nonEmpty').remove();
        }
    }

    $("#submit").bind("click", function (event) {
        $.ajax({

            data: $("#submit").closest("form").serialize(),
            dataType: "html",
            success: function (data, textStatus) {
                toastr.options = {"positionClass": "toast-bottom-full-width"}
                toastr.success('Podešavanja sačuvana!')
            },
            type: "post", url: myBaseUrl + "settings/edit"});
        return false;
    });
})
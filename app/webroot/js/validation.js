$(document).ready(function () {
    var error;
    toastr.options = {"positionClass": "toast-bottom-full-width"};
    $('#value').keyup(function () {
        $.post(
            myBaseUrl + "settings/validate_form",
            { name: $('#value').attr('id'), value: $('#value').val()},
            handleLimitValidation
        );
    })

    function handleLimitValidation(e) {
        error = e;
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
            error = "";
        }
    }

    $("#submit").bind("click", function (event) {
        if (error.length > 0) {
            toastr.error(error);
        }
        else {


            $.ajax({

                data: $("#submit").closest("form").serialize(),
                dataType: "html",
                success: function (data, textStatus) {
                    toastr.options = {"positionClass": "toast-bottom-full-width"};
                    toastr.success('Podešavanja sačuvana!');
                },
                type: "post", url: myBaseUrl + "settings/edit"});
        }
        return false;
    });
})
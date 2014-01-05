$(document).ready(function () {
    $("#search").bind("click", function (event) {

        $.ajax({
            dataType: "html",
            success: function (data, textStatus) {

                $("#pretraga").html(data);
//                $(".actions").remove();
            },
            url: myBaseUrl + "terms/search",
            data: { TermDate: $('#TermDate').val(),
                TermOd: $('#TermOd').val(),
                TermDo:$('#TermDo').val(),
                TermVrijemeTHour:$('#TermVrijemeTHour').val(),
                TermVrijemeTMin:$('#TermVrijemeTMin').val(),
                TermVrijemeOdHour:$('#TermVrijemeOdHour').val(),
                TermVrijemeOdMin:$('#TermVrijemeOdMin').val(),
                TermVrijemeDoHour:$('#TermVrijemeDoHour').val(),
                TermVrijemeDoMin:$('#TermVrijemeDoMin').val(),
                TermHall:$('#TermHall').val(),
                TermStatus:$('#TermStatus').val(),
                TermName:$('#TermName').val(),
                TermSurname:$('#TermSurname').val()
            }
        });
        return false;

    });


});


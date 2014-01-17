$(document).ready(function () {


    $( "#radio" ).buttonset();

    var datum = $("#datum");
    var datumRange = $("#datumRange");

    $("#radio2").bind("click", function (event) {

        datum.remove();
        $(".datumi").append(datumRange.show());
//        $("#datumRange").show();
    });

    $("#radio1").bind("click", function (event) {

        datumRange.remove();
        $(".datumi").append(datum);
//        $(datum).appendTo(".datumi");
//        $(".datumi").append($("#datum"));
//        $("#datumRange").show();
    });

    $("#search").bind("click", function (event) {

        $.ajax({
            dataType: "html",
            success: function (data, textStatus) {
                $("#listaTermina").children().remove().end().html(data);
//                $("#listaTermina").html(data);
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
            },
            beforeSend: function(XMLHttpRequest) {
                $('#load').activity();
            },
            complete: function(XMLHttpRequest, textStatus) {
                $('#load').activity(false);
            }
        });
        return false;

    });


});


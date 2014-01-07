$(document).ready(function () {


    var $calendar = $('#calendar');
    var id = 10;
    var sale = $('#wc-hall');
    var limit;
    var menadzer;
    var ownerTerms;
    var cijena = 5;
    var minutes;
    var priceField;
    var allTerms;
    toastr.options = {"positionClass": "toast-bottom-full-width"};


    function saveChangedTerm(calEvent) {
        $.each(allTerms, function (index, term) {
            if (term.id == calEvent.id) {
                term.start = calEvent.start;
                term.end = calEvent.end;
            }
        });
    }

    $calendar.weekCalendar({

        daysToShow: 7,
        height: function ($calendar) {
            return $(window).height() - $("h1").outerHeight() - 1;
        },
        eventRender: function (calEvent, $event) {
            if (calEvent.hall == parseInt(sale.val())) {


                if (calEvent.status == "otkazan") {
                    $event.css("backgroundColor", "#da1337");
                    $event.find(".wc-time").css({
                        "backgroundColor": "#B80115",
                        "border": "1px solid #A70004"
                    });
                }
                else if (calEvent.status == "potvrđen") {
                    $event.css("backgroundColor", "#5DDDB2");
                    $event.find(".wc-time").css({
                        "backgroundColor": "#3BBB90",
                        "border": "1px solid #2AAA80"
                    });
                }

                else if (calEvent.status == "završen") {
                    $event.css("backgroundColor", "#aaa");
                    $event.find(".wc-time").css({
                        "backgroundColor": "#999",
                        "border": "1px solid #888"
                    });
                    calEvent.readOnly = true;
                }

                if (getDifference(calEvent.start) < limit && !menadzer) {
                    calEvent.readOnly = true;
                }

                if ($.inArray(calEvent.id, ownerTerms["owner"]) == -1 && !menadzer) {
                    calEvent.readOnly = true;
                }
            }

        },
        draggable: function (calEvent, $event) {
            return calEvent.readOnly != true;
        },
        resizable: function (calEvent, $event) {
            return calEvent.readOnly != true;
        },
        eventNew: function (calEvent, $event) {

            var diffDays = getDifference(calEvent.start);

            if (diffDays < limit && !menadzer) {
                toastr.error("Termin mora biti zakazan minimalno " + limit + " dana unaprijed.");
                $calendar.weekCalendar("removeUnsavedEvents");
            }
            else {
                noviTermin(calEvent);
            }


        },
        eventDrop: function (calEvent, $event) {

            var diffDays = getDifference(calEvent.start);

            if (diffDays < limit && !menadzer) {
                toastr.error("Termin se može mijenjati minimalno " + limit + " dana unaprijed.");
                $calendar.weekCalendar("refresh");
            }
            else {
                $.post(myBaseUrl + "terms/move", {
                    'id': calEvent.id,
                    'start': calEvent.start.getTime() / 1000,
                    'end': calEvent.end.getTime() / 1000
                }, null);


                saveChangedTerm(calEvent);

            }
        },

        eventResize: function (calEvent, $event) {

            $.post(myBaseUrl + "terms/move", {
                'id': calEvent.id,
                'start': calEvent.start.getTime() / 1000,
                'end': calEvent.end.getTime() / 1000
            }, null);

            saveChangedTerm(calEvent);

        },
        eventClick: function (calEvent, $event) {

            if (calEvent.readOnly) {
                return;
            }

            var $dialogContent = $("#event_edit_container");
            resetForm($dialogContent);
            var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
            var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
            var statusField = $dialogContent.find("select[name='status']").val(calEvent.status);
            var bodyField = $dialogContent.find("textarea[name='body']");
            bodyField.val(calEvent.body);
            priceField = $dialogContent.find("label[name='price']");
            var iznosField = $dialogContent.find("input[name='iznos']");

            minutes = getMinutes(calEvent.start, calEvent.end);
            priceField.text(minutes * cijena / 15);

            if (!menadzer) {
                $("#status").hide();
                $('.iznos').hide();
            }

            $dialogContent.dialog({
                modal: true,
                title: "Uređivanje termina",
                close: function () {
                    $dialogContent.dialog("destroy");
                    $dialogContent.hide();
                    clearTime();
                    $('#calendar').weekCalendar("removeUnsavedEvents");
                },
                buttons: {
                    save: function () {

                        calEvent.start = new Date(startField.val());
                        calEvent.end = new Date(endField.val());
                        calEvent.body = bodyField.val();
                        calEvent.status = statusField.val();
                        calEvent.hall = sale.val();

                        var iznos = iznosField.val();
                        var start = calEvent.start.getTime() / 1000;
                        var end = calEvent.end.getTime() / 1000;
                        var body = calEvent.body;

                        $.post(myBaseUrl + "terms/save", {start: start, end: end, status: calEvent.status, body: body, id: calEvent.id, hall: calEvent.hall, iznos: iznos}, function (data) {
                            var tmp = jQuery.parseJSON(data);
                            if (tmp == "error") {
                                toastr.error("Greška, izaberite slobodan termin.");
                            }
                            else {
                                $calendar.weekCalendar("updateEvent", calEvent);
                                $dialogContent.dialog("close");
                            }
                        });
                    },
                    "otkaži": function () {
                        if (confirm('Da li ste sigurni da želite otkazati termin?')) {
                            $.post(myBaseUrl + "terms/otkazi", {id: calEvent.id});
//                                          $calendar.weekCalendar("removeEvent", calEvent.id);
                            $calendar.weekCalendar("refresh");
                            $dialogContent.dialog("close");
                        }

                    },
                    cancel: function () {
                        $dialogContent.dialog("close");
                    }
                }
            }).show();

            startField = $dialogContent.find("select[name='start']").val(calEvent.start);
            endField = $dialogContent.find("select[name='end']").val(calEvent.end);
            $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
            setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
            $(window).resize().resize(); //fixes a bug in modal overlay size ??


        },
        eventMouseover: function (calEvent, $event) {
        },
        eventMouseout: function (calEvent, $event) {
        },
        noEvents: function () {

        },
        data: function (start, end, callback) {
            $.getJSON(myBaseUrl + "terms/getEvents", {
                start: start.getTime(),
                end: end.getTime(),
                hall: sale.val()
            }, function (result) {

                var tmp = result.pop();
                limit = parseInt(tmp['limit']);

                tmp = result.pop();
                menadzer = tmp["menadzer"];

                ownerTerms = result.pop();

                allTerms = result;

                callback(result);
            });
        }
    });

    function resetForm($dialogContent) {
        $dialogContent.find("input").val("");
        $dialogContent.find("textarea").val("");
    }

    /*
     * Sets up the start and end time fields in the calendar event
     * form for editing based on the calendar event being edited
     */
    function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

        for (var i = 0; i < timeslotTimes.length; i++) {
            var startTime = timeslotTimes[i].start;
            var endTime = timeslotTimes[i].end;
            var startSelected = "";
            if (startTime.getTime() === calEvent.start.getTime()) {
                startSelected = "selected=\"selected\"";
            }
            var endSelected = "";
            if (endTime.getTime() === calEvent.end.getTime()) {
                endSelected = "selected=\"selected\"";
            }
            $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
            $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

        }
        $endTimeOptions = $endTimeField.find("option");
        $startTimeField.trigger("change");
    }


    var nav = $('.wc-nav');
    nav.append(sale);
    sale.show();

    sale.change(function () {
        $calendar.weekCalendar("refresh");
    });

    var $endTimeField = $("select[name='end']");
    var $endTimeOptions = $endTimeField.find("option");

    //reduces the end time options to be only after the start time options.
    $("select[name='start']").change(function () {
        var startTime = $(this).find(":selected").val();
        var currentEndTime = $endTimeField.find("option:selected").val();
        $endTimeField.html(
            $endTimeOptions.filter(function () {
                return startTime < $(this).val();
            })
        );

        var endTimeSelected = false;
        $endTimeField.find("option").each(function () {
            if ($(this).val() === currentEndTime) {
                $(this).attr("selected", "selected");
                endTimeSelected = true;
                return false;
            }
        });
        $endTimeField[0][0].remove();
        if (!endTimeSelected) {
            //automatically select an end date 2 slots away.
            $endTimeField.find("option:eq(1)").attr("selected", "selected");
        }

    });


    var $about = $("#about");

    $("#about_button").click(function () {
        $about.dialog({
            title: "About this calendar demo",
            width: 600,
            close: function () {
                $about.dialog("destroy");
                $about.hide();
            },
            buttons: {
                close: function () {
                    $about.dialog("close");
                }
            }
        }).show();
    });

    function clearTime() {
        $('#start').children().remove().end().append('<option value="">Select Start Time</option>');
        $('#end').children().remove().end().append('<option value="">Select End Time</option>');
    }

    function getDifference(start) {
        var termDate = new Date(start.getFullYear(), start.getMonth(), start.getDate());
        var d = new Date();
        var timeDiff = termDate.getTime() - d.getTime();
        return Math.ceil(timeDiff / (1000 * 3600 * 24));
    }

    function getMinutes(start, end) {
        var s = new Date(start.getFullYear(), start.getMonth(), start.getDate(), start.getHours(), start.getMinutes());
        var e = new Date(end.getFullYear(), end.getMonth(), end.getDate(), end.getHours(), end.getMinutes());
        var timeDiff = e.getTime() - s.getTime();
        return Math.ceil(timeDiff / (1000 * 60));
    }

    $('#start').change(function () {
        calculateTime();
    });

    $('#end').change(function () {
        calculateTime();
    });

    function getDate(time) {
        var t = time.split(/:/);
        var hours = t[0].slice(-2);
        var minutes = t[1];
        return new Date(2000, 0, 1, hours, minutes);
    }

    function calculateTime() {
        var startTime = $("#start").val();
        var endTime = $("#end").val();
        minutes = getMinutes(getDate(startTime), getDate(endTime));
        priceField.text(minutes * cijena / 15 + 'KM');
    }

    $('#noviTermin').click(function () {
        var termin;
        var count = 0;
        var zauzet = false;
        var slotIndex;
        var terminiDan = [];
        var timeSlots;
        var danTermina = new Date();

        danTermina.setDate(danTermina.getDate()+limit);

        var terminPronadjen = false;
        var day = 0;

        while(!terminPronadjen)
        {

            terminiDan = [];
            danTermina.setDate(danTermina.getDate()+day);
            $.each(allTerms, function(index, term)
            {
                if(term.start.getDate() == danTermina.getDate()){
                    terminiDan.push(term);
                }
            });

            timeSlots = $("#calendar").weekCalendar("getTimeslotTimes", danTermina);

            for(var i=0; i<timeSlots.length; i++)
            {
                zauzet = false;
                for(var j=0; j<terminiDan.length; j++)
                {
                    var diffStart = terminiDan[j].start.getTime() - timeSlots[i].start.getTime();
                    var diffEnd = terminiDan[j].end.getTime() - timeSlots[i].start.getTime();

                    if(diffStart == 0 || (diffStart < 0 && diffEnd > 0)){
                        zauzet = true;
                        break;
                    }
                }

                if(!zauzet){
                    if(count == 0)
                    {
                        count++;
                        termin = timeSlots[i].start;
                        slotIndex = i;
                    }
                    else if(count == 1 && i-slotIndex == 1)
                    {
                        terminPronadjen = true;
                        break;

                    }
                    else
                    {
                        slotIndex = i;
                        termin = timeSlots[i].start;
//                        count = 0;
//                        termin = "";
                    }
                }


            }
            day++;

        }

//        console.log(termin);

        var calEvent = {};
        calEvent.start = termin;
        calEvent.end = new Date(termin.getTime() + 30*60*1000);

        noviTermin(calEvent);

    });

    function noviTermin(calEvent) {
        if (!menadzer) {
            $("#status").hide();
        }
        $('.iznos').hide();
        var $dialogContent = $("#event_edit_container");
        resetForm($dialogContent);
        var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
        var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
        var bodyField = $dialogContent.find("textarea[name='body']");
        var statusField = $dialogContent.find("select[name='status']");
        priceField = $dialogContent.find("label[name='price']");

        minutes = getMinutes(calEvent.start, calEvent.end);
        priceField.text(minutes * cijena / 15);

        $dialogContent.dialog({
            modal: true,
            title: "Novi termin",
            close: function () {
                $dialogContent.dialog("destroy");
                $dialogContent.hide();
                clearTime();
                $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
                save: function () {


                    calEvent.id = id;
                    id++;
                    calEvent.start = new Date(startField.val());
                    calEvent.end = new Date(endField.val());
                    calEvent.body = bodyField.val();
                    calEvent.status = statusField.val();
                    calEvent.hall = sale.val();

                    //post to events.php
                    var start = calEvent.start.getTime() / 1000;
                    var end = calEvent.end.getTime() / 1000;
                    var body = calEvent.body;


                    $.post(myBaseUrl + "terms/save", {start: start, end: end, status: calEvent.status, body: body, hall: calEvent.hall }, function (data) {
                        var tmp = jQuery.parseJSON(data);
                        if (tmp == "error") {
                            toastr.error("Greška, izaberite slobodan termin");
                        }
                        else {
                            calEvent.id = tmp;
                            ownerTerms["owner"].push(calEvent.id);
                            allTerms.push(calEvent);
                            $calendar.weekCalendar("removeUnsavedEvents");
                            $calendar.weekCalendar("updateEvent", calEvent);
                            clearTime();
                            $dialogContent.dialog("close");
                        }
                    });


                },
                cancel: function () {
                    $dialogContent.dialog("close");
                }
            }
        }).show();

        $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
        setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
    }

});
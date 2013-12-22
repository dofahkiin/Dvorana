$(document).ready(function () {


    var $calendar = $('#calendar');
    var id = 10;

    $calendar.weekCalendar({
        timeslotsPerHour: 4,
        allowCalEventOverlap: true,
        overlapEventsSeparate: true,
        firstDayOfWeek: 1,
        businessHours: {start: 8, end: 18, limitDisplay: true },
        daysToShow: 7,
        height: function ($calendar) {
            return $(window).height() - $("h1").outerHeight() - 1;
        },
        eventRender: function (calEvent, $event) {
            if (calEvent.status == "otkazan") {
                $event.css("backgroundColor", "#da1337");
                $event.find(".wc-time").css({
                    "backgroundColor": "#B80115",
                    "border": "1px solid #A70004"
                });
            }
            else if(calEvent.status == "potvrđen"){
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
            }
        },
        draggable: function (calEvent, $event) {
            return calEvent.readOnly != true;
        },
        resizable: function (calEvent, $event) {
            return calEvent.readOnly != true;
        },
        eventNew: function (calEvent, $event) {
            var termDate = calEvent.start.getDate();
            var d = new Date();
            var month = d.getMonth() + 1;
            var today = d.getDate();

            $.post(myBaseUrl + "settings/limit", {}, function (data) {
                var limit = jQuery.parseJSON(data);

                if (termDate - today < limit["limit"] && !limit["menadzer"]) {
                    alert("Termin mora biti zakazan minimalno " + limit["limit"] + " dana unaprijed.");
                    $calendar.weekCalendar("removeUnsavedEvents");
                }
                else {
                    if (!limit["menadzer"]) {
                        $("#status").hide();
                    }
                    var $dialogContent = $("#event_edit_container");
                    resetForm($dialogContent);
                    var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
                    var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
                    var titleField = $dialogContent.find("input[name='title']");
                    var bodyField = $dialogContent.find("textarea[name='body']");
                    var statusField = $dialogContent.find("select[name='status']");


                    $dialogContent.dialog({
                        modal: true,
                        title: "New Calendar Event",
                        close: function () {
                            $dialogContent.dialog("destroy");
                            $dialogContent.hide();
                            $('#calendar').weekCalendar("removeUnsavedEvents");
                        },
                        buttons: {
                            save: function () {


                                calEvent.id = id;
                                id++;
                                calEvent.start = new Date(startField.val());
                                calEvent.end = new Date(endField.val());
                                calEvent.title = titleField.val();
                                calEvent.body = bodyField.val();
                                calEvent.status = statusField.val();

                                //post to events.php
                                var start = calEvent.start.getTime() / 1000;
                                var end = calEvent.end.getTime() / 1000;
                                var title = calEvent.title;
                                var body = calEvent.body;


                                $.post(myBaseUrl + "terms/save", {start: start, end: end, status: calEvent.status, body: body }, function (data) {
                                    calEvent.id = jQuery.parseJSON(data);
                                });

                                $calendar.weekCalendar("removeUnsavedEvents");
                                $calendar.weekCalendar("updateEvent", calEvent);
                                $dialogContent.dialog("close");
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


        },
        eventDrop: function (calEvent, $event) {
            $.post(myBaseUrl + "terms/owner", {id: calEvent.id}, function (data) {
                var user = jQuery.parseJSON(data);
                if (user["owner"] || user["menadzer"]) {

                    var termDate = calEvent.start.getDate();
                    var d = new Date();
                    var month = d.getMonth() + 1;
                    var today = d.getDate();

                    $.post(myBaseUrl + "settings/limit", {}, function (data) {
                        var limit = jQuery.parseJSON(data);

                        if (termDate - today < limit["limit"] && !limit["menadzer"]) {
                            alert("Termin se može mijenjati minimalno " + limit["limit"] + " dana unaprijed.");
                            $calendar.weekCalendar("refresh");
                        }
                        else {
                            $.post(myBaseUrl + "terms/move", {
                                'id': calEvent.id,
                                'start': calEvent.start.getTime() / 1000,
                                'end': calEvent.end.getTime() / 1000
                            }, null);

                        }

                    });
                }

                else {
                    alert("Možete mijenjati samo vlastite termine");
                    $calendar.weekCalendar("refresh");
                }

            });
        },
        eventResize: function (calEvent, $event) {

            $.post(myBaseUrl + "terms/owner", {id: calEvent.id}, function (data) {
                var user = jQuery.parseJSON(data);
                if (user["owner"] || user["menadzer"]) {


                    var termDate = calEvent.start.getDate();
                    var d = new Date();
                    var month = d.getMonth() + 1;
                    var today = d.getDate();

                    $.post(myBaseUrl + "settings/limit", {}, function (data) {
                        var limit = jQuery.parseJSON(data);

                        if (termDate - today < limit["limit"] && !limit["menadzer"]) {
                            alert("Termin se može mijenjati minimalno " + limit["limit"] + " dana unaprijed.");
                            $calendar.weekCalendar("refresh");
                        }
                        else {
                            $.post(myBaseUrl + "terms/move", {
                                'id': calEvent.id,
                                'start': calEvent.start.getTime() / 1000,
                                'end': calEvent.end.getTime() / 1000
                            }, null);
                        }
                    });
                }
                else {
                    alert("Možete mijenjati samo vlastite termine");
                    $calendar.weekCalendar("refresh");
                }
            });
        },
        eventClick: function (calEvent, $event) {

            if (calEvent.readOnly) {
                return;
            }

            var $dialogContent = $("#event_edit_container");
            resetForm($dialogContent);
            var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
            var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
            var titleField = $dialogContent.find("input[name='title']").val(calEvent.title);
            var statusField = $dialogContent.find("select[name='status']").val(calEvent.status)
            var bodyField = $dialogContent.find("textarea[name='body']");
            bodyField.val(calEvent.body);

            $.post(myBaseUrl + "terms/owner", {id: calEvent.id}, function (data) {
                var user = jQuery.parseJSON(data);
                if (user["owner"] || user["menadzer"]) {
                    var termDate = calEvent.start.getDate();
                    var d = new Date();
                    var month = d.getMonth() + 1;
                    var today = d.getDate();


                    $.post(myBaseUrl + "settings/limit", {}, function (data) {
                        var limit = jQuery.parseJSON(data);

                        if (termDate - today < limit["limit"] && !limit["menadzer"]) {
                            alert("Termin se može mijenjati minimalno " + limit["limit"] + " dana unaprijed.");
                            $calendar.weekCalendar("refresh");
                        }
                        else {
                            if (!user["menadzer"]) {
                                $("#status").hide();
                            }

                            $dialogContent.dialog({
                                modal: true,
                                title: "Edit - " + calEvent.title,
                                close: function () {
                                    $dialogContent.dialog("destroy");
                                    $dialogContent.hide();
                                    $('#calendar').weekCalendar("removeUnsavedEvents");
                                },
                                buttons: {
                                    save: function () {

                                        calEvent.start = new Date(startField.val());
                                        calEvent.end = new Date(endField.val());
                                        calEvent.title = titleField.val();
                                        calEvent.body = bodyField.val();
                                        calEvent.status = statusField.val();

                                        var start = calEvent.start.getTime() / 1000;
                                        var end = calEvent.end.getTime() / 1000;
                                        var title = calEvent.title;
                                        var body = calEvent.body;

                                        $.post(myBaseUrl + "terms/save", {start: start, end: end, status: calEvent.status, body: body, id: calEvent.id });
                                        $calendar.weekCalendar("updateEvent", calEvent);
                                        $dialogContent.dialog("close");
                                    },
                                    "otkaži": function () {
                                        if (confirm('Da li ste sigurni da želite otkazati termin?')) {
                                            $.post(myBaseUrl + "terms/otkazi", {id: calEvent.id});
//                                          $calendar.weekCalendar("removeEvent", calEvent.id);
                                            $dialogContent.dialog("close");
                                        }

                                    },
                                    cancel: function () {
                                        $dialogContent.dialog("close");
                                    }
                                }
                            }).show();

                            var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
                            var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
                            $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
                            setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
                            $(window).resize().resize(); //fixes a bug in modal overlay size ??

                        }

                    });
                }
                else {
                    alert("Možete mijenjati samo vlastite termine");
                }
            });
        },
        eventMouseover: function (calEvent, $event) {
        },
        eventMouseout: function (calEvent, $event) {
        },
        noEvents: function () {

        },
        data: myBaseUrl + "terms/getEvents"
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


});
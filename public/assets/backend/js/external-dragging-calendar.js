var Script = function () {


    /* initialize the external events
     -----------------------------------------------------------------*/

    $('#external-events div.external-event').each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
            zIndex: 999,
            revert: true,      // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
        });

    });


    /* initialize the calendar
     -----------------------------------------------------------------*/
    var calendarEvent = [];
    var appointmentDate = null;
    var appointmentYear = null;
    var appointmentMonth = null;
    var appointmentDay = null;
    $.ajax({
        type: 'GET',
        url: window.daliyDoUrl,
        data: {},
        dataType: 'json',
        cache: false,
        success: function (data) {
            var jsondata = eval(data.appointment);
            $.each(jsondata, function (i, item) {
                appointmentDate = item.date.split('-');
                appointmentYear = appointmentDate[0];
                appointmentMonth = parseInt(appointmentDate[1]) - 1;
                appointmentDay = parseInt(appointmentDate[2]);

                var starDate = new Date(appointmentYear, appointmentMonth, appointmentDay, item.time_from, 0);
                var endDate = new Date(appointmentYear, appointmentMonth, appointmentDay, item.time_to, 0);

                calendarEvent.push({
                    title: 'Admin ' + item.backend_user_name+'-Customer ' +item.user_id,
                    start: starDate,
                    end: endDate,
                    allDay: false,
                    url: window.appointmentEditUrl + item.id
                });
            });
            fullCalendar(calendarEvent);
        }
    });


    function fullCalendar(events) {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'agendaWeek,agendaDay'
            },
            defaultView: "agendaWeek",
            //contentHeight: 'auto',
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },

            events: events,
            allDaySlot: false
            //events: [
            //    {
            //        title: 'All Day Event',
            //        start: new Date(y, m, 1)
            //    },
            //    {
            //        title: 'Long Event',
            //        start: new Date(y, m, d - 5),
            //        end: new Date(y, m, d - 2)
            //    },
            //    {
            //        id: 999,
            //        title: 'Repeating Event',
            //        start: new Date(y, m, d - 3, 16, 0),
            //        allDay: false
            //    },
            //    {
            //        id: 999,
            //        title: 'Repeating Event',
            //        start: new Date(y, m, d + 4),
            //        allDay: true
            //    },
            //    {
            //        title: 'Meeting',
            //        start: new Date(y, m, d, 10, 30),
            //        allDay: false
            //    },
            //    {
            //        title: 'Lunch',
            //        start: new Date(y, m, d, 12, 0),
            //        end: new Date(y, m, d, 14, 0),
            //        allDay: false
            //    },
            //    {
            //        title: 'Birthday Party',
            //        start: new Date(y, m, d + 1, 19, 0),
            //        end: new Date(y, m, d + 1, 22, 30),
            //        allDay: false
            //    },
            //    {
            //        title: 'Click for Google',
            //        start: new Date(y, m, 28),
            //        end: new Date(y, m, 29),
            //        url: 'http://google.com/'
            //    }
            //]
        });

        // default agendaWeek view
        $('.fc-content .fc-time').hide();
        br();

        var constHeight = $('.fc-view-container').height();
        $('.fc-scroller').height(constHeight);

        $('.fc-agendaWeek-button').on('click', preventNoWrap);
        $('.fc-agendaDay-button').on('click', preventNoWrap);
        $('.fc-prev-button').on('click', preventNoWrap);
        $('.fc-next-button').on('click', preventNoWrap);

        $('.fc-day-header').on('click', function() {
            jumpToAgendaDay($(this));
        });

        function preventNoWrap() {
            var $basicWeekView = $('.fc-agendaWeek-view .fc-day-header'),
                currentView = $('#calendar').fullCalendar('getView');

            var i = 0,
                len = $basicWeekView.length;

            for (; i < len; i++) {
                var replaceContent = $basicWeekView.eq(i).html().replace(/\s/g, '<br>');
                $basicWeekView.eq(i).html(replaceContent);
            }
            $('.fc-scroller').height(constHeight);

            $('.fc-day-header').on('click', function() {
                jumpToAgendaDay($(this));
            });

            if (currentView.type == 'agendaDay') {
                $('.fc-content .fc-time').show();
            } else {
                $('.fc-content .fc-time').hide();
            }
            br();
        }

        function jumpToAgendaDay(obj) {
            var date = obj.data('date');
            $('#calendar').fullCalendar('changeView', 'agendaDay');
            $('.fc-content .fc-time').show();
            $('#calendar').fullCalendar('gotoDate', date);
            $('.fc-scroller').height(constHeight);
            br();
        }

        function br(){
            var a = $('.fc-title').text().replace('-','<br>');
            $('.fc-title').html(a);
        }
    }


}();
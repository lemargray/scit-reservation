var updateReservation = function (info, whichObject) {
    console.log(info.event.id);
    // if(calendar.maxTime < info.event.end){
    //     info.revert();
    // }
    var str = "<b>"+info.event.title +"</b><br><b>From:</b> " + moment(info[whichObject].start).format('dddd hh:mm a') + " - "; 
    str += moment(info[whichObject].end).format('hh:mm a') + "<br><b>to:</b> ";
    str += moment(info.event.start).format('dddd hh:mm a') + " - "; 
    str += moment(info.event.end).format('hh:mm a') + " ?"; 
    console.log(info);
    // alert(info.event.title + " was dropped on " + info.event.start.toISOString());
    Swal.fire({
        title: 'Are you sure?',
        // text: "You want to reschedule " + str,
        type: 'warning',
        showCancelButton: true,
        html: "You want to reschedule " + str,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Reschedule!'
        }).then((result) => {
            var updatedData = {_token: $('#csrf').val(), _method: 'PUT', start_date: moment(info.event.start).format('YYYY-MM-DD HH:mm'), end_date:  moment(info.event.end).format('YYYY-MM-DD HH:mm')};
            console.log(updatedData);
            if (result.value) {
                var id = info.event.id == ''?info.event.extendedProps.id:info.event.id;
                $.post('/lab-reservations/'+ id, updatedData)
                .done(function( data ) {
                    iziToast.success({
                        title: 'OK',
                        position: 'topCenter',
                        message: 'Successfully rescheduled ' + info.event.title,
                    });
                })
                .fail(function(xhr, status, error) {
                    info.revert();

                    iziToast.error({
                        title: 'FAILED!',
                        position: 'topCenter',
                        message: 'Unable to rescheduled ' + info.event.title,
                    });
                });
                
            }else{
                info.revert();
            }
        });
};

var addReservation = function (info) {
    var addData = {_token: $('#csrf').val(), 
        start_date: moment(info.event.start).format('YYYY-MM-DD HH:mm'), 
        end_date:  moment(info.event.end).format('YYYY-MM-DD HH:mm'),
        reservable_id: info.event.extendedProps.reservable_id,
        reservable_type: info.event.extendedProps.reservable_type,
        description: info.event.extendedProps.description,
        lab_id: info.event.extendedProps.lab_id,
    };

    $.post('/lab-reservations', addData)
    .done(function( data ) {
        iziToast.success({
            title: 'OK',
            position: 'topCenter',
            message: 'Lab successfully reserve for ' + info.event.title,
        });
        console.log(data);
        info.event.setExtendedProp('id', data);
        info.event.setProp('editable', true);
        console.log("id: "+info.event.extendedProps.id);
    })
    .fail(function(xhr, status, error) {
        info.event.remove();

        iziToast.error({
            title: 'FAILED!',
            position: 'topCenter',
            message: 'Unable to reserve lab for ' + info.event.title,
        });

        
    });
};

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');    

    new Draggable(containerEl, {
        itemSelector: '.fc-event',
        // eventData: function(eventEl) {
        //     var event = JSON.parse($(eventEl)[0].getAttribute('data-event'));
        //     // console.log(event);
        //   return event;
        // }
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],
        header: {
            left: 'prev,next',// today',
            center: 'title',
            right: '',///*'dayGridMonth,*/'timeGridWeek,timeGridDay'
        },        
        minTime: $('#opening_time').val(),
        maxTime: $('#closing_time').val(),
        eventOverlap: false,
        // defaultDate: '2019-04-12',
        // aspectRatio: 2.35,
        height: 'auto',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        hiddenDays: [0],
        allDaySlot: false,
        defaultView: $(window).width() < 765 ? 'timeGrid':'timeGridWeek',
        // defaultView: 'timeGridWeek',
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short'
        },
        businessHours: {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            daysOfWeek: [ 1, 2, 3, 4, 5, 6], // Monday - Thursday
            
            startTime: $('#opening_time').val(), // a start time (10am in this example)
            endTime: $('#closing_time').val(), // an end time (6pm in this example)
        },
        // selectMirror: true,  
        select: function(arg) {
            // var title = prompt('Event Title:');
            // if (title) {
            // calendar.addEvent({
            //     title: title,
            //     start: arg.start,
            //     end: arg.end,
            //     allDay: arg.allDay
            // })
            // }
            // calendar.unselect()
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: '/api/reservations/'+$('#lab-id').val(),
            failure: function(error) {
               console.log(error);
            }
        },
        eventClick: function(info){
            // console.log(info.event.startEditable);
            if(!info.event.startEditable){
                return;
            }
            Swal.fire({
                title: 'Are you sure?',
                // text: "You want to reschedule " + str,
                type: 'error',
                showCancelButton: true,
                html: "Reservation for: " + info.event.title + 
                    "<br>From: " + moment(info.event.start).format('YYYY-MM-DD HH:mm a')+ 
                    "<br>To: "+ moment(info.event.start).format('YYYY-MM-DD HH:mm a') + "<br>will be cancelled.",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Cancel!'
                }).then((result) => {
                    var updatedData = {_token: $('#csrf').val(), _method: 'DELETE'};
                    console.log(updatedData);
                    if (result.value) {
                        var id = info.event.id == ''?info.event.extendedProps.id:info.event.id;
                        $.post('/lab-reservations/'+ id, updatedData)
                        .done(function( data ) {                            
                            info.event.remove();

                            iziToast.success({
                                title: 'OK',
                                position: 'topCenter',
                                message: 'Reservation ' + info.event.title + " successfully cancelled",
                            });
                        })
                        .fail(function(xhr, status, error) {        
                            iziToast.error({
                                title: 'FAILED!',
                                position: 'topCenter',
                                message: 'Unable to cancel reservation for: ' + info.event.title,
                            });
                        });
                        
                    }
                });
        },
        eventRender: function(event, element){
            var e = document.createElement('div');
            e.innerHTML = '<div style="font-size:11px;font-style:italic">'+ event.event.extendedProps.description +'</div>';
            event.el.children[0].children[event.el.children[0].children.length-1].append(e);
        },

        eventDrop: function(info){
            updateReservation(info, 'oldEvent');
        },
        eventResize: function(info){
            updateReservation(info, 'prevEvent');
        },
        eventReceive: function(info){
            // console.log(moment().utcOffset(60));
            // alert(moment().utcOffset(-5));
            // alert(moment(info.event.start).add(1, "hour").utcOffset(-5));

            if(moment(info.event.start).add(1, "hour").utcOffset(-5).isBefore(moment().utcOffset(-5), "minutes")){
                info.event.remove();
                iziToast.error({
                    title: 'FAILED!',
                    position: 'topCenter',
                    message: 'You cannot make a reservation for a day that already passed',
                });
                return;
            }
           addReservation(info);    
        //    console.log(calendar.getEventById(7));
        //    console.log(calendar.getEventById('new').id);
        },
        // loading: function(bool) {
        //     document.getElementById('loading').style.display = bool ? 'block' : 'none';
        // }
    });
    calendar.render();
  });
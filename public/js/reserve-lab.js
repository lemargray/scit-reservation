var updateReservation = function (info, whichObject) {
    if(calendar.maxTime < info.event.end){
        info.revert();
    }
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
                $.post('../../../lab-reservations/'+info.event.id, updatedData)
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
        minTime:'8:00',
        maxTime: '21:00',
        eventOverlap: false,
        defaultDate: '2019-04-12',
        // aspectRatio: 2.35,
        height: 'auto',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        hiddenDays: [0],
        allDaySlot: false,
        defaultView: 'timeGridWeek',
        eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: 'short'
        },
        // selectMirror: true,  
        select: function(arg) {
            var title = prompt('Event Title:');
            if (title) {
            calendar.addEvent({
                title: title,
                start: arg.start,
                end: arg.end,
                allDay: arg.allDay
            })
            }
            calendar.unselect()
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: '../../api/reservations/'+$('#lab-id').val(),
            failure: function(error) {
               console.log(error);
            }
        },
        eventRender: function(event, element){
            var e = document.createElement('div');
            e.innerHTML = '<div>'+ event.event.extendedProps.description +'</div>';
            event.el.children[0].children[event.el.children[0].children.length-1].append(e);
        },

        eventDrop: function(info){
            updateReservation(info, 'oldEvent');
        },
        eventResize: function(info){
            updateReservation(info, 'prevEvent');
        },
        eventReceive: function(info){
            console.log(info);
        },
        // loading: function(bool) {
        //     document.getElementById('loading').style.display = bool ? 'block' : 'none';
        // }
    });
    calendar.render();
  });
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

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
        selectable: false,
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
        editable: false,
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
        // loading: function(bool) {
        //     document.getElementById('loading').style.display = bool ? 'block' : 'none';
        // }
    });
    calendar.render();
  });
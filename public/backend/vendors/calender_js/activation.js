if($("#calendar").length> 0 ){


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
      header: {
        left: 'title',
        center:'false' ,
        right: 'prev, title , next',
      },
      height: 954,
      defaultDate: '2020-05-12',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events

      events: [
        {
          title: 'Comment for test purpose',
          start: '2020-05-04',
          end: '2020-05-10',
          color: '#F13D80' // override!
        },
        {
          title: 'Comment for test purpose',
          start: '2020-05-04',
          end: '2020-05-10',
          color: '#B235DC' // override!
        },
        {
          title: 'Comment for test purpose',
          start: '2020-05-13',
          end: '2020-05-16',
          color: '#F13D80' // override!
        },
        {
          title: 'Comment for test purpose',
          start: '2020-05-13',
          end: '2020-05-16',
          color: '#B235DC' // override!
        },
      ],
      eventClick: function(event) {
        var modal = $("#mile_stone_view_modal");
        modal.modal();
      },
      dateClick: function(date, jsEvent, view) {
          $('#mile_stone_view_modal').modal('show');
      },
    });

    calendar.render();
  });

}
if($("#calendar2").length> 0 ){
  

  // calender 2
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar2');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
      header: {
        left: 'title',
        // center:'false' ,
        center: 'prev, title , next',
        right: false
      },
      height: 954,
      defaultDate: '2020-05-12',
      navLinks: false, // can click day/week names to navigate views
      editable: true,
      eventLimit: false, // allow "more" link when too many events
      events: [
        {
          title: 'Comment for test purpose',
          start: '2020-05-04',
          end: '2020-05-10',
          color: '#F13D80' // override!
        },
        {
          title: 'Comment for test purpose',
          start: '2020-05-04',
          end: '2020-05-10',
          color: '#B235DC' // override!
        },
        {
          title: 'Comment for test purpose',
          start: '2020-05-13',
          end: '2020-05-16',
          color: '#F13D80' // override!
        },
        {
          title: 'Comment for test purpose',
          start: '2020-05-13',
          end: '2020-05-16',
          color: '#B235DC' // override!
        },
      ],
      eventClick: function(event) {
        var modal = $("#mile_stone_view_modal");
        modal.modal();
      },
      dateClick: function(date, jsEvent, view) {
          $('#mile_stone_view_modal').modal('show');
      },
    });

    calendar.render();
  });
}

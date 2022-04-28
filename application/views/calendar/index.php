<div class="cal" >
</div>

<script type="text/javascript">
$(function() {
	$('.cal').fullCalendar({
		header: {
		   left: 'prev,next today',
		   center: 'title',
		//    right: 'month,agendaWeek,agendaDay'
		},
		// events: '<?php echo base_url(); ?>schedule_care/data_event',
		editable: true,
		droppable: true,
		eventReceive: function(event){
			console.log(event);
		},
		// eventLimit: true, // for all non-agenda views
		// views: {
		//     agenda: {
		//         eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
		//     }
		// },

		eventAfterRender: function(event, element, view) {
                      $(element).css('width','50px');
				  },

		eventRender: function(event, element) {
			console.log(element);
			// element.find(".fc-event-title").remove();
			// element.find(".fc-event-time").remove();
			// var new_description =
			//     moment(event.start).format("HH:mm") + '-'
			//     + moment(event.end).format("HH:mm") + '<br/>'
			//     + event.customer + '<br/>'
			//     + '<strong>Address: </strong><br/>' + event.address + '<br/>'
			//     + '<strong>Task: </strong><br/>' + event.task + '<br/>'
			//     + '<strong>Place: </strong>' + event.place + '<br/>'
			// ;
			// element.append(new_description);
		},

		// eventClick: function(event, jsEvent, view) {
		// 	update_schedule(event);
		// },
		// eventDrop: function(event, delta, revertFunc) {
		// 	// console.log(event);
		// 	var start = event.start.format();
// 				var end = (event.end == null) ? start : event.end.format();
// 				var schedule_id = event.schedule_id;
		// 	// console.log(schedule_id);
		// 	change_schedule(schedule_id, start);
		// },
		// dayClick: function(date, event, view) {
		// 	currentDate = date.format();
		// 	new_schedule(currentDate);
		// },
	});
});
</script>

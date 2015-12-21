var slots = new function() {

	this.get_slots = function() {

		$.get('/?a=get_meeting_slots&v=json', function(data) {

			data = $.parseJSON(data);

			slots.render_slots_list(data['slots']['slots']);

		});

	};

	this.render_slots_list = function(data) {

		var html = '';

		for(k in data) {

			if(data[k]['remaining_qty'] > 0) {

				html += '<option value="'+data[k]['slot_id']+'">'+data[k]['display_time_range']+'</option>';

			}

		}

		if(html == '') { // No slots remaining


		} else { // There are slots remaining. List them.

			html = '<select id="slot-list">'+html+'</select><button id="slot-submit">Submit</button>';

		}

		$("#slots-h").html(html).show();

		$("#slot-submit").click(function() {

			slots.submit_meeting($('#slot-list').val(), 'EM4992957214');

		});

	};

	this.submit_meeting = function(slot_id, pin) {

		$.get('/?a=reserve_slot_meeting&slot_id='+slot_id+'&pin='+pin, function(data) {

			data = $.parseJSON(data);

		});

	};
	
}

$(document).ready(function() {

	slots.get_slots();

});
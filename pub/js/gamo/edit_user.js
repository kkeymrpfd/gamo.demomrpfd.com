var edit_user = new function() {

	this.save = function(options) {

		options = Core.ensure_defaults({
			first_name: $('#edit_user_first_name').val(),
			last_name: $('#edit_user_last_name').val(),
			display_name: $('#edit_user_display_name').val(),
			email: $('#edit_user_email').val(),
			title: $('#edit_user_title').val(),
			phone: $('#edit_user_phone').val(),
			partner: $('#edit_user_partner').val(),
			user_id: $('#admin_user_id').val()
		}, options);

		$.post('/?a=admin_edit_user&v=json', options, function(data) {

			var result = $.parseJSON(data);

			if(result['msg'] != 1) {

				Core.modal({
					msg: result['msg'],
					alert: 'error'
				});

			} else {

				Core.modal({
					msg: "User information has been saved!",
					alert: 'success',
					close: 5000
				});

			}

		});

	};

};

$(document).ready(function() {

	$('#edit-user-save').click(function() {

		edit_user.save();

	});

});

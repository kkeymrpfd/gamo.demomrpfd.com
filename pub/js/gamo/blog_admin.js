var blog_admin = new function() {

	this.get = function(options) {	

		$.get('/?a=blog_action&do=list&v=json&status=all&page='+(options['page']-1)+'&status='+$('#filter_action_type').val(), function(data) {
			
			data = $.parseJSON(data);
			
			if(data['current_page'] == 2 && data['last_page'] == 1) {

				return false;

			}

			if(data['current_page'] < 1) {

				options['page'] = 1;
				blog_admin.get(options);
				return false;

			} else if(data['current_page'] > data['last_page']) {

				options['page'] = data['last_page'];
				blog_admin.get(options);
				return false;

			}

			blog_admin.render(data);

			pager.set({
				holder: options['pager'],
				current: data['current_page'],
				last: data['last_page'],
				getter_id: options['getter_id']
			});

		});

	};

	this.render = function(data, getter_id) { // Render html
		
		if(data != null
		&& data['actions'] != null
		&& data['actions'][0] != null
		&& data['actions'][0]['id'] != null) { // These are valid users
			
			var html = '<table cellspacing="0" cellpadding="0" border="0">';
			var color = '';
			var textarea = '';

			for(k in data['actions']) {

				textarea = '';

				if(data['actions'][k]['comments'] != '') {

					textarea = '<br><textarea style="margin-top:5px">'+Core.escape_html(data['actions'][k]['comments'])+'</textarea>';

				}

				switch(data['actions'][k]['status']) {
					case "1":
						color = 'deffdb';
						break;
					case "2":
						color = 'ffeded';
						break;
					default:
						color = 'fff';
				}

				html += 
				'<tr style="background-color:#'+color+'">'
					+ '<td style="padding:5px;font-size:10px;color:#555">' +data['actions'][k]['id'] + '</td>'
					+ '<td style="font-size:12px;width:160px;padding:10px"><div class="action-date">'+data['actions'][k]['time'] + '</div></td>'
					+ '<td style="width:170px;padding:10px 30px 10px 10px">' +Core.escape_html(data['actions'][k]['email']) + '</td>'
					+ '<td><div style="width:220px;font-size:13px;overflow:hidden;margin-right:10px"><a href="' + Core.escape_html(data['actions'][k]['blog_url']) + '" target="_blank">Visit Blog</a>'+textarea+'</div></td>'
					+ '<td><div class="btn" style="margin-right:10px" onclick="blog_admin.approve({step:1, blog_id:'+data['actions'][k]['id']+'})">Approve</div></td>'
					+ '<td style="padding:10px"><div class="btn btn-danger" onclick="blog_admin.reject({step:1, blog_id:'+data['actions'][k]['id']+'})">Reject</div></td>'
				+ '</tr>';

			}

			html += '</table>';

			$('#blog-holder').html(html);

		} else {

			$('#blog-holder').html("No blogs found matching this criteria");

		}

	};

	this.reject = function(options) {

		options = Core.ensure_defaults({
			step: 1,
			blog_id: -1
		}, options);

		if(options['step'] == 1) {

			Core.modal({
				msg: "Are you sure that you want to reject this blog?",
				header: 0,
				footer: '<button class="btn btn-danger" onclick="blog_admin.reject({step:2, blog_id:'+options['blog_id']+'})">Reject blog</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else {

			$.get('/?a=blog_action&v=json&do=setstatus&blog_id='+options['blog_id']+'&status=reject', function(data) {

				var result = $.parseJSON(data);
				
				if(result != null && result['msg'] != '') {
					
					Core.modal({
						msg: result['msg'],
						alert: 'error'
					});

				} else if(result == null || result['valid'] != 1) {

					Core.modal({
						msg: "There was an error while processing your request. Your changes might not have been saved",
						alert: 'error'
					});

				} else if(result['valid'] == 1) {
					
					Core.modal({
						msg: "Blog has been rejected!",
						alert: 'success',
						close: 1200
					});

					pager.get({
						holder: '#blog-holder-pager'
					});

				}

			});

		}

	};

	this.approve = function(options) {

		options = Core.ensure_defaults({
			step: 1,
			blog_id: -1
		}, options);

		$.get('/?a=blog_action&v=json&do=setstatus&blog_id='+options['blog_id']+'&status=accept', function(data) {

			var result = $.parseJSON(data);
			
			if(result != null && result['msg'] != '') {
				
				Core.modal({
					msg: result['msg'],
					alert: 'error'
				});

			} else if(result == null || result['valid'] != 1) {

				Core.modal({
					msg: "There was an error while processing your request. Your changes might not have been saved",
					alert: 'error'
				});

			} else if(result['valid'] == 1) {
				
				Core.modal({
					msg: "Blog has been approved!",
					alert: 'success',
					close: 1200
				});

				pager.get({
					holder: '#blog-holder-pager'
				});

			}

		});

	};

};

$(document).ready(function() {

	$(document).on('click', '[blog-reject-id]', function() {

		blog_admin.reject({
			step:2,
			blog_id: $(this).attr('blog-reject-id')
		});

	});

	Core.anchor_based.push({
		selector: "blog_user",
		param: "blog_user"
	});

	Core.anchor_based.push({
		selector: "blog_status",
		param: "blog_status"
	});

	Core.anchor_based_run(Core.anchor_params()['params']);

	Core.reference["blog_history"] = Core.unique_id();

	Core.functions[Core.reference["blog_history"]] = function(page, getter_id) {
		
		blog_admin.get({
			pager: "#blog-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference["blog_history"]](1, Core.reference["blog_history"]);

	$("#get_blogs_submit").click(function() {

		Core.functions[Core.reference["blog_history"]](1, Core.reference["blog_history"]);

	});

});
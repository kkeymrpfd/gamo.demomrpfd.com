var gamo_whats_new = new function() {

	this.get = function() {

		if(!Core.local_time) {

			setTimeout(function() {

				gamo_whats_new.get();

			}, 100);

		} else {

			$.get('/?a=get_whats_new&v=json', function(data) {

				var result = $.parseJSON(data);

				var html = '';

				for(k in result['whats_new']) {

					if(result['whats_new'][k]['item_type'] == 'vevent') {

						html += gamo_whats_new.vevent_html(result['whats_new'][k]);

					} else if(result['whats_new'][k]['item_type'] == 'resource') {

						html += gamo_whats_new.resource_html(result['whats_new'][k]);

					} else if(result['whats_new'][k]['item_type'] == 'whats_new') {

						html += gamo_whats_new.whats_new_html(result['whats_new'][k]);

					}

				}

				$('#whats-new-list').html(html);

			});

		}

	}

	this.vevent_html = function(data) {

		var html = '<div class="item">'
	                    +'<div class="fadeHeader">'
	                        +'<h5>New Virtual Event!</h5>'
	                        +'<h6>Posted on '+Core.local_time(data['time_added'])+'</h6>'
	                    +'</div>'
	                    +'<div class="imageBox">'
	                        +'<div class="image stretchImg"><img src="/vevent_img.php?id='+data['resource_id']+'" alt="" /></div>'
	                        +'<div class="info">'
	                            +'<h5>'+data['title']+'</h5>'
	                            +'<p>'+data['summary']+'</p>'
	                        +'</div>'
	                        +'<div class="clearer">&nbsp;</div>'
	                        +'<a href="/?p=virtual_events#delay:vevent-'+data['id']+'" class="button copyLeft">Go Now</a>'
	                    +'</div>'
	                +'</div>';

	    return html;


	}

	this.resource_html = function(data) {

		var html = '<div class="item">'
	                    +'<div class="fadeHeader">'
	                        +'<h5>New Resource!</h5>'
	                        +'<h6>Posted on '+Core.local_time(data['time_added'])+'</h6>'
	                    +'</div>'
	                    +'<div class="imageBox">'
	                        +'<div class="image stretchImg"><img src="/resource_img.php?image='+data['type']+'" alt="" /></div>'
	                        +'<div class="info">'
	                            +'<h5>'+data['title']+'</h5>'
	                            +'<p>'+data['descrip']+'</p>'
	                        +'</div>'
	                        +'<div class="clearer">&nbsp;</div>'
	                        +'<a href="/?p=resources#delay:resource-'+data['resource_id']+'" class="button copyLeft">Go Now</a>'
	                    +'</div>'
	                +'</div>';

	    return html;


	}

	this.whats_new_html = function(data) {

		var html = '<div class="item">'
	                    +'<div class="fadeHeader">'
	                        +'<h5>'+Core.safe_echo(data['title'])+'</h5>'
	                        +'<h6>Posted on '+Core.local_time(data['time_added'])+'</h6>'
	                    +'</div>'
	                    +'<div class="imageBox">'
	                        +'<div class="image stretchImg"><img src="'+data['image']+'" class="border-curved" alt="" /></div>'
	                        +'<div class="info">'
	                            +'<p>'+data['descrip']+'</p>'
	                        +'</div>'
	                        +'<div class="clearer">&nbsp;</div>'
	                        +'<a href="'+data['url']+'" class="button copyLeft">Go Now</a>'
	                    +'</div>'
	                +'</div>';

	    for(k in data['replace']) {
	    	
	    	if(data['replace'][k]['type'] == 'local_time') {
	    		
	    		html = html.replace(data['replace'][k]['key'], Core.local_time(data['replace'][k]['data'], "dddd, MMMM D, YYYY, h:mm a") );

	    	}

	    }

	    return html;


	}

};

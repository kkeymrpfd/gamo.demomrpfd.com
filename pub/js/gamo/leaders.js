/*
Retrieves actions that need to be approved by an admin
*/
var leaders = new function() {

	this.get = function(options) {

		options = Core.ensure_defaults({
			holder: 'leaders-holder'
		}, options);

		$.get('/?a=get_leaders&v=json&page='+options['start']+'&group='+options['group']+'&holder='+(options['holder']+'').substr(1), function(data) {

			var result = $.parseJSON(data);

			leaders.render(result);
	
			$('.tabs').height($('.tab.curr').outerHeight());
			
			return data;

		});

	};
    

	this.render = function(data) {

		var html = '<div class="leaderboardTop">';
        var display_name = '';
        var user_img = '';

		for(k in data['users']) {

            display_name = (data['users'][k]['user_group'] != 'company') ? data['users'][k]['display_name'] : data['users'][k]['company'];
            
            if(data['users'][k]['user_group'] != 'company') {

                user_img = '<div class="thumb stretchImg">'
                    +'<img src="user_img.php?image=759'+data['users'][k]['user_id']+'.png" alt="" />'
                +'</div>';

            }

			if(k < 3) {

				html += '<div class="leader">'
                +'<div class="rank shadow">#'+data['users'][k]['rank']+'</div>'
                + user_img
                +'<div class="name">'+display_name+'</div>'
                +'<div class="achievement">'
                    +'<div class="level">'+data['users'][k]['level']+'</div>'
                +'</div>'
                +'<div class="points">'
                    +'<h5 class="shadow">'+data['users'][k]['points']+'</h5>'
                    +'<p>Points</p>'
                +'</div>'
            +'</div>';

			}

		}

		html += '</div>';

		html += '<div class="leaderboardFull list">'
            +'<div class="listRow title">'
                +'<div class="listCell rank">Rank</div>'
                +'<div class="listCell name">Name</div>'
                +'<div class="listCell achievement">Achievement Level</div>'
                +'<div class="listCell points">Points</div>'
            +'</div>';

        for(k in data['users']) {

        	if(k >= 3) {

        		html += '<div class="listRow">'
                +'<div class="listCell rank">#'+data['users'][k]['rank']+'</div>'
                +'<div class="listCell name">'+data['users'][k]['display_name']+'</div>'
                +'<div class="listCell achievement">'+data['users'][k]['level']+'</div>'
                +'<div class="listCell points">'+data['users'][k]['points']+'</div>'
            +'</div>'

        	}

        }

        html += '</div>';

		$(data['holder']).html(html);

	};

};

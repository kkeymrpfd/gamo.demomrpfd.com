<?
Core::get_element ( 'game_header' );
$demandgen_points = Core::r ( 'actions' )->get_action_points ( 'send_demandgen' );
?>
/start_view
/css: /css/bootstrap-tagsinput.css
/js: /js/bootstrap-tagsinput.min.js
<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
			<?
			
			Core::get_element ( 'game_nav' );
			?>
/start_view
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 content2 non-meetings">
				<div id="sent-msg" style="margin:20px 0px;display:none"><div class="alert alert-success">Your demand gen email has been succesfully processed! The contacts you provided will be receiving their emails shortly!</div></div>
				<div class="hidden-xs">
					<div class="module-title">Demand Gen</div>
					<h4 style="line-height: 24px;">Send demand gen emails to prospects through MRP Gamification.</h4>
				</div>
				<div class="visible-xs">
					<div class="content widget">
						<h1>Sales Resources</h1>
						<h5>Below you will find valuable information regarding MRP products and solutions to help better prepare you for the sales process. Look for new assets periodically to earn even more points and rewards.</h5>
					</div>
				</div>
				<div class="bluebackground widget">
                <div class="table">
                    	
                    <div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>$50</h2>
							</div>
						<div class="table-cell cell-desc">Send emails in the content module to at least 300 valid recipients</div>
					</div>

					<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<div>2 pts per contact</div>
							</div>
						<div class="table-cell cell-desc">' . Core::r('actions')->get_action_name('send_demandgen') . '</div>
					</div>

                      
						</div>
				</div>		
				
/end_view	

				<?
				
				foreach ( $data ['email_templates'] ['records'] as $entry ) {
					?>								
				/start_view
				<div class="content widget"> 
					<div class="media">
						<div class="pull-left">
							<div class="media-object"> <img src="img/email.png" alt="">
								<p><a href="/?p=demandgen_send&email_template_id=' . $entry['email_template_id'] . '" class="btn bluebackground btn-block">Send</a></p>
							</div>
						</div>
						<div class="media-body" style="color:#333">
							<h4 class="media-heading">' . $entry['title'] . '</h4>
							' . $entry['description'] . '
							<div style="font-weight:bold;color:#db5034;margin-top:10px"><i>Sent to ' . $entry['sent_qty'] . ' contacts so far (+' . ($entry['sent_qty'] * $demandgen_points) . ' pts)</i></div>
						</div>
					</div>
					<div class="media">
						<div id="resource-show-'.$entry['resource_id'].'"></div>
					</div>
				</div>
				/end_view
				<?
				}
				?>
				
/start_view				
	</div>
</div>
<script language="javascript">
$(document).ready(function() {

	if(window.location.hash.indexOf("sent") != -1) {

		window.location.hash = "";

		$("#sent-msg").fadeIn(300);
		$("html,body").animate({
		   scrollTop: $("#sent-msg").offset().top - 10
		});

		setTimeout(function() {

			$("#sent-msg").fadeOut(300);

		}, 6000);

	}

});
</script>
/end_view
<?
Core::get_element ( 'game_footer' );
?>

<?
Core::get_element('game_header');
?>
/start_view
/js: /js/pickaday.js
/css: /css/pickaday.css
/js: /js/gamo/meetings.js
/js: /js/gamo/badge_check.js
<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1 class="title">Thank you for playing trivia!</h1>
		</div>
	</div>
	<div class="spacer">
	</div>
	<center><a href="/?p=profile" class="btn btn-primary" style="border:none;font-size:1.1em;color:#fff">Return to Dashboard</div></a>
</div>
/end_view
<? if($data['badge_check']['badge_id'] != -1) { ?>
/start_view
<script language="javascript">
$(document).ready(function() {
	
	badge_check.render($.parseJSON(\'' . json_encode($data['badge_check']) . '\'));

});
</script>
/end_view
<?
}
Core::get_element('game_footer');
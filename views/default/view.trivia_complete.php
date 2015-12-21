<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script type="text/javascript" src="/js/pickaday.js"></script>
<link rel="stylesheet" type="text/css" href="/css/pickaday.css">
<script type="text/javascript" src="/js/gamo/meetings.js"></script>
<script type="text/javascript" src="/js/gamo/badge_check.js"></script>
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
'; ?>
<? if($data['badge_check']['badge_id'] != -1) { ?>
<? $view_output .= '
<script language="javascript">
$(document).ready(function() {
	
	badge_check.render($.parseJSON(\'' . json_encode($data['badge_check']) . '\'));

});
</script>
'; ?>
<?
}
Core::get_element('game_footer');
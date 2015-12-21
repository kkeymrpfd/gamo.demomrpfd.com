<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script type="text/javascript" src="/js/gamo/quiz_pin.js"></script>
<div style="margin:20px">
	<div class="panel panel-default">
  		<div class="panel-body" style="text-align:center">
			<form id="pin-form" class="form-horizontal" role="form">
			  <div id="result-msg"></div>
			  <div class="form-group">
			    <div style="color:#000">Enter the pin that Max D\'Ductible will announce:</div>
			    <div style="margin:1em">
			      <input type="text" class="form-control" id="pin" name="pin" placeholder="pin" style="color:#000;font-weight:bold" >
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary" style="font-weight:bold">Continue</button>
			    </div>
			  </div>
			<input type="hidden" id="quiz_id" value="' . $data['quiz_id'] . '">
			</form>
		</div>
	</div>
</div>
'; ?>
<?
Core::get_element('game_footer');
?>

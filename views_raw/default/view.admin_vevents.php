/start_view
/js: /js/gamo/admin_users.js
/js: /js/pager.js
/js: /js/gamo/vevents.js
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
/css: /css/jquery-ui.css
<div style="width:600px;text-align:left">
	<button id="add-vevent-toggle" class="btn btn-primary"><i class="icon-plus icon-white"></i> Create new virtual event</button>
	<div id="new-vevent-holder" style="margin:15px 0px 15px -50px">
		<form class="form-horizontal" action="/?a=admin_create_vevent" target="create-vevent-frame" method="post" enctype="multipart/form-data" style="margin:0px">
			<div class="control-group">
				<label class="control-label" for="vevent_title">Title:</label>
				<div class="controls">
				  <input type="text" name="vevent_title" id="vevent_title" placeholder="Title">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="vevent_date">Date:</label>
				<div class="controls">
				  <input type="text" name="vevent_date" id="vevent_date" placeholder="Date" readonly="true">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="vevent_title">Time:</label>
				<div class="controls">
					<select name="vevent_time" id="vevent_time">
						<option value="500">5:00 am</option>
						<option value="530">5:30 am</option>
						<option value="600">6:00 am</option>
						<option value="630">6:30 am</option>
						<option value="700">7:00 am</option>
						<option value="730">7:30 am</option>
						<option value="800">8:00 am</option>
						<option value="830">8:30 am</option>
						<option value="900">9:00 am</option>
						<option value="930">9:30 am</option>
						<option value="1000">10:00 am</option>
						<option value="1030">10:30 am</option>
						<option value="1100">11:00 am</option>
						<option value="1130">11:30 am</option>
						<option value="1200">12:00 pm</option>
						<option value="1230">12:30 pm</option>
						<option value="1300">1:00 pm</option>
						<option value="1330">1:30 pm</option>
						<option value="1400">2:00 pm</option>
						<option value="1430">2:30 pm</option>
						<option value="1500">3:00 pm</option>
						<option value="1530">3:30 pm</option>
						<option value="1600">4:00 pm</option>
						<option value="1630">4:30 pm</option>
						<option value="1700">5:00 pm</option>
						<option value="1730">5:30 pm</option>
						<option value="1800">6:00 pm</option>
						<option value="1830">6:30 pm</option>
						<option value="1900">7:00 pm</option>
						<option value="1930">7:30 pm</option>
						<option value="2000">8:00 pm</option>
						<option value="2030">8:30 pm</option>
						<option value="2100">9:00 pm</option>
						<option value="2130">9:30 pm</option>
						<option value="2200">10:00 pm</option>
						<option value="2230">10:30 pm</option>
						<option value="2300">11:00 pm</option>
						<option value="2330">11:30 pm</option>
						<option value="2400">12:00 am</option>
					</select> <span style="font-size:12px">(eastern time)</span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="vevent_descrip">Description:</label>
				<div class="controls">
				  <textarea name="vevent_descrip" id="vevent_descrip" style="width:350px;height:175px"></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="vevent_email">E-mail Image:</label>
				<div class="controls">
				  <input type="file" name="vevent_email" id="vevent_email" style="margin:8px 0px">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="vevent_url">Url:</label>
				<div class="controls">
				  <input type="text" name="vevent_url" id="vevent_url" placeholder="URL">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-success" style="margin:0px 10px 0px 210px">Submit</button>
					<button class="btn" onclick="$(\'#new-vevent-holder\').slideToggle();return false">Cancel</button>
				</div>
			</div>
		</form>
	</div>
	<iframe id="create-vevent-frame" style="width:600px;height:300px"></iframe>
	<div id="vevents-list-holder"></div>

	<div id="delete-vevent-modal" style="display:none">
		How would you like to proceed?
		<form class="form-horizontal" style="margin:20px 0px 0px -190px" onsubmit="return false">
		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="radio" name="delete-vevent-type" value="vevent" checked="checked"> Delete the vevent, but leave points/badges awarded for downloading or sharing it
				</label>
			</div>
			<div class="controls">
				<label class="checkbox">
					<input type="radio" name="delete-vevent-type" value="all"> Delete the vevent, AND any points/badges awarded for downloading or sharing it
				</label>
			</div>
		</div>
	</div>

</div>
<script language="javascript">
$(document).ready(function() {

	$("#add-vevent-toggle").click(function() {

		$("#new-vevent-holder").slideToggle();

	});

	$("#vevent_date").datepicker();

});
</script>
/end_view
<?
Core::get_element('game_header');
?>
/start_view
/css: /css/bootstrap-tagsinput.css
/js: /js/bootstrap-tagsinput.min.js
<div class="row" id="demandgen-h">
	<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
	<? Core::get_element('game_nav'); ?>
/start_view
	</div>
	<div class="col-md-8 col-sm-8 col-xs-12 content2 non-meetings">
		<div class="hidden-xs">
			<div class="module-title">Demand Gen</div>
		</div>			
	</div>
	<div class="col-md-8 col-sm-8 col-xs-12">
		<div id="demandgen-result-h" style="margin:15px 0px;display:none"></div>
		How would you like to enter your recipients?
		<select id="list_type" style="margin-left:10px">
			<option value="upload">Upload List</option>
			<option value="manual">Manual Entry</option>
		</select>
		<div class="table" style="margin-top:20px;display:none" id="manual_entry">
			<div class="table-row">
				<div class="table-cell" style="width:230px">
					<label for="recipients">Please enter the e-mail addresses of the recipients you would like to send this e-mail to. You can send an email to up to 200 contacts.</label>
				</div>
				<div class="table-cell" style="padding-left:20px;vertical-align:top">
					<div style="width:300px"><select multiple data-role="tagsinput" id="recipients" class="recipients"></select></div>
				</div>
			</div>
		</div>
		<div class="table" style="margin-top:20px;display:none" id="upload_entry">
			<div id="list-error" style="margin:20px 0px;display:none"></div>
			<form id="recipients-form" action="/?a=upload_demandgen_list" target="recipients-frame" method="post" enctype="multipart/form-data" style="margin:0px">
				<div class="table-row">
					<div class="table-cell" style="width:230px">
						<label for="recipients_file">Please upload a list or recipients in a csv spreadsheet. There should be one column with the email addresses of the recipients. You can send an email to up to 200 contacts.</label>
					</div>
					<div class="table-cell" style="padding-left:20px;vertical-align:top">
						<input type="file" name="recipients_file" id="recipients_file" style="margin:8px 20px;display:inline-block">
					</div>
				</div>
			</form>
		</div>
		<iframe id="recipients-frame" name="recipients-frame" style="display:none"></iframe>
		<div class="form-group">
			<label for="subject">Subject</label>
			<input type="text" class="form-control" id="subject" style="display:inline-block;width:450px;margin-left:20px;color:#000" value="' . Core::safe_echo($data['email_template']['subject']) . '">
			<a style="color:#428bca" id="subject-reset">Reset</a>
		</div>
		<div class="form-group">
			<div id="image-error" style="margin:20px 0px;display:none"></div>
			<form id="logo-image-form" action="/?a=upload_demandgen_image" target="logo-image-frame" method="post" enctype="multipart/form-data" style="margin:0px">
				<label for="demandgen_logo">Your partner logo</label>
				<input type="file" name="demandgen_logo" id="demandgen_logo" style="margin:8px 20px;display:inline-block">
				<br>This should be an image file that is at least 80 x 80 pixes large and no more than 10 mb in size.
			</form>
		</div>
		/end_view
		<? if(isset($data['email_template']['settings']['redirect_url'])) { ?>
		/start_view
		<div class="form-group">
			<label for="redirect_url">' . Core::safe_echo($data['email_template']['settings']['redirect_url']['name']) . '</label>
			<input type="text" class="form-control" id="redirect_url" style="display:inline-block;width:450px;margin-left:20px;color:#000" placeholder="' . Core::safe_echo($data['email_template']['settings']['redirect_url']['hint']) . '">
		</div>
		/end_view
		<? } ?>
		/start_view
		<iframe id="logo-image-frame" name="logo-image-frame" style="display:none"></iframe>
		<div class="form-group">
			<label for="message">Preview:</label>
			<a style="color:#428bca" id="preview-open" target="demandgen_preview">Open in new window</a>
			<br><iframe style="width:100%;height:500px;border: solid 1px #ccc" id="demandgen_preview"></iframe>
		</div>
		<p class="pull-right">
			<button type="button" class="btn bluebackground" style="color:#db5034" id="send-b">Send</button>
		</p>
		<input type="hidden" id="email_template_id" value="' . $data['email_template_id'] . '">
		<input type="hidden" id="logo_file" value="' . $data['email_template_id'] . '">
	</div>
</div>
<script src="js/gamo/demandgen.js?t=' . time() . '"></script>
/end_view
<?
Core::get_element('game_footer');
?>

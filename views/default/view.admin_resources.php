<? $view_output .= '
<script type="text/javascript" src="/js/gamo/admin_users.js"></script>
<script type="text/javascript" src="/js/pager.js"></script>
<script type="text/javascript" src="/js/gamo/resources.js"></script>
<div style="width:600px;text-align:left">
	<button id="add-resource-toggle" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add New Resource</button>
	<div id="new-resource-holder" style="margin:15px 0px 15px -50px;display:none">
		<form class="form-horizontal" action="/?a=admin_create_resource" target="create-resource-frame" method="post" enctype="multipart/form-data" style="margin:0px">
			<div class="control-group">
				<label class="control-label" for="resource_title">Title</label>
				<div class="controls">
				  <input type="text" name="resource_title" id="resource_title" placeholder="Title">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="resource_descrip">Description</label>
				<div class="controls">
				  <textarea name="resource_descrip" id="resource_descrip" style="width:350px;height:175px"></textarea>
				</div>
			</div>
			<div class="control-group" id="resource-type-holder">
				<label class="control-label" for="resource_file">File</label>
				<div class="controls">
				  <select name="resource_type" id="resource_type">
				  	<option value="spreadsheet">Spreadsheet</option>
				  	<option value="doc">Document</option>
				  	<option value="pdf">PDF</option>
				  	<option value="video">Video</option>
				  	<option value="image">Image</option>
				  </select>
				</div>
			</div>
			<div class="control-group" id="file-upload-holder" style="display:none">
				<label class="control-label" for="resource_file">File</label>
				<div class="controls">
				  <input type="file" name="resource_file" id="resource_file" style="margin:8px 0px">
				</div>
			</div>
			<div class="control-group" id="video-embed-holder" style="display:none">
				<label class="control-label" for="resource_embed">Video Embed:</label>
				<div class="controls">
				  <textarea name="resource_embed" id="resource_embed" style="width:330px"></textarea>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-success" style="margin:0px 10px 0px 210px">Submit</button>
					<button class="btn" onclick="$(\'#new-resource-holder\').slideToggle();return false">Cancel</button>
				</div>
			</div>
		</form>
		<iframe id="create-resource-frame"></iframe>
	</div>
	<div id="resources-list-holder"></div>

	<div id="delete-resource-modal" style="display:none">
		How would you like to proceed?
		<form class="form-horizontal" style="margin:20px 0px 0px -190px" onsubmit="return false">
		<div class="control-group">
			<div class="controls">
				<label class="checkbox">
					<input type="radio" name="delete-resource-type" value="resource" checked="checked"> Delete the resource, but leave points/badges awarded for downloading or sharing it
				</label>
			</div>
			<div class="controls">
				<label class="checkbox">
					<input type="radio" name="delete-resource-type" value="all"> Delete the resource, AND any points/badges awarded for downloading or sharing it
				</label>
			</div>
		</div>
	</div>

</div>
<script language="javascript">
$(document).ready(function() {

	$("#add-resource-toggle").click(function() {

		$("#new-resource-holder").slideToggle();

	});

	gamo_resources.admin_resources();

});
</script>
'; ?>
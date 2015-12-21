<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script src="js/core.js"></script>
<script src="/js/gamo/gamo.js"></script>
<script src="/js/gamo/register.js"></script>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<!-- InstanceBeginEditable name="content" -->
		<div class="content widget profile">
			<h1>Edit Profile</h1>
			
			<form id="user-img-form" action="/?a=upload_user_img" target="user-img-frame" method="post" enctype="multipart/form-data" style="margin:0px">
                       <div class="media">
							<div class="pull-left"> <img src="/user_img.php?image=' . $data['user_id'] .'" class="media-object" alt="" style="border-radius:80px"> </div>
							<div class="media-body">
								<p>Upload new image</p>
								<p>
									<input type="hidden" name="MAX_FILE_SIZE" value="10800000" />
									<input type="file" name="file" id="file" style="margin:8px 0px">
								</p>
							</div>
							<div class="pull-right" style="font-size: 12px;">
							<br>
								Please use an image file (PNG, JPEG, JPG, or GIF) with similar width and height for uploaded photo.
							</div>
					  </div>
					  <iframe id="user-img-frame" name="user-img-frame" style="display:none"></iframe>
            </form>
            
			<p>&nbsp;</p>
			<form class="form-horizontal" role="form" id="register-form">
				<div class="form-group">
					<div class="col-sm-9" id="reg-result-h"></div>
				</div>
				<div class="form-group">
					<label for="first_name" class="col-sm-2 control-label">First Name</label>
					<div class="col-sm-10">
						<input type="hidden" class="form-control" id="user_id" value="' . $data['user']['user_id'] . '">
						<input type="text" class="form-control" id="first_name" value="' . $data['user']['first_name'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="last_name" class="col-sm-2 control-label">Last Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="last_name" value="' . $data['user']['last_name'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="title" value="' . $data['user']['title'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="company" class="col-sm-2 control-label">Company</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="company" value="' . $data['user']['company'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" value="' . $data['user']['email'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-2 control-label">Phone</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="phone" value="' . $data['user']['phone'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="country" class="col-sm-2 control-label">Country</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="country" value="' . $data['user']['country'] . '">
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 control-label">Choose Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password">
					</div>
				</div><div class="form-group">
					<label for="passwordConfirm" class="col-sm-2 control-label">Re-Enter Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="password2">
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn bluebackground pull-right">Submit</button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" id="text-message">
						
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- InstanceEndEditable -->
	</div>
</div>
<script language="javascript">
$(document).ready(function() {

	$("#file").on("change", function(e) {

		$("#user-img-form").trigger("submit");

	});

});
</script>
'; ?>
<?
Core::get_element('game_footer');
?>
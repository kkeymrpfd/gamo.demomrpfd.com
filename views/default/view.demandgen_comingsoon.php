<?
Core::get_element ( 'game_header' );
?>
<? $view_output .= '
<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript" src="/js/gamo/resources.js"></script>
<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
'; ?>
			<?
			
			Core::get_element ( 'game_nav' );
			?>
<? $view_output .= '
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 content2 non-meetings">
				<div class="hidden-xs">
					<div class="module-title">Demand Gen</div> 
					<h4 style="line-height: 24px;">Coming Soon: Share assets with prospects through MRP Gamification to earn points and rewards.</h4>
				</div>
				<div class="visible-xs">
					<div class="widget content">
						<h1>Demand Gen</h1>
						<h4>Coming Soon: Share assets with prospects through MRP Gamification to earn points and rewards.</h4>
					</div>
				</div>
				<div class="bluebackground widget" style="display:none">
                
                <div class="table">
                    <div class="table-row">
                    	<div class="table-cell align-left" style="width:28%">
								<h2>' . Core::r('actions')->get_action_points('share_resource') . ' pts</h2>
							</div>
						<div class="table-cell">' . Core::r('actions')->get_action_name('share_resource') . '</div>
						</div>
                       </div> 
                <div class="media">*You can earn up to a max of 500 points/month.</div>
				</div>
'; ?>		
				<?
				
				foreach ( $data ['resources'] as $news_item ) :
					?>
						
				<? $view_output .= '
				<div class="content widget">
					<div class="media">
						<div class="pull-left">
							<div class="media-object"> <img src="/resource_img.php?image=' . $news_item['type'] . '" alt="">
								<p><a class="btn bluebackground btn-block" data-other="' . $news_item['resource_id'] . '" data-toggle="modal" data-target="#myModal">Send</a></p>
							</div>
						</div>
						<div class="media-body">
							<h4 class="media-heading">' . $news_item['title'] . '</h4>
							<p>' . $news_item['descrip'] . '</p>
						</div>
					</div>
				</div>
				'; ?>		
						
				<?
				endforeach
				;
				?>
<? $view_output .= '				
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content" style="background-color:#fff">
					<div class="modal-header">
						<button style="font-size: 25px;" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form role="form" id="share-form">
							<div class="form-group">
								<div id="share_error"></div>
							</div>
							<div class="form-group">
								<label for="recipients">Recipients</label>
								<div class="table">
                    				<div class="table-row">
										<div class="table-cell">
											<select id="recipients" style="width:350px" class="form-control" multiple="multiple"></select>
										</div>
										<div class="table-cell" style="padding-left:20px">
											<input type="file" name="recipients_upload" id="recipients_upload" style="margin:8px 0px">
										</div>
									</div>
								</div>
								You can manually enter the e-mail addresses of the people you would like to send this e-mail to in the field above, or you can upload a spreadsheet. If uploading a spreadsheet, please upload a file with 1 column and all email addresses in that column.
							</div>
							<div class="form-group">
								<label for="subject">Subject</label>
								<input type="subject" class="form-control" id="email">
								<input type="hidden" id="modal_resource_id" value="0" />
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<img src="/img/email_sample.png">
								<textarea class="form-control" id="message" style="height:250px;text-align:left;display:none">
Hi,

[name] has shared a resource with you through MRP Gamification. To download it, please click here:

[link]

Regards,

MRP Gamification
								</textarea>
							</div>
							<p class="pull-right">
								<button type="button" class="btn bluebackground" style="color:#db5034" id="send-form">Send</button>
							</p>
						</form>
					</div>
					<div class="modal-footer">
					</div>
				</div>
		<!-- InstanceEndEditable -->
	</div>
</div>
<script language="javascript">
$(document).ready(function() {

	$("#recipients").select2({
	  tags: true
	});

});
</script>
'; ?>
<?
Core::get_element ( 'game_footer' );
?>
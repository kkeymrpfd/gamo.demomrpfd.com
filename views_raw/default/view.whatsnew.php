<?
Core::get_element ( 'game_header' );
?>
/start_view
/js: /js/gamo/resources.js
<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
			<?
			
Core::get_element ( 'game_nav' );
			?>
/start_view
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 content2">
				<div class="module-title hidden-xs">What\'s New</div>
/end_view		
			<?
			
			$count = 0;
			foreach ( $data ['whats_new'] as $news_item ) :
				
				if ($news_item ['item_type'] == 'resource') :
					?>
								
							<?
					
if ($news_item ['type'] == 'video') :
						?>
							
								<?
						
$action_button_name = 'Watch';
						?>
								<?
						
$action_button_url = '#';
						?>
								<?
						
$action_button_action = 'gamo_resources.show_video({ resource_id: ' . $news_item ['resource_id'] . ' });return false;';
						?>
								
							
					 <?
else :
						?>
							
							   	<?
						
$action_button_name = 'Download';
						?>
								<?
						
$action_button_url = '/?a=download_resource&resource_id=' . $news_item ['resource_id'];
						?>
								<?
						
$action_button_action = '';
						?>
								
							
					<?
endif;
					?>
									
							/start_view
							<div class="content widget">
								/end_view
								<?
					
if ($count == 0) :
						?>
									/start_view
									<h1 class="visible-xs"><img src="img/Header_WhatsNew.png">What&#39;s New</h1>
									/end_view
									<?
						
$count ++;
						?>
								
					<?endif;
					?>
								/start_view
								<div class="media">
									<div class="pull-left">
										<div class="media-object"> <img width="60" src="/resource_img.php?image=' . $news_item['type'] . '" alt="">
											<p><a class="btn bluebackground btn-block" target="_blank" onclick="' . $action_button_action . '" href="' . $action_button_url . '">' . $action_button_name . '</a></p>
										</div>
									</div>
									<div class="media-body">
										<h4 class="media-heading">' . $news_item['title'] . '</h4>
										<p>' . $news_item['descrip'] . '</p>
									</div>
								</div>
								<div class="media">
									<div id="resource-show-'.$news_item['resource_id'].'"></div>
								</div>
							</div>
							
							/end_view
				
				
				<? endif;
				
				if ($news_item ['item_type'] == 'whats_new') :
					
					?>
			
				/start_view
				<div class="content widget">
					<div class="media">
						<div class="pull-left">
							<div class="media-object"> <img width="60" src="' . $news_item['image'] . '" alt="">
								<p><a class="btn bluebackground btn-block" href="' . $news_item['url'] . '" target="_blank">Go Now</a></p>
							</div>
						</div>
						<div class="media-body">
							<h4 class="media-heading">' . $news_item['title'] . '</h4>
							<p>' . $news_item['descrip'] . '</p>
						</div>
					</div>
				</div>
				/end_view
				
				
				<? endif;
				?>

			<?
			
endforeach
			;
			?>


/start_view				
	</div>
</div>
/end_view
<?
Core::get_element ( 'game_footer' );
?>
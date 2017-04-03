<?
Core::get_element ( 'game_header' );
?>
<? $view_output .= '
<script type="text/javascript" src="/js/gamo/resources.js"></script>
<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
'; ?>
			<?
			
Core::get_element ( 'game_nav' );
			?>
<? $view_output .= '
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 content2">
				<div class="module-title hidden-xs">What\'s New</div>
'; ?>		
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
									
							<? $view_output .= '
							<div class="content widget">
								'; ?>
								<?
					
if ($count == 0) :
						?>
									<? $view_output .= '
									<h1 class="visible-xs"><img src="img/Header_WhatsNew.png">What&#39;s New</h1>
									'; ?>
									<?
						
$count ++;
						?>
								
					<?endif;
					?>
								<? $view_output .= '
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
							
							'; ?>
				
				
				<? endif;
				
				if ($news_item ['item_type'] == 'whats_new') :
					
					?>
			
				<? $view_output .= '
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
				'; ?>
				
				
				<? endif;
				?>

			<?
			
endforeach
			;
			?>


<? $view_output .= '				
	</div>
</div>
'; ?>
<?
Core::get_element ( 'game_footer' );
?>
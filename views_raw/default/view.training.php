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
			<div class="col-md-8 col-sm-8 col-xs-12 content2 non-meetings">
				<div class="hidden-xs">
					<div class="module-title">Sales Resources</div>
					<h4 style="line-height: 24px;">Below you will find valuable information regarding MRP marketing products and solutions to help better prepare you for the sales process. Look for new assets periodically to earn even more points and rewards.</h4>
				</div>
				<div class="visible-xs">
					<div class="content widget">
						<h1>Sales Resources</h1>
						<h5>Below you will find valuable information regarding MRP Marketing products and solutions to help better prepare you for the sales process. Look for new assets periodically to earn even more points and rewards..</h5>
					</div>
				</div>
				<div class="bluebackground widget">
                <div class="table">
                    	
                    	<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>$30</h2>
							</div>
						<div class="table-cell cell-desc">Download at least 5 resources from the sales resources section</div>
					</div>

					<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>' . Core::r('actions')->get_action_points('download_resource') . ' pts</h2>
							</div>
						<div class="table-cell cell-desc">' . Core::r('actions')->get_action_name('download_resource') . '</div>
					</div>

                      
						</div>        
				</div>
				<center>
				<a name="r"></a>
				<div style="margin-bottom:40px">	
					View Resources: <select id="resource_category" style="background-color:#fff;font-size:1.4em">
/end_view
<?php

foreach ( $data ['resource_categories'] as $k => $v ) {
	?>
/start_view
<option value="' . $k . '"' . $v['selected'] . '>' . $v['label'] . '</option>
/end_view
<?

}
?>
/start_view
					</select>
				</div>
				</center>
				
/end_view	

				<?
				
foreach ( $data ['resources'] as $news_item ) :
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
					<div class="media">
						<div class="pull-left">
							<div class="media-object"> <img src="/resource_img.php?image=' . $news_item['type'] . '" alt="">
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

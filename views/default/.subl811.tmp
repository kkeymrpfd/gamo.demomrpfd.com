<?
Core::get_element('game_header');

$group_one_max = 3;
$group_two_max = 6;
$group_three_max = 9;

?>
<? $view_output .= '
		<div class="content widget leaderboards">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12"> 
					<h1>Leaderboard</h1>
					
'; ?>
					<? foreach($data['leaders']['users'] as $index => $leader): 
					
							$rank_up = '';
					
							if( $leader['rank'] == 1 ){
								$rank_up = 'st';
							}elseif( $leader['rank'] == 2 ){
								$rank_up = 'nd';
							}elseif( $leader['rank'] == 3 ){
								$rank_up = 'rd';
							}elseif( $index < $group_three_max ){
								$rank_up = 'th';
							}
							
							$img = 80;
							$hnum = 2;
							
							if( $index >= $group_one_max ){
								$img = 60;
								$hnum = 4;
							}
							
							
							if($index == $group_one_max): ?>
<? $view_output .= '
										</div>
									</div>
								</div>
								<div class="content connectedwidget leaderboards2 lightgreybackground">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12"> 

'; ?>
							<? endif; ?>
							
							

							
							<? if($index == $group_three_max): ?>
<? $view_output .= '

										</div>
									</div>
								</div>
								<div class="content connectedwidget darkgreybackground leaderboards3">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<table class="table borderless">
												<thead>
													<tr>
														<th>Rank</th>
														<th>Name</th>
														<th>Achievement Level</th>
														<th>Points</th>
													</tr>
												</thead>
												<tbody>
'; ?>
							<? endif; ?>
							
					
							<? if( $index < $group_three_max ): ?>
<? $view_output .= '
							<div class="row mtop15 hidden-xs">
									'; ?>
										<? 
											//$img = $img/2; 
											$hnum = $hnum*2;
										?>
									<? $view_output .= '
								<div class="col-sm-2 col-xs-6">
									<h1>' . $leader['rank'] .'<sup>' . $rank_up . '</sup></h1>
								</div>
								<div class="col-sm-3 ">
									<img class="leader-image" src="/user_img.php?image=' . $leader['user_id'] .'" alt="80x80" style="width: '.$img.'px; height: '.$img.'px;">
								</div>
								<div class="col-sm-4 col-xs-6"  style="padding-left: 2%;">
									<h'.$hnum.' class="display-name">' . $leader['display_name'] .'.</h'.$hnum.'>
								</div>
								<div class="col-sm-3 col-xs-6">
									<p><span class="score">' . $leader['points'] .'</span> pts</p>
								</div>
							</div>
							
							<div class="row mtop15 visible-xs">
								<div class="col-sm-2 col-xs-2">
									<h3>' . $leader['rank'] .'<sup>' . $rank_up . '</sup></h3>
								</div>
								<div class="col-sm-3 col-xs-3">

									<img class="leader-image" src="/user_img.php/?image=' . $leader['user_id'] .'" alt="80x80" style="width: '.$img.'px; height: '.$img.'px;">
								</div>
								<div class="col-sm-4 col-xs-4"  style="padding-left: 2%">
									<h'.$hnum.'>' . $leader['display_name'] .'.</h'.$hnum.'>
								</div>
								<div class="col-sm-3 col-xs-2">
									<p><span class="score" style="font-size: 18px">' . $leader['points'] .'</span> pts</p>
								</div>
							</div>
'; ?>						
							
							<? else: ?>
<? $view_output .= '						
							<tr>
								<td>#' . $leader['rank'] .'</td>
								<td>' . $leader['display_name'] .'.</td>
								<td>' . $leader['level'] .'</td>
								<td>' . $leader['points'] .'</td>
							</tr>
'; ?>							
							<? endif; ?>

					<? endforeach; ?>
		
<? $view_output .= '
						</tbody>
					</table>
				
				</div>
			</div>
		</div>
		<!-- InstanceEndEditable -->

'; ?>
<?
Core::get_element('game_footer');
?>
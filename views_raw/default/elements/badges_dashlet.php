/start_view
<div class="badges widget" style="padding:0" id="badges-widget">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<center><h3 class="media-h3" id="badge-h3">Badges/Rewards</h3></center> 
		</div>

		
	</div>
	<div class="badges-border"></div>
	<div style="padding:1em">
/end_view
<? foreach($data['badges'] as $k => $badge) {  
	
	?>
/start_view
<div class="col-md-4 col-sm-12">
	<br>
	<a href="?p=badges"><img id="badge-' . $badge['badge_id'] . '" src="/img/badges/' . $badge['badge_id'] . '' . Core::condition_output($badge['user_has'], '-active', '-inactive') .'.png" class="img-circle img-responsive center-block image-75 ' . Core::condition_output($badge['user_has'], 'active-badge', 'inactive-badge') .'" data-badge="' . $badge['badge_id'] . '"></a>
</div>
/end_view
<? 
} 

$mod=($k+1)%3;
if($mod !=0){
	
	for($i=$mod;$i<3;$i++){ ?>
		
		
		/start_view
		<div class="col-md-4 col-sm-12">
		<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;
		</div>
		/end_view
		
		
<?	}
	
}

?>
/start_view
		<center>
			<p><button class="dashlet-link blue" href="/?p=badges" style="margin-top:10px">View all rewards</button></p>
		</center>
	</div>
</div>
/end_view
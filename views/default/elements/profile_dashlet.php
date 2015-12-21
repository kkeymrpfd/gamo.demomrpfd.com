<? $view_output .= '
<div class="col-md-4 col-sm-4 hidden-xs">
	<div class="profile">
		<div class="table-row">
			<div class="table-cell">
				<div style="width:200px;display:inline-block;text-align:center;font-size:2em;position:relative;top:50px;overflow:hidden;font-weight:bold">
					' . $data['user']['first_name']. '<br>' . $data['user']['last_name'] . '
				</div>
			</div>
			<div class="table-cell">
				<div style="position:relative;top:20px">
					<div style="height:120px">
						<img src="/user_img.php?image=' . $data['user_id'] .'" alt="" style="border-radius:80px;max-height:120px;overflow:hidden">
					</div>
					<div style="margin-top:10px">
						<button class="dashlet-link red" href="/?p=profile">Edit Profile</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
'; ?>
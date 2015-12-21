<?
Core::get_element('game_header');
?>
<? $view_output .= '
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- InstanceBeginEditable name="content" -->
		<div class="row">
'; ?>
			<? Core::get_element('game_nav'); ?>
<? $view_output .= '
			<div class="col-md-8 col-sm-12 col-xs-12 content2 meetings">
				<h1><img src="img/Header_Meetings.png">Meetings</h1>
				<h4>Earn points and prices for what you Schedule, Transact, and Close. <strong>All meetings must include the Content Analysis System &amp; Malware Analysis Appliance Bundle. </h4>
				<div class="bluebackground widget">
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>50 pts</h2>
							</div>
						</div>
						<div class="media-body"> Schedule a Meeting with a Manager Level </div>
					</div>
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>250 pts</h2>
							</div>
						</div>
						<div class="media-body"> Schedule a Meeting with a C-Level </div>
					</div>
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>125 pts</h2>
							</div>
						</div>
						<div class="media-body"> Transact a Meeting with a Manager Level </div>
					</div>
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>500 pts</h2>
							</div>
						</div>
						<div class="media-body"> Transact a Meeting with a C-Level </div>
					</div>
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>500 pts</h2>
							</div>
						</div>
						<div class="media-body"> Schedule a POC/Eval </div>
					</div>
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>500 pts</h2>
							</div>
						</div>
						<div class="media-body"> Close a Deal </div>
					</div>
				</div>
				
				
				<form role="form" class="form-horizontal">
					<div class="content widget">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="name">
									</div>
								</div>
								<div class="form-group">
									<label for="title" class="col-sm-3 control-label">Title</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="title">
									</div>
								</div>
								<div class="form-group">
									<label for="level" class="col-sm-3 control-label">Level</label>
									<div class="col-sm-9">
										<select class="form-control" id="level">
											<option>Manager</option>
											<option>C-Level</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="company" class="col-sm-3 control-label">Company</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="company">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-3 control-label">Email</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="email">
									</div>
								</div>
								<div class="form-group">
									<label for="date" class="col-sm-3 control-label">Date</label>
									<div class="col-sm-9">
										<input type="date" class="form-control" id="date">
									</div>
								</div>
								<div class="form-group">
									<label for="rep" class="col-sm-3 control-label">Blue Coat Rep</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="rep">
									</div>
								</div>	

							</div>
						</div>
					</div>
					<div class="content connectedwidget lightgreybackground">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label" style="padding-left:15px">Mark As</label>
										<div class="col-sm-9">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-primary">
													<input type="radio" name="options" id="transacted2">
													Transacted </label>
												<label class="btn btn-primary">
													<input type="radio" name="options" id="transacted2">
													Did Not Transact </label>											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label" style="padding-left:15px">POC/Eval Schedule</label>
										<div class="col-sm-9">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-primary">
													<input type="radio" name="options" id="sched1">
													Yes </label>
												<label class="btn btn-primary">
													<input type="radio" name="options" id="sched2">
													No </label>												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="form-group">
										<label for="opportunity" class="col-sm-3 control-label" style="padding-left:15px">Est. Opportunity</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="opportunity">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="content connectedwidget darkgreybackground">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="form-group">
										<label class="col-sm-3 control-label" style="padding-left:15px">Status</label>
										<div class="col-sm-9">
											<div class="btn-group" data-toggle="buttons">
												<label class="btn btn-primary">
													<input type="radio" name="options" id="status1">
													Won Deal </label>
												<label class="btn btn-primary">
													<input type="radio" name="options" id="status2">
													Lost Deal </label>											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="row">
									<div class="form-group">
										<label for="amount" class="col-sm-3 control-label" style="padding-left:15px">Deal amount</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="amount">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="content connectedwidget">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<button type="submit" class="btn bluebackground pull-right">Submit</button>
							</div>
						</div>
					</div>
				</form>
				
				
				<div class="bluebackground widget meetingfeedback">
					<h4>Meeting Feedback</h4>
					<table class="borderless">
						<thead>
						<tr>
							<th>Date</th>
							<th>Activity</th>
							<th>Company</th>
							<th>Status</th>
							<th>Points</th>
							<th>&nbsp;</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>04/14/14</td>
							<td>Meeting Scheduled</td>
							<td>ACME Inc.</td>
							<td>Scheduled</td>
							<td>10</td>
							<td><a href="" class="btn orangebackground">Update</a></td>
						</tr>
						<tr>
							<td>04/14/14</td>
							<td>Meeting Scheduled</td>
							<td>ACME Inc.</td>
							<td>Transacted</td>
							<td>10</td>
							<td><a href="" class="btn orangebackground">Update</a></td>
						</tr>
						</tbody>
					</table>
				</div>
				
				
			</div>
			
			
			
		</div>
		<!-- InstanceEndEditable -->
	</div>
</div>

'; ?>
<?
Core::get_element('game_footer');
?>
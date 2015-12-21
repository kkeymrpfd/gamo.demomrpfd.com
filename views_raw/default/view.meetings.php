<?
Core::get_element('game_header');
?>
/start_view
<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/gamo/meeting.js?t=4"></script>
/js: /js/gamo/gamo.js
<script src="/js/pager.js?t=1"></script>
/js: /js/moment.js
<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
			<? Core::get_element('game_nav'); ?>
/start_view
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 content2 meetings">
            
				<div class="hidden-xs">
					<div class="module-title">Opportunities / Deal Registration</div>
					<h4 style="line-height: 24px;">Earn points and prizes for what you Schedule, Transact, and Close.</h4>
				</div>
				<div class="visible-xs">
					<div class="widget content">
						<h1>Meetings</h1>
						<h5>Earn points and prizes for what you Schedule, Transact, and Close.</strong> </h5>
					</div>
				</div>
				<div class="bluebackground widget " style="padding:0;">
					<div class="table">
					<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>$500</h2>
							</div>
                        <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">For each closed deal you submit valued at $25,000 and above</div>
					</div>
					<div class="table-row row-dark">
                    	<div class="table-cell align-left cell-amount">
								<h2>$250</h2>
							</div>
                        <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">For each closed deal you submit valued at $10,000 to $24,999</div>
					</div>
					<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>$100</h2>
							</div>
                        <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">For each closed deal you submit valued at $5,000 to $9,999</div>
					</div>
					<div class="table-row row-dark">
                    	<div class="table-cell align-left cell-amount">
								<h2>$20</h2>
							</div>
                        <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">For each registered deal you submit</div>
					</div>
					<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>' . Core::r('actions')->get_action_points('submit_deal_close') . ' pts</h2>
							</div>
                          <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">' . Core::r('actions')->get_action_name('submit_deal_close') . '</div>
					</div>
                    <div class="table-row row-dark">
                    	<div class="table-cell align-left cell-amount">
								<h2>' . Core::r('actions')->get_action_points('submit_meeting') . ' pts</h2>
							</div>
                        <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">' . Core::r('actions')->get_action_name('submit_meeting') . ' </div>
					</div>
					<div class="table-row row-light">
                    	<div class="table-cell align-left cell-amount">
								<h2>' . Core::r('actions')->get_action_points('submit_deal_feedback') . ' pts</h2>
							</div>
                          <div class="table-cell cell-badge">&nbsp;</div>
						<div class="table-cell cell-desc">' . Core::r('actions')->get_action_name('submit_deal_feedback') . '</div>
					</div>
					
                    </div>
				</div>

				<form role="form" class="form-horizontal" id="create-meeting-form" >
				
				    <div class="content widget" style="padding-bottom:0;">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    Earn points and prizes when you submit deals, feedback, and closed deals. All submissions are subject to review.
                                    <div style="font-weight:bold;font-size:1.2em;margin-top:14px">Submit customer details below:</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="content connectedwidget" id="main-form-div" style="padding-top:0; padding-bottom:0;">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="col-sm-9" id="meeting_result_h">
										
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_name" class="col-sm-4 control-label">Contact Name</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="meeting_name">
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_title" class="col-sm-4 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="meeting_title">
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_company" class="col-sm-4 control-label">Company</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="meeting_company">
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_phone" class="col-sm-4 control-label">Phone</label>
									<div class="col-sm-8">
										<input type="tel" class="form-control" id="meeting_phone">
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_email" class="col-sm-4 control-label">Email</label>
									<div class="col-sm-8">
										<input type="email" class="form-control" id="meeting_email">
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_date" class="col-sm-4 control-label">Date</label>
									<div class="col-sm-4">
										<input type="text" class="form-control readonly" id="meeting_date" />
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_id" class="col-sm-4 control-label">Deal Reg ID #</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="meeting_id">
									</div>
								</div>
								<div class="form-group">
									<label for="meeting_status" class="col-sm-4 control-label">Status</label>
									<div class="col-sm-8">
										<select class="form-control" id="meeting_status">
											<option value="submit_meeting">Deal Registered</option>
											<option value="submit_deal_feedback">Deal Not Closed</option>
											<option value="submit_deal_close">Deal Closed</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="row">
											<div class="form-group">
												<label for="meeting_amount" class="col-sm-4 control-label" style="padding-left:15px">Deal amount</label>
												<div class="col-sm-8">
													<input type="number" class="form-control" id="meeting_amount">
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="row">
											<div class="form-group">
												<label for="meeting_notes" class="col-sm-4 control-label" style="padding-left:15px">Notes</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="meeting_notes">
												</div>
											</div>
										</div>
									</div>
								</div>
								</form>
							</div>
						</div>
					</div>					
					<div class="content connectedwidget" style="">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" class="form-control" id="action_id" value=""> 
								<button type="button" class="btn pull-left" id="meeting-reset" style="background-color:#eee;color:#444">Reset</button>
								<button type="button" class="btn bluebackground pull-right" id="create-meeting-submit">Submit</button>
							</div>
						</div>
					</div>
				
				<div class="bluebackground widget meetingfeedback">
					<div style="color:#777;font-size:1.2em;margin-bottom:15px">Opportunities</div>
					
                    <div class="container-fluid">
	                    <div class="row meetingfeedbackheader">
	                         <div class="col-xs-4 col-md-4">Company</div>
	                         <div class="col-xs-4 col-md-4">Status</div>
	                         <div class="col-xs-1 col-md-1">Points</div>
	                         <div class="col-xs-2 col-md-2">&nbsp;</div>
	                    </div>
                    </div>
                	<div id="meeting-list-holder-pager"></div>
				</div>
				
			</div>
			
			
			
		</div>
		<!-- InstanceEndEditable -->

<div class="modal fade" id="meeting_success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Success</h4>
      </div>
      <div class="modal-body">
        <p id="modal_text"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="color: #000">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>


<script type="text/javascript">
$(function() {
	
	$("#meeting_date").datepicker({ startDate: new Date("07/13/2014"), endDate: "+4w",daysOfWeekDisabled: [0,6] });

	$(document).on("keyup", ".readonly", function(e) {
	       
        e.preventDefault();
 
    });
     
    $(document).on("keydown", ".readonly", function(e) {
           
            e.preventDefault();
     
    });
     
     
    $(document).on("paste", ".readonly", function(e) {
           
            e.preventDefault();
     
    });
    
});

</script>

/end_view
<?
Core::get_element('game_footer');
?>

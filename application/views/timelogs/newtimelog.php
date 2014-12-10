<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb hide">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 Timelogs
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
			  <div class="col-sm-12 col-md-12">
			    <div class="portlet light ">
						<div class="portlet-title">
						  <div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">+ New Time Log</span>
							</div>
						</div>
						<div class="portlet-body">
                <form role="form" action="<?php echo URL; ?>timelogs/addtimelog" method="POST" style="width: 300px;">
                  <div class="form-group">
                    <label for="volunteer">Volunteer</label>
                    <select name="volunteer">
                      <?php foreach($contacts as $contact){ ?>
                        <option value = "<?php echo $contact->id;?>"><?php echo $contact->firstname; echo " "; echo $contact->lastname;?></option>
                      <?php }?>
                      
                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="volunteer">Date</label>
											<input name="date" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""/>
                      <br><br>
                    <label for="volunteer">Time In</label>
                    <div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="timein" type="text" class="form-control timepicker timepicker-default">
										</div>                  </div>
                  <div class="form-group">
                    <label for="volunteer">Time Out</label>
                    <div class="input-icon">
											<i class="fa fa-clock-o"></i>
											<input name="timeout" type="text" class="form-control timepicker timepicker-default">
										</div>
                  </div>

                  <hr>

                  <hr>

                  <div class="form-group">
                    <input type="hidden" name="totaltime" value="1"/>
                  </div>
                  <button type="submit" class="btn btn-default" name="submit_add_timelog" value="Submit">Submit</button>
                </form>
						</div>
					</div>
			  </div>
</div>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Events</h1>
			</div>
			<!-- END PAGE TITLE -->
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
	<div class="page-content">
		<div class="container">
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb hide">
				<li>
					<a href="#">Home</a><i class="fa fa-circle"></i>
				</li>
				<li class="active">
					 + New Event
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row margin-top-10">
				<div class="col-sm-12">
		      <!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">+ New Event</span>
							</div>
						</div>
						<div class="portlet-body">
    <div>
        <form role="form" action="<?php echo URL; ?>events/createevent" method="POST" enctype="multipart/form-data" style="width: 300px;">
          <div class="form-group">
            <label for="date">Date</label>
            <hr>
            <label for="program">Select Program</label>
            <br>
            <select>
              <option>
                  Program
              </option>
            </select>
          </div>
          
          <hr>
            <label for="start_time">Start Time</label>
            <br>
            <label for="end_time">End Time</label>
          <hr>
          
          <div class="form-group">
            <input type="hidden" name="is_event" value="1" checked/>
          </div>
          <button type="submit" class="btn btn-primary" name="submit_add_event" value="Submit">Save Event</button>
        </form>
    </div>
</div>
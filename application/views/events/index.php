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
			<div class="row margin-top-20">
				<div class="col-md-12 col-lg-12">
		      <!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">All Events (<?php //echo $amount_of_events; ?>)</span>
							</div>
							<div class="inputs">
								<div class="portlet-input input-medium input-inline">
									<div class="input-icon right">
										<i class="icon-magnifier"></i>
										<form action="<?php echo URL; ?>events?" method="post">
										<input type="text" name="search" class="form-control form-control-solid" value="<?php if(isset($_POST['search'])&&$_POST['search']!=''){echo $search;}?>" placeholder="search...">
										</form>
									</div>
								</div>
								<div class="portlet-input input-small input-inline">
								  <a href="<?php echo URL . 'events/newevent'; ?>" class="btn btn-primary">+ New Event</a>
								</div>
							</div>
						</div>
						<div class="portlet-body">
						  
    <!-- main content output -->
        <div>
          DATE FILTERS
        </div>
        <hr>
        <div style="float: left; margin: 10px 0px 25px 0px;">
          <a href="<?php echo URL . 'events/'?>">View All</a>
            / View By Last Name:
            <a href="<?php echo URL; ?>events?search=A">A</a>
            <a href="<?php echo URL; ?>events?search=B">B</a>
            <a href="<?php echo URL; ?>events?search=C">C</a>
            <a href="<?php echo URL; ?>events?search=D">D</a>
            <a href="<?php echo URL; ?>events?search=E">E</a>
            <a href="<?php echo URL; ?>events?search=F">F</a>
            <a href="<?php echo URL; ?>events?search=G">G</a>
            <a href="<?php echo URL; ?>events?search=H">H</a>
            <a href="<?php echo URL; ?>events?search=I">I</a>
            <a href="<?php echo URL; ?>events?search=J">J</a>
            <a href="<?php echo URL; ?>events?search=K">K</a>
            <a href="<?php echo URL; ?>events?search=L">L</a>
            <a href="<?php echo URL; ?>events?search=M">M</a>
            <a href="<?php echo URL; ?>events?search=N">N</a>
            <a href="<?php echo URL; ?>events?search=O">O</a>
            <a href="<?php echo URL; ?>events?search=P">P</a>
            <a href="<?php echo URL; ?>events?search=Q">Q</a>
            <a href="<?php echo URL; ?>events?search=R">R</a>
            <a href="<?php echo URL; ?>events?search=S">S</a>
            <a href="<?php echo URL; ?>events?search=T">T</a>
            <a href="<?php echo URL; ?>events?search=U">U</a>
            <a href="<?php echo URL; ?>events?search=V">V</a>
            <a href="<?php echo URL; ?>events?search=W">W</a>
            <a href="<?php echo URL; ?>events?search=X">X</a>
            <a href="<?php echo URL; ?>events?search=Y">Y</a>
            <a href="<?php echo URL; ?>events?search=Z">Z</a>
          </div>
          <form action="<?php echo URL?>events/bulkVolunteerActions" method="POST">
          <div style="float: right;">
            <div class="btn-group pull-right">
              <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Bulk Actions
                <i class="fa fa-angle-down"></i>
              </button>
              <ul class="dropdown-menu pull-right">
                <li><input class="submit-link" name="submit-bulk-email" type="submit" value="Email"/></li>
  							<li><input class="submit-link" name="submit-bulk-delete" type="submit" value="Delete"/></li>
  						</ul>
						</div>
          </div>
        <br><br>
        <div class="table-toolbar table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px"><input type="checkbox" class="event-check-all"/></th>
                <th width="100px">Date</th>
                <th>Program Name</th>
                <th width="180px">Start Time</th>
                <th width="180px">End Time</th>
                <th width="80px">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><input class="event-check" value="<?php if (isset($event->id)) echo $event->id; ?>" name="event[]" type="checkbox"/></td>
                    <td><?php if (isset($event->date)) echo $event->date; ?></td>
                    <td><?php if (isset($event->name)) echo $event->name; ?></td>
                    <td><?php if (isset($event->start_time)) echo $event->start_time; ?></td>
                    <td><?php if (isset($event->end_time)) echo $event->end_time; ?></td>
                    <td>
                      <a class="view" href="<?php echo URL . 'timelogs/choice?event=' . $event->id; ?>">log</a>
                      <a class="view" href="<?php echo URL . 'events/viewVolunteer/' . $event->id; ?>">view</a>
                      <a class="edit" href="<?php echo URL . 'events/editVolunteer/' . $event->id; ?>">edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        </form>
    </div>
</div>

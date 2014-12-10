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
		      <!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption caption-md">
								<i class="icon-bar-chart theme-font hide"></i>
								<span class="caption-subject theme-font bold uppercase">All Time Logs (<?php echo $amount_of_timelogs; ?>)</span>
							</div>
							<div class="inputs">
								<div class="portlet-input input-small input-inline">
									<div class="input-icon right">
										<i class="icon-magnifier"></i>
										<input type="text" class="form-control form-control-solid" placeholder="search...">
									</div>
								</div>
								<div class="portlet-input input-small input-inline">
								  <a href="<?php echo URL . 'timelogs/newtimelog'; ?>" class="btn btn-primary">+ New Time Log</a>
								</div>
							</div>
						</div>
						<div class="portlet-body">
						  <div class="table-toolbar">
    <!-- main content output -->
    
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th width="30px"><input type="checkbox" class="volunteer-check-all"/></th>
                <th>Volunteer</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th width="80px">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($timelogs as $timelog) { ?>
                <tr>
                    <td><input type="checkbox"/></td>
                    <td><?php if (isset($timelog->contact_id)) echo $timelog->contact_id; ?></td>
                    <td><?php if (isset($timelog->time_in)) echo $timelog->time_in; ?></td>
                    <td><?php if (isset($timelog->time_out)) echo $timelog->time_out; ?></td>
                    <td>
                      <a class="view" href="<?php echo URL . 'volunteers/viewvolunteer/' . $contact->id; ?>">view</a>
                      <a class="edit" href="<?php echo URL . 'volunteers/editvolunteer/' . $contact->id; ?>">edit</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

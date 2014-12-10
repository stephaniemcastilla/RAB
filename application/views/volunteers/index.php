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
								<span class="caption-subject theme-font bold uppercase">All Volunteers (<?php echo $amount_of_volunteers; ?>)</span>
							</div>
							<div class="inputs">
								<div class="portlet-input input-medium input-inline">
									<div class="input-icon right">
										<i class="icon-magnifier"></i>
										<form action="<?php echo URL; ?>volunteers?" method="post">
										<input type="text" name="search" class="form-control form-control-solid" value="<?php if(isset($_POST['search'])&&$_POST['search']!=''){echo $search;}?>" placeholder="search...">
										</form>
									</div>
								</div>
								<div class="portlet-input input-small input-inline">
								  <a href="<?php echo URL . 'volunteers/newvolunteer'; ?>" class="btn btn-primary">+ New Volunteer</a>
								</div>
							</div>
						</div>
						<div class="portlet-body">
						  
    <!-- main content output -->
        <div>
          <form action="<?php echo URL; ?>volunteers?" method="post">
          <select name="filter" style="margin-right: 10px;">
            <option value="" selected>Filter By Skill:</option>
          <?php foreach ($volunteer_categories as $volunteer_category) { ?>
            <option value="<?php echo $volunteer_category->id; ?>">
            <?php echo $volunteer_category->name; ?>
            </option>
          <?php } ?>
          <input type="submit" class="btn btn-default" value="Go"/>
          </select>
          </form>
        </div>
        <hr>
        <div style="float: left; margin: 10px 0px 25px 0px;">
          <a href="<?php echo URL . 'volunteers/'?>">View All</a>
            / View By Last Name:
            <a href="<?php echo URL; ?>volunteers?search=A">A</a>
            <a href="<?php echo URL; ?>volunteers?search=B">B</a>
            <a href="<?php echo URL; ?>volunteers?search=C">C</a>
            <a href="<?php echo URL; ?>volunteers?search=D">D</a>
            <a href="<?php echo URL; ?>volunteers?search=E">E</a>
            <a href="<?php echo URL; ?>volunteers?search=F">F</a>
            <a href="<?php echo URL; ?>volunteers?search=G">G</a>
            <a href="<?php echo URL; ?>volunteers?search=H">H</a>
            <a href="<?php echo URL; ?>volunteers?search=I">I</a>
            <a href="<?php echo URL; ?>volunteers?search=J">J</a>
            <a href="<?php echo URL; ?>volunteers?search=K">K</a>
            <a href="<?php echo URL; ?>volunteers?search=L">L</a>
            <a href="<?php echo URL; ?>volunteers?search=M">M</a>
            <a href="<?php echo URL; ?>volunteers?search=N">N</a>
            <a href="<?php echo URL; ?>volunteers?search=O">O</a>
            <a href="<?php echo URL; ?>volunteers?search=P">P</a>
            <a href="<?php echo URL; ?>volunteers?search=Q">Q</a>
            <a href="<?php echo URL; ?>volunteers?search=R">R</a>
            <a href="<?php echo URL; ?>volunteers?search=S">S</a>
            <a href="<?php echo URL; ?>volunteers?search=T">T</a>
            <a href="<?php echo URL; ?>volunteers?search=U">U</a>
            <a href="<?php echo URL; ?>volunteers?search=V">V</a>
            <a href="<?php echo URL; ?>volunteers?search=W">W</a>
            <a href="<?php echo URL; ?>volunteers?search=X">X</a>
            <a href="<?php echo URL; ?>volunteers?search=Y">Y</a>
            <a href="<?php echo URL; ?>volunteers?search=Z">Z</a>
          </div>
          <form action="<?php echo URL?>volunteers/bulkVolunteerActions" method="POST">
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
                <th width="30px"><input type="checkbox" class="volunteer-check-all"/></th>
                <th width="30px">Photo</th>
                <th width="180px">First Name</th>
                <th width="180px">Last Name</th>
                <th>Email</th>
                <th width="80px">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($volunteers)) { foreach ($volunteers as $volunteer) { ?>
                <tr>
                    <td><input class="volunteer-check" value="<?php if (isset($volunteer->id)) echo $volunteer->id; ?>" name="volunteer[]" type="checkbox"/></td>
                    <td><?php if (isset($volunteer->photo)) echo '<div style="width: 25px; height: 25px; overflow: hidden; margin: auto;"><img src="'.URL.$volunteer->photo. '" width="25px"/></div>'; ?></td>
                    <td><?php if (isset($volunteer->firstname)) echo $volunteer->firstname; ?></td>
                    <td><?php if (isset($volunteer->lastname)) echo $volunteer->lastname; ?></td>
                    <td>
                        <?php if (isset($volunteer->email)) { ?>
                            <a href="mailto:<?php echo $volunteer->email; ?>"><?php echo $volunteer->email; ?></a>
                        <?php } ?>
                    </td>
                    <td>
                      <a class="view" href="<?php echo URL . 'volunteers/viewVolunteer/' . $volunteer->id; ?>">view</a>
                      <a class="edit" href="<?php echo URL . 'volunteers/editVolunteer/' . $volunteer->id; ?>">edit</a>
                    </td>
                </tr>
            <?php }?>
              </tbody>
            </table>
            <?php } else {?>
                  </tbody>
                </table>
                <div class="empty_table">
                    No Volunteers Found
                <div>
            <?php } ?>
        </form>
    </div>
</div>

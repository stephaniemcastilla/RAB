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
								<span class="caption-subject theme-font bold uppercase">All Programs (<?php echo $amount_of_programs; ?>)</span>
							</div>
							<div class="inputs">
								<div class="portlet-input input-medium input-inline">
									<div class="input-icon right">
										<i class="icon-magnifier"></i>
										<form action="<?php echo URL; ?>programs?" method="post">
										<input type="text" name="search" class="form-control form-control-solid" value="<?php if(isset($_POST['search'])&&$_POST['search']!=''){echo $search;}?>" placeholder="search...">
										</form>
									</div>
								</div>
								<div class="portlet-input input-small input-inline">
								  <a href="<?php echo URL . 'programs/newprogram'; ?>" class="btn btn-primary">+ New Program</a>
								</div>
							</div>
						</div>
						<div class="portlet-body">
						  
    <!-- main content output -->
        <div>
          <form action="<?php echo URL; ?>programs?" method="post">
          <select name="filter" style="margin-right: 10px;">
            <option value="" selected>Filter By Tag:</option>
          <?php foreach ($program_categories as $program_category) { ?>
            <option value="<?php echo $program_category->id; ?>">
            <?php echo $program_category->name; ?>
            </option>
          <?php } ?>
          <input type="submit" class="btn btn-default" value="Go"/>
          </select>
          </form>
        </div>
        <hr>
        <div style="float: left; margin: 10px 0px 25px 0px;">
          <a href="<?php echo URL . 'programs/'?>">View All</a>
            / View By Last Name:
            <a href="<?php echo URL; ?>programs?search=A">A</a>
            <a href="<?php echo URL; ?>programs?search=B">B</a>
            <a href="<?php echo URL; ?>programs?search=C">C</a>
            <a href="<?php echo URL; ?>programs?search=D">D</a>
            <a href="<?php echo URL; ?>programs?search=E">E</a>
            <a href="<?php echo URL; ?>programs?search=F">F</a>
            <a href="<?php echo URL; ?>programs?search=G">G</a>
            <a href="<?php echo URL; ?>programs?search=H">H</a>
            <a href="<?php echo URL; ?>programs?search=I">I</a>
            <a href="<?php echo URL; ?>programs?search=J">J</a>
            <a href="<?php echo URL; ?>programs?search=K">K</a>
            <a href="<?php echo URL; ?>programs?search=L">L</a>
            <a href="<?php echo URL; ?>programs?search=M">M</a>
            <a href="<?php echo URL; ?>programs?search=N">N</a>
            <a href="<?php echo URL; ?>programs?search=O">O</a>
            <a href="<?php echo URL; ?>programs?search=P">P</a>
            <a href="<?php echo URL; ?>programs?search=Q">Q</a>
            <a href="<?php echo URL; ?>programs?search=R">R</a>
            <a href="<?php echo URL; ?>programs?search=S">S</a>
            <a href="<?php echo URL; ?>programs?search=T">T</a>
            <a href="<?php echo URL; ?>programs?search=U">U</a>
            <a href="<?php echo URL; ?>programs?search=V">V</a>
            <a href="<?php echo URL; ?>programs?search=W">W</a>
            <a href="<?php echo URL; ?>programs?search=X">X</a>
            <a href="<?php echo URL; ?>programs?search=Y">Y</a>
            <a href="<?php echo URL; ?>programs?search=Z">Z</a>
          </div>
          <form action="<?php echo URL?>programs/bulkProgramActions" method="POST">
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
                <th width="30px"><input type="checkbox" class="program-check-all"/></th>
                <th>Program Name</th>
                <th width="80px">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($programs)) { foreach ($programs as $program) { ?>
                <tr>
                    <td><input class="program-check" value="<?php if (isset($program->id)) echo $program->id; ?>" name="program[]" type="checkbox"/></td>
                    <td>
                        <?php if (isset($program->name)) { echo $program->name;  } ?>
                    </td>
                    <td>
                      <a class="view" href="<?php echo URL . 'programs/viewProgram/' . $program->id; ?>">view</a>
                      <a class="edit" href="<?php echo URL . 'programs/editProgram/' . $program->id; ?>">edit</a>
                    </td>
                </tr>
            <?php }?>
              </tbody>
            </table>
            <?php } else {?>
                  </tbody>
                </table>
                <div class="empty_table">
                    No Programs Found
                <div>
            <?php } ?>
        </form>
    </div>
</div>

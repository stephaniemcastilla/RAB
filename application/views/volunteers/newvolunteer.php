<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Volunteers</h1>
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
					 + New Volunteer
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
								<span class="caption-subject theme-font bold uppercase">+ New Volunteer</span>
							</div>
						</div>
						<div class="portlet-body">
    <div>
        <form role="form" action="<?php echo URL; ?>volunteers/createvolunteer" method="POST" enctype="multipart/form-data" style="width: 300px;">
          <div class="form-group">
            <label for="firstname">Photo</label>
            <input id="photo" name="photo" type="file" accept="image/*;capture=camera">
          </div>
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" value="" required />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="" />
          </div>
          
          <hr>
            <label for="tags">Skill Areas</label>
          <?php foreach ($volunteers_categories as $volunteers_category) { ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="tag[]" value="<?php echo $volunteers_category->id; ?>">
                <?php echo $volunteers_category->name; ?>
              </label>
            </div>
          <?php } ?>
          <hr>
          
          <div class="form-group">
            <input type="hidden" name="is_volunteer" value="1" checked/>
          </div>
          <button type="submit" class="btn btn-primary" name="submit_add_volunteer" value="Submit">Save Volunteer</button>
        </form>
    </div>
</div>
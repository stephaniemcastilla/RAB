<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			<div class="page-title">
				<h1>Programs</h1>
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
					 + New Program
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
								<span class="caption-subject theme-font bold uppercase">+ New Program</span>
							</div>
						</div>
						<div class="portlet-body">
		<?php foreach ($program as $program) { ?>
    <div>
        <form role="form" action="<?php echo URL; ?>programs/updateProgram/<?php echo $program->id; ?>" method="POST" enctype="multipart/form-data" style="width: 300px;">
          <div class="form-group">
            <label for="name">Program Name</label>
            <input type="text" class="form-control" name="name" value="<?php if (isset($program->name)) echo $program->name; ?>" required />
          </div>
          
          <hr>
            <label for="tags">Program Types</label>
            <?php foreach ($program_categories as $program_category) { ?>
              <div class="checkbox">
                <label>
                    <input type="checkbox" name="tag[]" value="<?php echo $program_category->id; ?>"
                    <?php foreach ($tags as $tag) { ?>
                      <?php if($program_category->id == $tag->tag_id) {?>
                        checked
                      <?php } ?>
                    <?php } ?>>
                  <?php echo $program_category->name; ?>
                </label>
              </div>
            <?php } ?>
          <hr>
          
          <div class="form-group">
            <input type="hidden" name="is_program" value="1" checked/>
          </div>
          <button type="submit" class="btn btn-default" name="submit_update_program" value="Submit">Save Changes</button>
          <a href="<?php echo URL . 'programs/deleteprogram/' . $program->id; ?>" type="submit" class="btn btn-danger" name="submit_add_program" value="Submit">Delete Volunteer</a>        </form>
    </div>
    <?php } ?>
</div>
<div class="container">
    <h2>Edit Volunteer</h2>
    <!-- add volunteer form -->
    <?php foreach ($volunteer as $volunteer) { ?>
    <div>
        <form role="form" action="<?php echo URL; ?>volunteers/updateVolunteer/<?php echo $volunteer->id; ?>" method="POST" enctype="multipart/form-data" style="width: 300px;">
          <div class="form-group">
            <label for="firstname">Photo</label>
            <br>
            <img src="<?php if (isset($volunteer->photo)) echo URL.$volunteer->photo;?>" width="100px"style="margin-bottom: 10px;"/>
            <input type="file" name="photo" accept="image/*;capture=camera">
          </div>
          <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?php if (isset($volunteer->firstname)) echo $volunteer->firstname; ?>" required />
          </div>
          <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?php if (isset($volunteer->lastname)) echo $volunteer->lastname; ?>" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="<?php if (isset($volunteer->email)) echo $volunteer->email; ?>" />
          </div>
          
          <hr>
            <label for="tags">Volunteer Skills</label>
          <?php foreach ($volunteer_categories as $volunteer_category) { ?>
            <div class="checkbox">
              <label>
                  <input type="checkbox" name="tag[]" value="<?php echo $volunteer_category->id; ?>"
                  <?php foreach ($tags as $tag) { ?>
                    <?php if($volunteer_category->id == $tag->tag_id) {?>
                      checked
                    <?php } ?>
                  <?php } ?>>
                <?php echo $volunteer_category->name; ?>
              </label>
            </div>
          <?php } ?>

          <hr>
          
          <div class="form-group">
            <input type="hidden" name="is_volunteer" value="1" checked/>
          </div>
          <button type="submit" class="btn btn-default" name="submit_update_volunteer" value="Submit">Save Changes</button>
          <a href="<?php echo URL . 'volunteers/deletevolunteer/' . $volunteer->id; ?>" type="submit" class="btn btn-danger" name="submit_add_volunteer" value="Submit">Delete Volunteer</a>
        </form>
    </div>
    <?php } ?>
</div>
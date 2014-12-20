<a href="<?php echo URL; ?>events" class="close_button">X</a>

<div class="centered">
     Hi <?php echo $info->firstname; ?>!
     <br>
     <br>
     You are signed in for <?php echo $info->program_name; ?>.
     <br>
     <br>
     <form action="confirmin" method="post">
     You started at 
     <input type="time" name="timein" value="<?php echo date("H:i",strtotime($info->time_in)); ?>"/>
     <input type="hidden" name="date" value="<?php echo date("Y-m-j",strtotime($info->time_in)); ?>" />
     <input type="hidden" name="submitted" value="submitted" />
     <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
     <input type="hidden" name="id" value="<?php echo $timelog_id; ?>" />
     <br><br>
     <button type="submit"> Confirm </button>
</form>
</div>
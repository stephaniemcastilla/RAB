<a href="<?php echo URL; ?>events" class="close_button">X</a>
<br>
<div class="confirmout">
  <?php echo $firstname; ?>s Log book<br>
  Total logged time = <?php echo $sum_time; ?> hours<br><br>
  <a href="choice?event=<?php echo $event_id; ?>">Finish</a> 
</div>
<div class="table-toolbar table-responsive">
     <table class="table table-striped table-bordered table-hover">
     <thead>
     <tr>
     <th width="100px">Event</th>
     <th width="100px">Date</th>
     <th width="100px">Start Time</th>
     <th width="100px">End Time</th>
     <th width="100px">Total Time (hours)</th>
     </tr>
     </thead>
     <tbody>
<?php foreach ($timelogs as $timelog) { ?>
<tr>
<td height="50px"><?php echo $timelog->name; ?></td>
<td><?php echo date("j F Y",strtotime($timelog->time_in)); ?></td>
<td><?php echo date("g:ia",strtotime($timelog->time_in)); ?></td>
<td><?php 
if($timelog_id == $timelog->id){
    echo '<form action="confirmout" method="post">';
    echo '<input type="time" name="timeout" value="' . date("H:i",strtotime($timelog->time_out)) .'"/>';
    echo '<input type="hidden" name="date" value="' . date("Y-m-j",strtotime($timelog->time_out)) . '" />';
    echo '<input type="hidden" name="submitted" value="submitted" />';
    echo '<input type="hidden" name="event" value="' . $timelog->event . '" />';
    echo '<input type="hidden" name="id" value="' . $timelog->id . '" />';
    echo ' <button type="submit"> Update </button></form>';
} else {
    echo date("g:ia",strtotime($timelog->time_out)); 
}
?></td>
<td><?php echo $timelog->total_time; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
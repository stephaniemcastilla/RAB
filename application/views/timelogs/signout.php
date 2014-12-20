<a href="<?php echo URL; ?>events" class="close_button">X</a>

<div class="centered">
  <div class="label_div">Signed in to NNN</div>
  <div class="input_container">
      <ul id="autofill2_results" style="display: block; width: 600px; margin: 50px auto;">
       <?php foreach ($timelogs as $timelog) {
     echo "<li style='list-style: none; text-align: left;'>".$timelog->firstname." ".$timelog->lastname."<a href='" . URL . "timelogs/sign_out?event=" . $event_id . "&timelog=" . $timelog->id . "' class='btn btn-primary' style='float: right; margin-top: 15px;'>SIGN OUT</a></li>";
} ?>
    </ul>
  </div>
</div>
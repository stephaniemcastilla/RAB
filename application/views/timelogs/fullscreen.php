<a href="<?php echo URL; ?>events" class="close_button">X</a>

<div class="centered">
  Welcome! Please sign in:
  <br>
  <br>
  <div class="label_div">Enter your last name:</div>
  <div class="input_container">
      <input type="text" id="autofill" onkeyup="autofill(<?php echo $event;?>)"/>
      <ul id="autofill_results" style="display: none; width: 500px; margin: 50px auto;">

      </ul>
  </div>
     <br>
     <br>
  <div class="label_div">Already signed in?</div>
  <div class="input_container">
      <ul id="autofill2_results" style="display: block; width: 600px; margin: 50px auto;">
       <?php foreach ($open_timelogs as $timelog) {
     echo "<li style='list-style: none; text-align: left;'>".$timelog->firstname." ".$timelog->lastname."<a href='" . URL . "timelogs/sign_out?id=" . $timelog->id . "' class='btn btn-primary' style='float: right; margin-top: 15px;'>SIGN OUT</a>   <a href='" . URL . "volunteers/viewVolunteer?id=" . $timelog->contact_id . "' class='btn btn-primary' style='float: right; margin-top: 15px;'>VIEW PROFILE</a></li>";
} ?>
    </ul>
  </div>
</div>
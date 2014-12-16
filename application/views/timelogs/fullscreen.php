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
</div>
<?php 
  $this->registerCssFile('@web/css/countdown.css');
  $this->registerJsFile('@web/js/countdown.js', ['depends' => 'frontend\assets\AppAsset']);
  $seconds = 120;
 ?>
<input type="hidden" id="ammount" name="" value="<?= $seconds ?>">
<section class="clock">
  <div class="row">
    <div id="timer" class="col-12">
      <div class="clock-wrapper">
        <div id="hours-area">
          <span class="hours">00</span>
          <span class="dots">:</span>
        </div>
        <span class="minutes">00</span>
        <span class="dots">:</span>
        <span class="seconds">00</span>
      </div>
    </div>
  </div>
</section>
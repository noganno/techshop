<?php


?>
<!-- Modal .btn #product-basket - rassrochka cart uchun modal -->
<div class="modal fade" id="product-rassrochka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg p-2" role="document" id="cart-rassrochka-modal-container">
        <?= $this->render('@frontend/views/_partials/_cartRassrochkaModalContent.php') ?>
    </div>
</div>

<!-- Modal .btn #product-basket  asosiy cart uchun modal-->
<div class="modal fade" id="product-basket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg p-2" role="document" id="cart-modal-container">
        <?= $this->render('@frontend/views/_partials/_cartModalContent.php') ?>
    </div>
</div>


<!-- Modal  #login-modal-->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg p-2" role="document">
        <?= $this->render('@frontend/views/_partials/_loginModal.php') ?>
    </div>
</div>


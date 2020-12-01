<?php


namespace frontend\components;


use yii\jui\Widget;

class ModalBodyNoProductsWidget extends Widget
{

    public function run()
    {

//        <div class="no-product-image" style="display: flex; justify-content: center;">
//                <img src="/images/gif/stick_figure_shopping_cart_md_wm.gif">
//            </div>
        echo '<div class="modal-body">
            <p> ' . t("There are no products in your shopping cart") . '</p>
        </div>';
    }

}

<?php

echo $form->field($model, 'attribute_values')->widget(\unclead\multipleinput\MultipleInput::className(), [
    'max' => 50,
    'allowEmptyList' => true,
    'columns' => $attribute_form
]);
?>
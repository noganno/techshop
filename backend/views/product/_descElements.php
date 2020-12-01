<?= $form->field($model, 'description')->widget(\mihaildev\ckeditor\CKEditor::class, [
    'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
]); ?>
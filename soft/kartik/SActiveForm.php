<?php


namespace soft\kartik;


use yeesoft\multilingual\containers\MultilingualFieldContainer;
use  soft\widget\FormLanguageSwitcher;
//use yeesoft\multilingual\widgets\FormLanguageSwitcher;

class SActiveForm extends \kartik\widgets\ActiveForm
{

    public $fieldClass = 'soft\kartik\SActiveField';
    /**
     * Renders form language switcher.
     *
     * @param \yii\base\Model $model
     * @param string $view
     * @return string
     */
    public function languageSwitcher($model, $view = null)
    {
        return FormLanguageSwitcher::widget(['model' => $model, 'view' => $view])."<br>";
    }

    public function field($model, $attribute, $options = [])
    {
        $fields = [];

        $isNonMultilingual = (isset($options['multilingual']) && $options['multilingual'] === false);
        $isFieldMultilingual = (isset($options['multilingual']) && $options['multilingual']);
        $isAttributeMultilingual = ($model->getBehavior('multilingual') && $model->hasMultilingualAttribute($attribute));

        if (!$isNonMultilingual && ($isFieldMultilingual || $isAttributeMultilingual)) {
            $languages = array_keys($model->getBehavior('multilingual')->languages);
            foreach ($languages as $language) {
                $fields[] = parent::field($model, $attribute, array_merge($options, ['language' => $language]));
            }

        } else {
            return parent::field($model, $attribute, $options);
        }

        return new MultilingualFieldContainer(['fields' => $fields]);
    }


}
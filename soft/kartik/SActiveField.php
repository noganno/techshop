<?php


namespace soft\kartik;


use Yii;
use yeesoft\multilingual\assets\FormLanguageSwitcherAsset;
use yeesoft\multilingual\helpers\MultilingualHelper;
use yii\helpers\Html;

class SActiveField extends \kartik\widgets\ActiveField
{
    /**
     * Language of the field.
     *
     * @var string
     */
    public $language;

    /**
     * Whether is field multilingual. Use this option to mark an attribute as multilingual
     * in dynamic models.
     *
     * @var bool
     */
    public $multilingual = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->language && ($this->model->getBehavior('multilingual') || $this->multilingual)) {

            $this->attribute = MultilingualHelper::getAttributeName($this->attribute, $this->language);
            $activeLanguage = (Yii::$app->language === $this->language);
            $switcherUsed = isset(Yii::$app->assetManager->bundles[FormLanguageSwitcherAsset::className()]);

            $this->options = array_merge($this->options, [
                'data-lang' => $this->language,
                'data-toggle' => 'multilingual-field',
                'class' => ($activeLanguage ? 'in form-group' : 'form-group'),
                'style' => ((!$activeLanguage && $switcherUsed) ? 'display:none' : ''),
            ]);
        }
    }
}
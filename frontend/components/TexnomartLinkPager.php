<?php

namespace frontend\components;
use Yii;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;

class TexnomartLinkPager extends \yii\bootstrap4\LinkPager
{

    public $options = ['class' => 'outer-pagination py-2'];
    public $listOptions = ['class' => ['pagination', 'justify-content-end']];
    public $prevPageCssClass = '';
    public $nextPageCssClass = '';
    public $maxButtonCount = 4;

    public function init()
    {
        parent::init();
        $this->nextPageLabel = '<span>'.Yii::t("app", "Next").'</span> <img src="/images/png/arrow-right.png">';
        $this->prevPageLabel = '<img src="/images/png/arrow-left.png"> <span>'.Yii::t("app", "Previous").'</span>';
    }


    public function run()
    {
        $html  = parent::run();
        return Html::tag('div', $html, ['class' => 'auto-container']);
    }

    /**
     * Renders a page button.
     * You may override this method to customize the generation of page buttons.
     * @param string $label the text label for the button
     * @param int $page the page number
     * @param string $class the CSS class for the page button.
     * @param bool $disabled whether this page button is disabled
     * @param bool $active whether this page button is active
     * @return string the rendering result
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = $this->linkContainerOptions;
        $linkWrapTag = ArrayHelper::remove($options, 'tag', 'li');
        Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        if ($active) {
            Html::addCssClass($linkOptions, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            $disabledItemOptions = $this->disabledListItemSubTagOptions;
            $linkOptions = ArrayHelper::merge($linkOptions, $disabledItemOptions);
            $linkOptions['tabindex'] = '-1';
        }

        return Html::tag($linkWrapTag, Html::a($label, $this->pagination->createUrl($page), $linkOptions), $options);
    }


}
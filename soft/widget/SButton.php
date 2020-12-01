<?php 
	
	namespace soft\widget;

	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\helpers\ArrayHelper;
	use soft\base\SWidgetBase;
	use soft\widget\SStyle;
	use soft\helpers\SArray;
	use soft\extra\SToggle;

	/**
	 * @author Shukurullo Odilov
	 */

	class SButton extends SWidgetBase
	{
		

		public const TYPE_LINK = 'link';
		public const TYPE_BUTTON = 'button';
		public const TYPE_SUBMIT = 'submit';

		public $_config = [


			'visible' => true,
			'type' => self::TYPE_LINK,
			'btn' => true,
			'style' => SStyle::btnStyle['primary'],
			'size' => SStyle::btnSize['default'],
			'url' => '#',
			'options' => [],
			'label' => "",
			'icon' => false,
			'title' => false,

            // Toggle Options
			'toggle' => SToggle::toggle['tooltip'],
			'toggleOptions' => [],

            // agar pjax => false  bo'lsa,  'options[]' ga 'data-pjax' => 0 element qo'shiladi
			'pjax' => true,

            // agar modal => true  bo'lsa,  'options[]' ga 'role' => 'modal-remote' element qo'shiladi
            'modal' => false,

		];
            

		public $_events = [];


        public function main()
        {
        	$this->html = $this->_config['visible'] ? $this->renderButton() : "";
        }

        public function renderButton()
        {
        	
        	// Add css classes
        	if ($this->_config['btn'] ) {

        		Html::addCssClass($this->_config['options'], ['btn', $this->_config['style'], $this->_config['size'] ]);
        		
        	}

        	// Add icon if true

        	if ($this->_config['icon']) {
        		$this->_config['label'] = Html::tag('i', '', ['class' => "fa fa-{$this->_config['icon']}" ])." ".$this->_config['label'];
        	}

        	// Add ID

        	SArray::setValueIfNoValid($this->_config['options'], 'id', $this->getId());
        	
        	// Add title
        	SArray::setValueIfNoValid($this->_config['options'], 'title', $this->_config['title']);

        	
        	// Add data-pjax option if pjax false
        	if (!$this->_config['pjax']) {
        		$this->_config['options']['data-pjax'] = 0;
        	}

            // Add 'role' => 'modal-remote' option if modal true
            if ($this->_config['modal']) {
                $this->_config['options']['role'] = "modal-remote";
            }

        	// Render toggle if true
        	if ($this->_config['toggle']) {
        		SToggle::render($this->_config['options'], $this->_config['toggle'], $this->_config['toggleOptions']);
        	}

        	// Render Button
        	if ($this->_config['type'] == self::TYPE_BUTTON ) {
        		return Html::button($this->_config['label'], $this->_config['options']);
        	}

        	elseif ($this->_config['type'] == self::TYPE_SUBMIT ) {
        		return Html::submitButton($this->_config['label'], $this->_config['options']);
        	}

        	else{

        		return Html::a($this->_config['label'], $this->_config['url'], $this->_config['options']);
        	}
        }
    }

 ?>
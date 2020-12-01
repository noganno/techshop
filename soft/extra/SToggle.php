<?php 

	namespace soft\extra;

	use Yii;
	use yii\web\View;
	use soft\helpers\SArray;


	/**
	 * Render toggle data (tooltip or popover) for buttons
	*/

	/**
	 * @author: Shukurullo Odilov
	 */

	class SToggle
	{
		/**
		 * @var options[] is the button options
		*/
		
		public $options = [];

		public const toggle = [
			'tooltip' => 'tooltip',
			'popover' => 'popover',
		];

		public const placement = [
			'top' => 'top',
			'left' => 'left',
			'bottom' => 'bottom',
			'right' => 'right',
		];

		public const trigger = [
			'click' => 'click',
			'focus' => 'focus',
			'hover' => 'hover',
		];

		public const data = [
			'toggle' => self::toggle['tooltip'],
			'placement' => self::placement['top'],
			'trigger' => self::trigger['hover'],
		];

		/**
		 * Add toggle data to options[]
		*/
		
		public static function render(&$options, $toggle, $data){
		
			  $data = SArray::merge(self::data, $data);

			  $view = Yii::$app->view;

			/*  if ($toggle == self::toggle['tooltip'] ) {
			  	$view->registerJs("$('[data-toggle=tooltip]').tooltip()", View::POS_READY, 'registerTooltip');
			  }

			  if ($toggle == self::toggle['popover'] ) {
			  	$view->registerJs("$('[data-toggle=popover]').popover()", View::POS_READY, 'registerPopover');
			  }*/

			  $data['toggle'] = $toggle;

			  foreach ($data as $key => $value) {
			  	$options['data-'.$key] = $value;
			  }
		        
		}

	}


 ?>
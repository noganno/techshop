<?php 


	namespace soft\base;
    
//    use yii\base\Widget;
    use yii\bootstrap4\Widget;
    use yii\web\View;
    use yii\helpers\ArrayHelper;



	/**
	 * @author Shukurullo Odilov
	 */
	class SWidgetBase extends Widget
	{
		
		public $html;

		public $_layout = [];
		public $layout = [];

		public $_config = [];
		public $config = [];

		public $_events = [];
		public $events = [];

		public $_css;
		public $css;
		public $_js;
		public $js;
		public $jsPosition = View::POS_READY;


		/**
		 * Widget event Template
		*/

		public $eventTemplate = "$('#{id}').on('{event}', function(e){
			{content}
		})";

		/**
		 * Init function
		*/

        public function init()
        {
            $defaults = $this->defaultValues();
            $this->_layout = ArrayHelper::merge( $this->_layout, $defaults['layout'], $this->config);
            $this->_config = ArrayHelper::merge( $this->_config, $defaults['config'], $this->config);
            $this->_events = ArrayHelper::merge($this->_events, $defaults['events'],  $this->events);
            parent::init();
        }

		public function defaultValues()
		{
			return [
				'layout' => [],
				'config' => [],
                'events' => [],
			];
		}

		/**
		 *  Widget assets
		 * */

		public function asset()
		{
			
		}

        public function cssFile($url, $options = [], $key = null)
        {
            $this->view->registerCssFile($url, $options, $key);
        }

        public function jsFile($url, $options = [], $key = null)
        {
            $this->view->registerJsFile($url, $options, $key);
        }

        public function registerCss($css, $options = [], $key = null)
        {
        	$this->view->registerCss($css, $options = [], $key = null);
        }

        public function registerJs($js, $position = View::POS_READY, $key = null)
        {
            $this->view->registerJs($js, $this->jsPosition, $key = null);
        }

        public function depends($assetClassName)
        {
        	$this->view->registerAssetBundle($assetClassName);
        }


        /**
         * Main function
        */
        
        public function main()
        {
        	
        }

		public function run()
		{

			$this->main();
			$this->registerCss($this->_css);
			$this->registerCss($this->css);
			$this->registerJs($this->_js);
			$this->registerJs($this->js);
			$this->registerEvents();

			$this->asset();

			echo $this->html;

		}


		public function registerEvents()
		{
			foreach ($this->_events as $event => $content) {

				$js = strtr($this->eventTemplate, [

					'{id}' => $this->getId(),
					'{event}' => $event,
					'{content}' => $content,

				]);

				$this->registerJS($js);
			}
		}


	}

 ?>
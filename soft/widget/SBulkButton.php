<?php 
	
	namespace soft\widget;

	use soft\base\SWidgetBase;
	use soft\widget\SStyle;
    use soft\widget\SButton;

	/**
	 * @author Shukurullo Odilov
	 */

	class SBulkButton extends SWidgetBase
	{
		

		public $_config = [
            'confirmTitle' =>  'Tasdiqlaysizmi?',
            'size' => SStyle::btnSize['xs'],
            'confirmMessage' => "Siz ushbu amalni bajarishni tasdiqlaysizmi?",
			'options' => [
             'role' => 'modal-remote-bulk',
             'data-confirm' => false,
             'data-method' => false,
             'data-request-method' => 'post',
            ],
		];
            
        public function main()
        {
            $config = $this->_config;
           
            $config['options']['data-confirm-title'] = $config['confirmTitle'];
            $config['options']['data-confirm-message'] = $config['confirmMessage'];

        	$this->html = SButton::widget([ 'config' => $config]);
        }
       
    }

 ?>
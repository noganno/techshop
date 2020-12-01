<?phpnamespace soft\helpers;use Yii;use yii\helpers\Html;use soft\helpers\SArray;class SHtml extends Html{	/**	 * Generates a tag with icon if $icon is not null	 * if $options[visible] == false return ""	*/		public static function a($text, $url = null, $options = [], $icon = null)	{       	$text = static::withIcon($text, $icon);    	if (isset($options['visible'])) {    		if (!$options['visible']) {    			return "";    		}    		unset($options['visible']);    	}        return parent::a($text, $url, $options);	}	 /**         * Generates icon         */        public static function icon($icon = null)        {            if ($icon == null) {return ""; }            $icon = explode(",", $icon);            if (count($icon) > 1 && $icon[1] === 'gly') {                $i = Html::tag('span', "", ['class' => 'glyphicon glyphicon-'.$icon[0]]);            }//            if (count($icon) > 1 && $icon[1] === 'fa') {//                $i = Html::tag('i', "", ['class' => 'fa fa-'.$icon[0]]);//            }            else{                $i = Html::tag('i', "", ['class' => 'fa fa-'.$icon[0]]);            }               return $i;        }        /**         * Generates text with icon         */                public static function withIcon($text = null, $icon = null)        {            if ($icon == null) {                return $text;            }            return static::icon($icon)." ".$text;        }         /**         * Generates badge         */        public static function badge($badgeText = null)        {            if ($badgeText === null) {                return "";             }            else{                return parent::tag('span', $badgeText, ['class' => 'badge']);            }        }        /**    	 * Generates text with  badge     	*/    	    	public static function withBadge($label = null, $badgeText = '')    	{    		$badge = static::badge($badgeText);    		return $badge." ".$label;    	}    	 /**         * Generates back button        */        public static function back($url = null, $options=[], $icon = 'arrow-left' ){        			if ($url == null) {				$url = Yii::$app->request->referrer;			}			SArray::setValueIfNoValid($options, 'class', 'btn btn-primary btn-sm');			return static::a("Ortga", $url, $options, $icon);        }        public static function submitButton($label = null, $options = [])        {            $options['type'] = 'submit';            $label = $label == null ? Yii::t('app', 'Save') : $label;            $label = static::withIcon($label, 'floppy-disk,gly');            SArray::setValueIfNoValid($options, 'class', 'btn btn-success');            return static::button($label, $options);        }        public static function createButton($label = null, $url=['create'], $options = [])        {            $label = $label == null ? Yii::t('app', 'Create new') : $label;            $label = static::withIcon($label, 'plus,gly');            SArray::setValueIfNoValid($options, 'class', 'btn btn-success');            return static::a($label, $url, $options);        }        public static function updateButton($id='', $label = null, $url=['update'], $options = [])        {            $label = $label == null ? Yii::t('app', 'Update') : $label;            $label = static::withIcon($label, 'edit,gly');            $url['id'] = $id;            SArray::setValueIfNoValid($options, 'class', 'btn btn-primary');            return static::a($label, $url, $options);        }}
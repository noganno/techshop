<?php 

 	namespace soft\service;

 	use Yii;
 	use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use soft\grid\SKGridView;


 	/**
 	 * @author Shukurullo Odilov
 	 */

 	class Attribute extends \yii\base\Model
 	{
 		
 		public static function selectColumns($model, $cols = [], $vars = [])
 		{

            $result = [];
            $modelColumns = ArrayHelper::merge(SKGridView::defaultColumns(), $model->columns());
 		     
            foreach ($cols as $key => $value) {
                if (is_string($value)) {
                    if (ArrayHelper::keyExists($value, $modelColumns)) {
                        $result[] = ArrayHelper::getValue($modelColumns, $value);
                    }
                    else{
                        $result[] = $value;
                    }
                }
                else{

                     if (ArrayHelper::keyExists($key, $modelColumns)) {
                        $column = ArrayHelper::merge(ArrayHelper::getValue($modelColumns, $key), $value);
                    }
                    else{
                        $column = $value;
                    }

                    if (!isset($column['attribute']) && $model->hasAttribute($key) ) {
                       ArrayHelper::setValue($column, 'attribute', $key);
                    }

                    $result[] = $column;

                }
    
            }

            return $result;
 		}


 		


 	}

 ?>
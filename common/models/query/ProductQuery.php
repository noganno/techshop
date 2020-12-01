<?php



namespace common\models\query;

use Yii;
use backend\models\ProductCategory;
use backend\models\PcAssign;
use yii\helpers\ArrayHelper;

class ProductQuery extends \soft\db\SActiveQuery

{

    public function active()

    {
        return $this->andWhere(['product.status' => 1, '{{%product}}.deleted' => false]);
    }


    public function filterByCategory($categoryId)
    {
        $assigns = PcAssign::find()-> where(['pc_id' => $categoryId])->all();
        $productIds = ArrayHelper::getColumn($assigns, 'p_id');
        return $this->andWhere(['in', 'id', $productIds]);
    }

    public function filterByCategories($categoryIds = [])
    {
        if (!empty($categoryIds)){
            $i = 1;
            foreach ($categoryIds as $id){
                $category = ProductCategory::findActiveOne($id);
                if($category != null) {
                    $assigns = PcAssign::find()-> where(['in', 'pc_id', $category->getSubcategoriesIds()])->all();
                    $productIds = ArrayHelper::getColumn($assigns, 'p_id');
                    if ($i == 1){
                        $this->andFilterWhere(['in', 'id', $productIds])->active();
                    }
                    else{
                        $this->orFilterWhere(['in', 'id', $productIds])->active();
                    }
                    $i++;
                }
            }
        }
    }


    public function filterByCost($minCost=0, $maxCost=10000, $regionCost=0)
    {

        $query = $this;

        $minCost = intval($minCost);
        $maxCost = intval($maxCost);
        $regionCost = intval($regionCost);

        $dollarCourse = Yii::$app->help->dollarCourse;
        if ($regionCost == null ||  $regionCost < 0){
            $regionCost = 0;
        }
        
        $difference = $regionCost/$dollarCourse;
        
        if($minCost == null){
            $minCost = 0;
        }
        
            
        $min = $minCost - $difference;
        $query = $query->andWhere(['>', 'product.current_cost',  $min]);
        
        
        if($maxCost == null){
            $maxCost = 10000;
        }

        $max = $maxCost - $difference;
          
        $query = $query->andWhere(['<', 'product.current_cost',  $max]);
            
        return $query; 
       
    }

    public function hit($hit=true)
    {
        if ($hit){
            $hit = true;
        }
        $this->andFilterWhere(['product.hit' => $hit]);
    }

    public function new($new=true)
    {
        if ($new){
            $new = true;
        }
        $this->andFilterWhere(['product.new' => $new]);
    }

    public function recommend($recommend=true)
    {
        if ($recommend){
            $recommend = true;
        }
        $this->andFilterWhere(['product.recommend' => $recommend]);
    }

    public function top()
    {
        $this->orderBy(['product.order_count' => SORT_DESC]);
    }

}
<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $unique_id
 * @property string|null $sklad_id
 * @property string|null $slug
 * @property string|null $model
 * @property int|null $quantity
 * @property int|null $stock_status_id
 * @property int|null $manufacturer_id
 * @property float|null $price
 * @property float|null $sale_price
 * @property float|null $loan_price
 * @property float|null $weight
 * @property int|null $weight_class_id
 * @property float|null $length
 * @property int|null $length_class_id
 * @property int|null $sort_order
 * @property int|null $status
 * @property int|null $viewed
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $action
 * @property string|null $action_beginig_date
 * @property string|null $action_finishing_date
 * @property int|null $new
 * @property int|null $recommend
 * @property int|null $xit
 * @property int|null $deposit
 * @property int|null $order_count
 * @property int|null $deleted
 * @property int|null $warranty_id
 * @property int|null $country_id
 * @property int|null $old_site_id
 * @property int|null $is_new_product Yangi saytda yo'q, lekin 1C da bor bo'lsa, qiymati true bo'ladi
 *
 * @property OrderProducts[] $orderProducts
 * @property ProductToSklad[] $productToSklads
 * @property QuickOrders[] $quickOrders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quantity', 'stock_status_id', 'manufacturer_id', 'weight_class_id', 'length_class_id', 'sort_order', 'status', 'viewed', 'created_at', 'updated_at', 'action', 'new', 'recommend', 'xit', 'deposit', 'order_count', 'deleted', 'warranty_id', 'country_id', 'old_site_id', 'is_new_product'], 'integer'],
            [['price', 'sale_price', 'loan_price', 'weight', 'length'], 'number'],
            [['action_beginig_date', 'action_finishing_date'], 'safe'],
            [['unique_id', 'sklad_id', 'model'], 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 127],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unique_id' => Yii::t('app', 'Unique ID'),
            'sklad_id' => Yii::t('app', 'Sklad ID'),
            'slug' => Yii::t('app', 'Slug'),
            'model' => Yii::t('app', 'Model'),
            'quantity' => Yii::t('app', 'Quantity'),
            'stock_status_id' => Yii::t('app', 'Stock Status ID'),
            'manufacturer_id' => Yii::t('app', 'Manufacturer ID'),
            'price' => Yii::t('app', 'Price'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'loan_price' => Yii::t('app', 'Loan Price'),
            'weight' => Yii::t('app', 'Weight'),
            'weight_class_id' => Yii::t('app', 'Weight Class ID'),
            'length' => Yii::t('app', 'Length'),
            'length_class_id' => Yii::t('app', 'Length Class ID'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'status' => Yii::t('app', 'Status'),
            'viewed' => Yii::t('app', 'Viewed'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'action' => Yii::t('app', 'Action'),
            'action_beginig_date' => Yii::t('app', 'Action Beginig Date'),
            'action_finishing_date' => Yii::t('app', 'Action Finishing Date'),
            'new' => Yii::t('app', 'New'),
            'recommend' => Yii::t('app', 'Recommend'),
            'xit' => Yii::t('app', 'Xit'),
            'deposit' => Yii::t('app', 'Deposit'),
            'order_count' => Yii::t('app', 'Order Count'),
            'deleted' => Yii::t('app', 'Deleted'),
            'warranty_id' => Yii::t('app', 'Warranty ID'),
            'country_id' => Yii::t('app', 'Country ID'),
            'old_site_id' => Yii::t('app', 'Old Site ID'),
            'is_new_product' => Yii::t('app', 'Is New Product'),
        ];
    }

    /**
     * Gets query for [[OrderProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProducts::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductToSklads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductToSklads()
    {
        return $this->hasMany(ProductToSklad::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[QuickOrders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuickOrders()
    {
        return $this->hasMany(QuickOrders::className(), ['product_id' => 'id']);
    }
}

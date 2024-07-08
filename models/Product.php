<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property ProductPrice[] $productPrices
 * @property Purchase[] $purchases
 */
class Product extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'products';
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProductPrices(): ActiveQuery
    {
        return $this->hasMany(ProductPrice::class, ['product_id' => 'id']);
    }

    public function getPurchases(): ActiveQuery
    {
        return $this->hasMany(Purchase::class, ['product_id' => 'id']);
    }
}

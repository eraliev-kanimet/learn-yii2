<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property CurrencyRate[] $currencyRates
 * @property ProductPrice[] $productPrices
 */
class Currency extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'currencies';
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
            [['code', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCurrencyRates(): ActiveQuery
    {
        return $this->hasMany(CurrencyRate::class, ['currency_id' => 'id']);
    }

    public function getProductPrices(): ActiveQuery
    {
        return $this->hasMany(ProductPrice::class, ['currency_id' => 'id']);
    }
}

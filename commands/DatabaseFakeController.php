<?php

namespace app\commands;

use app\models\Currency;
use app\models\CurrencyRate;
use app\models\Product;
use app\models\ProductPrice;
use app\models\Purchase;
use app\models\User;
use Faker\Factory;
use yii\base\Exception;
use yii\console\Controller;

class DatabaseFakeController extends Controller
{
    /**
     * @throws \yii\db\Exception
     * @throws Exception
     */
    public function actionIndex(): void
    {
        $this->actionUsers();
        $this->actionCurrencies();
        $this->actionProducts();
        $this->actionPurchases();
    }

    /**
     * @throws Exception
     * @throws \yii\db\Exception
     */
    public function actionUsers(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->name = $faker->name;
            $user->email = $faker->unique()->email;
            $user->setPassword('password');

            $user->save();
        }

        echo "Fake users generation completed.\n\n";
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionCurrencies(): void
    {
        $currencies = [
            'RUB' => ['Ruble', 1],
            'USD' => ['Dollar', 89],
        ];

        if (!Currency::find()->where(['in', 'code', array_keys($currencies)])->count()) {
            foreach ($currencies as $code => $value) {
                $currency = new Currency();

                $currency->code = $code;
                $currency->name = $value[0];

                $currency->save();

                $currencyRate = new CurrencyRate();
                $currencyRate->currency_id = $currency->id;
                $currencyRate->rate = $value[1];
                $currencyRate->date = date('Y-m-d H:i:s');

                $currencyRate->save();
            }
        }

        echo "Fake currencies generation completed.\n\n";
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionProducts(): void
    {
        $faker = Factory::create();

        $products = [
            'Study ticket' => 10000,
            'Individual counseling' => 5000,
        ];

        $currencies = Currency::find()->limit(2)->all();

        if (count($currencies) == 2 && !Product::find()->where(['in', 'name', array_keys($products)])->count()) {
            foreach ($products as $name => $price) {
                $product = new Product();

                $product->name = $name;
                $product->description = $faker->text;

                $product->save();

                /** @var Currency $currency */
                foreach ($currencies as $currency) {
                    $productPrice = new ProductPrice();

                    $productPrice->product_id = $product->id;
                    $productPrice->currency_id = $currency->id;
                    $productPrice->value = $price;

                    $productPrice->save();
                }
            }
        }

        echo "Fake products generation completed.\n\n";
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionPurchases(): void
    {
        $faker = Factory::create();

        $prices = ProductPrice::find()
            ->with('currency.currencyRates')
            ->limit(10)
            ->all();

        /** @var ProductPrice $price */
        foreach ($prices as $price) {
            $purchase = new Purchase();

            $purchase->product_id = $price->product_id;
            $purchase->name = $faker->name;
            $purchase->phone = $faker->phoneNumber;
            $purchase->amount = $price->value * $price->currency->currencyRates[0]->rate;
            $purchase->payment_status = rand(0, 1);

            $purchase->save();
        }

        echo "Fake purchases generation completed.\n\n";
    }
}
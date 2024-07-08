<?php

namespace app\components;

use yii\db\Migration as BaseMigration;

class Migration extends BaseMigration
{
    public function timestamps(): array
    {
        return [
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ];
    }
}
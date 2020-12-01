<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%warranty}}`.
 */
class m200926_033215_create_warranty_table extends \soft\db\SMigration
{

    public $multilingiualAttributes = ['name'];
    public $authorId = false;
    public $tableName = 'warranty';

    public function attributes()
    {
        return [
            'name' => $this->string()->notNull()->unique()
        ];
    }


}

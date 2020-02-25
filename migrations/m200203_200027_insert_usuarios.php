<?php

use yii\db\Migration;

/**
 * Class m200203_200027_insert_usuarios
 */
class m200203_200027_insert_usuarios extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('usuarios', [
            'nombre' => 'pepe',
            'password' => Yii::$app->security->generatePasswordHash('pepe'),
            'auth_key' => Yii::$app->security->generateRandomString(60),
            'telefono' => '123123123',
            'poblacion' => 'Sanlúcar',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('usuarios', ['nombre' => 'pepe']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200203_200027_insert_usuarios cannot be reverted.\n";

        return false;
    }
    */
}

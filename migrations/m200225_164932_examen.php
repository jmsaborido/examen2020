<?php

use yii\db\Migration;

/**
 * Class m200225_164932_examen
 */
class m200225_164932_examen extends Migration
{
    public function safeUp()
    {
        $this->createTable('codpostales', [
            'id' => $this->primaryKey(),
            'poblacion_id' => $this->bigInteger()->notNull(),
        ]);
        $this->createTable('poblaciones', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(60)->notNull(),
            'provincia_id' => $this->bigInteger()->notNull(),
        ]);
        $this->createTable('provincias', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(60)->notNull(),
        ]);

        $this->addForeignKey(
            'fk_codpostales_poblaciones',
            'codpostales',
            'poblacion_id',
            'poblaciones',
            'id'
        );
        $this->addForeignKey(
            'fk_poblaciones_provincias',
            'poblaciones',
            'provincia_id',
            'provincias',
            'id'
        );
        $this->renameColumn(
            'lectores',
            'cod_postal',
            'codpostal_id'
        );
        $this->alterColumn(
            'lectores',
            'codpostal_id',
            $this->bigInteger()->notNull()
        );
        $this->addForeignKey(
            'fk_lectores_codpostales',
            'lectores',
            'codpostal_id',
            'codpostales',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_poblaciones_provincias', 'poblaciones');
        $this->dropForeignKey('fk_codpostales_poblaciones', 'codpostales');
        $this->dropForeignKey('fk_lectores_codpostales', 'lectores');
        $this->dropTable('poblaciones');
        $this->dropTable('provincias');
        $this->dropTable('codpostales');
        $this->renameColumn(
            'lectores',
            'codpostal_id',
            'cod_postal'
        );
        $this->alterColumn(
            'lectores',
            'cod_postal',
            $this->integer(5)
        );
    }
}

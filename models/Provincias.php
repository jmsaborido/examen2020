<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property Poblaciones[] $poblaciones
 */
class Provincias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * Gets query for [[Poblaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoblaciones()
    {
        return $this->hasMany(Poblaciones::className(), ['provincia_id' => 'id'])->inverseOf('provincia');
    }
}

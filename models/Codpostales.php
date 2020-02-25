<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "codpostales".
 *
 * @property int $id
 * @property int $poblacion_id
 *
 * @property Poblaciones $poblacion
 * @property Lectores[] $lectores
 */
class Codpostales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'codpostales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['poblacion_id'], 'required'],
            [['poblacion_id'], 'default', 'value' => null],
            [['poblacion_id'], 'integer'],
            [['poblacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poblaciones::className(), 'targetAttribute' => ['poblacion_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'poblacion_id' => 'Poblacion ID',
        ];
    }

    /**
     * Gets query for [[Poblacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPoblacion()
    {
        return $this->hasOne(Poblaciones::className(), ['id' => 'poblacion_id'])->inverseOf('codpostales');
    }

    /**
     * Gets query for [[Lectores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLectores()
    {
        return $this->hasMany(Lectores::className(), ['codpostal_id' => 'id'])->inverseOf('codpostal');
    }
}

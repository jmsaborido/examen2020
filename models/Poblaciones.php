<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poblaciones".
 *
 * @property int $id
 * @property string $nombre
 * @property int $provincia_id
 *
 * @property Codpostales[] $codpostales
 * @property Provincias $provincia
 */
class Poblaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'poblaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'provincia_id'], 'required'],
            [['provincia_id'], 'default', 'value' => null],
            [['provincia_id'], 'integer'],
            [['nombre'], 'string', 'max' => 60],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::className(), 'targetAttribute' => ['provincia_id' => 'id']],
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
            'provincia_id' => 'Provincia ID',
        ];
    }

    /**
     * Gets query for [[Codpostales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodpostales()
    {
        return $this->hasMany(Codpostales::className(), ['poblacion_id' => 'id'])->inverseOf('poblacion');
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id'])->inverseOf('poblaciones');
    }
}

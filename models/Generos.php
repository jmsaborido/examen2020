<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "generos".
 *
 * @property int $id
 * @property string $denom
 * @property string $created_at
 *
 * @property Libros[] $libros
 */
class Generos extends \yii\db\ActiveRecord
{
    private $_total = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'generos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denom'], 'required'],
            [['created_at'], 'safe'],
            [['denom'], 'string', 'max' => 255],
            [['denom'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denom' => 'Denominación',
            'created_at' => 'Fecha de alta',
        ];
    }

    public function setTotal($total)
    {
        $this->_total = $total;
    }

    public function getTotal()
    {
        if ($this->_total === null && !$this->isNewRecord) {
            $this->setTotal($this->getLibros()->count());
        }
        return $this->_total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libros::className(), ['genero_id' => 'id'])->inverseOf('genero');
    }

    public static function findWithTotal()
    {
        return static::find()
            ->select(['generos.*', 'COUNT(l.id) AS total'])
            ->joinWith('libros l', false)
            ->groupBy('generos.id');
    }

    public static function lista()
    {
        return static::find()->select('denom')->indexBy('id')->column();
    }
}

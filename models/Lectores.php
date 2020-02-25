<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lectores".
 *
 * @property int $id
 * @property string $numero
 * @property string $nombre
 * @property string|null $direccion
 * @property string $poblacion
 * @property string $provincia
 * @property int $codpostal_id
 * @property string|null $fecha_nac
 * @property string $created_at
 * 
 * @property Codpostales $codpostal
 * @property Prestamos[] $prestamos
 * @property Libros[] $libros
 */
class Lectores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lectores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'nombre', 'poblacion', 'provincia'], 'required'],
            [['codpostal_id'], 'default', 'value' => null],
            [['codpostal_id'], 'integer'],
            [['fecha_nac', 'created_at'], 'safe'],
            [['numero'], 'string', 'max' => 9],
            [['nombre', 'direccion', 'poblacion', 'provincia'], 'string', 'max' => 255],
            [['numero'], 'unique'],
            [['codpostal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Codpostales::className(), 'targetAttribute' => ['codpostal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'nombre' => 'Nombre',
            'direccion' => 'Direccion',
            'poblacion' => 'Poblacion',
            'provincia' => 'Provincia',
            'codpostal_id' => 'Codigo Postal',
            'fecha_nac' => 'Fecha Nac',
            'created_at' => 'Created At',
        ];
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['lector_id' => 'id'])->inverseOf('lector');
    }

    public function getLibros()
    {
        return $this->hasMany(Libros::class, ['id' => 'libro_id'])->via('prestamos');
    }

    public function getPrestados()
    {
        return $this->getLibros()
            ->via('prestamos', function ($query) {
                $query->andWhere(['devolucion' => null]);
            });
    }

    public static function lista()
    {
        return static::find()->select('nombre')->indexBy('id')->column();
    }
    public function getCodpostal()
    {
        return $this->hasOne(Codpostales::className(), ['id' => 'codpostal_id'])->inverseOf('lectores');
    }
}

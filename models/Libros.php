<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "libros".
 *
 * @property int $id
 * @property string $isbn
 * @property string $titulo
 * @property int|null $num_pags
 * @property int $genero_id
 * @property string $created_at
 *
 * @property Generos $genero
 * @property Prestamos[] $prestamos
 * @property Lectores[] $lectores
 */
class Libros extends \yii\db\ActiveRecord
{
    private $_imagen = null;
    private $_imagenUrl = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isbn', 'titulo', 'genero_id'], 'required'],
            [['num_pags', 'genero_id'], 'default', 'value' => null],
            [['num_pags'], 'integer', 'min' => 0],
            ['genero_id', 'integer'],
            ['num_pags', 'positivo'],
            [['created_at'], 'safe'],
            [['isbn'], 'string', 'max' => 13],
            [['titulo'], 'string', 'max' => 255],
            [['isbn'], 'unique'],
            [['genero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Generos::className(), 'targetAttribute' => ['genero_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'Isbn',
            'titulo' => 'Título',
            'num_pags' => 'Núm. Pags.',
            'genero_id' => 'Género ID',
            'created_at' => 'Fecha de alta',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Generos::className(), ['id' => 'genero_id'])->inverseOf('libros');
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamos::className(), ['libro_id' => 'id'])->inverseOf('libro');
    }

    public function getLectores()
    {
        return $this->hasMany(Lectores::class, ['id' => 'lector_id'])->via('prestamos');
    }

    public function getEstaPrestado()
    {
        return $this->getPrestamos()
            ->andOnCondition(['devolucion' => null])
            ->exists();
    }

    public function getImagen()
    {
        if ($this->_imagen !== null) {
            return $this->_imagen;
        }

        $this->setImagen(Yii::getAlias('@img/' . $this->id . '.jpg'));
        return $this->_imagen;
    }


    public function setImagen($imagen)
    {
        $this->_imagen = $imagen;
    }

    public function getImagenUrl()
    {
        if ($this->_imagenUrl !== null) {
            return $this->_imagenUrl;
        }

        $this->setImagenUrl(Yii::getAlias('@imgUrl/' . $this->id . '.jpg'));
        return $this->_imagenUrl;
    }

    public function setImagenUrl($imagenUrl)
    {
        $this->_imagenUrl = $imagenUrl;
    }

    public static function lista()
    {
        return static::find()->select('titulo')->indexBy('id')->column();
    }
    public function positivo($attribute)
    {
        if ($attribute < 0) {
            $this->addError($attribute, "");
        }
    }
}

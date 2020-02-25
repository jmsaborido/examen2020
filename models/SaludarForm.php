<?php

namespace app\models;

use yii\base\Model;

class SaludarForm extends Model
{
    public $nombre;
    public $telefono;

    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['telefono'], 'number'],
        ];
    }
}

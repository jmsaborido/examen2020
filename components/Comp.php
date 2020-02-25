<?php

namespace app\components;

use yii\base\Behavior;

class Comp extends Behavior
{
    public $direccion;
    
    private $_telefono;

    public function getTelefono()
    {
        return $this->_telefono;
    }

    public function setTelefono($telefono)
    {
        $this->_telefono = $telefono;
    }
}

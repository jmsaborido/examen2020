<?php

namespace app\components;

use yii\base\Component;
use yii\base\Event;

class Prueba extends Component
{
    const EVENTO_HOLA = 'hola';

    public $apellidos;

    private $_nombre = 'pepe';

    public function behaviors()
    {
        return [
            'comp' => [
                'class' => Comp::class,
                'telefono' => 555555,
                'direccion' => 'Calle Falsa, 123',
            ],
        ];
    }

    public function __construct($config = [])
    {
        // Aquí hacemos lo que tengamos que hacer
        // Y al final:
        parent::__construct($config);
    }

    public function init()
    {
        parent::init();
        // Hacer lo que tengamos que hacer
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function setNombre($nombre)
    {
        $this->_nombre = trim($nombre);
    }
}

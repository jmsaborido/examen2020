<?php

namespace app\components;

use yii\base\Component;

class Dos extends Component
{
    public $nombre;

    public function __construct($nombre, $config = [])
    {
        $this->nombre = $nombre;
        parent::__construct($config);
    }
}

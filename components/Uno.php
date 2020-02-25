<?php

namespace app\components;

use yii\base\Component;

class Uno extends Component
{
    public $dos;

    public function __construct(Dos $dos, $config = [])
    {
        $this->dos = $dos;
        parent::__construct($config);
    }

}

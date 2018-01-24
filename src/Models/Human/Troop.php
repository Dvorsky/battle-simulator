<?php

namespace App\Models\Human;

use App\Models\BaseTroop;
use App\Models\Army;


class Troop extends BaseTroop
{
    public $name = 'Human Troop';
    public $army;

    public function __construct(Army $army)
    {
        $this->set_stats();
        $this->army = $army;
    }


}
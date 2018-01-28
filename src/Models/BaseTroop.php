<?php

namespace App\Models;

class BaseTroop
{
    public $health, $str, $def, $acc;

    /**
     * Basic stats to a Troop model
     */
    public function set_stats()
    {
        $this->health = 100;
        $this->str = rand(10, 20);
        $this->def = rand(5, 10);
        $this->acc = rand(40,60);
    }


}
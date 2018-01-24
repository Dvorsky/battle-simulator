<?php

namespace App\Models;

use App\Models\BaseTroop;


class Troop extends BaseTroop
{
    public function __construct()
    {
        $this->set_stats();
    }


}
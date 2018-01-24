<?php

namespace App\Models;

use App\Models\Human\Troop;

class Army
{
    public $size, $team, $troops = [];

    /**
     * Creates number of troops based on army size
     *
     * @param int $army_size
     * @param string $team
     */
    public function __construct(int $army_size, string $team)
    {
        $this->size = $army_size;
        $this->team = $team;

        for ($i = 0; $i < $army_size; $i++) {
            $troop = new Troop($this);

            array_push($this->troops, $troop);
        }
    }
}
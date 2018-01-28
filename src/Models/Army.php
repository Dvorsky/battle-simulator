<?php

namespace App\Models;

class Army
{
    public $team, $troops = [];
    private $races = [
        'Human',
        'Elf',
        'Orc'
    ];

    /**
     * Creates number of troops based on army size and assigns
     * Army race by random index for $races array
     *
     * @param int $army_size
     * @param string $team
     */
    public function __construct(int $army_size, string $team)
    {
        $this->team = $team;
        $this->race = $this->races[rand(0, count($this->races) - 1)];

        for ($i = 0; $i < $army_size; $i++) {
            $troop = new Troop($this);

            array_push($this->troops, $troop);
        }
    }

    /**
     * Return size of the army
     */
    public function get_size()
    {
        return count($this->troops);
    }
}
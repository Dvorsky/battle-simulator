<?php

namespace App;

use App\Army;
use App\Helpers\Neighbours;

class Soldier
{
    public $str;
    public $fit;
    public $position = [];
    public $team;
    public $army;

    public function __construct(Army $army, Map $map)
    {
        $this->str = rand(10, 20);
        $this->fit = rand(50, 100);
        $this->team = $army->team;
        $this->army = $army;

        $pos = $army->get_last_troop_position();
        $neighbours = Neighbours::check_neighbours($pos, $map, $this);

        while (count($neighbours) == 0) {
            $neighbour = rand(1, 8);
            $pos = Neighbours::switch_pos_to_neighbour($neighbour, $pos);
            $neighbours = Neighbours::check_neighbours($pos, $map, $this);
        }

        $pos = rand(0, count($neighbours) - 1);
        $pos = $neighbours[$pos];
        $x = $pos[0];
        $y = $pos[1];

        $this->position = $pos;

        $map->map[$y][$x] = $this;
    }

    public function __destruct()
    {
        $this->army->size--;
    }

}
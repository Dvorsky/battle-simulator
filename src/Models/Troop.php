<?php

namespace App\Models;

class Troop extends BaseTroop
{
    public $name, $army;

    /**
     * Troop constructor.
     * Changes base Troop stats based on race
     *
     * @param Army $army
     */
    public function __construct(Army $army)
    {
        $this->set_stats();
        $this->army = $army;
        $this->name = $this->army->race . ' Troop';

        if ($this->army->race == 'Elf') {
            $this->str -= $this->str * .05;
            $this->acc += $this->acc * .2;
        } elseif ($this->army->race == 'Orc') {
            $this->str += $this->str * .1;
            $this->acc -= $this->acc * .3;
        } elseif ($this->army->race == 'Human') {
            $this->def += $this->def * .2;
        }
    }


}
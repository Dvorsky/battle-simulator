<?php
/**
 * Created by PhpStorm.
 * User: sykdor
 * Date: 23.01.18.
 * Time: 02:47
 */

namespace App;

use App\Map;


class Army
{
    public $team;
    private $position = [];
    private $last_troop_position = [];
    public $size;

    /**
     * Army constructor. Sets up starting position for army and surrounding soldiers
     *
     * @param int $army_size
     * @param array $position
     */
    public function __construct(int $army_size, array $position, Map $map, $team)
    {
        $this->position = $position;
        $this->last_troop_position = $position;
        $this->team = $team;

        for ($i = 0; $i < $army_size; $i++) {
            if ($soldier = new Soldier($this, $map)) {
                $this->last_troop_position = $soldier->position;
                $this->size++;
            };

        }

    }


    /**
     * Get army position
     *
     * @return array
     */
    public function get_position()
    {
        return $this->position;
    }

    public function get_last_troop_position()
    {
        return $this->last_troop_position;
    }


}
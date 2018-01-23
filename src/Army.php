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

    private $position = [];

    /**
     * Army constructor. Sets up starting position for army and surrounding soldiers
     *
     * @param int $army_size
     * @param array $position
     */
    public function __construct(int $army_size, array $position)
    {
        $this->position = $position;

        for ($i = 0; $i < $army_size; $i++) {

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


}
<?php

namespace App;

class Map
{
    public $map = null;
    public $size = [];

    public function __construct($size_x, $size_y)
    {
        $map = [];

        for ($x = 0; $x < $size_x; $x++) {
            $redak = [];
            for ($y = 0; $y < $size_y; $y++) {
                array_push($redak, null);
            }

            array_push($map, $redak);
        }

        $this->map = $map;
        $this->size = [
            'x' => $size_x,
            'y' => $size_y,
        ];


        return $map;
    }

    public function show()
    {
        foreach ($this->map as $row) {
            foreach ($row as $cell) {
                if ($cell != null) {
                    echo 'army ';
                } else {
                    echo 'null ';
                }
            }
            echo '<br>';
        }
    }

    public function set_army($army_size)
    {
        $x = rand(0, $this->size['x'] - 1);
        $y = rand(0, $this->size['y'] - 1);



        $this->map[$x][$y] = new Army($army_size, [$x, $y]);

        return $this->map[$x][$y];
    }
}
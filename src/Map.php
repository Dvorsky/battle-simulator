<?php

namespace App;

class Map
{
    public $map = null;
    public $size = [];

    public function __construct($size_x, $size_y)
    {
        $map = [];

        for ($y = 0; $y < $size_y; $y++) {
            $row = [];
            for ($x = 0; $x < $size_x; $x++) {
                array_push($row, null);
            }

            array_push($map, $row);
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
                switch (true) {
                    case $cell instanceof Army:
                        echo 'Army ';
                        break;
                    case $cell instanceof Soldier:
                        echo 'Soldier ';
                        break;
                    case $cell == null:
                        echo 'Null ';
                        break;
                }
            }
            echo '<br>';
        }
    }

    public function set_army($army_size, $team)
    {
        $x = rand(0, $this->size['x'] - 1);
        $y = rand(0, $this->size['y'] - 1);

        $this->map[$y][$x] = new Army($army_size, [$x, $y], $this, $team);

        return $this->map[$y][$x];
    }
}
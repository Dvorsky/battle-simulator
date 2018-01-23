<?php

namespace App\Helpers;

use App\Army;
use App\Map;
use App\Soldier;

class Neighbours
{
    public static function check_neighbours(array $pos, Map $map, Soldier $soldier)
    {
        $x = $pos[0];
        $y = $pos[1];

        $empty = [];

        for ($xx = -1; $xx <= 1; $xx++) {
            for ($yy = -1; $yy <= 1; $yy++) {
                if ($xx == 0 && $yy == 0) {
                    continue; # Not a neighbour of itself
                }
                if (!self::is_on_map($x + $xx, $y + $yy, $map)) {
                    continue; # Place isn't on map
                }

                if (self::is_occupied($x + $xx, $y + $yy, $map, $soldier)) {
                    continue; # Place is occupied
                }

                array_push($empty, [$x + $xx, $y + $yy]);
            }
        }

        return $empty;
    }

    public static function is_on_map($x, $y, Map $map)
    {
        if ($x >= 0 && $y >= 0 && $x < $map->size['x'] && $y < $map->size['y']) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_occupied($x, $y, Map $map, Soldier $soldier)
    {
        if ($map->map[$y][$x] == null) {
            return false;
        } elseif ($map->map[$y][$x] instanceof Army) {
            return true;
        } else {
            if (self::is_friendly($x, $y, $map, $soldier)) {
                return true;
            }

            unset($soldier);
            echo '<span>RIP</span>';
            return null;
        }
    }

    public static function is_friendly($x, $y, Map $map, Soldier $soldier)
    {
        return $map->map[$y][$x]->team == $soldier->team ? true : false;
    }

    public static function switch_pos_to_neighbour($neighbour, $pos)
    {
        $x = $pos[0];
        $y = $pos[1];

        switch ($neighbour) {
            case 1:
                $x = $x - 1;
                $y = $y - 1;
                return [$x, $y];
            case 2:
                $y = $y - 1;
                return [$x, $y];
            case 3:
                $x = $x + 1;
                $y = $y - 1;
                return [$x, $y];
            case 4:
                $x = $x + 1;
                return [$x, $y];
            case 5:
                $x = $x + 1;
                $y = $y + 1;
                return [$x, $y];
            case 6:
                $y = $y + 1;
                return [$x, $y];
            case 7:
                $x = $x - 1;
                $y = $y + 1;
                return [$x, $y];
            case 8:
                $x = $x - 1;
                return [$x, $y];

        }
    }
}
<?php

namespace App\Controllers;

use App\Models\Army;
use App\Models\Troop;

class Battle
{
    public $blue, $red, $won = false, $turn, $winner;

    private $attacker, $defender;

    /**
     * Battle constructor.
     *
     * @param Army $blue
     * @param Army $red
     */
    public function __construct(Army $blue, Army $red)
    {
        $this->blue = $blue;
        $this->red = $red;
    }

    /**
     *  Main battle loop
     *  At start generates hit chance and based on it it decides
     *  who is 'Attacker' and who 'Defender'
     *
     */
    public function start()
    {
        while ($this->won !== true) {
            for ($troop_id = 0; $troop_id < $this->bigger_army(); $troop_id++) {
                do {
                    $blue_hit_chance = rand(0, 100);
                    $red_hit_chance = rand(0, 100);
                } while ($blue_hit_chance == $red_hit_chance);

                $this->set_attacker($blue_hit_chance, $red_hit_chance);
                $this->set_defender($blue_hit_chance, $red_hit_chance);

                $enemy_id = $this->get_enemy_id($this->defender->get_size());

                if (isset($this->attacker->troops[$troop_id]) && isset($this->defender->troops[$enemy_id])) {
                    $this->defender = $this->attack($troop_id, $enemy_id, $this->attacker, $this->defender);
                }

                $enemy_id = $this->get_enemy_id($this->defender->get_size());

                if (isset($this->defender->troops[$troop_id]) && isset($this->attacker->troops[$enemy_id])) {
                    $this->attacker = $this->attack($troop_id, $enemy_id, $this->defender, $this->attacker);
                }

                $this->set_teams();
            }
            $this->turn++;

            if ($this->blue->get_size() <= 0 || $this->red->get_size() <= 0) {
                $this->set_winner();
                $this->won = true;
            }
        }
    }


    /**
     * When attacking, first check if you hit or miss by doing acc_check
     * After that, damage calculation is being done
     * At end, check if Troop is killed or not and return the updated Army
     *
     * @param $id_of_attacker
     * @param $id_of_defender
     * @param Army $attacker
     * @param Army $defender
     * @return Army
     */
    public function attack($id_of_attacker, $id_of_defender, Army $attacker, Army $defender)
    {
        if (!$this->acc_check($attacker->troops[$id_of_attacker])) {
            return $defender;
        }

        $dmg = $this->calculate_damage($attacker->troops[$id_of_attacker], $defender->troops[$id_of_defender]);

        $defender->troops[$id_of_defender]->health -= $dmg;

        if ($this->is_dead($defender->troops[$id_of_defender])) {
            $defender = $this->kill($defender, $defender->troops[$id_of_defender]);
        }

        return $defender;
    }

    /**
     * Check if Troop successfully hits the target based on acc
     * It's pretty basic formula which isn't the best
     *
     * @param Troop $troop
     * @return bool
     */
    public function acc_check(Troop $troop)
    {
        if ($troop->acc >= rand(0, 100)) {
            return true;
        }

        return false;
    }

    /**
     * Damage calculation based on formula:
     * damage = att * att / (att + def)
     *
     * @param Troop $attacker
     * @param Troop $defender
     * @return float|int
     */
    public function calculate_damage(Troop $attacker, Troop $defender)
    {
        $dmg = $attacker->str * $attacker->str / ($defender->str + $defender->def);

        return $dmg;
    }

    /**
     * Check if Troop is dead
     *
     * @param Troop $defender
     * @return bool
     */
    public function is_dead(Troop $defender)
    {
        return $defender->health <= 0 ? true : false;
    }

    public function kill(Army $army, Troop $defender)
    {
        $id = array_search($defender, $army->troops);

        unset($army->troops[$id]);
        $army->troops = array_values($army->troops);

        return $army;
    }

    /**
     * Checks who has bigger army and returns it
     *
     * @return int
     */
    public function bigger_army()
    {
        return $this->blue->get_size() > $this->red->get_size() ? $this->blue->get_size() : $this->red->get_size();
    }

    /**
     * Sets teams to blue and red sides, used to save post battle results
     */
    public function set_teams()
    {
        if ($this->attacker->team == 'Blue') {
            $this->blue = $this->attacker;
            $this->red = $this->defender;
        } elseif ($this->defender->team == 'Red') {
            $this->red = $this->attacker;
            $this->blue = $this->defender;
        }

    }

    /**
     * Get an ID number for enemy Troop
     *
     * @param $size
     * @return int
     */
    public function get_enemy_id($size)
    {
        return rand(0, $size - 1);
    }

    /**
     * Set an Attacker
     *
     * @param $blue_hit_chance
     * @param $red_hit_chance
     */
    public function set_attacker($blue_hit_chance, $red_hit_chance)
    {
        $this->attacker = ($blue_hit_chance > $red_hit_chance ? $this->blue : $this->red);
    }

    /**
     * Set a Defender
     *
     * @param $blue_hit_chance
     * @param $red_hit_chance
     */
    public function set_defender($blue_hit_chance, $red_hit_chance)
    {
        $this->defender = ($blue_hit_chance > $red_hit_chance ? $this->red : $this->blue);
    }

    /**
     * Return result of the match
     */
    public function set_winner()
    {
        if ($this->red->get_size() <= 0) {
            $this->winner = $this->blue;
        } elseif ($this->blue->get_size() <= 0) {
            $this->winner = $this->red;
        }
    }
}
<?php

require __DIR__.'/vendor/autoload.php';

use App\Army;
use App\Battle;

/*
 * Grabs army sizes and initializes two army objects which then fight
 */

$army1_size = $_GET['army1'];
$army2_size = $_GET['army2'];

$blue = new Army($army1_size, 'Blue');
$red = new Army($army2_size, 'Red');

$battle = new Battle($blue, $red);
$battle->start();

echo $battle->result;
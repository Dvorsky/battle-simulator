<?php

require __DIR__.'/vendor/autoload.php';

use App\Models\Army;
use App\Controllers\Battle;

/*
 * Grabs army sizes and initializes two army objects which then fight
 */

$army1_size = $_GET['army1'];
$army2_size = $_GET['army2'];

$blue = new Army($army1_size, 'Blue');
$red = new Army($army2_size, 'Red');

$battle = new Battle($blue, $red);
$battle->start();

?>

<p>
    <strong><?= $battle->winner->team ?> won in <?= $battle->turn ?> turns.</strong><br>
    <?= $battle->blue->team ?> was playing as <?= $battle->blue->race ?><br>
    <?= $battle->red->team ?> was playing as <?= $battle->red->race ?><br>
</p>

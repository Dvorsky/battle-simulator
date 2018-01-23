<?php

include('src/functions/print_map.php');
require __DIR__.'/vendor/autoload.php';

use App\Map;

$map = new Map(50, 50);

$army1_size = $_GET['army1'];
$army2_size = $_GET['army2'];


$red = $map->set_army($army1_size);
$blue = $map->set_army($army2_size);

$map->show();





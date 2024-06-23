<?php

use App\Entity\Sci;

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Utils' . DIRECTORY_SEPARATOR . 'config.php'); 

$file = DIR_JSON . "\madeup.json";
$data = file_get_contents($file);
$obj = json_decode($data);

echo count($obj);

for ($i = 0; $i<count($obj); $i++) {
    $sci = new Sci;
    $sci->setSci

    echo $obj[$i]->id;
    echo $obj[$i]->formality->siren;
}
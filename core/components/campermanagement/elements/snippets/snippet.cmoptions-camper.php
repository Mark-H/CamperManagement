<?php
$opts = $modx->getCollectionGraph('cmOption','{ "CamperOptions":{ "Campers":{} } }');

foreach ($opts as $opt) {
    echo 'Option name: '.$opt->get('name').PHP_EOL;
    if ($opt->CamperOptions) {
        foreach ($opt->CamperOptions as $option) {
            if ($option->Campers) {
                echo 'Camper details: ';
                print_r($option->Campers->toArray()).PHP_EOL;
            }
        }
    }
}
?>
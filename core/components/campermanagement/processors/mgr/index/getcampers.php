<?php

$results = array();

$campers = $modx->getCollectionGraph('cmCamper','{ "Brand":{},"CamperOptions":{"Options":{}}}');

foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    $array['brand'] = $camper->Brand->get('name');
    foreach ($camper->CamperOptions as $opt) {
        $array['options'][] = $opt->Options->get('name');
    }
    $array['options'] = implode(", ",$array['options']);
    $results[] = $array;
}

$returnArray = array(
    'success' => true,
    'total' => count($results),
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
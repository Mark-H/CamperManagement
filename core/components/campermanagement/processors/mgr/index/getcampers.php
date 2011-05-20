<?php

$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,20);
$sort = $modx->getOption('sort',$scriptProperties,'keynr');
$dir = $modx->getOption('dir',$scriptProperties,'asc');

$results = array();

$query = $modx->newQuery('cmCamper');
$query->sortby($sort,$dir);

$count = $modx->getCount('cmCamper',$query);

$query->limit($limit,$start);
$campers = $modx->getCollectionGraph('cmCamper','{ "Brand":{}, "Owner": {}, "CamperOptions":{"Options":{}}}',$query);

foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    $array['brand'] = $camper->Brand->get('name');
    $array['owner'] = $camper->Owner->get('lastname');
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
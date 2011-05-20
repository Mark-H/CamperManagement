<?php

$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,20);
$sort = $modx->getOption('sort',$scriptProperties,'lastname');
$dir = $modx->getOption('dir',$scriptProperties,'asc');

$results = array();

$query = $modx->newQuery('cmOwner');
$query->sortby($sort,$dir);

$count = $modx->getCount('cmOwner',$query);

$query->limit($limit,$start);
$owners = $modx->getCollection('cmOwner',$query);

foreach ($owners as $owner) {
    $results[] = $owner->toArray();
}

$returnArray = array(
    'success' => true,
    'total' => $count,
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
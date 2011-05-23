<?php

$start = $modx->getOption('start',$scriptProperties,0);
$limit = 0; // It refuses to do pagination-less without this
//$limit = $modx->getOption('limit',$scriptProperties,999);
$sort = $modx->getOption('sort',$scriptProperties,'name');
$dir = $modx->getOption('dir',$scriptProperties,'asc');

$results = array();

$query = $modx->newQuery('cmOption');
$query->sortby($sort,$dir);

$count = $modx->getCount('cmOption',$query);

$query->limit($limit,$start);
$options = $modx->getCollection('cmOption',$query);

foreach ($options as $opt) {
    $results[] = $opt->toArray();
}

$returnArray = array(
    'success' => true,
    'total' => $count,
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
<?php

$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,20);
$sort = $modx->getOption('sort',$scriptProperties,'name');
$dir = $modx->getOption('dir',$scriptProperties,'asc');
$search = $modx->getOption('query',$scriptProperties,'');
$results = array();

$query = $modx->newQuery('cmBrand');
$query->sortby($sort,$dir);

if ($search !== '') {
    $query->where(array(
        'name:LIKE' => '%'.$search.'%'
    ));
}

$count = $modx->getCount('cmBrand',$query);

$query->limit($limit,$start);
$brands = $modx->getCollection('cmBrand',$query);

foreach ($brands as $brand) {
    $results[] = $brand->toArray();
}

$returnArray = array(
    'success' => true,
    'total' => $count,
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
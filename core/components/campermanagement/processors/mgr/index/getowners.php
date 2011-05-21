<?php

$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,20);
$sort = $modx->getOption('sort',$scriptProperties,'lastname');
$dir = $modx->getOption('dir',$scriptProperties,'asc');
$search = $modx->getOption('query',$scriptProperties,'');

$results = array();

$query = $modx->newQuery('cmOwner');
$query->sortby($sort,$dir);

if ($search !== '') {
    $query->where(array(
        'firstname:LIKE' => '%'.$search.'%'));
    $query->orCondition(array(
        'lastname:LIKE' => '%'.$search.'%'));
}

$count = $modx->getCount('cmOwner',$query);

$query->limit($limit,$start);
$owners = $modx->getCollection('cmOwner',$query);

foreach ($owners as $owner) {
    $results[] = $owner->toArray();
}

if ($modx->getOption('display',$scriptProperties,'') == 'combo') {
    foreach ($results as $o => $val) {
        $newresults[] = array('id' => $val['id'], 'name' => $val['lastname'].', '.$val['firstname'].' ('.$val['id'].')');
    }
    $results = $newresults;
}

$returnArray = array(
    'success' => true,
    'total' => $count,
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
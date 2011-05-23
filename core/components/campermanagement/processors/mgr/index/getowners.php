<?php
/*
 * CamperManagement
 *
 * Copyright 2011 by Mark Hamstra <business@markhamstra.nl>
 *
 * This file is part of CamperManagement, a camper/caravan inventory management
 * addon for MODX Revolution.
 *
 * CamperManagement is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CamperManagement is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CamperManagement; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 */
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
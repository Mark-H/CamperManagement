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
$sort = $modx->getOption('sort',$scriptProperties,'keynr');
$dir = $modx->getOption('dir',$scriptProperties,'asc');

$archiveOnly = $modx->getOption('archive',$scriptProperties,false);

if ($sort == 'id') { $sort = 'cmCamper.id'; }
if ($sort == 'statusname') { $sort = 'cmCamper.status'; }

$results = array();

$query = $modx->newQuery('cmCamper');

$query->sortby($sort,$dir);

if ($archiveOnly) {
    $findStatus = array(5);
} else {
    $findStatus = array(0,1,2,3,4);
}
$query->where(array(
    'status:IN' => $findStatus
              ));

if ($sort != 'cmCamper.id') { $query->sortby('cmCamper.id',$dir); }

$count = $modx->getCount('cmCamper',$query);

$query->limit($limit,$start);

$statuses = array($modx->lexicon('campermgmt.status0'),$modx->lexicon('campermgmt.status1'),$modx->lexicon('campermgmt.status2'),$modx->lexicon('campermgmt.status3'),$modx->lexicon('campermgmt.status4'),$modx->lexicon('campermgmt.status5'));

$campers = $modx->getCollectionGraph('cmCamper','{ "Brand":{}, "Owner": {} }',$query);

foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    $array['statusname'] = $statuses[$array['status']];
    $array['added'] = ($array['added'] > 0) ? date('m-d-Y',$array['added']) : '';
    $array['archived'] = ($array['archived'] > 0) ? date('m-d-Y',$array['archived']) : '';
    $array['brand'] = ($camper->Brand) ? $camper->Brand->get('name') : 'n/a';
    $array['owner'] = ($camper->Owner) ? $camper->Owner->get('lastname').', '.$camper->Owner->get('firstname').' ('.$camper->Owner->get('id').')' : 'n/a';
    $array['options'] = array();
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
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
$limit = $modx->getOption('limit',$scriptProperties,10);
$sort = $modx->getOption('sort',$scriptProperties,'timestamp');
$dir = $modx->getOption('dir',$scriptProperties,'desc');

$includeBrand = (boolean)$modx->getOption('includeBrand',$scriptProperties,true);
$includeOwner = (boolean)$modx->getOption('includeOwner',$scriptProperties,false);
$includeImages = (boolean)$modx->getOption('includeImages',$scriptProperties,true);
$includeOptions = (boolean)$modx->getOption('includeOptions',$scriptProperties,true);

$status = $modx->getOption('status',$scriptProperties,'1,2,3,4');
$status = explode(",", $status);

$numimages = $modx->getOption('numimages',$scriptProperties,1);

$output = '';

// Create the query
$query = $modx->newQuery('cmCamper');
if (count($status) > 1) {
    $query->where(array(
        'cmCamper.status:IN' => $status
    ));
} else {
    $query->where(array(
        'cmCamper.status' => $status[0]
    ));
}

$count = $modx->getCount('cmCamper',$query);
$query->sortby($sort,$dir);
$query->limit($limit,$start);

$queryGraph = array();
if ($includeBrand) { $queryGraph[] = '"Brand":{}'; }
if ($includeImages) { $queryGraph[] = '"Images":{}'; }
if ($includeOwner) { $queryGraph[] = '"Owner":{}'; }
if ($includeOptions) { $queryGraph[] = '"CamperOptions":{ "Options":{} }'; }

$queryGraph = '{ '.implode(', ',$queryGraph).' }';

$campers = $modx->getCollectionGraph('cmCamper',$queryGraph,$query);
$results = array();
foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    if ($includeBrand) {
        $array['brand'] = ($camper->Brand) ? $camper->Brand->get('name') : 'n/a';
    }
    if ($includeOwner) {
        $array['owner'] = ($camper->Owner) ? $camper->Owner->toArray() : 'n/a';
    }
    if ($includeImages) {
        $array['images'] = array();
        foreach ($camper->Images as $img) {
            $array['images'][] = $img->get('image');
        }
        //$array['images'] = implode(", ",$array['images']);
    }
    if ($includeOptions) {
        $array['options'] = array();
        foreach ($camper->CamperOptions as $opt) {
            $array['options'][] = $opt->Options->get('name');
        }
        //$array['options'] = implode(", ",$array['options']);
    }
    $results[] = $array;
}

return '<pre>'.print_r($results,true).'</pre>';
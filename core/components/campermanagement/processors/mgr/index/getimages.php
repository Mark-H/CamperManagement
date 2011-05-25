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
$sort = $modx->getOption('sort',$scriptProperties,'id');
$dir = $modx->getOption('dir',$scriptProperties,'asc');
$cid = $modx->getOption('cid',$scriptProperties,null);
if (empty($cid)) { return $modx->error->failure('Onbekend voertuig. Voordat u afbeeldingen kunt uploaden dient het voertuig te zijn opgeslagen.'); }

$results = array();

$query = $modx->newQuery('cmImages');
$query->where(array(
    'camper' => $cid));
$query->sortby($sort,$dir);

$count = $modx->getCount('cmImages',$query);

$query->limit($limit,$start);
$images = $modx->getCollection('cmImages',$query);

foreach ($images as $img) {
    $results[] = $img->toArray();
}

$returnArray = array(
    'success' => true,
    'total' => $count,
    'results' => $results
);
return $modx->toJSON($returnArray);

?>
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

$includeBrand = (boolean)$modx->getOption('includeBrand',$scriptProperties,false);
$includeOwner = (boolean)$modx->getOption('includeOwner',$scriptProperties,false);
$includeImages = (boolean)$modx->getOption('includeImages',$scriptProperties,false);
$includeOptions = (boolean)$modx->getOption('includeOptions',$scriptProperties,true);

$status = $modx->getOption('status',$scriptProperties,'1,2,3,4');
$status = explode(",", $status);

$numimages = $modx->getOption('numimages',$scriptProperties,1);

/* Templateing properties take in chunk names */
$tplprop['Outer'] = $modx->getOption('tplOuter',$scriptProperties,'cmDefaultTplOuter');
$tplprop['Item'] = $modx->getOption('tplItem',$scriptProperties,'cmDefaultTplItem');

if ($includeImages) {
    $tplprop['ImageOuter'] = $modx->getOption('tplImageOuter',$scriptProperties,'cmDefaultTplImageOuter');
    $tplprop['ImageItem'] = $modx->getOption('tplImageItem',$scriptProperties,'cmDefaultTplImageItem');
}
if ($includeOptions) {
    $tplprop['OptionsOuter'] = $modx->getOption('tplOptionsOuter',$scriptProperties,'cmDefaultTplOptionsOuter');
    $tplprop['OptionsItem'] = $modx->getOption('tplOptionsItem',$scriptProperties,'cmDefaultTplOptionsItem');
}
/* Confirm every tpl property is a valid chunk, and if so, assign the property to the $tpl array */
$tpl = array();
foreach ($tplprop as $key => $value) {
    $tObj = $modx->getObject('modChunk',array('name' => $value));
    if ($tObj instanceof modChunk) {
        $tpl[$key] = $value;
        //$tpl[$key]->setCacheable(0);
        //return $tpl[$key]->isCacheable();
    } else {
        return $key.' chunk does not exist: '.$value;
    }
}

$statusnames = array('Niet bevestigd','Actief','Topper','In optie','Verkocht','Inactief');

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

// Build graph part of the query based on properties (for some optimizing)
$queryGraph = array();
if ($includeBrand) { $queryGraph[] = '"Brand":{}'; }
if ($includeImages) { $queryGraph[] = '"Images":{}'; }
if ($includeOwner) { $queryGraph[] = '"Owner":{}'; }
if ($includeOptions) { $queryGraph[] = '"CamperOptions":{ "Options":{} }'; }
$queryGraph = '{ '.implode(', ',$queryGraph).' }';
//echo '<pre>'.print_r($query->query,true).'</pre>';
$campers = $modx->getCollectionGraph('cmCamper',$queryGraph,$query);
echo count($campers[5]->Images);
$results = array();
foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    $array['statusname'] = $statusnames[$array['status']];

    if ($includeBrand)
        $array['brand'] = ($camper->Brand) ? $camper->Brand->get('name') : 'n/a';
    
    if ($includeOwner)
        $array['owner'] = ($camper->Owner) ? $camper->Owner->toArray() : 'n/a';

    if ($includeImages) {
        $array['images'] = array();
        foreach ($camper->Images as $img) {
            $image = $img->get('path').$img->get('image');
            echo $img->get('image');
            $array['images'][] = $modx->getChunk($tpl['ImageItem'],array('image' => $image));
        }
        if (count($array['images']) > 0)
            $array['images'] = $modx->getChunk($tpl['ImageOuter'],array('images' => implode("\n",$array['images'])));
        else 
            unset ($array['images']);
    }
    if ($includeOptions) {
        $array['options'] = array();
        foreach ($camper->CamperOptions as $opt) {
            $array['options'][] = $modx->getChunk($tpl['OptionsItem'],$opt->Options->toArray()); 
        }

        if (count($array['options']) > 0)
            $array['options'] = $modx->getChunk($tpl['OptionsOuter'],array('options' => implode(", ",$array['options'])));
        else
            unset($array['options']);
    }
    $results[] = $modx->getChunk($tpl['Item'],$array);
    unset ($array);
}

return $modx->getChunk($tpl['Outer'],array('items' => implode("\n",$results)));
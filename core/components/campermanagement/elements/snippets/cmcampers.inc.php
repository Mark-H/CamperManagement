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
$limit = $modx->getOption('limit',$scriptProperties,4);
$sort = $modx->getOption('sort',$scriptProperties,'timestamp');
$dir = $modx->getOption('dir',$scriptProperties,'desc');

$includeBrand = (boolean)$modx->getOption('includeBrand',$scriptProperties,true);
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
if ($includeOwner) {
    $tplprop['Owner'] = $modx->getOption('tplOwner',$scriptProperties,'cmDefaultTplOwner');
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
// Make sure there's a sort on a unique column as well
if ($sort != 'id') { $query->sortby('id','desc'); }
$query->limit($limit,$start);

// If the money_format function doesn't exist, let's declare it now cause we'll need it.
if (!function_exists('money_format')) { require_once $campermgmt->config['corePath'] . '/classes/function.money_format.php'; }

$campers = $modx->getCollection('cmCamper',$query);
$results = array();
foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    $array['statusname'] = $statusnames[$array['status']];

    $array['manufactured'] = ($array['manufactured'] > 0) ? strftime('%d/%m/%Y',$array['manufactured']) : '';
    $array['timestamp'] = ($array['timestamp'] > 0) ? strftime('%d/%m/%Y',$array['timestamp']) : '';
    $array['periodiccheck'] = ($array['periodiccheck'] > 0) ? strftime('%d/%m/%Y',$array['periodiccheck']) : '';

    $array['price'] = ($array['price'] > 0) ? money_format('%+!#10n', $array['price']) : money_format('%+!#10n',0);
    // Fetch brand name
    if ($includeBrand) {
        $tBrand = $camper->getOne('Brand');
        $array['brand'] = ($tBrand instanceof cmBrand) ? $tBrand->get('name') : '';
    }

    // Fetch owner details
    if ($includeOwner) {
        $tOwner = $camper->getOne('Owner');
        $array['owner'] = ($tOwner instanceof cmOwner) ? $modx->getChunk($tpl['Owner'],$tOwner->toArray()) : $array['owner'];
    }

    // Fetch images
    if ($includeImages) {
        $tImages = $camper->getMany('Images');
        if (!empty($tImages)) {
            $array['images'] = array();
            foreach ($tImages as $img) {
                if ($img instanceof cmImages) {
                    $image = $img->get('path').$img->get('image');
                    $array['images'][] = $modx->getChunk(
                        $tpl['ImageItem'],
                        array('image' => $image)
                    );
                }
            }
        }
        if (count($array['images']) > 0)
            $array['images'] = $modx->getChunk($tpl['ImageOuter'],array('images' => implode("\n",$array['images'])));
        else
            unset ($array['images']);
    }

    // Fetch options
    if ($includeOptions) {
        $tOptionsLink = $camper->getMany('CamperOptions');
        if (!empty($tOptionsLink)) {
            $array['options'] = array();
            foreach ($tOptionsLink as $optLink) {
                if ($optLink instanceof cmCamperOptions) {
                    $opt = $optLink->getOne('Options');
                    if ($opt instanceof cmOption)
                        $array['options'][] = $modx->getChunk(
                            $tpl['OptionsItem'],
                            $optLink->getOne('Options')->toArray()
                        );
                }
            }
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
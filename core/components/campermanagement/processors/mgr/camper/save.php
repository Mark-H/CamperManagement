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
$data = $scriptProperties;

$data['manufactured'] = strtotime($data['manufactured']);
$data['periodiccheck'] = strtotime($data['periodiccheck']);
$new = true;
if (is_numeric($data['id'])) {
    $c = $modx->getObject('cmCamper',$data['id']);
    if (!($c instanceof cmCamper)) {
        $c = $modx->newObject('cmCamper');
        $data['added'] = time();
    }
    unset($data['id']);
    $new = false;
} else {
    $c = $modx->newObject('cmCamper');
    $data['added'] = time();
}

if (in_array($data['status'],array(0,5))) {
    if ($c->get('status') != 5) {
        $data['archived'] = time();
    }
} else {
    if (in_array($c->get('status'),array(0,5))) {
        $data['archived'] = 0;
    }
}

$c->fromArray($data);

// Add the brand relationship
$brandObj = $modx->getObject('cmBrand',array('name' => $scriptProperties['brand']));
if (!empty($brandObj)) {
    $c->addOne($brandObj);
} else {
    if (trim($scriptProperties['brand']) == '') {
        return $modx->error->failure($modx->lexicon('campermgmt.error.brand_invalid'));
    }
    $brandObj = $modx->newObject('cmBrand');
    $brandObj->set('name',$scriptProperties['brand']);
    $brandResult = $brandObj->save();
    if ($brandResult === true) {
         $c->addOne($brandObj);
    } else {
        return $modx->error->failure($modx->lexicon('campermgmt.error.brand_undefined'));
    }
}

// If this is an existing record, first unset all options to prevent it from keeping now unchecked options.
if ($new == false) {
    $existingoptions = $c->getMany('CamperOptions');
    if (count($existingoptions) > 0) {
        foreach ($existingoptions as $opt) {
            $opt->remove();
        }
    }
}

// (Re-) Add the options related to this camper
$options = $modx->getOption('options',$scriptProperties,'');
if ($options !== '') {
    $optionsArray = explode(",",$options);
    $optionsObjs = array();
    foreach ($optionsArray as $opt) {
        $tobj = $modx->newObject('cmCamperOptions');
        $tobj->addOne($modx->getObject('cmOption',$opt));
        $optionsObjs[] = $tobj;
    }
    $c->addMany($optionsObjs);
}

// Save the data
$success = $c->save();

if (!$success) {
    return $modx->error->failure($modx->lexicon('campermgmt.error.undefined'));
} else {
    return $modx->error->success($c->get('id'));
}
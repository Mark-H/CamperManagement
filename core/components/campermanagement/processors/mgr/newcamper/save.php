<?php

$dataitems = array('type','plate','car','engine','manufactured','beds','weight','mileage','periodiccheck','remarks','price','status','keynr','owner');
$data = array();

foreach ($dataitems as $di) {
    $data[$di] = $modx->getOption($di,$scriptProperties,'');
}

$data['manufactured'] = strtotime($data['manufactured']);
$data['periodiccheck'] = strtotime($data['periodiccheck']);

$c = $modx->newObject('cmCamper');
$c->fromArray($data);

$brandObj = $modx->getObject('cmBrand',array('name' => $scriptProperties['brand']));
if (!empty($brandObj)) {
    $c->addOne($brandObj);
} else {
    $brandObj = $modx->newObject('cmBrand');
    $brandObj->set('name',$scriptProperties['brand']);
    $brandObj->save();
    $c->addOne($brandObj);
}

$ownerObj = $modx->getObject('cmOwner',$scriptProperties['owner']);
if (!empty($ownerObj)) {
    $c->addOne($ownerObj);
} else {
    echo 'Owner not found!'; // @TODO Return an error
}

$success = $c->save();

if ($success) {
    $modx->error->failure();
} else { $modx->error->success(); }
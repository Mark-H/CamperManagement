<?php


$data = $scriptProperties['data'];
if (empty($data)) { return $modx->error->failure($modx->lexicon('campermgmt.error_undefined')); }

$data = $modx->fromJSON($data);
if (!is_array($data) || empty($data['id']) || !is_numeric($data['id'])) { return $modx->error->failure($modx->lexicon('campermgmt.error_undefined')); }

$img = $modx->getObject('cmImages',$data['id']);
if (!($img instanceof cmImages)) { return $modx->error->failure($modx->lexicon('campermgmt.error_undefined')); }

$img->set('rank',(int) $data['rank']);
$result = $img->save();

if ($result) { return $modx->error->success(); }
else { return $modx->error->failure($modx->lexicon('campermgmt.error_undefined')); }
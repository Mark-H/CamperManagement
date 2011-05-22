<?php

if (empty($scriptProperties['id'])) {
    $owner = $modx->newObject('cmOwner');
} else {
    $owner = $modx->getObject('cmOwner',$scriptProperties['id']);
}
$owner->fromArray($scriptProperties);

$result = $owner->save();

if ($result) {
    return $modx->toJSON(array(
        'success' => true,
        'message' => $owner->get('id'),
        'data' => array()));
}
return $modx->error->failure('Error.');
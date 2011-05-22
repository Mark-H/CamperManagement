<?php

if (empty($scriptProperties['id'])) {
    $owner = $modx->newObject('cmOwner');
} else {
    $owner = $modx->getObject('cmOwner',$scriptProperties['id']);
}
$owner->fromArray($scriptProperties);

$result = $owner->save();

if ($result) {
    return $modx->error->success('Database updated.');
}
return $modx->error->failure('Error.');
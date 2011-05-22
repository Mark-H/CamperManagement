<?php
$owner = $modx->getObject('cmOwner',$scriptProperties['id']);
if (empty($owner)) {
    $owner = $modx->newObject('cmOwner');
}
$owner->fromArray($scriptProperties);

$result = $owner->save();

if ($result) {
    return $modx->error->success('Database updated.');
}
return $modx->error->failure('Error.');
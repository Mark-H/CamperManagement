<?php

$owner = $modx->getObject('cmOwner',$scriptProperties['owner']);
if (!empty($owner)) {
    $owner->remove();
    if ($owner->save()) { return $modx->error->success('Deleted'); }
    else { return $modx->error->failure('Error removing'); }
} else {
    return $modx->error->failure('Owner not found.');
}
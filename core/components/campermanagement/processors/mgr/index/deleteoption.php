<?php

$owner = $modx->getObject('cmOption',$scriptProperties['owner']);
if (!empty($owner)) {
    $owner->remove();
    if ($owner->save()) { return $modx->error->success('Deleted'); }
    else { return $modx->error->failure('Error removing'); }
} else {
    return $modx->error->failure('Option not found.');
}
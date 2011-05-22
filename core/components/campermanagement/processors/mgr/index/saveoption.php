<?php
$option = $modx->getObject('cmOption',$scriptProperties['id']);
if (empty($option)) {
    $option = $modx->newObject('cmOption');
}
$option->fromArray($scriptProperties);

$result = $option->save();

if ($result) {
    return $modx->error->success('Database updated.');
}
return $modx->error->failure('Error.');
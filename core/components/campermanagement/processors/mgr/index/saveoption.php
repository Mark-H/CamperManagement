<?php
if (empty($scriptProperties['id'])) {
    $option = $modx->newObject('cmOption');
} else {
    $option = $modx->getObject('cmOption',$scriptProperties['id']);
}
$option->fromArray($scriptProperties);

$result = $option->save();

if ($result) {
    return $modx->error->success($option->get('id'));
}
return $modx->error->failure('Error.');
<?php
if (empty($scriptProperties['id'])) {
    $brand = $modx->newObject('cmBrand');
} else {
    $brand = $modx->getObject('cmBrand',$scriptProperties['id']);
}
$brand->fromArray($scriptProperties);

$result = $brand->save();

if ($result) {
    return $modx->error->success('Database updated.');
}
return $modx->error->failure('Error.');
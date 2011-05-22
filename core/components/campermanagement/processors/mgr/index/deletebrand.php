<?php

$brand = $modx->getObject('cmBrand',$scriptProperties['owner']);
if (!empty($brand)) {
    $brand->remove();
    if ($brand->save()) { return $modx->error->success('Deleted'); }
    else { return $modx->error->failure('Error removing'); }
} else {
    return $modx->error->failure('Brand not found.');
}
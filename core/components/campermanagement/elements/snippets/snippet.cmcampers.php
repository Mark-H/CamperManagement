<?php
/**
 * @package campermanagement
 */

// NOT for production use.
$base_path = !empty($base_path) ? $base_path : $modx->getOption('core_path').'components/campermanagement/';

$modelPath = $base_path.'model/';
$modx->addPackage('campermanagement',$modelPath);

if ($_GET['createtables'] == 'do') {
$manager = $modx->getManager();

$manager->createObjectContainer('cmCamper');
$manager->createObjectContainer('cmCamperOptions');
$manager->createObjectContainer('cmOption');
$manager->createObjectContainer('cmBrand');
$manager->createObjectContainer('cmOwner');
}



echo '<pre>';

$campers = $modx->getCollectionGraph('cmCamper','{ "Brand":{}, "Owner":{}, "CamperOptions":{"Options":{}}}');
foreach ($campers as $camper) {
    $array = $camper->toArray();
    $array['brand'] = $camper->Brand->get('name');
    $array['owner'] = $camper->Owner->get('lastname');
    foreach ($camper->CamperOptions as $opt) {
        $array['camperoptions'][] = $opt->Options->toArray();
    }
    print_r($array);
}
echo '</pre>';
return;
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
}

if ($_GET['new'] == 'camper') {
    $c = $modx->newObject('cmCamper');
    $c->fromArray(array(
        'type' => 'Super snel',
        'plate' => '-',
        'car' => 'Suzuki Swift',
        'engine' => '1.0 super',
        'manufactured' => time('-10wks'),
        'beds' => 4,
        'weight' => 3543,
        'mileage' => 245643,
        'periodiccheck' => time('+2wks'),
        'remarks' => 'Super conditie!!'
    ));
    $brand = 'zwasfi';
    $br = $modx->getObject('cmBrand',array('name' => $brand));
    if (!empty($br)) {
        $c->addOne($br);
    } else {
        $br = $modx->newObject('cmBrand');
        $br->set('name',$brand);
        $c->addOne($br);
    }
    $c->save();
}


$campers = $modx->getCollection('cmCamper');
echo '<pre>';
foreach ($campers as $cmp) {
    $stuff = $cmp->toArray();
    $stuff['brand'] = $cmp->getOne('Brand')->get('name');
    $stuff['opts'] = $cmp->getMany('cmCamperOptions');
    foreach ($stuff['opts'] as $opt) {
        $stuff['options'] = $opt->toArray();
    }
    print_r($stuff);
}
echo '</pre>';
return;
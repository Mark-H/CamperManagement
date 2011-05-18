<?php
/**
 * @package campermanagement
 */

// NOT for production use.
$base_path = !empty($base_path) ? $base_path : $modx->getOption('core_path').'components/campermanagement/';

$modelPath = $base_path.'model/';
$modx->addPackage('campermanagement',$modelPath);
/*$manager = $modx->getManager();

$manager->createObjectContainer('cmCamper');
$manager->createObjectContainer('cmCamperOptions');
$manager->createObjectContainer('cmOption');
$manager->createObjectContainer('cmBrand');*/

echo $base_path;
$c = $modx->newObject('cmCamper');
$c->fromArray(array(
    'brand' => 1,
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
$brand = $modx->newObject('cmBrand');
$brand->set('name','Swuzuki');
$c->addOne($brand);
$c->save();

$campers = $modx->getCollection('cmCamper');
echo 'Total: '.count($campers);
foreach ($campers as $cmp) {
    print_r($cmp->toArray());
}
echo 'Lol';
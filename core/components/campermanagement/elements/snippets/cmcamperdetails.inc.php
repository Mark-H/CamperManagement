<?php

$corepath = $modx->getOption('campermanagement.core_path',$config,$modx->getOption('core_path').'components/campermanagement/');
require_once $corepath.'/model/campermanagement/campermanagement.class.php';
$campermgmt = new CamperManagement($modx);
$campermgmt->initialize('mgr');

$cid = (int)$_REQUEST['cid'];
if (empty($cid)) {
    return 'Does not compute!';
    // @TODO: send off to a not found page or something
}

$camper = $modx->getObject('cmCamper',$cid);
if (!($camper instanceof cmCamper)) {
    return 'Cannot find camper...';
    // @TODO: Send to another page?
}

$array = $camper->toArray();

if (in_array($array['status'],array(0,5))) {
    // Camper is either not confirmed yet (status 0) or not active (status 5)
    return 'The camper you tried to find is currently not available.';
}


$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,4);
$sort = $modx->getOption('sort',$scriptProperties,'timestamp');
$dir = $modx->getOption('dir',$scriptProperties,'desc');

$includeBrand = (boolean)$modx->getOption('includeBrand',$scriptProperties,true);
$includeOwner = (boolean)$modx->getOption('includeOwner',$scriptProperties,true);
$includeImages = (boolean)$modx->getOption('includeImages',$scriptProperties,false);
$includeOptions = (boolean)$modx->getOption('includeOptions',$scriptProperties,true);

$numimages = $modx->getOption('numimages',$scriptProperties,100);

if ($includeImages) {
    $tplprop['ImageOuter'] = $modx->getOption('tplImageOuter',$scriptProperties,'cmDefaultTplImageOuter');
    $tplprop['ImageItem'] = $modx->getOption('tplImageItem',$scriptProperties,'cmDefaultTplImageItemDetail');
}
if ($includeOptions) {
    $tplprop['OptionsOuter'] = $modx->getOption('tplOptionsOuter',$scriptProperties,'cmDefaultTplOptionsOuter');
    $tplprop['OptionsItem'] = $modx->getOption('tplOptionsItem',$scriptProperties,'cmDefaultTplOptionsItem');
}
if ($includeOwner) {
    $tplprop['Owner'] = $modx->getOption('tplOwner',$scriptProperties,'cmDefaultTplOwner');
}
/* Confirm every tpl property is a valid chunk, and if so, assign the property to the $tpl array */
$tpl = array();
foreach ($tplprop as $key => $value) {
    if ($campermgmt->getChunk($value)) {
        $tpl[$key] = $value;
    } else {
        return $key.' chunk does not exist: '.$value;
    }
}
unset ($tplprop);

$statusnames = array('Niet bevestigd','Actief','Topper','In optie','Verkocht','Inactief');

// If the money_format function doesn't exist, let's declare it now cause we'll need it.
if (!function_exists('money_format')) { require_once $campermgmt->config['corePath'] . '/classes/function.money_format.php'; }

    $array = array();
    $array = $camper->toArray();
    $array['statusname'] = $statusnames[$array['status']];

    $array['manufactured'] = ($array['manufactured'] > 0) ? strftime('%d/%m/%Y',$array['manufactured']) : 'Onbekend';
    $array['timestamp'] = ($array['timestamp'] > 0) ? strftime('%d/%m/%Y',$array['timestamp']) : 'Onbekend';
    $array['periodiccheck'] = ($array['periodiccheck'] > 0) ? strftime('%d/%m/%Y',$array['periodiccheck']) : 'Onbekend';

    $array['price'] = ($array['price'] > 0) ? money_format('%+!#10n', $array['price']) : money_format('%+!#10n',0);

    // Fetch brand name
    if ($includeBrand) {
        $tBrand = $camper->getOne('Brand');
        $array['brand'] = ($tBrand instanceof cmBrand) ? $tBrand->get('name') : '';
    }

    // Fetch owner details
    if ($includeOwner) {
        $tOwner = $camper->getOne('Owner');
        $array['owner'] = ($tOwner instanceof cmOwner) ? $campermgmt->getChunk($tpl['Owner'],$tOwner->toArray()) : $array['owner'];
    }

    // Fetch images
    if (($includeImages) && ($numimages > 0)) {
        $tImages = $camper->getMany('Images');
        if (!empty($tImages)) {
            $array['images'] = array();
            $imgcounter = 0;
            foreach ($tImages as $img) {
                if (($img instanceof cmImages) && ($imgcounter < $numimages)) {
                    $image = $img->get('path').$img->get('image');
                    $array['images'][] = $campermgmt->getChunk(
                        $tpl['ImageItem'],
                        array('image' => $image)
                    );
                    $imgcounter++;
                }
            }
        }
        if (count($array['images']) > 0)
            $array['images'] = $campermgmt->getChunk($tpl['ImageOuter'],array('images' => implode("\n",$array['images'])));
    }

    // Fetch options
    if ($includeOptions) {
        $tOptionsLink = $camper->getMany('CamperOptions');
        if (!empty($tOptionsLink)) {
            $array['options'] = array();
            foreach ($tOptionsLink as $optLink) {
                if ($optLink instanceof cmCamperOptions) {
                    $opt = $optLink->getOne('Options');
                    if ($opt instanceof cmOption)
                        $array['options'][] = $campermgmt->getChunk(
                            $tpl['OptionsItem'],
                            $optLink->getOne('Options')->toArray()
                        );
                }
            }
        }
        if (count($array['options']) > 0)
            $array['options'] = $campermgmt->getChunk($tpl['OptionsOuter'],array('options' => implode(", ",$array['options'])));
        else
            unset($array['options']);
    }



$modx->setPlaceholders($array,'cm.');

return;

?>
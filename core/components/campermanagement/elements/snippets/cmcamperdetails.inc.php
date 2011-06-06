<?php
/*
 * CamperManagement
 *
 * Copyright 2011 by Mark Hamstra <business@markhamstra.nl>
 *
 * This file is part of CamperManagement, a camper/caravan inventory management
 * addon for MODX Revolution.
 *
 * CamperManagement is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CamperManagement is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CamperManagement; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 */

$corepath = $modx->getOption('campermanagement.core_path',$config,$modx->getOption('core_path').'components/campermanagement/');
require_once $corepath.'/model/campermanagement/campermanagement.class.php';
$campermgmt = new CamperManagement($modx);
$campermgmt->initialize('mgr');

$cid = (int)$_REQUEST['cid'];
if ($cid < 1) {
    $cidEmptyRedirect = (int)$modx->getOption('cidEmptyAction',$scriptProperties,1); // @todo disable in pkg
    if ($cidEmptyRedirect > 0) {
        $url = $modx->makeUrl($cidEmptyRedirect);
        return $modx->sendRedirect($url);
    } else {
        return 'No camper specified.'; // @todo lexicon
    }
}

$camper = $modx->getObject('cmCamper',$cid);
if (!($camper instanceof cmCamper)) {
    $cidInvalidRedirect = (int)$modx->getOption('cidInvalidAction',$scriptProperties,1); // @todo disable in pkg
    if ($cidInvalidRedirect > 0) {
        $url = $modx->makeUrl($cidInvalidRedirect,'',array('from' => $cid));
        return $modx->sendRedirect($url);
    } else {
        return 'Camper not found.'; // @todo lexicon
    }
}

$array = $camper->toArray();
$hideInactive = $modx->getOption('hideInactive',$scriptProperties,false);
if (in_array($array['status'],array(0,5)) && $hideInactive) {
    $cidInactiveRedirect = (int)$modx->getOption('cidInvalidAction',$scriptProperties,1); // @todo disable in pkg
    if ($cidInactiveRedirect > 0) {
        $url = $modx->makeUrl($cidInactiveRedirect,'',array('from' => $cid));
        return $modx->sendRedirect($url);
    } else {
        return 'Camper is no longer available. '; // @todo lexicon
    }
}

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

$statusnames = array($modx->lexicon('campermgmt.status0'),$modx->lexicon('campermgmt.status1'),$modx->lexicon('campermgmt.status2'),$modx->lexicon('campermgmt.status3'),$modx->lexicon('campermgmt.status4'),$modx->lexicon('campermgmt.status5'));

// If the money_format function doesn't exist, let's declare it now cause we'll need it.
if (!function_exists('money_format')) { require_once $campermgmt->config['corePath'] . '/classes/function.money_format.php'; }

    $array = array();
    $array = $camper->toArray();
    $array['statusname'] = $statusnames[$array['status']];

    $array['manufactured'] = ($array['manufactured'] > 0) ? strftime('%d/%m/%Y',$array['manufactured']) : '';
    $array['added'] = ($array['added'] > 0) ? strftime('%d/%m/%Y',$array['added']) : '';
    $array['periodiccheck'] = ($array['periodiccheck'] > 0) ? strftime('%d/%m/%Y',$array['periodiccheck']) : '';

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
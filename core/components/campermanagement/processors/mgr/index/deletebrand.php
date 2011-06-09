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
$brand = $modx->getObject('cmBrand',$scriptProperties['brand']);
if ($brand instanceof cmBrand) {
    $brand->remove();
    if ($brand->save()) { return $modx->error->success(); }
    else { return $modx->error->failure($modx->lexicon('campermgmt.error.undefined')); }
} else {
    return $modx->error->failure($modx->lexicon('campermgmt.error.brand_nf',$scriptProperties['brand']));
}
?>

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

// Event: OnFileManagerUpload
$path = $directory->getPath();
$expected = $campermgmt->config['assetsPath'].'uploads/';
$assetsurl = $campermgmt->config['assetsUrl'].'uploads/';

if (($path == $expected) && ($files['file'])) {
    // Let's store a reference to the image.
    $id = (is_numeric($_POST['cid'])) ? $_POST['cid'] : null;
    if ($id === null) { return $modx->error->failure('[CamperMgmt] No camper reference found.'); }

    $camper = $modx->getObject('cmCamper',$id);
    if (!($camper instanceof cmCamper)) {
        return $modx->error->failure('Camper not found');
    }

    if (!($directory instanceof modDirectory)) return $modx->error->failure($modx->lexicon('file_folder_err_parent_invalid'));
    if (!$directory->isReadable() || !$directory->isWritable()) return $modx->error->failure($modx->lexicon('file_folder_err_perms_parent'));

    $year = $directory->getPath().date(Y);
    $yeardir = $modx->fileHandler->make($year,array(),'modDirectory');

    if (!$yeardir->exists()) {
        $modx->log('info','[CamperMgmt] Year target directory does not exist, creating..');
        $result = $yeardir->create();
        if ($result !== true) {
            return $modx->error->failure($modx->lexicon('file_folder_err_create').$result);
        }
    }

    $camperid = $yeardir->getPath().'/'.$camper->get('id');
    $camperdir = $modx->fileHandler->make($camperid,array(),'modDirectory');

    if (!$camperdir->exists()) {
        $modx->log('info','[CamperMgmt] Camper target directory does not exist, creating..');
        $result = $camperdir->create();
        if ($result !== true) {
            return $modx->error->failure($modx->lexicon('file_folder_err_create').$result);
        }
    }

    // All file structure in place!
    $subdir = date(Y).'/'.$camper->get('id').'/';
    $results = array();
    $imgrefs = array();
    foreach ($files as $file) {
        $oldfile = $path.$file['name'];
        $newfn = $subdir.$campermgmt->config['imgprefix'].substr(time(),-5).'-'.rand(000,999).'.'.pathinfo($oldfile,PATHINFO_EXTENSION);
        $newfile = $path.$newfn;
        if (!file_exists($oldfile)) { $modx->log('error', '[CamperMgmt] File does not exist at '.$oldloc); }
        if (!rename($oldfile,$newfile)) {
            return $modx->error->failure($modx->lexicon('file_err_upload'));
        }

        $imgobj = $modx->newObject('cmImages');
        $imgobj->fromArray(array(
            'path' => $assetsurl,
            'image' => $newfn,
            'camper' => $id
        ));

        $imgrefs[] = $imgobj;
    }
    $camper->addMany($imgrefs);
    $result = $camper->save();
    if ($result !== true) {
        return $modx->error->failure($modx->lexicon('Adding images to camper object failed.').$result);
    }
    else { return $modx->error->success(); }
}

?>
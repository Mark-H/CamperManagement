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

$path = $directory->getPath();
$expected = $campermgmt->config['assetsPath'].'uploads/originals/';

if (($path == $expected) && ($files['file'])) {
    if ($campermgmt->config['originalfolders']) {
        if (!($directory instanceof modDirectory)) return $modx->error->failure($modx->lexicon('file_folder_err_parent_invalid'));
        if (!$directory->isReadable() || !$directory->isWritable()) return $modx->error->failure($modx->lexicon('file_folder_err_perms_parent'));

        $year = $directory->getPath().date(Y);
        $yeardir = $modx->fileHandler->make($year,array(),'modDirectory');
        
        if (!$yeardir->exists()) {
            $modx->log('warn','Year target does not exist, creating..');
            $result = $yeardir->create();
            if ($result !== true) {
                return $modx->error->failure($modx->lexicon('file_folder_err_create').$result);
            }
        }

        $month = $yeardir->getPath().'/'.date(n);
        $monthdir = $modx->fileHandler->make($month,array(),'modDirectory');

        if (!$monthdir->exists()) {
            $modx->log('warn','Month target does not exist, creating..');
            $result = $monthdir->create();
            if ($result !== true) {
                return $modx->error->failure($modx->lexicon('file_folder_err_create').$result);
            }
        }

        // All file structure in place!
        $modx->log('warn','File structure in place');
        $newloc = $monthdir->getPath().'/';
        $curloc = $path;

        $results = array();
        foreach ($files as $file) {
            $oldfile = $curloc.$file['name'];
            $newfile = $newloc.$file['name'];
            $modx->log('warn','Attempting to move '.$oldfile.' to '.$newfile);
            if (!file_exists($oldfile)) { $modx->log('warn', 'File does not exist at '.$oldloc); }
            if (!rename($oldfile,$newfile)) {
                return $modx->error->failure($modx->lexicon('file_err_upload'));
            }

        }


    }
}

?>
<?php


/*$modx->invokeEvent('OnFileManagerUpload',array(
    'files' => &$_FILES,
    'directory' => &$directory,
));*/

//$modx->log('warn','Files data: '.print_r($files,true));
/*Array
(
    [file] => Array
        (
            [name] => pp-img2.jpg
            [type] => image/jpeg
            [tmp_name] => C:\wamp\tmp\php1EB3.tmp
            [error] => 0
            [size] => 46180
        )

)*/

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
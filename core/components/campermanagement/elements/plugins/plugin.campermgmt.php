<?php
$corepath = $modx->getOption('campermanagement.core_path',$config,$modx->getOption('core_path').'components/campermanagement/');
require_once $corepath.'/model/campermanagement/campermanagement.class.php';
$campermgmt = new CamperManagement($modx);
$campermgmt->initialize('mgr');

include($campermgmt->config['elementsPath'].'plugins/plugin.inc.php');

?>
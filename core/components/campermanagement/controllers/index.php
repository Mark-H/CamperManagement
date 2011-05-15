<?php
require_once dirname(dirname(__FILE__)).'/model/campermanagement/campermanagement.class.php';
$campermgmt = new CamperManagement($modx);
$campermgmt->initialize('mgr');

$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/campermanagement.js');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/page.index.js');

return '<div id="campermanagement"></div>';
?>
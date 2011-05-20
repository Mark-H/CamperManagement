<?php
require_once dirname(dirname(__FILE__)) . '/model/campermanagement/campermanagement.class.php';
$campermgmt = new CamperManagement($modx);
$campermgmt->initialize('mgr');

$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    CamperMgmt.config = '.$modx->toJSON($campermgmt->config).';
});
</script>');
// @TODO: In the actual package, make sure these are minified and/or combined into one or a few files.
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/campermanagement.js');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/page.index.js');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/index.campers.grid.js');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/index.owners.grid.js');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/index.options.grid.js');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/index.brands.grid.js');

return '<div id="campermanagement"></div>';
?>
<?php
require_once dirname(dirname(__FILE__)) . '/model/campermanagement/campermanagement.class.php';
$campermgmt = new CamperManagement($modx);
$campermgmt->initialize('mgr');

$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    CamperMgmt.config = '.$modx->toJSON($campermgmt->config).';
    CamperMgmt.action = '.$_GET['a'].';
});
</script>');
$modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/campermanagement.js');

switch ($_GET['action']) {
    case 'newcamper':
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/page.newcamper.js');
    break;

    case 'index':
    default:
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/page.index.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/grids/grid.campers.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/grids/grid.owners.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/grids/grid.options.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/grids/grid.brands.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/windows/owner.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/windows/option.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/windows/brand.js');
    break;
}
// @TODO: In the actual package, make sure these are minified and/or combined into one or a few files.

return '<div id="campermanagement"></div>';
?>
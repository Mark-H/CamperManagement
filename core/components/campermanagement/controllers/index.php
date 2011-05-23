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
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/windows/owner.js');
        $modx->regClientStartupScript($campermgmt->config['jsUrl'].'mgr/widgets/windows/option.js');
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
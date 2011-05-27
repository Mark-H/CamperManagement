<?php

if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('campermanagement.core_path',null,$modx->getOption('core_path').'components/campermanagement/').'model/';
            $modx->addPackage('campermanagement',$modelPath);

            $manager = $modx->getManager();
            $modx->setLogLevel(modX::LOG_LEVEL_ERROR);
            $manager->createObjectContainer('cmCamper');
            $manager->createObjectContainer('cmCamperOptions');
            $manager->createObjectContainer('cmOption');
            $manager->createObjectContainer('cmBrand');
            $manager->createObjectContainer('cmOwner');
            $modx->setLogLevel(modX::LOG_LEVEL_INFO);
            break;
    }
}
return true;

?>
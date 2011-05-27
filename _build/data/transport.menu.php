<?php

$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => 'campermanagement',
    'parent' => 0,
    'controller' => 'controllers/index',
    'haslayout' => 1,
    'lang_topics' => 'campermanagement:default',
    'assets' => '',
),'',true,true);

/* load menu into action */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'parent' => 'components',
    'text' => 'campermgmt',
    'description' => 'campermgmt.description'
),'',true,true);
$menu->addOne($action);

return $menu;

?>

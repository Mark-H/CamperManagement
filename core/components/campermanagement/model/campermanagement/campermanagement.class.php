<?php

class CamperManagement {
    public $modx;
    public $config = array();
    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
 
        $basePath = $this->modx->getOption('campermanagement.core_path',$config,$this->modx->getOption('core_path').'components/campermanagement/');
        $assetsUrl = $this->modx->getOption('campermanagement.assets_url',$config,$this->modx->getOption('assets_url').'components/campermanagement/');
        $this->config = array_merge(array(
            'basePath' => $basePath,
            'corePath' => $basePath,
            'modelPath' => $basePath.'model/',
            'processorsPath' => $basePath.'processors/',
            'chunksPath' => $basePath.'elements/chunks/',
            'jsUrl' => $assetsUrl.'js/',
            'cssUrl' => $assetsUrl.'css/',
            'assetsUrl' => $assetsUrl,
            'connectorUrl' => $assetsUrl.'connector.php',
            
            'separator' => ';'
        ),$config);
    }
    
    public function initialize($ctx = 'web') {
        switch ($ctx) {
            case 'mgr':
                $this->modx->lexicon->load('campermanagement:default');

            break;
        }
        return true;
    }
}
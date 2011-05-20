<?php
$xpdo_meta_map['cmOption']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers_options',
  'fields' => 
  array (
    'name' => '',
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
  ),
  'composites' => 
  array (
    'CamperOptions' => 
    array (
      'class' => 'cmCamperOptions',
      'local' => 'id',
      'foreign' => 'option',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);

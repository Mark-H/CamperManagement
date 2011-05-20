<?php
$xpdo_meta_map['cmBrand']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers_brands',
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
  'aggregates' => 
  array (
    'Campers' => 
    array (
      'class' => 'cmCamper',
      'local' => 'id',
      'foreign' => 'brand',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);

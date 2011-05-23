<?php
$xpdo_meta_map['cmImages']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers_images',
  'fields' => 
  array (
    'camper' => 0,
    'image' => '',
  ),
  'fieldMeta' => 
  array (
    'camper' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'image' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
  ),
  'aggregates' => 
  array (
    'Camper' => 
    array (
      'class' => 'cmCamper',
      'local' => 'camper',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);

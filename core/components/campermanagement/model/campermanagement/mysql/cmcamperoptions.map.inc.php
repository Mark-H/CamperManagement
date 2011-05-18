<?php
$xpdo_meta_map['cmCamperOptions']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers_optionslink',
  'fields' => 
  array (
    'camper' => 0,
    'option' => 0,
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
      'index' => 'index',
    ),
    'option' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
  ),
  'aggregates' => 
  array (
    'Campers' => 
    array (
      'class' => 'cmCamper',
      'local' => 'camper',
      'foreign' => 'id',
      'cardinality' => 'many',
      'owner' => 'foreign',
    ),
    'Options' => 
    array (
      'class' => 'cmOption',
      'local' => 'owner',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);

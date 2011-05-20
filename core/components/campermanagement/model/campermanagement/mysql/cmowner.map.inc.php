<?php
$xpdo_meta_map['cmOwner']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers_owners',
  'fields' => 
  array (
    'firstname' => '',
    'lastname' => '',
    'address' => '',
    'postal' => '',
    'city' => '',
    'country' => '',
  ),
  'fieldMeta' => 
  array (
    'firstname' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'lastname' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'address' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'postal' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'country' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
  ),
  'aggregates' => 
  array (
    'Campers' => 
    array (
      'class' => 'cmCamper',
      'local' => 'id',
      'foreign' => 'owner',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);

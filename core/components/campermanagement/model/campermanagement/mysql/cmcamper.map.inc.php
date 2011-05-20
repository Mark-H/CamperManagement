<?php
$xpdo_meta_map['cmCamper']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers',
  'fields' => 
  array (
    'brand' => 0,
    'type' => '',
    'plate' => '',
    'car' => '',
    'engine' => '',
    'manufactured' => 0,
    'beds' => 0,
    'weight' => 0,
    'mileage' => 0,
    'periodiccheck' => 0,
    'remarks' => '',
    'price' => 0,
    'status' => 0,
    'keynr' => 0,
    'owner' => NULL,
  ),
  'fieldMeta' => 
  array (
    'brand' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'type' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'plate' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'car' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'engine' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'manufactured' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'string',
      'null' => false,
      'default' => 0,
    ),
    'beds' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'weight' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'mileage' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'periodiccheck' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'null' => false,
      'default' => 0,
    ),
    'remarks' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'price' => 
    array (
      'dbtype' => 'int',
      'precision' => '25',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'status' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'keynr' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'owner' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
    ),
  ),
  'aggregates' => 
  array (
    'Brand' => 
    array (
      'class' => 'cmBrand',
      'local' => 'brand',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'CamperOptions' => 
    array (
      'class' => 'cmCamperOptions',
      'local' => 'id',
      'foreign' => 'camper',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);

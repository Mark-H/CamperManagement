<?php
/**
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
    'owner' => 0,
    'timestamp' => 0,
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
      'default' => '',
    ),
    'engine' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'manufactured' => 
    array (
      'dbtype' => 'int',
      'precision' => '25',
      'phptype' => 'integer',
      'default' => 0,
    ),
    'beds' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'default' => 0,
    ),
    'weight' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'default' => 0,
    ),
    'mileage' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'default' => 0,
    ),
    'periodiccheck' => 
    array (
      'dbtype' => 'int',
      'precision' => '25',
      'phptype' => 'integer',
      'attributes' => 'unsigned',
      'default' => 0,
    ),
    'remarks' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'price' => 
    array (
      'dbtype' => 'int',
      'precision' => '25',
      'phptype' => 'integer',
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
      'default' => 0,
    ),
    'owner' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'timestamp' => 
    array (
      'dbtype' => 'int',
      'precision' => '25',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
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
    'Owner' => 
    array (
      'class' => 'cmOwner',
      'local' => 'owner',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
  'composites' => 
  array (
    'CamperOptions' => 
    array (
      'class' => 'cmCamperOptions',
      'local' => 'id',
      'foreign' => 'camper',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Images' => 
    array (
      'class' => 'cmImages',
      'local' => 'id',
      'foreign' => 'camper',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);

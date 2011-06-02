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
$xpdo_meta_map['cmOwner']= array (
  'package' => 'campermanagement',
  'table' => 'extra_campers_owners',
  'fields' => 
  array (
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'bank' => 0,
    'phone1' => '',
    'phone2' => '',
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
    'email' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'bank' => 
    array (
      'dbtype' => 'int',
      'precision' => '255',
      'phptype' => 'integer',
      'default' => 0,
    ),
    'phone1' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'phone2' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'address' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'postal' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'default' => '',
    ),
    'city' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
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

/*
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

CamperMgmt.newOwnerWindow = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: 'Eigenaar',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/saveowner'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'textfield',
            fieldLabel: 'Voornaam',
            name: 'firstname',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Achternaam',
            name: 'lastname',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Adres',
            name: 'address'
        },{
            xtype: 'textfield',
            fieldLabel: 'E-mailadres',
            name: 'email'
        },{
            xtype: 'textfield',
            fieldLabel: 'Telefoon (1)',
            name: 'phone1'
        },{
            xtype: 'textfield',
            fieldLabel: 'Telefoon (2)',
            name: 'phone2'
        },{
            xtype: 'textfield',
            fieldLabel: 'Postcode',
            name: 'postal'
        },{
            xtype: 'textfield',
            fieldLabel: 'Plaats',
            name: 'city'
        },{
            xtype: 'textfield',
            fieldLabel: 'Land',
            name: 'country',
            value: 'Nederland'
        },{
            xtype: 'numberfield',
            fieldLabel: 'Bankrekening',
            name: 'bank'
        }]
    });
    CamperMgmt.newOwnerWindow.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.newOwnerWindow,MODx.Window);
Ext.reg('campermgmt-newownerwindow',CamperMgmt.newOwnerWindow);
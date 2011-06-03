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
 *//*
Owner Grid
 */
CamperMgmt.ownerGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'owner-grid',
		baseParams: { action: 'mgr/index/getowners' },
		fields: ['id','firstname','lastname','address','postal','city','country'],
		paging: true,
		autosave: false,
		remoteSort: true,
		tbar: [{
			text: _('campermgmt.owner.new'),
			handler: function(btn,e) {
                if (!CamperMgmt.window.newOwner) {
                    CamperMgmt.window.newOwner = MODx.load({
                        xtype: 'campermgmt-newownerwindow',
                        listeners: {
                            'success': {fn:this.refresh,scope:this}
                        }
                    }); 
                }
                CamperMgmt.window.newOwner.show(e.target);
			}
		}]
		,columns: [{
			header: _('campermgmt.field.id')
			,dataIndex: 'id'
			,sortable: true
			,width: 3
			,hidden: false
		},{
			header: _('campermgmt.field.firstname')
			,dataIndex: 'firstname'
			,sortable: true
			,width: 14
			,hidden: false
		},{
			header: _('campermgmt.field.lastname'),
			dataIndex: 'lastname',
		    sortable: true,
			width: 14
		},{
			header: _('campermgmt.field.address'),
			dataIndex: 'address',
			sortable: true,
			width: 20
		},{
			header: _('campermgmt.field.city'),
			dataIndex: 'city',
    		sortable: true,
			width: 14
		},{
			header: _('campermgmt.field.postal'),
			dataIndex: 'postal',
			sortable: true,
			width: 10
		}],
        listeners: {
            'rowcontextmenu': function(grid, rowIndex,e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: _('update'),
                        handler: function(grid, rowIndex) {
                            if (!CamperMgmt.window.newOwner) {
                                CamperMgmt.window.newOwner = MODx.load({
                                    xtype: 'campermgmt-newownerwindow',
                                    listeners: {
                                        'success': function() { Ext.getCmp('owner-grid').refresh()},
                                        'failure': function() { Ext.getCmp('owner-grid').refresh()}
                                    }
                                });
                            }
                            record = Ext.getCmp('owner-grid').getSelectionModel().getSelected().json;
                            CamperMgmt.window.newOwner.setValues(record);
                            CamperMgmt.window.newOwner.show(e.target);
                        }
                    },{
                        text: _('delete'),
                        handler: function() {
                            owner = Ext.getCmp('owner-grid').getSelectionModel().getSelected().data.id;
                            MODx.Ajax.request({
                                url: CamperMgmt.config.connectorUrl
                                ,params: {
                                    action: 'mgr/index/deleteowner'
                                    ,owner: owner
                                }
                                ,listeners: {
                                    'success': {fn:function(r) {
                                        Ext.getCmp('owner-grid').getSelectionModel().clearSelections(true);
                                        Ext.getCmp('owner-grid').refresh();
                                    },scope:this},
                                    'failure': {fn:function(r) {
                                        Ext.getCmp('owner-grid').refresh();
                                    },scope:this}
                                }
                            });
                            return true;
                        }
                    }]
                });
                _contextMenu.showAt(e.getXY());
            }
        }
    });
    CamperMgmt.ownerGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.ownerGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-owner',CamperMgmt.ownerGrid);
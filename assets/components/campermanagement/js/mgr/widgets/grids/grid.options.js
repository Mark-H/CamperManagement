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
Options Grid
 */
CamperMgmt.optionsGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'options-grid',
		baseParams: { action: 'mgr/index/getoptions' },
		fields: ['id','name'],
		paging: true,
        clicksToEdit: 2,
		autosave: true,
		remoteSort: true,
		tbar: [{
			text: _('campermgmt.option.new'),
			handler: function(btn,e) {
                if (!CamperMgmt.window.newOption) {
                    CamperMgmt.window.newOption = MODx.load({
                        xtype: 'campermgmt-newoptionwindow',
                        listeners: {
                            'success': function() { Ext.getCmp('options-grid').refresh()},
                            'failure': function() { Ext.getCmp('options-grid').refresh()}
                        }
                    });
                }
                CamperMgmt.window.newOption.show(e.target);
			}
		}]
		,columns: [{
			header: _('campermgmt.field.id')
			,dataIndex: 'id'
			,sortable: true
			,width: 3
			,hidden: false
		},{
			header: _('campermgmt.option')
			,dataIndex: 'name'
			,sortable: true
			,width: 14
			,hidden: false
            ,editable: true
            // @TODO: make inline editing functional
		}],
		listeners: {
            'rowcontextmenu': function(grid, rowIndex,e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: _('update'),
                        handler: function(grid, rowIndex) {
                            if (!CamperMgmt.window.newOption) {
                                CamperMgmt.window.newOption = MODx.load({
                                    xtype: 'campermgmt-newoptionwindow',
                                    listeners: {
                                        'success': function() { Ext.getCmp('options-grid').refresh()},
                                        'failure': function() { Ext.getCmp('options-grid').refresh()}
                                    }
                                });
                            }
                            record = Ext.getCmp('options-grid').getSelectionModel().getSelected().json;
                            CamperMgmt.window.newOption.setValues(record);
                            CamperMgmt.window.newOption.show(e.target);
                        }
                    },{
                        text: _('delete'),
                        handler: function() {
                            owner = Ext.getCmp('options-grid').getSelectionModel().getSelected().data.id;
                            MODx.Ajax.request({
                                url: CamperMgmt.config.connectorUrl
                                ,params: {
                                    action: 'mgr/index/deleteoption'
                                    ,owner: owner
                                }
                                ,listeners: {
                                    'success': {fn:function(r) {
                                        Ext.getCmp('options-grid').getSelectionModel().clearSelections(true);
                                        Ext.getCmp('options-grid').refresh();
                                    },scope:this},
                                    'failure': {fn:function(r) {
                                        Ext.getCmp('options-grid').refresh();
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
    CamperMgmt.optionsGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.optionsGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-options',CamperMgmt.optionsGrid);
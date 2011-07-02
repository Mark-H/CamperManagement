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
CamperMgmt.brandsGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'brands-grid',
		baseParams: { action: 'mgr/index/getbrands' },
		fields: ['id','name'],
		paging: true,
        clicksToEdit: 2,
		autosave: true,
        save_action: 'mgr/brands/savefromgrid',
		remoteSort: true,
		tbar: [{
			text: _('campermgmt.brand.new'),
			handler: function(btn,e) {
                CamperMgmt.window.newBrand = MODx.load({
                    xtype: 'campermgmt-newbrandwindow',
                    listeners: {
                        'success': function() { Ext.getCmp('brands-grid').refresh()},
                        'failure': function() { Ext.getCmp('brands-grid').refresh()}
                    }
                });
                CamperMgmt.window.newBrand.show(e.target);
			}
		}]
		,columns: [{
			header: _('campermgmt.field.id'),
			dataIndex: 'id',
			sortable: true,
			width: 3,
			hidden: false
		},{
			header: _('campermgmt.brand'),
			dataIndex: 'name',
			sortable: true,
			width: 14,
			hidden: false,
            editor: { xtype: 'textfield', allowBlank: false }
		}]
		,listeners: {
            'rowcontextmenu': function(grid, rowIndex,e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: _('update'),
                        handler: function(grid, rowIndex) {
                            CamperMgmt.window.newBrand = MODx.load({
                                xtype: 'campermgmt-newbrandwindow',
                                listeners: {
                                    'success': function() { Ext.getCmp('brands-grid').refresh()},
                                    'failure': function() { Ext.getCmp('brands-grid').refresh()}
                                },
                                title: _('update'),
                                record: Ext.getCmp('brands-grid').getSelectionModel().getSelected().json
                            });
                            CamperMgmt.window.newBrand.show(e.target);
                        }
                    },{
                        text: _('delete'),
                        handler: function() {
                            brand = Ext.getCmp('brands-grid').getSelectionModel().getSelected().data.id;
                            MODx.Ajax.request({
                                url: CamperMgmt.config.connectorUrl
                                ,params: {
                                    action: 'mgr/index/deletebrand'
                                    ,brand: brand
                                }
                                ,listeners: {
                                    'success': {fn:function(r) {
                                        Ext.getCmp('brands-grid').getSelectionModel().clearSelections(true);
                                        Ext.getCmp('brands-grid').refresh();
                                    },scope:this},
                                    'failure': {fn:function(r) {
                                        Ext.getCmp('brands-grid').refresh();
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
    CamperMgmt.brandsGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.brandsGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-brands',CamperMgmt.brandsGrid);
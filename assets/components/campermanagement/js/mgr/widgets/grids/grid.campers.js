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
/*
Index Campers & Caravans Grid
 */
CamperMgmt.indexGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'index-grid',
		baseParams: { action: 'mgr/index/getcampers' },
		fields: ['id','brand','type','plate','car','engine','manufactured','beds','weight','mileage','periodiccheck','remarks','price','status','statusname','keynr','owner','brand','options'],
		paging: true,
		autosave: false,
		remoteSort: true,
		tbar: [{
			text: 'Nieuwe camper toevoegen',
			handler: function() {
				window.location.href = '?a='+CamperMgmt.action+'&action=newcamper';
			}
		}],
		columns: [{
			header: '#',
			dataIndex: 'id',
			sortable: true,
			width: 5
		},{
			header: 'Key'
			,dataIndex: 'keynr'
			,sortable: true
			,width: 5
		},{
			header: 'Merk',
			dataIndex: 'brand',
		    sortable: true,
			width: 18
		},{
			header: 'Type',
			dataIndex: 'type',
			sortable: true,
			width: 18
		},{
			header: 'Eigenaar',
			dataIndex: 'owner',
            sortable: true,
			width: 18
		},{
			header: 'Status',
			dataIndex: 'statusname',
            sortable: true,
			width: 18
		},{
			header: 'Prijs',
			dataIndex: 'price',
			sortable: true,
			width: 18
		}]
		,listeners: {
			'rowcontextmenu': function(grid, rowIndex, e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: 'Aanpassen',
                        handler: function(grid, rowIndex, e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            window.location.href = '?a='+CamperMgmt.action+'&action=newcamper&cid='+cid;
                        }
                    },{
                        text: 'Status',
                        handler: function(grid,rowindex,e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            statuswindow = new CamperMgmt.changeCamperStatusWin({
                                params: { camper: cid }
                            });
                            statuswindow.show();
                        }
                    },{
                        text: 'Genereer Raambiljet',
                        handler: function(grid,rowindex,e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            window.open(MODx.config.site_url+'index.php?id=13&cid='+cid,'raambiljet');
                        }
                    },'-',{
                        text: 'Verwijder camper',
                        handler: function(btn, e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            confirmdelete = new CamperMgmt.confirmDeleteWin({
                                params: { camper: cid }
                            });
                            confirmdelete.show();
                        }
                    }]
                });
                _contextMenu.showAt(e.getXY());
			}
		}
    });
    CamperMgmt.indexGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.indexGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-index',CamperMgmt.indexGrid);

CamperMgmt.changeCamperStatusWin = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: 'Status wijzigen',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/camper/changestatus',
            id: Ext.getCmp('index-grid').getSelectionModel().getSelected().id
        },
        listeners: {
            'success': function () {
                var grid = Ext.getCmp('index-grid');
                if (grid) { grid.refresh(); }
            }
        },
        fields: [{
            xtype: 'textfield',
            fieldLabel: 'Camper',
            disabled: true,
            value: Ext.getCmp('index-grid').getSelectionModel().getSelected().data.brand+' '+Ext.getCmp('index-grid').getSelectionModel().getSelected().data.type
        },{
            xtype: 'modx-combo',
            fieldLabel: 'Status',
            hiddenName: 'newstatus',
            layout: 'form',
            fields: ['id','status'],
            store: [[0,'Niet bevestigd'],[1,'Actief'],[2,'Topper'],[3,'In optie'],[4,'Verkocht'],[5,'Inactief']],
            mode: 'local',
            displayField: 'status',
            valueField: 'id',
            value: Ext.getCmp('index-grid').getSelectionModel().getSelected().data.status
        }]
    });
    CamperMgmt.changeCamperStatusWin.superclass.constructor.call(this,config);
}
Ext.extend(CamperMgmt.changeCamperStatusWin,MODx.Window);
Ext.reg('campermgmt-changecamperstatus',CamperMgmt.changeCamperStatusWin);

CamperMgmt.confirmDeleteWin = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: 'Camper verwijderen',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/camper/remove',
            id: Ext.getCmp('index-grid').getSelectionModel().getSelected().id
        },
        listeners: {
            'success': function () {
                var grid = Ext.getCmp('index-grid');
                if (grid) { grid.refresh(); }
            }
        },
        items: [{
            html: '<p>Weet je zeker dat je deze camper wilt verwijderen? <span style="color: #ff0000">Dit kan NIET worden teruggedraaid!</span>' +
                    '</p><p>Klik op "opslaan" om de camper permanent te verwijderen uit het systeem.</p>',
            padding: '15px'
        }],
        fields: [{
            xtype: 'textfield',
            fieldLabel: 'Camper',
            disabled: true,
            value: Ext.getCmp('index-grid').getSelectionModel().getSelected().data.brand+' '+Ext.getCmp('index-grid').getSelectionModel().getSelected().data.type
        }]
    });
    CamperMgmt.confirmDeleteWin.superclass.constructor.call(this,config);
}
Ext.extend(CamperMgmt.confirmDeleteWin,MODx.Window);
Ext.reg('campermgmt-confirmdeletewin',CamperMgmt.confirmDeleteWin);
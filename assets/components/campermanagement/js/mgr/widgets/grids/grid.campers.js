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
    var tbar = new Ext.Toolbar();
    tbar.addButton({
        text: _('campermgmt.camper.new'),
        handler: function() {
            window.location.href = '?a='+CamperMgmt.action+'&action=newcamper';
        }
    });
    tbar.addSeparator();
    tbar.addButton({
        text: _('campermgmt.showarchived'),
        handler: this.toggleArchive,
        enableToggle: true,
        scope: this
    });
    if (CamperMgmt.config.overviewId > 0) {
        tbar.addSeparator();
        tbar.add({
            text: _('campermgmt.print.overview'),
            handler: function(grid,rowindex,e) {
                window.open(MODx.config.site_url + 'index.php?id=' + CamperMgmt.config.windowId, 'windowsheet');
            }
        })
    }
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'index-grid',
		baseParams: {
            action: 'mgr/index/getcampers',
            archive: CamperMgmt.archive
        },
        params: [],
		fields: ['id','brand','type','plate','car','engine','manufactured','beds','weight','mileage','periodiccheck','remarks','price','status','statusname','keynr','owner','brand','options','added','archived'],
		paging: true,
		autosave: false,
		remoteSort: true,
		tbar: tbar,
		columns: [{
			header: _('campermgmt.field.id'),
			dataIndex: 'id',
			sortable: true,
			width: 5
		},{
			header: _('campermgmt.field.key'),
			dataIndex: 'keynr',
			sortable: true,
			width: 5
		},{
			header: _('campermgmt.brand'),
			dataIndex: 'brand',
		    sortable: true,
			width: 18
		},{
			header: _('campermgmt.field.type'),
			dataIndex: 'type',
			sortable: true,
			width: 18
		},{
			header: _('campermgmt.owner'),
			dataIndex: 'owner',
            sortable: true,
			width: 18
		},{
			header: _('campermgmt.status'),
			dataIndex: 'statusname',
            sortable: true,
			width: 18
		},{ //ID 6
			header: _('campermgmt.added'),
			dataIndex: 'added',
            sortable: true,
			width: 18
		},{ //ID 7
			header: _('campermgmt.archived'),
			dataIndex: 'archived',
            sortable: true,
			width: 18,
            hidden: true
		},{
			header: _('campermgmt.field.price'),
			dataIndex: 'price',
			sortable: true,
			width: 18
		}]
		,listeners: {
			'rowcontextmenu': function(grid, rowIndex, e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: _('update'),
                        handler: function(grid, rowIndex, e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            window.location.href = '?a='+CamperMgmt.action+'&action=newcamper&cid='+cid;
                        }
                    },{
                        text: _('campermgmt.status.edit'),
                        handler: function(grid,rowindex,e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            statuswindow = new CamperMgmt.changeCamperStatusWin({
                                params: { camper: cid }
                            });
                            statuswindow.show();
                        }
                    },'-',{
                        text: _('campermgmt.camper.delete'),
                        handler: function(btn, e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            confirmdelete = new CamperMgmt.confirmDeleteWin({
                                params: { camper: cid }
                            });
                            confirmdelete.show();
                        }
                    }]
                });
                if (CamperMgmt.config.windowId > 0) {
                    _contextMenu.addSeparator();
                    _contextMenu.add({
                        text: _('campermgmt.print.window'),
                        handler: function(grid,rowindex,e) {
                            var cid = Ext.getCmp('index-grid').getSelectionModel().getSelected().id;
                            window.open(MODx.config.site_url + 'index.php?id=' + CamperMgmt.config.windowId + '&cid=' + cid,'windowsheet');
                        }
                    })
                }
                _contextMenu.showAt(e.getXY());
			}
		}
    });
    CamperMgmt.indexGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.indexGrid,MODx.grid.Grid,{
    toggleArchive: function(btn,e) {
        var s = this.getStore();
        if (btn.pressed) {
            s.setBaseParam('archive',1);
            btn.setText(_('campermgmt.hidearchived'));
            this.colModel.config[6].hidden = true;
            this.colModel.config[7].hidden = false;
        } else {
            s.setBaseParam('archive',0);
            btn.setText(_('campermgmt.showarchived'));
            this.colModel.config[7].hidden = true;
            this.colModel.config[6].hidden = false;
        }
        this.getBottomToolbar().changePage(1);
        s.removeAll();
        this.refresh();
    }
});
Ext.reg('campermgmt-grid-index',CamperMgmt.indexGrid);

CamperMgmt.changeCamperStatusWin = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('campermgmt.status.edit'),
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
            fieldLabel: _('campermgmt.camper'),
            disabled: true,
            value: Ext.getCmp('index-grid').getSelectionModel().getSelected().data.brand+' '+Ext.getCmp('index-grid').getSelectionModel().getSelected().data.type
        },{
            xtype: 'modx-combo',
            fieldLabel: _('campermgmt.status'),
            hiddenName: 'newstatus',
            layout: 'form',
            fields: ['id','status'],
            store: [[0,_('campermgmt.status0')],[1,_('campermgmt.status1')],[2,_('campermgmt.status2')],[3,_('campermgmt.status3')],[4,_('campermgmt.status4')],[5,_('campermgmt.status5')]],
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
        title: _('campermgmt.camper.delete'),
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
            html: _('campermgmt.camper.confirmdelete'),
            /*html: '<p>Weet je zeker dat je deze camper wilt verwijderen? <span style="color: #ff0000">Dit kan NIET worden teruggedraaid!</span>' +
                    '</p><p>Klik op "opslaan" om de camper permanent te verwijderen uit het systeem.</p>',*/
            padding: '15px'
        }],
        fields: [{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.camper'),
            disabled: true,
            value: Ext.getCmp('index-grid').getSelectionModel().getSelected().data.brand+' '+Ext.getCmp('index-grid').getSelectionModel().getSelected().data.type
        }]
    });
    CamperMgmt.confirmDeleteWin.superclass.constructor.call(this,config);
}
Ext.extend(CamperMgmt.confirmDeleteWin,MODx.Window);
Ext.reg('campermgmt-confirmdeletewin',CamperMgmt.confirmDeleteWin);
/*
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
			text: 'Nieuwe eigenaar toevoegen',
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
			header: '#'
			,dataIndex: 'id'
			,sortable: true
			,width: 3
			,hidden: false
		},{
			header: 'Voornaam'
			,dataIndex: 'firstname'
			,sortable: true
			,width: 14
			,hidden: false
		},{
			header: 'Achternaam',
			dataIndex: 'lastname',
		    sortable: true,
			width: 14
		},{
			header: 'Adres',
			dataIndex: 'address',
			sortable: true,
			width: 20
		},{
			header: 'Plaats',
			dataIndex: 'city',
    		sortable: true,
			width: 14
		},{
			header: 'Postcode',
			dataIndex: 'postal',
			sortable: true,
			width: 10
		}],
        listeners: {
            'rowcontextmenu': function(grid, rowIndex,e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: 'Eigenaar aanpassen',
                        handler: function(grid, rowIndex) {
                            if (!CamperMgmt.window.newOwner) {
                                CamperMgmt.window.newOwner = MODx.load({
                                    xtype: 'campermgmt-newownerwindow',
                                    listeners: {
                                        'success': function() { Ext.getCmp('owner-grid').refresh()}
                                    }
                                });
                            }
                            record = Ext.getCmp('owner-grid').getSelectionModel().getSelected().json;
                            CamperMgmt.window.newOwner.setValues(record);
                            CamperMgmt.window.newOwner.show(e.target);
                        }
                    },{
                        text: 'Verwijderen',
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
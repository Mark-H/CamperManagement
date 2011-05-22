/*
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
			text: 'Nieuwe optie toevoegen',
			handler: function(btn,e) {
                return true;
			}
		}]
		,columns: [{
			header: '#'
			,dataIndex: 'id'
			,sortable: true
			,width: 3
			,hidden: false
		},{
			header: 'Optie'
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
                        text: 'Aanpassen',
                        handler: function(grid, rowIndex) {
                            if (!CamperMgmt.window.newOption) {
                                CamperMgmt.window.newOption = MODx.load({
                                    xtype: 'campermgmt-newoptionwindow',
                                    listeners: {
                                        'success': function() { Ext.getCmp('owner-grid').refresh()}
                                    }
                                });
                            }
                            record = Ext.getCmp('options-grid').getSelectionModel().getSelected().json;
                            CamperMgmt.window.newOwner.setValues(record);
                            CamperMgmt.window.newOwner.show(e.target);
                        }
                    },{
                        text: 'Verwijderen',
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
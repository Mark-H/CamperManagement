/*
Brands Grid
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
		remoteSort: true,
		tbar: [{
			text: 'Nieuw merk toevoegen',
			handler: function(btn,e) {
                if (!CamperMgmt.window.newBrand) {
                    CamperMgmt.window.newBrand = MODx.load({
                        xtype: 'campermgmt-newbrandwindow',
                        listeners: {
                            'success': function() { Ext.getCmp('brands-grid').refresh()},
                            'failure': function() { Ext.getCmp('brands-grid').refresh()}
                        }
                    });
                }
                CamperMgmt.window.newBrand.show(e.target);
			}
		}]
		,columns: [{
			header: '#'
			,dataIndex: 'id'
			,sortable: true
			,width: 3
			,hidden: false
		},{
			header: 'Merk'
			,dataIndex: 'name'
			,sortable: true
			,width: 14
			,hidden: false
            ,editable: true
            // @TODO: make inline editing functional
		}]
		,listeners: {
            'rowcontextmenu': function(grid, rowIndex,e) {
                var _contextMenu = new Ext.menu.Menu({
                    items: [{
                        text: 'Aanpassen',
                        handler: function(grid, rowIndex) {
                            if (!CamperMgmt.window.newBrand) {
                                CamperMgmt.window.newBrand = MODx.load({
                                    xtype: 'campermgmt-newbrandwindow',
                                    listeners: {
                                        'success': function() { Ext.getCmp('brands-grid').refresh()},
                                        'failure': function() { Ext.getCmp('brands-grid').refresh()}
                                    }
                                });
                            }
                            record = Ext.getCmp('brands-grid').getSelectionModel().getSelected().json;
                            CamperMgmt.window.newBrand.setValues(record);
                            CamperMgmt.window.newBrand.show(e.target);
                        }
                    },{
                        text: 'Verwijderen',
                        handler: function() {
                            owner = Ext.getCmp('brands-grid').getSelectionModel().getSelected().data.id;
                            MODx.Ajax.request({
                                url: CamperMgmt.config.connectorUrl
                                ,params: {
                                    action: 'mgr/index/deletebrand'
                                    ,owner: owner
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
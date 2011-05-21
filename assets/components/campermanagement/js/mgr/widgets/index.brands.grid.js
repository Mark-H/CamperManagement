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
			header: 'Merk'
			,dataIndex: 'name'
			,sortable: true
			,width: 14
			,hidden: false
            ,editable: true
            // @TODO: make inline editing functional
		}]
		,listeners: {
			'cellcontextmenu': function(grid, row, col, eventObj){
				return true;
			}
		}
    });
    CamperMgmt.brandsGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.brandsGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-brands',CamperMgmt.brandsGrid);
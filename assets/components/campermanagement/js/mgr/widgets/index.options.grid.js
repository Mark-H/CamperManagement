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
		}]
		,listeners: {
			'cellcontextmenu': function(grid, row, col, eventObj){
				return true;
			}
		}
    });
    CamperMgmt.optionsGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.optionsGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-options',CamperMgmt.optionsGrid);
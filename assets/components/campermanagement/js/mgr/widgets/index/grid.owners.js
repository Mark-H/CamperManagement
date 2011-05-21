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
		}]
		,listeners: {
			'cellcontextmenu': function(grid, row, col, eventObj){
				return true;
			}
		}


    });
    CamperMgmt.ownerGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.ownerGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-owner',CamperMgmt.ownerGrid);
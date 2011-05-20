/*
Index Campers & Caravans Grid
 */
CamperMgmt.indexGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'index-grid',
		baseParams: { action: 'mgr/index/getcampers' },
		fields: ['id','brand','type','plate','car','engine','manufactured','beds','weight','mileage','periodiccheck','remarks','price','status','keynr','owner','brand','options'],
		paging: true,
		autosave: false,
		remoteSort: true,
		tbar: [{
			text: 'Nieuwe camper toevoegen',
			handler: function(btn,e) {
				/*if (typeof newEventWindow == 'undefined') {
					newEventWindow = MODx.load({
						xtype: 'eventmanager-new-event',
						listeners: {
							'success': function() {
								newEventWindow.hide();
								this.reload();
							}
						}
					});
				}
				newEventWindow.show(e.target);*/
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
			header: 'Key'
			,dataIndex: 'keynr'
			,sortable: true
			,width: 5
			,hidden: false
		},{
			header: 'Merk',
			dataIndex: 'brand',
		    sortable: true,
			width: 14
		},{
			header: 'Type',
			dataIndex: 'type',
			sortable: true,
			width: 20
		},{
			header: 'Eigenaar',
			dataIndex: 'owner',
    		sortable: true,
			width: 16
		},{
			header: 'Prijs',
			dataIndex: 'price',
			sortable: true,
			width: 18
		}]
		,listeners: {
			'cellcontextmenu': function(grid, row, col, eventObj){
				return true;
			}
		}


    });
    CamperMgmt.indexGrid.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.indexGrid,MODx.grid.Grid);
Ext.reg('campermgmt-grid-index',CamperMgmt.indexGrid);
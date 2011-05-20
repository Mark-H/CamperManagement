Ext.onReady(function() {
    Ext.QuickTips.init();
    MODx.load({ xtype: 'campermgmt-page-index'});
});

/*
Index page configuration.
 */
CamperMgmt.page.Index = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        renderTo: 'campermanagement'
        ,components: [{
            xtype: 'campermgmt-panel-header'
        },{
            xtype: 'campermgmt-panel-indexcontent'
        }]
    });
    CamperMgmt.page.Index.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.page.Index,MODx.Component);
Ext.reg('campermgmt-page-index',CamperMgmt.page.Index);

/*
Index page header configuration.
 */
CamperMgmt.panel.Header = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,items: [{
            html: '<h2>'+_('campermgmt')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        }]
    });
    CamperMgmt.panel.Header.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.Header,MODx.Panel);
Ext.reg('campermgmt-panel-header',CamperMgmt.panel.Header);

/*
 Index page rest of page (including grid) configuration
 */
CamperMgmt.panel.IndexContent = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false,
        bodyStyle: 'padding: 15px',
        defaults: {
            autoHeight: true
        },
        items: [{
            xtype: 'modx-panel',
            border: false,
            items: [{
                html: '<p>'+_('campermgmt.description')+'</p>',
                bodyStyle: 'margin-bottom: 15px',
                border: false
            },{
                xtype: 'campermgmt-grid-index',
                border: false
            }]
        }]
    });
    CamperMgmt.panel.IndexContent.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.IndexContent,MODx.Panel);
Ext.reg('campermgmt-panel-indexcontent',CamperMgmt.panel.IndexContent);


/*
Index Grid
 */
CamperMgmt.indexGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,  //CamperMgmt.config.connectorUrl,
		id: 'index-grid',
		baseParams: { action: 'mgr/index/getcampers' },
		fields: ['id','brand','type','plate','car','engine','manufactured','beds','weight','mileage','periodiccheck','remarks','price','status','keynr','owner','brand','options'],
		paging: true,
		autosave: false,
		remoteSort: true,
		//primaryKey: 'eventid',
		items: [{
			xtype: 'tbbutton',
			text: 'Nieuwe camper toevoegen',
            bodyStyle: 'margin-bottom: 5px',
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
			,width: 4
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
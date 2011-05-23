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
		fields: ['id','brand','type','plate','car','engine','manufactured','beds','weight','mileage','periodiccheck','remarks','price','status','keynr','owner','brand','options'],
		paging: true,
		autosave: false,
		remoteSort: true,
		tbar: [{
			text: 'Nieuwe camper toevoegen',
			handler: function(btn,e) {
				window.location.href = '?a='+CamperMgmt.action+'&action=newcamper';
                //return true;
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
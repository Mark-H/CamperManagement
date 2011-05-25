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
            xtype: 'modx-tabs',
            bodyStyle: 'padding: 10px 15px 10px 10px;',
            border: true,
            defaults: { border: false, autoHeight: true, bodyStyle: 'padding: 5px 10px 5px 5px;' },
            items: [{
                title: 'Campers &amp; Caravans',
                items: [{
                    xtype: 'campermgmt-panel-indexcontent',
                    border: false
                }]
            },{
                title: 'Eigenaren',
                items: [{
                    xtype: 'campermgmt-grid-owner',
                    border: false
                }]
            },{
                title: 'Opties',
                items: [{
                    xtype: 'campermgmt-grid-options',
                    border: false
                }]
            },{
                title: 'Merken',
                items: [{
                    xtype: 'campermgmt-grid-brands',
                    border: false
                }]
            }]

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
        defaults: {
            autoHeight: true
        },
        items: [{
            xtype: 'modx-panel',
            border: false,
            items: [{
                xtype: 'campermgmt-grid-index',
                border: false
            }]
        }]
    });
    CamperMgmt.panel.IndexContent.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.IndexContent,MODx.Panel);
Ext.reg('campermgmt-panel-indexcontent',CamperMgmt.panel.IndexContent);



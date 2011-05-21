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
            bodyStyle: 'padding: 10px;',
            border: true,
            defaults: { border: false, autoHeight: true },
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



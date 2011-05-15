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
        border: false
        ,items: [{
            xtype: 'modx-panel',
            //border: false,
            defaults: {
                bodyStyle: 'padding: 15px;',
                autoHeight: true
            },
            items: [{
                html: '<p>'+_('campermgmt.description')+'</p>',
                border: false
            },{
                //xtype: 'campermgmt.index.grid'
            }]
        }]
    });
    CamperMgmt.panel.IndexContent.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.IndexContent,MODx.Panel);
Ext.reg('campermgmt-panel-indexcontent',CamperMgmt.panel.IndexContent);



CamperMgmt.newOptionWindow = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: 'Optie',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/saveoption'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'textfield',
            fieldLabel: 'Naam',
            name: 'name',
            allowBlank: false
        }]
    });
    CamperMgmt.newOptionWindow.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.newOptionWindow,MODx.Window);
Ext.reg('campermgmt-newoptionwindow',CamperMgmt.newOptionWindow);
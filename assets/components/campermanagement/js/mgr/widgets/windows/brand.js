

CamperMgmt.newBrandWindow = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: 'Merk',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/savebrand'
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
    CamperMgmt.newBrandWindow.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.newBrandWindow,MODx.Window);
Ext.reg('campermgmt-newbrandwindow',CamperMgmt.newBrandWindow);
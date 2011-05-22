

CamperMgmt.newOwnerWindow = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: 'Eigenaar',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/saveowner'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'textfield',
            fieldLabel: 'Voornaam',
            name: 'firstname',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Achternaam',
            name: 'lastname',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Adres',
            name: 'address',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Postcode',
            name: 'postal',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Plaats',
            name: 'city',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: 'Land',
            name: 'country',
            allowBlank: false,
            defaultValue: 'Nederland'
        }]
    });
    CamperMgmt.newOwnerWindow.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.newOwnerWindow,MODx.Window);
Ext.reg('campermgmt-newownerwindow',CamperMgmt.newOwnerWindow);
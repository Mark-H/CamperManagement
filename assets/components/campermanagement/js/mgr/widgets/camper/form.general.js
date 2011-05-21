

CamperMgmt.formGeneral = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        /*defaults: {
            layout: 'form',
            labelWidth: 150,
            autoHeight: true,
            hideMode: 'offsets',
            bodyStyle: 'margin: 15px',
            border: false,
            xtype: 'modx-panel'
        },*/
        layout: 'form',
        labelWidth: 125,
        items: [{
            xtype: 'campermgmt-newcamper-form-brandscombo',
            fieldLabel: 'Merknaam',
            name: 'brand',
            id: 'brand'
        },{
            xtype: 'textfield',
            fieldLabel: 'Type',
            name: 'type',
            id: 'type'
        },{
            xtype: 'textfield',
            fieldLabel: 'Kenteken',
            name: 'plate',
            id: 'plate',
            allowBlank: true
        },{
            xtype: 'textfield',
            fieldLabel: 'Auto',
            name: 'car',
            id: 'car'
        },{
            xtype: 'textfield',
            fieldLabel: 'Motor',
            name: 'engine',
            id: 'engine'
        },{
            xtype: 'datefield',
            fieldLabel: 'Bouwdatum',
            name: 'manufactured',
            id: 'manufactured'
        },{
            xtype: 'textfield',
            fieldLabel: 'Slaapplaatsen',
            name: 'beds',
            id: 'beds'
        },{
            xtype: 'textfield',
            fieldLabel: 'Gewicht',
            name: 'weight',
            id: 'weight'
        },{
            xtype: 'textfield',
            fieldLabel: 'Kilometerstand',
            name: 'mileage',
            id: 'mileage'
        },{
            xtype: 'datefield',
            fieldLabel: 'APK tot',
            name: 'periodiccheck',
            id: 'periodiccheck'
        }]
    });
    CamperMgmt.formGeneral.superclass.constructor.call(this,config);
    };
Ext.extend(CamperMgmt.formGeneral,MODx.FormPanel);
Ext.reg('campermgmt-newcamper-form-general',CamperMgmt.formGeneral);

CamperMgmt.formGeneral.BrandsCombo = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/getbrands'
        },
        fields: ['id','name'],
        editable: true,
        typeAhead: true,
        minChars: 1,
        forceSelection: false
    });
    CamperMgmt.formGeneral.BrandsCombo.superclass.constructor.call(this,config);
    };
Ext.extend(CamperMgmt.formGeneral.BrandsCombo,MODx.combo.ComboBox);
Ext.reg('campermgmt-newcamper-form-brandscombo',CamperMgmt.formGeneral.BrandsCombo);
Ext.onReady(function() {
    Ext.QuickTips.init();
    MODx.load({ xtype: 'campermgmt-page-newcamper'});
});

/*
Index page configuration.
 */
CamperMgmt.page.NewCamper = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        renderTo: 'campermanagement',
        buttons: [{
            process: 'submit',
            text: 'Opslaan',
            handler: function() {
                frm = Ext.getCmp('campermgmt-panel-newcamper').form;
                if (frm.isValid()) {
                    opts = Ext.getCmp('campermgmt-gridselectoptions').getSelectedAsList();
                    frm.setValues({options: opts});
                    frm.submit({
                        waitMsg:'Opslaan...',
                        success: function(form,action) {
                            Ext.MessageBox.alert('Opgeslagen!','Deze camper is met succes toegevoegd aan de database.');
                        },
                        failure: function(form,action) {
                            Ext.MessageBox.alert('Fout','Er is iets misgegaan...');
                        }
                    });
                }
                else {
                    Ext.MessageBox.alert('Fout','Vul alle velden juist in.');
                }
            }
        },{
            process: 'cancel',
            text: 'Annuleren',
            handler: function() {
                history.go(-1);
            }
        }]
        ,components: [{
            xtype: 'campermgmt-panel-header'
        },{
            xtype: 'campermgmt-panel-newcamper-content'
        }]
    });
    CamperMgmt.page.NewCamper.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.page.NewCamper,MODx.Component);
Ext.reg('campermgmt-page-newcamper',CamperMgmt.page.NewCamper);

/*
Index page header configuration.
 */
CamperMgmt.panel.Header = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,items: [{
            html: '<h2>Nieuwe camper toevoegen</h2>',
            border: false,
            cls: 'modx-page-header'
        }]
    });
    CamperMgmt.panel.Header.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.Header,MODx.Panel);
Ext.reg('campermgmt-panel-header',CamperMgmt.panel.Header);

/*
 Index page rest of page (including grid) configuration
 */
CamperMgmt.panel.NewCamperContent = function(config) {
    config = config || {};
    Ext.apply(config,{
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/newcamper/save'
        },

        layout: 'fit',
        id: 'campermgmt-panel-newcamper',
        border: false,
        defaults: {
            autoHeight: true
        },
        deferredRender: false,
        forceLayout: true,
        baseCls: 'modx-formpanel',
        items: [{
            xtype: 'modx-tabs',
            border: true,
            defaults: {
                layout: 'form',
                labelWidth: 150,
                autoHeight: true,
                hideMode: 'offsets',
                bodyStyle: 'margin: 15px',
                border: false,
                xtype: 'modx-panel'
            },
            items: [{
                title: 'Foto\'s',
                items: [{
                    handler: this.uploadFiles,
                    scope: this,
                    xtype: 'button',
                    text: 'Nieuwe foto\'s uploaden'
                }]

            },{
                title: 'Voertuig gegevens',
                items: [{
                    layout: 'form',
                    labelWidth: 125,
                    border: false,
                    items: [{
                        xtype: 'campermgmt-newcamper-form-brandscombo',
                        fieldLabel: 'Merknaam',
                        name: 'brand',
                        id: 'brand',
                        allowBlank: false,
                        vtype: 'alphanum'
                    },{
                        xtype: 'textfield',
                        fieldLabel: 'Type',
                        name: 'type',
                        id: 'type',
                        allowBlank: false
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
                        id: 'car',
                        allowBlank: false,
                        vtype: 'alphanum'
                    },{
                        xtype: 'textfield',
                        fieldLabel: 'Motor',
                        name: 'engine',
                        id: 'engine',
                        allowBlank: false
                    },{
                        xtype: 'datefield',
                        fieldLabel: 'Bouwdatum',
                        name: 'manufactured',
                        id: 'manufactured',
                        format: 'd-m-Y',
                        allowBlank: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Slaapplaatsen',
                        name: 'beds',
                        id: 'beds',
                        allowBlank: false,
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Gewicht',
                        name: 'weight',
                        id: 'weight',
                        allowBlank: false,
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Kilometerstand',
                        name: 'mileage',
                        id: 'mileage',
                        allowBlank: false,
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'datefield',
                        fieldLabel: 'APK tot (dd-mm-yyyy)',
                        name: 'periodiccheck',
                        id: 'periodiccheck',
                        format: 'd-m-Y',
                        allowBlank: true
                    }]
                }]
            },{
                title: 'Opties',
                items: [{
                    xtype: 'button',
                    text: 'Nieuwe optie aanmaken',
                    handler: function(btn,e) {
                        if (!CamperMgmt.window.newOption) {
                            CamperMgmt.window.newOption = MODx.load({
                                xtype: 'campermgmt-newoptionwindow',
                                listeners: {
                                    'success': function(form_acc, action) {
                                        Ext.getCmp('options-grid').getStore().reload();
                                    },
                                    'failure': function() { Ext.getCmp('options-grid').refresh()}
                                }
                            });
                        }
                        CamperMgmt.window.newOption.show(e.target);
                    }
                },{
                    layout: 'form',
                    xtype: 'campermgmt-gridselectoptions',
                    params: { limit: 999 },
                    id: 'options-grid',
                    name: 'options',
                    border: false
                },{
                    xtype: 'hidden',
                    name: 'options',
                    value: ''
                }]
            },{
                title: 'Algemeen',
                items: [{
                    layout: 'form',
                    labelWidth: 125,
                    border: false,
                    items: [{
                        xtype: 'numberfield',
                        fieldLabel: 'Prijs (in &euro;)',
                        name: 'price',
                        id: 'price',
                        allowBlank: false,
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Sleutelnummer',
                        name: 'keynr',
                        id: 'keynr',
                        allowBlank: true,
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'textarea',
                        fieldLabel: 'Opmerkingen',
                        name: 'remarks',
                        id: 'remarks',
                        allowBlank: true,
                        maxLength: 250,
                        width: '80%'
                    },{
                        xtype: 'campermgmt-newcamper-form-ownerscombo',
                        fieldLabel: 'Eigenaar',
                        name: 'owner',
                        id: 'owner',
                        allowBlank: false
                    },{
                        xtype: 'button',
                        text: 'Nieuwe eigenaar',
                        fieldLabel: '.. of',
                        handler: function(btn, e) {
                            if (!CamperMgmt.window.newOwner) {
                                CamperMgmt.window.newOwner = MODx.load({
                                    xtype: 'campermgmt-newownerwindow',
                                    listeners: {
                                        'success': function(form_acc,action) {
                                            //console.log(form_acc.a.result.message);
                                            Ext.getCmp('owner').setValue(form_acc.a.result.message);
                                        }
                                    }
                                });
                            }
                            CamperMgmt.window.newOwner.show(e.target);
                        }
                    }]
                }]
            }]
        }]
    });
    CamperMgmt.panel.NewCamperContent.superclass.constructor.call(this,config);
    this.addEvents({
        'beforeUpload': true
        ,'afterUpload': true
        ,'fileBrowserSelect': true
    });
};
Ext.extend(CamperMgmt.panel.NewCamperContent,MODx.FormPanel,{
    uploadFiles: function(btn,e) {
        if (!this.uploader) {
            this.uploader = new Ext.ux.UploadDialog.Dialog({
                id: 'campermgmt-uploader',
                url: MODx.config.connectors_url+'browser/file.php'
                ,base_params: {
                    action: 'upload',
                    prependPath: '',
                    prependUrl: '',
                    path: 'uploads/originals/',
                    basePath: CamperMgmt.config.assetsPath,
                    basePathRelative: 0 
                }
                ,reset_on_hide: true
                ,width: 550
                ,cls: 'ext-ux-uploaddialog-dialog modx-upload-window'
            });
            this.uploader.on('click',function(n,e) {
                n.select();
                this.cm.activeNode = n;
            },this);
            this.uploader.on('show',this.beforeUpload,this);
            this.uploader.on('uploadsuccess',this.uploadSuccess,this);
            this.uploader.on('uploaderror',this.uploadError,this);
            this.uploader.on('uploadfailed',this.uploadFailed,this);
        }
        this.uploader.show(btn);
    },
    uploadError: function(dlg,file,data,rec) {},
    uploadFailed: function(dlg,file,rec) {},

    uploadSuccess:function() {
        //this.refresh();
    },
    beforeUpload: function() {
        var path;
        if (this.uploader.base_params.path) {
            path = this.uploader.base_params.path;
        } else { path = '/'; }

        this.uploader.setBaseParams({
            action: 'upload'
            ,prependPath: this.uploader.base_params.prependPath || null
            ,prependUrl: this.uploader.base_params.prependUrl || null
            ,basePath: this.uploader.base_params.basePath || ''
            ,basePathRelative: this.uploader.base_params.basePathRelative || null
            ,baseUrl: this.uploader.base_params.baseUrl || ''
            ,baseUrlRelative: this.uploader.base_params.baseUrlRelative || null
            ,path: path
            ,wctx: MODx.ctx || ''
        });
        this.fireEvent('beforeUpload',this.uploader);
    }
});
Ext.reg('campermgmt-panel-newcamper-content',CamperMgmt.panel.NewCamperContent);



CamperMgmt.BrandsCombo = function(config) {
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
    CamperMgmt.BrandsCombo.superclass.constructor.call(this,config);
    };
Ext.extend(CamperMgmt.BrandsCombo,MODx.combo.ComboBox);
Ext.reg('campermgmt-newcamper-form-brandscombo',CamperMgmt.BrandsCombo);

CamperMgmt.OwnersCombo = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/getowners',
            display: 'combo'
        },
        fields: ['id','name'],
        displayField: 'name',
        valueField: 'id',
        hiddenName: 'owner',
        editable: true,
        typeAhead: true,
        minChars: 2,
        forceSelection: true
    });
    CamperMgmt.OwnersCombo.superclass.constructor.call(this,config);
    };
Ext.extend(CamperMgmt.OwnersCombo,MODx.combo.ComboBox);
Ext.reg('campermgmt-newcamper-form-ownerscombo',CamperMgmt.OwnersCombo);

CamperMgmt.gridSelectOptions = function(config) {
    config = config || {};
    this.sm = new Ext.grid.CheckboxSelectionModel();

    Ext.applyIf(config,{
        url: CamperMgmt.config.connectorUrl,
        id: 'campermgmt-gridselectoptions',
        baseParams: {
            action: 'mgr/index/getoptions'
        },
        fields: ['id','name'],
        sm: this.sm,
        columns: [
            this.sm,
            {
                header: 'Optie',
                dataIndex: 'name',
                sortable: false,
                width: 200
            }
        ]
    });
    CamperMgmt.gridSelectOptions.superclass.constructor.call(this,config);
}
Ext.extend(CamperMgmt.gridSelectOptions,MODx.grid.Grid);
Ext.reg('campermgmt-gridselectoptions',CamperMgmt.gridSelectOptions);
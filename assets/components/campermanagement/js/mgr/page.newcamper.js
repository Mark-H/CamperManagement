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
    var w = MODx.load({ xtype: 'campermgmt-page-newcamper'});
    if (CamperMgmt.values) {
        Ext.getCmp('campermgmt-panel-newcamper').getForm().setValues(CamperMgmt.values)
    }
    w.show();
    
    if ((CamperMgmt.values) && (CamperMgmt.values.options)) {
        Ext.getCmp('options-grid').store.on('load', function(){
            //console.info('loaded');
            var grid = Ext.getCmp('options-grid');
            //console.info('grid object'+grid);
            var options = CamperMgmt.values.options.split(",");
            //console.info(options);
            for (var i in options) {
                //console.info('i has value '+options[i]);
                var index = grid.store.indexOfId(Number(options[i]));
                //console.info('i has index '+index);
                if (Number(index) > 0) {
                    var optionIndices = (optionIndices) ? optionIndices+','+Number(index) : Number(index);
                }
            }
            //console.info(optionIndices);
            grid.getSelectionModel().selectRows(optionIndices);
        }, this, {
            single: true
        });
    }
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
                    opts = Ext.getCmp('options-grid').getSelectedAsList();
                    frm.setValues({options: opts});
                    frm.submit({
                        waitMsg:'Opslaan...',
                        success: function(form,action) {
                            Ext.MessageBox.alert('Opgeslagen!','Voertuig succesvol opgeslagen.');
                            var cid = action.result.message;
                            if (cid) { 
                                CamperMgmt.cid = cid;
                            }
                            if (Ext.getCmp('images-grid')) {
                                Ext.getCmp('images-grid').baseParams.cid = CamperMgmt.cid
                            }
                            if (Ext.getCmp('campermgmt-panel-newcamper')) {
                                Ext.getCmp('campermgmt-panel-newcamper').baseParams.id = CamperMgmt.cid
                            }
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
            text: 'Terug naar overzicht',
            handler: function() {
                window.location.href = '?a='+CamperMgmt.action;
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
            html: (CamperMgmt.cid > 0) ? '<h2>Voertuig bewerken (#'+CamperMgmt.cid+')</h2>' : '<h2>Nieuwe camper toevoegen</h2>',
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
            action: 'mgr/newcamper/save',
            id: CamperMgmt.cid
        },

        layout: 'fit',
        id: 'campermgmt-panel-newcamper',
        border: false,
        defaults: {
            autoHeight: true,
            deferredRender: false
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
                xtype: 'modx-panel',
                deferredRender: false
            },
            items: [{
                title: 'Algemeen',
                items: [{
                    layout: 'form',
                    labelWidth: 125,
                    border: false,
                    items: [{
                        xtype: 'modx-combo',
                        fieldLabel: 'Status',
                        hiddenName: 'status',
                        fields: ['id','status'],
                        store: [[0,'Niet bevestigd'],[1,'Actief'],[2,'Topper'],[3,'In optie'],[4,'Verkocht'],[5,'Inactief']],
                        mode: 'local',
                        displayField: 'status',
                        valueField: 'id',
                        name: 'status'
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Prijs (in &euro;)',
                        name: 'price',
                        id: 'price',
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Sleutelnummer',
                        name: 'keynr',
                        id: 'keynr',
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'textarea',
                        fieldLabel: 'Opmerkingen',
                        name: 'remarks',
                        id: 'remarks',
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
                                            Ext.getCmp('owner').setValue(form_acc.a.result.message);
                                        }
                                    }
                                });
                            }
                            CamperMgmt.window.newOwner.show(e.target);
                        }
                    }]
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
                        allowBlank: false
                    },{
                        xtype: 'textfield',
                        fieldLabel: 'Type',
                        name: 'type',
                        id: 'type'
                    },{
                        xtype: 'textfield',
                        fieldLabel: 'Kenteken',
                        name: 'plate',
                        id: 'plate'
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
                        id: 'manufactured',
                        format: 'd-m-Y'
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Slaapplaatsen',
                        name: 'beds',
                        id: 'beds',
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Gewicht',
                        name: 'weight',
                        id: 'weight',
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'numberfield',
                        fieldLabel: 'Kilometerstand',
                        name: 'mileage',
                        id: 'mileage',
                        allowNegative: false,
                        allowDecimals: false
                    },{
                        xtype: 'datefield',
                        fieldLabel: 'APK tot (dd-mm-yyyy)',
                        name: 'periodiccheck',
                        id: 'periodiccheck',
                        format: 'd-m-Y'
                    }]
                }]
            },{
                title: 'Opties',
                items: [{
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
                title: 'Foto\'s',
                items: [{
                    layout: 'form',
                    border: false,
                    items: [{
                        xtype: 'hidden',
                        name: 'images',
                        id: 'campermgmt-images'
                    },{
                        xtype: 'campermgmt-grid-images'
                    }]
                }]
            }]
        }]
    });
    CamperMgmt.panel.NewCamperContent.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.NewCamperContent,MODx.FormPanel);
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
    this.store = new Ext.data.Store({
        id: 'cm-store-options',
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/getoptions'
        }, 
        reader: new Ext.data.JsonReader({
            root: 'results',
            fields: ['id','name']
        }),
        listeners: {
            /*load: function(t, records, options) {
                console.info('test ok');
                if (Ext.getCmp('options-grid').getSelectionModel()) { Ext.getCmp('options-grid').getSelectionModel().selectFirstRow() }
                else { console.info('cmp not found') }
            },
            delay: 2000*/
        }
    });
    Ext.applyIf(config,{
        store: this.store,
        id: 'campermgmt-gridselectoptions',
        sm: this.sm,
        tbar: [{
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
                CamperMgmt.window.newOption.reset();
                CamperMgmt.window.newOption.show(e.target);
            }
        }],
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

Ext.override( Ext.grid.CheckboxSelectionModel, {
    handleMouseDown : function(g, rowIndex, e){
        if(e.button !== 0 || this.isLocked()){
            return;
        };
        var view = this.grid.getView();
        if(e.shiftKey && this.last !== false){
            var last = this.last;
            this.selectRange(last, rowIndex, e.ctrlKey);
            this.last = last;
            view.focusRow(rowIndex);
        }else{
            var isSelected = this.isSelected(rowIndex);
            if(isSelected){
                this.deselectRow(rowIndex);
            }else if(!isSelected){
                this.selectRow(rowIndex, ! this.singleSelect);
                view.focusRow(rowIndex);
            }
        }
    }
});
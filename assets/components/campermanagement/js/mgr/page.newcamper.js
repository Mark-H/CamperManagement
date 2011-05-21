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
                alert('Niet opgeslagen!');
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
        baseCls: 'modx-formpanel',
        items: [{
            xtype: 'modx-tabs',
            deferredRender: false,
            forceLayout: true,
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
                title: 'Algemene gegevens',
                items: [{
                    xtype: 'campermgmt-newcamper-form-general'
                }]
            },{
                title: 'Opties',
                items: [{
                    html: 'Hier kan je opties selecteren en/of toevoegen.',
                    border: false
                }]
            },{
                title: 'Overigen',
                items: [{
                    html: 'Hier kan je de eigenaar en opmerkingen invoegen.',
                    border: false
                }]
            }]
        }]
    });
    CamperMgmt.panel.NewCamperContent.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.panel.NewCamperContent,MODx.Panel);
Ext.reg('campermgmt-panel-newcamper-content',CamperMgmt.panel.NewCamperContent);



var CamperMgmt = function(config) {
    config = config || {};
    CamperMgmt.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {}
});
Ext.reg('campermgmt',CamperMgmt);
CamperMgmt = new CamperMgmt();
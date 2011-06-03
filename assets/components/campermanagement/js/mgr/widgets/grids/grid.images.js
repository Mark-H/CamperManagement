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
CamperMgmt.imagesGrid = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		url: CamperMgmt.config.connectorUrl,
		id: 'images-grid',
		baseParams: { action: 'mgr/index/getimages', cid: CamperMgmt.cid },
		fields: ['id','image','path'],
		paging: true,
		remoteSort: true,
		tbar: [{
			text: _('campermgmt.image.upload'),
			handler: function(btn,e) {
                if (CamperMgmt.cid > 0) {
                    if (!this.uploader) {
                        this.uploader = new Ext.ux.UploadDialog.Dialog({
                            id: 'campermgmt-uploader',
                            url: MODx.config.connectors_url+'browser/file.php',
                            base_params: {
                                action: 'upload',
                                prependPath: '',
                                prependUrl: '',
                                path: 'uploads/originals/',
                                basePath: CamperMgmt.config.assetsPath,
                                basePathRelative: 0
                            },
                            reset_on_hide: true,
                            width: 550,
                            cls: 'ext-ux-uploaddialog-dialog modx-upload-window'
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
                } else {
                    Ext.Msg.alert(_('error'),_('campermgmt.image.requiressave'))
                }
			}
		}]
		,columns: [{
			header: _('campermgmt.field.id'),
			dataIndex: 'id',
			sortable: true,
			width: 1,
			hidden: false
		},{
			header: _('campermgmt.image'),
			dataIndex: 'image',
			sortable: true,
			width: 4,
			hidden: false
		},{
			header: _('campermgmt.image.path'),
			dataIndex: 'path',
			sortable: true,
		    width: 5,
			hidden: false
		}]
		,listeners: {
            // @TODO: Make this work
            'rowcontextmenu': function(grid, rowIndex,e) {
                var _ctxmenu = new Ext.menu.Menu({
                    items: [{
                        text: _('delete'),
                        handler: function() {
                            imgid = Ext.getCmp('images-grid').getSelectionModel().getSelected().data.id;
                            MODx.Ajax.request({
                                url: CamperMgmt.config.connectorUrl
                                ,params: {
                                    action: 'mgr/image/remove'
                                    ,image: imgid
                                }
                                ,listeners: {
                                    'success': {fn:function(r) {
                                        Ext.getCmp('images-grid').getSelectionModel().clearSelections(true);
                                        Ext.getCmp('images-grid').refresh();
                                    },scope:this},
                                    'failure': {fn:function(r) {
                                        Ext.getCmp('images-grid').refresh();
                                    },scope:this}
                                }
                            });
                            return true;
                        }
                    }]
                });
                _ctxmenu.showAt(e.getXY());
            }
		}
    });
    CamperMgmt.imagesGrid.superclass.constructor.call(this,config);
    this.addEvents({
        'beforeUpload': true
        ,'afterUpload': true
        ,'fileBrowserSelect': true
    });
};
Ext.extend(CamperMgmt.imagesGrid,MODx.grid.Grid,{
    uploadError: function(dlg,file,data,rec) {},
    uploadFailed: function(dlg,file,rec) {},

    uploadSuccess:function() {
        Ext.getCmp('images-grid').refresh();
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
            ,cid: CamperMgmt.cid
        });
        this.fireEvent('beforeUpload',this.uploader);
    }
});
Ext.reg('campermgmt-grid-images',CamperMgmt.imagesGrid);
Seodomains.window.Resource = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        title: _('add'),
        url: Seodomains.config.connector_url,
        width: 700,
        autoHeight: true,
        action: 'mgr/resource/create',
        saveBtnText:_('add'),
        fields: [{
            xtype: 'hidden',
            name: 'resource',
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'seodomains-combo-domain',
            name: 'domain',
            fieldLabel: _('seodomains_resource_grid_domain'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textarea',
            name: 'content',
            fieldLabel: _('seodomains_resource_grid_content'),
            anchor: '100%',
            allowBlank: false,
            height: 400,
            id: config.id + '-content',
            listeners: {
                render: function (config) {
                    if (MODx.loadRTE) {
                        window.setTimeout(function() {
                            MODx.loadRTE(config.id);
                        }, 300);
                    }
                }
            }
        }]
    });
    Seodomains.window.Resource.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains.window.Resource, MODx.Window);
Ext.reg('seodomains-window-resource', Seodomains.window.Resource);

Seodomains.window.UpdateResource = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'seodomains-window-resource-update';
    }
    Ext.applyIf(config, {
        title: _('update'),
        autoHeight: true,
        fields: this.getFields(config),
        url: Seodomains.config.connector_url,
        action: 'mgr/resource/update',
        width: 700
    });
    Seodomains.window.UpdateResource.superclass.constructor.call(this, config);            
};
Ext.extend(Seodomains.window.UpdateResource, MODx.Window, {
    getFields: function (config) {
        
        return [{
            xtype: 'hidden',
            name: 'id',
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'seodomains-combo-domain',
            name: 'domain',
            fieldLabel: _('seodomains_resource_grid_domain'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textarea',
            name: 'content',
            fieldLabel: _('seodomains_resource_grid_content'),
            anchor: '100%',
            allowBlank: false,
            height: 400,
            id: config.id + '-content',
            listeners: {
                render: function (config) {
                    if (MODx.loadRTE) {
                        window.setTimeout(function() {
                            MODx.loadRTE(config.id);
                        }, 300);
                    }
                }
            }
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('seodomains-resource-window-update', Seodomains.window.UpdateResource);
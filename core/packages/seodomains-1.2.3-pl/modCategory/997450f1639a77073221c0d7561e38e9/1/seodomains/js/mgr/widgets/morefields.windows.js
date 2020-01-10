Seodomains.window.Morefields = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        title: _('add'),
        url: Seodomains.config.connector_url,
        width:600,
        action: 'mgr/morefields/create',
        saveBtnText:_('add'),
        fields: [{
            xtype: 'hidden',
            name: 'domain',
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'name',
            fieldLabel: _('seodomains_morefields_grid_name'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'key',
            fieldLabel: _('seodomains_morefields_grid_key'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textarea',
            name: 'value',
            fieldLabel: _('seodomains_morefields_grid_value'),
            anchor: '99%',
            allowBlank: false
        }]
    });
    Seodomains.window.Morefields.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains.window.Morefields, MODx.Window);
Ext.reg('seodomains-window-morefields', Seodomains.window.Morefields);

Seodomains.window.UpdateMorefields = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'seodomains-window-morefields-update';
    }
    Ext.applyIf(config, {
        title: _('update'),
        autoHeight: true,
        fields: this.getFields(config),
        url: Seodomains.config.connector_url,
        action: 'mgr/morefields/update',
        width: 600
    });
    Seodomains.window.UpdateMorefields.superclass.constructor.call(this, config);            
};
Ext.extend(Seodomains.window.UpdateMorefields, MODx.Window, {
    getFields: function (config) {
        
        return [{
            xtype: 'hidden',
            name: 'id',
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'name',
            fieldLabel: _('seodomains_morefields_grid_name'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'key',
            fieldLabel: _('seodomains_morefields_grid_key'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textarea',
            name: 'value',
            fieldLabel: _('seodomains_morefields_grid_value'),
            anchor: '99%',
            allowBlank: false
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('seodomains-morefields-window-update', Seodomains.window.UpdateMorefields);
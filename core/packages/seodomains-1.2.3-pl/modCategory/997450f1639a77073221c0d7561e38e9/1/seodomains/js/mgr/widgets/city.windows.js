Seodomains.window.City = function (config) {
    config = config || {};
    config.record = config.record || {object: {id: 0}};
    Ext.applyIf(config, {
        title: _('add'),
        url: Seodomains.config.connector_url,
        width:800,
        action: 'mgr/city/create',
        saveBtnText:_('add'),
        fields: [{
            xtype: 'textfield',
            name: 'domain',
            fieldLabel: _('seodomains_city_grid_domain'),
            emptyText: _('seodomains_city_grid_domain_empty'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'checkbox',
            name: 'https',
            fieldLabel: _('seodomains_city_grid_https'),
            anchor: '99%',
            allowBlank: true,
            labelSeparator: '',
            hideLabel: true,
            boxLabel:  _('seodomains_city_grid_https'),
        },{
            xtype: 'textfield',
            name: 'city',
            fieldLabel: _('seodomains_city_grid_city'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'city_r',
            fieldLabel: _('seodomains_city_grid_city_r'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'phone',
            fieldLabel: _('seodomains_city_grid_phone'),
            anchor: '99%',
            allowBlank: true
        },{
            xtype: 'textfield',
            name: 'email',
            fieldLabel: _('seodomains_city_grid_email'),
            anchor: '99%',
            allowBlank: true
        },{
            xtype: 'textarea',
            name: 'address',
            fieldLabel: _('seodomains_city_grid_address'),
            anchor: '99%',
            allowBlank: true
        },{
            xtype: 'textarea',
            name: 'address_full',
            fieldLabel: _('seodomains_city_grid_address_full'),
            anchor: '99%',
            allowBlank: true
        }]
    });
    Seodomains.window.City.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains.window.City, MODx.Window);
Ext.reg('seodomains-window-city', Seodomains.window.City);

Seodomains.window.UpdateCity = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'seodomains-window-city';
    }
    Ext.applyIf(config, {
        title: _('update'),
        autoHeight: true,
        fields: this.getFields(config),
        url: Seodomains.config.connector_url,
        action: 'mgr/city/update',
        width: 800
    });
    Seodomains.window.UpdateCity.superclass.constructor.call(this, config);            
};
Ext.extend(Seodomains.window.UpdateCity, MODx.Window, {
    getFields: function (config) {
        var tabs = [{
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: true,
            hideMode: 'offsets',
            items:[{
                title: _('seodomains_window_main'),
                layout: 'anchor',
                items: [{
                    layout: 'column',
                    border: 'false',
                    anchor: '100%',
                    items:[{
                        columnWidth: 1,
                        layout: 'form',
                        defaults: {msTarget: 'under'},
                        border: 'false',
                        items: [{
                            xtype: 'hidden',
                            name: 'id',
                            id: config.id + '-id',
                        }, {
                            xtype: 'textfield',
                            name: 'domain',
                            fieldLabel: _('seodomains_city_grid_domain'),
                            anchor: '99%',
                            allowBlank: false
                        }, {
                            xtype: 'textfield',
                            name: 'city',
                            fieldLabel: _('seodomains_city_grid_city'),
                            anchor: '99%',
                            allowBlank: false
                        }, {
                            xtype: 'textfield',
                            name: 'city_r',
                            fieldLabel: _('seodomains_city_grid_city_r'),
                            anchor: '99%',
                            allowBlank: false
                        },{
                            xtype: 'textfield',
                            name: 'phone',
                            fieldLabel: _('seodomains_city_grid_phone'),
                            anchor: '99%',
                            allowBlank: true
                        },{
                            xtype: 'textfield',
                            name: 'email',
                            fieldLabel: _('seodomains_city_grid_email'),
                            anchor: '99%',
                            allowBlank: true
                        },{
                            xtype: 'textarea',
                            name: 'address',
                            fieldLabel: _('seodomains_city_grid_address'),
                            anchor: '99%',
                            allowBlank: true
                        },{
                            xtype: 'textarea',
                            name: 'address_full',
                            fieldLabel: _('seodomains_city_grid_address_full'),
                            anchor: '99%',
                            allowBlank: true
                        },{
                            xtype: 'textfield',
                            name: 'address_coordinats',
                            fieldLabel: _('seodomains_city_grid_address_coordinats'),
                            anchor: '99%',
                            allowBlank: true
                        }]
                    }]
                }]
            },{
                title: _('seodomains_window_morefields'),
                layout: 'anchor',
                items:[{
                    layout: 'column',
                    border: 'false',
                    anchor: '100%',
                    items:[{
                        xtype: 'seodomains-grid-morefields',
                        preventRender: true,
                        record: config.record.object
                    }]
                }]
            }]
        }];
    
        return tabs;
    },

    loadDropZones: function () {
    }

});
Ext.reg('seodomains-city-window-update', Seodomains.window.UpdateCity);

Seodomains.window.DuplicateCity = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'seodomains-window-city-duplicate';
    }
    Ext.applyIf(config, {
        title: _('duplicate'),
        autoHeight: true,
        fields: this.getFields(config),
        url: Seodomains.config.connector_url,
        action: 'mgr/city/duplicate',
        width: 800
    });
    Seodomains.window.DuplicateCity.superclass.constructor.call(this, config);            
};
Ext.extend(Seodomains.window.DuplicateCity, MODx.Window, {
    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-duplicate_id',
        },{
            xtype: 'textfield',
            name: 'domain',
            fieldLabel: _('seodomains_city_grid_domain'),
            emptyText: _('seodomains_city_grid_domain_empty'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'checkbox',
            name: 'https',
            fieldLabel: _('seodomains_city_grid_https'),
            anchor: '99%',
            allowBlank: true,
            labelSeparator: '',
            hideLabel: true,
            boxLabel:  _('seodomains_city_grid_https'),
        },{
            xtype: 'textfield',
            name: 'city',
            fieldLabel: _('seodomains_city_grid_city'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'city_r',
            fieldLabel: _('seodomains_city_grid_city_r'),
            anchor: '99%',
            allowBlank: false
        },{
            xtype: 'textfield',
            name: 'phone',
            fieldLabel: _('seodomains_city_grid_phone'),
            anchor: '99%',
            allowBlank: true
        },{
            xtype: 'textfield',
            name: 'email',
            fieldLabel: _('seodomains_city_grid_email'),
            anchor: '99%',
            allowBlank: true
        },{
            xtype: 'textarea',
            name: 'address',
            fieldLabel: _('seodomains_city_grid_address'),
            anchor: '99%',
            allowBlank: true
        },{
            xtype: 'textarea',
            name: 'address_full',
            fieldLabel: _('seodomains_city_grid_address_full'),
            anchor: '99%',
            allowBlank: true
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('seodomains-city-window-duplicate', Seodomains.window.DuplicateCity);
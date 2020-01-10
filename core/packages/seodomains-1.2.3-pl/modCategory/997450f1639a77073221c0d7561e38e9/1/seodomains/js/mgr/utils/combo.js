Seodomains.combo.Domain = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Seodomains.config.connector_url, 
        baseParams: {
            action: 'mgr/load/domain',
        }, 
        name: 'domain', 
        hiddenName: 'domain',
        fields: ['id', 'city'], 
        mode: 'remote', 
        displayField: 'city', 
        fieldLabel: _('seodomains_city_grid_city'),
        valueField: 'id',
        editable: true, 
        anchor: '99%',
        allowBlank: false,
        autoLoad: false
    });
    Seodomains.combo.Domain.superclass.constructor.call(this, config);
};
Ext.extend(Seodomains.combo.Domain, MODx.combo.ComboBox);
Ext.reg('seodomains-combo-domain', Seodomains.combo.Domain);